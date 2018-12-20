<?php
/**
 * Create by Minh Minh
 * Team Wiloke
 * URI: wiloke.net
 */
class piPostsListing extends piWilokeWidgets
{
    public $aDef = array('title'=>'', 'number_of_posts'=>4, 'display'=>'latest_posts');
    public function __construct()
    {
        parent::__construct('pi_postslisting', parent::PI_PREFIX . 'Posts Listing', array('classname'=>'postslisting'));
        add_filter('the_content', array($this, 'pi_post_views_count'), 10, 1);
    }

    public function form($aInstance)
    {
        $aInstance = wp_parse_args($aInstance, $this->aDef);
        $this->pi_text_field( 'Title', $this->get_field_id('title'), $this->get_field_name('title'), $aInstance['title']);
        $this->pi_text_field( 'Number of posts', $this->get_field_id('number_of_posts'), $this->get_field_name('number_of_posts'), $aInstance['number_of_posts']);
        $this->pi_select_field( 'Display', $this->get_field_id('display'), $this->get_field_name('display'), array('latest_posts'=>'Latest posts', 'popular_posts'=>'Popular Posts'), $aInstance['display']);
    }

    public function update($aNewinstance, $aOldinstance)
    {
        $aInstance = $aOldinstance;
        foreach ( $aNewinstance as $key => $val )
        {
            if ( $key == 'number_of_posts' )
            {
                $aInstance[$key] = (int)$val;
            }else{
                $aInstance[$key] = strip_tags($val);
            }
        }
        return $aInstance;
    }

    public function pi_post_views_count($content)
    {
        global $post;
        if ( is_single($post->ID) )
        {
            $visted = get_post_meta($post->ID, 'pi_post_views_count', true);

            if ( $visted )
            {
                $visted = (int)$visted + 1;
            }else{
                $visted = 1;
            }

            update_post_meta($post->ID, 'pi_post_views_count', $visted);
        }
        return $content;
    }

    public function widget($atts, $aInstance)
    {
        $aInstance = wp_parse_args($aInstance, $this->aDef);
        $args = array('post_type'=>'post', 'post_status'=>'publish', 'posts_per_page'=>$aInstance['number_of_posts'], 'ignore_sticky_posts'=>1);

        if ( $aInstance['display'] == 'popular_posts' )
        {
            $args['meta_key']   = 'pi_post_views_count';
            $args['orderby']    = 'meta_value_num';
            $args['order']      = 'DESC';
        }

        $query = new WP_Query($args);

        print $atts['before_widget'];

        if ( !empty($aInstance['title']) )
        {
            print $atts['before_title'] . esc_html($aInstance['title']) . $atts['after_title'];
        }

        echo '<div class="widget-list">';
            if ( $query->have_posts() ) :
                while ( $query->have_posts() ) : $query->the_post();
                    $link = get_permalink($query->post->ID);
                    ?>
                    <div class="item">
                        <div class="item-image">
                            <div class="image-cover">
                                <?php if ( has_post_thumbnail($query->post->ID) ) : ?>
                                <a href="<?php echo esc_url($link); ?>">
                                    <?php echo get_the_post_thumbnail($query->post->ID, 'pi-postlisting'); ?>
                                </a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="item-content">
                            <h3 class="item-title" data-number-line="2">
                                <a href="<?php echo esc_url($link); ?>"><?php echo get_the_title($query->post->ID); ?></a>
                            </h3>
                            <span class="item-meta"><?php echo $this->pi_get_the_date($query->post->ID); ?></span>
                        </div>
                    </div>
                    <?php
                endwhile;
            else :
                echo '<p>'.__('There are no posts yet', 'pi').'</p>';
            endif;wp_reset_postdata();
        echo '</div>';

        print $atts['after_widget'];
    }
}