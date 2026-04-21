<?php
/*
Plugin Name: My Plugins
Description: A plugin to manage sub-plugins, including a filter plugin.
Version: 1.0
Author: Steven Powers
*/

// Hook to add a settings page to the admin menu
add_action('admin_menu', 'my_plugins_add_settings_page');

// Hook to register the settings
add_action('admin_init', 'my_plugins_register_settings');

// Hook to check the status of sub-plugins during WordPress initialization
add_action('admin_init', 'my_plugins_check_sub_plugins');

// Function to add the settings page to the WordPress admin menu
function my_plugins_add_settings_page() {
    // Security check to ensure the user has the right permissions
    if (current_user_can('manage_options')) {
        add_menu_page(
            'My Plugins Settings',    // Page title
            'My Plugins',             // Menu title
            'manage_options',         // Capability
            'my-plugins-settings',    // Menu slug
            'my_plugins_settings_page', // Callback to display the settings page
            'dashicons-admin-plugins',  // Icon (optional)
            80                         // Position (optional)
        );
    }
}

// Callback function to display the content of the settings page
function my_plugins_settings_page() {
    require_once(plugin_dir_path(__FILE__) . 'settings-page.php');
}

// Function to register the plugin settings
function my_plugins_register_settings() {
    // Register the settings group and the specific option
    register_setting('my_plugins_settings_group', 'filters_plugin_active');

    // You can add a section to organize your settings if needed
    add_settings_section(
        'my_plugins_main_section',  // ID
        'Main Settings',            // Title
        null,                       // Callback (optional)
        'my-plugins-settings'       // Page slug
    );

    // Add a settings field to the settings section
    add_settings_field(
        'filters_plugin_active',           // ID
        'Activate Filter Plugin',          // Title of the field
        'my-plugins-settings',             // Page slug
        'my_plugins_main_section'          // Section ID
    );
}

// Include the file for checking sub-plugins (use require_once to prevent redeclaration)
require_once(plugin_dir_path(__FILE__) . 'activation.php');
?>
