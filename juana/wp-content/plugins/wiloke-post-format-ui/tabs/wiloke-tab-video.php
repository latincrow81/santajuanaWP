<?php

    $url = '';

    if ( isset($this->post_meta['video']['url']) ) {
        $url = $this->post_meta['video']['url'];
    } ?>

    <div id="wiloke-post-format-video" class="wiloke-format-block <?php echo ($this->post_format == 'video') ? 'active' : '' ?>">

        <?php do_action( 'wiloke_post_format_before_video' ); ?>

        <label for="wiloke-video-field-url"><strong><?php echo esc_html__('Enter Youtube/Vimeo URL or Embed Code.', 'wiloke'); ?></strong></label>

        <textarea id="wiloke-video-field-url" name="wiloke_post_format[video][url]" tabindex="1"><?php echo esc_textarea($url); ?></textarea>  

        <?php do_action( 'wiloke_post_format_after_video' ); ?>

        <div class="des-info">
            <?php echo esc_html__('Url youtube, vimeo or embed any of', 'wiloke'); ?>
        </div>

    </div>	
