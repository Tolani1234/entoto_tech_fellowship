<h3><a href="<?php echo esc_url( admin_url('themes.php?page=mags-details&section=recommended_actions') ); ?>"><?php echo esc_html__('Setup manually', 'mags'); ?></a> <?php echo esc_html__('or Follow the below steps to Import demo content:', 'mags'); ?></h3>
<p><?php printf( esc_html__( 'Importing demo data is the easiest way to setup your site same like our demo. %s It will allow you to quickly edit everything instead of creating content from scratch.', 'mags' ),'<br>'); ?></p>
<ol>
	<li><?php echo sprintf( esc_html__( 'Install and Activate the %1$s"One Click Demo Import"%2$s plugin. If you have not.', 'mags' ), '<a target="_blank" href="' . esc_url('https://wordpress.org/plugins/one-click-demo-import/') . '">', '</a>' ); ?></li>
	<li><?php echo esc_html__('After activating it just go to "Import Demo Data" option under "Appearance".', 'mags'); ?> </li>
	<li><?php echo sprintf( esc_html__( 'Download the desired demo data from %1$shere%2$s.', 'mags' ), '<a target="_blank" href="' . esc_url('https://www.themehorse.com/theme-instruction/mags/#DemoContent') . '">', '</a>' ); ?></li>
	<li><?php echo esc_html__('Choose a XML, WIE and DAT file and click on "Import Demo Data" button than you can see your site with our demo content.', 'mags'); ?></li>
	<li><?php echo sprintf( esc_html__( 'Now go to the %1$sCustomize%2$s where all settings and theme options are available where you can easily customize different aspects of the theme.', 'mags' ), '<a href="' . esc_url(admin_url('customize.php')) . '">', '</a>' ); ?></li>
</ol>