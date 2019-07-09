<div class="col-3 clearfix">
	<div class="col">
		<h3><i class="dashicons dashicons-megaphone"></i><?php echo esc_html__('Recommended Actions', 'mags'); ?></h3>
		<p><?php echo esc_html__('Complete the list of steps so that you can set up your site same like our demo which is very easy to follow.', 'mags'); ?></p>
		<a class="button button-primary" href="<?php echo esc_url( admin_url('themes.php?page=mags-details&section=recommended_actions') ); ?>"><?php echo esc_html__('Recommended Actions', 'mags'); ?></a>
	</div>

	<div class="col">
		<h3><i class="dashicons dashicons-book-alt"></i><?php echo esc_html__('Read Full Documentation', 'mags'); ?></h3>
		<p><?php printf(
			/* translators: Theme Name */
			esc_html__('Read our full documentation for all the detailed information on how to setup and use %s theme.', 'mags'), esc_html($this->theme_name) ); ?></p>
		<a class="button button-primary" target="_blank" href="https://www.themehorse.com/theme-instruction/mags/"><?php echo esc_html__('Read Full Documentation', 'mags'); ?></a>
	</div>

	<div class="col">
		<h3><i class="dashicons dashicons-upload"></i><?php echo esc_html__('Demo Content', 'mags'); ?></h3>
		<p><?php echo esc_html__('Importing demo data is the easiest way to setup your site. Quickly edit everything instead of creating content from scratch.', 'mags'); ?></p>
		<a class="button button-primary" href="<?php echo esc_url( admin_url('themes.php?page=mags-details&section=demo_content') ); ?>"><?php echo esc_html__('Import Demo Content', 'mags'); ?></a>
	</div>

	<div class="col">
		<h3><i class="dashicons dashicons-admin-customizer"></i><?php echo esc_html__('Theme Options', 'mags'); ?></h3>
		<p><?php echo esc_html__('All settings and theme options are available via "Customizer" where you can easily customize different aspects of the theme.', 'mags'); ?></p>
		<a class="button button-primary" href="<?php echo esc_url(admin_url('customize.php')); ?>"><?php echo esc_html__('Go to Theme Options', 'mags'); ?></a>
	</div>
</div>