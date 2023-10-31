<?php
/*
 * All the functions are in the PHP files in the `functions/` folder.
 */

if ( ! defined('ABSPATH') ) {
  exit;
}
require get_template_directory() . '/functions/cleanup.php';
require get_template_directory() . '/functions/setup.php';
require get_template_directory() . '/functions/enqueues.php';
require get_template_directory() . '/functions/action-hooks.php';
require get_template_directory() . '/functions/navbar.php';
require get_template_directory() . '/functions/dimox-breadcrumbs.php';
require get_template_directory() . '/functions/widgets.php';
require get_template_directory() . '/functions/search-widget.php';
require get_template_directory() . '/functions/index-pagination.php';
require get_template_directory() . '/functions/split-post-pagination.php';
require get_template_directory() . '/functions/table.php';

/**
 * Helper function to return the theme option value.
 * If no value has been saved, it returns $default.
 * Needed because options are saved as serialized strings.
 *
 * Not in a class to support backwards compatibility in themes.
 */
if (!function_exists('of_get_option')) :
  function of_get_option($name, $default = false)
  {

    $option_name = '';
    // Get option settings from database
    $options = get_option('sparkling');

    // Return specific option
    if (isset($options[$name])) {
      return $options[$name];
    }

    return $default;
  }
endif;

/* Globals variables */
global $options_categories;
$options_categories = array();
$options_categories_obj = get_categories();
foreach ($options_categories_obj as $category) {
  $options_categories[$category->cat_ID] = $category->cat_name;
}

require get_template_directory() . '/functions/customizer.php';
