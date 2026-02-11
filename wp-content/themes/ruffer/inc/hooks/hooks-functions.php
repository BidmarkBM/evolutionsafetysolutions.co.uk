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


    // preloader hook function 
    if( ! function_exists( 'ruffer_preloader_wrap_cb' ) ) {
        function ruffer_preloader_wrap_cb() {
            $preloader_display              =  ruffer_opt('ruffer_display_preloader');

            if( class_exists('ReduxFramework') ){
                if( $preloader_display ){
                    echo '<div class="preloader">';
                        echo '<button class="th-btn style2 preloaderCls">'.esc_html__( 'Cancel Preloader', 'ruffer' ).'</button>';
                        echo '<div class="preloader-inner">';
                            if( ! empty( ruffer_opt( 'ruffer_preloader_img','url' ) ) ){
                                echo ruffer_img_tag( array(
                                    'url'   => esc_url( ruffer_opt( 'ruffer_preloader_img','url' ) ),
                                    'class' => 'loader-img',
                                ) );  
                            }else{
                               echo '<span class="loader"></span>';
                            }
                        echo '</div>';
                    echo '</div>';
                }
            }else{
                echo '<div class="preloader">';
                    echo '<button class="th-btn style2 preloaderCls">'.esc_html__( 'Cancel Preloader', 'ruffer' ).'</button>';
                    echo '<div class="preloader-inner">';
                        echo '<span class="loader"></span>';
                    echo '</div>';
                echo '</div>';
            }
        }
    }

    // Header Hook function
    if( !function_exists('ruffer_header_cb') ) {
        function ruffer_header_cb( ) {
            get_template_part('templates/header');
            get_template_part('templates/header-menu-bottom');
        }
    }

    // back top top hook function
    if( ! function_exists( 'ruffer_back_to_top_cb' ) ) {
        function ruffer_back_to_top_cb( ) {
            $backtotop_trigger = ruffer_opt('ruffer_display_bcktotop');
            if( class_exists( 'ReduxFramework' ) ) {
                if( $backtotop_trigger ) {
                    echo '<!-- Back to Top Button -->';
                    echo '<div class="scroll-top">';
                        echo '<svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">';
                            echo '<path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" style="transition: stroke-dashoffset 10ms linear 0s; stroke-dasharray: 307.919, 307.919; stroke-dashoffset: 307.919;"></path>';
                        echo '</svg>';
                    echo '</div>';
                    echo '<!-- End of Back to Top Button -->';
                }else {
                    echo '<!-- Back to Top Button -->';
                    echo '<div class="scroll-top">';
                        echo '<svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">';
                            echo '<path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" style="transition: stroke-dashoffset 10ms linear 0s; stroke-dasharray: 307.919, 307.919; stroke-dashoffset: 307.919;"></path>';
                        echo '</svg>';
                    echo '</div>';
                    echo '<!-- End of Back to Top Button -->';
                }
            }

        }
    }

    // Blog Start Wrapper Function
    if( !function_exists('ruffer_blog_start_wrap_cb') ) {
        function ruffer_blog_start_wrap_cb() {
            echo '<section class="th-blog-wrapper space-top space-extra-bottom arrow-wrap">';
                echo '<div class="container">';
                    echo '<div class="row gx-30">';
        }
    }

    // Blog End Wrapper Function
    if( !function_exists('ruffer_blog_end_wrap_cb') ) {
        function ruffer_blog_end_wrap_cb() {
                    echo '</div>';
                echo '</div>';
            echo '</section>';
        }
    }

    // Blog Column Start Wrapper Function
    if( !function_exists('ruffer_blog_col_start_wrap_cb') ) {
        function ruffer_blog_col_start_wrap_cb() {
            if( class_exists('ReduxFramework') ) {
                $ruffer_blog_sidebar = ruffer_opt('ruffer_blog_sidebar');
                if( $ruffer_blog_sidebar == '2' && is_active_sidebar('ruffer-blog-sidebar') ) {
                    echo '<div class="col-xxl-8 col-lg-7 order-lg-last">';
                } elseif( $ruffer_blog_sidebar == '3' && is_active_sidebar('ruffer-blog-sidebar') ) {
                    echo '<div class="col-xxl-8 col-lg-7">';
                } else {
                    echo '<div class="col-lg-12">';
                }

            } else {
                if( is_active_sidebar('ruffer-blog-sidebar') ) {
                    echo '<div class="col-xxl-8 col-lg-7">';
                } else {
                    echo '<div class="col-lg-12">';
                }
            }
        }
    }
    // Blog Column End Wrapper Function
    if( !function_exists('ruffer_blog_col_end_wrap_cb') ) {
        function ruffer_blog_col_end_wrap_cb() {
            echo '</div>';
        }
    }

    // Blog Sidebar
    if( !function_exists('ruffer_blog_sidebar_cb') ) {
        function ruffer_blog_sidebar_cb( ) {
            if( class_exists('ReduxFramework') ) {
                $ruffer_blog_sidebar = ruffer_opt('ruffer_blog_sidebar');
            } else {
                $ruffer_blog_sidebar = 2;
                
            }
            if( $ruffer_blog_sidebar != 1 && is_active_sidebar('ruffer-blog-sidebar') ) {
                // Sidebar
                get_sidebar();
            }
        }
    }


    if( !function_exists('ruffer_blog_details_sidebar_cb') ) {
        function ruffer_blog_details_sidebar_cb( ) {
            if( class_exists('ReduxFramework') ) {
                $ruffer_blog_single_sidebar = ruffer_opt('ruffer_blog_single_sidebar');
            } else {
                $ruffer_blog_single_sidebar = 4;
            }
            if( $ruffer_blog_single_sidebar != 1 ) {
                // Sidebar
                get_sidebar();
            }

        }
    }

    // Blog Pagination Function
    if( !function_exists('ruffer_blog_pagination_cb') ) {
        function ruffer_blog_pagination_cb( ) {
            get_template_part('templates/pagination');
        }
    }

    // Blog Content Function
    if( !function_exists('ruffer_blog_content_cb') ) {
        function ruffer_blog_content_cb( ) {
            if( class_exists('ReduxFramework') ) {
                $ruffer_blog_grid = ruffer_opt('ruffer_blog_grid');
            } else {
                $ruffer_blog_grid = '1';
            }

            if( $ruffer_blog_grid == '1' ) {
                $ruffer_blog_grid_class = 'col-lg-12';
            } elseif( $ruffer_blog_grid == '2' ) {
                $ruffer_blog_grid_class = 'col-sm-6';
            } else {
                $ruffer_blog_grid_class = 'col-lg-4 col-sm-6';
            }

            echo '<div class="row">';
                if( have_posts() ) {
                    while( have_posts() ) {
                        the_post();
                        echo '<div class="'.esc_attr($ruffer_blog_grid_class).'">';
                            get_template_part('templates/content',get_post_format());
                        echo '</div>';
                    }
                    wp_reset_postdata();
                } else{
                    get_template_part('templates/content','none');
                }
            echo '</div>';
        }
    }

    // footer content Function
    if( !function_exists('ruffer_footer_content_cb') ) {
        function ruffer_footer_content_cb( ) {

            if( class_exists('ReduxFramework') && did_action( 'elementor/loaded' )  ){
                if( is_page() || is_page_template('template-builder.php') ) {
                    $post_id = get_the_ID();

                    // Get the page settings manager
                    $page_settings_manager = \Elementor\Core\Settings\Manager::get_settings_managers( 'page' );

                    // Get the settings model for current post
                    $page_settings_model = $page_settings_manager->get_model( $post_id );

                    // Retrieve the Footer Style
                    $footer_settings = $page_settings_model->get_settings( 'ruffer_footer_style' );

                    // Footer Local
                    $footer_local = $page_settings_model->get_settings( 'ruffer_footer_builder_option' );

                    // Footer Enable Disable
                    $footer_enable_disable = $page_settings_model->get_settings( 'ruffer_footer_choice' );

                    if( $footer_enable_disable == 'yes' ){
                        if( $footer_settings == 'footer_builder' ) {
                            // local options
                            $ruffer_local_footer = get_post( $footer_local );
                            echo '<footer>';
                            echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $ruffer_local_footer->ID );
                            echo '</footer>';
                        } else {
                            // global options
                            $ruffer_footer_builder_trigger = ruffer_opt('ruffer_footer_builder_trigger');
                            if( $ruffer_footer_builder_trigger == 'footer_builder' ) {
                                echo '<footer>';
                                $ruffer_global_footer_select = get_post( ruffer_opt( 'ruffer_footer_builder_select' ) );
                                $footer_post = get_post( $ruffer_global_footer_select );
                                echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $footer_post->ID );
                                echo '</footer>';
                            } else {
                                // wordpress widgets
                                ruffer_footer_global_option();
                            }
                        }
                    }
                } else {
                    // global options
                    $ruffer_footer_builder_trigger = ruffer_opt('ruffer_footer_builder_trigger');
                    if( $ruffer_footer_builder_trigger == 'footer_builder' ) {
                        echo '<footer>';
                        $ruffer_global_footer_select = get_post( ruffer_opt( 'ruffer_footer_builder_select' ) );
                        $footer_post = get_post( $ruffer_global_footer_select );
                        echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $footer_post->ID );
                        echo '</footer>';
                    } else {
                        // wordpress widgets
                        ruffer_footer_global_option();
                    }
                }
            } else {
                echo '<div class="footer-wrapper footer-layout1 footer-sitcky">';
                    echo '<div class="copyright-wrap">';
                        echo '<div class="container">';
                            echo '<p class="copyright-text text-center">'.sprintf( 'Copyright <i class="fal fa-copyright"></i> %s <a href="%s">%s</a> All Rights Reserved by <a href="%s">%s</a>',date('Y'),esc_url('#'),__( 'Ruffer.','ruffer' ),esc_url('https://themeforest.net/user/th'),__( 'Themeholy', 'ruffer' ) ).'</p>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            }

        }
    }

    // blog details wrapper start hook function
    if( !function_exists('ruffer_blog_details_wrapper_start_cb') ) {
        function ruffer_blog_details_wrapper_start_cb( ) {
            echo '<section class="th-blog-wrapper blog-details space-top space-extra-bottom">';
                echo '<div class="container">';
                    
                    echo '<div class="row gx-30">';
        }
    }

    // blog details column wrapper start hook function
    if( !function_exists('ruffer_blog_details_col_start_cb') ) {
        function ruffer_blog_details_col_start_cb( ) {
            if( class_exists('ReduxFramework') ) {
                $ruffer_blog_single_sidebar = ruffer_opt('ruffer_blog_single_sidebar');
                if( $ruffer_blog_single_sidebar == '2' && is_active_sidebar('ruffer-blog-sidebar') ) {
                    echo '<div class="col-xxl-8 col-lg-7 order-last">';
                } elseif( $ruffer_blog_single_sidebar == '3' && is_active_sidebar('ruffer-blog-sidebar') ) {
                    echo '<div class="col-xxl-8 col-lg-7">';
                } else {
                    echo '<div class="col-lg-12">';
                }

            } else {
                if( is_active_sidebar('ruffer-blog-sidebar') ) {
                    echo '<div class="col-xxl-8 col-lg-7">';
                } else {
                    echo '<div class="col-lg-12">';
                }
            }
        }
    }

    // blog details post meta hook function
    if( !function_exists('ruffer_blog_post_meta_cb') ) {
        function ruffer_blog_post_meta_cb( ) {
            if( class_exists('ReduxFramework') ) {
                $ruffer_display_post_tag   =  ruffer_opt('ruffer_display_post_tag');
                $ruffer_display_post_date      =  ruffer_opt('ruffer_display_post_date');
                $ruffer_display_post_author      =  ruffer_opt('ruffer_display_post_author');
                $ruffer_display_post_comment      =  ruffer_opt('ruffer_display_post_comment');
            } else {
                $ruffer_display_post_tag   = '';
                $ruffer_display_post_date      = '1';
                $ruffer_display_post_author      = '1';
                $ruffer_display_post_comment      = '1';
            }

            echo '<!-- Blog Meta -->';
                echo '<div class="blog-meta">';
                    if( $ruffer_display_post_author ){
                        echo '<a class="author" href="'.esc_url( get_author_posts_url( get_the_author_meta('ID') ) ).'">';

                        echo '<i class="far fa-user"></i>';
                        echo esc_html__('By ', 'ruffer') . esc_html( ucwords( get_the_author() ) );
                        echo '</a>';
                    }
                    if( $ruffer_display_post_date ){
                        echo '<a href="'.esc_url( ruffer_blog_date_permalink() ).'"><i class="fa-light fa-calendar-days"></i>';
                            echo '<time datetime="'.esc_attr( get_the_date( DATE_W3C ) ).'">'.esc_html( get_the_date() ).'</time>';
                        echo '</a>';
                    }
                    if( $ruffer_display_post_comment ){
                        if( get_comments_number() == 1 ){
                            $comment_text = __( ' Comment', 'ruffer' );
                        }else{
                            $comment_text = __( ' Comments', 'ruffer' );
                        }

                        echo '<a href="'.esc_url( get_comments_link( get_the_ID() ) ).'"><i class="far fa-comments"></i>'.esc_html( get_comments_number() ).''.$comment_text.'</a>';
                    }
                    if( $ruffer_display_post_tag ){
                        $categories = get_the_category();  
                        echo '<a href="'.esc_url( get_category_link( $categories[0]->term_id ) ).'"><i class="fas fa-tags"></i>'.esc_html( $categories[0]->name ).'</a>';
                    }
                echo '</div>';
        }
    }

    // blog details share options hook function
    if( !function_exists('ruffer_blog_details_share_options_cb') ) {
        function ruffer_blog_details_share_options_cb( ) {
            if( class_exists('ReduxFramework') ) {
                $ruffer_post_details_share_options = ruffer_opt('ruffer_post_details_share_options');
            } else {
                $ruffer_post_details_share_options = false;
            }
            if( function_exists( 'ruffer_social_sharing_buttons' ) && $ruffer_post_details_share_options ) {
                echo '<div class="col-md-auto text-xl-end">';
                echo '<span class="share-links-title">'.__( 'Share:', 'ruffer' ).'</span>';
                    echo '<ul class="social-links">';
                        echo ruffer_social_sharing_buttons();
                    echo '</ul>';
                    echo '<!-- End Social Share -->';
                echo '</div>';
            }
        }
    }

    // Blog Details Post Navigation hook function
    if( !function_exists( 'ruffer_blog_details_post_navigation_cb' ) ) {
        function ruffer_blog_details_post_navigation_cb( ) {
            if( class_exists('ReduxFramework') ) {
                $ruffer_post_details_post_navigation = ruffer_opt('ruffer_post_details_post_navigation');
            } else {
                $ruffer_post_details_post_navigation = true;
            }

            $prevpost = get_previous_post();
            $nextpost = get_next_post();

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

            if( $ruffer_post_details_post_navigation && ! empty( $prevpost ) || !empty( $nextpost ) ) {
                echo '<div class="blog-navigation">';
                    echo '<div>';
                        if( ! empty( $prevpost ) ) {
                            echo '<a href="'.esc_url( get_permalink( $prevpost->ID ) ).'" class="nav-btn prev">';
                            if( class_exists('ReduxFramework') ) {
                                if (has_post_thumbnail( $prevpost->ID )) {
                                    echo get_the_post_thumbnail( $prevpost->ID, 'ruffer_80X80' );
                                };
                            }
                                echo '<span class="nav-text">'.esc_html__( ' Previous Post', 'ruffer' ).'</span>';
                            echo '</a>';
                        }
                    echo '</div>';

                    echo '<a href="'.get_permalink( get_option( 'page_for_posts' ) ).'" class="blog-btn"><i class="fa-solid fa-grid"></i></a>';

                    echo '<div>';
                        if( ! empty( $nextpost ) ) {
                            echo '<a href="'.esc_url( get_permalink( $nextpost->ID ) ).'" class="nav-btn next">';
                                if( class_exists('ReduxFramework') ) {
                                    if (has_post_thumbnail($nextpost->ID)) {
                                        echo get_the_post_thumbnail( $nextpost->ID, 'ruffer_80X80' );
                                    };
                                }
                                echo '<span class="nav-text">'.esc_html__( ' Next Post', 'ruffer' ).'</span>';
                            echo '</a>';
                        }
                    echo '</div>';
                echo '</div>';
            }
        }
    }
    
    // blog details author bio hook function
    if( !function_exists('ruffer_blog_details_author_bio_cb') ) {
        function ruffer_blog_details_author_bio_cb( ) {
            if( class_exists('ReduxFramework') ) {
                $postauthorbox =  ruffer_opt( 'ruffer_post_details_author_desc_trigger' );
            } else {
                $postauthorbox = '1';
            }
            if( !empty( get_the_author_meta('description')  ) && $postauthorbox == '1' ) {

                 echo '<div class="blog-author">';
                    echo '<div class="auhtor-img">';
                        echo ruffer_img_tag( array(
                        "url"   => esc_url( get_avatar_url( get_the_author_meta('ID'), array(
                            "size"  => '140'
                            ) ) ),
                        ) );
                    echo '</div>';
                    echo '<div class="media-body">';
                        echo '<div class="media">';
                            echo '<div class="media-left">';
                                echo '<h3 class="author-name"><a class="text-inherit" href="'.esc_url( get_author_posts_url( get_the_author_meta('ID') ) ).'">'.esc_html( ucwords( get_the_author() ) ).'</a></h3>';

                                $designation = get_user_meta( get_the_author_meta('ID'), '_ruffer_user_designation',true );

                                if( !empty( $designation ) ){
                                    echo '<span class="author-desig">'.esc_html( $designation ).'</span>';
                                }
                            echo '</div>';

                            $ruffer_social_icons = get_user_meta( get_the_author_meta('ID'), '_ruffer_social_profile_group',true );
                            if( is_array( $ruffer_social_icons ) && !empty( $ruffer_social_icons ) ) {
                                echo '<div class="media-body text-end">';
                                    echo '<div class="th-social style2 align-items-center">';
                                        foreach( $ruffer_social_icons as $singleicon ) {
                                            if( ! empty( $singleicon['_ruffer_social_profile_icon'] ) ) {
                                                echo '<a href="'.esc_url( $singleicon['_ruffer_lawyer_social_profile_link'] ).'"><i class="'.esc_attr( $singleicon['_ruffer_social_profile_icon'] ).'"></i></a>';
                                            }
                                        }
                                    echo '</div>';
                                echo '</div>';
                            }
                        echo '</div>';
                        if( ! empty( get_the_author_meta('description') ) ) {
                            echo '<p class="author-text">';
                                echo esc_html( get_the_author_meta('description') );
                            echo '</p>';
                        }
                    echo '</div>';
                echo '</div>';
            }

        }
    }

    // Blog Details Comments hook function
    if( !function_exists('ruffer_blog_details_comments_cb') ) {
        function ruffer_blog_details_comments_cb( ) {
            if ( ! comments_open() ) {
                echo '<div class="blog-comment-area">';
                    echo ruffer_heading_tag( array(
                        "tag"   => "h3",
                        "text"  => esc_html__( 'Comments are closed', 'ruffer' ),
                        "class" => "inner-title"
                    ) );
                echo '</div>';
            }

            // comment template.
            if ( comments_open() || get_comments_number() ) {
                comments_template();
            }
        }
    }

    // Blog Details Column end hook function
    if( !function_exists('ruffer_blog_details_col_end_cb') ) {
        function ruffer_blog_details_col_end_cb( ) {
            echo '</div>';
        }
    }

    // Blog Details Wrapper end hook function
    if( !function_exists('ruffer_blog_details_wrapper_end_cb') ) {
        function ruffer_blog_details_wrapper_end_cb( ) {
                    echo '</div>';
                echo '</div>';
            echo '</section>';
        }
    }

    // page start wrapper hook function
    if( !function_exists('ruffer_page_start_wrap_cb') ) {
        function ruffer_page_start_wrap_cb( ) {
            
            if( is_page( 'cart' ) ){
                $section_class = "th-cart-wrapper space-top space-extra-bottom";
            }elseif( is_page( 'checkout' ) ){
                $section_class = "th-checkout-wrapper space-top space-extra-bottom";
            }elseif( is_page('wishlist') ){
                $section_class = "wishlist-area space-top space-extra-bottom";
            }else{
                $section_class = "space-top space-extra-bottom";  
            }
            echo '<section class="'.esc_attr( $section_class ).'">';
                echo '<div class="container">';
                    echo '<div class="row">';
        }
    }

    // page wrapper end hook function
    if( !function_exists('ruffer_page_end_wrap_cb') ) {
        function ruffer_page_end_wrap_cb( ) {
                    echo '</div>';
                echo '</div>';
            echo '</section>';
        }
    }

    // page column wrapper start hook function
    if( !function_exists('ruffer_page_col_start_wrap_cb') ) {
        function ruffer_page_col_start_wrap_cb( ) {
            if( class_exists('ReduxFramework') ) {
                $ruffer_page_sidebar = ruffer_opt('ruffer_page_sidebar');
            }else {
                $ruffer_page_sidebar = '1';
            }
            if( $ruffer_page_sidebar == '2' && is_active_sidebar('ruffer-page-sidebar') ) {
                echo '<div class="col-xxl-8 col-lg-7 order-last">';
            } elseif( $ruffer_page_sidebar == '3' && is_active_sidebar('ruffer-page-sidebar') ) {
                echo '<div class="col-xxl-8 col-lg-7">';
            } else {
                echo '<div class="col-lg-12">';
            }

        }
    }

    // page column wrapper end hook function
    if( !function_exists('ruffer_page_col_end_wrap_cb') ) {
        function ruffer_page_col_end_wrap_cb( ) {
            echo '</div>';
        }
    }

    // page sidebar hook function
    if( !function_exists('ruffer_page_sidebar_cb') ) {
        function ruffer_page_sidebar_cb( ) {
            if( class_exists('ReduxFramework') ) {
                $ruffer_page_sidebar = ruffer_opt('ruffer_page_sidebar');
            }else {
                $ruffer_page_sidebar = '1';
            }

            if( class_exists('ReduxFramework') ) {
                $ruffer_page_layoutopt = ruffer_opt('ruffer_page_layoutopt');
            }else {
                $ruffer_page_layoutopt = '3';
            }

            if( $ruffer_page_layoutopt == '1' && $ruffer_page_sidebar != 1 ) {
                get_sidebar('page');
            } elseif( $ruffer_page_layoutopt == '2' && $ruffer_page_sidebar != 1 ) {
                get_sidebar();
            }
        }
    }

    // page content hook function
    if( !function_exists('ruffer_page_content_cb') ) {
        function ruffer_page_content_cb( ) {
            if(  class_exists('woocommerce') && ( is_woocommerce() || is_cart() || is_checkout() || is_page('wishlist') || is_account_page() )  ) {
                echo '<div class="woocommerce--content">';
            } else {
                echo '<div class="page--content clearfix">';
            }

                the_content();

                // Link Pages
                ruffer_link_pages();

            echo '</div>';
            // comment template.
            if ( comments_open() || get_comments_number() ) {
                comments_template();
            }

        }
    }

    if( !function_exists('ruffer_blog_post_thumb_cb') ) {
        function ruffer_blog_post_thumb_cb( ) {
            if( get_post_format() ) {
                $format = get_post_format();
            }else{
                $format = 'standard';
            }

            $ruffer_post_slider_thumbnail = ruffer_meta( 'post_format_slider' );

            if( !empty( $ruffer_post_slider_thumbnail ) ){
                echo '<div class="blog-img th-blog-carousel">';
                    foreach( $ruffer_post_slider_thumbnail as $single_image ){
                        echo ruffer_img_tag( array(
                            'url'   => esc_url( $single_image )
                        ) );
                    }
                echo '</div>';
            }elseif( has_post_thumbnail() && $format == 'standard' ) {
                echo '<!-- Post Thumbnail -->';
                echo '<div class="blog-img">';
                    if( ! is_single() ){
                        echo '<a href="'.esc_url( get_permalink() ).'" class="post-thumbnail">';
                    }

                    the_post_thumbnail();

                    if( ! is_single() ){
                        echo '</a>';
                    }
                echo '</div>';
                echo '<!-- End Post Thumbnail -->';
            }elseif( $format == 'video' ){
                if( has_post_thumbnail() && ! empty ( ruffer_meta( 'post_format_video' ) ) ){
                    echo '<div class="blog-img">';
                        if( ! is_single() ){
                            echo '<a href="'.esc_url( get_permalink() ).'" class="post-thumbnail">';
                        }
                            the_post_thumbnail();
                        if( ! is_single() ){
                            echo '</a>';
                        }
                        echo '<a href="'.esc_url( ruffer_meta( 'post_format_video' ) ).'" class="popup-video play-btn style3">';
                            echo '<i class="fas fa-play"></i>';
                        echo '</a>';
                    echo '</div>';
                }elseif( ! has_post_thumbnail() && ! is_single() ){
                    echo '<div class="blog-video">';
                        if( ! is_single() ){
                            echo '<a href="'.esc_url( get_permalink() ).'" class="post-thumbnail">';
                        }
                            echo ruffer_embedded_media( array( 'video', 'iframe' ) );
                        if( ! is_single() ){
                            echo '</a>';
                        }
                    echo '</div>';
                }
            }elseif( $format == 'audio' ){
                $ruffer_audio = ruffer_meta( 'post_format_audio' );
                if( ! empty( $ruffer_audio ) ){
                    echo '<div class="blog-audio">';
                        echo wp_oembed_get( $ruffer_audio );
                    echo '</div>';
                }elseif( ! is_single() ){
                    echo '<div class="blog-audio">';
                        echo wp_oembed_get( $ruffer_audio );
                    echo '</div>';
                }
            }

        }
    }

    if( !function_exists('ruffer_blog_post_content_cb') ) {
        function ruffer_blog_post_content_cb( ) {
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
            if( class_exists( 'ReduxFramework' ) ) {
                $ruffer_excerpt_length          = ruffer_opt( 'ruffer_blog_postExcerpt' );
                $ruffer_display_post_category   = ruffer_opt( 'ruffer_display_post_category' );
            } else {
                $ruffer_excerpt_length          = '48';
                $ruffer_display_post_category   = '1';
            }

            if( class_exists( 'ReduxFramework' ) ) {
                $ruffer_blog_admin = ruffer_opt( 'ruffer_blog_post_author' );
                $ruffer_blog_readmore_setting_val = ruffer_opt('ruffer_blog_readmore_setting');
                if( $ruffer_blog_readmore_setting_val == 'custom' ) {
                    $ruffer_blog_readmore_setting = ruffer_opt('ruffer_blog_custom_readmore');
                } else {
                    $ruffer_blog_readmore_setting = __( 'Read More', 'ruffer' );
                }
            } else {
                $ruffer_blog_readmore_setting = __( 'Read More', 'ruffer' );
                $ruffer_blog_admin = true;
            }
            echo '<!-- blog-content -->';

                do_action( 'ruffer_blog_post_thumb' );
                
                echo '<div class="blog-content">';

                    // Blog Post Meta
                    do_action( 'ruffer_blog_post_meta' );

                    echo '<!-- Post Title -->';
                    echo '<h2 class="blog-title"><a href="'.esc_url( get_permalink() ).'">'.wp_kses( get_the_title( ), $allowhtml ).'</a></h2>';
                    echo '<!-- End Post Title -->';

                    echo '<!-- Post Summary -->';
                        echo ruffer_paragraph_tag( array(
                            "text"  => wp_kses( wp_trim_words( get_the_excerpt(), $ruffer_excerpt_length, '' ), $allowhtml ),
                            "class" => 'blog-text',
                        ) );

                        if( !empty( $ruffer_blog_readmore_setting ) ){
                            echo '<!-- Button -->';
                                echo '<a href="'.esc_url( get_permalink() ).'" class="th-btn">'.esc_html( $ruffer_blog_readmore_setting ).'</a>';
                            echo '<!-- End Button -->';
                        }
                    echo '<!-- End Post Summary -->';
                echo '</div>';
            echo '<!-- End Post Content -->';
        }
    }
