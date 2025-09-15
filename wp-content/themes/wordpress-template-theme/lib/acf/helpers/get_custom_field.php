<?php 
    function get_custom_field($field_name) {

        $post_type = get_post_type();

        if (function_exists('get_field')) {
            global $post;
            $post_id = $post->ID;

            $custom_fields = get_field($post_type, $post_id); 

            if ($custom_fields && isset($custom_fields[$field_name])) {
                return $custom_fields[$field_name];
            } else {
                return 'No custom field found.';
            }
        }
        return 'ACF is not active.';
    }
?>