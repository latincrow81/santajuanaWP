<?php

/**

 * The Header for our theme.

 *

 * Displays all of the <head> section and everything up till <div id="main">

 *

 * @package Catch Themes

 * @subpackage Catch Kathmandu

 * @since Catch Kathmandu 1.0

 */

?>

<!DOCTYPE html>

<!--[if IE 6]>

<html id="ie6" <?php language_attributes(); ?>>

<![endif]-->

<!--[if IE 7]>

<html id="ie7" <?php language_attributes(); ?>>

<![endif]-->

<!--[if IE 8]>

<html id="ie8" <?php language_attributes(); ?>>

<![endif]-->

<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->

<html <?php language_attributes(); ?>>

<!--<![endif]-->

<head>

	<meta charset="<?php bloginfo( 'charset' ); ?>" />

	<link rel="profile" href="http://gmpg.org/xfn/11" />

	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<!--[if lt IE 9]>

	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.min.js"></script>
    

	<![endif]-->
    
    <link href="<?php echo get_template_directory_uri(); ?>/css/bootstrap.min.css" rel="stylesheet">
<script src="http://tiberiusdesign.com/santa_juana/wp-content/themes/catch-kathmandu/responsive-menu.js" type="text/javascript"></script>
<?php wp_head(); ?>

</head>



<body <?php body_class(); ?>>



<?php 

/** 

 * catchkathmandu_before hook

 */

do_action( 'catchkathmandu_before' ); ?>



<div id="page" class="hfeed site">



	<?php 

    /** 

     * catchkathmandu_before_header hook

     */

    do_action( 'catchkathmandu_before_header' ); ?>

    

	<header id="masthead" role="banner">

    

    	<?php 

		/** 

		 * catchkathmandu_before_hgroup_wrap hook

		 *

		 * HOOKED_FUNCTION_NAME PRIORITY

		 *

		 * catchkathmandu_header_top 10

		 */

		do_action( 'catchkathmandu_before_hgroup_wrap' ); ?>

        

    	<div id="hgroup-wrap" class="container">

        	<div id="header-left">

		

			<div id="site-logo">

            	<a href="<?php echo get_site_url(); ?>" title="Santa Juana Inmobiliaria">

            		<img src="<?php echo get_site_url(); ?>/wp-content/uploads/2015/02/cropped-logo.png" width="250" alt="Santa Juana Inmobiliaria">

				</a>

			</div><!-- #site-logo -->  

		</div>

       		<?php 

			/** 

			 * catchkathmandu_hgroup_wrap hook

			 *

			 * HOOKED_FUNCTION_NAME PRIORITY

			 *

			 * catchkathmandu_header_image 10

			 * catchkathmandu_header_right 15

			 */

			do_action( 'catchkathmandu_hgroup_wrap' ); ?>

            
			<div id="menuResponsive" class="closed">
         	<div id="icon">MENÚ</div>
         	<div style="width:100%; clear:none;"></div>
         	<div id="drop">
         		<ul>
         			<li><a href="<?php bloginfo( 'home' ); ?>">Inicio</a></li>
         			<li><a>Conózcanos</a></li>
         			<li class="hijo"><a href="<?php bloginfo( 'home' ); ?>/quienes-somos/">Quiénes Somos</a></li>
         			<li class="hijo"><a href="<?php bloginfo( 'home' ); ?>/nuestra-historia/">Nuestra Historia</a></li>
         			<li><a href="<?php bloginfo( 'home' ); ?>/proyectos/">Proyectos</a></li>
         			<li><a>Servicio al Cliente</a></li>
         			<li class="hijo"><a href="<?php bloginfo( 'home' ); ?>/pague-su-factura/">Pague su Factura</a></li>
         			<li class="hijo"><a href="<?php bloginfo( 'home' ); ?>/contactenos/">Contáctenos</a></li>
         			<li><a href="<?php bloginfo( 'home' ); ?>/noticias/">Noticias</a></li>
         		</ul>
         	</div>
         </div>   

        </div><!-- #hgroup-wrap -->

        

        <?php 

		/** 

		 * catchkathmandu_after_hgroup_wrap hook

		 *

		 * HOOKED_FUNCTION_NAME PRIORITY

		 *

		 * catchkathmandu_featured_overall_image 10

		 * catchkathmandu_secondary_menu 20

		 * catchkathmandu_breadcrumb_display 30

		 */

		do_action( 'catchkathmandu_after_hgroup_wrap' ); ?>

        

	</header><!-- #masthead .site-header -->

    

	<?php 

    /** 

     * catchkathmandu_after_header hook

     */

    do_action( 'catchkathmandu_after_header' ); ?> 

        

	<?php 

    /** 

     * catchkathmandu_before_main hook

	 *

	 * HOOKED_FUNCTION_NAME PRIORITY

	 *

	 * catchkathmandu_slider_display 10

	 * catchkathmandu_homepage_headline 15

     */

    do_action( 'catchkathmandu_before_main' ); ?>

    

    <div id="main" class="container">

    

		<?php 

        /** 

         * catchkathmandu_main hook

         *

         * HOOKED_FUNCTION_NAME PRIORITY

         *

	 	 * catchkathmandu_homepage_featured_display 10

         */

        do_action( 'catchkathmandu_main' ); ?>

		

		<?php 

        /** 

         * catchkathmandu_content_sidebar_start hook

         *

         * HOOKED_FUNCTION_NAME PRIORITY

         *

	 	 * catchkathmandu_homepage_featured_display 10

         */

        do_action( 'catchkathmandu_content_sidebar_start' ); ?>        