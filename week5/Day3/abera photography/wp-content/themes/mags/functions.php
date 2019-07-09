<?php
/**
 * Mags functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Mags
 */

if ( ! function_exists( 'mags_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function mags_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Mags, use a find and replace
		 * to change 'mags' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'mags', get_template_directory() . '/languages' );

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
			'primary' => esc_html__( 'Primary', 'mags' ),
			'right-section' => __( 'Top Bar Navigation', 'mags' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'mags_custom_background_args', array(
			'default-color' => 'f1f1f1',
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
			'height'      => 100,
			'width'       => 260,
			'flex-width'  => true,
			'flex-height' => true,
		) );

		// Add Support for post-formats
		add_theme_support( 'post-formats', array(
			'quote', 'link'
		) );
	}
endif;
add_action( 'after_setup_theme', 'mags_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function mags_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'mags_content_width', 1110 );
}
add_action( 'after_setup_theme', 'mags_content_width', 0 );

add_action('admin_enqueue_scripts', 'mags_media_js', 10);
/**
 * Enqueue Styles.
 */
function mags_media_js( $hook ) {
	if ( $hook != 'widgets.php' )
		return;
	wp_enqueue_style('mags-custom-widgets-style', get_template_directory_uri() . '/assets/css/widgets.css');
	wp_enqueue_script('mags_media_uploader', get_template_directory_uri().'/assets/js/media-uploader-script.js', array('jquery', 'media-upload', 'thickbox'), false, true);
}

/**
 * Returns a "Continue reading" link for excerpts
 */
function mags_continue_reading($more) {
	if (!is_admin()) {
		return '&hellip; ';
	}
	return $more;
}
add_filter('excerpt_more', 'mags_continue_reading');

/**
 * Sets the post excerpt length to 17 words.
 *
 * function tied to the excerpt_length filter hook.
 *
 * @uses filter excerpt_length
 */
function mags_excerpt_length($length) {
	if (!is_admin()) {
		return 30;
	}
	return $length;
}
add_filter('excerpt_length', 'mags_excerpt_length');

/**
 * Enqueue scripts and styles.
 */
function mags_scripts() {
	$mags_settings = mags_get_option_defaults();
	wp_enqueue_style( 'bootstrap-style', get_template_directory_uri().'/assets/library/bootstrap/css/bootstrap.min.css', array(), '4.3.1');
	wp_enqueue_style('font-awesome-style', get_template_directory_uri().'/assets/library/font-awesome/css/all.min.css', array(), '5.7.2');

	wp_register_style( 'mags-google-fonts', '//fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i');
	wp_enqueue_style( 'mags-google-fonts' );

	wp_enqueue_script('popper-script', get_template_directory_uri().'/assets/library/bootstrap/js/popper.min.js', array('jquery'), '1.14.7', true);
	wp_enqueue_script('bootstrap-script', get_template_directory_uri().'/assets/library/bootstrap/js/bootstrap.min.js', array('jquery'), '4.3.1', true);

	if ( (is_front_page() || (is_home() && $mags_settings['mags_banner_display'] === 'front-blog')) && $mags_settings['mags_banner_slider_posts_hide'] === 0 ) {
		wp_enqueue_style('slick', get_template_directory_uri() . '/assets/library/slick/slick.css', array(), '1.8.0');
		wp_enqueue_script('slick', get_template_directory_uri() . '/assets/library/slick/slick.js', array('jquery'), '1.8.0', true);
		wp_enqueue_script('mags-slick', get_template_directory_uri() . '/assets/library/slick/slick-settings.js', array('slick'), false, true);
	}

	wp_enqueue_style( 'mags-style', get_stylesheet_uri() );

	wp_enqueue_script( 'html5', get_template_directory_uri() . '/assets/js/html5.js', array(), '3.7.3' );
	wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'mags-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_active_sidebar('mags_front_page_sidebar_section') || is_active_sidebar('mags_right_sidebar') || is_active_sidebar('mags_left_sidebar') ) {
		wp_enqueue_script('jquery-sticky', get_template_directory_uri() . '/assets/library/sticky/jquery.sticky.js', array('jquery'), '1.0.4', true);
		wp_enqueue_script('mags-jquery-sticky', get_template_directory_uri() . '/assets/library/sticky/jquery.sticky-settings.js', array('jquery-sticky'), false, true);
	}

	wp_enqueue_script('mags-scripts', get_template_directory_uri().'/assets/js/scripts.js', array('jquery'), false, true);
}
add_action( 'wp_enqueue_scripts', 'mags_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Widgets and Sidebar file
 */
require get_template_directory() . '/inc/mags-widgets.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/functions.php';

/**
 * Load footer info page
 */
require get_template_directory() . '/inc/mags-footer-info.php';

/**
 * Load mags metaboxes
 */
require get_template_directory() . '/inc/mags-metaboxes.php';

/**
 * Load Register the required plugins
 */
require get_template_directory() . '/inc/tgm/class-tgm-plugin-activation.php';

/**
 * Theme Details Page.
 */
require get_template_directory() . '/inc/theme-info/info.php';

