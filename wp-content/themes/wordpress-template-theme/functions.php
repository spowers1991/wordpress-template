<?php
/**
 * wordpress-template-theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package wordpress-template-theme
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function wordpress_template_theme_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on wordpress-template-theme, use a find and replace
		* to change 'wordpress-template-theme' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'wordpress-template-theme', get_template_directory() . '/languages' );

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
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'wordpress-template-theme' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'wordpress_template_theme_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'wordpress_template_theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function wordpress_template_theme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'wordpress_template_theme_content_width', 640 );
}
add_action( 'after_setup_theme', 'wordpress_template_theme_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function wordpress_template_theme_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'wordpress-template-theme' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'wordpress-template-theme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'wordpress_template_theme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function theme_enqueue_scripts() {
    wp_enqueue_style('theme-style', get_template_directory_uri() . '/dist/style.css');
    wp_enqueue_script('theme-js', get_template_directory_uri() . '/dist/app.js', array('jquery'), null, true);

	 // Localize script to provide the AJAX URL
	 wp_localize_script('ajax-filter', 'ajax_object', array(
		 'ajax_url' => admin_url('admin-ajax.php')
	 ));
}
add_action('wp_enqueue_scripts', 'theme_enqueue_scripts');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

add_action('wp_enqueue_scripts', 'remove_woocommerce_styles', 99);
function remove_woocommerce_styles() {
    if (class_exists('WooCommerce')) {
        // Remove default WooCommerce styles
        wp_dequeue_style('woocommerce-general'); // WooCommerce base styles
        wp_dequeue_style('woocommerce-layout'); // WooCommerce layout styles
        wp_dequeue_style('woocommerce-smallscreen'); // WooCommerce small screen styles
    }
}


// ACF 
require_once get_template_directory() . '/lib\acf\helpers\get_custom_field.php';

/*
function replace_all_uploads_urls($content) {
    // Set the external image directory URL
    $external_image_url = 'https://external-source.com/images/'; // Change this to your external URL

    // Get the uploads base URL
    $uploads_base_url = wp_upload_dir()['baseurl'];

    // Replace the uploads URL with the external URL
    $content = str_replace($uploads_base_url, $external_image_url, $content);

    return $content;
}

// Hook into the content filters
add_filter('the_content', 'replace_all_uploads_urls');
add_filter('wp_get_attachment_url', 'replace_all_uploads_urls');
*/