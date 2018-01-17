<?php
/**
 * Medical Way functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Medical_Way
 */

if ( ! function_exists( 'medical_way_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function medical_way_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Medical Way, use a find and replace
	 * to change 'medical-way' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'medical-way' );

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
	 * Enable support for custom logo.
	 */
	add_theme_support( 'custom-logo' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size('medical-way-large', 570, 380, true);

	// Register navigation menu locations.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Navigation', 'medical-way' ),
		'top'     => esc_html__( 'Top Navigation', 'medical-way' ),
		'social'  => esc_html__( 'Social Links', 'medical-way' ),
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
	add_theme_support( 'custom-background', apply_filters( 'medical_way_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

}
endif;
add_action( 'after_setup_theme', 'medical_way_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function medical_way_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'medical_way_content_width', 810 );
}
add_action( 'after_setup_theme', 'medical_way_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function medical_way_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'medical-way' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here to appear in Sidebar.', 'medical-way' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Home Page Widget Area', 'medical-way' ),
		'id'            => 'home-page-widget-area',
		'description'   => esc_html__( 'Add widgets here to appear in Home Page Widget Area.', 'medical-way' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '</span></h2>',
	) );
	register_sidebar( array(
		'name'          => sprintf( esc_html__( 'Footer %d', 'medical-way' ), 1 ),
		'id'            => 'footer-1',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => sprintf( esc_html__( 'Footer %d', 'medical-way' ), 2 ),
		'id'            => 'footer-2',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => sprintf( esc_html__( 'Footer %d', 'medical-way' ), 3 ),
		'id'            => 'footer-3',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => sprintf( esc_html__( 'Footer %d', 'medical-way' ), 4 ),
		'id'            => 'footer-4',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'medical_way_widgets_init' );

/**
* Enqueue scripts and styles.
*/
function medical_way_scripts() {
	wp_enqueue_style( 'medical-way-fonts', medical_way_fonts_url(), array(), null );

	wp_enqueue_style( 'jquery-meanmenu', get_template_directory_uri() . '/assets/third-party/meanmenu/meanmenu.css' );

	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/third-party/font-awesome/css/font-awesome.min.css', '', '4.7.0' );

	wp_enqueue_style( 'medical-way-style', get_stylesheet_uri() );

	wp_enqueue_script( 'medical-way-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'medical-way-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20151215', true );

	wp_enqueue_script( 'jquery-cycle2', get_template_directory_uri() . '/assets/third-party/cycle2/js/jquery.cycle2.min.js', array( 'jquery' ), '2.1.6', true );

	wp_enqueue_script( 'jquery-waypoints', get_template_directory_uri() . '/assets/third-party/counter-up/jquery.waypoints.min.js', array('jquery'), '4.0.1', true );

	wp_enqueue_script( 'jquery-counterup', get_template_directory_uri() . '/assets/third-party/counter-up/jquery.counterup.min.js', array('jquery-waypoints'), '2.0.5', true );

	wp_enqueue_script( 'jquery-meanmenu', get_template_directory_uri() . '/assets/third-party/meanmenu/jquery.meanmenu.js', array('jquery'), '2.0.2', true );

	wp_enqueue_script( 'medical-way-custom', get_template_directory_uri() . '/assets/js/custom.js', array( 'jquery' ), '1.0.3', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'medical_way_scripts' );

/**
* Enqueue scripts and styles for admin >> widget page only.
*/
function medical_way_admin_scripts( $hook ) {

	if( 'widgets.php' === $hook ){

		wp_enqueue_style( 'medical-way-admin', get_template_directory_uri() . '/includes/widgets/css/admin.css', array(), '1.0.3' );

		wp_enqueue_media();

		wp_enqueue_script( 'medical-way-admin', get_template_directory_uri() . '/includes/widgets/js/admin.js', array( 'jquery' ), '1.0.3' );

	}

}

add_action( 'admin_enqueue_scripts', 'medical_way_admin_scripts' );

// Load main file.
require_once trailingslashit( get_template_directory() ) . '/includes/main.php';
