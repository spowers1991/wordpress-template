<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package wordpress-template-theme
 */

get_header(); 

$taxonomy = 'genre'; 
$terms = get_terms(array(
    'taxonomy' => $taxonomy,
    'hide_empty' => false,
));

if (empty($terms) || is_wp_error($terms)) {
    echo "No terms found or an error occurred.";
} else {
    ?>
        <main id="primary" class="site-main container m-auto flex flex-col gap-12">

            <?php include locate_template('partials/filter-form.php');  ?>

            <div id="filtered-posts">
                <?php
                    $args = array(
                        'post_type' => 'movie', 
                        'posts_per_page' => -1,
                    );
                    $query = new WP_Query($args);

                    include locate_template('partials/post-list.php');
                ?>
            </div>

            <div class="my-12">
                <?php echo get_custom_field('additional_info'); ?>
            </div>

        </main>
    <?php
}

get_footer();
?>
