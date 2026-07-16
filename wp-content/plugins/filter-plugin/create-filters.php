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
    $post_type = 'movie';
    $selected_options = [];
    $taxonomy_slugs = get_object_taxonomies($post_type, 'names');

    if (!empty($taxonomy_slugs)) {
        foreach ($taxonomy_slugs as $taxonomy_slug) {
            $selected_value = isset($_POST[$taxonomy_slug]) ? sanitize_text_field($_POST[$taxonomy_slug]) : '';

            if (!empty($selected_value)) {
                $selected_options[$taxonomy_slug] = [$selected_value];
            }
        }
    }

    // Create Filters instance with selected options.
    $filters = new \Filters($post_type, $selected_options);

    // Get the query results
    $query = $filters->get_query();

    // Include the template parts to display the filtered results
    include(plugin_dir_path(__FILE__) . 'includes/helpers/get-template-parts.php');
    
    // End AJAX request
    wp_die(); 
}

add_action('wp_ajax_create_filters', 'fm_create_filters');
add_action('wp_ajax_nopriv_create_filters', 'fm_create_filters');
