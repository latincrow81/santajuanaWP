<?php

    $style = $caption = $value = '';

    if ( isset($this->post_meta['gallery']['images']) && $this->post_meta['gallery']['images'] != '' ) {
        $value = $this->post_meta['gallery']['images'];
    }

    if ( isset($this->post_meta['gallery']['style']) && $this->post_meta['gallery']['style'] != '' ) {
        $style = $this->post_meta['gallery']['style'];
    } else {
        $style = 'wiloke-tiled-gallery';
    }

    if ( isset($this->post_meta['gallery']['caption']) && $this->post_meta['gallery']['caption'] != '' ) {
        $caption = $this->post_meta['gallery']['caption'];
    } ?>

    <div id="wiloke-post-format-gallery" class="wiloke-format-block <?php echo ($this->post_format == 'gallery') ? 'active' : '' ?>">

        <?php do_action( 'wiloke_post_format_before_gallery' ); ?>

        <ul class="screenshot">
            <?php 
                if( !empty($value) ) :
                $ids = explode(',', $value);

                foreach ($ids as $id) :

                    $attachment = wp_get_attachment_image_src($id, 'thumbnail') ?>
                    <li class="wiloke-image">
                        <img src="<?php echo esc_url( $attachment[0] ); ?>" alt="">
                    </li>

                <?php endforeach; 

            endif; ?>

        </ul>

        <div class="wiloke-button-media gallery-button">
            <input class="wiloke-media-value" type="hidden" name="wiloke_post_format[gallery][images]" value="<?php echo esc_attr($value); ?>" />
            <a href="#" class="button add" data-type="gallery"><?php echo esc_html__('Add/Edit Gallery', 'wiloke'); ?></a>
            <a href="#" class="button remove"><?php echo esc_html__('Clear Gallery', 'wiloke'); ?></a>
        </div>

        <div class="option-select gallary-option">
            <label for="post_format_gallery">
                <input type="radio" id="post_format_gallery" name="wiloke_post_format[gallery][style]" <?php checked($style, 'tiled-gallery', true); ?> value="tiled-gallery" > <?php echo esc_html__('Tiled Gallery' ,'wiloke') ?>
            </label>
            <label for="post_format_slideshow">
                <input type="radio" id="post_format_slideshow" name="wiloke_post_format[gallery][style]" <?php checked($style, 'slider-gallery', true); ?> value="slider-gallery" > <?php echo esc_html__('Slider' ,'wiloke') ?>
            </label>

            <label for="post_format_caption">
                <input type="checkbox" id="post_format_caption" name="wiloke_post_format[gallery][caption]" <?php checked($caption, 1, true); ?> value="1" > <?php echo esc_html__('Show caption' ,'wiloke') ?>
            </label>
        </div>

        <div class="des-info">
            <?php echo esc_html__('We recommeded that you should use the image width larger than 1000px', 'wiloke'); ?>
        </div>

      <?php do_action( 'wiloke_post_format_after_gallery' ); ?>

    </div>