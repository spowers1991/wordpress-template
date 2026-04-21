<?php 
    function get_custom_field($field_name) {

        $post_type = get_post_type();
        $post_id = get_the_ID();

        if (!$post_id) {
            global $post;
            $post_id = isset($post->ID) ? (int) $post->ID : 0;
        }

        if (function_exists('get_field') && $post_id > 0) {
            // First, try reading the field directly by its ACF field name.
            $field_value = get_field($field_name, $post_id);
            if ($field_value !== null && $field_value !== false && $field_value !== '') {
                return $field_value;
            }

            // Fallback: support nested fields when a Group field uses the post type as its name.
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