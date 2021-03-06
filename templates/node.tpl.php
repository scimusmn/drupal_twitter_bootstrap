<?php

/**
 * @file
 * dtb's theme implementation to display a node.
 */
?>
<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>

  <?php print render($title_prefix); ?>
  <?php if (!$page): ?>
    <h2<?php print $title_attributes; ?>>
      <a href="<?php print $node_url; ?>"><?php print $title; ?></a>
    </h2>
  <?php endif; ?>
  <?php print render($title_suffix); ?>

  <div class="content clearfix"<?php print $content_attributes; ?>>
    <?php
      // We hide the comments and links now so that we can render them later.
      hide($content['comments']);
      hide($content['links']);
      hide($content['field_tags']);
      print render($content);
    ?>
  </div>

  <?php if ($display_submitted): ?>
    <div class="meta submitted">
      &laquo; Posted on <?php print $date; ?> &raquo;<br />
      <?php if (isset($content['field_tags'][0])): ?>
        in <?php print render($content['field_tags']); ?>
      <?php endif; ?>
    </div>
  <?php endif; ?>


  <?php print render($content['comments']); ?>

</div>
