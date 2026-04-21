<?php

    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    if (!function_exists('get_current_genre')) {
        function get_current_genre() {
            if (isset($_SESSION['selected_genre'])) {
                return sanitize_text_field((string) $_SESSION['selected_genre']);
            }

            return '';
        }
    }

    if (!function_exists('get_current_age')) {
        function get_current_age() {
            if (isset($_SESSION['selected_age'])) {
                return sanitize_text_field((string) $_SESSION['selected_age']);
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

        public static function output_current_genre() {
            if (function_exists('get_current_genre')) {
                echo esc_html(get_current_genre());
            }
        }

        public static function output_current_age() {
            if (function_exists('get_current_age')) {
                echo esc_html(get_current_age());
            }
        }
    }
?>
