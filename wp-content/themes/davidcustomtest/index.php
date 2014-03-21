<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

	<div>
		<div>
		<?php if ( have_posts() ) : ?>

            <ul class="dave-content"><?php
                /* Start the Loop */
                while ( have_posts() ) : the_post(); ?>
                    <li class="dave-content">
                        <?php $image=get_field('featured_image'); ?>
                       <a href="<?php the_permalink();?>"><img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" /></a>

                        <a id="david-post-title" href= "<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        <?php the_excerpt();
                              new_excerpt_more($more);
                        $author = get_author_post($post->post_author); ?>
                        <a id="david-author" href="<?php echo get_post_permalink($author->ID);?>"> <?php echo $author->post_title ?> </a>
                    </li>
                    <?php

                    endwhile; ?>
            </ul>


		  	<?php //twentytwelve_content_nav( 'nav-below' ); ?>

		<?php else : ?>

			<article>

			<?php if ( current_user_can( 'edit_posts' ) ) :
				// Show a different message to a logged-in user who can add posts.
			?>
				<header>
					<h1><?php _e( 'No posts to display', 'twentytwelve' ); ?></h1>
				</header>

				<div>
					<p><?php printf( __( 'Ready to publish your first post? <a href="%s">Get started here</a>.', 'twentytwelve' ), admin_url( 'post-new.php' ) ); ?></p>
				</div><!-- .entry-content -->

			<?php else :
				// Show the default message to everyone else.
			?>
				<header>
					<h1><?php _e( 'Nothing Found', 'twentytwelve' ); ?></h1>
				</header>

				<div>
					<p><?php _e( 'Apologies, but no results were found. Perhaps searching will help find a related post.', 'twentytwelve' ); ?></p>
					<?php get_search_form(); ?>
				</div><!-- .entry-content -->
			<?php endif; // end current_user_can() check ?>

			</article><!-- #post-0 -->

		<?php endif; // end have_posts() check ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>