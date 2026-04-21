<?php
// Check if the function already exists before declaring it
if (!function_exists('my_plugins_check_sub_plugins')) {

    function my_plugins_check_sub_plugins() {
        // Include necessary functions for plugin activation/deactivation
        require_once ABSPATH . 'wp-admin/includes/plugin.php';

        // Get the current activation status of the sub-plugin from the database
        if (get_option('filters_plugin_active', 0)) {
            // If the filter plugin is set to be active, activate it
            my_plugins_activate_filter_plugin();
        } else {
            // Otherwise, deactivate the filter plugin
            my_plugins_deactivate_filter_plugin();
        }
    }

    function my_plugins_activate_filter_plugin() {
        // Define the full path to the sub-plugin's main file, relative to the plugins directory
        $sub_plugin = 'filter-plugin/create-filters.php';

        // Check if the plugin is already active to avoid double activation
        if (!is_plugin_active($sub_plugin)) {
            // Activate the sub-plugin
            activate_plugin($sub_plugin);

            // Log the activation for debugging
            error_log("Filter Plugin Activated");
        }
    }

    function my_plugins_deactivate_filter_plugin() {
        // Define the full path to the sub-plugin's main file, relative to the plugins directory
        $sub_plugin = 'filter-plugin/create-filters.php';

        // Check if the plugin is active before trying to deactivate it
        if (is_plugin_active($sub_plugin)) {
            // Deactivate the sub-plugin
            deactivate_plugins($sub_plugin);

            // Log the deactivation for debugging
            error_log("Filter Plugin Deactivated");
        }
    }
}
?>
