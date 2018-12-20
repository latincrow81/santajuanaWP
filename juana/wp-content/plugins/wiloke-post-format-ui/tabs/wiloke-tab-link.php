<?php

    $url = $text = '';

    if ( isset($this->post_meta['link']['caption']) ) {
        $text = $this->post_meta['link']['caption'];
    } 

    if ( isset($this->post_meta['link']['caption']) ) {
        $url = $this->post_meta['link']['caption'];
    } 

    ?>

    <div id="wiloke-post-format-link" class="wiloke-format-block <?php echo ($this->post_format == 'link') ? 'active' : '' ?>">

        <?php do_action( 'wiloke_post_format_before_link' ); ?>

            <label for="wiloke-link-field-url"><strong><?php echo esc_html__('Text', 'rose'); ?></strong></label>
            <input id="wiloke-link-field-url" type="text" name="wiloke_post_format[link][caption]" value="<?php echo esc_attr($text); ?>" />

            <label for="wiloke-link-field-url"><strong><?php echo esc_html__('Url', 'rose'); ?></strong></label>
            <input id="wiloke-link-field-url" type="text" name="wiloke_post_format[link][url]" value="<?php echo esc_url($url); ?>" style="max-width: 60%"/>

        <?php do_action( 'wiloke_post_format_after_link' ); ?>

        <div class="des-info">
            <?php echo esc_html__('Url link', 'wiloke'); ?>
        </div>

    </div>	
