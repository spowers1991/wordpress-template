<?php

/*
Plugin Name: Filters
Description: A plugin to filter custom posts using AJAX
Version: 1.0
Author: Steven Powers
*/

include_once(plugin_dir_path(__FILE__) . 'ajax/ajax-scripts.php');
include_once(plugin_dir_path(__FILE__) . 'includes/Filters.php');

// Ajax function
function fm_create_filters() {
    // Get the selected values from the AJAX request
    $selected_genre = isset($_POST['genre']) ? sanitize_text_field($_POST['genre']) : '';
    $selected_age = isset($_POST['age']) ? sanitize_text_field($_POST['age']) : '';

    // Construct selected_options as an associative array
    $selected_options = [];

    // Add selected genre if not empty
    if (!empty($selected_genre)) {
        $selected_options['genre'] = [$selected_genre]; // Store as array
    }

    // Add selected age if not empty
    if (!empty($selected_age)) {
        $selected_options['age'] = [$selected_age]; // Store as array
    }

    // Create Filters instance with post type 'movie' and selected options
    $filters = new \Filters('movie', $selected_options);

    // Get the query results
    $query = $filters->get_query();

    // Include the template parts to display the filtered results
    include(plugin_dir_path(__FILE__) . 'includes/helpers/get-template-parts.php');
    
    // End AJAX request
    wp_die(); 
}

add_action('wp_ajax_create_filters', 'fm_create_filters');
add_action('wp_ajax_nopriv_create_filters', 'fm_create_filters');
