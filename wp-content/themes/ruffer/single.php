<?php

/**
 * @Packge     : Ruffer
 * @Version    : 1.0
 * @Author     : Themeholy
 * @Author URI : https://www.themeholy.com/
 *
 */

// Block direct access
if (! defined('ABSPATH')) {
	exit();
}

//header
get_header();

/**
 * 
 * Hook for Blog Details Wrapper
 *
 * Hook ruffer_blog_details_wrapper_start
 *
 * @Hooked ruffer_blog_details_wrapper_start_cb 10
 *  
 */
do_action('ruffer_blog_details_wrapper_start');

/**
 * 
 * Hook for Blog Details Column Start
 *
 * Hook ruffer_blog_details_col_start
 *
 * @Hooked ruffer_blog_details_col_start_cb 10
 *  
 */
do_action('ruffer_blog_details_col_start');

while (have_posts()) :
	the_post(); // Initialize the post data

	// Check if Elementor is active and we are in preview mode
	// This ensures Elementor can find the content area even if the template part logic skips it (e.g. empty content)
	if (class_exists('Elementor\Plugin') && \Elementor\Plugin::$instance->preview->is_preview_mode()) {
		the_content();
	} else {
		get_template_part('templates/content-single');
	}

endwhile;
/**
 * 
 * Hook for Blog Details Column End
 *
 * Hook ruffer_blog_details_col_end
 *
 * @Hooked ruffer_blog_details_col_end_cb 10
 *  
 */
do_action('ruffer_blog_details_col_end');

/**
 * 
 * Hook for Blog Details Sidebar
 *
 * Hook ruffer_blog_details_sidebar
 *
 * @Hooked ruffer_blog_details_sidebar_cb 10
 *  
 */
do_action('ruffer_blog_details_sidebar');
/**
 * 
 * Hook for Blog Details Wrapper End
 *
 * Hook ruffer_blog_details_wrapper_end
 *
 * @Hooked ruffer_blog_details_wrapper_end_cb 10
 *  
 */
do_action('ruffer_blog_details_wrapper_end');

//footer
get_footer();
