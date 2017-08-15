<?php
/**
 * Script and Style Functions
 *
 * Handles the loading of scripts and styles for the
 * theme through the proper enqueuing methods.
 **/

if ( ! function_exists( 'orcp_enqueue_styles' ) ) :

	/**
	 * Stylesheets
	 *
	 * Registers and enqueues theme stylesheets.
	 **/
	function orcp_enqueue_styles() {

		// Register
		// wp_register_style( $handle, $src, $deps, $ver, $media );

		wp_register_style( 'layout', THEME_CSS_URI . '/layout.css', false, THEME_VERSION, 'all' );
		wp_register_style( 'flexslider', THEME_CSS_URI . '/flexslider.css', false, '2.2.0', 'all' );
		wp_register_style( 'google-font-droid-serif', '//fonts.googleapis.com/css?family=Droid+Serif:400,700', false, false, 'all' );

		// Enqueue
		wp_enqueue_style( 'layout' );
		wp_enqueue_style( 'flexslider' );
		wp_enqueue_style( 'google-font-droid-serif' );

	}

	add_action( 'wp_enqueue_scripts', 'orcp_enqueue_styles' );

endif;

if ( ! function_exists( 'orcp_enqueue_scripts' ) ) :

	/**
	 * Enqueue Scripts on public side
	 **/
	function orcp_enqueue_scripts() {

		// Register
		// wp_register_script( $handle, $src, $deps, $ver, $in_footer );
		wp_register_script( 'foundation', THEME_JS_URI . '/plugins/foundation/foundation.js', array( 'jquery' ), THEME_VERSION, true );
		wp_register_script( 'foundation-magellan', THEME_JS_URI . '/plugins/foundation/foundation.magellan.js', array( 'jquery', 'foundation' ), THEME_VERSION, true );
		wp_register_script( 'foundation-reveal', THEME_JS_URI . '/plugins/foundation/foundation.reveal.js', array( 'jquery', 'foundation' ), THEME_VERSION, true );
		wp_register_script( 'foundation-offcanvas', THEME_JS_URI . '/plugins/foundation/foundation.offcanvas.js', array( 'jquery', 'foundation' ), THEME_VERSION, true );
		wp_register_script( 'foundation-interchange', THEME_JS_URI . '/plugins/foundation/foundation.interchange.js', array( 'jquery', 'foundation' ), THEME_VERSION, true );
		wp_register_script( 'modernizr', THEME_JS_URI . '/vendor/modernizr-2.7.2.min.js', false, '2.7.2', false );
		wp_register_script( 'flexslider', THEME_JS_URI . '/plugins/jquery.flexslider-min.js', false, '2.7.2', true );
		wp_register_script( 'jquery-cookie', THEME_JS_URI . '/plugins/jquery.cookie.js', false, '1.4.1', true );
		wp_register_script( 'jquery-swipebox', THEME_JS_URI . '/plugins/jquery.swipebox.min.js', false, '1.3.0.2', true );
		wp_register_script( 'iconic', THEME_JS_URI . '/plugins/iconic.min.js', false, '0.4.2', true );
		// wp_register_script( 'slimscroll', THEME_JS_URI . '/plugins/jquery.slimscroll.min.js', array( 'jquery' ), '1.3.6', true );
		wp_register_script( 'fullpage', THEME_JS_URI . '/plugins/jquery.fullPage.min.js', array( 'jquery' ), '2.6.9', true );
		wp_register_script( 'main-scripts', THEME_JS_URI . '/main.min.js', array( 'jquery', 'foundation', 'flexslider', 'foundation-magellan', 'foundation-reveal', 'jquery-cookie', 'jquery-swipebox' ), THEME_VERSION, true );

		// Get the project objects
		$orcp_project_objs = orcp_get_project_objs();

		// Add Variables/Localization to Main Scripts
		$main_localization_array = array(
			'ajaxurl'             => admin_url( 'admin-ajax.php' ),
			'homeurl'             => home_url(),
			'activeProjectNumber' => $orcp_project_objs['active_project_no'],
			'maxProjectNumber'    => $orcp_project_objs['max_project_no'],
			'themeurl'			  => get_stylesheet_directory_uri(),
			'vatText'			  => get_field( 'checkout_vat_text', 'option' ),
			'customText'		  => get_field( 'orcp_custom_text', 'option' ),
		);

		wp_localize_script( 'main-scripts', 'orcp', $main_localization_array );

		// Enqueue
		wp_enqueue_script( 'modernizr' );
//		wp_enqueue_script( 'flexslider' );
		wp_enqueue_script( 'foundation' );
		wp_enqueue_script( 'foundation-magellan' );
		wp_enqueue_script( 'foundation-reveal' );
//		wp_enqueue_script( 'foundation-offcanvas' );
		wp_enqueue_script( 'foundation-interchange' );
		wp_enqueue_script( 'jquery-cookie' );
		wp_enqueue_script( 'jquery-swipebox' );
		wp_enqueue_script( 'iconic' );
//		wp_enqueue_script( 'slimscroll' );
		wp_enqueue_script( 'fullpage' );
		wp_enqueue_script( 'main-scripts' );

	}

	add_action('wp_enqueue_scripts', 'orcp_enqueue_scripts');

endif;

if ( ! function_exists( 'orcp_favicon' ) ) :

	/**
	 * Adds a favicon to the site
	 *
	 * Will load any favicon that is added into the
	 * theme image directory.
	 **/
	function orcp_favicon() {

		echo '<link rel="Shortcut Icon" type="image/x-icon" href="' . THEME_IMAGES_URI . '/favicon.ico">';

	}

	add_action('wp_head', 'orcp_favicon'); // Adds the favicon to frontend
	add_action('admin_head', 'orcp_favicon'); // Adds the favicon to backend

endif;