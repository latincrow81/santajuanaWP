<?php
/**
 * The template for displaying all pages.
 *
 Template Name: New Index
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Catch Themes
 * @subpackage Catch Kathmandu
 * @since Catch Kathmandu 1.0
 */

get_header('custom'); ?>

		<div style="display:inline-block;">
            <a href="<?php echo get_site_url(); ?>/centro-comercial-carnaval/"> <img src="<?php echo get_template_directory_uri(); ?>/images/soledad.png" width="320"></a>
    	</div>
		<div style="display:inline-block;">
            <a href="<?php echo get_site_url(); ?>/class-suites/"> <img src="<?php echo get_template_directory_uri(); ?>/images/class.png" width="300"></a>
        </div>
        <div style="display:inline-block;">
            <a href="<?php echo get_site_url(); ?>/proyectos/"> <img src="<?php echo get_template_directory_uri(); ?>/images/proyectos.jpg" width="320"></a>
        </div>
        <div style="display:inline-block;">
            <a href="<?php echo get_site_url(); ?>/pague-su-factura/"> <img src="<?php echo get_template_directory_uri(); ?>/images/pagos-pse-wide.jpg" width="1020"></a>
        </div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>