<?php 
/*
Plugin Name: Rose Team
Plugin URI: http://wiloke.net
Description: Rose Team
Version: 1.0
Author: Love - Wiloke Team
Author URI: http://wiloke.net
*/

if (!defined('ABSPATH')) {
  die("You don't have sufficient permission to access this page");
}

define('ROSE_TEAM_URL', trailingslashit(plugins_url('', __FILE__)) );
define('ROSE_TEAM', '1.0');

if(!class_exists('rose_team')) {

	class rose_team { 

		public function __construct() {
			add_action('init', array($this, 'rose_register'));
			add_shortcode( 'rose_shortcode_team', array($this, 'shortcode_render'));	
			add_action('vc_before_init', array($this, 'rose_vc_map'));
		}

		public function rose_register() {

	      	$labels = array(
		        'name' => esc_html__('Team', 'rose'),
		        'singular_name' => esc_html__('Team', 'rose'),
		        'all_items' => esc_html__('All Team', 'rose'),
		        'add_new' => esc_html__('Add Member', 'rose'),
		        'add_new_item' => esc_html__('Add Member', 'rose'),
		        'edit_item' => esc_html__('Edit Member', 'rose'),
		        'new_item' => esc_html__('New Member', 'rose'),
		        'view_item' => esc_html__('View Member', 'rose'),
		        'search_items' => esc_html__('Search Member', 'rose'),
		        'not_found' =>  esc_html__('No Member Found', 'rose'),
		        'not_found_in_trash' => esc_html__('No Member Found In Trash', 'rose'),
		        'parent_item_colon' => ''
	      	);

	      	$args = array(
		        'labels' => $labels,
		        'public' => true,
		        'publicly_queryable' => true,
		        'show_ui' => true,
		        'query_var' => true,
		        'rewrite' => true,
		        'capability_type' => 'post',
		        'show_in_nav_menus' => false,
		        'hierarchical' => false,
		        'exclude_from_search' => true,
		        'menu_position' => 21,
		        'menu_icon' => 'dashicons-networking',
		        'supports' => array('title', 'editor', 'page-attributes','thumbnail')
	      	);
		      
	      	register_post_type('team', $args);
	  	}

	  	public function rose_vc_map() {

			vc_map( array(
				'name'			=> esc_html__('Rose Team', 'rose'),
				'base'			=> 'rose_shortcode_team',
				'category'		=> esc_html__('Rose', 'rose'),
				'description'	=> '',
				'params'		=> array(

					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Number Of Items', 'rose' ),
						'param_name' => 'show_post',
						'value' => 3,
						'std' => 3,
					),

					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Large Desktops (>= 1200px)', 'rose' ),
						'param_name' => 'col_lg',
						'std'	=> 3,
						'value' => array(
							esc_html__( '1 column', 'rose' ) => 1,
							esc_html__( '2 column', 'rose' ) => 2,
							esc_html__( '3 column', 'rose' ) => 3,
							esc_html__( '4 column', 'rose' ) => 4,
							esc_html__( '5 column', 'rose' ) => 5,
							esc_html__( '6 column', 'rose' ) => 6,
						)
					),

					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Medium Dekstops', 'rose' ),
						'param_name' => 'col_md',
						'std'	=> 3,
						'value' => array(
							esc_html__( '1 column', 'rose' ) => 1,
							esc_html__( '2 column', 'rose' ) => 2,
							esc_html__( '3 column', 'rose' ) => 3,
							esc_html__( '4 column', 'rose' ) => 4,
							esc_html__( '5 column', 'rose' ) => 5,
							esc_html__( '6 column', 'rose' ) => 6,
						)
					),

					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Tablets (≥768px)', 'rose' ),
						'param_name' => 'col_sm',
						'std'	=> 2,
						'value' => array(
							esc_html__( '1 column', 'rose' ) => 1,
							esc_html__( '2 column', 'rose' ) => 2,
							esc_html__( '3 column', 'rose' ) => 3,
							esc_html__( '4 column', 'rose' ) => 4,
							esc_html__( '5 column', 'rose' ) => 5,
							esc_html__( '6 column', 'rose' ) => 6,
						)
					),

					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Mobiles (<768px)', 'rose' ),
						'param_name' => 'col_xs',
						'std'	=> 1,
						'value' => array(
							esc_html__( '1 column', 'rose' ) => 1,
							esc_html__( '2 column', 'rose' ) => 2,
							esc_html__( '3 column', 'rose' ) => 3,
							esc_html__( '4 column', 'rose' ) => 4,
							esc_html__( '5 column', 'rose' ) => 5,
							esc_html__( '6 column', 'rose' ) => 6,
						)
					),

					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Spacing Vertical', 'rose' ),
						'param_name' => 'vertical',
						'std'	=> 30,
						'value' => array(
							esc_html__( 'No Spacing', 'rose' ) => 0,
							esc_html__( '5px', 'rose' ) 		=> 5,
							esc_html__( '10px', 'rose' ) 		=> 10,
							esc_html__( '15px', 'rose' ) 		=> 15,
							esc_html__( '20px', 'rose' ) 		=> 20,
							esc_html__( '25px', 'rose' ) 		=> 25,
							esc_html__( '30px', 'rose' ) 		=> 30,
						),
						'description'			=> esc_html__('Set spacing vertical.', 'rose')
					),

					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Horizontal Spacing', 'rose' ),
						'param_name' => 'horizontal',
						'std'	=> 30,
						'value' => array(
							esc_html__( 'No Spacing', 'rose' ) => 0,
							esc_html__( '5px', 'rose' ) 		=> 5,
							esc_html__( '10px', 'rose' ) 		=> 10,
							esc_html__( '15px', 'rose' ) 		=> 15,
							esc_html__( '20px', 'rose' ) 		=> 20,
							esc_html__( '25px', 'rose' ) 		=> 25,
							esc_html__( '30px', 'rose' ) 		=> 30,
						),
						'description'			=> esc_html__('Set vertical spacing', 'rose')
					),

					array(
						'type'			=> 'colorpicker',
						'heading'		=> esc_html__('Color For Member Name', 'rose'),
						'param_name'	=> 'color_name',
						'value'			=> '',
						'group'			=> esc_html__('Design option', 'rose')
					),

					array(
						'type'			=> 'colorpicker',
						'heading'		=> esc_html__('Color For Work Text', 'rose'),
						'param_name'	=> 'color_job',
						'value'			=> '',
						'group'			=> esc_html__('Design option','rose')
					),

					array(
						'type'			=> 'colorpicker',
						'heading'		=> esc_html__('Underline Color', 'rose'),
						'param_name'	=> 'color_line',
						'value'			=> '',
						'description'	=> esc_html__('Set color for line.', 'rose'),
						'group'			=> esc_html__('Design option','rose')
					),

					array(
						'type'			=> 'colorpicker',
						'heading'		=> esc_html__('Social Color', 'rose'),
						'param_name'	=> 'color_social',
						'value'			=> '',
						'group'			=> esc_html__('Design option','rose')
					),

					array(
						'type'			=> 'colorpicker',
						'heading'		=> esc_html__('Background Color', 'rose'),
						'param_name'	=> 'bg_color',
						'value'			=> '',
						'group'			=> esc_html__('Design option','rose')
					),

					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Order', 'rose' ),
						'param_name' => 'order',
						'std'			=> 'DESC',
						'value' => array(
							esc_html__( 'Descending', 'rose' ) 	=> 'DESC',
							esc_html__( 'Ascending', 'rose' ) 		=> 'ASC',
						),
						'description' => esc_html__( 'Designates the ascending or descending order of the orderby parameter.', 'rose' ),
					),

					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Order By', 'rose' ),
						'param_name' => 'orderby',
						'std'			=> 'date',
						'value' => array(
							esc_html__( 'Post Date', 'rose' ) 		=> 'date',
							esc_html__( 'Menu Order', 'rose' ) 	=> 'menu_order',
							esc_html__( 'Title', 'rose' ) 			=> 'title',
						),
						'description' => esc_html__( 'Sort retrieved projects by parameter.', 'rose' ),
					),
				)
			));
		}

		public function shortcode_render( $attr, $content = '' ) {

			extract(shortcode_atts( array(
				'show_post'			=> 3,
				'col_lg'			=> 3,
				'col_md'			=> 3,
				'col_sm'			=> 2,
				'col_xs'			=> 1,
				'vertical'			=> 30,
				'horizontal'		=> 30,
				'color_name' 		=> '',
				'color_job' 		=> '',
				'color_line' 		=> '',
				'color_social'		=> '',
				'bg_color'				=> '',
				'member_in'			=> 'all',
				'order'				=> 'DESC',
				'orderby'			=> 'date'
			), $attr )); 

			$bg_color = !empty( $bg_color ) ? 'style="background-color:'. esc_attr($bg_color) .'"' : '';
			$color_name = !empty( $color_name) ? 'style="color:'. esc_attr($color_name) .'"' : '';
			$color_job = !empty( $color_job) ? 'style="color:'. esc_attr($color_job) .'"' : '';	
			$color_line = !empty( $color_line) ? 'style="background-color:'. esc_attr($color_line) .'"' : '';
			$color_social = !empty( $color_social ) ? 'style="color:'. esc_attr($color_social) .'"' : '';

			$args = array(
				'post_type' => 'team',
				'post_status' => 'publish',
				'posts_per_page' => $show_post,
				'ignore_sticky_posts'=> 1,
				'order'					=> $order,
				'orderby'				=> $orderby
	  		);

	  		if( !empty($member_in) && $member_in != 'all' ) {
				$post_in = explode(',', $member_in);
				$args['post__in'] = $post_in;
			}

			$query = new WP_Query( $args );
			
			ob_start(); ?>
			
			<?php if($query->have_posts() ) : ?>
				<div class="team-wrap">
					<div class="grid" data-col-lg="<?php echo esc_attr($col_lg); ?>" data-col-md="<?php echo esc_attr($col_md); ?>" data-col-sm="<?php echo esc_attr($col_sm); ?>" data-col-xs="<?php echo esc_attr($col_xs); ?>" data-vertical="<?php echo esc_attr($vertical); ?>" data-horizontal="<?php echo esc_attr($horizontal); ?>">

						<?php while ($query->have_posts()) : $query->the_post(); ?>

							<div class="grid-item">
								<div class="team-item" <?php echo $bg_color; ?>>
									
									<?php 
										global $post;
										$setting = get_post_meta( $post->ID, 'team_setting', true ); 
									?>

									<?php if(has_post_thumbnail()) : ?>
										<div class="avatar">
											<?php the_post_thumbnail(array(270, 270)); ?>
										</div>
									<?php endif; ?>

									<h4 class="h5" <?php echo $color_name; ?>><?php the_title(); ?></h4>

									<?php if( isset($setting['job']) && !empty($setting['job']) ) : ?>
										<span <?php echo $color_job; ?>><?php echo esc_html($setting['job']); ?></span>
									<?php endif; ?>

									<div class="hr" <?php echo $color_line; ?>></div>
									
									<?php if ( !empty($post->post_content) ) : ?>
									<div class="desc" style="margin-bottom: 13px;">
										<?php the_content(); ?>
									</div>
									<?php endif; ?>

									<?php if( isset($setting) && !empty($setting) ) : ?>
										<div class="social-user">
											<?php foreach ($setting as $k => $v) : ?>
												<?php if( $k != 'job' && !empty($v) ) : ?>
													<a href="<?php echo esc_url($v) ?>" <?php echo $color_social ?> ><i class="fa <?php echo esc_attr($k); ?>"></i></a>
												<?php endif; ?>
											<?php endforeach; ?>
										</div>
									<?php endif; ?>
								</div>
							</div>

						<?php endwhile; ?>

					</div>
				</div>
			<?php endif; ?>

			<?php wp_reset_postdata(); ?>

			<?php $output = ob_get_clean();

			return $output;
		}
	}

	new rose_team();
}
