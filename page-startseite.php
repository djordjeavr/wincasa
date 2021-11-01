<?php /* Template Name: Startseite */ ?>

<?php get_header() ?>

    <!-- start INFO  -->
    <div class="pt-lg-5 pt-0  mt-lg-5 mt-0">
        <div class="container p-0">
            
         <div class="row home-page-content m-auto">
             <div class="content-image col-lg-6 col-12 mb-5">
                 <img src="<?= get_field("content_image");?>">
             </div>
             <div class="content-text col-lg-6 col-12">
                 <?= get_field("content_text");?>
             </div>
         </div>
		<div id="kontakt" class="pt-5  mt-5">
			<h2 class="text-center mt-lg-3 mt-0">Kontakt</h2>
         <div class="card-holder py-5 m-0 row justify-content-center" >
             <div class="background contact-card mb-3 mr-3 mr-0 pt-lg-5 p-4">
                 <div class="contact-image m-auto">
                     <img src="<?= get_field("image_location")?>">
                 </div>
                 <div class="mt-lg-4 mt-3 ">
                     <?= get_field("location") ?>
                 </div>
             </div>
             <div  class="background contact-card mb-3  mr-3 mr-0 pt-lg-5 p-4">
                 <div class="contact-image m-auto">
                     <img src="<?= get_field("image_phone")?>">
                 </div>
                 <div class="mt-lg-4 mt-3">
                     <?= get_field("phone") ?>
                 </div>
                 </div>
                 <div  class="background contact-card pt-lg-5  mr-3 mr-0 p-4">
                 <div class="contact-image m-auto">
                     <img src="<?= get_field("image_mail")?>">
                 </div>
                 <div class="mt-lg-4 mt-3 ">
                     <?= get_field("mail") ?>
                 </div>
         </div>
        
    </div>
			</div>
			<div class="homepage-swiper d-flex py-3">
			<?php	$images = get_field('galerie');
                
                if( $images ): ?>
                    <?php foreach( $images as $image ):			
					$size = 'swiper';
					$size_mob = 'swiper-mob';
					$thumb = $image['sizes'][ $size ];
					$thumb_mob = $image['sizes'][ $size_mob ];
					if (wp_is_mobile()) {
						$cover_image = $thumb_mob;
					} else {
						$cover_image = $thumb;
					}
				?> 
                        
             
                            <img class="mr-3" src="<?php echo $cover_image; ?>">

                        
                    <?php endforeach; ?>    

                <?php endif; ?>  
			</div>
		</div>
</div>

<?php create_table_flat_status(); add_flats()?>
<?php //removeData();?>
<?php addLinks();?>
<?php get_footer() ?>