<div id="post-filter">
    
    <?php
        $post_type = 'movie';

        $taxonomies = get_object_taxonomies($post_type, 'objects');

        $specific_taxonomies = array('genre', 'age'); 

        foreach ($specific_taxonomies as $taxonomy_slug) {
            if (isset($taxonomies[$taxonomy_slug])) {
                $terms = get_terms(array(
                    'taxonomy' => $taxonomy_slug,
                    'hide_empty' => false, 
                ));

                if (!empty($terms) && !is_wp_error($terms)) {
                    ?>
                    <label for="<?php echo esc_attr($taxonomy_slug); ?>-filter"><?php echo esc_html($taxonomies[$taxonomy_slug]->label); ?> Filter</label>
                    <select id="<?php echo esc_attr($taxonomy_slug); ?>-filter" name="<?php echo esc_attr($taxonomy_slug); ?>" class="posts-filter">
                        <option value="">Select <?php echo esc_html($taxonomies[$taxonomy_slug]->label); ?></option>
                        <?php foreach ($terms as $term) : ?>
                            <option value="<?php echo esc_attr($term->slug); ?>">
                                <?php echo esc_html($term->name); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <?php
                } 
            }
        }
    ?>

</div>
