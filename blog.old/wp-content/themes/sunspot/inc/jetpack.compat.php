<?php
/**
 * Compatibility settings and functions for Jetpack from Automattic
 * See jetpack.me
 *
 * @package Sunspot
 */

/**
 * Add support for Infinite Scroll.
 */
function sunspot_infinite_scroll_init() {
	$options = get_option( 'sunspot_theme_options' );
	$post_columns = $options[ 'sunspot_radio_buttons' ];

	// if the user is showing the single column posts layout on the front page.
	if ( 'double' != $post_columns ) {
		add_theme_support( 'infinite-scroll', array(
			'container'      => 'content',
			'footer'         => 'wrapper',
		) );
	}
}
add_action( 'after_setup_theme', 'sunspot_infinite_scroll_init' );