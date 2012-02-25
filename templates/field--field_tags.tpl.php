<?php

/**
 * @file field--field_tags.tpl.php
 */
?>
<div class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>
  <?php if (!$label_hidden) : ?>
    <div class="field-label"<?php print $title_attributes; ?>><?php print $label ?>:&nbsp;</div>
  <?php endif; ?>
  <div class="field-items"<?php print $content_attributes; ?>>
    <?php
    $output = '';
    foreach ($items as $delta => $item) {
      $output .= '<span class="field-item '. $item_attributes[$delta] .'>';
      $output .= render($item);
      $output .= '</span>, ';
    }
    // Chop the final comma off the end
    $output = substr($output, 0, -2). '.';
    ?>
    <?php print $output; ?>
  </div>
</div>
