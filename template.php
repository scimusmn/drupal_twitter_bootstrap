<?php

/**
 * Add body classes if certain regions have content.
 */
function dtb_preprocess_html(&$variables) {
  // This would be a way to modify the region classes if we need it.
  //if (!empty($variables['page']['featured'])) {
    //$variables['classes_array'][] = 'featured';
  //}

  //if (!empty($variables['page']['triptych_first'])
    //|| !empty($variables['page']['triptych_middle'])
    //|| !empty($variables['page']['triptych_last'])) {
    //$variables['classes_array'][] = 'triptych';
  //}

  //if (!empty($variables['page']['footer_firstcolumn'])
    //|| !empty($variables['page']['footer_secondcolumn'])
    //|| !empty($variables['page']['footer_thirdcolumn'])
    //|| !empty($variables['page']['footer_fourthcolumn'])) {
    //$variables['classes_array'][] = 'footer-columns';
  //}
}

/**
 * Override or insert variables into the page template.
 */
function dtb_process_page(&$variables) {
  // Always print the site name and slogan, but if they are toggled off, we'll
  // just hide them visually.
  $variables['hide_site_name']   = theme_get_setting('toggle_name') ? FALSE : TRUE;
  $variables['hide_site_slogan'] = theme_get_setting('toggle_slogan') ? FALSE : TRUE;
  if ($variables['hide_site_name']) {
    // If toggle_name is FALSE, the site_name will be empty, so we rebuild it.
    $variables['site_name'] = filter_xss_admin(variable_get('site_name', 'Drupal'));
  }
  if ($variables['hide_site_slogan']) {
    // If toggle_site_slogan is FALSE, the site_slogan will be empty, so we rebuild it.
    $variables['site_slogan'] = filter_xss_admin(variable_get('site_slogan', ''));
  }

  // Since the title and the shortcut link are both block level elements,
  // positioning them next to each other is much simpler with a wrapper div.
  if (!empty($variables['title_suffix']['add_or_remove_shortcut']) && $variables['title']) {
    // Add a wrapper div using the title_prefix and title_suffix render elements.
    $variables['title_prefix']['shortcut_wrapper'] = array(
      '#markup' => '<div class="shortcut-wrapper clearfix">',
      '#weight' => 100,
    );
    $variables['title_suffix']['shortcut_wrapper'] = array(
      '#markup' => '</div>',
      '#weight' => -99,
    );
    // Make sure the shortcut link is the first item in title_suffix.
    $variables['title_suffix']['add_or_remove_shortcut']['#weight'] = -100;
  }

  // Define body span classes based on enabled regions
  if ($variables['page']['sidebar_first'] && $variables['page']['sidebar_second']) {
    $variables['sidebar_first_span'] = '3';
    $variables['content_span'] = '6';
    $variables['sidebar_second_span'] = '3';
  }
  elseif (!$variables['page']['sidebar_first'] && $variables['page']['sidebar_second']) {
    $variables['content_span'] = '9';
    $variables['sidebar_second_span'] = '3';
  }
  elseif ($variables['page']['sidebar_first'] && !$variables['page']['sidebar_second']) {
    $variables['sidebar_first_span'] = '3';
    $variables['content_span'] = '9';
  }
  elseif (!$variables['page']['sidebar_first'] && !$variables['page']['sidebar_second']) {
    $variables['content_span'] = '12';
  }

  // Find out how many enabled footer columns we have
  $count = 0;
  foreach ($variables['page'] as $key => $value) {
    $pos = strpos($key, "footer_");
    if ($pos !== false) {
      if (isset($value["#region"])) {
        $count++;
      }
    }
  }

  // Create column span classes
  $variables['footer_columns'] = TRUE;
  if ($count) {
    $column_width = 12 / $count;
    $variables['footer_columns_class'] = "span".$column_width;
  }
  else {
    $variables['footer_columns'] = FALSE;
  }
}

/**
 * Implements hook_preprocess_maintenance_page().
 */
function dtb_preprocess_maintenance_page(&$variables) {
  if (!$variables['db_is_active']) {
    unset($variables['site_name']);
  }
  drupal_add_css(drupal_get_path('theme', 'dtb') . '/css/maintenance-page.css');
}

/**
 * Override or insert variables into the maintenance page template.
 */
function dtb_process_maintenance_page(&$variables) {
  // Always print the site name and slogan, but if they are toggled off, we'll
  // just hide them visually.
  $variables['hide_site_name']   = theme_get_setting('toggle_name') ? FALSE : TRUE;
  $variables['hide_site_slogan'] = theme_get_setting('toggle_slogan') ? FALSE : TRUE;
  if ($variables['hide_site_name']) {
    // If toggle_name is FALSE, the site_name will be empty, so we rebuild it.
    $variables['site_name'] = filter_xss_admin(variable_get('site_name', 'Drupal'));
  }
  if ($variables['hide_site_slogan']) {
    // If toggle_site_slogan is FALSE, the site_slogan will be empty, so we rebuild it.
    $variables['site_slogan'] = filter_xss_admin(variable_get('site_slogan', ''));
  }
}

/**
 * Override or insert variables into the node template.
 */
function dtb_preprocess_node(&$variables) {
  if ($variables['view_mode'] == 'full' && node_is_page($variables['node'])) {
    $variables['classes_array'][] = 'node-full';
  }
}

/**
 * Override or insert variables into the block template.
 */
function dtb_preprocess_block(&$variables) {
  // In the header region visually hide block titles.
  if ($variables['block']->region == 'header') {
    $variables['title_attributes_array']['class'][] = 'element-invisible';
  }
}

/**
 * Implements theme_menu_tree().
 */
function dtb_menu_tree($variables) {
  return '<ul class="menu clearfix">' . $variables['tree'] . '</ul>';
}

/**
 * Implements theme_field__field_type().
 */
function dtb_field__taxonomy_term_reference($variables) {
  $output = '';

  // Render the label, if it's not hidden.
  if (!$variables['label_hidden']) {
    $output .= '<h3 class="field-label">' . $variables['label'] . ': </h3>';
  }

  // Render the items.
  $output .= ($variables['element']['#label_display'] == 'inline') ? '<ul class="links inline">' : '<ul class="links">';
  foreach ($variables['items'] as $delta => $item) {
    $output .= '<li class="taxonomy-term-reference-' . $delta . '"' . $variables['item_attributes'][$delta] . '>' . drupal_render($item) . '</li>';
  }
  $output .= '</ul>';

  // Render the top-level DIV.
  $output = '<div class="' . $variables['classes'] . (!in_array('clearfix', $variables['classes_array']) ? ' clearfix' : '') . '">' . $output . '</div>';

  return $output;
}

/**
 * Implements hook_form_alter().
 * Add a class to buttons so they use Bootstrap styles.
 */
function dtb_form_alter(&$form, &$form_state, $form_id) {
  $form['actions']['submit']['#attributes'] = array('class' => array('btn'));
}

/**
 * Display a view as a table style.
 */
function dtb_preprocess_views_view_table(&$vars) {

  // Count how many rows we're outputting, and if there's more than 50, add the table-condensed style.
  $total = count($vars['rows']);
  if ($total > 50) {
    $vars['classes_array'][] = 'table-condensed';
  }

  // Add general Bootstrap table classes
  $vars['classes_array'][] = 'table table-striped table-bordered';
}
