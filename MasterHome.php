<?php
/**
Template Name: Homepage
**/

get_header();
?>
		
<div class="outer">
    <!--Video/Image banner-->
	<?php if( have_rows('banner', 'options') ): ?>
		<div class="video-banner"> <img src="<?php echo get_template_directory_uri() ?>/img/video-top.png" alt=""></div>
    	<div class="banner">
            <div class="rt-cafego"><img src="<?php echo get_template_directory_uri() ?>/img/rt-cafego.png" alt=""></div>
            <div class="carousel" data-flickity='{"contain": true, "prevNextButtons": false, "pageDots": true }'>
    		<?php while( have_rows('banner', 'options') ) : the_row(); ?>
    			<div class="carousel-cell">
                    <div class="container">
                        <div class="left"> <img src="<?php echo get_sub_field('image', 'options') ?>" alt=""> </div>
                        <div class="right">
                            <h2><?php echo get_sub_field('title', 'options') ?></h2>
                            <p><?php echo get_sub_field('description', 'options') ?></p> <a href="<?php echo get_permalink(get_sub_field('cta_link', 'options')) ?>"><?php echo get_sub_field('cta_label', 'options') ?></a> </div>
                    </div>
                </div>	
    		<?php endwhile; ?>
            </div>
        </div>

    <?php endif; ?>
    <!--Video/Image banner-->
    
    <!--Icon area-->
    <?php if(have_rows('icon_area')) : ?>
    <div class="icon-area">
        <div class="container">
            <ul>
            	<?php while(have_rows('icon_area')) : the_row(); ?>
                <li><img src="<?php echo get_sub_field('icon_image') ?>" alt="">
                    <h2><?php echo get_sub_field('title') ?></h2> <a href="<?php echo get_sub_field('cta_link') ?>"><?php echo get_sub_field('cta_label') ?></a></li>
                <?php endwhile; ?>
            </ul>
        </div>
    </div>
	<?php endif; ?>
    <!--Icon area-->

    <!--Certificate area-->
	<?php 
	if(have_rows('certificate_area')) :
		while(have_rows('certificate_area')) : the_row();
	?>
		<div class="certificate">
	        <div class="text-hand">
	            <h3><?php echo get_sub_field('title') ?></h3> <a href="<?php echo get_sub_field('cta_link') ?>"><?php echo get_sub_field('cta_label') ?></a> </div>
	        <div class="certificate-video">
	            <h4><?php echo get_sub_field('video_title') ?></h4> <img src="<?php echo get_sub_field('certificate_image') ?>" alt="">
	            <div class="text-block">
	                <p><?php echo get_sub_field('video_description') ?></p>
	                <!--<a href="<?php echo get_sub_field('video_link') ?>">--><img class="video-modal" src="<?php echo get_sub_field('video_button') ?>" alt=""><!--</a>-->
	            </div>
	        </div>
	    </div>
    <?php
    	endwhile;
    endif;
    ?>
    <!--Certificate area-->

    <!--Featured products area-->
    <?php if(have_rows('featured_products')) : ?>
    <div class="product-thumb">
        <ul>
    	<?php while(have_rows('featured_products')) : the_row(); ?>
            <li>
                <a href="<?php echo get_permalink(get_sub_field('product_link')) ?>"><img src="<?php echo get_sub_field('image') ?>" alt="">
                    <p><?php echo get_sub_field('title_and_price') ?></p>
                </a>
            </li>
        <?php endwhile; ?>
        </ul>
    </div>
	<?php endif; ?>
    <!--Featured products area-->

    <!--Blog area-->
	<div class="blog-bt">
        <div class="container-full">
            <div class="blog-area">
                <div class="blog-head">
                    <h3><?php echo get_field('blog_area_title') ?></h3>
                </div>
                <ul>
            	<?php 
				   $the_query = new WP_Query( array(
				      'posts_per_page' => 2,
				   )); 
				?>
				<?php if ( $the_query->have_posts() ) : ?>
				  	<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
				  		<li><a href="<?php the_permalink() ?>"><h2><?php the_title(); ?></h2> <img src="<?php echo get_the_post_thumbnail_url(get_the_ID()) ?>" alt=""></a></li>
			    	<?php endwhile; ?>
			    	<?php wp_reset_postdata(); ?>
		    	<?php else : ?>
  					<li><h2><?php __('No Events'); ?></li></h2>
			    <?php endif; ?>
                </ul>

                <?php
                if(have_rows('caption_area')) :
                	while(have_rows('caption_area')) : the_row();
                ?>
                <div class="caption">
                    <h4><?php echo get_sub_field('testimonial') ?></h4> <a class="cart-btn" href="<?php echo get_sub_field('cta_link') ?>"><?php echo get_sub_field('cta_label') ?></a>
                </div>
                <?php
                	endwhile;
                endif;
                ?>
            </div>
        </div>
    </div>
    <!--Blog area-->
    
<?php
get_footer();
