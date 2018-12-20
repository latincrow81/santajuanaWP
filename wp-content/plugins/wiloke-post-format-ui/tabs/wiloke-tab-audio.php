<?php

    $url = '';

    if ( isset($this->post_meta['audio']['url']) ) {
        $url = $this->post_meta['audio']['url'];
    } ?>
    <div id="wiloke-post-format-audio" class="wiloke-format-block <?php echo ($this->post_format == 'audio') ? 'active' : '' ?>">

        <?php do_action( 'wiloke_post_format_before_audio' ); ?>

        <label for="wiloke-audio-field-url"><strong><?php echo esc_html__('Audio URL (oEmbed) or Embed Code', 'wiloke'); ?></strong></label>

        <textarea name="wiloke_post_format[audio][url]" id="wiloke-audio-field-url" tabindex="1"><?php echo esc_textarea($url); ?></textarea>

        <?php do_action( 'wiloke_post_format_after_audio' ); ?>

        <div class="des-info">
            <?php echo esc_html__('Audio URL (oEmbed) or Embed Code', 'wiloke'); ?>
        </div>
    </div>	
