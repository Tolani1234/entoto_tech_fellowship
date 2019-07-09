<?php
/**
 * Mags Theme Customizer
 *
 * @package Mags
 */

if ( ! class_exists( 'WP_Customize_Section' ) ) {
	return null;
}

function mags_support_register($wp_customize){
	class Mags_Customize_Mags_Support extends WP_Customize_Control {
		public function render_content() { ?>
		<div class="theme-info">
			<a title="<?php esc_attr_e( 'Review Mags', 'mags' ); ?>" href="<?php echo esc_url( 'https://wordpress.org/support/theme/mags/reviews/' ); ?>" target="_blank">
				<?php esc_html_e( 'Rate Mags', 'mags' ); ?>
			</a>
			<a href="<?php echo esc_url( 'https://www.themehorse.com/theme-instruction/mags/' ); ?>" title="<?php esc_attr_e( 'Mags Theme Instructions', 'mags' ); ?>" target="_blank">
			<?php esc_html_e( 'Theme Instructions', 'mags' ); ?>
			</a>
			<a href="<?php echo esc_url( 'https://www.themehorse.com/support-forum/' ); ?>" title="<?php esc_attr_e( 'Support Forum', 'mags' ); ?>" target="_blank">
			<?php esc_html_e( 'Support Forum', 'mags' ); ?>
			</a>
			<a href="<?php echo esc_url( 'https://www.themehorse.com/demos/mags/' ); ?>" title="<?php esc_attr_e( 'Mags Demo', 'mags' ); ?>" target="_blank">
			<?php esc_html_e( 'View Demo', 'mags' ); ?>
			</a>
		</div>
		<?php
		}
	}

	class Mags_Customize_drop_down_Category_Control extends WP_Customize_Control {
		/**
		 * The type of customize control being rendered.
		 */
		public $type = 'select';
		/**
		 * Displays the multiple select on the customize screen.
		 */
		public function render_content() {
			$mags_categories = get_categories(); ?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<select <?php $this->link(); ?>>
					<?php foreach ($mags_categories as $category) : ?>
						<option value="<?php echo esc_attr($category->cat_ID); ?>">
							<?php echo esc_html($category->cat_name); ?>
						</option>
					<?php endforeach; ?>
				</select>
			</label>
			<?php
		}
	}
}
add_action('customize_register', 'mags_support_register');

/**
 * Upsell customizer section.
 *
 * @since  1.0.0
 * @access public
 */
class Mags_Customize_Section_Upsell extends WP_Customize_Section {

	/**
	 * The type of customize section being rendered.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $type = 'upsell';

	/**
	 * Custom button text to output.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $pro_text = '';

	/**
	 * Custom pro button URL.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $pro_url = '';

	/**
	 * Add custom parameters to pass to the JS via JSON.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function json() {
		$json = parent::json();

		$json['pro_text'] = $this->pro_text;
		$json['pro_url']  = esc_url( $this->pro_url );

		return $json;
	}

	/**
	 * Outputs the Underscore.js template.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	protected function render_template() { ?>

		<li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand">
			<h3 class="accordion-section-title">
				{{ data.title }}

				<# if ( data.pro_text && data.pro_url ) { #>
				<a href="{{ data.pro_url }}" class="upgrade-to-pro" target="_blank">{{ data.pro_text }}</a>
				<# } #>
			</h3>
		</li>
	<?php }
}

function mags_customize_custom_sections( $wp_customize ) {
	// Register custom section types.
	$wp_customize->register_section_type( 'Mags_Customize_Section_Upsell' );

	// Register sections.
	$wp_customize->add_section( new Mags_Customize_Section_Upsell( $wp_customize, 'theme_upsell', array(
		'title'					=> esc_html__( 'Mags Pro', 'mags' ),
		'pro_text'				=> esc_html__( 'Upgrade to Pro', 'mags' ),
		'pro_url'				=> 'https://www.themehorse.com/themes/mags-pro',
		'priority'				=> 1,
	) ) );
}
add_action( 'customize_register', 'mags_customize_custom_sections');

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function mags_customize_register( $wp_customize ) {
	global $mags_settings;
	$mags_settings = mags_get_option_defaults();

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'mags_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'mags_customize_partial_blogdescription',
		) );
	}

	// Section => Site Identity
	$wp_customize->add_setting( 'mags_header_sitebranding_center', array(
		'default'				=> 0,
		'sanitize_callback'		=> 'mags_sanitize_integer',
		'capability' 			=> 'edit_theme_options'
	) );
	$wp_customize->add_control( 'mags_header_sitebranding_center', array(
		'label'					=> __('Site Branding Centred ', 'mags'),
		'description'			=> __('Set the Logo above for effect.','mags'),
		'section'				=> 'title_tagline',
		'type'					=> 'checkbox',
	) );
	$wp_customize->add_setting( 'mags_header_sitebranding_inline', array(
		'default'				=> 0,
		'sanitize_callback'		=> 'mags_sanitize_integer',
		'capability' 			=> 'edit_theme_options'
	) );
	$wp_customize->add_control( 'mags_header_sitebranding_inline', array(
		'label'					=> __('Site Branding Inline ', 'mags'),
		'description'			=> __('Set the Logo above for effect.','mags'),
		'section'				=> 'title_tagline',
		'type'					=> 'checkbox',
	) );

	// Section => Layout
	$wp_customize->add_section( 'mags_content_layout_section', array(
		'title' 					=> __('Layout','mags'),
		'priority'				=> 121,
	) );
	$wp_customize->add_setting('mags_content_layout', array(
		'default'				=> 'right',
		'sanitize_callback'	=> 'mags_sanitize_choices',
		'capability' 			=> 'edit_theme_options'
	) );
	$wp_customize->add_control('mags_content_layout', array(
		'label'			=> __('Global Layout Setting','mags'),
		'description'			=> __('Below options are global setting. Set individual layout from specific page/post.','mags'),
		'section'				=> 'mags_content_layout_section',
		'type'					=> 'radio',
		'checked'				=> 'checked',
		'choices'				=> array(
			'right'					=> __('Right Sidebar','mags'),
			'left'					=> __('Left Sidebar','mags'),
			'nosidebar'				=> __('No Sidebar','mags'),
			'fullwidth'				=> __('No Sidebar Full Width','mags'),
		),
	) );

	// Section => Social Profiles
	$wp_customize->add_section('mags_social_profiles_setting', array(
		'title'					=> __('Social Profiles', 'mags'),
		'priority'				=> 131,
	) );
	$social_profiles = array(
		'mags_header_social_profile_facebook' 		=> __( 'Facebook', 'mags' ),
		'mags_header_social_profile_twitter' 		=> __( 'Twitter', 'mags' ),
		'mags_header_social_profile_instagram' 		=> __( 'Instagram', 'mags' ),
		'mags_header_social_profile_youtube' 		=> __( 'Youtube', 'mags' ),
	);

	foreach( $social_profiles as $key => $value ) {
		$wp_customize->add_setting($key, array(
			'default'				=> '',
			'sanitize_callback'		=> 'esc_url_raw',
		) );
		$wp_customize->add_control($key, array(
			'label'					=> $value,
			'section'				=> 'mags_social_profiles_setting',
			'type'					=> 'text',
		) );
	}

	// Section => Header
	$wp_customize->add_section('mags_custom_header_setting', array(
		'title'					=> __('Header', 'mags'),
		'priority'				=> 141,
	) );
	$wp_customize->add_setting('mags_top_bar_social_profiles', array(
		'default'				=> 0,
		'sanitize_callback'		=> 'mags_sanitize_integer',
	) );
	$wp_customize->add_control( 'mags_top_bar_social_profiles', array(
		'label'					=> __('Hide Social Profiles', 'mags'),
		'section'				=> 'mags_custom_header_setting',
		'type'					=> 'checkbox',
	) );
	$wp_customize->add_setting( 'mags_top_bar_hide', array(
		'default'				=> 0,
		'sanitize_callback'		=> 'mags_sanitize_integer',
		'capability' 			=> 'edit_theme_options'
	) );
	$wp_customize->add_control( 'mags_top_bar_hide', array(
		'label'					=> __('Hide Top Bar', 'mags'),
		'section'				=> 'mags_custom_header_setting',
		'type'					=> 'checkbox',
	) );
	$wp_customize->add_setting( 'mags_nav_uppercase', array(
		'default'				=> 1,
		'sanitize_callback'		=> 'mags_sanitize_integer',
	) );
	$wp_customize->add_control( 'mags_nav_uppercase', array(
		'label'					=> __('Navigation Uppercase', 'mags'),
		'section'				=> 'mags_custom_header_setting',
		'type'					=> 'checkbox'
	) );
	$wp_customize->add_setting( 'mags_breadcrumbs_hide', array(
		'default'				=> 0,
		'sanitize_callback'		=> 'mags_sanitize_integer',
	) );
	$wp_customize->add_control( 'mags_breadcrumbs_hide', array(
		'label'					=> __('Hide Breadcrumbs', 'mags'),
		'section'				=> 'mags_custom_header_setting',
		'type'					=> 'checkbox'
	) );
	$wp_customize->add_setting('mags_header_style', array(
		'default'				=> 'style2',
		'sanitize_callback'		=> 'mags_sanitize_choices',
		'capability' 			=> 'edit_theme_options'
	) );
	$wp_customize->add_control('mags_header_style', array(
		'label'					=> __('Header Style','mags'),
		'section'				=> 'mags_custom_header_setting',
		'type'					=> 'radio',
		'checked'				=> 'checked',
		'choices'				=> array(
			'style1'				=> __('Style 1','mags'),
			'style2'				=> __('Style 2','mags'),
		),
	) );
	$wp_customize->add_setting( 'mags_header_background',array(
		'sanitize_callback'		=> 'esc_url_raw',
		'capability' 			=> 'edit_theme_options'
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control ( $wp_customize, 'mags_header_background', array(
		'label'					=> __('Background Image', 'mags'),
		'section'				=> 'mags_custom_header_setting',
		'active_callback'		=> 'mags_is_header_style2',
	) ) );
	$wp_customize->add_setting('mags_header_bg_overlay', array(
		'default'				=> 'none',
		'sanitize_callback'		=> 'mags_sanitize_choices',
		'capability' 			=> 'edit_theme_options'
	) );
	$wp_customize->add_control('mags_header_bg_overlay', array(
		'label'					=> __('Background Overlay','mags'),
		'section'				=> 'mags_custom_header_setting',
		'type'					=> 'radio',
		'checked'				=> 'checked',
		'active_callback'		=> 'mags_is_header_style2',
		'choices'				=> array(
			'dark'					=> __('Dark Overlay','mags'),
			'light'					=> __('Light Overlay','mags'),
			'none'					=> __('None','mags'),
		),
	) );
	$wp_customize->add_setting( 'mags_header_add_image',array(
		'sanitize_callback'		=> 'esc_url_raw',
		'capability' 			=> 'edit_theme_options'
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control ( $wp_customize, 'mags_header_add_image', array(
		'label'					=> __('Advertisement Image', 'mags'),
		'section'				=> 'mags_custom_header_setting',
		'active_callback'		=> 'mags_is_header_style2',
	) ) );
	$wp_customize->add_setting('mags_header_add_link', array(
		'default'				=> '',
		'sanitize_callback'		=> 'esc_url_raw',
	) );
	$wp_customize->add_control('mags_header_add_link', array(
		'label'					=> __('Advertisement Image Url', 'mags'),
		'section'				=> 'mags_custom_header_setting',
		'type'					=> 'text',
		'active_callback'		=> 'mags_is_header_style2',
	) );

	// Panel => Banner
	$wp_customize->add_panel( 'mags_banner_settings', array(
		'title'					=> __('Banner', 'mags'),
		'priority'				=> 161,
	));

	// Section => Banner Settings
	$wp_customize->add_section( 'mags_banner_global_settings', array(
		'title'					=> __('Banner Settings', 'mags'),
		'panel'					=> 'mags_banner_settings',
	));
	$wp_customize->add_setting('mags_banner_display', array(
		'default'				=> 'front-blog',
		'sanitize_callback'		=> 'mags_sanitize_choices',
		'capability' 			=> 'edit_theme_options'
	) );
	$wp_customize->add_control('mags_banner_display', array(
		'label'					=> __('Display Option','mags'),
		'description'			=> __('Make sure Banner Sections are enable.','mags'),
		'section'				=> 'mags_banner_global_settings',
		'type'					=> 'radio',
		'checked'				=> 'checked',
		'choices'				=> array(
			'front-only'			=> __('Show on Homepage only','mags'),
			'front-blog'			=> __('Show on both Homepage and Posts Page','mags'),
		),
	) );

	// Section => Featured Slider
	$wp_customize->add_section( 'mags_banner_slider', array(
		'title'					=> __('Featured Slider', 'mags'),
		'panel'					=> 'mags_banner_settings',
	));
	$wp_customize->add_setting( 'mags_banner_slider_posts_hide', array(
		'default'				=> 0,
		'sanitize_callback'		=> 'mags_sanitize_integer',
		'capability' 			=> 'edit_theme_options'
	) );
	$wp_customize->add_control( 'mags_banner_slider_posts_hide', array(
		'label'					=> __('Hide Featured Slider', 'mags'),
		'section'				=> 'mags_banner_slider',
		'type'					=> 'checkbox',
	) );
	$wp_customize->add_setting( 'mags_banner_slider_latest_post', array(
		'default'				=> 'latest',
		'sanitize_callback'		=> 'mags_sanitize_choices',
		'capability' 			=> 'edit_theme_options'
	) );
	$wp_customize->add_control( 'mags_banner_slider_latest_post', array(
		'label'					=> __('Choose Post Type', 'mags'),
		'section'				=> 'mags_banner_slider',
		'active_callback'		=> 'mags_is_banner_slider_posts_set',
		'type'					=> 'radio',
		'checked'				=> 'checked',
		'choices'				=> array(
			'latest'				=> __('Show Latest Posts','mags'),
			'category'				=> __('Show Posts from Category','mags'),
		),
	) );
	$wp_customize->add_setting( 'mags_banner_slider_post_categories', array(
		'default'				=> array(),
		'sanitize_callback'		=> 'mags_sanitize_select',
		'capability' 			=> 'edit_theme_options'
	));
	$wp_customize->add_control( new Mags_Customize_drop_down_Category_Control( $wp_customize, 'mags_banner_slider_post_categories', array(
		'label'					=> __('Choose Category', 'mags'),
		'section'				=> 'mags_banner_slider',
		'active_callback'		=> 'mags_is_banner_slider_latest_post_set',
		'type'					=> 'select'
	) ) );

	// Section => Footer Featured Posts
	$wp_customize->add_section( 'mags_footer_featured_posts', array(
		'title'					=> __('Footer Featured Posts', 'mags'),
		'priority'				=> 181,
	));
	$wp_customize->add_setting( 'mags_footer_featured_posts_hide', array(
		'default'				=> 0,
		'sanitize_callback'		=> 'mags_sanitize_integer',
		'capability' 			=> 'edit_theme_options'
	) );
	$wp_customize->add_control( 'mags_footer_featured_posts_hide', array(
		'label'					=> __('Hide Footer Featured Posts', 'mags'),
		'section'				=> 'mags_footer_featured_posts',
		'type'					=> 'checkbox',
	) );
	$wp_customize->add_setting('mags_footer_featured_posts_title', array(
		'default'				=> __('Recommended', 'mags'),
		'sanitize_callback'		=> 'sanitize_text_field',
		'capability' 			=> 'edit_theme_options'
	));
	$wp_customize->add_control( 'mags_footer_featured_posts_title', array(
		'label'					=> __('Posts Title', 'mags'),
		'section'				=> 'mags_footer_featured_posts',
		'active_callback'		=> 'mags_is_footer_featured_posts_set',
		'type'					=> 'text',
	));
	$wp_customize->add_setting( 'mags_footer_featured_background',array(
		'sanitize_callback'		=> 'esc_url_raw',
		'capability' 			=> 'edit_theme_options'
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control ( $wp_customize, 'mags_footer_featured_background', array(
		'label'					=> __('Background Image', 'mags'),
		'section'				=> 'mags_footer_featured_posts',
		'active_callback'		=> 'mags_is_footer_featured_posts_set',
	) ) );
	$wp_customize->add_setting('mags_footer_featured_background_style', array(
		'default'				=> 'scroll',
		'sanitize_callback'		=> 'mags_sanitize_choices',
		'capability' 			=> 'edit_theme_options'
	) );
	$wp_customize->add_control('mags_footer_featured_background_style', array(
		'label'					=> __('Background Style','mags'),
		'section'				=> 'mags_footer_featured_posts',
		'type'					=> 'radio',
		'checked'				=> 'checked',
		'active_callback'		=> 'mags_is_footer_featured_posts_bg_image_set',
		'choices'				=> array(
			'scroll'				=> __('Scroll','mags'),
			'fixed'					=> __('Fixed','mags'),
		),
	) );
	$wp_customize->add_setting( 'mags_footer_featured_latest_post', array(
		'default'				=> 'latest',
		'sanitize_callback'		=> 'mags_sanitize_choices',
		'capability' 			=> 'edit_theme_options'
	) );
	$wp_customize->add_control( 'mags_footer_featured_latest_post', array(
		'label'					=> __('Choose Post Type', 'mags'),
		'section'				=> 'mags_footer_featured_posts',
		'active_callback'		=> 'mags_is_footer_featured_posts_set',
		'type'					=> 'radio',
		'checked'				=> 'checked',
		'choices'				=> array(
			'latest'				=> __('Show Latest Posts','mags'),
			'category'				=> __('Show Posts from Category','mags'),
		),
	) );
	$wp_customize->add_setting( 'mags_footer_featured_post_categories', array(
		'default'				=> array(),
		'sanitize_callback'		=> 'mags_sanitize_select',
		'capability' 			=> 'edit_theme_options'
	));
	$wp_customize->add_control( new Mags_Customize_drop_down_Category_Control( $wp_customize, 'mags_footer_featured_post_categories', array(
		'label'					=> __('Choose Category', 'mags'),
		'section'				=> 'mags_footer_featured_posts',
		'active_callback'		=> 'mags_is_footer_featured_latest_post_set',
		'type'					=> 'select'
	) ) );

	// Section => NewCard Settings
	$wp_customize->add_section( 'mags_main_global_settings', array(
		'title'					=> __('Mags Settings', 'mags'),
		'priority'				=> 191,
	));
	$wp_customize->add_setting( 'mags_featured_image_single', array(
		'default'				=> 0,
		'sanitize_callback'		=> 'mags_sanitize_integer',
		'capability' 			=> 'edit_theme_options'
	) );
	$wp_customize->add_control( 'mags_featured_image_single', array(
		'label'					=> __('Disable Featured Image in Posts Single', 'mags'),
		'section'				=> 'mags_main_global_settings',
		'type'					=> 'checkbox',
	) );
	$wp_customize->add_setting( 'mags_featured_image_page', array(
		'default'				=> 0,
		'sanitize_callback'		=> 'mags_sanitize_integer',
		'capability' 			=> 'edit_theme_options'
	) );
	$wp_customize->add_control( 'mags_featured_image_page', array(
		'label'					=> __('Disable Featured Image in Page', 'mags'),
		'section'				=> 'mags_main_global_settings',
		'type'					=> 'checkbox',
	) );


	// Section => Mags Support
	$wp_customize->add_section('mags_support', array(
		'title'					=> __('Mags Support', 'mags'),
		'priority'				=> 191,
	));
	$wp_customize->add_setting('mags_support', array(
		'default'				=> false,
		'capability'			=> 'edit_theme_options',
		'sanitize_callback'	=> 'wp_filter_nohtml_kses',
	));
	$wp_customize->add_control( new Mags_Customize_Mags_Support( $wp_customize, 'mags_support', array(
		'label'					=> __('Mags Support','mags'),
		'section'				=> 'mags_support'
	) ) );
}
add_action( 'customize_register', 'mags_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function mags_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function mags_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

function mags_customizer_control_scripts() {
	wp_enqueue_style( 'mags-customize-controls', get_template_directory_uri() . '/assets/css/customize-controls.css' );
	wp_enqueue_script( 'mags-customizer-control-js', get_template_directory_uri() . '/assets/js/customizer-control.js', array(), false, true );
}
add_action( 'customize_controls_enqueue_scripts', 'mags_customizer_control_scripts', 0 );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function mags_customize_preview_js() {
	wp_enqueue_script( 'mags-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'mags_customize_preview_js' );

/**
 * Sanitize the values
 */
if ( ! function_exists( 'mags_sanitize_choices' ) ) {
	/**
	 * Sanitization: select
	 *
	 * @since 1.1.1
	 *
	 * @param WP_Customize_Setting $setting Setting instance.
	 *
	 * @return mixed Sanitized value.
	 */
	function mags_sanitize_choices($input, $setting) {

		// Ensure input is a slug.
		$input = sanitize_key($input);

		// Get list of choices from the control associated with the setting.
		$choices = $setting->manager->get_control($setting->id)->choices;

		// If the input is a valid key, return it; otherwise, return the default.
		return (array_key_exists($input, $choices) ? $input : $setting->default);
	}
}

if ( ! function_exists( 'mags_sanitize_integer' ) ) {
	/**
	 * Sanitization: number_absint
	 *
	 * @since 1.1.1
	 *
	 * @param WP_Customize_Setting $setting Setting instance.
	 *
	 * @return int Sanitized number.
	 */
	function mags_sanitize_integer($input) {
		return absint($input);
	}
}

if ( ! function_exists( 'mags_sanitize_select' ) ) {
	/**
	 * Sanitization: text
	 *
	 * @since 1.1.1
	 *
	 * @param WP_Customize_Setting $setting Setting instance.
	 *
	 * @return string Sanitized content.
	 */
	function mags_sanitize_select($input) {
		if ($input !== '') {
			return $input;
		} else {
			return '';
		}
	}
}

if ( ! function_exists( 'mags_is_footer_featured_posts_set' ) ) {
	/**
	 * Check if Featured Posts is enable.
	 *
	 * @since 1.1.1
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function mags_is_footer_featured_posts_set($control) {

		if ( 0 === $control->manager->get_setting('mags_footer_featured_posts_hide')->value() ) {
			return true;
		} else {
			return false;
		}

	}
}

if ( ! function_exists( 'mags_is_footer_featured_latest_post_set' ) ) {
	/**
	 * Check if post category is enable.
	 *
	 * @since 1.1.1
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function mags_is_footer_featured_latest_post_set($control) {

		if ( 'category' === $control->manager->get_setting('mags_footer_featured_latest_post')->value() && 0 === $control->manager->get_setting('mags_footer_featured_posts_hide')->value() ) {
			return true;
		} else {
			return false;
		}

	}
}

if ( ! function_exists( 'mags_is_banner_slider_posts_set' ) ) {
	/**
	 * Check if Banner Slider Posts is enable.
	 *
	 * @since 1.1.1
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function mags_is_banner_slider_posts_set($control) {

		if ( 0 === $control->manager->get_setting('mags_banner_slider_posts_hide')->value() ) {
			return true;
		} else {
			return false;
		}

	}
}

if ( ! function_exists( 'mags_is_banner_slider_latest_post_set' ) ) {
	/**
	 * Check if banner slider category is enable.
	 *
	 * @since 1.1.1
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function mags_is_banner_slider_latest_post_set($control) {

		if ( 'category' === $control->manager->get_setting('mags_banner_slider_latest_post')->value() && 0 === $control->manager->get_setting('mags_banner_slider_posts_hide')->value() ) {
			return true;
		} else {
			return false;
		}

	}
}

if ( ! function_exists( 'mags_is_header_style2' ) ) {
	/**
	 * Check if header style is set to style 2.
	 *
	 * @since 1.1.1
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function mags_is_header_style2($control) {

		if ( 'style2' === $control->manager->get_setting('mags_header_style')->value() ) {
			return true;
		} else {
			return false;
		}

	}
}

if ( ! function_exists( 'mags_is_footer_featured_posts_bg_image_set' ) ) {
	/**
	 * Check if Featured Posts and Background Image is set.
	 *
	 * @since 1.1.1
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function mags_is_footer_featured_posts_bg_image_set($control) {

		if ( 0 === $control->manager->get_setting('mags_footer_featured_posts_hide')->value() && '' !== $control->manager->get_setting('mags_footer_featured_background')->value() ) {
			return true;
		} else {
			return false;
		}

	}
}