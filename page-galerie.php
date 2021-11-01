<?php /* Template Name: Galerie*/ ?>
<?php get_header();?>


    <!-- start INFO  -->
    <div class="py-5">
        <div class="container ">

            
                <h1 class="mb-4 text-red text-center"><?php the_title(); ?></h1>
                
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <?php the_content(); ?>
                <?php endwhile; endif; ?>
            
            
                <?php //galerie
                $images = get_field('galerie');
                
                if( $images ): ?>

                    <div class="gallery gallery-block clearfix">
                    <?php foreach( $images as $image ): ?> 
                        
                        <a href="<?php echo $image['sizes']['gallery']; ?>" title="">
                            <img src="<?php echo $image['sizes']['gallery-thumb']; ?>">
                        </a>
                        
                    <?php endforeach; ?>    
                    </div>

                <?php endif; ?>  
            
            
            
        </div>
    </div>






<?php  get_footer() ?>

