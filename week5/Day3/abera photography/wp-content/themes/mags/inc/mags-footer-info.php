<?php
/**
 * Contains all current date, year and link of the theme
 *
 *
 * @package Mags
 */
?>
<?php
/**
 * To display the current year.
 *
 */
function mags_the_year() {
	return date_i18n( 'Y' );
}
/**
 * To display a link back to the site.
 *
 */
function mags_site_link() {
	return ' <a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" >' . get_bloginfo( 'name', 'display' ) . '</a>';
}
/**
 * To display a link to WordPress.org.
 *
 */
function mags_wp_link() {
	return '<div class="wp-link">' .
		sprintf(
			esc_html__('Proudly Powered by: %s', 'mags'),
			'<a href="' . esc_url('http://wordpress.org/') . '" target="_blank" title="' . esc_attr__('WordPress', 'mags') . '">' . esc_html__('WordPress', 'mags') . '</a>'
		) . '</div>';
}
/**
 * To display a link to author.
 *
 */
function mags_author_link() {
	return '<div class="author-link">' .
		sprintf(
			esc_html__('Theme by: %s', 'mags'),
			'<a href="' . esc_url('https://www.themehorse.com') . '" target="_blank" title="' . esc_attr__('Theme Horse', 'mags') . '" >' . esc_html__('Theme Horse', 'mags') . '</a>'
		) . '</div>';
}
