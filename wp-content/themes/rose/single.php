<?php get_header(); ?>
	
	<?php $setting = rose_blog::rose_blog_setting(); ?>

	<?php rose_blog::rose_blog_hero(); ?>

	<section id="main" class="mb-100">
		<div class="container">
			<div class="row">

				<div class="<?php echo esc_attr($setting['class_content']) ?>">

					<div class="blog-single">
						
						<?php 
							if ( have_posts() ) :
								while ( have_posts() ) : the_post(); 
									get_template_part('content');
								endwhile;
							else:
								get_template_part('content-none');
							endif; 
						?>
						
					</div>

				</div>

				<?php if( $setting['class_sidebar'] != 'hidden' ) : ?>
					<div class="<?php echo esc_attr($setting['class_sidebar']) ?>">
						<?php get_template_part('sidebar'); ?>
					</div>
				<?php endif; ?>

			</div>
		</div>
	</section>

<?php get_footer(); ?>