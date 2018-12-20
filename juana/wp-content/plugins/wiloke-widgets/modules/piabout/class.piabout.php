<?php
/**
 * Create by Minh Minh
 * Team Wiloke
 * URI: wiloke.net
 */

class piAbout extends piWilokeWidgets
{
  public $aDef = array('title'=>'About me', 'url' => '', 'description'=>'', 'name'=>'Wiloke');

  public function __construct()
  {
    parent::__construct('pi_about', parent::PI_PREFIX . 'About', array('class'=>'pi_about') );
  }

  public function form($aInstance)
  {
    $aInstance = wp_parse_args($aInstance, $this->aDef);

    $this->pi_text_field('Title', $this->get_field_id('title'), $this->get_field_name('title'), $aInstance['title']);
    $this->pi_upload_field('Image', $this->get_field_id('image'), $this->get_field_id('upload_button'), $this->get_field_name('url'), false, $aInstance['url'], __('We recommeded that you should use an image of 350x350px.', 'wiloke'));
    $this->pi_text_field('Name', $this->get_field_id('name'), $this->get_field_name('name'), $aInstance['name']);
    $this->pi_textarea_field('Description', $this->get_field_id('description'), $this->get_field_name('description'), $aInstance['description'], __('Allows the simple html tags', 'wiloke'));
  }

  public function update($aNewinstance, $aOldinstance)
  {
    $aInstance = $aOldinstance;
    foreach ( $aNewinstance as $key => $val )
    {
      if ( $key == 'description' )
      {
        $aInstance[$key] = $val;
      }else{
        $aInstance[$key] = strip_tags($val);
      }
    }

    return $aInstance;
  }

  public function widget($atts, $aInstance)
  {
    $aInstance = wp_parse_args($aInstance, $this->aDef);

    echo $atts['before_widget'];
    if ( !empty($aInstance['title']) )
    {
      echo $atts['before_title'] . esc_html($aInstance['title']) . $atts['after_title'];
    }
    ?>
    <div class="widget-about-content">
      <?php if ( !empty($aInstance['url']) ) : ?>
        <div class="images">
          <img src="<?php echo esc_url($aInstance['url']); ?>" alt="<?php echo esc_attr($aInstance['name']); ?>">
        </div>
      <?php endif; ?>
      <h4 class="text-uppercase"><?php echo esc_attr($aInstance['name']); ?></h4>
      <?php if ( !empty($aInstance['description']) ) : ?>
      <p><?php echo wp_kses_post($aInstance['description']); ?></p>
      <?php endif; ?>
    </div>
    <?php
    echo $atts['after_widget'];
  }
}

?>