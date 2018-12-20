<?php

class piFacebookLikeBox extends piWilokeWidgets {
    public $aDef = array( 'title' =>'Fanpage', 'page_url'=>'', 'faces' => '', 'stream'=>'', 'header'=>'', 'height'=>300);
    public function __construct() {
        $args = array('classname'=>'pi_facebook_likebox', 'description'=>'');
        parent::__construct("pi_facebook_likebox", parent::PI_PREFIX . 'Facebook', $args);
    }

    public function form($aInstance) {
        $aInstance = wp_parse_args(  $aInstance, $this->aDef );

        $this->pi_text_field('Title', $this->get_field_id('title'), $this->get_field_name('title'), $aInstance['title']);
        $this->pi_link_field('Facebook Page URL:', $this->get_field_id('page_url'), $this->get_field_name('page_url'), $aInstance['page_url'], 'EG. http://www.facebook.com/envato');
        $this->pi_select_field('Show Faces', $this->get_field_id('faces'), $this->get_field_name('faces'), array('Disable', 'Enable'), $aInstance['faces']);
        $this->pi_select_field('Show Stream', $this->get_field_id('stream'), $this->get_field_name('stream'), array('Disable', 'Enable'), $aInstance['stream']);
        $this->pi_select_field('Show Header', $this->get_field_id('header'), $this->get_field_name('header'), array('Disable', 'Enable'), $aInstance['header']);
    }

    public  function update($new_instance, $old_instance) {
        $instance = $old_instance;
        foreach ( $new_instance as $key => $val ) {
            $instance[$key] = strip_tags($val);
        }
        return $instance;
    }

    public function widget( $atts, $aInstance ) {

        print $atts['before_widget'];
        if( !empty($aInstance['title']) )
        {
            print $atts['before_title'].esc_attr($aInstance['title']).$atts['after_title'];
        }
        print '<div class="box-content">';
        ?>
        <iframe src="//www.facebook.com/plugins/likebox.php?href=<?php echo esc_url($aInstance['page_url']); ?>&amp;colorscheme=light&amp;show_faces=<?php if(isset($aInstance['faces']) && !empty($aInstance['faces'])) { echo 'true'; } else { echo 'false'; } ?>&amp;border_color&amp;stream=<?php if(isset($aInstance['stream']) && !empty($aInstance['stream']) ) { echo 'true'; } else { echo 'false'; } ?>&amp;header=<?php if( isset($aInstance['header']) && !empty($aInstance['header']) ) { echo 'true'; } else { echo 'false'; } ?>"  style="border:none; overflow:hidden; height:<?php echo esc_attr($aInstance['height']); ?>px;"></iframe>
        <?php
        echo '</div>';

        print $atts['after_widget'];
    }
}

?>