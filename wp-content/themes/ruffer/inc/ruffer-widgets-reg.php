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
    exit;
}

function ruffer_widgets_init() {

    if( class_exists('ReduxFramework') ) {
        $ruffer_sidebar_widget_title_heading_tag = ruffer_opt('ruffer_sidebar_widget_title_heading_tag');
    } else {
        $ruffer_sidebar_widget_title_heading_tag = 'h3';
    }

    //sidebar widgets register
    register_sidebar( array(
        'name'          => esc_html__( 'Blog Sidebar', 'ruffer' ),
        'id'            => 'ruffer-blog-sidebar',
        'description'   => esc_html__( 'Add Blog Sidebar Widgets Here.', 'ruffer' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget_title">',
        'after_title'   => '</h3>',
    ) );

    // page sidebar widgets register
    register_sidebar( array(
        'name'          => esc_html__( 'Page Sidebar', 'ruffer' ),
        'id'            => 'ruffer-page-sidebar',
        'description'   => esc_html__( 'Add Page Sidebar Widgets Here.', 'ruffer' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget_title">',
        'after_title'   => '</h3>',
    ) );
    if( class_exists( 'ReduxFramework' ) ){
        // footer widgets register
        register_sidebar( array(
           'name'          => esc_html__( 'Footer Widgets Area 1', 'ruffer' ),
           'id'            => 'ruffer-footer-1',
           'before_widget' => '<div class="col-md-6 col-xxl-3 col-xl-4"><div id="%1$s" class="widget footer-widget %2$s">',
           'after_widget'  => '</div></div>',
           'before_title'  => '<h3 class="widget_title">',
           'after_title'   => '</h3>',
        ) );
        register_sidebar( array(
           'name'          => esc_html__( 'Footer Widgets Area 2', 'ruffer' ),
           'id'            => 'ruffer-footer-2',
           'before_widget' => '<div class="col-md-6 col-xl-auto"><div id="%1$s" class="widget footer-widget %2$s">',
           'after_widget'  => '</div></div>',
           'before_title'  => '<h3 class="widget_title">',
           'after_title'   => '</h3>',
        ) );
        register_sidebar( array(
           'name'          => esc_html__( 'Footer Widgets Area 3', 'ruffer' ),
           'id'            => 'ruffer-footer-3',
           'before_widget' => '<div class="col-md-6 col-xl-auto"><div id="%1$s" class="widget footer-widget %2$s">',
           'after_widget'  => '</div></div>',
           'before_title'  => '<h3 class="widget_title">',
           'after_title'   => '</h3>',
        ) );
        register_sidebar( array(
           'name'          => esc_html__( 'Footer Widgets Area 4', 'ruffer' ),
           'id'            => 'ruffer-footer-4',
           'before_widget' => '<div class="col-md-6 col-xl-auto"><div id="%1$s" class="widget footer-widget %2$s">',
           'after_widget'  => '</div></div>',
           'before_title'  => '<h3 class="widget_title">',
           'after_title'   => '</h3>',
        ) );
    }
    // Offcanvas sidebar widgets register
    register_sidebar( array(
        'name'          => esc_html__( 'Offcanvas Sidebar', 'ruffer' ),
        'id'            => 'ruffer-offcanvth-sidebar',
        'description'   => esc_html__( 'Add Page Offcanvas Widgets Here.', 'ruffer' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s footer-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget_title">',
        'after_title'   => '</h3>',
    ) );
    if( class_exists('woocommerce') ) {
        register_sidebar(
            array(
                'name'          => esc_html__( 'WooCommerce Sidebar', 'ruffer' ),
                'id'            => 'ruffer-woo-sidebar',
                'description'   => esc_html__( 'Add widgets here to appear in your woocommerce page sidebar.', 'ruffer' ),
                'before_widget' => '<div class="widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h4 class="widget_title">',
                'after_title'   => '</h4>',
            )
        );
    }

}

add_action( 'widgets_init', 'ruffer_widgets_init' );