<?php
if ( ! class_exists( 'ORCP_Framework' ) ) :

	class ORCP_Framework {

		/**
		 * Initializes theme framework. Load required files and
		 * call necessary functions.
		 **/
		function __construct() {

			// Define theme constants
			$this->constants();

			// Add WordPress default add_theme_support
			add_action( 'after_setup_theme', array( $this, 'theme_support' ) );

			// Add localization support
			add_action('init', array( $this, 'language' ) );

			// Load functions
			add_action( 'init', array( $this, 'functions' ) );

			// Add custom image sizes
			add_action( 'after_setup_theme', array( $this, 'custom_image_sizes' ) );

			// Add navigation menus
			add_action( 'after_setup_theme', array( $this, 'register_navigation_menus' ) );

		}

		/**
		 * Defines constants: paths etc. for use in the theme
		 **/
		function constants() {

			// Theme Constants
			define( 'THEME_NAME', 'ORCP' ); // Name of the theme
			define( 'THEME_SLUG', 'orcp' ); // Slug of the theme
			define( 'THEME_VERSION', '1.0.2' ); // Version of the theme

			// Theme Main Directory Constants
			define( 'THEME_DIR', get_template_directory() ); // Path to theme directory
			define( 'THEME_URI', get_template_directory_uri() ); // URI to theme directory

			// Framework Constants
			define( 'THEME_FRAMEWORK', THEME_DIR . '/core' ); // Path to framework folder

			// Constants for Sub-folders in the framework folder
			define( 'THEME_DASHBOARD_WIDGETS', THEME_FRAMEWORK . '/dashboard-widgets'); // Path to custom dashboard widgets
			define( 'THEME_FUNCTIONS', THEME_FRAMEWORK . '/functions'); // Path to theme functions

			// Theme Asset Constants
			define( 'THEME_ASSETS_URI', THEME_URI . '/assets'); // URI to theme inc folder
			define( 'THEME_IMAGES_URI', THEME_ASSETS_URI . '/images'); // URI to theme images folder
			define( 'THEME_CSS_URI', THEME_ASSETS_URI . '/css'); // URI to css folder
			define( 'THEME_JS_URI', THEME_ASSETS_URI . '/js'); // URI to javascripts folder
		}

		/**
		 * Add theme support for: add_theme_support variables
		 * Also registers default sidebar
		 **/
		function theme_support() {

			if( function_exists( 'add_theme_support' ) ) {

				// Add theme support for Automatic Feed Links
				add_theme_support( 'automatic-feed-links' );

				// Add theme support for Featured Images
				add_theme_support( 'post-thumbnails' );

				// Add theme support for custom CSS in the TinyMCE visual editor
				add_editor_style( '/assets/css/editor-style.css' );

				// Add HTML5 support
				add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption'  ) );

				// Declare WooCommerce support
				add_theme_support( 'woocommerce' );

			}

			// Add Options Page
			if ( function_exists( 'acf_add_options_page' ) ) {
				acf_add_options_page();
			}

		}

		/**
		 * Set up Custom Image Sizes
		 */
		function custom_image_sizes() {}

		/**
		 * Register Navigation Menus
		 */
		function register_navigation_menus() {

			if ( ! function_exists( 'register_navigation_menus' ) ) {

				$locations = array(
					'primary-menu' => __( 'Left menu', 'orcp' ),
				);

				register_nav_menus( $locations );

			}

		}

		/**
		 * Loads core orcp functions.
		 **/
		function functions() {

			// AJAX Functions
			require_once( THEME_FUNCTIONS . '/ajax.php' );

			// Cleanup Functions
			require_once( THEME_FUNCTIONS . '/cleanup.php' );

			// Helper functions
			require_once( THEME_FUNCTIONS . '/common.php' );

			// Transient Queries
			require_once( THEME_FUNCTIONS . '/transient-queries.php' );

			// Load scripts, styles, favicon etc.
			require_once( THEME_FUNCTIONS . '/scripts-styles.php' );

			// Sidebars
			require_once( THEME_FUNCTIONS . '/sidebars.php' );

			// UI Element Functions
			require_once( THEME_FUNCTIONS . '/ui.php' );

			// WooCommerce Functions
			require_once( THEME_FUNCTIONS . '/woocommerce.php' );

			// MailChimp
			require_once( THEME_FUNCTIONS . '/newsletter.php' );

		}

		/**
		 * Makes theme available for the built-in localization
		 **/
		function language(){

			$locale = get_locale();

			load_theme_textdomain( 'orcp', THEME_DIR . '/languages' );
			$locale_file = THEME_DIR . "/languages/$locale.php";

			if ( is_readable( $locale_file ) ){
				require_once( $locale_file );
			}

		}

	}

endif;