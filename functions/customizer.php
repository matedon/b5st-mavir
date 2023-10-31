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
        'b5st_main_options',
        array(
            'capability' => 'edit_theme_options',
            'theme_supports' => '',
            'title' => __('B5ST Options', 'b5st'),
            'description' => __('Panel to update b5st theme options', 'b5st'),
            // Include html tags such as <p>.
            'priority' => 10,
            // Mixed with top-level-section hierarchy.
        )
    );

    /* b5st Main Options */
    $wp_customize->add_section(
        'b5st_slider_options',
        array(
            'title' => __('Slider Options', 'b5st'),
            'priority' => 31,
            'panel' => 'b5st_main_options',
        )
    );
    $wp_customize->add_setting(
        'b5st[b5st_slider_checkbox]',
        array(
            'default' => 0,
            'type' => 'option',
            'sanitize_callback' => 'b5st_sanitize_checkbox',
        )
    );
    $wp_customize->add_control(
        new Epsilon_Control_Toggle(
            $wp_customize,
            'b5st[b5st_slider_checkbox]',
            array(
                'label' => esc_html__('Check if you want to enable slider', 'b5st'),
                'section' => 'b5st_slider_options',
                'priority' => 5,
                'type' => 'epsilon-toggle',
            )
        )
    );
    $wp_customize->add_setting(
        'b5st[b5st_slider_link_checkbox]',
        array(
            'default' => 1,
            'type' => 'option',
            'sanitize_callback' => 'b5st_sanitize_checkbox',
        )
    );
    $wp_customize->add_control(
        new Epsilon_Control_Toggle(
            $wp_customize,
            'b5st[b5st_slider_link_checkbox]',
            array(
                'label' => esc_html__('Uncheck this option to remove the link from the slides', 'b5st'),
                'section' => 'b5st_slider_options',
                'priority' => 6,
                'type' => 'epsilon-toggle',
            )
        )
    );

    $wp_customize->add_setting(
        'b5st[b5st_slider_autoplay_checkbox]',
        array(
            'default' => 1,
            'type' => 'option',
            'sanitize_callback' => 'b5st_sanitize_checkbox',
        )
    );
    $wp_customize->add_control(
        new Epsilon_Control_Toggle(
            $wp_customize,
            'b5st[b5st_slider_autoplay_checkbox]',
            array(
                'label' => esc_html__('Check if you want to enable autoplay', 'b5st'),
                'section' => 'b5st_slider_options',
                'priority' => 5,
                'type' => 'epsilon-toggle',
            )
        )
    );

    $wp_customize->add_setting(
        'b5st[b5st_slider_autoplay_time]',
        array(
            'default' => 5000,
            'type' => 'option',
            'sanitize_callback' => 'b5st_sanitize_number',
        )
    );
    $wp_customize->add_control(
        'b5st[b5st_slider_autoplay_time]',
        array(
            'label' => __('Slider autoplay in time (ms)', 'b5st'),
            'section' => 'b5st_slider_options',
            'description' => __('Enter autoplay time in milliseconds', 'b5st'),
            'type' => 'text',
        )
    );

    // Pull all the categories into an array
    global $options_categories;
    $wp_customize->add_setting(
        'b5st[b5st_slide_categories]',
        array(
            'default' => '',
            'type' => 'option',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'b5st_sanitize_slidecat',
        )
    );
    $wp_customize->add_control(
        'b5st[b5st_slide_categories]',
        array(
            'label' => __('Slider Category', 'b5st'),
            'section' => 'b5st_slider_options',
            'type' => 'select',
            'description' => __('Select a category for the featured post slider', 'b5st'),
            'choices' => $options_categories,
        )
    );

    $wp_customize->add_setting(
        'b5st[b5st_slide_number]',
        array(
            'default' => 3,
            'type' => 'option',
            'sanitize_callback' => 'b5st_sanitize_number',
        )
    );
    $wp_customize->add_control(
        'b5st[b5st_slide_number]',
        array(
            'label' => __('Number of slide items', 'b5st'),
            'section' => 'b5st_slider_options',
            'description' => __('Enter the number of slide items', 'b5st'),
            'type' => 'text',
        )
    );
}

add_action('customize_register', 'b5st_customizer');


/**
 * Sanitzie checkbox for WordPress customizer
 */
function b5st_sanitize_checkbox($input)
{
  if (1 == $input) {
    return 1;
  } else {
    return '';
  }
}

/**
 * Adds sanitization callback function: colors
 * @package b5st
 */
function b5st_sanitize_hexcolor($color)
{
  $unhashed = sanitize_hex_color_no_hash($color);
  if ($unhashed) {
    return '#' . $unhashed;
  }

  return $color;
}

/**
 * Adds sanitization callback function: Nohtml
 * @package b5st
 */
function b5st_sanitize_nohtml($input)
{
  return wp_filter_nohtml_kses($input);
}

/**
 * Adds sanitization callback function: Number
 * @package b5st
 */
function b5st_sanitize_number($input)
{
  if (isset($input) && is_numeric($input)) {
    return $input;
  }
}

/**
 * Adds sanitization callback function: Strip Slashes
 * @package b5st
 */
function b5st_sanitize_strip_slashes($input)
{
  return wp_kses_stripslashes($input);
}

/**
 * Adds sanitization callback function: Sanitize Text area
 * @package b5st
 */
function b5st_sanitize_textarea($input)
{
  return sanitize_text_field($input);
}

/**
 * Adds sanitization callback function: Slider Category
 * @package b5st
 */
function b5st_sanitize_slidecat($input)
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
 * @package b5st
 */
function b5st_sanitize_layout($input)
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
 * @package b5st
 */
function b5st_sanitize_typo_size($input)
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
 * @package b5st
 */
function b5st_sanitize_typo_face($input)
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
 * @package b5st
 */
function b5st_sanitize_typo_style($input)
{
  global $typography_options, $typography_defaults;
  if (array_key_exists($input, $typography_options['styles'])) {
    return $input;
  } else {
    return $typography_defaults['style'];
  }
}
