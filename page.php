<?php
/**
 * The template for displaying all page posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @since Puls Norge 1.0
 */

get_header(); 

/* Start the Loop */
while ( have_posts() ) :
	the_post();

	// get_template_part( 'template-parts/content/content-single' );
    the_content();

endwhile; // End of the loop.

get_footer();
