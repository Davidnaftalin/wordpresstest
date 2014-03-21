<?php

get_header(); ?>

    <div>
        <div>
            <?php $args = array('post_type' => 'people', 'posts_per_page' => 10);
            $loop = new WP_Query($args);
            while ($loop->have_posts()) : $loop->the_post(); ?>
                <a href = <?php echo get_post_permalink();?> ><?php the_title() ?></a>
          <?php echo '<div>';
                the_content();
                echo '</div>';

                $terms = wp_get_post_terms( get_the_ID(), 'skills');
                foreach ($terms as $term) {
                    echo "<li> $term->name  </li>";
                } ?>



     <a href = http://www.twitter.com/<?php echo clean_twitter_url(get_field('twitter', $post->ID)); ?>> <img src ="http://www.godogs.org.uk/wp-content/blogs.dir/34/files/2013/05/Twitter_Logo_small.png"> </a>
            <br>


            <?php
            // Find connected pages
            $connected = new WP_Query(array(
                'connected_type' => 'people_to_projects',
                'connected_items' => get_the_ID(),
                'nopaging' => true,
            ));

            // Display connected pages
            if ($connected->have_posts()) :
                ?>
                <h3>Projects:</h3>
                <ul>
                    <?php while ($connected->have_posts()) : $connected->the_post(); ?>
                        <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                    <?php endwhile; ?>
                </ul>

<?php
// Prevent weirdness
                wp_reset_postdata();

            endif;

            endwhile;
            ?>
        </div>
        <!-- #content -->
    </div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>