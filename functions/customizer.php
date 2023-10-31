<?php

// Add epsilon framework
require get_template_directory() . '/inc/libraries/epsilon-framework/class-epsilon-autoloader.php';
$epsilon_framework_settings = array(
  'controls' => array('toggle'), // array of controls to load
  'sections' => array('recommended-actions', 'pro'), // array of sections to load
);
new Epsilon_Framework($epsilon_framework_settings);

function b5st_customizer($wp_customize)
{
    /* Main option Settings Panel */
    $wp_customize->add_panel(
        'sparkling_main_options',
        array(
            'capability' => 'edit_theme_options',
            'theme_supports' => '',
            'title' => __('Sparkling Options', 'sparkling'),
            'description' => __('Panel to update sparkling theme options', 'sparkling'),
            // Include html tags such as <p>.
            'priority' => 10,
            // Mixed with top-level-section hierarchy.
        )
    );

    /* Sparkling Main Options */
    $wp_customize->add_section(
        'sparkling_slider_options',
        array(
            'title' => __('Slider Options', 'sparkling'),
            'priority' => 31,
            'panel' => 'sparkling_main_options',
        )
    );
    $wp_customize->add_setting(
        'sparkling[sparkling_slider_checkbox]',
        array(
            'default' => 0,
            'type' => 'option',
            'sanitize_callback' => 'sparkling_sanitize_checkbox',
        )
    );
    $wp_customize->add_control(
        new Epsilon_Control_Toggle(
            $wp_customize,
            'sparkling[sparkling_slider_checkbox]',
            array(
                'label' => esc_html__('Check if you want to enable slider', 'sparkling'),
                'section' => 'sparkling_slider_options',
                'priority' => 5,
                'type' => 'epsilon-toggle',
            )
        )
    );
    $wp_customize->add_setting(
        'sparkling[sparkling_slider_link_checkbox]',
        array(
            'default' => 1,
            'type' => 'option',
            'sanitize_callback' => 'sparkling_sanitize_checkbox',
        )
    );
    $wp_customize->add_control(
        new Epsilon_Control_Toggle(
            $wp_customize,
            'sparkling[sparkling_slider_link_checkbox]',
            array(
                'label' => esc_html__('Uncheck this option to remove the link from the slides', 'sparkling'),
                'section' => 'sparkling_slider_options',
                'priority' => 6,
                'type' => 'epsilon-toggle',
            )
        )
    );

    // Pull all the categories into an array
    global $options_categories;
    $wp_customize->add_setting(
        'sparkling[sparkling_slide_categories]',
        array(
            'default' => '',
            'type' => 'option',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'sparkling_sanitize_slidecat',
        )
    );
    $wp_customize->add_control(
        'sparkling[sparkling_slide_categories]',
        array(
            'label' => __('Slider Category', 'sparkling'),
            'section' => 'sparkling_slider_options',
            'type' => 'select',
            'description' => __('Select a category for the featured post slider', 'sparkling'),
            'choices' => $options_categories,
        )
    );

    $wp_customize->add_setting(
        'sparkling[sparkling_slide_number]',
        array(
            'default' => 3,
            'type' => 'option',
            'sanitize_callback' => 'sparkling_sanitize_number',
        )
    );
    $wp_customize->add_control(
        'sparkling[sparkling_slide_number]',
        array(
            'label' => __('Number of slide items', 'sparkling'),
            'section' => 'sparkling_slider_options',
            'description' => __('Enter the number of slide items', 'sparkling'),
            'type' => 'text',
        )
    );
}

add_action('customize_register', 'b5st_customizer');


/**
 * Sanitzie checkbox for WordPress customizer
 */
function sparkling_sanitize_checkbox($input)
{
  if (1 == $input) {
    return 1;
  } else {
    return '';
  }
}

/**
 * Adds sanitization callback function: colors
 * @package Sparkling
 */
function sparkling_sanitize_hexcolor($color)
{
  $unhashed = sanitize_hex_color_no_hash($color);
  if ($unhashed) {
    return '#' . $unhashed;
  }

  return $color;
}

/**
 * Adds sanitization callback function: Nohtml
 * @package Sparkling
 */
function sparkling_sanitize_nohtml($input)
{
  return wp_filter_nohtml_kses($input);
}

/**
 * Adds sanitization callback function: Number
 * @package Sparkling
 */
function sparkling_sanitize_number($input)
{
  if (isset($input) && is_numeric($input)) {
    return $input;
  }
}

/**
 * Adds sanitization callback function: Strip Slashes
 * @package Sparkling
 */
function sparkling_sanitize_strip_slashes($input)
{
  return wp_kses_stripslashes($input);
}

/**
 * Adds sanitization callback function: Sanitize Text area
 * @package Sparkling
 */
function sparkling_sanitize_textarea($input)
{
  return sanitize_text_field($input);
}

/**
 * Adds sanitization callback function: Slider Category
 * @package Sparkling
 */
function sparkling_sanitize_slidecat($input)
{
  global $options_categories;
  if (array_key_exists($input, $options_categories)) {
    return $input;
  } else {
    return '';
  }
}

/**
 * Adds sanitization callback function: Sidebar Layout
 * @package Sparkling
 */
function sparkling_sanitize_layout($input)
{
  global $site_layout;
  if (array_key_exists($input, $site_layout)) {
    return $input;
  } else {
    return '';
  }
}

/**
 * Adds sanitization callback function: Typography Size
 * @package Sparkling
 */
function sparkling_sanitize_typo_size($input)
{
  global $typography_options, $typography_defaults;
  if (array_key_exists($input, $typography_options['sizes'])) {
    return $input;
  } else {
    return $typography_defaults['size'];
  }
}

/**
 * Adds sanitization callback function: Typography Face
 * @package Sparkling
 */
function sparkling_sanitize_typo_face($input)
{
  global $typography_options, $typography_defaults;
  if (array_key_exists($input, $typography_options['faces'])) {
    return $input;
  } else {
    return $typography_defaults['face'];
  }
}

/**
 * Adds sanitization callback function: Typography Style
 * @package Sparkling
 */
function sparkling_sanitize_typo_style($input)
{
  global $typography_options, $typography_defaults;
  if (array_key_exists($input, $typography_options['styles'])) {
    return $input;
  } else {
    return $typography_defaults['style'];
  }
}
