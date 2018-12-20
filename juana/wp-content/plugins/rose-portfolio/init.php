<?php
/*
Plugin Name: Rose Portfolio
Plugin URI: http://wiloke.net
Description: Rose Portfolio
Version: 1.1
Author: Love - Wiloke Team
Author URI: http://wiloke.net
*/
if (!defined('ABSPATH')) {
  die("You don't have sufficient permission to access this page");
}

define('ROSE_PORTFOLIO_URL', trailingslashit(plugins_url('', __FILE__)) );
define('ROSE_PORTFOLIO', '1.0');
define('ROSE_ADMIN_CORE_DIR',  trailingslashit(get_template_directory_uri().'/core'));

if (!class_exists('rose_plugin_portfolio')) {
	
	class rose_plugin_portfolio {

	  	public function __construct() {
	  		add_action('init', array($this, 'rose_register'));
	  		add_shortcode( 'rose_shortcode_portfolio', array($this, 'shortcode_render') );
			add_action('vc_before_init', array($this, 'rose_vc_map'));
			add_action( 'wp_ajax_rose_ajax_portfolio', array($this, 'ajax_loadmore' ));
			add_action( 'wp_ajax_nopriv_rose_ajax_portfolio', array($this, 'ajax_loadmore' ));
			add_action( 'wp_ajax_ajax_like', array($this, 'ajax_like' ));
			add_action( 'wp_ajax_nopriv_ajax_like', array($this, 'ajax_like' ));
			add_action( 'wp_enqueue_scripts', array($this, 'enqueued' ) );
			add_filter( 'post_type_link', array($this, 'rose_remove_portfolio_slug'), 10, 3 );
			add_action( 'pre_get_posts', array($this, 'rose_parse_request'));
	  	}

	  	public function rose_parse_request($query)
	  	{

		 	if ( !$query->is_main_query() || 2 != count( $query->query ) || ! isset( $query->query['page'] ) ) {
		        return;
		    }

		    $aPostTypes = get_post_types();

		    if ( ! empty( $query->query['name'] ) ) {
		        $query->set( 'post_type', $aPostTypes );
		    }
	  	}

	  	public function rose_remove_portfolio_slug($post_link, $post, $leavename)
	  	{
	  		if ( 'portfolio' != $post->post_type || 'publish' != $post->post_status ) 
	  		{
		        return $post_link;
		    }

			$portfolioLink = get_option('wiloke_portfolio_permalink');

			if ( $portfolioLink == 'category-portfolio' )
			{
				$pattern = '%portfolio-category%';
			}elseif ($portfolioLink == 'without-posttype'){
				$pattern = '%portfolio-postname%';
			}

			if ( isset($pattern) )
			{
				$post_link = str_replace( '/'.$pattern.'/', '/', $post_link );
			}

		    
		    return $post_link;
	  	}

	    //REGISTER PORTFOLIO
		public function rose_register() {

			// Register post type portfolio
			$labels = array(
				'name' => esc_html__('Portfolio', 'rose'),
				'singular_name' => esc_html__('Portfolio', 'rose'),
				'all_items' => esc_html__('All Portfolio', 'rose'),
				'add_new' => esc_html__('Add Portfolio', 'rose'),
				'add_new_item' => esc_html__('Add Portfolio', 'rose'),
				'edit_item' => esc_html__('Edit Portfolio', 'rose'),
				'new_item' => esc_html__('New Portfolio', 'rose'),
				'view_item' => esc_html__('View Portfolio', 'rose'),
				'search_items' => esc_html__('Search Portfolio', 'rose'),
				'not_found' =>  esc_html__('No Portfolio found', 'rose'),
				'not_found_in_trash' => esc_html__('No Portfolio found in Trash', 'rose'),
				'parent_item_colon' => ''
			);

			$portfolioLink = get_option('wiloke_portfolio_permalink');

			if ( $portfolioLink == 'category-portfolio' )
			{
				$portfolioLink = '%portfolio-category%';
			}elseif ($portfolioLink == 'without-posttype'){
				$portfolioLink = '%portfolio-postname%';
			}else{
				$portfolioLink = 'portfolio';
			}

	      	$args = array(
		        'labels' => $labels,
		        'public' => true,
		        'publicly_queryable' => true,
		        'show_ui' => true,
		        'query_var' => true,
		        'rewrite' => array('with_front'=>false, 'slug'=>$portfolioLink),
		        'has_archive' => true,
		        'capability_type' => 'post',
		        'show_in_nav_menus' => false,
		        'hierarchical' => true,
		        'exclude_from_search' => true,
		        'menu_position' => 21,
		        'menu_icon' => 'dashicons-portfolio',
		        'supports' => array('title','editor','thumbnail', 'page-attributes')
	      	);

	      	register_post_type('portfolio', $args);

	      	$labels = array(
		        'name' => 'Categories',
		        'singular' => 'Categories',
		        'menu_name' => 'Categories'
	      	);

	      	$args_taxonomy = array(
		        'labels'                     => $labels,
		        'hierarchical'               => true,
		        'public'                     => true,
		        'show_ui'                    => true,
		        'show_admin_column'          => true,
		        'show_in_nav_menus'          => false,
		        'show_tagcloud'              => false,
	      	);

	      	register_taxonomy('category-portfolio', 'portfolio', $args_taxonomy);
	    }

	    public function rose_vc_map() {
			$cats = $this->rose_terms();

			vc_map( array(
				'name'			=> esc_html__('Rose Portfolio', 'rose'),
				'base'			=> 'rose_shortcode_portfolio',
				'category'		=> esc_html__('Rose', 'rose'),
				'admin_enqueue_js' => array(ROSE_ADMIN_CORE_DIR .'visual/assets/js/script.js'),
				'params'		=> array(

					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Style', 'rose' ),
						'param_name' => 'style',
						'std'			=> 'style1',
						'value' => array(
							esc_html__( 'Modern', 'rose' ) => 'style1',
							esc_html__( 'Grid', 'rose' ) => 'style2',
							esc_html__( 'Masonry', 'rose' ) => 'style3',
						),
						'description' => esc_html__( 'Option select style portfolio.', 'rose' ),
					),

					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Caption Position', 'rose' ),
						'param_name' => 'caption_pos',
						'std'			=> 'caption-middle',
						'value' => array(
							esc_html__( 'Middle', 'rose' ) => 'caption-middle',
							esc_html__( 'Bottom', 'rose' ) => 'caption-bottom',
						),
						'description' => esc_html__( 'Choose caption position middle or bottom.', 'rose' ),
					),

					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Categories Position', 'rose' ),
						'param_name' => 'category_pos',
						'std'			=> 'bottom',
						'value' => array(
							esc_html__( 'Under Title', 'rose' ) => 'bottom',
							esc_html__( 'Above Title', 'rose' ) => 'top',
						),
						'description' => esc_html__( 'Choose categories position top or bottom title.', 'rose' ),
					),

					array(
						'type' 			=> 'wiloke_get_list_of_terms',
						'heading' 		=> esc_html__( 'Categories Filter', 'rose' ),
						'param_name' 	=> 'category_in',
						'is_multiple'	=> true,
						'taxonomy'      => 'category-portfolio',
						'value'			=> $cats,
						'description'	=> esc_html__('Display post in category.', 'rose')
					),
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Option', 'rose' ),
						'param_name' => 'options',
						'value'		=> array(
							esc_html__( 'Hide Filter', 'rose' ) => 'filter',
							esc_html__( 'Hide Category', 'rose' ) => 'category',
							esc_html__( 'Hide Favorite', 'rose' ) => 'favorite',
							esc_html__( 'Hide Line', 'rose' ) => 'line',
							esc_html__( 'Hide Arrow', 'rose' ) => 'arrow',
						),
						
					),

					array(
						'type'			=> 'textfield',
						'heading'		=> esc_html__('Show Posts', 'rose'),
						'param_name'	=> 'post_number',
						'std'			=> 8,
						'value'			=> 8,
						'description'	=> esc_html__('Show the post on the page.')
					),

					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Hover Effect', 'rose' ),
						'param_name' => 'effect',
						'std'			=> 'effet-fade',
						'value' => array(
							esc_html__( 'Fade', 'rose' ) => 'effet-fade',
							esc_html__( 'Push Top', 'rose' ) => 'effet-push-top',
							esc_html__( 'Push Right', 'rose' ) => 'effet-push-right',
							esc_html__( 'Push Bottom', 'rose' ) => 'effet-push-bottom',
							esc_html__( 'Push Left', 'rose' ) => 'effet-push-left',
							esc_html__( 'Move Top', 'rose' ) => 'effet-move-top',
							esc_html__( 'Move Right', 'rose' ) => 'effet-move-right',
							esc_html__( 'Move Bottom', 'rose' ) => 'effet-move-bottom',
							esc_html__( 'Move Left', 'rose' ) => 'effet-move-left',
							esc_html__( 'Classic', 'rose' ) => 'effet-classic',
							esc_html__( 'Zoom In', 'rose' ) => 'effet-zoom-in',
							esc_html__( 'Flip Y', 'rose' ) => 'effet-flip-y',
							esc_html__( 'Flip X', 'rose' ) => 'effet-flip-x',
							esc_html__( 'Slide Top', 'rose' ) => 'effet-slide-top',
							esc_html__( 'Slide Right', 'rose' ) => 'effet-slide-right',
							esc_html__( 'Slide Bottom', 'rose' ) => 'effet-slide-bottom',
							esc_html__( 'Slide Left', 'rose' ) => 'effet-slide-left',
						),
						'dependency' => array(
							'element' => 'caption_pos',
							'value' => array('caption-middle'),
						),
						'description' => esc_html__( 'Select the hover effect. The default is fade.', 'rose' ),
					),

					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Column Lager', 'rose' ),
						'param_name' => 'col_lg',
						'std'			=> '3',
						'value' => array(
							esc_html__( '1 Column', 'rose' ) => '1',
							esc_html__( '2 Column', 'rose' ) => '2',
							esc_html__( '3 Column', 'rose' ) => '3',
							esc_html__( '4 Column', 'rose' ) => '4',
							esc_html__( '5 Column', 'rose' ) => '5',
							esc_html__( '6 Column', 'rose' ) => '6',
						),
						'dependency' => array(
							'element' => 'style',
							'value' => array('style2', 'style3'),
						),
						'description' => esc_html__( 'Large devices desktops (≥1200px).', 'rose' ),
					),

					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Column Medium', 'rose' ),
						'param_name' => 'col_md',
						'std'			=> '3',
						'value' => array(
							esc_html__( '1 Column', 'rose' ) => '1',
							esc_html__( '2 Column', 'rose' ) => '2',
							esc_html__( '3 Column', 'rose' ) => '3',
							esc_html__( '4 Column', 'rose' ) => '4',
							esc_html__( '5 Column', 'rose' ) => '5',
							esc_html__( '6 Column', 'rose' ) => '6',
						),
						'dependency' => array(
							'element' => 'style',
							'value' => array('style2', 'style3'),
						),
						'description' => esc_html__( 'Medium devices desktops (≥992px).', 'rose' ),
					),

					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Column Small', 'rose' ),
						'param_name' => 'col_sm',
						'std'			=> '2',
						'value' => array(
							esc_html__( '1 Column', 'rose' ) => '1',
							esc_html__( '2 Column', 'rose' ) => '2',
							esc_html__( '3 Column', 'rose' ) => '3',
							esc_html__( '4 Column', 'rose' ) => '4',
							esc_html__( '5 Column', 'rose' ) => '5',
							esc_html__( '6 Column', 'rose' ) => '6',
						),
						'dependency' => array(
							'element' => 'style',
							'value' => array('style2', 'style3'),
						),
						'description' => esc_html__( 'Small devices tablets (≥768px).', 'rose' ),
					),

					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Column Extra Small', 'rose' ),
						'param_name' => 'col_xs',
						'std'			=> '1',
						'value' => array(
							esc_html__( '1 Column', 'rose' ) => '1',
							esc_html__( '2 Column', 'rose' ) => '2',
							esc_html__( '3 Column', 'rose' ) => '3',
							esc_html__( '4 Column', 'rose' ) => '4',
							esc_html__( '5 Column', 'rose' ) => '5',
							esc_html__( '6 Column', 'rose' ) => '6',
						),
						'dependency' => array(
							'element' => 'style',
							'value' => array('style2', 'style3'),
						),
						'description' => esc_html__( 'Extra small devices phones (<768px).', 'rose' ),
					),

					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Spacing Vertical', 'rose' ),
						'param_name' => 'vertical',
						'std'			=> '0',
						'value' => array(
							esc_html__( 'No Vertical', 'rose' ) => '0',
							esc_html__( '5px', 'rose' ) => '5',
							esc_html__( '10px', 'rose' ) => '10',
							esc_html__( '15px', 'rose' ) => '15',
							esc_html__( '20px', 'rose' ) => '20',
							esc_html__( '25px', 'rose' ) => '25',
							esc_html__( '30px', 'rose' ) => '30',
						),
						'dependency' => array(
							'element' => 'style',
							'value' => array('style2', 'style3'),
						),
						'description' => esc_html__( 'Spacing left right. Default no spacing.', 'rose' ),
					),

					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Spacing Horizontal', 'rose' ),
						'param_name' => 'horizontal',
						'std'			=> '0',
						'value' => array(
							esc_html__( 'No Horizontal', 'rose' ) 	=> '0',
							esc_html__( '5px', 'rose' ) 			=> '5',
							esc_html__( '10px', 'rose' ) 			=> '10',
							esc_html__( '15px', 'rose' ) 			=> '15',
							esc_html__( '20px', 'rose' ) 			=> '20',
							esc_html__( '25px', 'rose' ) 			=> '25',
							esc_html__( '30px', 'rose' ) 			=> '30',
						),
						'dependency' => array(
							'element' => 'style',
							'value' => array('style2', 'style3'),
						),
						'description' => esc_html__( 'Spacing top bottom. Default no spacing.', 'rose' ),
					),

					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Pagination', 'rose' ),
						'param_name' => 'paging',
						'std'			=> 'scroll',
						'value' => array(
							esc_html__( 'Infinite Scroll', 'rose' ) 	=> 'scroll',
							esc_html__( 'Load More Button', 'rose' ) 			=> 'click',
							esc_html__( 'No Pagination', 'rose' ) 		=> 'none',
						)
					),

					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Order', 'rose' ),
						'param_name' => 'order',
						'std'			=> 'DESC',
						'value' => array(
							esc_html__( 'Descending', 'rose' ) 	=> 'DESC',
							esc_html__( 'Ascending', 'rose' ) 		=> 'ASC',
						)
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

		public function shortcode_render($attr, $content) {

			extract(shortcode_atts( array(
				'style' 			=> 'style1',
				'post_number'		=> '8',
				'category_in'		=> '',
				'caption_pos'		=> 'caption-middle',
				'effect'			=> 'effet-fade',
				'col_lg'			=> '3',
				'col_md'			=> '3',
				'col_sm'			=> '2',
				'col_xs'			=> '1',
				'vertical'			=> '0',
				'horizontal'		=> '0',
				'paging'			=> 'scroll',
				'order'				=> 'DESC',
				'orderby'			=> 'date',
				'category_pos'		=> 'bottom',
				'options'			=> '',
				'post__not_in'		=> ''
			), $attr )); 

			$attribute = array();

			$attribute[] = (stripos($options, 'line') !== false) ? 'data-line="true"' : '';
			$attribute[] = (stripos($options, 'favorite') !== false) ? 'data-favorite="true"' : '';
			$attribute[] = (stripos($options, 'category') !== false) ? 'data-category="true"' : '';
			$attribute[] = (stripos($options, 'arrow') !== false) ? 'data-arrow="true"' : '';

			if($style == 'style1') {
				$attribute[] = 'data-vertical="0"';
				$attribute[] = 'data-horizontal="0"';
			} else {
				$attribute[] = 'data-vertical="'. esc_attr($vertical) .'"';
				$attribute[] = 'data-horizontal="'. esc_attr($horizontal) .'"';
				$attribute[] = 'data-col-lg="'. esc_attr($col_lg) .'"';
				$attribute[] = 'data-col-md="'. esc_attr($col_md) .'"';
				$attribute[] = 'data-col-sm="'. esc_attr($col_sm) .'"';
				$attribute[] = 'data-col-xs="'. esc_attr($col_xs) .'"';
			}

			if( $caption_pos != 'caption-middle') {
				$effect = '';
			}

			$class= 'portfolio-isotop grid '. $style .' '. $effect .' '. $caption_pos;

			$args = array( 
				'style' 			=> $style, 
				'post_number'		=> $post_number,
				'category_in'		=> $category_in,
				'post__not_in'		=> $post__not_in,
				'order' 			=> $order, 
				'orderby' 			=> $orderby,
				'caption_pos'		=> $caption_pos,
				'category_pos'		=> $category_pos
			);

			if ( empty($category_in) )
			{
				return false;
			} 

			$aCatIds = explode(',', $args['category_in']);

			$query_args = array(
				'post_type' 			=> 'portfolio',
				'post_status' 			=> 'publish',
				'posts_per_page' 		=> $args['post_number'],
				'ignore_sticky_posts'	=> 1,
				'order'					=> $args['order'],
				'orderby'				=> $args['orderby'],
				'tax_query'				=> array(
					array(
	  					'taxonomy' 	=> 'category-portfolio',
	  					'field' 	=> 'term_id', 
	  					'terms' 	=> $aCatIds
  					)
				)
	  		);

	  		$wilokeQuery = new WP_Query($query_args);

			$portfolioWrapId = uniqid('portfolio_');

			$term_count = array();
			$totalCount = 0;
			
			$aCatIds = explode(',', $args['category_in']);

			foreach ($aCatIds as $term_id) {

				$aTerms = get_term($term_id, 'category-portfolio', OBJECT, 'count');
				if ( !empty($aTerms) && !is_wp_error($aTerms) )
				{
					$term_count[$term_id] = $aTerms->count;
				}
			}

			$term_count['all'] = $wilokeQuery->found_posts;
			$totalCount		   = $term_count['all'];
			$term_count = json_encode($term_count);
			

			$param = json_encode($args); 

			ob_start(); ?>
	
			<div id="<?php echo esc_attr($portfolioWrapId); ?>" class="portfolio-wrap" data-count="<?php echo esc_attr($term_count); ?>">

				<?php if( stripos($options, 'filter') === false ) { $this->filter($category_in, $portfolioWrapId); } ?>

				<div class="<?php echo $class ?>" <?php echo implode(' ', $attribute) ?>>

					<div class="grid-size"></div>

					<?php $this->loop($args, $wilokeQuery); ?>
		
				</div>

				<?php if($paging !='hidden' || ( absint($args['post_number']) >= absint($totalCount) ) ): ?>

					<?php $key = rand(1, 1000000); ?>

					<div class="loadmore text-center <?php echo esc_attr($paging); ?> mt-30">
						<a href="#" class="button" data-parentid="<?php echo esc_attr($portfolioWrapId); ?>" data-id="rose_<?php echo esc_attr($key); ?>"><?php echo esc_html__('Load more', 'rose'); ?></a>								
						<script>
							window['rose_<?php echo esc_js($key); ?>']= <?php echo $param; ?>;
						</script>
					</div>
				<?php endif; ?>
				
			</div>
			
			<?php $output = ob_get_clean();

			return $output;
		}

		public function filter( $category = '', $parentid ) { 
			if( isset($category) && !empty($category) ) {
				$args = array(
					'hide_empty' => true, 
					'parent' => 0,
					'include'	=> array_map('intval', explode(',', $category))
				);

	  			$terms = get_terms('category-portfolio', $args); 

	  			ob_start();

				if ($terms) : ?>
					
					<div class="portfolio-filter mb-40">

						<div class="toggle-filter"><span></span></div>

				    	<ul class="ul-filter">
			    			<li class="active"><a href="#" data-filter="*" data-show-button="1" class="all">All</a></li>
				  			<?php foreach ($terms  as $term ) : ?>
			  					<li><a href="#" title="<?php echo esc_attr($term->name) ?>" data-filter=".rose_portfolio_category_<?php echo esc_attr($term->term_id); ?>" data-id="<?php echo esc_attr($term->term_id); ?>" data-post="<?php echo esc_attr($term->count); ?>" ><?php echo esc_html($term->name); ?></a></li>
							<?php endforeach; ?>

						</ul>
					</div>

		  		<?php endif;

		  		$output = ob_get_clean();
		  		echo $output;
	  		}

	  	}

		public function ajax_loadmore() {
			
			if( isset($_GET['param'] )) {
		      	$args = stripslashes(html_entity_decode( $_GET['param']) );
		      	$args = json_decode($args, true);
		      	$args['style'] = isset($args['style']) ? $args['style'] : 'style1';
		      	$args['post_number'] = isset($args['post_number']) ? $args['post_number'] : 8;
		      	$args['order'] = isset($args['order']) ? $args['order'] : 'DESC';
		      	$args['orderby'] = isset($args['orderby']) ? $args['orderby'] : 'date';
		      	$args['post__not_in'] = isset($args['post__not_in']) ? $args['post__not_in'] : '';
		      	$args['category_in'] = isset($args['category_in']) ? $args['category_in'] : array();
		      	if( isset($args['category_filter']) ) { $args['category_in'] = $args['category_filter']; }

				ob_start();

				$this->loop($args);
				$result['content'] = ob_get_clean();

				echo json_encode($result);
				wp_die();
			}
		}

		public function loop( $args= array(), $query=null ) {

			if(isset($args['category_in']) && !empty($args['category_in'])) {
				$args['category_in'] =  array_map('intval', explode(',', $args['category_in']) );
			} else {
				return;
			}

			$query_args = array(
				'post_type' 			=> 'portfolio',
				'post_status' 			=> 'publish',
				'posts_per_page' 		=> $args['post_number'],
				'ignore_sticky_posts'	=> 1,
				'order'					=> $args['order'],
				'orderby'				=> $args['orderby'],
				'tax_query'				=> array(
					array(
	  					'taxonomy' 	=> 'category-portfolio',
	  					'field' 	=> 'term_id', 
	  					'terms' 	=> $args['category_in']
  					)
				)
	  		);

			if( isset($args['post__not_in']) && !empty($args['post__not_in']) ) {
				$query_args['post__not_in'] = array_map('intval', explode(',', $args['post__not_in']));
			}

			if ( empty($query) )
			{
	  			$query = new WP_Query($query_args);
	  		}
	  				
	  		$attr = array( 'style' => $args['style'], 'caption_pos' => $args['caption_pos'], 'category_pos' => $args['category_pos']  );

	  		if( $query->have_posts() ) {
	  			$index = 0;
		  		while ($query->have_posts()) : $query->the_post();
		  			$attr['index'] = $index;
		  			$this->content($attr);
		  			$index++;
		  		endwhile;
			}

			wp_reset_postdata(); 
		}

		public function content($args = array()) {
			global $post;
			global $rose_option;
			$wow = ( isset($rose_option['portfolio_animation']) && !empty($rose_option['portfolio_animation']) ) ? 'wow fadeInUp' : '';
			$category = $this->get_category($post->ID, 'category-portfolio');
			$slug = isset($category['term_id']) ? 'rose_portfolio_category_' . implode(' rose_portfolio_category_', $category['term_id']) : '';
			$name = isset($category['name']) ? implode(' & ', $category['name']) : '';

			$class = $this->index_class($args['index']);
			$delay = absint($args['index']) * 0.15;
			if( $args['style'] != 'style1' ) { $class = ''; }
			ob_start(); ?>

			<div class="grid-item <?php echo esc_attr($slug); ?> <?php echo $class; ?>" data-id="<?php the_ID(); ?>">
			    <div class="portfolio-item <?php echo esc_attr($wow) ?>" data-wow-delay="<?php echo esc_attr($delay) ?>s">

			        <a href="<?php the_permalink() ?>">

						<?php if($args['caption_pos'] == 'caption-top') : ?>
				            <div class="caption">
				                <div class="tb">
				                    <div class="tb-cell">
		                        		<?php if($args['category_pos'] == 'bottom') : ?>
			                        		<h2><?php the_title(); ?></h2>
			                        		<span class="hr"></span>
			                        		<span class="cat"><?php echo esc_html($name); ?></span>
		                        		<?php else : ?>
		                        			<span class="cat"><?php echo esc_html($name); ?></span>
			                        		<span class="hr"></span>
			                        		<h2><?php the_title(); ?></h2>
		                        		<?php endif; ?>
		                        		<?php if($args['caption_pos'] != 'caption-middle') : ?>
						        			<span class="arrow"><i class="fa fa-angle-right"></i></span>
						        		<?php endif; ?>
				                    </div>
				                </div>
				            </div>
						<?php endif; ?>

			            <div class="img">
			                <?php if( has_post_thumbnail() ) { the_post_thumbnail(array(570, 570)); } ?>

			                <?php if($args['caption_pos'] != 'caption-middle') : ?>
								<span class="heart" data-id="<?php the_ID() ?>">
					            	<?php $this->favorite($post->ID); ?>
					        	</span>
				        	<?php endif; ?>

			            </div>

						<?php if($args['caption_pos'] != 'caption-top') : ?>
				            <div class="caption">
				                <div class="tb">
				                    <div class="tb-cell">
				                    	<?php if($args['category_pos'] == 'bottom') : ?>
			                        		<h2><?php the_title(); ?></h2>
			                        		<span class="hr"></span>
			                        		<span class="cat"><?php echo esc_html($name); ?></span>
		                        		<?php else : ?>
		                        			<span class="cat"><?php echo esc_html($name); ?></span>
			                        		<span class="hr"></span>
			                        		<h2><?php the_title(); ?></h2>
		                        		<?php endif; ?>

		                        		<?php if($args['caption_pos'] == 'caption-middle') : ?>
											<span class="heart" data-id="<?php the_ID() ?>">
								            	<?php $this->favorite($post->ID); ?>
								        	</span>
							        	<?php endif; ?>

						        		<?php if($args['caption_pos'] != 'caption-middle') : ?>
						        			<span class="arrow"><i class="fa fa-angle-right"></i></span>
						        		<?php endif; ?>
				                    </div>
				                </div>
				            </div>
				            
						<?php endif; ?>
			        </a>
			    </div>
			</div>

			<?php $output = ob_get_clean();

			echo $output;
		}

		public function index_class($index) {
			$class = '';
			switch ($index) {
				case 0:
				case 6:
					$class = 'squaresx2';
					break;
				case 3:
					$class = 'rec-hor';
					break;
				case 4: 
					$class = 'rec-ver';
					break;
			}

			return $class;
		}

		public function get_category($post_id, $type) {
			$terms = get_the_terms( $post_id, $type );
			$att =  array(
				'name'	=> array(),
				'slug'	=> array()
			);

		    if ( $terms && !is_wp_error( $terms ) ) {
		        foreach ( $terms as $term ) {
	        		$att['name'][].= $term->name; 
	        		$att['slug'][]= $term->slug;
	        		$att['term_id'][]= $term->term_id;
		        }
		    }

		    return $att;
		}

		public function favorite($post_id) { 
	  		$count = 0;
	  		$class = 'fa-heart-o';
	  		$ip = $this->IpAdress();
	  		$favorite = get_post_meta($post_id, 'favorite', true); 
	  		if( isset($favorite) && !empty($favorite) ) {
	  			$count = count($favorite);
	  			if( in_array($ip, $favorite) ) {
	  				$class = 'fa-heart';
	  			}
	  		} 
	  		ob_start(); ?>
        	<i class="fa <?php echo esc_attr($class); ?>"></i>
        	<?php if($count > 0) :  ?>
        		<span><?php echo esc_html($count); ?></span>
        	<?php endif;

        	$output = ob_get_clean();
			echo $output;
	  	}

	  	public function favorite_update( $post_id ) {

	  		$favorite = get_post_meta($post_id, 'favorite', true); 
	  		$ip = $this->IpAdress();
	  		
	  		if( is_array($favorite) && in_array($ip, $favorite) ) {
	  			$index = array_search($ip, $favorite);
			    unset($favorite[$index]);
	  		} else {
	  			$favorite[] = $ip;
	  		}
	  		update_post_meta($post_id, 'favorite', $favorite);
	  	}

	  	public  function ajax_like() {
	  		if($_GET['post_id']) {
				$post_id = $_GET['post_id'];
				$this->favorite_update($post_id);
				ob_start();
				$this->favorite($post_id);
				$result['content'] = ob_get_clean();
		  		echo json_encode($result);
				wp_die();
			}
	  	}

	  	public function rose_terms() {
	  		$list = array();
	  		$terms = get_terms('category-portfolio', 'hide_empty=true');

	  		if( !is_wp_error($terms) ) {
	  			foreach ($terms as $term) {
	  				$list[$term->name] = $term->term_id;
	  			}
	  		}

	  		return $list;
	  	}

		// Address Client
		public function IpAdress() {

			$ip = '';
			if( !empty( $_SERVER['HTTP_CLIENT_IP'] ) ){

		      	$ip = $_SERVER['HTTP_CLIENT_IP'];

		    } elseif ( !empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ){

		      	$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];

		    } else {
		      	$ip = $_SERVER['REMOTE_ADDR'];
		    }

		    return $ip;
		}

	  	public function enqueued() {

	  		if( !wp_script_is('sidebar-sticky', 'enqueued') ) {
		    	wp_register_script('sidebar-sticky', ROSE_PORTFOLIO_URL .'assets/js/sidebar-sticky.js', array(), '', true);
		    	wp_enqueue_script('sidebar-sticky');
		    }

	  		if( !wp_script_is('jquery-waypoints', 'enqueued') ) {
		    	wp_register_script('jquery-waypoints', ROSE_PORTFOLIO_URL .'assets/js/jquery.waypoints.min.js', array(), '4.0.0', true);
		    	wp_enqueue_script('jquery-waypoints');
		    }

		    

		    if( !wp_script_is('rose-js-portfolio', 'enqueued') ) {
		    	wp_register_script('rose-js-portfolio', ROSE_PORTFOLIO_URL .'assets/js/rose.portfolio.js', array(), '1.0', true);
			 	wp_enqueue_script('rose-js-portfolio');
		    }
	  	}
	}

	new rose_plugin_portfolio();
}