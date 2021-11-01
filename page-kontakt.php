<?php /* Template Name: Kontakt*/ ?>
<?php get_header();?>



    <!-- content -->
    <main>
        <div class="width_basic mx-auto py-5">
            <div class="row">
                
                
               
                <div class="col-12 col-lg-8 offset-lg-2 pr-0 mb-5 pr-lg-5 mb-lg-0">
                    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <?php the_content(); ?>
                    <?php endwhile; endif; ?>

                    
					<?php //echo do_shortcode('[contact-form-7 id="46" title="Contact form DE"]'); ?>
						
                    <?php the_field('contact_form'); ?>
                    <?php the_field('text_main'); ?>
                </div>
                
                             
                
                
                
                

            </div>
        </div>
    </main>

    
    
    
    
    





<?php  get_footer() ?>
