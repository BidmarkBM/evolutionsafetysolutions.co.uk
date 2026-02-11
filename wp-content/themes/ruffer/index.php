<?php
/**
 * @Packge     : Ruffer
 * @Version    : 1.0
 * @Author     : Themeholy
 * @Author URI : https://www.themeholy.com/
 *
 */

// Block direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}   
    // Header
    get_header();

    /**
    * 
    * Hook for Blog Start Wrapper
    *
    * Hook ruffer_blog_start_wrap
    *
    * @Hooked ruffer_blog_start_wrap_cb 10
    *  
    */
    do_action( 'ruffer_blog_start_wrap' );

    /**
    * 
    * Hook for Blog Column Start Wrapper
    *
    * Hook ruffer_blog_col_start_wrap
    *
    * @Hooked ruffer_blog_col_start_wrap_cb 10
    *  
    */
    do_action( 'ruffer_blog_col_start_wrap' );

    /**
    * 
    * Hook for Blog Content
    *
    * Hook ruffer_blog_content
    *
    * @Hooked ruffer_blog_content_cb 10
    *  
    */
    do_action( 'ruffer_blog_content' );

    /**
    * 
    * Hook for Blog Pagination
    *
    * Hook ruffer_blog_pagination
    *
    * @Hooked ruffer_blog_pagination_cb 10
    *  
    */
    do_action( 'ruffer_blog_pagination' ); 

    /**
    * 
    * Hook for Blog Column End Wrapper
    *
    * Hook ruffer_blog_col_end_wrap
    *
    * @Hooked ruffer_blog_col_end_wrap_cb 10
    *  
    */
    do_action( 'ruffer_blog_col_end_wrap' ); 

    /**
    * 
    * Hook for Blog Sidebar
    *
    * Hook ruffer_blog_sidebar
    *
    * @Hooked ruffer_blog_sidebar_cb 10
    *  
    */
    do_action( 'ruffer_blog_sidebar' );     
        
    /**
    * 
    * Hook for Blog End Wrapper
    *
    * Hook ruffer_blog_end_wrap
    *
    * @Hooked ruffer_blog_end_wrap_cb 10
    *  
    */
    do_action( 'ruffer_blog_end_wrap' );

    //footer
    get_footer();