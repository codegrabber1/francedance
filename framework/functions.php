<?php
/**
 * FranceDance functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package FranceDance
 */

if ( ! function_exists( 'francedance_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function francedance_setup() {
		/**
		 * Load up our required theme files and widgets.
		 *
		 */
		require( get_template_directory() . "/framework/options/site_options.php" );
		require( get_template_directory() . "/framework/options/option_functions.php" );
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on FranceDance, use a find and replace
		 * to change 'francedance' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'francedance', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'francedance' ),
			'menu-2' => esc_html__( 'Second', 'francedance' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'francedance_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'francedance_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function francedance_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'francedance_content_width', 640 );
}
add_action( 'after_setup_theme', 'francedance_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function francedance_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'francedance' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'francedance' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'francedance_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function francedance_scripts() {

	wp_enqueue_style( 'francedance-bootstrapcss', 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap-grid.min.css' );

	wp_enqueue_style( 'francedance-animatecss', 'https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css' );

	wp_enqueue_style( 'francedance-carouselcss', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css' );

	wp_enqueue_style( 'francedance-fontawesomecss', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' );

	wp_enqueue_style( 'francedance-superfishcss', 'https://cdnjs.cloudflare.com/ajax/libs/superfish/1.7.9/css/superfish.min.css' );

	wp_enqueue_style( 'francedance-mmenucss', 'https://cdnjs.cloudflare.com/ajax/libs/jQuery.mmenu/7.0.3/jquery.mmenu.all.css' );

	wp_enqueue_style( 'francedance-lghtcss', get_template_directory_uri() .'/libs/lightgallery/css/lightgallery.css' );


	wp_enqueue_style( 'style', get_stylesheet_uri() );

	wp_enqueue_script( 'francedance-jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js', array(), '20151215', true );

	wp_enqueue_script( 'francedance-mixjs', get_template_directory_uri() .'/js/jquery.mixitup.min.js', array(), '20151215', true );

	wp_enqueue_script( 'francedance-imagesloaded', 'https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js', array(), '20151215', true );

	wp_enqueue_script( 'francedance-masonry', 'https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.min.js', array(), '20151215', true );


	wp_enqueue_script( 'francedance-carousel', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js', array(), '20151215', true );

	wp_enqueue_script( 'francedance-wowjs', 'https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js', array( 'jquery' ), '20151215', true );

	wp_enqueue_script( 'francedance-superfishjs', 'https://cdnjs.cloudflare.com/ajax/libs/superfish/1.7.9/js/superfish.min.js', array(), '20151215', true );

	wp_enqueue_script( 'francedance-mmenujs', 'https://cdnjs.cloudflare.com/ajax/libs/jQuery.mmenu/7.0.3/jquery.mmenu.all.js', array(), '20151215', true );

	wp_enqueue_script( 'francedance-lgthnjs', get_template_directory_uri() .'/libs/lightgallery/js/lg-thumbnail.min.js', array(), '20151215', true );

	wp_enqueue_script( 'francedance-lghgjs', get_template_directory_uri() .'/libs/lightgallery/js/lightgallery-all.min.js', array(), '20151215', true );



	wp_enqueue_script( 'francedance-customjs', get_template_directory_uri() . '/js/custom.js', array(), '20151215', true );




	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'francedance_scripts' );

/**
 * Main big slider on the home page.
 *
 * @uses $wp_post_types Inserts new post type object into the list
 *
 * @return void the registered post type object, or an error object
 */
function main_slider() {
	$labels = array(
		'name'               => __( 'All slides', 'francedance' ),
		'singular_name'      => __( 'Singular Name', 'francedance' ),
		'add_new'            => __( 'Add New Singular Name', 'francedance' ),
		'add_new_item'       => __( 'Add New Singular Name', 'francedance' ),
		'edit_item'          => __( 'Edit Singular Name', 'francedance' ),
		'new_item'           => __( 'New Singular Name', 'francedance' ),
		'view_item'          => __( 'View Singular Name', 'francedance' ),
		'parent_item_colon'  => __( 'Parent Singular Name:', 'francedance' ),
		'menu_name'          => __( 'Big slider', 'francedance' ),
	);

	$args = array (
		'labels'              => $labels,
		'hierarchical'        => false,
		'description'         => 'description',
		'taxonomies'          => array(),
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 10,
		'menu_icon'           => '',
		'show_in_nav_menus'   => true,
		'publicly_queryable'  => true,
		'exclude_from_search' => false,
		'has_archive'         => true,
		'query_var'           => true,
		'can_export'          => true,
		'rewrite'             => true,
		'capability_type'     => 'post',
		'supports'            => array(
			'title',
			'editor',
			'thumbnail',
			'excerpt',
			'custom-fields',
		),
	);
	register_post_type( 'mainslider', $args );
}
add_action( 'init', 'main_slider' );