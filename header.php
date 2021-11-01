<?php
?>
<!doctype html>
<html lang="en">

<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
          integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <title>
        <?php 
            if(is_front_page()) { 
                bloginfo('name');  
            } else {
                wp_title('');
            }        
        ?>
    </title>
	
    <?php wp_head(); ?>
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/swiper.min.css">
    <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/style.css?v=9">
    
   
    
    <link rel="icon" href="<?php echo get_field('site_favicon','options');  ?>" type="image/x-icon" />
    <link rel="shortcut icon" href="<?php echo get_field('site_favicon','options');  ?>" type="image/x-icon" />
</head>

    
<body <?php body_class(); ?>>

<!-- start NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
        <a class="navbar-brand" href="<?php echo get_home_url(); ?>">
            <img src="<?php echo get_field('site_logo','options');  ?>" alt="">
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
			  <nav class="mainnav navbar-nav mr-auto">
                <?php 
                    wp_nav_menu( array(
                        'theme_location'       => 'primary',
                        'menu'       => 'primary',
                        'depth'      => 2,
                        'container'  => 'ul',
                        'menu_class' => 'navbar-nav text-center',
						'walker'=> new wp_bootstrap_navwalker()
                        )
                    ); 
                ?> 
            </nav>
            <div class="contact text-center">
                <a href="<?= site_url();?>/kontakt">Kontakt</a>
            </div>
        </div>
    </div>
</nav>
<!-- end NAVBAR -->

  <!-- start SLIDER -->
    <?php  if(is_front_page()) : ?>
    <div id="carouselExampleIndicators" class=" mb-5 carousel slide" data-ride="carousel">
        
        <ol class="carousel-indicators">
            <?php if( have_rows('slider', 'option') ):
              $i=0
            ?>

            <?php while( have_rows('slider', 'option') ): the_row(); ?>
            <li data-target="#carouselExampleIndicators" data-slide-to="<?= $i ?>" class="active"></li>
            <?php $i+=1 ?>
            <?php endwhile; ?>
            <?php endif; ?>
        </ol>
        
        <div class="carousel-inner">
            <?php 
                $active=1; 
                if( have_rows('slider', 'option') ): 
            ?>

                <?php while( have_rows('slider', 'option') ): the_row(); 
					$image = get_sub_field('slide');
					$size = 'cover';
					$size_mob = 'cover-mob';
					$thumb = $image['sizes'][ $size ];
					$thumb_mob = $image['sizes'][ $size_mob ];
				?>
                    <div class="carousel-item <?php if($active){echo "active"; $active=0;}?>">
                        <img class="d-block w-100 carousel-image" 
							 src="<?= $image['url']; ?>" 
							 alt="">
                    </div>
			
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
        
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <?php endif; ?>  
    <!-- end SLIDER -->
    
    
     <?php  if(!is_front_page()&& get_the_title() !== '404 Fehler') : ?>   
		<div class="container-fluid mb-5 main-title-block" style="background-image: url(<?php echo get_field('image_background') ?>) ;">	
		<!--	<div class="color-overlay"></div> -->
		</div>       
    <?php endif; ?>  
	<?php 
