<?php
/**
 * Compatibility settings and functions for Jetpack from Automattic
 * See http://jetpack.me/support/infinite-scroll/
 *
 * @package Sundance
 */

/**
 * Add support for Infinite Scroll.
 */
function sundance_infinite_scroll_init() {
	add_theme_support( 'infinite-scroll', array(
		'container'      => 'content',
		'footer'         => 'primary',
	) );
}
add_action( 'after_setup_theme', 'sundance_infinite_scroll_init' );