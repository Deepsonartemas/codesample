<?php
/**
 * @package WordPress
 * @subpackage
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
	<head profile="http://gmpg.org/xfn/11">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
		<link rel="stylesheet" type="text/css" media="screen" href="<?php bloginfo('stylesheet_url'); ?>" />
		<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
		<?php wp_head(); ?>
		<link rel="shortcut icon" href="<?php echo get_template_directory_uri() ?>/img/favicon.ico">
	</head>
	<body <?php body_class(); ?>>
		<div class="header animated">
	        <div class="container">
	            <div class="logo">
	            	<!--Site logo-->
	                <a href="<?php echo site_url() ?>"><img src="<?php echo get_field('site_logo', 'options') ?>" alt="Logo"></a>
	                <!--Site logo-->
	            </div>
	            <header>
	                <nav id='navigate'>
	                    <div class="button"></div>
	                    <!--Header menu--->
	                    <?php wp_nav_menu( array( 'theme_location' => 'header-menu', 'container' => '' ) );  ?>
	                    <!--Header menu--->
	                </nav>
	            </header>
	            <div class="callto">
	            	<!--Cart and my account links-->
	                <a href="<?php echo wc_get_cart_url() ?>"><img src="<?php echo get_template_directory_uri() ?>/img/shopping-cart.svg" alt=""></a>
	                <a href="<?php echo site_url() ?>/my-account/"><img src="<?php echo get_template_directory_uri() ?>/img/user.svg" alt=""></a>
	                <!--Cart and my account links-->
	            </div>
	        </div>
	    </div>