<?php
/*
Plugin Name: Wiloke Post Format UI
Plugin URI: http://wiloke.net
Description: Wiloke Post Format UI
Version: 1.0
Author: Minhminh - Wiloke Team
Author URI: http://wiloke.net
*/
define('BASE_URL',  trailingslashit(plugins_url('', __FILE__)) );
define('WILOKE_POST_FORMAT_VERTIONS', '1.0');

if (!class_exists('wiloke_post_format')) {

    class wiloke_post_format {

        public $post_meta;
        public $post_format;
        
        public function __construct() {
            add_action('add_meta_boxes', array($this, 'wiloke_add_meta_boxes'));
            add_shortcode('wiloke_post_format_shortcode', array($this, 'wiloke_post_format_shortcode'));
            add_action('save_post', array($this, 'wiloke_save_post'));
            add_action('wp_enqueue_scripts', array($this, 'wiloke_post_format_ui_fe_scripts'));
        }

        public function wiloke_post_format_ui_fe_scripts() {

            if ( !wp_style_is('owl-carousel', 'enqueued') ) {
                wp_register_style('owl-carousel', BASE_URL . 'assets/css/owl.carousel.css', array(), '1.0');
                wp_enqueue_style('owl-carousel');
                wp_register_script('owl-carousel', BASE_URL . 'assets/js/owl.carousel.min.js', array(), '1.0', true);
                wp_enqueue_script('owl-carousel');
            }

            if ( !wp_script_is('justifiedGallery', 'enqueued') ) {
                wp_register_style('justifiedgallery', BASE_URL . 'assets/css/justifiedGallery.min.css', array(), '1.0');
                wp_enqueue_style('justifiedgallery');

                wp_register_script('justifiedgallery', BASE_URL . 'assets/js/jquery.justified-gallery.min.js', array('jquery'), '1.0', true);
                wp_enqueue_script('justifiedgallery');
            }

            if ( !wp_script_is('magnific-popup', 'enqueued') ) {
                wp_register_style('magnific-popup', BASE_URL . 'assets/css/magnific-popup.css', array(), '');
                wp_enqueue_style('magnific-popup');

                wp_register_script('magnific-popup', BASE_URL . 'assets/js/jquery.magnific-popup.min.js', array('jquery'), '', true);
                wp_enqueue_script('magnific-popup');
            }
            
            if ( !wp_script_is('pi_post_format_ui', 'enqueued') ) {
                wp_register_script('pi_post_format_ui', BASE_URL . 'source/js/script.js', array('jquery'), '1.0', true);
                wp_enqueue_script('pi_post_format_ui');   
            }
        }

        public function wiloke_post_format_shortcode() { 

            global $post;
            $format = get_post_format($post->ID);
            $post_meta = get_post_meta($post->ID, 'wiloke_post_formats'); 
            
            if( isset($post_meta[0]) ) {

                $post_meta = $post_meta[0];

                switch ($format) {
                    case 'aside':
                        $this->wiloke_render_aside($post_meta[$format]);
                        break;
                    case 'chat':
                        $this->wiloke_render_chat($post_meta[$format]);
                        break;
                    case 'gallery':
                        $this->wiloke_render_gallery($post_meta[$format]);
                        break;
                    case 'link':
                        $this->wiloke_render_link($post_meta[$format]);
                        break;
                    case 'image':
                        $this->wiloke_render_image($post_meta[$format]);
                        break;
                    case 'quote':
                        $this->wiloke_render_quote($post_meta[$format]);
                        break;
                    case 'status':
                        $this->wiloke_render_status($post_meta[$format]);
                        break;
                    case 'video':
                        $this->wiloke_render_video($post_meta[$format]);
                        break;
                    
                    case 'audio':
                        $this->wiloke_render_audio($post_meta[$format]);
                        break;
                }
            }
        }

        // Render Image Header of post single
        public function wiloke_render_image ($custom_format) {

            if ( isset($custom_format['id']) ) : 
                $src = wp_get_attachment_image_src($custom_format['id'], 'lager'); ?>

                <div class="image pi-magnific-popup" >
                    <a href="<?php echo esc_url($src[0]) ?>">
                        <img src="<?php echo esc_url($src[0]); ?>" alt="">
                    </a>
                </div>

            <?php  endif;
        }

        // Render Gallery header of post single
        public function wiloke_render_gallery ($custom_format) {
            $ids = explode(',', $custom_format['images']);
            $class = isset( $custom_format['style'] ) ? $custom_format['style'] : 'gallery';?>

            <div class="wiloke-<?php echo esc_attr($class); ?> pi-magnific-popup tiled-gallery-unresized">

                <?php foreach ( $ids as $id ) :
                    $attachment = get_post($id);
                    $caption    = $attachment->post_excerpt;
                    $src        = wp_get_attachment_image_src($id, 'lager'); ?>

                    <div class="item">

                        <a href="<?php echo esc_url($src[0]) ?>" data-caption="<?php echo esc_attr($caption); ?>">
                            <img src="<?php echo esc_url($src[0]) ?>" alt="<?php echo esc_attr($caption) ?>">
                        </a>

                        <?php if( isset($custom_format['caption']) && isset($caption) ) : ?>
                            <h4><?php echo esc_html($caption); ?></h4>
                        <?php endif; ?>

                    </div>

                <?php endforeach; ?>

            </div>

           <?php

        }
        
        // Render quote Header of post single
        public function wiloke_render_quote ($custom_format) {
            $content = $author = $url = '';
            global $post;

            if( isset($custom_format['content']) ) {
                $content = $custom_format['content'];
            }

            if( isset($custom_format['author']) ) {
                $author = $custom_format['author'];
            }

            if( isset($custom_format['url']) ) {
                $url = $custom_format['url'];
            } 

            $src = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ) ?>

            <div class="post-quote" style="background-image: url(<?php echo esc_url($src); ?>)">
                <blockquote>
                    <p><?php echo esc_html($content) ?></p>
                    <cite><a href="<?php echo esc_url($url) ?>" title="<?php echo esc_attr($author); ?>"><?php echo esc_html($author); ?></a></cite>
                </blockquote>
            </div>

            <?php
        }

        // Render video Header of post single
        public function wiloke_render_video ($custom_format) {

            if (!empty($custom_format) && !empty($custom_format['url'])) :

                $rex_video = $this->wiloke_parse_video($custom_format['url']); ?>

                <div class="video embed-responsive embed-responsive-16by9">

                    <?php switch ($rex_video['type']) {

                        case 'youtube':

                            $url     = '//www.youtube.com/embed/'.$rex_video['id']; ?>

                            <iframe src="<?php echo esc_url($url) ?>" class="embed-responsive-item"></iframe>

                            <?php  break;

                        case 'vimeo':

                            $url = '//player.vimeo.com/video/'.$rex_video['id'].'?title=0&amp;byline=0&amp;portrait=0'; ?>

                            <iframe class="embed-responsive-item" src="<?php echo esc_attr(esc_url($url)) ?>" class="embed-responsive-item"></iframe>

                            <?php break;

                        case 'self':

                            echo wp_kses($custom_format['url']);

                            break;
                    } ?>

                </div>

                <?php

            endif;

        }

        // Render Audio header of post single
        public function wiloke_render_audio ($custom_format) {

            if (!empty($custom_format) && !empty($custom_format['url'])) : ?>

                <div class="audio">

                    <?php if ( preg_match('/(iframe|object|embed)/', $custom_format['url']) ) {
                        echo wp_kses($custom_format['url'], array( 'iframe' => array('src'=>array() ), 'object' => array( 'src' => array() ), 'embed' => array( 'src'=>array() ) ) );
                    } else {
                      echo do_shortcode('[audio src="'.esc_url($custom_format['url']).'"]');
                    } ?>

                </div>

                <?php 

            endif;
          
        }

        // Render Link Header of post single
        public function wiloke_render_link($custom_format) {
            global $post;
            $url = $text = '';

            if( isset( $custom_format['url'] ) ) {
                $url = $custom_format['url'];
            }

            if(isset( $custom_format['caption'] ) ) {
                $text = $custom_format['caption'];
            } ?>

            <div class="post-link">
                <a href="<?php echo esc_url($url) ?>">
                    <span class="icon"><i class="fa fa-link"></i></span>
                    <h2 class="h5 entry-title"><?php the_title(); ?></h2>
                    <span><?php echo esc_html($text) ?></span>
                </a>
            </div>

            <?php
        }

        public function wiloke_parse_video ($url) {

            $type = $id = '';

            if( isset($url) && !empty($url) ) {

                if (strpos($url, 'youtube') > 0) {

                    $type = 'youtube';
                    preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $output_array);
                    $id = $output_array[1];

                } else if (strpos($url, 'vimeo') > 0) {

                    $type = 'vimeo';
                    preg_match('/(https?:\/\/)?(www\.)?(player\.)?vimeo\.com\/([a-z]*\/)*([0-9]{6,11})[?]?.*/', $url, $output_array);
                    $id = $output_array[5];

                }
            }

            if ( !empty($id) && !empty($type) ) {
                return array('type'=>$type, 'id'=>$id);
            } else {
                return array('type'=>'self', 'id'=>$id);
            }
        }

        /**
         * Change the post formats position
         * @author minhminh
         * @since 1.0 
         */
        public function wiloke_add_meta_boxes($post_type) {

            $support_post_type = post_type_supports($post_type, 'post-formats');
            $current_theme_support = current_theme_supports('post-formats');

            if ($support_post_type && $current_theme_support) {
                $this->enqueue_admin();
                add_action('edit_form_after_title', array($this, 'wiloke_post_format_config'), 10);
            }
        }

        function enqueue_admin() {
            wp_register_style('wiloke_post_format', BASE_URL .'admin/source/css/wiloke_post_format.css', array(), WILOKE_POST_FORMAT_VERTIONS, 'all');
            wp_enqueue_style('wiloke_post_format');

            wp_register_script('wiloke_post_format', BASE_URL .'admin/source/js/wiloke_post_format.js', array('jquery'), WILOKE_POST_FORMAT_VERTIONS);
            wp_enqueue_script('wiloke_post_format');    
        }


        /**
         * Post Formats Configuration
         * @author minhminh
         * @since 1.0
         */
        public function wiloke_post_format_config() {

            global $post;
            $support = get_theme_support('post-formats');
            
            if( isset( $support ) && is_array( $support[0] ) ) : 
                $support = $support[0];
                $post_meta = get_post_meta($post->ID, 'wiloke_post_formats');
                $this->post_format = get_post_format($post->ID);

                if( isset($post_meta[0]) ) {
                    $this->post_meta = $post_meta[0];
                }

                ob_start(); ?>
    
                <div class="wiloke-post-format-wrapper">

                    <?php 

                        require_once 'tabs/wiloke-controls-tabs.php';
                        foreach($support as $value) {
                            require_once 'tabs/wiloke-tab-' .$value .'.php';
                        } 
                    ?>

                </div>

                <?php $output = ob_get_clean();

                echo $output;

            endif;
        }

        public function wiloke_save_post($post_id) {
            
            if ( isset($_POST['wiloke_post_format']) ) {
                update_post_meta($post_id, "wiloke_post_formats", $_POST['wiloke_post_format']);
            }
        }
    }

    new wiloke_post_format();

}