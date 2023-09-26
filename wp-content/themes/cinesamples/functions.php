<?php
/**
 * Genesis Sample.
 *
 * This file adds functions to the Genesis Sample Theme.
 *
 * @package Genesis Sample
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @link    https://www.studiopress.com/
 */

// Starts the engine.
require_once get_template_directory() . '/lib/init.php';

// Sets up the Theme.
require_once get_stylesheet_directory() . '/lib/theme-defaults.php';

add_action( 'after_setup_theme', 'genesis_sample_localization_setup' );
/**
 * Sets localization (do not remove).
 *
 * @since 1.0.0
 */
function genesis_sample_localization_setup() {

	load_child_theme_textdomain( genesis_get_theme_handle(), get_stylesheet_directory() . '/languages' );

}

// Adds helper functions.
require_once get_stylesheet_directory() . '/lib/helper-functions.php';

// Adds image upload and color select to Customizer.
require_once get_stylesheet_directory() . '/lib/customize.php';

// Includes Customizer CSS.
require_once get_stylesheet_directory() . '/lib/output.php';

// Adds WooCommerce support.
require_once get_stylesheet_directory() . '/lib/woocommerce/woocommerce-setup.php';

// Adds the required WooCommerce styles and Customizer CSS.
require_once get_stylesheet_directory() . '/lib/woocommerce/woocommerce-output.php';

// Adds the Genesis Connect WooCommerce notice.
require_once get_stylesheet_directory() . '/lib/woocommerce/woocommerce-notice.php';

add_action( 'after_setup_theme', 'genesis_child_gutenberg_support' );
/**
 * Adds Gutenberg opt-in features and styling.
 *
 * @since 2.7.0
 */
function genesis_child_gutenberg_support() { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound -- using same in all child themes to allow action to be unhooked.
	require_once get_stylesheet_directory() . '/lib/gutenberg/init.php';
}

// Registers the responsive menus.
if ( function_exists( 'genesis_register_responsive_menus' ) ) {
	genesis_register_responsive_menus( genesis_get_config( 'responsive-menus' ) );
}

add_action( 'wp_enqueue_scripts', 'genesis_sample_enqueue_scripts_styles' );
/**
 * Enqueues scripts and styles.
 *
 * @since 1.0.0
 */
function genesis_sample_enqueue_scripts_styles() {

	$appearance = genesis_get_config( 'appearance' );

	wp_enqueue_style(
		genesis_get_theme_handle() . '-fonts',
		$appearance['fonts-url'],
		[],
		genesis_get_theme_version()
	);

	wp_enqueue_style( 'font-awesome-free', '//use.fontawesome.com/releases/v5.2.0/css/all.css' );


	wp_enqueue_style( 'dashicons' );

	if ( genesis_is_amp() ) {
		wp_enqueue_style(
			genesis_get_theme_handle() . '-amp',
			get_stylesheet_directory_uri() . '/lib/amp/amp.css',
			[ genesis_get_theme_handle() ],
			genesis_get_theme_version()
		);
	}

	// Vendor Files
	wp_enqueue_style(
		genesis_get_theme_handle() . '-b4-grid',
		get_stylesheet_directory_uri() . '/vendor/css/grid.min.css',
		[ genesis_get_theme_handle() ],
		genesis_get_theme_version()
	);

	wp_enqueue_style(
		genesis_get_theme_handle() . '-slick',
		get_stylesheet_directory_uri() . '/vendor/css/slick.css',
		[ genesis_get_theme_handle() ],
		genesis_get_theme_version()
	);

	wp_enqueue_style(
		genesis_get_theme_handle() . '-slick-theme',
		get_stylesheet_directory_uri() . '/vendor/css/slick-theme.css',
		[ genesis_get_theme_handle() ],
		genesis_get_theme_version()
	);

	wp_enqueue_style(
		genesis_get_theme_handle() . '-magnific-css',
		get_stylesheet_directory_uri() . '/vendor/css/magnific-popup.css',
		[ genesis_get_theme_handle() ],
		genesis_get_theme_version()
	);



	wp_enqueue_style(
		genesis_get_theme_handle() . '-main',
		get_stylesheet_directory_uri() . '/assets/css/main.css',
		[ genesis_get_theme_handle() ],
		genesis_get_theme_version()
	);

	wp_enqueue_style(
		genesis_get_theme_handle() . '-blocks',
		get_stylesheet_directory_uri() . '/assets/css/blocks.css',
		[ genesis_get_theme_handle() ],
		genesis_get_theme_version()
	);
	// Js files
	wp_enqueue_script(
		genesis_get_theme_handle() . '-slick-js',
		get_stylesheet_directory_uri() . '/vendor/js/slick.min.js',
		array( 'jquery' ),
		genesis_get_theme_version(),
		true
	);
	wp_enqueue_script(
		genesis_get_theme_handle() . '-magnific-js',
		get_stylesheet_directory_uri() . '/vendor/js/magnific-popup.js',
		array( 'jquery' ),
		genesis_get_theme_version(),
		true
	);

	wp_enqueue_script(
		'main-js',
		get_stylesheet_directory_uri() . '/assets/js/main.js',
		array( 'jquery' ),
		genesis_get_theme_version(),
		true
	);

	wp_enqueue_script(
		'custom-js',
		get_stylesheet_directory_uri() . '/assets/js/custom.js',
		array( 'jquery' ),
		genesis_get_theme_version(),
		true
	);
	wp_localize_script( 'main-js', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php', 'admin' ) ) );

}

add_action('enqueue_block_editor_assets','add_block_editor_assets',10,0);
function add_block_editor_assets(){
	wp_enqueue_style('block_editor_css', get_stylesheet_directory_uri() . '/vendor/css/grid.min.css');
  	wp_enqueue_style('block_editor_css_2', get_stylesheet_directory_uri() . '/assets/css/blocks.css');

}


add_action( 'after_setup_theme', 'genesis_sample_theme_support', 9 );
/**
 * Add desired theme supports.
 *
 * See config file at `config/theme-supports.php`.
 *
 * @since 3.0.0
 */
function genesis_sample_theme_support() {

	$theme_supports = genesis_get_config( 'theme-supports' );

	foreach ( $theme_supports as $feature => $args ) {
		add_theme_support( $feature, $args );
	}

}

add_action( 'after_setup_theme', 'genesis_sample_post_type_support', 9 );
/**
 * Add desired post type supports.
 *
 * See config file at `config/post-type-supports.php`.
 *
 * @since 3.0.0
 */
function genesis_sample_post_type_support() {

	$post_type_supports = genesis_get_config( 'post-type-supports' );

	foreach ( $post_type_supports as $post_type => $args ) {
		add_post_type_support( $post_type, $args );
	}

}

// Adds image sizes.
add_image_size( 'sidebar-featured', 75, 75, true );
add_image_size( 'genesis-singular-images', 702, 526, true );

// Removes header right widget area.
// unregister_sidebar( 'header-right' );

// Removes secondary sidebar.
unregister_sidebar( 'sidebar-alt' );

// Removes site layouts.
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-content-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );

// Repositions primary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_header', 'genesis_do_nav', 12 );

// Repositions the secondary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_footer', 'genesis_do_subnav', 10 );

add_filter( 'wp_nav_menu_args', 'genesis_sample_secondary_menu_args' );
/**
 * Reduces secondary navigation menu to one level depth.
 *
 * @since 2.2.3
 *
 * @param array $args Original menu options.
 * @return array Menu options with depth set to 1.
 */
function genesis_sample_secondary_menu_args( $args ) {

	if ( 'secondary' === $args['theme_location'] ) {
		$args['depth'] = 1;
	}

	return $args;

}

add_filter( 'genesis_author_box_gravatar_size', 'genesis_sample_author_box_gravatar' );
/**
 * Modifies size of the Gravatar in the author box.
 *
 * @since 2.2.3
 *
 * @param int $size Original icon size.
 * @return int Modified icon size.
 */
function genesis_sample_author_box_gravatar( $size ) {

	return 90;

}

add_filter( 'genesis_comment_list_args', 'genesis_sample_comments_gravatar' );
/**
 * Modifies size of the Gravatar in the entry comments.
 *
 * @since 2.2.3
 *
 * @param array $args Gravatar settings.
 * @return array Gravatar settings with modified size.
 */
function genesis_sample_comments_gravatar( $args ) {

	$args['avatar_size'] = 60;
	return $args;

}


function upload_svg_files( $allowed ) {
    if ( !current_user_can( 'manage_options' ) )
        return $allowed;
    $allowed['svg'] = 'image/svg+xml';
    return $allowed;
}
add_filter( 'upload_mimes', 'upload_svg_files');

function enable_extended_upload ( $mime_types =array() ) {

	// The MIME types listed here will be allowed in the media library.
	
	// You can add as many MIME types as you want.
	
	$mime_types['gz']  = 'application/x-gzip';
	
	$mime_types['zip']  = 'application/zip';
	
	$mime_types['rtf'] = 'application/rtf';
	
	$mime_types['ppt'] = 'application/mspowerpoint';
	
	$mime_types['ps'] = 'application/postscript';
	
	$mime_types['flv'] = 'video/x-flv';
	
	// If you want to forbid specific file types which are otherwise allowed,
	
	// specify them here.  You can add as many as possible.
	
	unset( $mime_types['exe'] );
	
	unset( $mime_types['bin'] );
	
	return $mime_types;
	
	}
	
add_filter('upload_mimes', 'enable_extended_upload');
// Hero
add_action( 'genesis_after_header', 'hero_pages' );

function hero_pages() {
	// if( is_front_page()) return;
	?>
	<div id="seach-form" class="search-form" style="display:none;"><div class="c-container"><?php echo get_search_form(); ?><a class="close-search-f"><img src="<?php echo get_stylesheet_directory_uri() ?>/images/close-search.png"></a></div></div>
	<?php
	$hero_slides = get_field('hero_slides') ? get_field('hero_slides') : '';
	if ( $hero_slides != '' ) {
		?>
		<section class="page-hero">
		<?php
		foreach($hero_slides as $hero):
			$hero_title 			= $hero['hero_title'] ? '<h2>'.$hero['hero_title'].'</h2>' : '<h2>'.get_the_title().'</h2>' ;
			$hero_description 		= $hero['hero_content'] ? $hero['hero_content'] : '' ;
			$hero_background_image 	= $hero['hero_background_image'] ? $hero['hero_background_image'] : get_site_url().'/wp-content/uploads/2020/05/image-16.jpg' ;
			$hero_button1			= $hero['hero_button1'] ? '<li><a class="btn" href="'.$hero['hero_button1']['url'].'" title="'.$hero['hero_button1']['title'].'">'.$hero['hero_button1']['title'].'</a>' : '';
			$hero_button2			= $hero['hero_button2'] ? '<li><a class="btn btn-transparent" href="'.$hero['hero_button2']['url'].'" title="'.$hero['hero_button2']['title'].'">'.$hero['hero_button2']['title'].'</a>' : '';
			$background_color		= $hero['background_color'] ? $hero['background_color'] : '';
        ?>
        <div class="page-hero-item" style="background-image: url(<?php echo $hero_background_image?>)">
			<div class="overlay" style="background-color: <?php echo $background_color?>"></div>
			<div class="container">
				<div class="page-hero-info col-sm-12 col-lg-6">
					<?php echo  $hero_title;?>
					<?php echo $hero_description?>
					<?php if($hero_button1 != ''):?>
					<ul>
					<?php echo $hero_button1?>
					<?php echo $hero_button2?>
					</ul>
					<?php endif;?>
				</div>
			</div>
			
		</div>
		
		<?php

		endforeach;
		?>
		</section>
		<?php
    } elseif (get_field('small_title')) {
		?>
    	<section class="page-hero page-hero-white">
			<div class="container text-center">
				<div class="page-hero-info">
					<h4><?php echo get_field('small_title'); ?></h4>
					<h1><?php echo get_field('big_title'); ?></h1>
				</div>
			</div>
		</section>
    	<?php
    }else {
    	$featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full') ? get_the_post_thumbnail_url(get_the_ID(),'full') : get_site_url().'/wp-content/uploads/2020/05/image-16.jpg';
        ?>
          <section class="page-hero page-hero-title" style="background-image: url('<?php echo $featured_img_url?>')">
			<div class="container text-center">
				<div class="page-hero-info">
					<?php echo  get_the_title();?>
				</div>
			</div>
		</section>
        <?php
    }
}
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
add_filter ( 'genesis_edit_post_link' , '__return_false' );

add_filter( 'body_class', 'sp_body_class' );
function sp_body_class( $classes ) {
	$move_to_up = get_field('move_to_up') ? get_field('move_to_up') : '';
	if(is_page() && $move_to_up != ''):
		$classes[] = 'move-to-up';
	endif;
	return $classes;
}


function ff_block_category( $categories, $post ) {

	if ( $post->post_type == 'page' ) { 

		$welcoop_blocks = array_merge(
			$categories,
			array(
				array(
					'slug' => 'headers',
					'title' => __( 'CineSamples Headers', 'mlp-admin' ),
				)
				
				),
				array(	
				array(
					'slug' => 'customblocks',
					'title' => __( 'CineSamples Blocks', 'mlp-admin' ),
				)
				)
		);

	} else {

		return $categories;

	}

	return $welcoop_blocks;
}
add_filter( 'block_categories', 'ff_block_category', 10, 2);

// Blocks
function register_acf_block_types() {
	
	// Custom Title
    acf_register_block_type(array(
        'name'              => 'section-custom-title',
        'title'             => __('Block - Custom Title'),
        'description'       => __('A custom title.'),
        'render_template'   => 'template-parts/blocks/custom/block-custom-title.php',
        'category'          => 'headers',
		'icon'              => 'editor-insertmore',
		'mode'              => 'preview',
		'keywords'          => array( 'block', 'title' ),
	));


	// register a services block.
    acf_register_block_type(array(
        'name'              => 'section-product-categories',
        'title'             => __('Block - Slider Categories'),
        'description'       => __('A custom content block.'),
        'render_template'   => 'template-parts/blocks/custom/block-slider-categories.php',
        'category'          => 'customblocks',
		'icon'              => 'analytics',
		'mode'              => 'preview',
		'keywords'          => array( 'block', 'boxes' ),
	));


	// register a media video block.
    acf_register_block_type(array(
        'name'              => 'section-media-video',
        'title'             => __('Block - Media Video'),
        'description'       => __('A custom content block.'),
        'render_template'   => 'template-parts/blocks/custom/block-media-video.php',
        'category'          => 'customblocks',
		'icon'              => 'video',
		'mode'              => 'preview',
		'keywords'          => array( 'block', 'video' ),
	));


	// register a library block.
    acf_register_block_type(array(
        'name'              => 'section-video-library',
        'title'             => __('Block - Library'),
        'description'       => __('A custom filtered Library Block.'),
        'render_template'   => 'template-parts/blocks/custom/block-library.php',
        'category'          => 'customblocks',
		'icon'              => 'video',
		'mode'              => 'preview',
		'keywords'          => array( 'block', 'video', 'library' ),
	));

	// register a Button block.
    acf_register_block_type(array(
        'name'              => 'section-custom-button',
        'title'             => __('Block - Custom Button'),
        'description'       => __('A custom single button Block.'),
        'render_template'   => 'template-parts/blocks/custom/block-custom-button.php',
        'category'          => 'customblocks',
		'icon'              => 'video',
		'mode'              => 'preview',
		'keywords'          => array( 'block', 'button' ),
	));

	// register a tabs block.
    acf_register_block_type(array(
        'name'              => 'section-custom-tab',
        'title'             => __('Block - Custom Tabs'),
        'description'       => __('A custom Tabs.'),
        'render_template'   => 'template-parts/blocks/custom/block-tabs.php',
        'category'          => 'customblocks',
		'icon'              => 'video',
		'mode'              => 'preview',
		'keywords'          => array( 'block', 'tabs' ),
	));


	// register videos carousel.
    acf_register_block_type(array(
        'name'              => 'section-videos-carousel',
        'title'             => __('Block - Videos Carousel'),
        'description'       => __('A videos carousel.'),
        'render_template'   => 'template-parts/blocks/custom/block-videos-carousel.php',
        'category'          => 'customblocks',
		'icon'              => 'video',
		'mode'              => 'preview',
		'keywords'          => array( 'block', 'video', 'carousel' ),
	));


	// register a blockquote block.
    acf_register_block_type(array(
        'name'              => 'section-blockquote',
        'title'             => __('Block - Blockquote'),
        'description'       => __('A custom content block.'),
        'render_template'   => 'template-parts/blocks/custom/block-blockquote.php',
        'category'          => 'customblocks',
		'icon'              => 'blockquote',
		'mode'              => 'preview',
		'keywords'          => array( 'block', 'blockquote' ),
	));


	
}	
// Check if function exists and hook into setup.
if( function_exists('acf_register_block_type') ) {
    add_action('acf/init', 'register_acf_block_types');
}

$args = array(
	'label' => __('Videos'),
	'singular_label' => __('Video'),
	'public' => true,
	'show_ui' => true,
	'order' => 10,
	'capability_type' => 'page',
	'hierarchical' => false,
	'rewrite' => true,
	'query_var' => 'videos',
	'menu_icon' => 'dashicons-video-alt2',
	'supports' => array('title' ,'thumbnail')
	);
register_post_type( 'video' , $args );

$args2 = array(
	'label' => __('Team Members'),
	'singular_label' => __('Team Member'),
	'public' => false,
	'show_ui' => true,
	'order' => 10,
	'capability_type' => 'page',
	'hierarchical' => false,
	'rewrite' => array(
	  'slug' => '/',
	  'with_front' => false
	),
	'query_var' => 'team-member',
	'menu_icon' => 'dashicons-video-alt2',
	'show_in_rest' => true,
	'supports' => array('title' ,'thumbnail', 'editor', 'excerpt')
	);
register_post_type( 'team-member' , $args2 );

register_taxonomy( 'video-cat', 'video',
	array(
		'labels' => array(
			'name'                       => _x( 'Video Categories', 'video-tax' , 'cinesamples' ),
			'singular_name'              => _x( 'Video Categories' , 'taxonomy singular name',  'cinesamples' ),
			'search_items'               => __( 'Search Video Categories'                   ,  'cinesamples' ),
			'popular_items'              => __( 'Popular Video Categoriess'                  ,  'cinesamples' ),
			'all_items'                  => __( 'All Types'                                ,  'cinesamples' ),
			'edit_item'                  => __( 'Edit Portfolio Type'                      ,  'cinesamples' ),
			'update_item'                => __( 'Update Video Categories'                    ,  'cinesamples' ),
			'add_new_item'               => __( 'Add New Video Category'                   ,  'cinesamples' ),
			'new_item_name'              => __( 'New Video Categories'                  , 'cinesamples' ),
			'separate_items_with_commas' => __( 'Separate Video Categories with commas'     ,  'cinesamples' ),
			'add_or_remove_items'        => __( 'Add or remove Video Categories'            , 'cinesamples' ),
			'choose_from_most_used'      => __( 'Choose from the most used Video Categories',  'cinesamples' ),
			'not_found'                  => __( 'No Video Categories found.'                ,  'cinesamples' ),
			'menu_name'                  => __( 'Video Categories'                          ,  'cinesamples' ),
			'parent_item'                => null,
			'parent_item_colon'          => null,
		),
		'exclude_from_search' => true,
		'has_archive'         => true,
		'hierarchical'        => true,
		'rewrite'             => array( 'slug' => _x( 'video-cat', 'video-cat slug' , 'cinesamples' ), 'with_front' => false ),
		'show_ui'             => true,
		'show_tagcloud'       => false,
	)
);

add_filter( 'manage_taxonomies_for_video_columns', 'genesis_video_columns' );

function genesis_video_columns( $taxonomies ) {

	$taxonomies[] = 'video-cat';
	return $taxonomies;

}

//* Register widget areas
genesis_register_sidebar( array(
    'id'              		=> 'footer-copy',
    'name'         	 	=> __( 'Footer Copyrigh', 'wpsitesdotnet' ),
    'description'  	=> __( 'Footer Copy widget area', 'wpsitesdotnet' ),
) );
genesis_register_sidebar( array(
    'id'              		=> 'header-left',
    'name'         	 	=> __( 'Header Left', 'wpsitesdotnet' ),
    'description'  	=> __( 'Header left widget area', 'wpsitesdotnet' ),
) );


remove_action( 'genesis_site_title', 'genesis_seo_site_title' );
remove_action( 'genesis_site_description', 'genesis_seo_site_description');


remove_action( 'genesis_header','genesis_do_header' );
add_action( 'genesis_header', 'custom_do_header' );
function custom_do_header() {
	global $wp_registered_sidebars;
	echo '<div class="row">';
	if (is_active_sidebar( 'header-left' ) ) {
		echo '<div class="col-4 header-left">';

		add_filter( 'wp_nav_menu_args', 'genesis_header_menu_args' );
		add_filter( 'wp_nav_menu', 'genesis_header_menu_wrap' );
		dynamic_sidebar( 'header-left' );
		remove_filter( 'wp_nav_menu_args', 'genesis_header_menu_args' );
		remove_filter( 'wp_nav_menu', 'genesis_header_menu_wrap' );
		echo '<div class="wrap-menu-mob"><div class="menu-mobile"><span></span></div><a href="#search" itemprop="url"><span itemprop="name"><i class="icon-search"></i></span></a></div></div>';
	}

	echo '<div class="title-area col-4"> <div class="logo-mob"><img src="'.get_stylesheet_directory_uri().'/images/c-logo.png" alt=""></div>';
	do_action( 'genesis_site_title' );
	do_action( 'genesis_site_description' );
	echo '</div>';

	
	genesis_widget_area( 'header-middle', array(
	'before' => '<div class="header-middle widget-area">',
	'after'  => '</div>',
	) );
        


	if ( ( isset( $wp_registered_sidebars['header-right'] ) && is_active_sidebar( 'header-right' ) ) || has_action( 'genesis_header_right' ) ) {

		echo '<div class="col-4 header-right">';

		do_action( 'genesis_header_right' );
		add_filter( 'wp_nav_menu_args', 'genesis_header_menu_args' );
		add_filter( 'wp_nav_menu', 'genesis_header_menu_wrap' );
		dynamic_sidebar( 'header-right' );
		remove_filter( 'wp_nav_menu_args', 'genesis_header_menu_args' );
		remove_filter( 'wp_nav_menu', 'genesis_header_menu_wrap' );

 		echo '</div>';

 	}
	 echo '</div>';
}

// if( function_exists('acf_add_options_page') ) {
	
// 	acf_add_options_page(array(
// 		'page_title' 	=> 'Videos',
// 		'menu_title'	=> 'Videos',
// 		'menu_slug' 	=> 'videos',
// 		'capability'	=> 'edit_posts',
// 		'position'		=> '10',
// 		'icon_url'		=> 'dashicons-video-alt2',
// 		'redirect'		=> 'false'
// 	));
	
	
// }

remove_action( 'genesis_footer', 'genesis_do_footer');


/**
 * Ajax Functions Filter
 */
add_action('wp_ajax_nopriv_cine_list_filter_ajax', 'filter_fuction');
add_action('wp_ajax_cine_list_filter_ajax', 'filter_fuction');
function filter_fuction(){
	$data_slug = $_POST['data_slug'];
	global $post;
    $args = array(
        'post_type' => 'video',
        'per_page' => 3,
        'tax_query' => array(
            array(
                'taxonomy' => 'video-cat',
                'field'    => 'slug',
                'terms'    => $data_slug,
            ),
        ),
    );
    $query = new WP_Query( $args );
    ?>
        <div class="row desktop">
	        <?php 
	        if( $query->have_posts() ): ?>
	        <?php while( $query->have_posts() ):  $query->the_post(); 
	            $thumb_img = get_the_post_thumbnail();
	        ?>
	        <div class="col-md-4 col-sm-6">
	            <div class="item-preview">
	                <picture>
	                    <?php if( $thumb_img ):
	                        echo $thumb_img;
	                    else :
	                    ?>
	                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/preview-1.jpg" alt=";">
	                    <?php endif; ?>
	                    <?php $video_url = (get_field( 'video_url',$post->ID )) ? get_field( 'video_url',$post->ID ) : ""; ?>
	                    <?php
	                    $id_popup = substr(strrchr($video_url, "="), 1);
	                    if( $video_url ) {
	                        $video_url = str_ireplace( 'www.youtube.com/watch?v=', 'www.youtube.com/embed/', $video_url );
	                        $video_url .= '?autoplay=1';
	                    }
	                    ?>
	                    <a href="#popup_<?php echo $id_popup;  ?>" class="play-btn open-video-popup"></a>
	                </picture>
	            </div>
	            <div class="modal-popup modal-video mfp-hide" id="popup_<?php echo $id_popup ?>" data-url="<?php echo $video_url; ?>">
	            <header class="block-title">
	                <?php $video_description = (get_field( 'video_description',$post->ID )) ? get_field( 'video_description',$post->ID ) : ""; ?>
	                <?php if( $video_description ): ?>           
	                <p><?php echo $video_description; ?></p>
	                <?php endif; ?>
	            </header>
	            <div class="video-wrap">
	                <iframe width="100%" height="315" frameborder="0" allowfullscreen></iframe>
	            </div>
	        </div>
	        </div>
	        <?php endwhile; ?>
	        <?php 
	        wp_reset_postdata();
	        endif; ?>
	    </div>
        <div class="row mobile">
            <?php 
            if( $query->have_posts() ): ?>
            <?php while( $query->have_posts() ):  $query->the_post(); 
                $thumb_img = get_the_post_thumbnail();
            ?>
            <div class="col-md-4 col-sm-6">
                <div class="item-preview">
                    <picture>
                        <?php if( $thumb_img ):
                            echo $thumb_img;
                        else :
                        ?>
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/preview-1.jpg" alt="">
                        <?php endif; ?>
                        <?php $video_url = (get_field( 'video_url',$post->ID )) ? get_field( 'video_url',$post->ID ) : ""; ?>
                        <?php
                        $id_popup = substr(strrchr($video_url, "="), 1);
                        if( $video_url ) {
                            $video_url = str_ireplace( 'www.youtube.com/watch?v=', 'www.youtube.com/embed/', $video_url );
                            $video_url .= '?autoplay=1';
                        }
                        ?>
                        <a href="#popup_<?php echo $id_popup;  ?>" class="play-btn open-video-popup"></a>
                    </picture>
                </div>
                <div class="modal-popup modal-video mfp-hide" id="popup_<?php echo $id_popup ?>" data-url="<?php echo $video_url; ?>">
                <header class="block-title">
                    <?php $video_description = (get_field( 'video_description',$post->ID )) ? get_field( 'video_description',$post->ID ) : ""; ?>
                    <?php if( $video_description ): ?>           
                    <p><?php echo $video_description; ?></p>
                    <?php endif; ?>
                </header>
                <div class="video-wrap">
                    <iframe width="100%" height="315" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
            </div>
            <?php endwhile; ?>
            <?php 
            wp_reset_postdata();
            endif; ?>
        </div>
        <div class="arrow-nav mobile">
            <div class="btn-slick-prev"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/arrow-back.png" alt=""></div>
            <div class="btn-slick-next"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/arrow-next.png" alt=""></div>
        </div>
   	<?php 
   	die();
}


add_shortcode('team_list', 'team_list_function');
function team_list_function(){
	$args = new WP_Query( array(
	    'post_type' => 'team-member',
	    'showposts' => -1
	  )
	);
	$out = '';
	$out .= '<div class="team-members desktop-display">';
	if ($args->have_posts()) {
		$counter = 0;
		$counter2 = 0;
		while ( $args->have_posts() ) : $args->the_post();
			$counter++;
			$counter2++;
			if ($counter == 1) {
				$out .= '<div class="separator-members">';
			}
			$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
			$thumbnail = $image[0];
			$out .= '<div class="item-member" member-id="'.get_the_ID().'">';
				$out .= '<div class="member-photo"><img src="'.$thumbnail.'" /></div>';
				$out .= '<div class="member-info">';
					$out .= '<div class="info-c">';
						$out .= '<h3>'.get_the_title().'</h3>';
						$out .= '<div class="position">'.get_field('position').'</div>';
					$out .= '</div>';
				$out .= '</div>';
			$out .= '</div>';
			if ($counter % 3 == 0 || $counter2 == $args->found_posts) {
				$out .= '</div><div class="result-content-team-member"></div>';
			}
			if ($counter==3) {
				$counter = 0;
			}
		endwhile;
		wp_reset_query();
	}
	$out .= '</div>';
	$out .= '<div class="team-members mobile-display">';
	if ($args->have_posts()) {
		$counter = 0;
		$counter2 = 0;
		while ( $args->have_posts() ) : $args->the_post();
			$counter++;
			$counter2++;
			if ($counter == 1) {
				$out .= '<div class="separator-members">';
			}
			$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
			$thumbnail = $image[0];
			$out .= '<div class="item-member item-grid" member-id="'.get_the_ID().'">';
				$out .= '<div class="member-photo"><img src="'.$thumbnail.'" /></div>';
				$out .= '<div class="member-info">';
					$out .= '<div class="info-c">';
						$out .= '<h3>'.get_the_title().'</h3>';
						$out .= '<div class="position">'.get_field('position').'</div>';
					$out .= '</div>';
				$out .= '</div>';
			$out .= '</div>';
			if ($counter % 2 == 0 || $counter2 == $args->found_posts) {
				$out .= '</div><div class="result-content-team-member"></div>';
			}
			if ($counter==2) {
				$counter = 0;
			}
		endwhile;
		wp_reset_query();
	}
	$out .= '</div>';
	return $out;
}

add_action('wp_ajax_nopriv_detail_member', 'detail_member');
add_action('wp_ajax_detail_member', 'detail_member');
function detail_member(){
	$member_id = $_POST['member_id'];
	$content_post = get_post($member_id);
	$content = $content_post->post_content;
	$content = apply_filters('the_content', $content);
	$content = str_replace(']]>', ']]&gt;', $content);
	?>
	<div class="container-content-m">
		<div class="dsc-memb">
			<div class="left-dsc">
				<?php echo '<h5>'.get_field('position', $member_id).'</h5>'; ?>
				<?php echo '<h3>'.get_the_title($member_id).'</h3>'; ?>
			</div>
			<div class="right-dsc">
				<?php echo '<div>'.get_the_excerpt($member_id).'</div>'; ?>
			</div>
		</div>
		<?php echo $content; ?>		
	</div>
	<?php
	die();
}

// Product Detail Ajax for bundle
add_action('wp_ajax_nopriv_detail_product', 'detail_product');
add_action('wp_ajax_detail_product', 'detail_product');
function detail_product(){
	$product_id = $_POST['product_id'];
	?>
	<!-- Content detail product -->
	<div class="full-content-detail-p section-sp">
		<div class="wrap">
			<div class="title-p-d">
				<h4>Library</h4>
				<h2><?php echo get_the_title($product_id); ?></h2>
			</div>
			<div class="about-prod">
				<div class="left-about-p">
					<h4>About</h4>
					<h2>The Library</h2>
				</div>
				<div class="right-about-p">
					<div class="dsc"><p><?php echo get_field('large_description', $product_id); ?></p></div>
					<div class="woo-detail">
						<div class="row">
							<div class="col-md-4">
								<h5>Price</h5>
								<?php $productc = wc_get_product($product_id); ?>
								<div><?php echo $productc->get_price_html() ?></div>
							</div>
							<div class="col-md-4">
								<h5>Version</h5>
								<p>2.0</p>
							</div>
							<div class="col-md-4">
								<h5>Compatibility</h5>
								<p>Works with the Free Kontakt Player v5.5.0 and higher.</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Content detail product -->
	<!-- Content Demo Videos -->
	<div class="large-product-videos section-sp">
		<div class="wrap">
			<h4><?php echo get_field('demo_videos_small_title', $product_id) ?></h4>
			<h2><?php echo get_field('demo_videos_title', $product_id) ?></h2>
			<p><?php echo get_field('demo_videos_description', $product_id) ?></p>
			<?php
			$videos = get_field('videos', $product_id) ? get_field('videos', $product_id) : '';
			if ($videos) {
				?>
				<div class="videos-carousel">
					<?php
					foreach ( $videos as $video ) :

						$image = wp_get_attachment_image_src( get_post_thumbnail_id( $video ), 'full' );
						?>
						<div class="c-video-p" style="background:linear-gradient(180deg, rgba(0, 0, 0, 0) 0%, #000000 100%),url(<?php echo $image[0] ?>);">
							<h4><?php echo get_the_title($video); ?></h4>
							<?php echo get_field('video_description', $video); ?>
						</div>
						<?php
					endforeach;
					?>
				</div>
				<script type="text/javascript">
					jQuery(document).ready(function(){
						jQuery('.videos-carousel').slick({
							dots: false,
							infinite: false,
							speed: 300,
							slidesToShow: 1,
							slidesToScroll: 1,
							arrows: false,
							responsive: [
							{
							  breakpoint: 1024,
							  settings: {
							    slidesToShow:1,
							    arrows: false,
							    slidesToScroll: 1,
							    infinite: false,
							    dots: false
							  }
							},
							{
							  breakpoint: 600,
							  settings: {
							  	arrows: false,
							    slidesToShow: 1,
							    slidesToScroll: 1
							  }
							},
							{
							  breakpoint: 480,
							  settings: {
							  	arrows: false,
							    slidesToShow: 1,
							    slidesToScroll: 1
							  }
							}
							]
						});
					});
				</script>
				<?php
			}
			?>
		</div>
	</div>
	<!-- End Content Demo Videos -->

	<!-- Content Demo Samples -->
	<div class="content-demo-samples section-sp">
		<div class="wrap">
			<div class="row">
				<div class="col-md-5">
					<h4><?php echo get_field('product_demo_sample_small_title', $product_id); ?></h4>
					<h2><?php echo get_field('product_demo_sample_title', $product_id); ?></h2>
					<?php echo get_field('product_demo_sample_description', $product_id); ?>
				</div>
				<div class="col-md-7">
					<?php
					$samples = get_field('samples', $product_id) ? get_field('samples', $product_id) : '';
					if ($samples) {
						$counter = 0;
						while ( have_rows('samples', $product_id) ) : the_row();
							$counter++;
							?>
							<div class="sample-item">
								<span class="number"><?php echo $counter; ?></span>
								<span class="dsc"><strong><?php echo get_sub_field('sample_title'); ?></strong><br><?php echo get_sub_field('sample_description'); ?></span>
								<a href="#" class="link-sample"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/play-button.png"></a>
							</div>
							<?php
						endwhile;
					}
					?>
				</div>
			</div>
		</div>
	</div>
	<!-- End Content Demo Samples -->
	<!-- Content Patch List -->
	<div class="single-patch-list section-sp patch-listbundled">
		<div class="wrap">
			<div class="row">
				<div class="col-md-5">
					<h2><?php echo get_field('product_patch_list_title', $product_id); ?></h2>
					<p><?php echo get_field('product_patch_list_description', $product_id); ?></p>
				</div>
				<div class="col-md-7">
					<div class="patch-list">
						<div class="pl-left">
							<?php
							$pll = get_field('patch_list_left', $product_id) ? get_field('patch_list_left', $product_id) : '';
							if ($pll) {
								while ( have_rows('patch_list_left', $product_id) ) : the_row();
									?>
									<div class="patch-item">
										<span class="number"><?php echo get_sub_field('number'); ?></span>
										<span class="dsc"><?php echo get_sub_field('pl_content'); ?></span>
									</div>
									<?php
								endwhile;
							}
							?>
						</div>
						<div class="pl-right">
							<?php
							$plr = get_field('patch_list_right', $product_id) ? get_field('patch_list_right', $product_id) : '';
							if ($plr) {
								while ( have_rows('patch_list_right', $product_id) ) : the_row();
									?>
									<div class="patch-item">
										<span class="number"><?php echo get_sub_field('number'); ?></span>
										<span class="dsc"><?php echo get_sub_field('pl_content'); ?></span>
									</div>
									<?php
								endwhile;
							}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Content Patch List -->
	<?php
	die();
}


// Videos shortcode 
add_shortcode('grid-videos-by-category', 'grid_videos_function');
function grid_videos_function(){
	$args = new WP_Query( array(
	    'post_type' => 'video',
	    'showposts' => -1
	  )
	);
	$out = '';
	$out .= '<div class="team-members desktop-display">';
	if ($args->have_posts()) {
		$counter = 0;
		$counter2 = 0;
		while ( $args->have_posts() ) : $args->the_post();
			$counter++;
			$counter2++;
			if ($counter == 1) {
				$out .= '<div class="separator-members">';
			}
			$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
			$thumbnail = $image[0];
			$out .= '<div class="item-member item-grid" video-id="'.get_the_ID().'">';
				$out .= '<div class="member-photo"><img src="'.$thumbnail.'" /></div>';
				$out .= '<div class="member-info">';
					$out .= '<div class="info-c">';
						$out .= '<h3>'.get_the_title().'</h3>';
						$out .= '<div class="position">'.get_the_date("F j, Y").'</div>';
					$out .= '</div>';
				$out .= '</div>';
			$out .= '</div>';
			if ($counter % 3 == 0 || $counter2 == $args->found_posts) {
				$out .= '</div><div class="result-content-team-member"></div>';
			}
			if ($counter==3) {
				$counter = 0;
			}
		endwhile;
		wp_reset_query();
	}
	$out .= '</div>';
	$out .= '<div class="team-members mobile-display">';
	if ($args->have_posts()) {
		$counter = 0;
		$counter2 = 0;
		while ( $args->have_posts() ) : $args->the_post();
			$counter++;
			$counter2++;
			if ($counter == 1) {
				$out .= '<div class="separator-members">';
			}
			$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
			$thumbnail = $image[0];
			$out .= '<div class="item-member" member-id="'.get_the_ID().'">';
				$out .= '<div class="member-photo"><img src="'.$thumbnail.'" /></div>';
				$out .= '<div class="member-info">';
					$out .= '<div class="info-c">';
						$out .= '<h3>'.get_the_title().'</h3>';
						$out .= '<div class="position">'.get_the_date("F j, Y").'</div>';
					$out .= '</div>';
				$out .= '</div>';
			$out .= '</div>';
			if ($counter % 2 == 0 || $counter2 == $args->found_posts) {
				$out .= '</div><div class="result-content-team-member"></div>';
			}
			if ($counter==2) {
				$counter = 0;
			}
		endwhile;
		wp_reset_query();
	}
	$out .= '</div>';
	return $out;
}

add_action('wp_ajax_nopriv_grid_video', 'grid_video');
add_action('wp_ajax_grid_video', 'grid_video');
function grid_video(){
	$video_id = $_POST['video_id'];
	$content_post = get_post($video_id);
	$content = $content_post->post_content;
	$content = apply_filters('the_content', $content);
	$content = str_replace(']]>', ']]&gt;', $content);
	$video_url = (get_field( 'video_url',$video_id )) ? get_field( 'video_url',$video_id ) : "";
	?>
	<div class="container-content-m">
		<div class="dsc-memb">
			<div class="left-dsc " data-video-url="<?php echo $video_url; ?>">
			<?php  ?>
			<?php
			$id_popup = substr(strrchr($video_url, "="), 1);
			if( $video_url ) {
				$video_url = str_ireplace( 'www.youtube.com/watch?v=', 'www.youtube.com/embed/', $video_url );
				$video_url .= '?autoplay=1';
				
			}
			?>
			</div>
			<div class="right-dsc">
				<?php echo '<h6>'.get_the_date("F j, Y", $video_id).'</h6>'; ?>
				<?php echo '<h4>'.get_the_title($video_id).'</h4>'; ?>
				<?php echo '<div>'.get_the_excerpt($video_id).'</div>'; ?>
			</div>
		</div>
		<?php echo $content; ?>		
	</div>
	<?php
	die();
}

add_filter( 'gform_pre_render_2', 'populate_posts' );
add_filter( 'gform_pre_validation_2', 'populate_posts' );
add_filter( 'gform_pre_submission_filter_2', 'populate_posts' );
add_filter( 'gform_admin_pre_render_2', 'populate_posts' );
function populate_posts( $form ) {
 
    foreach ( $form['fields'] as &$field ) {
 
        if ( $field->type != 'select' || strpos( $field->cssClass, 'populate-posts' ) === false ) {
            continue;
        }
 
        // you can add additional parameters here to alter the posts that are retrieved
        // more info: http://codex.wordpress.org/Template_Tags/get_posts
        $posts = get_posts( 'post_type=product&numberposts=-1&post_status=publish' );
 
        $choices = array();
 
        foreach ( $posts as $post ) {
            $choices[] = array( 'text' => $post->post_title, 'value' => $post->post_title );
        }
 
        // update 'Select a Post' to whatever you'd like the instructive option to be
        $field->placeholder = 'Select product...';
        $field->choices = $choices;
 
    }
 
    return $form;
}


// Adding Gutenberg to Woocommerce Products
function wplook_activate_gutenberg_products($can_edit, $post_type){
	if($post_type == 'product'){
		$can_edit = true;
	}
	return $can_edit;
}
add_filter('use_block_editor_for_post_type', 'wplook_activate_gutenberg_products', 10, 2);


add_filter( 'woocommerce_product_tabs', 'misha_remove_reviews_tab' );
function misha_remove_reviews_tab( $tabs ) {
	unset( $tabs['reviews'] );
	unset( $tabs['additional_information'] );
	unset( $tabs['description'] );
	return $tabs;
}

/* Series Custom product taxonomy */
function ess_custom_taxonomy_Item()  {

	$labels = array(
	    'name'                       => 'Series',
	    'singular_name'              => 'Serie',
	    'menu_name'                  => 'Series',
	    'all_items'                  => 'All Series',
	    'parent_item'                => 'Parent Serie',
	    'parent_item_colon'          => 'Parent Serie:',
	    'new_item_name'              => 'New Serie Name',
	    'add_new_item'               => 'Add New Serie',
	    'edit_item'                  => 'Edit Serie',
	    'update_item'                => 'Update Serie',
	    'separate_items_with_commas' => 'Separate Serie with commas',
	    'search_items'               => 'Search Series',
	    'add_or_remove_items'        => 'Add or remove Series',
	    'choose_from_most_used'      => 'Choose from the most used Series',
	);
	$args = array(
	    'labels'                     => $labels,
	    'hierarchical'               => true,
	    'public'                     => true,
	    'show_ui'                    => true,
	    'show_admin_column'          => true,
	    'show_in_nav_menus'          => true,
	    'show_tagcloud'              => true,
	);
	register_taxonomy( 'serie', 'product', $args );
}

add_action( 'init', 'ess_custom_taxonomy_item', 0 );

/* Woocommerce remove checkout additional fields */
add_filter( 'woocommerce_enable_order_notes_field', '__return_false', 9999 );
add_filter( 'woocommerce_checkout_fields' , 'remove_order_notes' );
function remove_order_notes( $fields ) {
    unset($fields['order']['order_comments']);
    return $fields;
}