<?php
/**
 * @Packge     : Ruffer
 * @Version    : 1.0
 * @Author     : Themeholy
 * @Author URI : https://www.themeholy.com/
 *
 */

    // Block direct access
    if( !defined( 'ABSPATH' ) ){
        exit();
    }

    if( defined( 'CMB2_LOADED' )  ){
        if( !empty( ruffer_meta('page_breadcrumb_area') ) ) {
            $ruffer_page_breadcrumb_area  = ruffer_meta('page_breadcrumb_area');
        } else {
            $ruffer_page_breadcrumb_area = '1';
        }
    }else{
        $ruffer_page_breadcrumb_area = '1';
    }
    
    $allowhtml = array(
        'p'         => array(
            'class'     => array()
        ),
        'span'      => array(
            'class'     => array(),
        ),
        'a'         => array(
            'href'      => array(),
            'title'     => array()
        ),
        'br'        => array(),
        'em'        => array(),
        'strong'    => array(),
        'b'         => array(),
        'sub'       => array(),
        'sup'       => array(),
    );
    
    if(  is_page() || is_page_template( 'template-builder.php' )  ) {
        if( $ruffer_page_breadcrumb_area == '1' ) {
            echo '<!-- Page title 2 -->';
            echo '<div class="breadcumb-wrapper" data-overlay="black" data-opacity="7">';
                echo '<div class="container">';
                    echo '<div class="breadcumb-content text-center">';
                        if( defined('CMB2_LOADED') || class_exists('ReduxFramework') ) {
                            if( !empty( ruffer_meta('page_breadcrumb_settings') ) ) {
                                if( ruffer_meta('page_breadcrumb_settings') == 'page' ) {
                                    $ruffer_page_title_switcher = ruffer_meta('page_title');
                                } else {
                                    $ruffer_page_title_switcher = ruffer_opt('ruffer_page_title_switcher');
                                }
                            } else {
                                $ruffer_page_title_switcher = '1';
                            }
                        } else {
                            $ruffer_page_title_switcher = '1';
                        }

                        if( $ruffer_page_title_switcher ){
                            if( class_exists( 'ReduxFramework' ) ){
                                $ruffer_page_title_tag    = ruffer_opt('ruffer_page_title_tag');
                            }else{
                                $ruffer_page_title_tag    = 'h1';
                            }

                            if( defined( 'CMB2_LOADED' )  ){
                                if( !empty( ruffer_meta('page_title_settings') ) ) {
                                    $ruffer_custom_title = ruffer_meta('page_title_settings');
                                } else {
                                    $ruffer_custom_title = 'default';
                                }
                            }else{
                                $ruffer_custom_title = 'default';
                            }

                            if( $ruffer_custom_title == 'default' ) {
                                echo ruffer_heading_tag(
                                    array(
                                        "tag"   => esc_attr( $ruffer_page_title_tag ),
                                        "text"  => esc_html( get_the_title( ) ),
                                        'class' => 'breadcumb-title'
                                    )
                                );
                            } else {
                                echo ruffer_heading_tag(
                                    array(
                                        "tag"   => esc_attr( $ruffer_page_title_tag ),
                                        "text"  => esc_html( ruffer_meta('custom_page_title') ),
                                        'class' => 'breadcumb-title'
                                    )
                                );
                            }

                        }
                        if( defined('CMB2_LOADED') || class_exists('ReduxFramework') ) {

                            if( ruffer_meta('page_breadcrumb_settings') == 'page' ) {
                                $ruffer_breadcrumb_switcher = ruffer_meta('page_breadcrumb_trigger');
                            } else {
                                $ruffer_breadcrumb_switcher = ruffer_opt('ruffer_enable_breadcrumb');
                            }

                        } else {
                            $ruffer_breadcrumb_switcher = '1';
                        }

                        if( $ruffer_breadcrumb_switcher == '1' && (  is_page() || is_page_template( 'template-builder.php' ) )) {
                            ruffer_breadcrumbs(
                                array(
                                    'breadcrumbs_classes' => 'nav',
                                )
                            );
                        }
                    echo '</div>';
                   
                echo '</div>';
                if( class_exists( 'ReduxFramework' )  ){
                    $breadcrumb_2nd_image = ruffer_opt('ruffer_allHeader_bg_2', 'url' );
                    if(!empty($breadcrumb_2nd_image)){
                    echo '<div class="breadcumb-shape">';
                        echo '<img src="'.esc_url($breadcrumb_2nd_image).'" alt="'.esc_attr__('shape', 'ruffer').'">';
                    echo '</div>';
                    }
                }
            echo '</div>';
            echo '<!-- End of Page title -->';
            
        }
    } else {
        echo '<!-- Page title 3 -->';
        echo '<div class="breadcumb-wrapper" data-overlay="black" data-opacity="7">';
            echo '<div class="container">';
                echo '<div class="breadcumb-content text-center">';
                    if( class_exists( 'ReduxFramework' )  ){
                        $ruffer_page_title_switcher  = ruffer_opt('ruffer_page_title_switcher');
                    }else{
                        $ruffer_page_title_switcher = '1';
                    }

                    if( $ruffer_page_title_switcher ){
                        if( class_exists( 'ReduxFramework' ) ){
                            $ruffer_page_title_tag    = ruffer_opt('ruffer_page_title_tag');
                        }else{
                            $ruffer_page_title_tag    = 'h1';
                        }
                        if( class_exists('woocommerce') && is_shop() ) {
                            echo ruffer_heading_tag(
                                array(
                                    "tag"   => esc_attr( $ruffer_page_title_tag ),
                                    "text"  => wp_kses( woocommerce_page_title( false ), $allowhtml ),
                                    'class' => 'breadcumb-title'
                                )
                            );
                        }elseif ( is_archive() ){
                            echo ruffer_heading_tag(
                                array(
                                    "tag"   => esc_attr( $ruffer_page_title_tag ),
                                    "text"  => wp_kses( get_the_archive_title(), $allowhtml ),
                                    'class' => 'breadcumb-title'
                                )
                            );
                        }elseif ( is_home() ){
                            $ruffer_blog_page_title_setting = ruffer_opt('ruffer_blog_page_title_setting');
                            $ruffer_blog_page_title_switcher = ruffer_opt('ruffer_blog_page_title_switcher');
                            $ruffer_blog_page_custom_title = ruffer_opt('ruffer_blog_page_custom_title');
                            if( class_exists('ReduxFramework') ){
                                if( $ruffer_blog_page_title_switcher ){
                                    echo ruffer_heading_tag(
                                        array(
                                            "tag"   => esc_attr( $ruffer_page_title_tag ),
                                            "text"  => !empty( $ruffer_blog_page_custom_title ) && $ruffer_blog_page_title_setting == 'custom' ? esc_html( $ruffer_blog_page_custom_title) : esc_html__( 'Latest News', 'ruffer' ),
                                            'class' => 'breadcumb-title'
                                        )
                                    );
                                }
                            }else{
                                echo ruffer_heading_tag(
                                    array(
                                        "tag"   => "h1",
                                        "text"  => esc_html__( 'Latest News', 'ruffer' ),
                                        'class' => 'breadcumb-title',
                                    )
                                );
                            }
                        }elseif( is_search() ){
                            echo ruffer_heading_tag(
                                array(
                                    "tag"   => esc_attr( $ruffer_page_title_tag ),
                                    "text"  => esc_html__( 'Search Result', 'ruffer' ),
                                    'class' => 'breadcumb-title'
                                )
                            );
                        }elseif( is_404() ){
                            echo ruffer_heading_tag(
                                array(
                                    "tag"   => esc_attr( $ruffer_page_title_tag ),
                                    "text"  => esc_html__( '404 PAGE', 'ruffer' ),
                                    'class' => 'breadcumb-title'
                                )
                            );
                        }elseif( is_singular( 'product' ) ){
                            $posttitle_position  = ruffer_opt('ruffer_product_details_title_position');
                            $postTitlePos = false;
                            if( class_exists( 'ReduxFramework' ) ){
                                if( $posttitle_position && $posttitle_position != 'header' ){
                                    $postTitlePos = true;
                                }
                            }else{
                                $postTitlePos = false;
                            }

                            if( $postTitlePos != true ){
                                echo ruffer_heading_tag(
                                    array(
                                        "tag"   => esc_attr( $ruffer_page_title_tag ),
                                        "text"  => wp_kses( get_the_title( ), $allowhtml ),
                                        'class' => 'breadcumb-title'
                                    )
                                );
                            } else {
                                if( class_exists( 'ReduxFramework' ) ){
                                    $ruffer_post_details_custom_title  = ruffer_opt('ruffer_product_details_custom_title');
                                }else{
                                    $ruffer_post_details_custom_title = __( 'Shop Details','ruffer' );
                                }

                                if( !empty( $ruffer_post_details_custom_title ) ) {
                                    echo ruffer_heading_tag(
                                        array(
                                            "tag"   => esc_attr( $ruffer_page_title_tag ),
                                            "text"  => wp_kses( $ruffer_post_details_custom_title, $allowhtml ),
                                            'class' => 'breadcumb-title'
                                        )
                                    );
                                }
                            }
                        }else{
                            $posttitle_position  = ruffer_opt('ruffer_post_details_title_position');
                            $postTitlePos = false;
                            if( is_single() ){
                                if( class_exists( 'ReduxFramework' ) ){
                                    if( $posttitle_position && $posttitle_position != 'header' ){
                                        $postTitlePos = true;
                                    }
                                }else{
                                    $postTitlePos = false;
                                }
                            }
                            if( is_singular( 'product' ) ){
                                $posttitle_position  = ruffer_opt('ruffer_product_details_title_position');
                                $postTitlePos = false;
                                if( class_exists( 'ReduxFramework' ) ){
                                    if( $posttitle_position && $posttitle_position != 'header' ){
                                        $postTitlePos = true;
                                    }
                                }else{
                                    $postTitlePos = false;
                                }
                            }

                            if( $postTitlePos != true ){
                                echo ruffer_heading_tag(
                                    array(
                                        "tag"   => esc_attr( $ruffer_page_title_tag ),
                                        "text"  => wp_kses( get_the_title( ), $allowhtml ),
                                        'class' => 'breadcumb-title'
                                    )
                                );
                            } else {
                                if( class_exists( 'ReduxFramework' ) ){
                                    $ruffer_post_details_custom_title  = ruffer_opt('ruffer_post_details_custom_title');
                                }else{
                                    $ruffer_post_details_custom_title = __( 'Blog Details','ruffer' );
                                }

                                if( !empty( $ruffer_post_details_custom_title ) ) {
                                    echo ruffer_heading_tag(
                                        array(
                                            "tag"   => esc_attr( $ruffer_page_title_tag ),
                                            "text"  => wp_kses( $ruffer_post_details_custom_title, $allowhtml ),
                                            'class' => 'breadcumb-title'
                                        )
                                    );
                                }
                            }
                        }
                    }
                    if( class_exists('ReduxFramework') ) {
                        $ruffer_breadcrumb_switcher = ruffer_opt( 'ruffer_enable_breadcrumb' );
                    } else {
                        $ruffer_breadcrumb_switcher = '1';
                    }
                    if( $ruffer_breadcrumb_switcher == '1' ) {
                        ruffer_breadcrumbs(
                            array(
                                'breadcrumbs_classes' => 'nav',
                            )
                        );
                    }
                echo '</div>';                
            echo '</div>';
        echo '</div>';
        echo '<!-- End of Page title -->';
    }