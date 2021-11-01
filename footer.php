<?php
?>

<?php if(home_url($_SERVER['REQUEST_URI']) !== get_site_url().'/kontakt/'){  ?>
<div class="hero2 " id="wincasa-alarm" name="wincasa-alarm">
    <!--<div class="hero-overlay"></div>  -->
    <div class="container ">
        <div class=" d-flex  align-items-center h-100">
            <div class="text-center row">

				
				<div class="col-12"><img class="wincasa-alarm-logo" src="<?php bloginfo('template_directory'); ?>/images/subscribe.svg"></div>
                <h2 class="col-lg-10 offset-lg-1 p-3">Wincasa Alarm</h2>
                <p class="col-lg-6 offset-lg-3">Abonnieren Sie den Wincasa Alarm und verpassen Sie keine freiwerdenden Objekte mehr!</p>
                <p class="col-lg-6 offset-lg-3">Ich möchte darüber benachrichtigt werden, wenn eines der untenstehenden Objekte verfügbar wird:</p>
                
                
                <?php $form = '[ultimatemember form_id="29"]'; ?>
                <div class="subscribe-form col-12 col-lg-6  offset-lg-3" >
                <?php
                if ( !is_user_logged_in() ) {
                    echo do_shortcode($form);
                } 
                ?>
                </div>

            </div>
        </div>
    </div>
</div>
<?php }?>
 <?php if ( UM()->form()->count_errors() > 0 ) : ?>
	<script>
	  document.getElementById("wincasa-alarm").scrollIntoView();
	</script>	
<?php endif ; ?>   



<!-- MAP -->
<div class="map-block clearfix">
       <iframe  class="float-left iframe-map" src="<?php echo get_field('map_link','option'); ?>" width="1200" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
</div>
<!-- end  MAP -->


<!-- start FOOTER-->
<div class="footer">
    <div class="container">
        <div class="row mt-5">
            <div class="col-lg-5 col-12 mb-4 about">
                <img class="footer-logo" src="<?php echo get_field('site_footer_logo','options');  ?>" >
            </div>
            <div class="col-lg-4 col-12">
				 <h3 class="py-3 pb-4">Liegenschaft</h3>
				<?php 
                    wp_nav_menu( array(
                        'theme_location'       => 'primary',
                        'menu'       => 'primary',
                        'depth'      => 1,
                        'container'  => 'ul',
                        'menu_class' => 'px-0',
						'walker'=> new wp_bootstrap_navwalker()
                        )
                    ); 
                ?> 
            </div>
            <div class="col-lg-3 col-12 contact-us">
                <h3 class="py-3 pb-4">Kontaktieren Sie uns</h3>
                <div class="d-flex ">
                    <img src="<?php bloginfo('template_directory'); ?>/images/telephone.svg">
                    <p><a href="tel:0584557777">058 455 77 77</a></p>
                </div>
                <div class="d-flex ">
                    <img src="<?php bloginfo('template_directory'); ?>/images/mail.svg">
                    <p><a href="mailto:info@wincasa.ch">info@wincasa.ch</a></p>
                </div>
				<div class="d-flex">
					 <img class="footer-map-image" src="<?= wp_upload_dir()["baseurl"]; ?>/2021/05/ic-map.png">
                    <p>Ursulaweg 23, 25, 27, 29 ,31 ,33<br>Pfaffenwiesnstr. 50, 52, 54 <br> Heiniweg 6-16<br>8404 Winterthur</p>
				</div>
            </div>
        </div>

    </div>
</div>


<div class="copyright">
	<div class="container">
        <div class="row">
			
            <div class="col-lg-2">
				<div class="copy-logo mb-3 mb-lg-0 text-center text-lg-left">
					<img src="<?php bloginfo('template_directory'); ?>/images/WincasaLogo.png">
				</div>                
            </div>
			
            <div class="col-lg-10">
                <div class="copy-text text-center text-lg-right">
					<span>©</span> 2021 <?php echo get_field('site_link','options');?>  Alle Rechte vorbehalten. 
					<div class="footer-links">
				       <a href="<?php echo get_home_url(); ?>/rechtliche-informationen/">Rechtliche Informationen</a> | <a href="<?php echo get_home_url(); ?>/datenschutzerklaerung">Datenschutz</a> 
					</div>
				</div>
            </div>
            
        </div>
	</div>
</div>


<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns"
        crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
-->


<!-- Magnific Popup -->
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/magnific-popup.css">
<script src="<?php bloginfo('template_directory'); ?>/js/jquery.magnific-popup.js"></script>
<!-- Slider -->

 <script src="<?php bloginfo('template_directory'); ?>/js/swiper.min.js"></script>
 <script src="<?php bloginfo('template_directory'); ?>/js/plugin_wincasaobjektliste.js"></script>

<!--<script>
function 
getViewport(){
    var e=window,a='inner';
    if(!('innerWidth'in window)){a='client';e=document.documentElement||document.body;}
    return{width:e[a+'Width'],height:e[a+'Height']}}
    
    jQuery(document).ready(function($){
        var $win=$(window),isTouch=!!('ontouchstart'in window);(function(){
            function calculator(width){
                var percent='72%';
                if(width<=480){percent='90%';}
                else if(width<=767){percent='75%';}
                return percent;
            };

		var $example=$('#slider'),
		$frame=$('.frame',$example),
		$details=$('div.details',$example),
		$title=$('#title',$details),
		$description=$('#description',$details),
		lastIndex=-1;
		
		$frame.mightySlider(
		{
			speed:1000,
			startAt:1,
			autoScale:1,
			easing:'easeOutExpo',
			navigation:{slideSize:calculator(getViewport().width),keyboardNavBy:'slides',activateOn:'click'},
			dragging:{swingSpeed:0.12,onePage:1},
			buttons:!isTouch?{prev:$('a.mSPrev',$frame),
			next:$('a.mSNext',$frame)}:{},
			cycling: {
                cycleBy:       'pages', // Enable automatic cycling by 'slides' or 'pages'.
                pauseTime:     5000, // Delay between cycles in milliseconds.
                loop:          1,    // Repeat cycling when last slide/page is activated.
                pauseOnHover:  0,    // Pause cycling when mouse hovers over the FRAME.
                startPaused:   0     // Whether to start in paused sate.
            },
		},
		{
		active:function(name,index){
			var slideOptions=this.slides[index].options;
			if(lastIndex!==index)
			$details.stop().animate({opacity:0},500,function(){
				$title.html(slideOptions.title);
				$photographer.html(slideOptions.photographer);
				$description.html(slideOptions.description);
				$details.animate({opacity:1},500);});lastIndex=index;}});
			var API=$frame.data().mightySlider;$win.resize(function(){API.set({navigation:{slideSize:calculator(getViewport().width)}});});})();
});
</script>-->

<?php wp_footer();?>
<script src="<?php bloginfo('template_directory'); ?>/js/script.js?v=1"></script>

</body>

</html>