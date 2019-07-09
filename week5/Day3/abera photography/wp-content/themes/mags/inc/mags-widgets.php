<?php
 /**
 * Register widget area and Sidebar.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 *
 * @package Mags
 */
/****************************************************************************************/

/**
 * Function to register the widget areas(sidebar) and widgets.
 */
function mags_widgets_init() {

	// Registering Right Sidebar
	register_sidebar( array(
		'name' 				=> __('Right Sidebar', 'mags') ,
		'id' 				=> 'mags_right_sidebar',
		'description' 		=> __('Shows widgets at Right Side.', 'mags'),
		'before_widget' 	=> '<section id="%1$s" class="widget %2$s">',
		'after_widget' 		=> '</section>',
		'before_title' 		=> '<h3 class="widget-title">',
		'after_title' 		=> '</h3>',
	)	);

	// Registering Left Sidebar
	register_sidebar( array(
		'name' 				=> __('Left Sidebar', 'mags') ,
		'id' 				=> 'mags_left_sidebar',
		'description' 		=> __('Shows widgets at Left Side.', 'mags'),
		'before_widget' 	=> '<section id="%1$s" class="widget %2$s">',
		'after_widget' 		=> '</section>',
		'before_title' 		=> '<h3 class="widget-title">',
		'after_title' 		=> '</h3>',
	) );

	// Registering Front Page Template Content Section
	register_sidebar(array(
		'name' 				=> __('Front Page Section', 'mags') ,
		'id' 				=> 'mags_front_page_content_section',
		'description' 		=> __('Shows widgets on Front Page Template Section. Suitable widget: TH: Horizontal/Vertical Posts, TH: Card/Block Posts, TH: Multiple Layout Posts and TH: Recent Posts', 'mags'),
		'before_widget' 	=> '<section id="%1$s" class="widget %2$s">',
		'after_widget' 		=> '</section>',
		'before_title' 		=> '<h2 class="widget-title">',
		'after_title' 		=> '</h2>',
	));

	// Registering Footer Sidebar 1
	register_sidebar( array(
		'name' 				=> __('Footer - Column 1', 'mags') ,
		'id' 				=> 'mags_footer_sidebar',
		'description' 		=> __('Shows widgets at Footer Column 1.', 'mags'),
		'before_widget' 	=> '<section id="%1$s" class="widget %2$s">',
		'after_widget' 		=> '</section>',
		'before_title' 		=> '<h3 class="widget-title">',
		'after_title' 		=> '</h3>',
	) );

	// Registering Footer Sidebar 2
	register_sidebar( array(
		'name' 				=> __('Footer - Column 2', 'mags'),
		'id' 				=> 'mags_footer_column2',
		'description' 		=> __('Shows widgets at Footer Column 2.', 'mags'),
		'before_widget' 	=> '<section id="%1$s" class="widget %2$s">',
		'after_widget' 		=> '</section>',
		'before_title' 		=> '<h3 class="widget-title">',
		'after_title' 		=> '</h3>',
	) );

	// Registering Footer Sidebar 3
	register_sidebar( array(
		'name' 				=> __('Footer - Column 3', 'mags'),
		'id' 				=> 'mags_footer_column3',
		'description' 		=> __('Shows widgets at Footer Column 3.', 'mags'),
		'before_widget' 	=> '<section id="%1$s" class="widget %2$s">',
		'after_widget' 		=> '</section>',
		'before_title' 		=> '<h3 class="widget-title">',
		'after_title' 		=> '</h3>',
	) );

	register_widget("mags_horizontal_vertical_posts");
	register_widget("mags_card_block_posts");
	register_widget("mags_recent_posts");
	register_widget("mags_multiple_layout_posts");
}
add_action('widgets_init', 'mags_widgets_init');

/****************************************************************************************/
/**
 * Widget for Front Page Template.
 * Construct the widget.
 * i.e. Posts.
 */
class mags_horizontal_vertical_posts extends WP_Widget {

	function __construct() {
		$widget_ops = array(
			'classname' => 'mags-widget-horizontal-vertical-posts',
			'description' => __('Display Horizontal/Vertical Posts', 'mags')
		);
		parent::__construct(false, $name = __('TH: Horizontal/Vertical Posts', 'mags') , $widget_ops);
	}

	function form($instance) {

		$instance = wp_parse_args(
			(array) $instance,
			array(
				'title' => '',
				'category' => '',
				'type' => 1,
				'style' => 0,
				'bg_image' => '',
				'bg_fixed_parllax' => 1,
				'spacing' => 0,
			)
		);
		$title = isset( $instance['title'] ) ? $instance['title'] : '';
		$type = ( isset($instance['type']) && is_numeric($instance['type']) ) ? (int) $instance['type'] : 1;
		$bg_fixed_parllax = ( isset($instance['bg_fixed_parllax']) && is_numeric($instance['bg_fixed_parllax']) ) ? (int) $instance['bg_fixed_parllax'] : 1; ?>
		<p>
			<em><?php esc_html_e('Set featured image on the related post if you need to display image.', 'mags'); ?></em>
		</p>
		<p>
			<input id="<?php echo $this->get_field_id('style'); ?>" name="<?php echo $this->get_field_name('style'); ?>" type="checkbox" value="1" <?php checked( '1', absint($instance['style']) ); ?>/>
			<label for="<?php echo $this->get_field_id('style'); ?>">
				<?php esc_html_e('Horizontal Style','mags'); ?>
			</label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">
				<strong><?php esc_html_e('Title', 'mags'); ?></strong>
			</label>
			<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>"/>
		</p>
		<p class="mags-widget-display-control">
			<label for="<?php echo $this->get_field_id('spacing'); ?>">
				<strong><?php esc_html_e('Spacing', 'mags'); ?></strong>
			</label><br>
			<input id="<?php echo $this->get_field_id('spacing'); ?>" name="<?php echo $this->get_field_name('spacing'); ?>" min="0" max="50" step="5" type="range" value="<?php echo absint($instance['spacing']); ?>">
		</p>
		<p>
			<label><strong><?php esc_html_e('Choose Post Type', 'mags'); ?></strong></label><br>
			<input type="radio" id="<?php echo ($this->get_field_id('type') . '-1'); ?>" name="<?php echo ($this->get_field_name('type')); ?>" value="1" <?php checked($type == 1, true); ?>>
			<label for="<?php echo ($this->get_field_id('type') . '-1'); ?>" class="input-label"><?php esc_html_e('Latest Posts', 'mags'); ?></label>
			<br>
			<input type="radio" id="<?php echo ($this->get_field_id( 'type') . '-2'); ?>" name="<?php echo ($this->get_field_name('type')); ?>" value="2" <?php checked($type == 2, true); ?>>
			<label for="<?php echo ($this->get_field_id('type') . '-2'); ?>" class="input-label"><?php esc_html_e('Show Posts from Category', 'mags'); ?></label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('category'); ?>">
				<strong><?php esc_html_e('Choose Category', 'mags'); ?></strong>
			</label>
			<?php wp_dropdown_categories(
				array(
					'show_option_none' => ' ',
					'name' => $this->get_field_name('category') ,
					'selected' => $instance['category']
				)
			); ?>
		</p>
		<div class="custom-image-uploader mags-widget-display-control">
			<label for="<?php echo $this->get_field_id('bg_image'); ?>">
				<strong><?php esc_html_e('Background Image', 'mags'); ?></strong>
			</label>
			<div class="custom_media_preview">
				<?php if ( $instance['bg_image'] !== '' ) { ?>
					<img src="<?php echo esc_url( $instance['bg_image'] ); ?>" style="max-width: 100%;" />
				<?php } ?>
			</div>
			<input type="text" class="custom_media_input" id="<?php echo $this->get_field_id('bg_image'); ?>" name="<?php echo $this->get_field_name('bg_image'); ?>" value="<?php echo esc_url($instance['bg_image']); ?>"/>
			<input type="button" class="button custom_image_upload" data-title="<?php esc_attr_e( 'Select an Image', 'mags' ); ?>" data-update-btn="<?php esc_attr_e( 'Select', 'mags' ); ?>" name="<?php echo $this->get_field_name('bg_image'); ?>" value="<?php esc_attr_e('Upload Image', 'mags');?>"/>
		</div>
		<p class="mags-widget-display-control">
			<label><strong><?php esc_html_e('Background Image Style', 'mags'); ?></strong></label><br>
			<input type="radio" id="<?php echo ($this->get_field_id('bg_fixed_parllax') . '-1'); ?>" name="<?php echo ($this->get_field_name('bg_fixed_parllax')); ?>" value="1" <?php checked($bg_fixed_parllax == 1, true); ?>>
			<label for="<?php echo ($this->get_field_id('bg_fixed_parllax') . '-1'); ?>" class="input-label"><?php esc_html_e('Scroll', 'mags'); ?></label>
			<br>
			<input type="radio" id="<?php echo ($this->get_field_id('bg_fixed_parllax') . '-2'); ?>" name="<?php echo ($this->get_field_name('bg_fixed_parllax')); ?>" value="2" <?php checked($bg_fixed_parllax == 2, true); ?>>
			<label for="<?php echo ($this->get_field_id('bg_fixed_parllax') . '-2'); ?>" class="input-label"><?php esc_html_e('Fixed', 'mags'); ?></label>
		</p>
		<?php
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['category'] = absint($new_instance['category']);
		$instance['style'] = absint($new_instance['style']);
		$instance['title'] = sanitize_text_field($new_instance['title']);
		$instance['type'] = ( isset($new_instance['type']) && $new_instance['type'] > 0 && $new_instance['type'] < 3 ) ? (int) $new_instance['type'] : 1;
		$instance['bg_image'] = esc_url_raw($new_instance['bg_image']);
		$instance['bg_fixed_parllax'] = ( isset($new_instance['bg_fixed_parllax']) && $new_instance['bg_fixed_parllax'] > 0 && $new_instance['bg_fixed_parllax'] < 3 ) ? (int) $new_instance['bg_fixed_parllax'] : 1;
		$instance['spacing'] = ( isset($new_instance['spacing']) && $new_instance['spacing'] > 0 && $new_instance['spacing'] <= 50 ) ? (int) $new_instance['spacing'] : 0;
		return $instance;
	}

	function widget($args, $instance) {
		$category = isset($instance['category']) ? $instance['category'] : '';
		$style = empty($instance['style']) ? '' : $instance['style'];
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$type = ( isset($instance['type']) && is_numeric($instance['type']) ) ? (int) $instance['type'] : 1;
		$bg_image = isset($instance['bg_image']) ? $instance['bg_image'] : '';
		$bg_fixed_parllax = ( isset($instance['bg_fixed_parllax']) && is_numeric($instance['bg_fixed_parllax']) ) ? (int) $instance['bg_fixed_parllax'] : 1;
		$spacing = empty($instance['spacing']) ? 0 : $instance['spacing'];
		global $post;

		$post_type = array(
			'posts_per_page' => 5,
			'post_type' => array('post'),
			'post__not_in' => get_option('sticky_posts'),
		);
		if ( $type == 2 ) {
			$post_type['category__in'] = $category;
		}

		$get_featured_posts = new WP_Query($post_type);

		echo $args['before_widget'];
		if (!empty($bg_image)) { ?> <div class="section-background section-bg-overlay<?php echo ($bg_fixed_parllax === 2) ? ' bg-fixed' : '' ; ?>" style="background-image:url('<?php echo esc_url($bg_image); ?>');"> <?php } ?>
			<div class="container">
				<?php if ( !empty($title) ) { ?>
					<div class="section-title-wrap">
						<?php echo $args['before_title'] . $title . $args['after_title']; ?>
					</div><!-- .section-title-wrap -->
				<?php }
				if ( !empty($spacing) ) { ?> <div class="widget-cnt-spacing" style="padding-top: <?php echo absint($spacing); ?>%;"></div><?php } ?>
				<div class="row<?php echo ($style == 0) ? ' post-vertical' : ' post-horizontal' ;?>">
					<div class="<?php echo ($style == 0) ? 'col-md-6 ' : 'col-12 ' ;?>first-col">
					<?php
					$i=1;
					while ($get_featured_posts->have_posts()):$get_featured_posts->the_post(); ?>
					<?php if ( $i == 1 ) { ?>
						<div class="post-boxed main-post clearfix<?php echo ($style == 1) ? ' inlined' : '' ;?>">
							<?php if ( has_post_thumbnail() ) { ?>
								<div class="post-img-wrap">
									<a href="<?php the_permalink(); ?>" class="post-img" style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(),'full')); ?>');"></a>
								</div>
							<?php } ?>
							<div class="post-content">
								<div class="entry-meta category-meta">
									<div class="cat-links"><?php the_category(' '); ?></div>
								</div><!-- .entry-meta -->
								<?php the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h3>' ); ?>
								<div class="entry-meta">
									<?php mags_posted_on(); ?>
								</div>
								<div class="entry-content">
									<?php the_excerpt(); ?>
								</div><!-- .entry-content -->
							</div>
						</div><!-- post-boxed -->
					</div>
					<div class="<?php echo ($style == 0) ? 'col-md-6 ' : 'col-12 ' ;?>second-col">
						<?php if ( $style == 1 ) { ?>
							<div class="row">
						<?php }
						} else {
							if ( $style == 1 ) { ?>
								<div class="col-md-6 post-col">
							<?php } ?>
							<div class="post-boxed inlined clearfix">
								<?php if ( has_post_thumbnail() ) { ?>
									<div class="post-img-wrap">
										<a href="<?php the_permalink(); ?>" class="post-img" style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(),'full')); ?>');"></a>
									</div>
								<?php } ?>
								<div class="post-content">
									<div class="entry-meta category-meta">
										<div class="cat-links"><?php the_category(' '); ?></div>
									</div><!-- .entry-meta -->
									<?php the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h3>' ); ?>
									<div class="entry-meta">
										<?php mags_posted_on(); ?>
									</div>
								</div>
							</div><!-- .post-boxed -->
							<?php if ( $style == 1 ) { ?>
								</div><!-- .col-md-6 .post-col -->
							<?php }
						}
						$i++;
						endwhile;
						// Reset Post Data
						wp_reset_postdata(); ?>
						<?php if ( $style == 1 ) { ?>
							</div><!-- .row -->
						<?php } ?>
					</div>
				</div><!-- .row -->
			</div><!-- .container -->
		<?php echo (!empty($bg_image)) ? '</div><!-- .section-background -->' : '' ;

		echo $args['after_widget'] . '<!-- .mags-widget-horizontal-vertical-posts -->';
	}
}

/****************************************************************************************/
/**
 * Widget for Front Page Template.
 * Construct the widget.
 * i.e. Posts.
 */
class mags_card_block_posts extends WP_Widget {

	function __construct() {
		$widget_ops = array(
			'classname' => 'mags-widget-card-block-posts',
			'description' => __('Display Card/Block Posts', 'mags')
		);
		parent::__construct(false, $name = __('TH: Card/Block Posts', 'mags') , $widget_ops);
	}

	function form($instance) {

		$instance = wp_parse_args(
			(array) $instance,
			array(
				'title' => '',
				'category' => '',
				'type' => 1,
				'style' => 0,
				'bg_image' => '',
				'bg_fixed_parllax' => 1,
				'spacing' => 0,
			)
		);
		$title = isset( $instance['title'] ) ? $instance['title'] : '';
		$type = ( isset($instance['type']) && is_numeric($instance['type']) ) ? (int) $instance['type'] : 1;
		$bg_fixed_parllax = ( isset($instance['bg_fixed_parllax']) && is_numeric($instance['bg_fixed_parllax']) ) ? (int) $instance['bg_fixed_parllax'] : 1; ?>
		<p>
			<em><?php esc_html_e('Set featured image on the related post if you need to display Image.', 'mags'); ?></em>
		</p>
		<p>
			<input id="<?php echo $this->get_field_id('style'); ?>" name="<?php echo $this->get_field_name('style'); ?>" type="checkbox" value="1" <?php checked( '1', absint($instance['style']) ); ?>/>
			<label for="<?php echo $this->get_field_id('style'); ?>">
				<?php esc_html_e('Block Style','mags'); ?>
			</label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">
				<strong><?php esc_html_e('Title', 'mags'); ?></strong>
			</label>
			<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>"/>
		</p>
		<p class="mags-widget-display-control">
			<label for="<?php echo $this->get_field_id('spacing'); ?>">
				<strong><?php esc_html_e('Spacing', 'mags'); ?></strong>
			</label><br>
			<input id="<?php echo $this->get_field_id('spacing'); ?>" name="<?php echo $this->get_field_name('spacing'); ?>" min="0" max="50" step="5" type="range" value="<?php echo absint($instance['spacing']); ?>">
		</p>
		<p>
			<label><strong><?php esc_html_e('Choose Post Type', 'mags'); ?></strong></label><br>
			<input type="radio" id="<?php echo ($this->get_field_id('type') . '-1'); ?>" name="<?php echo ($this->get_field_name('type')); ?>" value="1" <?php checked($type == 1, true); ?>>
			<label for="<?php echo ($this->get_field_id('type') . '-1'); ?>" class="input-label"><?php esc_html_e('Latest Posts', 'mags'); ?></label>
			<br>
			<input type="radio" id="<?php echo ($this->get_field_id( 'type') . '-2'); ?>" name="<?php echo ($this->get_field_name('type')); ?>" value="2" <?php checked($type == 2, true); ?>>
			<label for="<?php echo ($this->get_field_id('type') . '-2'); ?>" class="input-label"><?php esc_html_e('Show Posts from Category', 'mags'); ?></label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('category'); ?>">
				<strong><?php esc_html_e('Choose Category', 'mags'); ?></strong>
			</label>
			<?php wp_dropdown_categories(
				array(
					'show_option_none' => ' ',
					'name' => $this->get_field_name('category') ,
					'selected' => $instance['category']
				)
			); ?>
		</p>
		<div class="custom-image-uploader mags-widget-display-control">
			<label for="<?php echo $this->get_field_id('bg_image'); ?>">
				<strong><?php esc_html_e('Background Image', 'mags'); ?></strong>
			</label>
			<div class="custom_media_preview">
				<?php if ( $instance['bg_image'] !== '' ) { ?>
					<img src="<?php echo esc_url( $instance['bg_image'] ); ?>" style="max-width: 100%;" />
				<?php } ?>
			</div>
			<input type="text" class="custom_media_input" id="<?php echo $this->get_field_id('bg_image'); ?>" name="<?php echo $this->get_field_name('bg_image'); ?>" value="<?php echo esc_url($instance['bg_image']); ?>"/>
			<input type="button" class="button custom_image_upload" data-title="<?php esc_attr_e( 'Select an Image', 'mags' ); ?>" data-update-btn="<?php esc_attr_e( 'Select', 'mags' ); ?>" name="<?php echo $this->get_field_name('bg_image'); ?>" value="<?php esc_attr_e('Upload Image', 'mags');?>"/>
		</div>
		<p class="mags-widget-display-control">
			<label><strong><?php esc_html_e('Background Image Style', 'mags'); ?></strong></label><br>
			<input type="radio" id="<?php echo ($this->get_field_id('bg_fixed_parllax') . '-1'); ?>" name="<?php echo ($this->get_field_name('bg_fixed_parllax')); ?>" value="1" <?php checked($bg_fixed_parllax == 1, true); ?>>
			<label for="<?php echo ($this->get_field_id('bg_fixed_parllax') . '-1'); ?>" class="input-label"><?php esc_html_e('Scroll', 'mags'); ?></label>
			<br>
			<input type="radio" id="<?php echo ($this->get_field_id('bg_fixed_parllax') . '-2'); ?>" name="<?php echo ($this->get_field_name('bg_fixed_parllax')); ?>" value="2" <?php checked($bg_fixed_parllax == 2, true); ?>>
			<label for="<?php echo ($this->get_field_id('bg_fixed_parllax') . '-2'); ?>" class="input-label"><?php esc_html_e('Fixed', 'mags'); ?></label>
		</p>
		<?php
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['category'] = absint($new_instance['category']);
		$instance['style'] = absint($new_instance['style']);
		$instance['title'] = sanitize_text_field($new_instance['title']);
		$instance['type'] = ( isset($new_instance['type']) && $new_instance['type'] > 0 && $new_instance['type'] < 3 ) ? (int) $new_instance['type'] : 1;
		$instance['bg_image'] = esc_url_raw($new_instance['bg_image']);
		$instance['bg_fixed_parllax'] = ( isset($new_instance['bg_fixed_parllax']) && $new_instance['bg_fixed_parllax'] > 0 && $new_instance['bg_fixed_parllax'] < 3 ) ? (int) $new_instance['bg_fixed_parllax'] : 1;
		$instance['spacing'] = ( isset($new_instance['spacing']) && $new_instance['spacing'] > 0 && $new_instance['spacing'] <= 50 ) ? (int) $new_instance['spacing'] : 0;
		return $instance;
	}

	function widget($args, $instance) {
		$category = isset($instance['category']) ? $instance['category'] : '';
		$style = empty($instance['style']) ? '' : $instance['style'];
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$type = ( isset($instance['type']) && is_numeric($instance['type']) ) ? (int) $instance['type'] : 1;
		$bg_image = isset($instance['bg_image']) ? $instance['bg_image'] : '';
		$bg_fixed_parllax = ( isset($instance['bg_fixed_parllax']) && is_numeric($instance['bg_fixed_parllax']) ) ? (int) $instance['bg_fixed_parllax'] : 1;
		$spacing = empty($instance['spacing']) ? 0 : $instance['spacing'];
		global $post;

		$post_type = array(
			'posts_per_page' => 6,
			'post_type' => array('post'),
			'post__not_in' => get_option('sticky_posts'),
		);
		if ( $type == 2 ) {
			$post_type['category__in'] = $category;
		}

		$get_featured_posts = new WP_Query($post_type);

		echo $args['before_widget'];
		if (!empty($bg_image)) { ?> <div class="section-background section-bg-overlay<?php echo ($bg_fixed_parllax === 2) ? ' bg-fixed' : '' ; ?>" style="background-image:url('<?php echo esc_url($bg_image); ?>');"> <?php } ?>
			<div class="container">
				<?php if ( !empty($title) ) { ?>
					<div class="section-title-wrap">
						<?php echo $args['before_title'] . $title . $args['after_title']; ?>
					</div><!-- .section-title-wrap -->
				<?php }
				if ( !empty($spacing) ) { ?> <div class="widget-cnt-spacing" style="padding-top: <?php echo absint($spacing); ?>%;"></div><?php } ?>
				<div class="row justify-content-center">
					<?php while ($get_featured_posts->have_posts()):$get_featured_posts->the_post(); ?>
						<div class="col-sm-6 col-lg-4 post-col">
							<div class="post-item<?php echo ($style == 0) ? ' post-boxed' : ' post-block' ;?>">
								<?php if ( has_post_thumbnail() && $style == 0 ) { ?>
									<div class="post-img-wrap">
										<a href="<?php the_permalink(); ?>" class="post-img" style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(),'full')); ?>');"></a>
										<div class="entry-meta category-meta">
											<div class="cat-links"><?php the_category(' '); ?></div>
										</div><!-- .entry-meta -->
									</div><!-- .post-img-wrap -->
								<?php }
								if ( $style == 0 ) { ?>
									<div class="post-content">
										<?php if ( !has_post_thumbnail() ) { ?>
											<div class="entry-meta category-meta">
												<div class="cat-links"><?php the_category(' '); ?></div>
											</div><!-- .entry-meta -->
										<?php } ?>
										<?php the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h3>' ); ?>
										<div class="entry-meta">
											<?php mags_posted_on(); ?>
										</div>
										<div class="entry-content">
											<?php the_excerpt(); ?>
										</div><!-- .entry-content -->
									</div><!-- .post-content -->
								<?php } else { ?>
									<div class="post-img-wrap">
										<a href="<?php the_permalink(); ?>" class="post-img" <?php if ( has_post_thumbnail() ) { ?>style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(),'full')); ?>');" <?php } ?>></a>
									</div><!-- .post-img-wrap -->
									<div class="entry-header">
										<div class="entry-meta category-meta">
											<div class="cat-links"><?php the_category(' '); ?></div>
										</div><!-- .entry-meta -->
										<?php the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h3>' ); ?>
										<div class="entry-meta">
											<?php mags_posted_on(); ?>
										</div>
									</div><!-- .entry-header -->
								<?php } ?>
							</div><!-- .post-item -->
						</div><!-- .col-sm-6 col-lg-4 .post-col -->
					<?php endwhile;
					// Reset Post Data
					wp_reset_postdata(); ?>
				</div><!-- .row -->
			</div><!-- .container -->
		<?php echo (!empty($bg_image)) ? '</div><!-- .section-background -->' : '' ;

		echo $args['after_widget'] . '<!-- .mags-widget-card-block-posts -->';
	}
}

/****************************************************************************************/
/**
 * Widget for Any Sidebars.
 * Construct the widget.
 * i.e. Name and posts.
 */
class mags_recent_posts extends WP_Widget {
	function __construct() {
		$widget_ops = array(
			'classname' => 'mags-widget-recent-posts',
			'description' => __('Display Recent Posts', 'mags')
		);
		parent::__construct(false, $name = __('TH: Recent Posts', 'mags') , $widget_ops);
	}
	function form($instance) {
		$instance = wp_parse_args(
			(array) $instance,
			array(
				'number' => '6',
				'title' => '',
				'bg_image' => '',
				'bg_fixed_parllax' => 1,
				'spacing' => 0,
			)
		);
		$title = isset( $instance['title'] ) ? $instance['title'] : '';
		$bg_fixed_parllax = ( isset($instance['bg_fixed_parllax']) && is_numeric($instance['bg_fixed_parllax']) ) ? (int) $instance['bg_fixed_parllax'] : 1; ?>
		<p>
			<em><?php esc_html_e('Set featured image on the related post if you need to display Image.', 'mags'); ?></em>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">
				<strong><?php esc_html_e('Title', 'mags'); ?></strong>
			</label>
			<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>"/>
		</p>
		<p class="mags-widget-display-control">
			<label for="<?php echo $this->get_field_id('spacing'); ?>">
				<strong><?php esc_html_e('Spacing', 'mags'); ?></strong>
			</label><br>
			<input id="<?php echo $this->get_field_id('spacing'); ?>" name="<?php echo $this->get_field_name('spacing'); ?>" min="0" max="50" step="5" type="range" value="<?php echo absint($instance['spacing']); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('number'); ?>">
				<strong><?php esc_html_e( 'Number of Post', 'mags' ); ?></strong>
			</label>
			<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="number" min="1" max="50" value="<?php echo absint($instance[ 'number']); ?>" />
		</p>
		<div class="custom-image-uploader mags-widget-display-control">
			<label for="<?php echo $this->get_field_id('bg_image'); ?>">
				<strong><?php esc_html_e('Background Image', 'mags'); ?></strong>
			</label>
			<div class="custom_media_preview">
				<?php if ( $instance['bg_image'] !== '' ) { ?>
					<img src="<?php echo esc_url( $instance['bg_image'] ); ?>" style="max-width: 100%;" />
				<?php } ?>
			</div>
			<input type="text" class="custom_media_input" id="<?php echo $this->get_field_id('bg_image'); ?>" name="<?php echo $this->get_field_name('bg_image'); ?>" value="<?php echo esc_url($instance['bg_image']); ?>"/>
			<input type="button" class="button custom_image_upload" data-title="<?php esc_attr_e( 'Select an Image', 'mags' ); ?>" data-update-btn="<?php esc_attr_e( 'Select', 'mags' ); ?>" name="<?php echo $this->get_field_name('bg_image'); ?>" value="<?php esc_attr_e('Upload Image', 'mags');?>"/>
		</div>
		<p class="mags-widget-display-control">
			<label><strong><?php esc_html_e('Background Image Style', 'mags'); ?></strong></label><br>
			<input type="radio" id="<?php echo ($this->get_field_id('bg_fixed_parllax') . '-1'); ?>" name="<?php echo ($this->get_field_name('bg_fixed_parllax')); ?>" value="1" <?php checked($bg_fixed_parllax == 1, true); ?>>
			<label for="<?php echo ($this->get_field_id('bg_fixed_parllax') . '-1'); ?>" class="input-label"><?php esc_html_e('Scroll', 'mags'); ?></label>
			<br>
			<input type="radio" id="<?php echo ($this->get_field_id('bg_fixed_parllax') . '-2'); ?>" name="<?php echo ($this->get_field_name('bg_fixed_parllax')); ?>" value="2" <?php checked($bg_fixed_parllax == 2, true); ?>>
			<label for="<?php echo ($this->get_field_id('bg_fixed_parllax') . '-2'); ?>" class="input-label"><?php esc_html_e('Fixed', 'mags'); ?></label>
		</p>
		<?php
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['number'] = ( isset($new_instance['number']) && $new_instance['number'] > 0 && $new_instance['number'] < 51 ) ? (int) $new_instance['number'] : 6;
		$instance['title'] = sanitize_text_field($new_instance['title']);
		$instance['bg_image'] = esc_url_raw($new_instance['bg_image']);
		$instance['bg_fixed_parllax'] = ( isset($new_instance['bg_fixed_parllax']) && $new_instance['bg_fixed_parllax'] > 0 && $new_instance['bg_fixed_parllax'] < 3 ) ? (int) $new_instance['bg_fixed_parllax'] : 1;
		$instance['spacing'] = ( isset($new_instance['spacing']) && $new_instance['spacing'] > 0 && $new_instance['spacing'] <= 50 ) ? (int) $new_instance['spacing'] : 0;
		return $instance;
	}

	function widget($args, $instance) {
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$number = empty($instance['number']) ? 6 : $instance['number'];
		$bg_image = isset($instance['bg_image']) ? $instance['bg_image'] : '';
		$bg_fixed_parllax = ( isset($instance['bg_fixed_parllax']) && is_numeric($instance['bg_fixed_parllax']) ) ? (int) $instance['bg_fixed_parllax'] : 1;
		$spacing = empty($instance['spacing']) ? 0 : $instance['spacing'];
		global $post;

		$get_featured_posts = new WP_Query(
			array(
				'posts_per_page' => $number,
				'post_type' => array('post'),
				'post__not_in' => get_option('sticky_posts'),
			)
		);

		echo $args['before_widget'];

			if (!empty($bg_image)) { ?> <div class="section-background section-bg-overlay<?php echo ($bg_fixed_parllax === 2) ? ' bg-fixed' : '' ; ?>" style="background-image:url('<?php echo esc_url($bg_image); ?>');"> <?php } ?>
				<div class="container">
					<?php if ( !empty($title) ) { ?>
						<div class="section-title-wrap">
							<?php echo $args['before_title'] . $title . $args['after_title']; ?>
						</div><!-- .section-title-wrap -->
					<?php }
					if ( !empty($spacing) ) { ?> <div class="widget-cnt-spacing" style="padding-top: <?php echo absint($spacing); ?>%;"></div><?php } ?>
					<div class="row">
						<?php if ($number > 0) {
							$i = 0;
							while ($get_featured_posts->have_posts()):$get_featured_posts->the_post(); ?>
								<div class="col-md-6 post-col">
									<div class="post-boxed inlined clearfix">
										<?php if ( has_post_thumbnail() ) { ?>
											<div class="post-img-wrap">
												<a href="<?php the_permalink(); ?>" class="post-img" style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(),'full')); ?>');"></a>
											</div>
										<?php } ?>
										<div class="post-content">
											<div class="entry-meta category-meta">
												<div class="cat-links"><?php the_category(' '); ?></div>
											</div><!-- .entry-meta -->
											<?php the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h3>' ); ?>
											<div class="entry-meta">
												<?php mags_posted_on(); ?>
											</div>
										</div>
									</div><!-- post-boxed -->
								</div><!-- col-md-6 -->
								<?php $i++;
							endwhile;
							// Reset Post Data
							wp_reset_postdata();
						} ?>
					</div><!-- .row -->
				</div><!-- .container -->
			<?php echo (!empty($bg_image)) ? '</div><!-- .section-background -->' : '' ;

		echo $args['after_widget'] . '<!-- .mags-widget-recent-posts -->';
	}
}

/****************************************************************************************/
/**
 * Widget for Front Page Template.
 * Construct the widget.
 * i.e. Posts.
 */
class mags_multiple_layout_posts extends WP_Widget {

	function __construct() {
		$widget_ops = array(
			'classname' => 'mags-widget-multiple-layouts',
			'description' => __('Display Multiple Layout Posts', 'mags')
		);
		parent::__construct(false, $name = __('TH: Multiple Layout Posts', 'mags') , $widget_ops);
	}

	function form($instance) {

		$instance = wp_parse_args(
			(array) $instance,
			array(
				'title' => '',
				'category' => '',
				'type' => 1,
				'style' => 1,
				'bg_image' => '',
				'bg_fixed_parllax' => 1,
				'spacing' => 0,
			)
		);
		$title = isset( $instance['title'] ) ? $instance['title'] : '';
		$type = ( isset($instance['type']) && is_numeric($instance['type']) ) ? (int) $instance['type'] : 1;
		$style = ( isset($instance['style']) && is_numeric($instance['style']) ) ? (int) $instance['style'] : 1;
		$bg_fixed_parllax = ( isset($instance['bg_fixed_parllax']) && is_numeric($instance['bg_fixed_parllax']) ) ? (int) $instance['bg_fixed_parllax'] : 1; ?>
		<p>
			<em><?php esc_html_e('Set featured image on the related post if you need to display image.', 'mags'); ?></em>
		</p>
		<p>
			<label><strong><?php esc_html_e('Choose Style', 'mags'); ?></strong></label><br>
			<input type="radio" id="<?php echo ($this->get_field_id('style') . '-1'); ?>" name="<?php echo ($this->get_field_name('style')); ?>" value="1" <?php checked($style == 1, true); ?>>
			<label for="<?php echo ($this->get_field_id('style') . '-1'); ?>" class="input-label"><?php esc_html_e('Style 1', 'mags'); ?></label>
			<br>
			<input type="radio" id="<?php echo ($this->get_field_id( 'style') . '-2'); ?>" name="<?php echo ($this->get_field_name('style')); ?>" value="2" <?php checked($style == 2, true); ?>>
			<label for="<?php echo ($this->get_field_id('style') . '-2'); ?>" class="input-label"><?php esc_html_e('Style 2', 'mags'); ?></label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">
				<strong><?php esc_html_e('Title', 'mags'); ?></strong>
			</label>
			<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>"/>
		</p>
		<p class="mags-widget-display-control">
			<label for="<?php echo $this->get_field_id('spacing'); ?>">
				<strong><?php esc_html_e('Spacing', 'mags'); ?></strong>
			</label><br>
			<input id="<?php echo $this->get_field_id('spacing'); ?>" name="<?php echo $this->get_field_name('spacing'); ?>" min="0" max="50" step="5" type="range" value="<?php echo absint($instance['spacing']); ?>">
		</p>
		<p>
			<label><strong><?php esc_html_e('Choose Post Type', 'mags'); ?></strong></label><br>
			<input type="radio" id="<?php echo ($this->get_field_id('type') . '-1'); ?>" name="<?php echo ($this->get_field_name('type')); ?>" value="1" <?php checked($type == 1, true); ?>>
			<label for="<?php echo ($this->get_field_id('type') . '-1'); ?>" class="input-label"><?php esc_html_e('Latest Posts', 'mags'); ?></label>
			<br>
			<input type="radio" id="<?php echo ($this->get_field_id( 'type') . '-2'); ?>" name="<?php echo ($this->get_field_name('type')); ?>" value="2" <?php checked($type == 2, true); ?>>
			<label for="<?php echo ($this->get_field_id('type') . '-2'); ?>" class="input-label"><?php esc_html_e('Show Posts from Category', 'mags'); ?></label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('category'); ?>">
				<strong><?php esc_html_e('Choose Category', 'mags'); ?></strong>
			</label>
			<?php wp_dropdown_categories(
				array(
					'show_option_none' => ' ',
					'name' => $this->get_field_name('category') ,
					'selected' => $instance['category']
				)
			); ?>
		</p>
		<div class="custom-image-uploader mags-widget-display-control">
			<label for="<?php echo $this->get_field_id('bg_image'); ?>">
				<strong><?php esc_html_e('Background Image', 'mags'); ?></strong>
			</label>
			<div class="custom_media_preview">
				<?php if ( $instance['bg_image'] !== '' ) { ?>
					<img src="<?php echo esc_url( $instance['bg_image'] ); ?>" style="max-width: 100%;" />
				<?php } ?>
			</div>
			<input type="text" class="custom_media_input" id="<?php echo $this->get_field_id('bg_image'); ?>" name="<?php echo $this->get_field_name('bg_image'); ?>" value="<?php echo esc_url($instance['bg_image']); ?>"/>
			<input type="button" class="button custom_image_upload" data-title="<?php esc_attr_e( 'Select an Image', 'mags' ); ?>" data-update-btn="<?php esc_attr_e( 'Select', 'mags' ); ?>" name="<?php echo $this->get_field_name('bg_image'); ?>" value="<?php esc_attr_e('Upload Image', 'mags');?>"/>
		</div>
		<p class="mags-widget-display-control">
			<label><strong><?php esc_html_e('Background Image Style', 'mags'); ?></strong></label><br>
			<input type="radio" id="<?php echo ($this->get_field_id('bg_fixed_parllax') . '-1'); ?>" name="<?php echo ($this->get_field_name('bg_fixed_parllax')); ?>" value="1" <?php checked($bg_fixed_parllax == 1, true); ?>>
			<label for="<?php echo ($this->get_field_id('bg_fixed_parllax') . '-1'); ?>" class="input-label"><?php esc_html_e('Scroll', 'mags'); ?></label>
			<br>
			<input type="radio" id="<?php echo ($this->get_field_id('bg_fixed_parllax') . '-2'); ?>" name="<?php echo ($this->get_field_name('bg_fixed_parllax')); ?>" value="2" <?php checked($bg_fixed_parllax == 2, true); ?>>
			<label for="<?php echo ($this->get_field_id('bg_fixed_parllax') . '-2'); ?>" class="input-label"><?php esc_html_e('Fixed', 'mags'); ?></label>
		</p>
		<?php
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['category'] = absint($new_instance['category']);
		$instance['style'] = ( isset($new_instance['style']) && $new_instance['style'] > 0 && $new_instance['style'] <= 2 ) ? (int) $new_instance['style'] : 1;
		$instance['title'] = sanitize_text_field($new_instance['title']);
		$instance['type'] = ( isset($new_instance['type']) && $new_instance['type'] > 0 && $new_instance['type'] < 3 ) ? (int) $new_instance['type'] : 1;
		$instance['bg_image'] = esc_url_raw($new_instance['bg_image']);
		$instance['bg_fixed_parllax'] = ( isset($new_instance['bg_fixed_parllax']) && $new_instance['bg_fixed_parllax'] > 0 && $new_instance['bg_fixed_parllax'] < 3 ) ? (int) $new_instance['bg_fixed_parllax'] : 1;
		$instance['spacing'] = ( isset($new_instance['spacing']) && $new_instance['spacing'] > 0 && $new_instance['spacing'] <= 50 ) ? (int) $new_instance['spacing'] : 0;
		return $instance;
	}

	function widget($args, $instance) {
		$category = isset($instance['category']) ? $instance['category'] : '';
		$style = ( isset($instance['style']) && is_numeric($instance['style']) ) ? (int) $instance['style'] : 1;
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$type = ( isset($instance['type']) && is_numeric($instance['type']) ) ? (int) $instance['type'] : 1;
		$bg_image = isset($instance['bg_image']) ? $instance['bg_image'] : '';
		$bg_fixed_parllax = ( isset($instance['bg_fixed_parllax']) && is_numeric($instance['bg_fixed_parllax']) ) ? (int) $instance['bg_fixed_parllax'] : 1;
		$spacing = empty($instance['spacing']) ? 0 : $instance['spacing'];
		global $post;

		$post_type = array(
			'posts_per_page' => 10,
			'post_type' => array('post'),
			'post__not_in' => get_option('sticky_posts'),
		);
		if ( $type == 2 ) {
			$post_type['category__in'] = $category;
		}

		$get_featured_posts = new WP_Query($post_type);
		$featured_post_count = $get_featured_posts->post_count;

		echo $args['before_widget'];
		if (!empty($bg_image)) { ?> <div class="section-background section-bg-overlay<?php echo ($bg_fixed_parllax === 2) ? ' bg-fixed' : '' ; ?>" style="background-image:url('<?php echo esc_url($bg_image); ?>');"> <?php } ?>
			<div class="container">
				<?php if ( !empty($title) ) { ?>
					<div class="section-title-wrap">
						<?php echo $args['before_title'] . $title . $args['after_title']; ?>
					</div><!-- .section-title-wrap -->
				<?php } ?>
				<?php if ( !empty($spacing) ) { ?> <div class="widget-cnt-spacing" style="padding-top: <?php echo absint($spacing); ?>%;"></div><?php } ?>
				<div class="row">
					<?php $i = 1;
					while ($get_featured_posts->have_posts()):$get_featured_posts->the_post(); ?>
						<?php if ( $i == 1 ) { ?>
							<div class="<?php echo ($featured_post_count <= 3) ? 'col-lg-12 ' : 'col-lg-8 '; echo ($style === 2) ? 'order-lg-2' : ''; ?>">
								<div class="main-section">
									<div class="post-item post-block">
										<div class="post-img-wrap">
											<a href="<?php the_permalink(); ?>" class="post-img" <?php if ( has_post_thumbnail() ) { ?> style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(),'full')); ?>');" <?php } ?>></a>
										</div>
										<div class="entry-header">
											<div class="entry-meta category-meta">
												<div class="cat-links"><?php the_category(' '); ?></div>
											</div><!-- .entry-meta -->
											<?php the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h3>' ); ?>
										</div>
									</div><!-- .post-block -->
								</div><!-- .main-section -->
						<?php }

						if ($i <= 3) {
							if ($i >= 2) {
								if ( $i == 2 ) { ?>
									<div class="row secondary-section">
								<?php } ?>
								<div class="col-sm-6 post-col">
									<div class="post-boxed">
										<?php if ( has_post_thumbnail() ) { ?>
											<div class="post-img-wrap">
												<a href="<?php the_permalink(); ?>" class="post-img" style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(),'full')); ?>');"></a>
											</div>
										<?php } ?>
										<div class="post-content">
											<div class="entry-meta category-meta">
												<div class="cat-links"><?php the_category(' '); ?></div>
											</div><!-- .entry-meta -->
											<?php the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h3>' ); ?>
										</div>
									</div><!-- .post-boxed -->
								</div><!-- .col-sm-6 .post-col -->
								<?php if ( $i == 3 || $i == $featured_post_count ) { ?>
									</div><!-- .row .secondary-section -->
								<?php }
							}
							if ($i == 3 || $i == $featured_post_count) { ?>
								</div><!-- <?php echo ($featured_post_count <= 3) ? '.col-lg-12 ' : '.col-lg-8 '; ?> -->
							<?php }
						}

						if ( $i >= 4 && $i <= 10  ) {
							if ( $i == 4 ) { ?>
								<div class="col-lg-4<?php echo ($style == 2) ? ' order-lg-1' : '' ;?> list-section">
									<div class="row">
							<?php } ?>
							<div class="col-md-6 col-lg-12 post-col">
								<div class="post-boxed inlined clearfix">
									<?php if ( has_post_thumbnail() ) { ?>
										<div class="post-img-wrap">
											<a href="<?php the_permalink(); ?>" class="post-img" style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(),'full')); ?>');"></a>
										</div>
									<?php } ?>
									<div class="post-content">
										<div class="entry-meta category-meta">
											<div class="cat-links"><?php the_category(' '); ?></div>
										</div><!-- .entry-meta -->
										<?php the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h3>' ); ?>
									</div>
								</div><!-- .post-boxed -->
							</div><!-- .col-md-6 .col-lg-12 -->
							<?php if ( $i == 10 || $i == $featured_post_count ) { ?>
									</div><!-- .row -->
								</div><!-- .list-section -->
							<?php }
						}
					$i++;
					endwhile;
					// Reset Post Data
					wp_reset_postdata(); ?>
				</div><!-- .row -->
			</div><!-- .container -->
		<?php echo (!empty($bg_image)) ? '</div><!-- .section-background -->' : '' ;

		echo $args['after_widget'] . '<!-- .mags-widget-multicategory-posts -->';
	}
}