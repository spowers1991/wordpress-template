<?php

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            ?>
                <div class="py-12 border-b-2">
                    <a href="<?php the_permalink(); ?>">
                        <div class="post-item">
                            <h2><?php the_title(); ?></h2>
                            <p><?php the_excerpt(); ?></p>
                        </div>
                    </a>
                </div>
            <?php
        }
    } else {
        echo '<p>No posts found.</p>';
    }
    wp_reset_postdata();
    
?>
