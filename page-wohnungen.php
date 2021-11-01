<?php /* Template Name: Wohnungen */ ?>
<?php get_header(); ?>
<main>
<!-- free FLATS -->
<div class="free-flats white-block standard-block">
    <div class="container">
        <?php echo get_field('page_text') ?>
      <?php echo do_shortcode("[get_wohnungen_free_table]"); ?>
		 <div class="swiper-container mb-5 cards" id="freieWohnungenSwiper">
                        <!-- Add Container -->
                    		<?php echo do_shortcode("[get_mobile_cards_wohnungen]"); ?>
                        
                    </div>
    </div>
</div>

<!-- all FLATS -->
<div class="all-flats gray-block">

    <div class="container">
        <div class="standard-block ">
            <h2 class=" red-text text-center mb-5">Alle Wohnungen</h2>
            <?php echo do_shortcode("[get_wohnungen_all_table]"); ?>
        </div>
    </div>
</div>
	</main>
<!-- start FOOTER -->
<?php get_footer(); ?>
<!-- end FOOTER -->