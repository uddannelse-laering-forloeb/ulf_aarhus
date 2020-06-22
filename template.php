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
    if (variable_get('heyloyalty_signup_enable_sidebar', '')) {
      $variables['newsletter_block'] = module_invoke('heyloyalty_newsletter', 'block_view', 'heyloyalty-newsletter-signup');
    }
    else {
      $variables['newsletter_block'] = NULL;
    }
  }
}

/**
 * Implements hook_preprocess_node().
 */
function ulf_aarhus_preprocess_field(&$variables) {
  // Provide newsletter block for static pages.
  if($variables['element']['#field_name'] == 'field_video') {
    print_r($variables['element']['field_video']);
  }
}
