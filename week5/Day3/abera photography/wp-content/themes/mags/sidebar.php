<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Mags
 */

if ( ! is_active_sidebar( 'mags_right_sidebar' ) ) {
	return;
}
?>

<aside id="secondary" class="col-lg-4 widget-area" role="complementary">
	<div class="sticky-sidebar">
		<?php dynamic_sidebar( 'mags_right_sidebar' ); ?>
	</div><!-- .sticky-sidebar -->
</aside><!-- #secondary -->
