<div class="col-3 clearfix">
	<div class="col">
		<h3><i class="dashicons dashicons-book-alt"></i><?php echo esc_html__('Documentation', 'mags'); ?></h3>
		<p><?php printf(
			/* translators: Theme Name */
			esc_html__('Read our full documentation for all the detailed information on how to setup and use %s theme.', 'mags'), esc_html($this->theme_name) ); ?></p>
		<a class="button button-primary" target="_blank" href="https://www.themehorse.com/theme-instruction/mags/"><?php echo esc_html__('Read Documentation', 'mags'); ?></a>
	</div>

	<div class="col">
		<h3><i class="dashicons dashicons-portfolio"></i><?php echo esc_html__('Changelog', 'mags'); ?></h3>
		<p><?php echo esc_html__('See the list on the latest version changes. Just see the changelog to get complete list of recent fixes and new features.', 'mags'); ?></p>
		<a class="button button-primary" target="_blank" href="https://www.themehorse.com/changelogs/mags-changelog/"><?php echo esc_html__('View Changelog', 'mags'); ?></a>
	</div>

	<div class="col">
		<h3><i class="dashicons dashicons-upload"></i><?php echo esc_html__('Demo Content', 'mags'); ?></h3>
		<p><?php echo esc_html__('Importing demo data is the easiest way to setup your site. Quickly edit everything instead of creating content from scratch.', 'mags'); ?></p>
		<a class="button button-primary" href="<?php echo esc_url( admin_url('themes.php?page=mags-details&section=demo_content') ); ?>"><?php echo esc_html__('Import Demo Content', 'mags'); ?></a>
	</div>

	<div class="col">
		<h3><i class="dashicons dashicons-sos"></i><?php echo esc_html__('Contact Support', 'mags'); ?></h3>
		<p><?php echo esc_html__('Still need support? Please create a support ticket in our dedicated forum and one of our support member will get back to you ASAP.', 'mags'); ?></p>
		<a class="button button-primary" target="_blank" href="https://www.themehorse.com/support-forum/"><?php echo esc_html__('Contact Support', 'mags'); ?></a>
	</div>
</div>