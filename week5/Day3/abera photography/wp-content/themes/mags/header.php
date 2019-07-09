<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Mags
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php global $mags_settings;
$mags_settings = mags_get_option_defaults(); ?>

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'mags' ); ?></a>
	<?php if (has_header_video() || has_header_image()) {
		the_custom_header_markup();
	} ?>

	<header id="masthead" class="site-header">
		<?php if ( $mags_settings['mags_top_bar_hide'] == 0 ) { ?>
			<div class="info-bar<?php echo ( has_nav_menu('right-section') ) ? ' infobar-links-on' : ''; ?>">
				<div class="container">
					<div class="row gutter-10">
						<div class="col-12 col-sm contact-section">
							<div class="date">
								<ul><li><?php echo esc_html(date_i18n("l, F j, Y")); ?></li></ul>
							</div>
						</div><!-- .contact-section -->

						<?php if ( $mags_settings['mags_top_bar_social_profiles'] === 0 && mags_is_social_profiles_links() > 0 ) { ?>
							<div class="col-sm-auto social-profiles order-lg-3">
								<button class="infobar-social-profiles-toggle"><?php esc_html_e('Responsive Menu', 'mags' ); ?></button>
								<?php esc_html( mags_social_profiles() ); ?>
							</div><!-- .social-profile -->
						<?php }

						if ( has_nav_menu('right-section') ) { ?>
							<div class="col-lg-auto infobar-links order-lg-2">
								<button class="infobar-links-menu-toggle"><?php esc_html_e('Responsive Menu', 'mags' ); ?></button>
								<?php wp_nav_menu( array(
									'theme_location'	=> 'right-section',
									'container'			=> '',
									'depth'				=> 1,
									'items_wrap'      	=> '<ul class="clearfix">%3$s</ul>',
								) ); ?>
							</div><!-- .infobar-links -->
						<?php } ?>
					</div><!-- .row -->
          		</div><!-- .container -->
        	</div><!-- .infobar -->
        <?php }

        if ($mags_settings['mags_header_style'] === 'style2') { ?>
			<div class="navbar-head<?php echo ($mags_settings['mags_header_background'] !== '') ? ' navbar-bg-set' : '' ; echo ($mags_settings['mags_header_bg_overlay'] === 'dark') ? ' header-overlay-dark' : '' ; echo ($mags_settings['mags_header_bg_overlay'] === 'light') ? ' header-overlay-light' : '' ;?>" <?php if ($mags_settings['mags_header_background'] !== '') { ?> style="background-image:url('<?php echo esc_url($mags_settings['mags_header_background']); ?>');"<?php } ?>>
				<div class="container">
					<div class="row align-items-center justify-content-lg-between">
						<div class="col-lg-5 col-xl-4 <?php echo ($mags_settings['mags_header_sitebranding_inline'] === 1) ? 'brand-inline ' : '' ; echo ($mags_settings['mags_header_sitebranding_center'] === 1) ? 'text-center ' : '' ; ?>site-branding navbar-brand">
							<?php the_custom_logo(); ?>
							<div class="site-title-wrap">
								<?php if ( is_page_template('templates/front-page-template.php') || is_home() ) :
									?>
									<h1 class="site-title"><a class="site-title-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
								<?php
								else :
									?>
									<h2 class="site-title"><a class="site-title-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h2>
								<?php
								endif;
								$mags_description = get_bloginfo( 'description', 'display' );
								if ( $mags_description || is_customize_preview() ) : ?>
									<p class="site-description"><?php echo $mags_description; /* WPCS: xss ok. */ ?></p>
								<?php endif; ?>
							</div><!-- .site-title-wrap -->
						</div><!-- .site-branding .navbar-brand -->
						<?php if ( $mags_settings['mags_header_add_image'] !== '' ) { ?>
							<div class="col-lg-7 col-xl-8 navbar-ad-section">
								<?php if ( $mags_settings['mags_header_add_link'] !== '' ) { ?>
									<a href="<?php echo esc_url( $mags_settings['mags_header_add_link'] ); ?>" class="mags-ad-728-90" target="_blank">
								<?php } ?>
								<img class="img-fluid" src="<?php echo esc_url( $mags_settings['mags_header_add_image'] ); ?>" alt="<?php esc_attr_e('Banner Add', 'mags'); ?>">
								<?php if ( $mags_settings['mags_header_add_link'] !== '' ) { ?>
									</a>
								<?php } ?>
							</div><!-- .navbar-ad-section -->
						<?php } ?>
					</div><!-- .row -->
				</div><!-- .container -->
			</div><!-- .navbar-head -->
        <?php } ?>
		<nav class="navbar navbar-expand-lg">
			<div class="container navbar-header-container">
				<?php if ($mags_settings['mags_header_style'] === 'style1') { ?>
					<div class="row justify-content-between align-items-center navbar-inline-row">
						<div class="navbar-brand-wrap">
							<div class="site-branding navbar-brand<?php echo ($mags_settings['mags_header_sitebranding_inline'] === 1) ? ' brand-inline' : '' ; echo ($mags_settings['mags_header_sitebranding_center'] === 1) ? ' text-center' : '' ; ?>">
								<?php the_custom_logo(); ?>
								<div class="site-title-wrap">
									<?php if ( is_page_template('templates/front-page-template.php') || is_home() ) : ?>
										<h1 class="site-title"><a class="site-title-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
									<?php else : ?>
										<h2 class="site-title"><a class="site-title-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h2>
									<?php endif;
									$mags_description = get_bloginfo( 'description', 'display' );
									if ( $mags_description || is_customize_preview() ) : ?>
										<p class="site-description"><?php echo $mags_description; /* WPCS: xss ok. */ ?></p>
									<?php endif; ?>
								</div><!-- .site-title-wrap -->
							</div><!-- .site-branding .navbar-brand -->
				<?php } ?>

				<div class="navigation-icons-wrap justify-content-between d-lg-none">
					<button class="navbar-toggler menu-toggle" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="<?php esc_attr_e('Toggle navigation', 'mags'); ?>"></button>
					<span class="search-toggle"></span>
				</div><!-- .navigation-icons-wrap -->

				<?php if ($mags_settings['mags_header_style'] === 'style1') { ?>
					</div><!-- .navbar-brand-wrap -->
				<?php } ?>

				<div class="navbar-main">
					<span class="search-toggle"></span>
					<div class="search-block off">
						<div class="container">
							<?php get_search_form(); ?>
						</div><!-- .container -->
					</div><!-- .search-box -->
					<div class="collapse navbar-collapse" id="navbarCollapse">
						<div id="site-navigation" class="main-navigation<?php echo ($mags_settings['mags_nav_uppercase'] == 1) ? " nav-uppercase" : "";?>" role="navigation">
							<?php
							if ( has_nav_menu('primary') ) {
								wp_nav_menu( array(
									'theme_location'	=> 'primary',
									'container'			=> '',
									'items_wrap'		=> '<ul class="nav-menu navbar-nav">%3$s</ul>',
								) );
							} else {
								wp_page_menu( array(
									'before' 			=> '<ul class="nav-menu navbar-nav">',
									'after'				=> '</ul>',
								) );
							}
							?>
						</div><!-- #site-navigation .main-navigation -->
					</div><!-- .navbar-collapse -->
				</div><!-- .navbar-main -->
				<?php if ($mags_settings['mags_header_style'] === 'style1') { ?>
					</div><!-- .row -->
				<?php } ?>
			</div><!-- .navbar-header-container -->
		</nav><!-- .navbar -->

		<?php if ( ( is_front_page() || ( is_home() && $mags_settings['mags_banner_display'] === 'front-blog' ) ) && $mags_settings['mags_banner_slider_posts_hide'] === 0 ) {

			$mags_bs_cat = absint($mags_settings['mags_banner_slider_post_categories']);

			$post_type_bs = array(
				'posts_per_page' => 5,
				'post__not_in' => get_option('sticky_posts'),
				'post_type' => array(
					'post'
				),
			);
			if ( $mags_settings['mags_banner_slider_latest_post'] == 'category' ) {
				$post_type_bs['category__in'] = $mags_bs_cat;
			}

			$mags_get_banner_slider = new WP_Query($post_type_bs); ?>

			<div class="featured-slider post-slider featured-slider-style-1">
				<div class="slick-slider">
					<?php while ($mags_get_banner_slider->have_posts()) {
						$mags_get_banner_slider->the_post(); ?>
						<div class="item">
							<div class="post-item post-block">
								<div class="post-img-wrap">
									<a href="<?php the_permalink(); ?>" class="post-img" <?php if ( has_post_thumbnail() ) { ?> style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(),'full')); ?>');" <?php } ?>></a>
								</div>
								<div class="container entry-header">
									<div class="entry-meta category-meta">
										<div class="cat-links"><?php the_category(' '); ?></div>
									</div><!-- .entry-meta -->
									<?php if ( !(has_post_format('link') || has_post_format('quote')) ) {
										the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' );
										the_excerpt();
									} else {
										the_content();
									} ?>
								</div><!-- .entry-header -->
							</div><!-- .post-item .post-block -->
						</div>
					<?php }
					// Reset Post Data
					wp_reset_postdata(); ?>
				</div><!-- .slick-slider -->
			</div><!-- .featured-slider .post-slider -->

		<?php } ?>

		<?php if ( !is_front_page() && !is_home() && !is_page_template('templates/front-page-template.php') && function_exists('mags_breadcrumbs') && $mags_settings['mags_breadcrumbs_hide'] === 0 ) { ?>
			<div id="breadcrumb">
				<div class="container">
					<?php mags_breadcrumbs(); ?>
				</div>
			</div><!-- .breadcrumb -->
		<?php } ?>
	</header><!-- #masthead -->
	<div id="content" class="site-content">
		<?php if ( !is_page_template('templates/front-page-template.php') ) { ?>
			<div class="container">
				<div class="row justify-content-center">
		<?php } ?>
