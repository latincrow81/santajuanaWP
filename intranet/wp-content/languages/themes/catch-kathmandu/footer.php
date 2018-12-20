<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package Catch Themes
 * @subpackage Catch Kathmandu
 * @since Catch Kathmandu 1.0
 */
?>

	<?php 
    /** 
     * catchkathmandu_content_sidebar_end hook
     *
     * @hooked catchkathmandu_content_sidebar_wrap_end - 10
	 * @hooked catchkathmandu_third_sidebar - 15
     */
    do_action( 'catchkathmandu_content_sidebar_end' ); 
    ?>  

	</div><!-- #main .site-main -->
    
	<?php 
    /** 
     * catchkathmandu_after_main hook
     */
    do_action( 'catchkathmandu_after_main' ); 
    ?> 
    
	<footer id="colophon" role="contentinfo">
		<?php
        /** 
         * catchkathmandu_before_footer_sidebar hook
         */
        do_action( 'catchkathmandu_before_footer_sidebar' );    

		/* A sidebar in the footer? Yep. You can can customize
		 * your footer with three columns of widgets.
		 */
		get_sidebar( 'footer' ); 

		/** 
		 * catchkathmandu_after_footer_sidebar hook
		 */
		do_action( 'catchkathmandu_after_footer_sidebar' ); ?>   
           
        <div id="site-generator" class="container">
			<?php 
            /** 
             * catchkathmandu_before_site_info hook
             */
            do_action( 'catchkathmandu_before_site_info' ); ?>  
                    
        	<div class="site-info" style="text-align:center;">
            	<div class="copyright">Parque Comercial El Tesoro - Cra 25A No. 1A Sur 45 - Oficina 2222 Tel 321 2736 - Medellín, Colombia </div>
            	<?php 
				/** 
				 * catchkathmandu_site_info hook
				 *
				 * @hooked catchkathmandu_footer_content - 10
				 */
				//do_action( 'catchkathmandu_site_generator' ); ?> 
          	</div><!-- .site-info -->
            
			<?php 
            /** 
             * catchkathmandu_after_site_info hook
             */
            do_action( 'catchkathmandu_after_site_info' ); ?>              
       	</div><!-- #site-generator --> 
        
        <?php
        /** 
		 * catchkathmandu_after_site_generator hook
		 */
		do_action( 'catchkathmandu_after_site_generator' ); ?>  
               
	</footer><!-- #colophon .site-footer -->
    
    <?php 
    /** 
     * catchkathmandu_after_footer hook
	 *
     * @hooked catchkathmandu_scrollup - 10
     */
    do_action( 'catchkathmandu_after_footer' ); 
    ?> 
    
</div><!-- #page .hfeed .site -->

<?php 
/** 
 * catchkathmandu_after hook
 */
do_action( 'catchkathmandu_after' );

wp_footer(); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/bootstrap.min.js"></script>
<script type="text/javascript" src="http://masonry.desandro.com/masonry.pkgd.min.js"></script>
<script type="text/javascript">
	$('#myModal').modal(options);
</script>
<script type="text/javascript">
    $('#carousel-1').carousel({
        interval: false
    });
     $('#carousel-2').carousel({
        interval: false
    });
      $('#carousel-3').carousel({
        interval: false
    });
       $('#carousel-4').carousel({
        interval: false
    });
        $('#carousel-5').carousel({
        interval: false
    });
</script>
<script>
	// use jquery masonry
	var $container = $('#items');
    $container.masonry({
        itemSelector: '.box',
        isFitWidth: true
    });
</script>
</body>
</html>