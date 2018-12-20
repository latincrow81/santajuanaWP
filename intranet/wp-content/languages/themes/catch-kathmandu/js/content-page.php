<?php
/**
 * The template for displaying content in the page.php template
 *
 * @package Catch Themes
 * @subpackage Catch Kathmandu
 * @since Catch Kathmandu 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php if ( function_exists( 'catchkathmandu_content_image' ) ) : catchkathmandu_content_image(); endif; ?>
    
    <div class="entry-container">
    
		<header class="entry-header" style="text-align:center;">
    		<h1 class="entry-title"><?php the_title(); ?></h1>
		</header><!-- .entry-header -->

		<div class="entry-content">
        	<?php the_content(); ?>
         	<?php wp_link_pages( array( 
				'before'		=> '<div class="page-link"><span class="pages">' . __( 'Pages:', 'catchkathmandu' ) . '</span>',
				'after'			=> '</div>',
				'link_before' 	=> '<span>',
				'link_after'   	=> '</span>',
			) ); 
			?>
     	</div><!-- .entry-content -->
        
        <footer class="entry-meta">          
            <?php edit_post_link( __( 'Edit', 'catchkathmandu' ), '<span class="edit-link">', '</span>' ); ?>        
        </footer><!-- .entry-meta -->
        
  	</div><!-- .entry-container -->
    
</article><!-- #post-<?php the_ID(); ?> -->