<?php
/**
 * This file sets general options for WordPress.com
 *
 * @package Baskerville 2
 */

/**
 * Enqueue WordPress.com-specific styles
 */
function baskerville_2_wpcom_styles() {
	wp_enqueue_style( 'baskerville-2-wpcom', get_template_directory_uri() . '/inc/style-wpcom.css', '20150330' );
}
add_action( 'wp_enqueue_scripts', 'baskerville_2_wpcom_styles' );


/**
 * Adds support for wp.com-specific theme functions.
 */

function baskerville_2_wpcom_setup() {
	global $themecolors;

	// Set theme colors for third party services.
	if ( ! isset( $themecolors ) ) {
		$themecolors = array(
			'bg' => 'f1f1f1',
			'text' => '666666',
			'link' => '13C4A5',
			'border' => 'eeeeee',
			'url' => '13C4A5',
		);
	}

	// add WordPress.com global print styles
	add_theme_support( 'print-style' );
}
add_action( 'after_setup_theme', 'baskerville_2_wpcom_setup' );
?>
