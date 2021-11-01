<?php
/**********Displays on which type of flats user is subscribed (using ACF for user)**********/
add_action('show_user_profile', 'onug_show_extra_profile_fields');
add_action('edit_user_profile', 'onug_show_extra_profile_fields');
function onug_show_extra_profile_fields($user)
{
    $private = get_the_author_meta('private', $user->ID);
    $lang = get_the_author_meta('lang', $user->ID);

    ?>
    <h3><?php esc_html_e('Subscribe info', 'onug'); ?></h3>
    <table class="form-table">
        <tr>
            <th><label for="private"><?php esc_html_e('Private?', 'onug'); ?></label></th>
            <td><input type="text" id="private" name="private" value="<?php echo esc_attr($private[0]); ?>"
                       class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="lang"><?php esc_html_e('Language', 'onug'); ?></label></th>
            <td><input type="text" id="lang" name="lang" value="<?php echo esc_attr($lang[0]); ?>" class="regular-text">
            </td>
        </tr>
    </table>

    <?php
}

/**********Adds on which type of flats user is subscribed (using ACF for user) and language**********/
add_action('personal_options_update', 'onug_save_extra_profile_fields');
add_action('edit_user_profile_update', 'onug_save_extra_profile_fields');
function onug_save_extra_profile_fields($user_id)
{

    if (!current_user_can('edit_user', $user_id)) {
        return false;
    }

    update_usermeta($user_id, 'private', esc_attr($_POST['private']));
    update_usermeta($user_id, 'lang', esc_attr($_POST['lang']));
}

/*****************Adds delete link tag to use on email template****************/
add_filter('um_template_tags_patterns_hook', 'my_template_tags_patterns', 10, 1);
add_filter('um_template_tags_replaces_hook', 'my_template_tags_replaces', 10, 1);

function my_template_tags_patterns($search)
{
    $search[] = '{delete_acc_link}';
    return $search;
}

function my_template_tags_replaces($replace)
{
    $replace[] = delete_acc_link();
    return $replace;
}

/*****************Returns link for deleting account*****************/
function delete_acc_link()
{
    $hash = get_hash_code(um_user('user_email'), um_user('ID'));
    $link = get_site_url() . "/loeschen/?user_id=" . um_user('ID') . "&hash=" . $hash;
    return $link;
}

/******************Generate and returns hash for user (salt is optional)******************/
function get_hash_code($mail, $ID)
{
    $salt = "es53ashdrt7wf3";
    return md5("mail:" . $mail . "+id:" . $ID . "+salt:" . $salt);
}

/****************Deletes user from users data table in database (instant deleting!)******************/
function delete_user_account($id)
{
    global $wpdb;
    $query = $wpdb->prepare("DELETE FROM `dm_users` WHERE `ID`=$id");
    $success = $wpdb->get_results($query);
    return $success;
}

/**************Code for creating "domain.com/delete" page (direct url to deleting) ************/
/*
 * <script>
if (confirm('Do you really want to delete your account?')) {
} else {
    window.close();
}
</script>
<?php

	$email=get_userdata($_GET['user_id'])->user_email;

	if(get_hash_code($email,$_GET['user_id'])==$_GET['hash'])
	{
		delete_user_account($_GET['user_id']);
 	}
?>
*/
/******************Creates table for free flats*****************/
function create_table_flat_status()
{
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE IF NOT EXISTS `{$wpdb->base_prefix}flat_status` (
        id INTEGER NOT NULL AUTO_INCREMENT,
        flat_no varchar(50) NOT NULL,
        status varchar(50) NOT NULL,
        time varchar(50) NOT NULL,
        private varchar(50) NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}
/*****************CRON action******************/
add_action('send_mails','add_flats');
/***************Adds flats to database and detect if flat changed status. Sends mail to users********************/
function add_flats()
{
    
    $flats = get_flats();
    $founded = false;
    $changedStatusPrivate = [];
    $changedStatusParking = [];
    $changedStatusGewerbe = [];
    global $wpdb;
    $flatsFromDB = $wpdb->get_results("SELECT * FROM  `{$wpdb->base_prefix}flat_status`");
    
    foreach ($flats as $flat) {
        
        foreach ($flatsFromDB as $flatFromDB) {
            if ($flat['referenceNumber'] == $flatFromDB->flat_no) {
                $founded = true;
                $status = isset($flat['available']) ? "free" : "taken";
                
                if ($flatFromDB->status != $status) {
                    $wpdb->update("{$wpdb->base_prefix}flat_status", ['status' => $status], ['flat_no' => $flat['referenceNumber']]);
                        if ($status == "free") {
                        if ($flat['type'] == "PRIVATE") {
                            $changedStatusPrivate[] = $flat;
                        } else if ($flat['type'] == "PARKING_SPACE") {
                            $changedStatusParking[] = $flat;
                        } else {
                            $changedStatusGewerbe[] = $flat;
                        }
                    }
                }
            }
        }
        if (!$founded) {
            $private = $flat['type'];
            $data = array(
                'flat_no' => $flat['referenceNumber'],
                'status' => isset($flat['available']) ? "free" : "taken",
                'time' => date("d/m/y h:m"),
                'private' => $private
            );
            global $wpdb;
            $wpdb->insert("{$wpdb->base_prefix}flat_status", $data);
        }
        
    }

    if (count($changedStatusPrivate) != 0 || count($changedStatusParking) != 0 || count($changedStatusGewerbe) != 0) {
        send_mails_to_users($changedStatusPrivate, $changedStatusParking, $changedStatusGewerbe);
    }
}

function send_mails_to_users($changedStatusPrivate, $changedStatusParking, $changedStatusGewerbe)
{

    $headers = array('Content-Type: text/html; charset=UTF-8');

    $messages = [];
    $messages['Wohnungen'] = generate_de_private_message($changedStatusPrivate);
    $messages['Parkplätze'] = generate_de_parking_message($changedStatusParking);
    $messages['Gewerbe'] = generate_de_gewerbe_message($changedStatusGewerbe);
   
    $messageDEheader = "<p>Guten Tag<br><br>In der von Ihnen abonnierten Liegenschaft sind neue Objekte verfügbar:</br><br>";
    $messageDEfooter = "<p>Freundliche Grüsse<br><br>Wincasa AG<a href='" . site_url() . "'><br>" . site_url() . "</a><br><br>Wenn Sie sich vom Wincasa Alarm abmelden möchten, dann kontaktieren Sie bitte support@streamnow.ch.</p>
<br> Wenn Sie den Wincasa Alarm nicht mehr brauchen, können Sie sich hier <a href='".delete_acc_link()."'>abmelden</a>.";

    $args = array('role' => 'Subscriber');
    $users = get_users($args);
    $title = "Wincasa Alarm";
    foreach ($users as $user) {
        $private = get_the_author_meta('private', $user->ID);
        //$lang = get_the_author_meta( 'lang', $user->ID );
        if ($private[0] != "Alle" && count($messages[$private[0]])!=0) {
            $message = $messageDEheader . $messages[$private[0]] . $messageDEfooter;
			wp_mail($user->user_email, $title, $message, $headers);
        } 
        else if($private[0]=="Alle") {
            $message = $messageDEheader . $messages['Wohnungen'] . $messages['Gewerbe'] . $messages['Parkplätze'] . $messageDEfooter;
			wp_mail($user->user_email, $title, $message, $headers);
        }
    }
    
}

function generate_de_private_message($flats)
{
    $message = '';
    foreach ($flats as $flat) {
        if ($flat["type"] == 'PRIVATE') {
            $message .= "<br>Objekttyp: Wohnung" . "<br>Anzahl Zimmer: " . $flat["numberOfRooms"] . "<br>Fläche: " . $flat["size"] . "m&#178;" . "<br>Stockwerk: " . $flat["floor"] . "
<br>Nettomiete: " . "CHF " . $flat["netRent"] . ".-" . "
<br>Nebenkosten: " . "CHF " . $flat["ancillaryCosts"] . ".-" . "
<br>Adresse: " . $flat["building"]["street"] . "
<br>Referenznummer: " . $flat["referenceNumber"] . "
<br><br>";
        }
    }
    return $message;
}

function generate_de_gewerbe_message($flats)
{
    $message = '';
    foreach ($flats as $flat) {

        if ($flat["type"] != 'PRIVATE') {
            $type = '';
            if ($flat["type"] == "OFFICE") {
                $type = 'Büro';
            } else if ($flat["type"] == "WAREHOUSE") {
                $type = 'Warengaus';
            }
            $message .= "<br>Objekttyp: " . $type . "<br>Fäche: " . $flat["size"] . "m&#178;<br>Stockwerk: " . $flat["floor"] . "<br>Bruttomiete: " . $flat["netRent"] . "
<br>Nebenkosten: " . "CHF " . $flat["ancillaryCosts"] . ".-" . "
<br>Nebenkosten:
<br>Adresse: " . $flat["building"]["street"] . "
<br>Referenznummer: " . $flat["referenceNumber"] . "
<br><br>";
        }
    }
    return $message;

}

function generate_de_parking_message($flats)
{
    $message = '';
    foreach ($flats as $flat) {
        if ($flat["type"] == 'PARKING_SPACE') {
            $message .= "<br>Objekttyp: Parkplätze" . "<br>Fäche: " . $flat["size"] . "m&#178;<br>Stockwerk: " . $flat["floor"] . "<br>Bruttomiete: " . $flat["netRent"] . "
<br>Nebenkosten: " . "CHF " . $flat["ancillaryCosts"] . ".-" . "
<br>Nebenkosten:
<br>Adresse: " . $flat["building"]["street"] . "
<br>Referenznummer: " . $flat["referenceNumber"] . "
<br><br>";
        }
    }
}

function delete_inactive_users(){

}