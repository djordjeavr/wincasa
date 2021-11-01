<?php /* Template Name: Parkplatze*/ ?>
<?php get_header();?>

<main>
<!-- free FLATS -->
<div class="free-flats white-block standard-block">
    <div class="container">
        <?php echo get_field('page_text') ?>
      <?php echo do_shortcode("[get_park_free_table]"); ?>
		<div class="swiper-container mb-5 cards" id="freieWohnungenSwiper">
                        <!-- Add Container -->
                    		<?php echo do_shortcode("[get_mobile_cards_park]"); ?>
                    </div>
    </div>
</div>

<!-- all FLATS -->
<div class="all-flats gray-block">

    <div class="container">
        <div class="standard-block ">
            <h2 class="text-center red-text mb-5">Alle Parkplätze</h2>
            <?php echo do_shortcode("[get_park_all_table]"); ?>
        </div>
    </div>
</div>
	</main>
<?php  get_footer() ?>

