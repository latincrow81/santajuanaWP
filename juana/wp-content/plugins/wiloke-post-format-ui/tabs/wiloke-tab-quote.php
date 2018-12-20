<?php
    $content = ''; $author = ''; $url = '';

    if ( isset($this->post_meta['quote']['content']) ) {
        $content = $this->post_meta['quote']['content'];
    }

    if ( isset($this->post_meta['quote']['author']) ) {
        $author = $this->post_meta['quote']['author'];
    }

    if ( isset($this->post_meta['quote']['url']) ) {
        $url = $this->post_meta['quote']['url'];
    } ?>

    <div id="wiloke-post-format-quote" class="wiloke-format-block <?php echo ($this->post_format == 'quote') ? 'active' : '' ?>">

        <?php do_action( 'wiloke_post_format_before_quote' ); ?>

        <label for="wiloke-quote-field-content"><strong><?php echo esc_html__('Quote', 'wiloke_post_format'); ?></strong></label>
        <textarea id="wiloke-quote-field-content" type="text" name="wiloke_post_format[quote][content]"><?php echo esc_textarea($content); ?></textarea>

        <label for="wiloke-quote-field-author"><strong><?php echo esc_html__('Author', 'wiloke_post_format'); ?></strong></label>
        <input id="wiloke-quote-field-author" type="text" name="wiloke_post_format[quote][author]" value="<?php echo esc_attr($author); ?>"/>
      
        <label for="wiloke-quote-field-url"><strong><?php echo esc_html__('Link', 'wiloke_post_format'); ?></strong></label>
        <input id="wiloke-quote-field-url" type="text" name="wiloke_post_format[quote][url]" value="<?php echo esc_url($url); ?>" style="max-width: 60%"/>

        <?php do_action( 'wiloke_post_format_after_quote' ); ?>

        <div class="des-info">
            <?php echo esc_html__('Blockquote', 'wiloke'); ?>
        </div>

    </div>
