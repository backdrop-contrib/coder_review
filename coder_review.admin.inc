<?php

/**
 * @file
 * Administrative forms and functions for the Coder module.
 */

/**
 * Page callback: Configures administrative settings via system_settings_form().
 *
 * @see coder_review_menu()
 * @see coder_review_settings_form_submit()
 */
function coder_review_admin_settings($form, &$form_state) {
  // Bootstrap enough to run.
  require_once realpath(dirname(__FILE__)) . '/coder_review.common.inc';

  $settings = _coder_review_get_default_settings();

  $form = _coder_review_settings_form($settings, $system, $files);
  $form['help'] = array(
    '#type' => 'markup',
    '#markup' => t('After setting these defaults, use <a href="@url">coder review</a> to perform code reviews.', array('@url' => url('admin/config/development/coder/review'))),
    '#weight' => -1,
  );
  $form['actions']['#type'] = 'actions';
  $form['actions']['submit'] = array(
    '#type' => 'submit',
    '#submit' => array(
      'coder_review_settings_form_submit',
      'coder_review_admin_settings_submit',
    ),
    '#value' => t('Save configuration'),
  );

  return $form;
}

/**
 * Form submission handler for coder_review_settings_form().
 */
function coder_review_settings_form_submit($form, &$form_state) {
  $form_state['storage'] = $form_state['values'];

  $config = config('coder_review.settings');
  $config->set('coder_modules', _coder_review_settings_array($form_state, 'module'));
  $config->set('coder_themes', _coder_review_settings_array($form_state, 'theme'));
  $config->save();
  backdrop_set_message(t('The configuration options have been saved.'));
}

/**
 * Form submission handler for coder_review_admin_settings().
 */
function coder_review_admin_settings_submit($form, &$form_state) {
  form_state_values_clean($form_state);

  $config = config('coder_review.settings');
  foreach ($form_state['values'] as $key => $value) {
    $config->set($key, $value);
  }
  $config->save();
}

/**
 * Custom callback for array_filter.
 */
function _coder_review_link_check($var) {
  return $var && $var[0] != '#';
}
