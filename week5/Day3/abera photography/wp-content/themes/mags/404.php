<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Mags
 */

get_header();

	mags_layout_primary(); ?>
		<main id="main" class="site-main">
			<div class="type-page">
				<div class="error-404 not-found">
					<header class="entry-header">
						<h1 class="entry-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'mags' ); ?></h1>
					</header><!-- .entry-header -->

					<div class="page-content">
						<p><?php esc_html_e( 'It looks like nothing was found at this location. May be please check the URL for typing errors or start a new search to find the page you are looking for.', 'mags' ); ?></p>

						<?php get_search_form(); ?>

					</div><!-- .page-content -->
				</div><!-- .error-404 -->
			</div><!-- .type-page -->
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
