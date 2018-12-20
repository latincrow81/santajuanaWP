<?php

    $id = '';

    if ( isset($this->post_meta['image']['id']) ) {
        $id = $this->post_meta['image']['id'];
    } ?>

    <div id="wiloke-post-format-image" class="wiloke-format-block <?php echo ($this->post_format == 'image') ? 'active' : '' ?>">

        <?php do_action( 'wiloke_post_format_before_image' ); ?>

        <ul class="screenshot">

            <?php if ($id != '') :

                $thumbnail = wp_get_attachment_image_src($id, 'thumbnail'); ?>
                
                <li><img src="<?php echo esc_url( $thumbnail[0] ); ?>" alt="" /></li>

            <?php endif; ?>

        </ul>

        <div class="wiloke-button-media">
            <input class="wiloke-media-value" type="hidden" name="wiloke_post_format[image][id]" value="<?php echo esc_attr($id); ?>" />
            <a href="#" class="button add" data-type="image"><?php echo esc_html__('Add/Edit Image', 'wiloke'); ?></a>
            <a href="#" class="button remove"><?php echo esc_html__('Clear Image', 'wiloke'); ?></a>
        </div>

        <div class="des-info">
            <?php echo esc_html__('Select image from media', 'wiloke'); ?>
        </div>

    </div>