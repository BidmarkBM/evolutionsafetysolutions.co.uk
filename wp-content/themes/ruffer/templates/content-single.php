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

    ruffer_setPostViews( get_the_ID() );

    ?>
    <div <?php post_class(); ?>>
    <?php
        if( class_exists('ReduxFramework') ) {
            $ruffer_post_details_title_position = ruffer_opt('ruffer_post_details_title_position');
        } else {
            $ruffer_post_details_title_position = 'header';
        }

        $allowhtml = array(
            'p'         => array(
                'class'     => array()
            ),
            'span'      => array(),
            'a'         => array(
                'href'      => array(),
                'title'     => array()
            ),
            'br'        => array(),
            'em'        => array(),
            'strong'    => array(),
            'b'         => array(),
        );
        // Blog Post Thumbnail
        do_action( 'ruffer_blog_post_thumb' );

        if( $ruffer_post_details_title_position != 'header' ) {
            echo '<h2 class="blog-title h3">'.wp_kses( get_the_title(), $allowhtml ).'</h2>';
        }
        
        echo '<div class="blog-content">';
            // Blog Post Meta
            do_action( 'ruffer_blog_post_meta' );

            if( get_the_content() ){

                the_content();
                // Link Pages
                ruffer_link_pages();
            }
        echo '</div>';

        if( class_exists('ReduxFramework') ) {
            $ruffer_post_details_share_options = ruffer_opt('ruffer_post_details_share_options');
        } else {
            $ruffer_post_details_share_options = false;
        }
        
        $ruffer_post_tag = get_the_tags();
        
        if( ! empty( $ruffer_post_tag ) || ( function_exists( 'ruffer_social_sharing_buttons' ) || $ruffer_post_details_share_options ) ){
            echo '<div class="share-links clearfix">';
                echo '<div class="row justify-content-between">';
                    if( is_array( $ruffer_post_tag ) && ! empty( $ruffer_post_tag ) ){
                        if( count( $ruffer_post_tag ) > 1 ){
                            $tag_text = __( 'Tags:', 'ruffer' );
                        }else{
                            $tag_text = __( 'Tag:', 'ruffer' );
                        }
                        
                        echo '<div class="col-sm-auto">';
                            echo '<span class="share-links-title">'.esc_html( $tag_text ).'</span>';
                            echo '<div class="tagcloud">';
                                foreach( $ruffer_post_tag as $tags ){
                                    echo '<a href="'.esc_url( get_tag_link( $tags->term_id ) ).'">'.esc_html( $tags->name ).'</a>';
                                }
                            echo '</div>';
                        echo '</div>';
                    }

                    /**
                    *
                    * Hook for Blog Details Share Options
                    *
                    * Hook ruffer_blog_details_share_options
                    *
                    * @Hooked ruffer_blog_details_share_options_cb 10
                    *
                    */
                    do_action( 'ruffer_blog_details_share_options' );
                echo '</div>';
            echo '</div>';
        }

         

        /**
        *
        * Hook for Blog Details Author Bio
        *
        * Hook ruffer_blog_details_author_bio
        *
        * @Hooked ruffer_blog_details_author_bio_cb 10
        *
        */
        do_action( 'ruffer_blog_details_author_bio' );

        /**
        *
        * Hook for Blog Details Comments
        *
        * Hook ruffer_blog_details_comments
        *
        * @Hooked ruffer_blog_details_comments_cb 10
        *
        */
        do_action( 'ruffer_blog_details_comments' );

    echo '</div>';   
    