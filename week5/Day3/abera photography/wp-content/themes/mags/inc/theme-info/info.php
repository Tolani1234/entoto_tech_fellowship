<?php
	if ( !class_exists('Mags_Info') ) :

		class Mags_Info {

			public $tab_sections = array();
			public $theme_name = ''; // For storing Theme Name
			public $theme_version = ''; // For Storing Theme Current Version Information
			public $theme_slug = ''; // For Storing Theme slug

			/*
			 * Constructor the info Screen
			*/
			public function __construct() {
				
				/* Useful Variables */
				$theme = wp_get_theme();

				$this->theme_name = $theme->Name;
				$this->theme_version = $theme->Version;
				$this->theme_slug = $theme->get_template();

				/* Define Tabs Sections */
				$this->tab_sections = array(
					'getting_started' 		=> __('Getting Started', 'mags'),
					'recommended_actions' 	=> __('Recommended Actions', 'mags'),
					'demo_content' 			=> __('Demo Content', 'mags'),
					'support' 				=> __('Support', 'mags'),
					'free_vs_pro' 			=> __('Free Vs Pro', 'mags'),
				);

				/* Theme Activation Notice */
				add_action( 'admin_notices', array( $this, 'mags_activation_admin_notice' ) );

				/* Create a Theme Details Page */
				add_action( 'admin_menu', array( $this, 'mags_info_register_menu' ) );

				/* Enqueue Styles & Scripts for Theme Details Page */
				add_action( 'admin_enqueue_scripts', array( $this, 'mags_info_styles_and_scripts' ) );
			}

			/* Notification Message on Theme Activation */
			public function mags_activation_admin_notice() {
				global $pagenow;

				if ( is_admin() && ('themes.php' == $pagenow) && (isset($_GET['activated'])) ) { ?>
					<div class="notice notice-info is-dismissible">
						<p><?php echo sprintf( esc_html__( 'Welcome! Thank you for choosing %1$s. Please make sure you visit our %2$stheme details%3$s page to get started with %1$s theme.', 'mags' ), esc_html($this->theme_name), '<a href="' . esc_url( admin_url('/themes.php?page=mags-details') ) . '">', '</a>' ); ?></p>
						<p><a class="button button-primary" href="<?php echo esc_url(admin_url('/themes.php?page=mags-details')) ?>"><?php printf( esc_html__( 'Get started with %1$s', 'mags' ), $this->theme_name ); ?></a></p>
					</div>
					<?php
				}
			}

			/* Register Menu for Theme Details Page */
			public function mags_info_register_menu() {
				add_theme_page( esc_html__( 'About Mags', 'mags' ), esc_html__( 'About Mags', 'mags' ) , 'edit_theme_options', 'mags-details', array( $this, 'mags_info_screen' ));
			}

			/* Theme Details Page */
			public function mags_info_screen() { ?>
				<div class="wrap about-wrap theme-info-wrapper">
					<h1><?php printf(
						// WPCS: XSS OK.
						/* translators: 1-theme name, 2-theme version*/
						esc_html__( 'Welcome to %1$s - Version %2$s', 'mags' ), esc_html($this->theme_name), esc_html($this->theme_version) ); ?></h1>
					<div class="about-text">
						<?php printf( esc_html__( '%1$s is now installed and all of the features provided by the theme are now ready to use. Here, we have the following information and helpful links for you and your better experience with %1$s. Thank you very much for installing and activating our theme! Let\'s get start setting up your site now... :)', 'mags' ), esc_html($this->theme_name) ); ?>
					</div>
					<a href="<?php echo esc_url('https://www.themehorse.com/'); ?>" target="_blank" class="wp-badge themehorse-logo"></a>
					<p>
						<a href="<?php echo esc_url('https://www.themehorse.com/themes/mags/'); ?>" class="button" target="_blank"><?php echo esc_html__('Theme Details', 'mags'); ?></a>
						<a href="<?php echo esc_url('https://www.themehorse.com/demos/mags/'); ?>" class="button" target="_blank"><?php echo esc_html__('View Demo', 'mags'); ?></a>
						<a href="<?php echo esc_url('https://wordpress.org/support/theme/mags/reviews/'); ?>" class="button" target="_blank"><?php echo esc_html__('Rate This Theme', 'mags'); ?></a>
						<a href="<?php echo esc_url('https://www.themehorse.com/themes/mags-pro'); ?>" class="button upgrade-button" target="_blank"><?php echo esc_html__('Upgrade to Pro', 'mags'); ?></a>
					</p>

					<div class="nav-tab-wrapper clearfix">
						<?php $tabs = $this->tab_sections;
						foreach($tabs as $id => $label) :
							$section = isset($_GET['section']) ? $_GET['section'] : 'getting_started'; // Input var okay.
							$nav_class = 'nav-tab ';
							$nav_class .= $id;
							if ($id == $section) {
								$nav_class .= ' nav-tab-active';
							} ?>
							<a href="<?php echo esc_url(admin_url('themes.php?page=mags-details&section='.$id)); ?>" class="<?php echo esc_attr($nav_class); ?>" >
								<?php echo esc_html( $label ); ?>
							</a>
						<?php endforeach; ?>
				   	</div>

			   		<div class="section-wrapper">
		   				<?php $section = isset($_GET['section']) ? $_GET['section'] : 'getting_started'; // Input var okay. ?>
	   					<div class="<?php echo esc_attr($section); ?> clearfix">
	   						<?php require_once get_template_directory() . '/inc/theme-info/sections/'.$section.'.php'; ?>
						</div>
				   	</div>
			   	</div>
				<?php
			}

			/* Enqueue Styles for the Theme Details Page */
			public function mags_info_styles_and_scripts( $hook ) {
				if ( $hook == 'appearance_page_' . $this->theme_slug . '-details' ) {
					wp_enqueue_style( 'mags-details-screen', get_template_directory_uri() . '/inc/theme-info/css/theme-info.css' );
				}
			}

		}

		new Mags_Info();

	endif;
