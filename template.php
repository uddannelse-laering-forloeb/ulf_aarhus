<?php

/**
 * Implements hook_preprocess_page().
 *
 * @param $variables
 *   Available variables.
 */
function ulf_aarhus_preprocess_page(&$variables) {
  // Hamburger icon.
  $variables['hamburger_icon_path'] = drupal_get_path('theme',$GLOBALS['theme']);
}


/**
 * Implements hook_preprocess_node().
 */
function ulf_aarhus_preprocess_node(&$variables) {
  // Provide newsletter block for static pages.
  if (module_exists('heyloyalty_newsletter')) {
    $variables['newsletter_block'] = module_invoke('heyloyalty_newsletter', 'block_view', 'heyloyalty-newsletter-signup');
  }
}
