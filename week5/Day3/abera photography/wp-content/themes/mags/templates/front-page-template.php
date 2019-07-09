<?php
/**
 * Template Name: Front Page Template
 *
 * Displays the Front Page Layout of the theme.
 *
 * @package Theme Horse
 * @subpackage Mags
 * @since Mags 1.1
 */
get_header();

	if ( is_active_sidebar('mags_front_page_content_section') ) : ?>

		<main id="main" class="site-main" role="main">
			<?php dynamic_sidebar( 'mags_front_page_content_section' ); ?>
		</main><!-- #main .site-main -->

	<?php endif;

get_footer();







