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

  // Set default node teaser template.
  if ($variables['view_mode'] == 'teaser') {
    $variables['theme_hook_suggestions'][] = 'node__default_teaser';

    // Select first 3 field_relevance_educators values and prepare for print.
    if ($variables['type'] == 'course_educators') {
      $target_group_array = [];
      if (!empty($variables['field_relevance_educators'])) {
        foreach (
          $variables['field_relevance_educators'] as $target_group
        ) {
          $target_group_array[] = $target_group['taxonomy_term']->name;
        }
      }
      $sliced_target_group_array = array_slice($target_group_array, 0, 3);

      $variables['course_teaser_target_group'] = '';
      foreach ($sliced_target_group_array as $value) {
        $variables['course_teaser_target_group'] .= $value . ', ';
      }

      if (count($target_group_array) > 3) {
        $variables['course_teaser_target_group'] .= '(...)';
      }
    }
  }
}
