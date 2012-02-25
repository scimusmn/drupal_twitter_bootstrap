<?php
/**
 * @file views-view-unformatted.tpl.php
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 */
?>
<?php if (!empty($title)): ?>
  <h3><?php print $title; ?></h3>
<?php endif; ?>
<?php
// Write the appropriate div classes for the four wide
// spans
$i = 0;
foreach ($rows as $id => $row) {
  unset($prefix);
  $filler = FALSE;
  if(is_int($i/4)) {
    $prefix = '<div class="row">';
  }
  if(isset($prefix)) { print $prefix; }
?>
  <div class="span4">
    <?php print "Value before title - " . $i; ?>
    <div class="<?php print $classes_array[$id]; ?>">
      <?php print $row; ?>
    </div>
    <?php ++$i; ?>
    <?php print "Value after title - " . $i; ?>
  </div>
  <?php
  if(is_int($i/4)) {
    $suffix = '</div>';
  }
  if(isset($suffix)) { print $suffix; }
}

// Fill in rows with extra blank divs if the loop doesn't
// end on a four.
if(!is_int($i/4)) {
  $row_max = ceil($i/4);
  $fills = ($row_max * 4) - $i;
  while ($fills >> 0) {
    print '<div class="span4">&nbsp;</div>';
    --$fills;
  }
  print '</div>';
}
?>
