<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>

  <?php print $user_picture; ?>

  <?php print render($title_prefix); ?>
  <?php if (!$page): ?>
    <h2<?php print $title_attributes; ?>><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
  <?php endif; ?>
  <?php print render($title_suffix); ?>

  <?php if ($display_submitted): ?>
    <div class="submitted">
      <?php print $submitted; ?>
    </div>
  <?php endif; ?>

  <div class="content"<?php print $content_attributes; ?>>
    <?php
      // We hide the comments and links now so that we can render them later.
      //hide($content['comments']);
      //hide($content['links']);
    ?>
    <div class="row">
      <?php if ($content['field_project_image_headline']): ?>
      <div class="span6"><?php print render($content['field_project_image_headline']); ?></div>
      <div class="span10"><?php print render($content['body']); ?></div>
      <?php else: ?>
      <div class="offset6 span10"><?php print render($content['body']); ?></div>
      <?php endif; ?>
    </div>
  </div>
</div>
