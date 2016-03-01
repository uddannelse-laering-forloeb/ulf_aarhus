<?php

/**
 * Implements hook_preprocess_page().
 *
 * @param $variables
 *   Available variables.
 */
function ulf_aarhus_preprocess_page(&$variables) {
  // Hamburger icon.
  $variables['hamburger_icon_path'] = 'profiles/ulf/themes/ulf_aarhus';
}