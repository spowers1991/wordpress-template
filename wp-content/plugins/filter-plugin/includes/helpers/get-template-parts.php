<?php
    // Define the paths to the plugin and theme partial files
    $plugin_partial = plugin_dir_path(__FILE__) . 'partials/post-list.php';
    $theme_partial = locate_template('partials/post-list.php');

    if ($theme_partial && file_exists($theme_partial)) {
        // Include the theme partial
        include $theme_partial;
    } else {
        // Check if the plugin partial exists
        if (file_exists($plugin_partial)) {
            // Include the plugin partial if the theme version is missing
            include $plugin_partial;
        } else {
            echo '<p>No posts found. Please check back later.</p>';
        }
    }
?>