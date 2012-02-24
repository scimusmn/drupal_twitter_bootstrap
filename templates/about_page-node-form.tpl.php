<div class="node-add-wrapper clear-block">
  <div class="row">
    <div class="span-6">

      <?php if($form): ?>
        <?php print drupal_render_children($form); ?>
      <?php endif; ?>

      <?php if($buttons): ?>
        <div class="node-buttons">
          <?php print render($buttons); ?>
      </div>
      <?php endif; ?>

    </div>

    <div class="span-6">
      Some other things.
    </div>

  </div>
</div>

