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
    switch ($variables['type']) { // Switch on content type.
      case 'course':
        $buttons = [];
        $term = $variables['field_target_group']['0']['taxonomy_term'];

        if(isset($variables['field_practical_info_buttons'][LANGUAGE_NONE]) && $term->name != 'Ungdomsuddannelse') {
          foreach($variables['field_practical_info_buttons'][LANGUAGE_NONE] as $button) {
            if ($button['value'] == 'show_transport_request') {
              $buttons[] = l('Information om transport', '/tilskud-til-transport-skoler-dagtilbud-og-klubber', [
                'attributes' => [
                  'class' => ['button'],
                  'target' => '_blank'
                ]
              ]);
            }

            // Provide variables for use in the different templates.
            if ($button['value'] == 'show_free_course_request') {
              $path = (isset($term) && $term->name === 'Dagtilbud') ? '/ansoeg/udgiftsdaekning/dagtilbud' : '/ansoeg/udgiftsdaekning';
              $buttons[] = l('ULF i Aarhus betaler dette forløb - ansøg her!', $path, [
                'attributes' => [
                  'class' => ['button'],
                  'target' => '_blank',
                ],
                'query' => ['course' => $variables['nid']],
              ]);
            }
          }
        }
        $variables['practical_info_buttons'] = $buttons;
        break;
    }
}

