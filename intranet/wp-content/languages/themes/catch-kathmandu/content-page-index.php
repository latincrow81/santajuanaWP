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

		<div class="entry-content" style="background-color:white; color:black; padding:15px;">
        	<?php the_content(); ?>
     	</div><!-- .entry-content -->
        
  	</div><!-- .entry-container -->
    
</article><!-- #post-<?php the_ID(); ?> -->