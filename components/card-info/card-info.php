<?php
/**
 * Card Info Component
 * 
 * args:
 * - icon (string)
 * - title (string)
 * - desc (string)
 */
$icon = isset($args['icon']) ? $args['icon'] : '✨';
$title = isset($args['title']) ? $args['title'] : 'Tiêu đề';
$desc = isset($args['desc']) ? $args['desc'] : 'Mô tả chi tiết...';
?>
<div class="card" style="text-align: center; padding: 40px 30px;">
    <div style="font-size: 50px; margin-bottom: 20px;"><?php echo $icon; ?></div>
    <h3 style="margin-bottom: 15px;"><?php echo esc_html($title); ?></h3>
    <p style="color: #666;"><?php echo esc_html($desc); ?></p>
</div>
