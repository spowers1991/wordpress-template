<?php
// Setup Admin Ajax 
function fm_enqueue_scripts() {
    wp_enqueue_script('fm-filters', plugin_dir_url(__FILE__) . '../js/filters.js', array('jquery'), '1.0', true);

    wp_localize_script('fm-filters', 'ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php')
    ));
}
add_action('wp_enqueue_scripts', 'fm_enqueue_scripts');
