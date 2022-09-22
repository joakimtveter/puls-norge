<?php
/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 */

if ( ! function_exists( 'puls_norge_setup' ) ) {
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 *
	 * @since Puls Norgee 1.0
	 *
	 * @return void
	 */
	function puls_norge_setup() {
		/**
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Twenty Twenty-One, use a find and replace
		 * to change 'twentytwentyone' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'pulsnorge', get_template_directory() . '/languages' );

		/**
		 * Let WordPress manage the document title.
		 * This theme does not use a hard-coded <title> tag in the document head,
		 * WordPress will provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/**
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 1568, 9999 );

        /**
		 * Register menu locations.
		 *
		 * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
		 */

		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary menu', 'pulsnorge' ),
				'footer'  => esc_html__( 'Footer menu', 'pulsnorge' ),
			)
		);

		/**
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
				'navigation-widgets',
			)
		);

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		$logo_width  = 300;
		$logo_height = 100;

		add_theme_support(
			'custom-logo',
			array(
				'height'               => $logo_height,
				'width'                => $logo_width,
				'flex-width'           => true,
				'flex-height'          => true,
				'unlink-homepage-logo' => true,
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

        // Remove support for default block patterns
        remove_theme_support( 'core-block-patterns' );

		$editor_stylesheet_path = './assets/css/style-editor.css';

		// Enqueue editor styles.
		add_editor_style( $editor_stylesheet_path );

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		// Remove feed icon link from legacy RSS widget.
		add_filter( 'rss_widget_feed_link', '__return_false' );
	}
}
add_action( 'after_setup_theme', 'puls_norge_setup' );

/**
 * Enqueue main scripts and styles.
 *
 * @since Puls Norge 1.0
 *
 * @return void
 */
function puls_norge_main_scripts() {
    // Enqueue main style sheet
	wp_enqueue_style(
		'puls-norge-style',
		get_template_directory_uri() . '/style.css',
		array(),
		wp_get_theme()->get( 'Version' )
	);
	wp_enqueue_style(
		'puls-norge-theme-style',
		get_template_directory_uri() . '/assets/css/theme-style.min.css',
		array(),
		wp_get_theme()->get( 'Version' )
	);
	
	// Register and enqueue main JavaScript file
	wp_enqueue_script(
		'puls-norge-main', 
		get_stylesheet_directory_uri() . '/src/js/puls-norge-main.js', 
		null , 
		wp_get_theme()->get( 'Version' ), 
		true
	);

}
add_action( 'wp_enqueue_scripts', 'puls_norge_main_scripts' );

/** 
 * Remove Wordpress version from head to improve security
 * 
 * @since Puls Norge 1.0
 */
remove_action('wp_head', 'wp_generator');

/** 
 * Add admin footer text modification
 * 
 * @since Puls Norge 1.0
 */  
function puls_norge_change_admin_footer () {
	$current_year = date('Y');
    echo '<span id="footer-thankyou">&copy;' . $current_year . ' Puls Norge - Spørsmål sendes til <a href="mailto:webmaster@pulsnorge.no">webmaster@pulsnorge.no</a></span>'; 
}

add_filter('admin_footer_text', 'puls_norge_change_admin_footer');

// Blocks
// require get_template_directory() . '/includes/blocks.php';