<?php
/**
 * Create by Minh Minh
 * Team Wiloke
 * URI: wiloke.net
 */

class piInstagram extends piWilokeWidgets
{
    public $aDef = array( 'title' =>'Instagram', 'user_id'=>'', 'number_of_photos' => 6, 'access_token' => '' );
    public function __construct()
    {
        $args = array('classname'=>'pi_instagram', 'description'=>'');
        parent::__construct("pi_instagram", parent::PI_PREFIX . 'Instagram Feed ', $args);
    }

    public function form($aInstance)
    {
        $aInstance = wp_parse_args( $aInstance, $this->aDef );

        $this->pi_text_field( __('Title', 'wiloke'), $this->get_field_id('title'), $this->get_field_name('title'), $aInstance['title']);
        $this->pi_text_field( __('User Id (*)', 'wiloke'), $this->get_field_id('user_id'), $this->get_field_name('user_id'), $aInstance['user_id']);
        $this->pi_text_field( __('Access Token (*)', 'wiloke'), $this->get_field_id('access_token'), $this->get_field_name('access_token'), $aInstance['access_token']);
        _e('<p><code>How to get User Id &amp; access token <a target="_blank" href="https://smashballoon.com/instagram-feed/token/">https://smashballoon.com/instagram-feed/token/</a></code></p>', 'wiloke');
        $this->pi_text_field( __('Number Of Photos', 'wiloke'), $this->get_field_id('number_of_photos'), $this->get_field_name('number_of_photos'), $aInstance['number_of_photos']);
    }

    public function update($aNewinstance, $aOldinstance)
    {
        $aInstance = $aOldinstance;
        foreach ( $aNewinstance as $key => $val )
        {
            if ( $key == 'number_of_photos' )
            {
                $aInstance[$key] = (int)$val;
            }else{
                $aInstance[$key] = strip_tags($val);
            }
        }

        return $aInstance;
    }

    public function widget( $atts, $aInstance )
    {
        $aInstance    = wp_parse_args($aInstance, $this->aDef);

        print $atts['before_widget'];

        if ( !empty($aInstance['title']) )
        {
            print $atts['before_title'] . esc_html($aInstance['title']) . $atts['after_title'];
        }
        ?>
        <div class='pi-instagram-feed widget-grid'>
            <?php
            if ( empty($aInstance['user_id']) || empty($aInstance['access_token']) )
            {
                _e('Please config your instagram', 'wiloke');
            }else{
                print $this->pi_get_instagram_feed($aInstance['user_id'], $aInstance['access_token'], $aInstance['number_of_photos']);
            }
            ?>
        </div>
    <?php
    //endif;
        print $atts['after_widget'];
    }

    public function pi_get_instagram_feed($userid, $accessToken, $count=6)
    {
        $url 	 = 'https://api.instagram.com/v1/users/'.$userid.'/media/recent?access_token='.$accessToken.'&count='.$count;
        $getInstagram = wp_remote_get( esc_url_raw( $url ), array( 'decompress' => false ));

        if ( !is_wp_error($getInstagram) )
        {
            $getInstagram = wp_remote_retrieve_body($getInstagram);
            $getInstagram = json_decode($getInstagram);

            $out = '';
            for ( $i=0; $i<$count; $i++ )
            {
                $caption = isset($getInstagram->data[$i]->caption->text) ? $getInstagram->data[$i]->caption->text : 'Instagram';
                $out .= '<div class="item"><a href="'.esc_url($getInstagram->data[$i]->link).'" target="_blank"><img src="'.esc_url($getInstagram->data[$i]->images->thumbnail->url).'" alt="'.esc_attr($caption).'" width="'.esc_attr($getInstagram->data[$i]->images->thumbnail->width).'" height="'.esc_attr($getInstagram->data[$i]->images->thumbnail->height).'" src="'.esc_url("").'" /></a></div>';
            }

            return $out;
        }
    }
}


?>