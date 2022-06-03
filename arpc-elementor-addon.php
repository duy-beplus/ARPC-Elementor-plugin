<?php

/**
 * Plugin Name:  ARPC Elementor Addon
 * Description: Custom Elementor Widgets on ARPC devsite.
 * Plugin URI:  https://elementor.com/
 * Version:     1.1.1
 * Author:      Beplus
 * Author URI:  https://developers.elementor.com/
 * Text Domain: community-elementor-addon
 *
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

function arpc_elementor_addon()
{

    // Load plugin file
    require_once(__DIR__ . '/includes/plugin.php');

    // Run the plugin
    \Community_Elementor_Addon\Plugin::instance();
}
add_action('plugins_loaded', 'arpc_elementor_addon');

// Create New categories for widgets
function add_elementor_widget_categories($elements_manager)
{
    $elements_manager->add_category(
        'custom-category',
        [
            'title' => esc_html__('Custom Category', 'custom-elementor'),
            'icon' => 'fa fa-plug',
        ]
    );
}
add_action('elementor/elements/categories_registered', 'add_elementor_widget_categories');
