<?php
/**
 * Button Component
 * 
 * args:
 * - url (string)
 * - text (string)
 * - style (string) e.g., 'primary', 'outline'
 * - class (string) extra classes
 * - inline_style (string) extra inline styles
 */
$url = isset($args['url']) ? $args['url'] : '#';
$text = isset($args['text']) ? $args['text'] : 'Button';
$style = isset($args['style']) ? $args['style'] : 'primary';
$class = isset($args['class']) ? $args['class'] : '';
$inline_style = isset($args['inline_style']) ? $args['inline_style'] : '';

$btn_class = 'btn';
if ($style === 'outline') {
    $btn_class .= ' btn-outline';
}
if (!empty($class)) {
    $btn_class .= ' ' . $class;
}
?>
<a href="<?php echo esc_url($url); ?>" class="<?php echo esc_attr($btn_class); ?>" style="<?php echo esc_attr($inline_style); ?>">
    <?php echo esc_html($text); ?>
</a>
