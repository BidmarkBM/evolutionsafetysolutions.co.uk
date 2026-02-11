<?php 
/**
 * @Packge     : Ruffer
 * @Version    : 1.0
 * @Author     : Themeholy
 * @Author URI : https://www.themeholy.com/
 *
 */
 
	// Block direct access
	if( ! defined( 'ABSPATH' ) ){
		exit();
	}

	/**
	* Hook for preloader
	*/
	add_action( 'ruffer_preloader_wrap', 'ruffer_preloader_wrap_cb', 10 );

	/**
	* Hook for offcanvas cart
	*/
	add_action( 'ruffer_main_wrapper_start', 'ruffer_main_wrapper_start_cb', 10 );

	/**
	* Hook for Header
	*/
	add_action( 'ruffer_header', 'ruffer_header_cb', 10 );
	
	/**
	* Hook for Blog Start Wrapper
	*/
	add_action( 'ruffer_blog_start_wrap', 'ruffer_blog_start_wrap_cb', 10 );
	
	/**
	* Hook for Blog Column Start Wrapper
	*/
    add_action( 'ruffer_blog_col_start_wrap', 'ruffer_blog_col_start_wrap_cb', 10 );
	
	/**
	* Hook for Blog Column End Wrapper
	*/
    add_action( 'ruffer_blog_col_end_wrap', 'ruffer_blog_col_end_wrap_cb', 10 );
	
	/**
	* Hook for Blog Column End Wrapper
	*/
    add_action( 'ruffer_blog_end_wrap', 'ruffer_blog_end_wrap_cb', 10 );
	
	/**
	* Hook for Blog Pagination
	*/
    add_action( 'ruffer_blog_pagination', 'ruffer_blog_pagination_cb', 10 );
    
    /**
	* Hook for Blog Content
	*/
	add_action( 'ruffer_blog_content', 'ruffer_blog_content_cb', 10 );
    
    /**
	* Hook for Blog Sidebar
	*/
	add_action( 'ruffer_blog_sidebar', 'ruffer_blog_sidebar_cb', 10 );
    
    /**
	* Hook for Blog Details Sidebar
	*/
	add_action( 'ruffer_blog_details_sidebar', 'ruffer_blog_details_sidebar_cb', 10 );

	/**
	* Hook for Blog Details Wrapper Start
	*/
	add_action( 'ruffer_blog_details_wrapper_start', 'ruffer_blog_details_wrapper_start_cb', 10 );

	/**
	* Hook for Blog Details Post Meta
	*/
	add_action( 'ruffer_blog_post_meta', 'ruffer_blog_post_meta_cb', 10 );

	/**
	* Hook for Blog Details Post Share Options
	*/
	add_action( 'ruffer_blog_details_share_options', 'ruffer_blog_details_share_options_cb', 10 );

	/**
	* Hook for Blog Details Post Author Bio
	*/
	add_action( 'ruffer_blog_details_author_bio', 'ruffer_blog_details_author_bio_cb', 10 );

	/**
	* Hook for Blog Details Tags and Categories
	*/
	add_action( 'ruffer_blog_details_tags_and_categories', 'ruffer_blog_details_tags_and_categories_cb', 10 );

	/**
	* Hook for Blog Details Related Post Navigation
	*/
	add_action( 'ruffer_blog_details_post_navigation', 'ruffer_blog_details_post_navigation_cb', 10 );

	/**
	* Hook for Blog Deatils Comments
	*/
	add_action( 'ruffer_blog_details_comments', 'ruffer_blog_details_comments_cb', 10 );

	/**
	* Hook for Blog Deatils Column Start
	*/
	add_action('ruffer_blog_details_col_start','ruffer_blog_details_col_start_cb');

	/**
	* Hook for Blog Deatils Column End
	*/
	add_action('ruffer_blog_details_col_end','ruffer_blog_details_col_end_cb');

	/**
	* Hook for Blog Deatils Wrapper End
	*/
	add_action('ruffer_blog_details_wrapper_end','ruffer_blog_details_wrapper_end_cb');
	
	/**
	* Hook for Blog Post Thumbnail
	*/
	add_action('ruffer_blog_post_thumb','ruffer_blog_post_thumb_cb');
    
	/**
	* Hook for Blog Post Content
	*/
	add_action('ruffer_blog_post_content','ruffer_blog_post_content_cb');
	
    
	/**
	* Hook for Blog Post Excerpt And Read More Button
	*/
	add_action('ruffer_blog_postexcerpt_read_content','ruffer_blog_postexcerpt_read_content_cb');
	
	/**
	* Hook for footer content
	*/
	add_action( 'ruffer_footer_content', 'ruffer_footer_content_cb', 10 );
	
	/**
	* Hook for main wrapper end
	*/
	add_action( 'ruffer_main_wrapper_end', 'ruffer_main_wrapper_end_cb', 10 );
	
	/**
	* Hook for Back to Top Button
	*/
	add_action( 'ruffer_back_to_top', 'ruffer_back_to_top_cb', 10 );

	/**
	* Hook for Page Start Wrapper
	*/
	add_action( 'ruffer_page_start_wrap', 'ruffer_page_start_wrap_cb', 10 );

	/**
	* Hook for Page End Wrapper
	*/
	add_action( 'ruffer_page_end_wrap', 'ruffer_page_end_wrap_cb', 10 );

	/**
	* Hook for Page Column Start Wrapper
	*/
	add_action( 'ruffer_page_col_start_wrap', 'ruffer_page_col_start_wrap_cb', 10 );

	/**
	* Hook for Page Column End Wrapper
	*/
	add_action( 'ruffer_page_col_end_wrap', 'ruffer_page_col_end_wrap_cb', 10 );

	/**
	* Hook for Page Column End Wrapper
	*/
	add_action( 'ruffer_page_sidebar', 'ruffer_page_sidebar_cb', 10 );

	/**
	* Hook for Page Content
	*/
	add_action( 'ruffer_page_content', 'ruffer_page_content_cb', 10 );