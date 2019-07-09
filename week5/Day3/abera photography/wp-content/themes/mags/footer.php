<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Mags
 */

?>
		<?php global $mags_settings; ?>
		<?php if ( !is_page_template('templates/front-page-template.php') ) { ?>
				</div><!-- row -->
			</div><!-- .container -->
		<?php } ?>
	</div><!-- #content .site-content-->
	<footer id="colophon" class="site-footer" role="contentinfo">
		<?php if ( $mags_settings['mags_footer_featured_posts_hide'] === 0 ) {

			$footer_mags_cat = absint($mags_settings['mags_footer_featured_post_categories']);

			$footer_post_type = array(
				'posts_per_page' => 4,
				'post__not_in' => get_option('sticky_posts'),
				'post_type' => array(
					'post'
				),
			);
			if ( $mags_settings['mags_footer_featured_latest_post'] == 'category' ) {
				$footer_post_type['category__in'] = $footer_mags_cat;
			}

			$footer_mags_get_featured_post = new WP_Query($footer_post_type); ?>

			<section class="featured-stories">
				<?php if ( !empty($mags_settings['mags_footer_featured_background'])) { ?> <div class="section-background section-bg-overlay<?php echo ( $mags_settings['mags_footer_featured_background_style'] === 'fixed' ) ? ' bg-fixed' : '' ; ?>" style="background-image:url('<?php echo esc_url($mags_settings['mags_footer_featured_background']); ?>');"> <?php } ?>
				<div class="container">
					<?php if ( !empty($mags_settings['mags_footer_featured_posts_title']) ) { ?>
						<div class="section-title-wrap">
							<h2 class="stories-title"><?php echo esc_html($mags_settings['mags_footer_featured_posts_title']); ?></h2>
						</div><!-- .section-title-wrap -->
					<?php } ?>
					<div class="row justify-content-center">
						<?php while ($footer_mags_get_featured_post->have_posts()) {
							$footer_mags_get_featured_post->the_post(); ?>
							<div class="col-sm-6 col-lg-3 post-col">
								<div class="post-boxed">
									<?php if ( has_post_thumbnail() ) { ?>
										<div class="post-img-wrap">
											<a href="<?php the_permalink(); ?>" class="post-img" style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(),'full')); ?>');"></a>
											<div class="entry-meta category-meta">
												<div class="cat-links"><?php the_category(' '); ?></div>
											</div><!-- .entry-meta -->
										</div><!-- .post-img-wrap -->
									<?php } ?>
									<div class="post-content">
										<?php if ( !has_post_thumbnail() ) { ?>
											<div class="entry-meta category-meta">
												<div class="cat-links"><?php the_category(' '); ?></div>
											</div><!-- .entry-meta -->
										<?php } ?>
										<?php the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h3>' ); ?>
										<?php if ( 'post' === get_post_type() ) { ?>
											<div class="entry-meta">
												<?php mags_posted_on(); ?>
											</div>
										<?php } ?>
									</div><!-- .post-content -->
								</div><!-- .post-boxed -->
							</div><!-- .col-sm-6 .col-lg-3 .post-col -->
						<?php }
						// Reset Post Data
						wp_reset_postdata(); ?>
					</div><!-- .row -->
				</div><!-- .container -->
				<?php echo (!empty($mags_settings['mags_footer_featured_background'])) ? '</div><!-- .section-background -->' : '' ; ?>
			</section><!-- .featured-stories -->
		<?php } ?>

		<?php if ( is_active_sidebar('mags_footer_sidebar') || is_active_sidebar('mags_footer_column2') || is_active_sidebar('mags_footer_column3') ) { ?>
			<div class="widget-area">
				<div class="container">
					<div class="row">
						<div class="col-sm-6 col-lg-4">
							<?php
								// Calling the Footer Sidebar Column 1
								if ( is_active_sidebar( 'mags_footer_sidebar' ) ) :
									dynamic_sidebar( 'mags_footer_sidebar' );
								endif;
							?>
						</div><!-- footer sidebar column 1 -->
						<div class="col-sm-6 col-lg-4">
							<?php
								// Calling the Footer Sidebar Column 2
								if ( is_active_sidebar( 'mags_footer_column2' ) ) :
									dynamic_sidebar( 'mags_footer_column2' );
								endif;
							?>
						</div><!-- footer sidebar column 2 -->
						<div class="col-sm-6 col-lg-4">
							<?php
								// Calling the Footer Sidebar Column 3
								if ( is_active_sidebar( 'mags_footer_column3' ) ) :
									dynamic_sidebar( 'mags_footer_column3' );
								endif;
							?>
						</div><!-- footer sidebar column 3 -->
					</div><!-- .row -->
				</div><!-- .container -->
			</div><!-- .widget-area -->
		<?php } ?>
		<div class="site-info">
			<div class="container">
				<div class="row">
					<?php
					if ( mags_is_social_profiles_links() > 0 ) { ?>
						<div class="col-lg-auto order-lg-2 ml-auto">
							<div class="social-profiles">
								<?php esc_html( mags_social_profiles() ); ?>
							</div>
						</div>
					<?php } ?>
					<div class="copyright col-lg order-lg-1 text-lg-left">
						<div class="theme-link">
							<?php echo esc_html__('Copyright &copy; ','mags') . mags_the_year() . mags_site_link(); ?>
						</div>
						<?php if ( get_privacy_policy_url() !== '' && function_exists('the_privacy_policy_link') ) {
							the_privacy_policy_link('<div class="privacy-link">', '</div>');
						}
						echo mags_author_link() . mags_wp_link(); ?>
					</div><!-- .copyright -->
				</div><!-- .row -->
			</div><!-- .container -->
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
	<div class="back-to-top"><a title="<?php esc_attr_e('Go to Top','mags');?>" href="#masthead"></a></div>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
