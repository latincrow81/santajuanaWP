<?php 
/*
Plugin Name: Rose Testimonial
Plugin URI: http://wiloke.net
Description: Rose Testimonial
Version: 1.0
Author: Love - Wiloke Team
Author URI: http://wiloke.net
*/
if (!defined('ABSPATH')) {
  die("You don't have sufficient permission to access this page");
}

define('ROSE_RESTIMONIAL_URL', trailingslashit(plugins_url('', __FILE__)) );
define('ROSE_RESTIMONIAL', '1.0');

if(!class_exists('rose_testimonial')) {

	class rose_testimonial { 

		public function __construct() {
			add_action('init', array($this, 'rose_register'));
			add_shortcode( 'rose_shortcode_testimonial', array($this, 'shortcode_render'));		
			add_action('vc_before_init', array($this, 'rose_vc_map'));
		}

		public function rose_register() {

	      	$labels = array(
		        'name' => esc_html__('Testimonial', 'rose'),
		        'singular_name' => esc_html__('Testimonial', 'rose'),
		        'all_items' => esc_html__('All Testimonial', 'rose'),
		        'add_new' => esc_html__('Add Testimonial', 'rose'),
		        'add_new_item' => esc_html__('Add Testimonial', 'rose'),
		        'edit_item' => esc_html__('Edit Testimonial', 'rose'),
		        'new_item' => esc_html__('New Testimonial', 'rose'),
		        'view_item' => esc_html__('View Testimonial', 'rose'),
		        'search_items' => esc_html__('Search Testimonial', 'rose'),
		        'not_found' =>  esc_html__('No Member Testimonial', 'rose'),
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
		        'menu_icon' => 'dashicons-format-quote',
		        'supports' => array('title', 'thumbnail', 'page-attributes')
	      	);
		      
	      	register_post_type('testimonial', $args);
	  	}

	  	public function rose_vc_map() {

			vc_map( array(
				'name'			=> esc_html__('Rose Testimonial', 'rose'),
				'base'			=> 'rose_shortcode_testimonial',
				'category'		=> esc_html__('Rose', 'rose'),
				'description'	=> '',
				'params'		=> array(

					array(
						'type'			=> 'textfield',
						'heading'		=> esc_html__('Show Post', 'rose'),
						'param_name'	=> 'show_post',
						'value'			=> '3',
						'description'			=> esc_html__('Show number post.', 'rose')
					),

					array(
						'type'			=> 'colorpicker',
						'heading'		=> esc_html__('Color Quote', 'rose'),
						'param_name'	=> 'color_quote',
						'value'			=> '',
						'description'			=> esc_html__('Set color for text quote.', 'rose')
					),

					array(
						'type'			=> 'colorpicker',
						'heading'		=> esc_html__('Color Name', 'rose'),
						'param_name'	=> 'color_name',
						'value'			=> '',
						'description'			=> esc_html__('Set color for text name.', 'rose')
					),

					array(
						'type'			=> 'colorpicker',
						'heading'		=> esc_html__('Color Work', 'rose'),
						'param_name'	=> 'color_work',
						'value'			=> '',
						'description'			=> esc_html__('Set color for text work.', 'rose')
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
				'color_quote'		=> '',
				'color_name'		=> '',
				'color_work'		=> '',
				'order'				=> 'DESC',
				'orderby'			=> 'date'
			), $attr )); 

			$color_quote = !empty( $color_quote ) ? 'style="color:'. esc_attr($color_quote) .'"' : '';
			$color_name = !empty( $color_name) ? 'style="color:'. esc_attr($color_name) .'"' : '';
			$color_work = !empty( $color_work) ? 'style="color:'. esc_attr($color_work) .'"' : '';	

			$args = array(
				'post_type' 			=> 'testimonial',
				'post_status' 			=> 'publish',
				'posts_per_page' 		=> $show_post,
				'ignore_sticky_posts'	=> 1,
				'order'					=> $order,
				'orderby'				=> $orderby
	  		);

			$query = new WP_Query( $args );
			ob_start(); ?>
			
			<?php if($query->have_posts() ) : ?>
				<div class="testimonial-slide">

					<?php while ($query->have_posts()) : $query->the_post(); ?>

						<div class="testimonial-item text-center">
							<?php 
								global $post;
								$setting = get_post_meta( $post->ID, 'testimonial_setting', true ); 
							?>

							<?php if( has_post_thumbnail() ) { the_post_thumbnail( array(75, 75) ); }?>

							<?php if( isset( $setting['quote'] ) && !empty( $setting['quote'] ) ) : ?>
								<p <?php echo $color_quote ?>><?php echo esc_html( $setting['quote'] ); ?></p>
							<?php endif; ?>

							<h4 class="h6" <?php echo $color_name; ?>><?php the_title(); ?></h4>

							<?php if( isset( $setting['work'] ) && !empty( $setting['work'] ) ) : ?>
								<span <?php echo $color_work ?>><?php echo esc_html($setting['work']); ?></span>
							<?php endif; ?>
						</div>

					<?php endwhile; ?>

				</div>
			<?php endif; ?>

			<?php wp_reset_postdata(); ?>

			<?php $output = ob_get_clean();

			return $output;
		}
	}

	new rose_testimonial();
}
