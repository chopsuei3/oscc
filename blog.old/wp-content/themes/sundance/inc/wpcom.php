<?php
/**
 * WordPress.com-specific functions and definitions
 *
 * @package Sundance
 * @since Sundance 1.0
 */

global $themecolors;
/**
 * Set a default theme color array for WP.com.
 *
 * @global array $themecolors
 * @since Sundance 1.0
 */
$themecolors = array(
	'bg' => 'eeebf2',
	'border' => 'b3b3b3',
	'text' => '3c3d47',
	'link' => '267172',
	'url' => '267172',
);

// Dequeue the font script if the blog has WP.com Custom Design.
function sundance_dequeue_fonts() {
	if ( class_exists( 'TypekitData' ) ) {
		if ( TypekitData::get( 'upgraded' ) ) {
			$customfonts = TypekitData::get( 'families' );

			if ( ! $customfonts )
				return;

			$site_title = $customfonts['site-title'];
			$headings = $customfonts['headings'];

			if ( $site_title['id'] && $headings['id'] ) {
				wp_dequeue_style( 'sundance-droid-serif' );
			}
		}
	}
}
add_action( 'wp_enqueue_scripts', 'sundance_dequeue_fonts' );