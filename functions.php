<?php

// Adding woocommerce custom theme support
function add_woocommerce_theme_support() {
  add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'add_woocommerce_theme_support' );

// Enqueuing custom CSS
function add_theme_styles() {
  wp_enqueue_style( 'style', get_stylesheet_uri() );
  wp_enqueue_style( 'aos', get_template_directory_uri() . '/css/aos.css', array(), '1.0', 'all');
  wp_enqueue_style( 'default', get_template_directory_uri() . '/css/default.css', array(), '1.1', 'all');
  wp_enqueue_style( 'bigscreen', get_template_directory_uri() . '/css/big-screen.css', array(), '1.1', 'all');
  wp_enqueue_style( 'mobile', get_template_directory_uri() . '/css/mobile.css', array(), '1.1', 'all');
  wp_enqueue_style( 'ipad', get_template_directory_uri() . '/css/ipad.css', array(), '1.1', 'all');
  wp_enqueue_style( 'menu', get_template_directory_uri() . '/css/menu.css', array(), '1.1', 'all');
  wp_enqueue_style( 'all', get_template_directory_uri() . '/css/all.css', array(), '1.1', 'all');
  wp_enqueue_style( 'flickity', get_template_directory_uri() . '/css/flickity.css', array(), '1.1', 'all');
  wp_enqueue_style( 'easyresponsivetabs', get_template_directory_uri() . '/css/easy-responsive-tabs.css', array(), '1.1', 'all');
  wp_enqueue_style( 'wpb-google-fonts', 'https://fonts.googleapis.com/css2?family=Gilda+Display&family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,800;0,900;1,300&display=swap', false ); 
}
add_action( 'wp_enqueue_scripts', 'add_theme_styles' );

// Enqueuing custom JS
function add_theme_scripts() {
	if( !is_admin()){
       wp_deregister_script('jquery');
       wp_register_script('jquery', get_template_directory_uri() . '/src/jquery-3.2.1.min.js', array(),'',true);
       wp_enqueue_script('jquery');
    }
   wp_enqueue_script('action', get_template_directory_uri() . '/src/action.js', array(),'',true);
   wp_enqueue_script('anime', get_template_directory_uri() . '/src/easyResponsiveTabs.js', array(),'',true);
   wp_enqueue_script('menu', get_template_directory_uri() . '/src/menu.js', array(),'',true);
   wp_enqueue_script('flickity', get_template_directory_uri() . '/src/flickity.pkgd.min.js', array(),'',true);
   wp_enqueue_script('aos', get_template_directory_uri() . '/src/aos.js', array(),'',true);
}
add_action( 'wp_enqueue_scripts', 'add_theme_scripts' );

// Customising the body_class()
function custom_body_class( $classes ) {
    global $post;
    if(is_front_page()) {
  		$classes[] = 'home';
  	} elseif(is_page_template('page-ursprung.php') || is_page_template('page-utz.php') || is_page_template('page-historia.php') || is_page_template('page-forenig.php') || is_page_template('page-recept.php')) {
  		$classes[] = 'inner';
  	} elseif(is_page_template('page-kaffeproducer.php')) {
  		$classes[] = 'inner kaffe';
    } elseif(is_page_template('page-kontakta.php')) {
  		$classes[] = 'inner contact';
    } elseif(is_page_template('page-vara-loften.php')) {
  		$classes[] = 'inner kundloften';
    } elseif(is_home()) {
  		$classes[] = 'nyheter';
    } elseif(is_page_template('page-webshop.php')) {
  		$classes[] = 'webshop';
    } else {
    	$classes[] = 'inner common';
    }

    return $classes;     
}
add_filter( 'body_class','custom_body_class' );

// Enabling the Options page
if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Theme Header Settings',
		'menu_title'	=> 'Theme Options',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Footer Settings',
		'menu_title'	=> 'Footer',
		'parent_slug'	=> 'theme-general-settings',
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Banner Settings',
		'menu_title'	=> 'Banner',
		'parent_slug'	=> 'theme-general-settings',
	));
	
}

// Adding Menu support
add_theme_support( 'menus' );

// Registering menus
function register_my_menus() {
	register_nav_menus(
    	array(
			'header-menu' => __( 'Header Menu' ),
			'footer-menu' => __( 'Footer Menu' )
     	)
   	);
}
add_action( 'init', 'register_my_menus' );

//Changing the return to shop url
add_filter( 'woocommerce_return_to_shop_redirect', 'change_return_shop_url' );
 
function change_return_shop_url() {
return home_url()."/hela-bonor/";
}

// Registering a sidebar
if(function_exists('register_sidebar'))
	register_sidebar(array(
		'before_widget' => '<div id="%1$s" class="secondary_content_widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="secondary_content_widget_title">',
		'after_title' => '</h3>',
	));

//Customising the woocommerce dashboard links
function my_account_menu_order() {
  $menuOrder = array(
      'dashboard'          => __( 'Profil', 'woocommerce' ),
      'orders'             => __( 'Orders', 'woocommerce' ),
      'downloads'          => __( 'Downloads', 'woocommerce' ),
      'edit-address'       => __( 'Addresses', 'woocommerce' ),
      'edit-account'       => __( 'Kontouppgifter', 'woocommerce' ),
      'customer-logout'    => __( 'Logga ut', 'woocommerce' ),
    );
  return $menuOrder;
 }

add_filter ( 'woocommerce_account_menu_items', 'my_account_menu_order' );


// Custom comment loop
function custom_comment($comment, $args, $depth) {	
	$GLOBALS['comment'] = $comment;
?>
	<li class="comment_li" id="comment_<?php comment_ID(); ?>">
		<div class="comment_wrap">
		<?php
			if($comment->comment_approved == '0'):
		?>
			<p class="awaiting_moderation">Your comment is awaiting moderation.</p>
		<?php
			endif;
			if($args['avatar_size'] != 0) {
		?>
				<div class="comment_author_avatar"><?php echo get_avatar($comment, $args['avatar_size']); ?></div>
		<?php
			}
			comment_text();
		?>
			<p class="comment_meta">
				<span class="comment_author"><?php comment_author_link() ?></span>
				&#8212;
				<span class="comment_date"><?php comment_date('M jS, Y'); ?></span>
			</p>
			<p class="comment_reply"><?php echo comment_reply_link(array('before' => '', 'after' => '', 'reply_text' => 'Reply to this comment', 'depth' => $depth, 'max_depth' => $args['max_depth'])); ?></p>
		</div> 
	<?php
}