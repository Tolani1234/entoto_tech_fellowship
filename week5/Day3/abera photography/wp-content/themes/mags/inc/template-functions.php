<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Mags
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function mags_body_classes( $classes ) {
	$mags_settings = mags_get_option_defaults();

	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	if ( has_header_video() && has_header_image() ) {
		if ( is_front_page() && is_home() ) {
			$classes[] = '';
		} elseif ( is_front_page() ) {
			$classes[] = '';
		} else {
			$classes[] = 'header-image';
		}
	} elseif ( has_header_image() ) {
		$classes[] = 'header-image';
	}

	return $classes;
}
add_filter( 'body_class', 'mags_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function mags_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'mags_pingback_header' );

function mags_sidebar_content() {

	$mags_settings = mags_get_option_defaults();

	global $post;
	if ($post) {
		$mags_meta_layout = get_post_meta($post->ID, 'mags_sidebarlayout', true);
	}
	$mags_custom_layout = $mags_settings['mags_content_layout'];

	if ( empty($mags_meta_layout) || is_archive() || is_search() || is_home() ) {
		$mags_meta_layout = 'default';
	}
	
		if ( 'default' == $mags_meta_layout ) {
			if ( 'right' == $mags_custom_layout ) {
				get_sidebar(); //used sidebar.php
			}
			elseif ( 'left' == $mags_custom_layout ) {
				get_sidebar('left'); //used sidebar-left.php
			}
			else {
				return; // doesnot display sidebar
			}
		}
		elseif ( 'meta-right' == $mags_meta_layout ) {
			get_sidebar(); //used sidebar.php
		}
		elseif ( 'meta-left' == $mags_meta_layout ) {
			get_sidebar('left'); //used sidebar-left.php
		}
		else {
			return; // doesnot display sidebar
		}
}
add_action( 'mags_sidebar', 'mags_sidebar_content');
