<?php
/**
 * Mags functions and definitions
 *
 * This file contains all the functions and it's defination that particularly can't be
 * in other files.
 *
 * @package Mags
 */

/**
 * Default Option
 */
function mags_get_option_defaults() {
	$mags_array_of_default_settings = array(
		'mags_header_sitebranding_center'					=> get_theme_mod('mags_header_sitebranding_center', 0),
		'mags_header_sitebranding_inline'					=> get_theme_mod('mags_header_sitebranding_inline', 0),
		'mags_content_layout' 								=> get_theme_mod('mags_content_layout','right'),
		'mags_header_style' 								=> get_theme_mod('mags_header_style','style2'),
		'mags_nav_uppercase'								=> get_theme_mod('mags_nav_uppercase',1),
		'mags_breadcrumbs_hide'								=> get_theme_mod('mags_breadcrumbs_hide',0),
		'mags_top_bar_hide'									=> get_theme_mod('mags_top_bar_hide',0),
		'mags_top_bar_social_profiles'						=> get_theme_mod('mags_top_bar_social_profiles',0),
		'mags_header_bg_overlay' 							=> get_theme_mod('mags_header_bg_overlay','none'),
		'mags_header_background'							=> get_theme_mod('mags_header_background',''),
		'mags_header_add_image'								=> get_theme_mod('mags_header_add_image',''),
		'mags_header_add_link'								=> get_theme_mod('mags_header_add_link',''),
		'mags_banner_display'								=> get_theme_mod('mags_banner_display', 'front-blog'),
		'mags_banner_slider_posts_hide'						=> get_theme_mod('mags_banner_slider_posts_hide', 0),
		'mags_banner_slider_latest_post'					=> get_theme_mod('mags_banner_slider_latest_post', 'latest'),
		'mags_banner_slider_post_categories' 				=> get_theme_mod('mags_banner_slider_post_categories', array()),
		'mags_footer_featured_posts_hide'					=> get_theme_mod('mags_footer_featured_posts_hide', 0),
		'mags_footer_featured_posts_title'					=> get_theme_mod('mags_footer_featured_posts_title', 'Recommended'),
		'mags_footer_featured_background'					=> get_theme_mod('mags_footer_featured_background', ''),
		'mags_footer_featured_background_style'				=> get_theme_mod('mags_footer_featured_background_style', 'scroll'),
		'mags_footer_featured_latest_post'					=> get_theme_mod('mags_footer_featured_latest_post', 'latest'),
		'mags_footer_featured_post_categories'				=> get_theme_mod('mags_footer_featured_post_categories', array()),
		'mags_featured_image_page'							=> get_theme_mod('mags_featured_image_page', 0),
		'mags_featured_image_single'						=> get_theme_mod('mags_featured_image_single', 0),
	);
	return apply_filters( 'mags_get_option_defaults', $mags_array_of_default_settings );
}

if ( !function_exists( 'mags_social_profiles' ) ) {
	/**
	 * Functions for Social Profiles.
	 */
	function mags_social_profiles() {
		$social_profiles = array(
			'mags_header_social_profile_facebook' 		=> 'facebook-f',
			'mags_header_social_profile_twitter' 		=> 'twitter',
			'mags_header_social_profile_instagram' 		=> 'instagram',
			'mags_header_social_profile_youtube' 		=> 'youtube',
		); ?>
		<ul class="clearfix">
			<?php
			$social_profiles_output = '';
			foreach ($social_profiles as $key => $value) {
				$link = get_theme_mod( $key, '' );
				if ( !empty( $link ) ) {
					$social_profiles_output .= '<li><a target="_blank" class="fab fa-' . $value . '"href="' . esc_url($link) . '"></a></li>';
				}
			}
			echo $social_profiles_output; ?>
		</ul>
	<?php }
}

if ( !function_exists( 'mags_is_social_profiles_links' ) ) {
	/**
	 * Functions for to count Social Profiles links.
	 */
	function mags_is_social_profiles_links() {
		$social_profiles = array(
			'mags_header_social_profile_facebook' 		=> 'facebook-f',
			'mags_header_social_profile_twitter' 		=> 'twitter',
			'mags_header_social_profile_instagram' 		=> 'instagram',
			'mags_header_social_profile_youtube' 		=> 'youtube',
		);
		$social_profiles_links = 0;
		foreach ($social_profiles as $key => $value) {
			$link = get_theme_mod( $key, '' );
			if ( !empty( $link ) ) {
				$social_profiles_links += 1;
			}
		}
		return $social_profiles_links;
	}
}

if ( !function_exists('mags_layout_primary') ) {
	/**
	 * Functions for Sidebars.
	 */
	function mags_layout_primary() {
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
			if ( ('right' == $mags_custom_layout) || ('nosidebar' == $mags_custom_layout) ) {
				$class = 'col-lg-8 ';
			}
			elseif ( 'left' == $mags_custom_layout ) {
				$class = 'col-lg-8 order-lg-2 ';
			}
			elseif ( 'fullwidth' == $mags_custom_layout ) {
				$class = 'col-lg-12 ';
			}
		}
		elseif ( ('meta-right' == $mags_meta_layout) || ('meta-nosidebar' == $mags_meta_layout) ) {
			$class = 'col-lg-8 ';
		}
		elseif ( 'meta-left' == $mags_meta_layout ) {
			$class = 'col-lg-8 order-lg-2 ';
		}
		elseif ( 'meta-fullwidth' == $mags_meta_layout ) {
			$class = 'col-lg-12 ';
		}

		echo '<div id="primary" class="' . $class . 'content-area">';

	}
}

if ( ! function_exists( 'mags_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function mags_posted_on() {

		$time_string = get_the_time( get_option( 'date_format' ) );

		$posted_on = '<a href="' . esc_url( get_permalink() ) . '" title="'. the_title_attribute('echo=0') . '">' . esc_html( $time_string ) . '</a> ';

		$byline = '<a href="' . esc_url( get_author_posts_url( get_the_author_meta('ID') ) ) . '">' . esc_html( get_the_author() ) . '</a> ';

		echo '<div class="date">' . $posted_on . '</div> <div class="by-author vcard author">' . $byline . '</div>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'mags_breadcrumbs' ) ) :
	/**
	 * Simple Breadcrumbs.
	 *
	 * @since 1.1.1
	 */
	function mags_breadcrumbs() {
		if ( ! function_exists( 'breadcrumb_trail' ) ) {
			require_once get_template_directory() . '/assets/library/breadcrumbs/breadcrumbs.php';
		}
		$args = array(
			'container'   => 'div',
			'show_browse' => false,
		);
		breadcrumb_trail($args);
	}

endif;


if ( ! function_exists( 'mags_register_required_plugins' ) ) :
	/**
	 * Register the required plugins for this theme.
	 *
	 */
	function mags_register_required_plugins() {

		$plugins = array(
			array(
				'name'     => esc_html__( 'One Click Demo Import', 'mags' ),
				'slug'     => 'one-click-demo-import',
				'required' => false,
			),
		);

		tgmpa( $plugins );

	}
endif;

add_action( 'tgmpa_register', 'mags_register_required_plugins' );

if ( ! function_exists( 'mags_ocdi_after_import' ) ) :
	/**
	 * function to import/export demo data
	 */
	function mags_ocdi_after_import() {

		// Set static front page and posts page
		$front_page = 'Home';
		$blog_page  = 'Blog';
		update_option( 'show_on_front', 'page' );

		$pages = array(
			'page_on_front'  => $front_page,
			'page_for_posts' => $blog_page,
		);

		foreach ( $pages as $option_key => $slug ) {
			$result = get_page_by_title( $slug );
			if ( $result ) {
				if ( is_array( $result ) ) {
					$object = array_shift( $result );
				} else {
					$object = $result;
				}

				update_option( $option_key, $object->ID );
			}
		}

		// Assign navigation menu locations.
		$menu_details = array(
			'primary'			=> 'main-menu',
			'right-section'     => 'top-right-menu',
		);

		if ( !empty($menu_details) ) {
			$nav_settings  = array();
			$current_menus = wp_get_nav_menus();

			if ( !empty( $current_menus ) && !is_wp_error( $current_menus ) ) {
				foreach ( $current_menus as $menu ) {
					foreach ( $menu_details as $location => $menu_slug ) {
						if ( $menu->slug === $menu_slug ) {
							$nav_settings[ $location ] = $menu->term_id;
						}
					}
				}
			}

			set_theme_mod( 'nav_menu_locations', $nav_settings );
		}
	}
endif;

add_action( 'pt-ocdi/after_import', 'mags_ocdi_after_import' );

// Disable PT branding.
add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );
