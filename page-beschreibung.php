<?php /* Template Name: Beschreibung*/ ?>
<?php get_header(); ?>


    <div class="cards">
        <div class="container">


            <?php

            // Check rows exists.
            if (have_rows('beschreibung')):

                // Loop through rows.
                while (have_rows('beschreibung')) : the_row();

                    // Load sub field value.
                    $imageLink = get_sub_field('image');
                    $title = get_sub_field('title');
                    $content = get_sub_field('text');

                    ?>

                    <div class="gray-text shadow about-card mb-5">
                        <div class="row">
                        <div class="col-lg-2 ">
                            <img src="<?php echo $imageLink;?>">
                        </div>
                        <div class="col pt-1">
                            <h2><?php echo $title;?></h2>
                            <p><?php echo $content?></p>

                        </div>
                    </div>
                    </div>

                <?php // End loop.
                endwhile;

            // No value.
            else :
                // Do something...
            endif; ?>

        </div>
    </div>


<?php
get_footer();
?>