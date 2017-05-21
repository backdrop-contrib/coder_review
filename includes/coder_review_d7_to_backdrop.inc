<?php
/**
 * @file
 * This include file implements coder functionality for 7.x -> 8.x upgrades.
 */

/**
 * Implements hook_reviews().
 */
function coder_review_d7_to_backdrop_reviews() {
  $rules[] = array(
    '#type' => 'regex',
    '#source' => 'allphp',
    '#value' => '(variable_get|variable_set|variable_del)+\(',
    '#warning' => array(
      '#text' => 'Variable_get, variable_set, and variable_del deprecated by CMI.',
      '#link' => _backdropnode(28616),
    ),
  );

  $review = array(
    '#title' => 'Converting 7.x modules to Backdrop',
    '#link' => 'https://api.backdropcms.org/change-records',
    '#rules' => $rules,
    '#severity' => 'critical',
    '#version' => 2,
    '#image' => 'images/bd.png',
  );

  return array('upgrade_d7_to_backdrop' => $review);
}
