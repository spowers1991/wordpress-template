<?php

    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    if (!function_exists('get_current_taxonomy_value')) {
        function get_current_taxonomy_value($taxonomy) {
            $taxonomy_key = sanitize_key((string) $taxonomy);
            $session_key = 'selected_' . $taxonomy_key;

            if (isset($_SESSION[$session_key])) {
                return sanitize_text_field((string) $_SESSION[$session_key]);
            }

            return '';
        }
    }

    class Filters {
        private $query;

        public function __construct($post_type, $selected_options) {

            $args = array(
                'post_type'      => $post_type, 
                'posts_per_page' => -1,
                'tax_query'      => array(
                    'relation' => 'AND', 
                ),
            );

            foreach ($selected_options as $taxonomy => $options) {
                if (!empty($options) && is_array($options)) {
                    foreach ($options as $option) {
                        if (!empty($option)) {
                            $args['tax_query'][] = array(
                                'taxonomy' => $taxonomy,
                                'field'    => 'slug',
                                'terms'    => $option,
                            );

                            $_SESSION['selected_' . $taxonomy] = $option; 
                        }
                    }
                }
            }

            $this->query = new \WP_Query($args);

        }

        public function get_query() {
            return $this->query;
        }

        public static function output_current_taxonomy($taxonomy) {
            if (function_exists('get_current_taxonomy_value')) {
                echo esc_html(get_current_taxonomy_value($taxonomy));
            }
        }
    }
?>
