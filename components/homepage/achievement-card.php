<?php
/**
 * Single Achievement Card Component
 * 
 * Expected $args:
 * - icon (string: svg content)
 * - number (string)
 * - unit (string)
 * - inline (boolean)
 * - desc (string)
 */
?>
<div class="achievement-card">
    <div class="ac-icon-wrapper">
        <?php echo isset($args['icon']) ? $args['icon'] : ''; ?>
    </div>
    
    <div class="ac-number-wrap <?php echo !empty($args['inline']) ? 'is-inline' : ''; ?>">
        <div class="ac-number"><?php echo isset($args['number']) ? $args['number'] : ''; ?></div>
        <div class="ac-unit"><?php echo isset($args['unit']) ? $args['unit'] : ''; ?></div>
    </div>
    
    <div class="ac-desc">
        <?php echo isset($args['desc']) ? $args['desc'] : ''; ?>
    </div>
</div>
