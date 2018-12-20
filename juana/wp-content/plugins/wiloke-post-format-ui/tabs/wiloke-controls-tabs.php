
<ul class="wiloke-controls-post-format">
    <li class="<?php echo  $this->post_format == false ? 'active' : ''; ?>"><a href="post-format-0" title="<?php echo esc_html__('Standard', 'wiloke_post_format'); ?>"><?php echo esc_html__('Standard', 'wiloke_post_format'); ?></a></li>

    <?php foreach ($support as $value) :
        $name = get_post_format_string($value);
        $href = 'post-format-'. $value;
        $class = ''; 
    ?>

    <li class="<?php echo $this->post_format == $value ? 'active' : ''; ?>"><a href="<?php echo esc_attr($href); ?>" title="<?php echo esc_attr($name); ?>"><?php echo esc_html($name); ?></a></li>

    <?php endforeach; ?>

</ul>

