<?php

/**
 * Implementation of hook_theme().
 */
function drupal_twitter_bootstrap_theme($existing, $type, $theme, $path) {

  return array(
    'about_page_node_form' => array(
      'render element' => 'form',
      'template' => 'about_page-node-form',
      // this will set to module/theme path by default:
      'path' => drupal_get_path('theme', 'drupal_twitter_bootstrap') .'/templates',
    )
  );
}
?>
