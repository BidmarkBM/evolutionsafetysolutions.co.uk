<?php
/**
 * Template Name: Comming Soon Page
 * Description: The template file for displaying comming soon page
 *
 * @package RUFFER
 */

get_header();

	while ( have_posts() ) : the_post();

		the_content();

		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;

	endwhile; // End of the loop.
	
get_footer();