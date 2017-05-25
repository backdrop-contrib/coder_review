<?php
/**
 * @file
 * This include file implements coder functionality for 7.x -> 8.x upgrades.
 */

/**
 * Implements hook_reviews().
 */
function coder_review_d7_to_backdrop_reviews() {
  $argex = '(((&?\$?)[a-zA-Z_]+((\([^)]*\))|\[[^\]]*\])?)|[0-9]+(\.[0-9]*)?|\'\'|"")';

  $rules[] = array(
    '#type' => 'callback',
    '#value' => '_coder_review_d7_to_backdrop_variable_callback',
  );
  $rules[] = array(
    '#source' => 'all',
    '#type' => 'regex',
    '#value' => '\$classes_array',
    '#warning' => array(
      '#text' => 'Process layer has been removed. $classes_array is now $classes (flatten in template file)',
      '#link' => _backdropnode(28554),
    ),
  );
  $rules[] = array(
    '#type' => 'regex',
    '#value' => '\$attributes_array',
    '#warning' => array(
      '#text' => 'Process layer has been removed. $attributes_array is now $attributes (flatten in template file)',
      '#link' => _backdropnode(28554),
    ),
  );
  $rules[] = array(
    '#type' => 'regex',
    '#value' => '\$content_attributes_array',
    '#warning' => array(
      '#text' => 'Process layer has been removed. $content_attributes_array is now $content_attributes (flatten in template file)',
      '#link' => _backdropnode(28554),
    ),
  );
  $rules[] = array(
    '#type' => 'regex',
    '#value' => '\$html_attributes_array',
    '#warning' => array(
      '#text' => 'Process layer has been removed. $html_attributes_array is now $html_attributes (flatten in template file)',
      '#link' => _backdropnode(28554),
    ),
  );
  $rules[] = array(
    '#type' => 'regex',
    '#value' => '\$body_attributes_array',
    '#warning' => array(
      '#text' => 'Process layer has been removed. $body_attributes_array is now $body_attributes (flatten in template file)',
      '#link' => _backdropnode(28554),
    ),
  );
  $rules[] = array(
    '#type' => 'regex',
    '#value' => '\$item_attributes_array',
    '#warning' => array(
      '#text' => 'Process layer has been removed. $item_attributes_array is now $item_attributes (flatten in template file)',
      '#link' => _backdropnode(28554),
    ),
  );
  $rules[] = array(
    '#type' => 'regex',
    '#value' => '\$title_attributes_array',
    '#warning' => array(
      '#text' => 'Process layer has been removed. $item_attributes_array has been removed',
      '#link' => _backdropnode(28554),
    ),
  );
  $rules[] = array(
    '#type' => 'regex',
    '#value' => 'print\s*\$head\;',
    '#warning' => array(
      '#text' => 'Process layer has been removed. $head variable has been removed. Use backdrop_get_html_head()',
      '#link' => _backdropnode(28554),
    ),
    '#filename' => array('tpl.php'),
  );
  $rules[] = array(
    '#type' => 'regex',
    '#value' => 'print\s*\$styles\;',
    '#warning' => array(
      '#text' => 'Process layer has been removed. $styles variable has been removed. Use backdrop_get_css()',
      '#link' => _backdropnode(28554),
    ),
    '#filename' => array('tpl.php'),
  );
  $rules[] = array(
    '#type' => 'regex',
    '#value' => 'print\s*\$scripts\;',
    '#warning' => array(
      '#text' => 'Process layer has been removed. $scripts variable has been removed. Use backdrop_get_js()',
      '#link' => _backdropnode(28554),
    ),
    '#filename' => array('tpl.php'),
  );
  $rules[] = array(
    '#type' => 'regex',
    '#value' => '[\s\(]_color_page_alter\s*\(',
    '#warning' => array(
      '#text' => 'Function _color_page_alter() layer has been removed.',
      '#link' => _backdropnode(28554),
    ),
    '#filename' => array('tpl.php'),
  );
  $rules[] = array(
    '#type' => 'regex',
    '#value' => '[\s\(]contextual_process\s*\(',
    '#warning' => array(
      '#text' => 'Function contextual_process() layer has been removed.',
      '#link' => _backdropnode(28554),
    ),
    '#filename' => array('contextual.module'),
  );
  $rules[] = array(
    '#type' => 'regex',
    '#value' => '[\s\(]template_process_username\s*\(',
    '#warning' => array(
      '#text' => 'Function template_process_username() layer has been removed.',
      '#link' => _backdropnode(28554),
    ),
    '#filename' => array('user.module'),
  );
  $rules[] = array(
    '#type' => 'regex',
    '#value' => '[\s\(]template_process_views_view\s*\(',
    '#warning' => array(
      '#text' => 'Function template_process_views_view() layer has been removed.',
      '#link' => _backdropnode(28554),
    ),
    '#filename' => array('theme.inc'),
  );
  $rules[] = array(
    '#type' => 'regex',
    '#source' => 'all',
    '#value' => 'file\[\]\s*\=',
    '#warning' => array(
      '#text' => 'The class registry has been replaced with a static class map.',
      '#link' => _backdropnode(26859),
    ),
    '#filename' => array('info'),
  );
  $rules[] = array(
    '#type' => 'regex',
    '#value' => 'function\s*getInfo\s*\(',
    '#warning' => array(
      '#text' => 'getInfo() is deprecated. Information about tests should now be in module.tests.info.',
      '#link' => _backdropnode(26860),
    ),
    '#filename' => array('test'),
  );
  $rules[] = array(
    '#type' => 'regex',
    '#value' => '(block_role|block_node_type)', // @todo: maybe this should search for db queries using these tables.
    '#warning' => array(
      '#text' => 'Block module no longer provides database tables.',
      '#link' => _backdropnode(26861),
    ),
  );
  $rules[] = array(
    '#type' => 'regex',
    '#value' => 'function\s+[a-z0-9_]+_(block_view)\s*\(\s*\$delta\s*=\s*\'\'\s*\)',
    '#warning' => array(
      '#text' => 'hook_block_view() now receives two additional arguments for $settings and $contexts.',
      '#link' => _backdropnode(26861),
    ),
  );
  $rules[] = array(
    '#type' => 'regex',
    '#value' => 'function\s+[a-z0-9_]+_(block_save)\s*\(\s*\$delta\s*=\s*\'\'\s*,\s*\$edit',
    '#warning' => array(
      '#text' => 'hook_block_save() now takes the $edit parameter by reference, as in &$edit.',
      '#link' => _backdropnode(26861),
    ),
  );
  $rules[] = array(
    '#type' => 'regex',
    '#value' => '[\s\(]block_custom_block_get\s*\(',
    '#warning' => array(
      '#text' => 'block_custom_block_get() is now block_custom_block_load() and takes a block $delta as parameter rather than $bid.',
      '#link' => _backdropnode(26861),
    ),
  );
  $rules[] = array(
    '#type' => 'regex',
    '#value' => '\$page',
    '#warning' => array(
      '#text' => '$page variable has been removed.',
      '#link' => _backdropnode(26861),
    ),
    '#filename' => array('tpl.php'),
  );
  $rules[] = array(
    '#type' => 'regex',
    '#value' => 'function\s+[a-z0-9_]+_(page_alter|page_build)\s*\(\s*(&\$page)',
    '#warning' => array(
      '#text' => 'hook_page_alter() and hook_page_build() have been removed.',
      '#link' => _backdropnode(26861),
    ),
  );
  $rules[] = array(
    '#type' => 'regex',
    '#value' => '\$page\[\'\#show_messages\'\]\s*=\s*FALSE',
    '#warning' => array(
      '#text' => 'As the $page renderable no longer exists, the function backdrop_display_messages(FALSE) should be used to hide (or show) messages for a page request.',
      '#link' => _backdropnode(26861),
    ),
  );
  $rules[] = array(
    '#type' => 'regex',
    '#value' => '[\s\(]drupal_set_page_content\s*\(',
    '#warning' => array(
      '#text' => 'drupal_set_page_content() has been removed. Block content is now managed by Layout module\'s UI.',
      '#link' => _backdropnode(26861),
    ),
  );
  $rules[] = array(
    '#type' => 'callback',
    '#value' => '_coder_review_d7_to_backdrop_htmltpl_callback',
  );
  $rules[] = array(
    '#type' => 'regex',
    '#value' => '(\$action_links|\$node|\$is_admin)',
    '#warning' => array(
      '#text' => '$action_links, $node, $is_admin variables have been removed.',
      '#link' => _backdropnode(26861),
    ),
    '#filename' => array('tpl.php'),
  );
  $rules[] = array(
    '#type' => 'regex',
    '#source' => 'quote',
    '#value' => 'admin\/appearance\/settings\'',
    '#warning' => array(
      '#text' => 'The global theme settings page at "/admin/appearance/settings" has been removed.',
      '#link' => _backdropnode(26863),
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


/**
 * @todo: add a function header comment.
 */
function _coder_review_d7_to_backdrop_variable_callback(&$coder_args, $review, $rule, $lines, &$results) {
  $states = array(
    'cron_key',
    'cron_last',
    'css_js_query_string',
    'install_task',
    'install_time',
    'maintenance_mode',
    'block_test_content',
    'entity_cache_test_label',
    'node_access_test_private',
    'image_module_test_file_download',
    'locale_test_domain',
    'locale_test_content_language_type',
    'locale_test_language_types',
    'locale_test_language_negotiation_info',
    'locale_test_language_negotiation_info_alter',
    'node_test_node_access_all_uid',
    'file_test_hook_file_url_alter',
    'test_verbose_module_hooks',
    'dependency_test',
    'dependencies',
    'update_script_test_requirement_type',
    'update_test_xml_map',
    'update_test_system_info',
    'update_test_update_status',
    'test_dynamic_access_argument1',
    'test_dynamic_access_argument2',
    'views_test_views_data_count',
    'views_test_schema',
    'views_test_views_data',
    'views_test_views_plugins',
    'test_email_collector',
  );

  $argex = '(((&?\$?)[a-zA-Z_]+((\([^)]*\))|\[[^\]]*\])?)|[0-9]+(\.[0-9]*)?|\'\'|"")';
  $filename = $coder_args['#filename'];
  if (file_exists($filename)) {
    $lines = file($filename);
    if ($lines) {
      foreach ($lines as $lineno => $line) {
        if (preg_match('/[\s\(](variable_get|variable_set|variable_del)+\s*\(\s*[\'\$]([a-zA-Z_]+)\'/', $line, $match)) {
          if (in_array($match[2], $states)) {
            $severity_name = _coder_review_severity_name($coder_args, $review, $rule);
            $tmprule = $rule;
            $tmprule['#warning'] = array(
              '#text' => 'Non-configuration variables have been converted to states system.',
              '#link' => _backdropnode(28553),
            );
            _coder_review_error($results, $tmprule, $severity_name, $lineno, $line, $coder_args['#ignores']);
          }
          else {
            $severity_name = _coder_review_severity_name($coder_args, $review, $rule);
            $tmprule = $rule;
            $tmprule['#warning'] = array(
              '#text' => 'Variable_get, variable_set, and variable_del deprecated by CMI.',
              '#link' => _backdropnode(28616),
            );
            _coder_review_error($results, $tmprule, $severity_name, $lineno, $line, $coder_args['#ignores']);
          }
        }
      }
    }
  }
}

/**
 * @todo: add a function header comment.
 */
function _coder_review_d7_to_backdrop_htmltpl_callback(&$coder_args, $review, $rule, $lines, &$results) {
  // Todo: figure out how to detect page.tpl.php.
}
