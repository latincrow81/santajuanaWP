<?php

/**
 * Created by ninhle - wiloke team
 * @since 1.0
 */

class piTWitterFeed extends piWilokeWidgets
{
    public $aDef = array('title'=>'Recent Tweets', 'username'=>'wilokethemes', 'limit'=>2, 'consumer_key'=>'', 'consumer_secret'=>'', 'access_token'=>'', 'access_token_secret'=>'', 'cache_interval'=>15);
    public function __construct()
    {
        parent::__construct('pi_twiiterfeed', parent::PI_PREFIX.'Twitter Feed', array('class'=>'pi_twiiterfeed'));
    }

    public function form($aInstance)
    {
        $aInstance = wp_parse_args($aInstance, $this->aDef);

        piWilokeWidgets::pi_text_field('Title', $this->get_field_id('title'), $this->get_field_name('title'), $aInstance['title']);
        piWilokeWidgets::pi_text_field('Username', $this->get_field_id('username'), $this->get_field_name('username'), $aInstance['username']);
        piWilokeWidgets::pi_text_field('Limit', $this->get_field_id('limit'), $this->get_field_name('limit'), $aInstance['limit']);
        piWilokeWidgets::pi_text_field('Comsumer Key', $this->get_field_id('consumer_key'), $this->get_field_name('consumer_key'), $aInstance['consumer_key']);
        piWilokeWidgets::pi_text_field('Comsumer Secret', $this->get_field_id('consumer_secret'), $this->get_field_name('consumer_secret'), $aInstance['consumer_secret']);
        piWilokeWidgets::pi_text_field('Access Token', $this->get_field_id('access_token'), $this->get_field_name('access_token'), $aInstance['access_token']);
        piWilokeWidgets::pi_text_field('Access Token Secret', $this->get_field_id('access_token_secret'), $this->get_field_name('access_token_secret'), $aInstance['access_token_secret']);
        piWilokeWidgets::pi_text_field('Cache Interval', $this->get_field_id('cache_interval'), $this->get_field_name('cache_interval'), $aInstance['cache_interval']);

        echo '<p>';
            echo '<code><a href="http://blog.wiloke.com/how-to-get-twitter-api/" target="_blank">'.__('Creating Twitter Application', 'wiloke') .'</a></code>';
        echo '</p>';
    }


    public function update($aNewinstance, $aOldinstance)
    {
        $aInstance = $aOldinstance;
        foreach ( $aNewinstance as $key => $val )
        {
            $aInstance[$key] = strip_tags($val);
        }
        return $aInstance;
    }

    public function widget($atts, $aInstance)
    {

        $aInstance = wp_parse_args($aInstance, $this->aDef);

        print $atts['before_widget'];
            if ( !empty($aInstance['title']) )
            {
                print $atts['before_title'] . $aInstance['title'] . $atts['after_title'];
            }

            if ( empty($aInstance['consumer_key']) || empty($aInstance['access_token']) || empty($aInstance['access_token_secret']) || empty($aInstance['access_token']) )
            {
                _e('You haven\'t configured your twitter api', 'wiloke');
            }else{
                require_once plugin_dir_path(__FILE__).'twitter/twitteroauth.php';

                $initTWitter = new TwitterOAuth($aInstance['consumer_key'], $aInstance['consumer_secret'], $aInstance['access_token'], $aInstance['access_token_secret'], $aInstance['cache_interval']);
                $initTWitter->ssl_verifypeer = true;

                $tweets = $initTWitter->get('statuses/user_timeline', array('screen_name' => $aInstance['username'], 'include_rts' => 'false', 'count' => $aInstance['limit']));
                if ( !empty($tweets) )
                {
                    $tweets = json_decode($tweets);

                    if( is_array($tweets) )
                    {
                        echo '<div class="widget-tweet-content">';
                        foreach($tweets as $control)
                        {
                            echo '<div class="item">';
                                echo '<i class="fa fa-twitter"></i>';
                                $status =  preg_replace('/http:\/\/([^\s]+)/i', '<a href="http://$1" target="_blank">$1</a>', $control->text);
                                print '<div class="item-content"><p>' . $status . '</p></div>';
                            echo '</div>';
                        }
                        echo '</div>';
                    }

                }else{
                    _e('There isn\'t any tweet yet', 'wiloke');
                }
            }
        print $atts['after_widget'];
    }
}
