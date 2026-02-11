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
    exit;
}

 // theme option callback
function ruffer_opt( $id = null, $url = null ){
    global $ruffer_opt;

    if( $id && $url ){

        if( isset( $ruffer_opt[$id][$url] ) && $ruffer_opt[$id][$url] ){
            return $ruffer_opt[$id][$url];
        }
    }else{
        if( isset( $ruffer_opt[$id] )  && $ruffer_opt[$id] ){
            return $ruffer_opt[$id];
        }
    }
}

// theme logo
function ruffer_theme_logo() {
    // escaping allow html
    $allowhtml = array(
        'a'    => array(
            'href' => array()
        ),
        'span' => array(),
        'i'    => array(
            'class' => array()
        )
    );
    $siteUrl = home_url('/');
    if( has_custom_logo() ) {
        $custom_logo_id = get_theme_mod( 'custom_logo' );
        $siteLogo = '';
        $siteLogo .= '<a class="logo" href="'.esc_url( $siteUrl ).'">';
        $siteLogo .= ruffer_img_tag( array(
            "class" => "img-fluid",
            "url"   => esc_url( wp_get_attachment_image_url( $custom_logo_id, 'full') )
        ) );
        $siteLogo .= '</a>';

        return $siteLogo;
    } elseif( !ruffer_opt('ruffer_text_title') && ruffer_opt('ruffer_site_logo', 'url' )  ){

        $siteLogo = '<img class="img-fluid" src="'.esc_url( ruffer_opt('ruffer_site_logo', 'url' ) ).'" alt="'.esc_attr__( 'logo', 'ruffer' ).'" />';
        return '<a class="logo" href="'.esc_url( $siteUrl ).'">'.$siteLogo.'</a>';


    }elseif( ruffer_opt('ruffer_text_title') ){
        return '<h2 class="mb-0"><a class="logo" href="'.esc_url( $siteUrl ).'">'.wp_kses( ruffer_opt('ruffer_text_title'), $allowhtml ).'</a></h2>';
    }else{
        return '<h2 class="mb-0"><a class="logo" href="'.esc_url( $siteUrl ).'">'.esc_html( get_bloginfo('name') ).'</a></h2>';
    }
}

// custom meta id callback
function ruffer_meta( $id = '' ){
    $value = get_post_meta( get_the_ID(), '_ruffer_'.$id, true );
    return $value;
}


// Blog Date Permalink
function ruffer_blog_date_permalink() {
    $year  = get_the_time('Y');
    $month_link = get_the_time('m');
    $day   = get_the_time('d');
    $link = get_day_link( $year, $month_link, $day);
    return $link;
}

//audio format iframe match
function ruffer_iframe_match() {
    $audio_content = ruffer_embedded_media( array('audio', 'iframe') );
    $iframe_match = preg_match("/\iframe\b/i",$audio_content, $match);
    return $iframe_match;
}


//Post embedded media
function ruffer_embedded_media( $type = array() ){
    $content = do_shortcode( apply_filters( 'the_content', get_the_content() ) );
    $embed   = get_media_embedded_in_content( $content, $type );


    if( in_array( 'audio' , $type) ){
        if( count( $embed ) > 0 ){
            $output = str_replace( '?visual=true', '?visual=false', $embed[0] );
        }else{
           $output = '';
        }

    }else{
        if( count( $embed ) > 0 ){
            $output = $embed[0];
        }else{
           $output = '';
        }
    }
    return $output;
}


// WP post link pages
function ruffer_link_pages(){
    wp_link_pages( array(
        'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'ruffer' ) . '</span>',
        'after'       => '</div>',
        'link_before' => '<span>',
        'link_after'  => '</span>',
        'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'ruffer' ) . ' </span>%',
        'separator'   => '<span class="screen-reader-text">, </span>',
    ) );
}


// Data Background image attr
function ruffer_data_bg_attr( $imgUrl = '' ){
    return 'data-bg-img="'.esc_url( $imgUrl ).'"';
}

// image alt tag
function ruffer_image_alt( $url = '' ){
    if( $url != '' ){
        // attachment id by url
        $attachmentid = attachment_url_to_postid( esc_url( $url ) );
       // attachment alt tag
        $image_alt = get_post_meta( esc_html( $attachmentid ) , '_wp_attachment_image_alt', true );
        if( $image_alt ){
            return $image_alt ;
        }else{
            $filename = pathinfo( esc_url( $url ) );
            $alt = str_replace( '-', ' ', $filename['filename'] );
            return $alt;
        }
    }else{
       return;
    }
}


// Flat Content wysiwyg output with meta key and post id

function ruffer_get_textareahtml_output( $content ) {
    global $wp_embed;

    $content = $wp_embed->autoembed( $content );
    $content = $wp_embed->run_shortcode( $content );
    $content = wpautop( $content );
    $content = do_shortcode( $content );

    return $content;
}

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */

function ruffer_pingback_header() {
    if ( is_singular() && pings_open() ) {
        echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
    }
}
add_action( 'wp_head', 'ruffer_pingback_header' );


// Excerpt More
function ruffer_excerpt_more( $more ) {
    return '...';
}

add_filter( 'excerpt_more', 'ruffer_excerpt_more' );


// ruffer comment template callback
function ruffer_comment_callback( $comment, $args, $depth ) {
        $add_below = 'comment';
    ?>
    <li <?php comment_class( array('th-comment-item') ); ?>>
        <div id="comment-<?php comment_ID() ?>" class="th-post-comment">
            <?php
                if( get_avatar( $comment, 100 )  ) :
            ?>
            <!-- Author Image -->
            <div class="comment-avater">
                <?php
                    if ( $args['avatar_size'] != 0 ) {
                        echo get_avatar( $comment, 110 );
                    }
                ?>
            </div>
            <!-- Author Image -->
            <?php
                endif;
            ?>
            <!-- Comment Content -->
            <div class="comment-content">
                <span class="commented-on"> <i class="fas fa-calendar-alt"></i> <?php printf( esc_html__('%1$s', 'ruffer'), get_comment_date() ); ?> </span>
                <h3 class="name"><?php echo esc_html( ucwords( get_comment_author() ) ); ?></h3>
                <?php comment_text(); ?>
                <div class="reply_and_edit">
                    <?php
                        $reply_text = wp_kses_post( '<i class="fas fa-reply"></i> Reply', 'ruffer' );

                        $edit_reply_text = wp_kses_post( '<i class="fas fa-pencil-alt"></i> Edit', 'ruffer' );

                        comment_reply_link(array_merge( $args, array( 'add_below' => $add_below, 'depth' => 3, 'max_depth' => 5, 'reply_text' => $reply_text ) ) );
                        edit_comment_link( $edit_reply_text, '  ', '' );
                    ?>  
                </div>
                <?php if ( $comment->comment_approved == '0' ) : ?>
                <p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'ruffer' ); ?></p>
                <?php endif; ?>
            </div>
        </div>
        <!-- Comment Content -->
<?php
}

//body class
add_filter( 'body_class', 'ruffer_body_class' );
function ruffer_body_class( $classes ) {
    if( class_exists('ReduxFramework') ) {
        $ruffer_blog_single_sidebar = ruffer_opt('ruffer_blog_single_sidebar');
        if( ($ruffer_blog_single_sidebar != '2' && $ruffer_blog_single_sidebar != '3' ) || ! is_active_sidebar('ruffer-blog-sidebar') ) {
            $classes[] = 'no-sidebar';
        }
        $new_class = is_page() ? ruffer_meta('custom_body_class') : null;
        if ( $new_class ) {
            $classes[] = $new_class;
        }

    } else {
        if( !is_active_sidebar('ruffer-blog-sidebar') ) {
            $classes[] = 'no-sidebar';
        }
    }
    return $classes;
}


function ruffer_footer_global_option(){
    // Ruffer Widget Enable Disable
    if( class_exists( 'ReduxFramework' ) ){
        $ruffer_footerwidget_enable = ruffer_opt( 'ruffer_footerwidget_enable' );
        $ruffer_footercta_enable = ruffer_opt( 'ruffer_footercta_enable' );
        $ruffer_disable_footer_bottom = ruffer_opt( 'ruffer_disable_footer_bottom' );

    }else{
        $ruffer_footerwidget_enable = '';
        $ruffer_disable_footer_bottom = '1';
        $ruffer_footercta_enable = '';
    }
    $allowhtml = array(
        'p'         => array(
            'class'     => array()
        ),
        'i'         => array(
            'class'     => array()
        ),
        'span'      => array(
            'class'     => array(),
        ),
        'a'         => array(
            'href'      => array(),
            'title'     => array(),
            'class'     => array(),
        ),
        'br'        => array(),
        'em'        => array(),
        'strong'    => array(),
        'b'         => array(),
    );

    echo '<footer class="footer-wrapper footer-layout1 footer-custom">';
        if( $ruffer_footercta_enable = 1 ){

            $ruffer_footer_cta_bg = !empty(ruffer_opt( 'ruffer_footer_cta_bg','url' )) ? ruffer_opt( 'ruffer_footer_cta_bg','url' ) : '#';
            $ruffer_footer_cta_title = !empty(ruffer_opt( 'ruffer_footer_cta_title' )) ? ruffer_opt( 'ruffer_footer_cta_title' ) : '';
            $ruffer_footer_cta_subtitle = !empty(ruffer_opt( 'ruffer_footer_cta_subtitle' )) ? ruffer_opt( 'ruffer_footer_cta_subtitle' ) : '';

            echo '<div class="footer-top" data-bg-src="'.esc_url( $ruffer_footer_cta_bg ).'">';
                echo '<div class="container">';
                    echo '<div class="row align-items-center justify-content-between">';
                        echo '<div class="col-lg-auto">';
                            echo '<div class="title-area mb-lg-0 text-lg-start text-center">';
                                echo '<span class="sub-title style2 text-white">'.esc_html( $ruffer_footer_cta_title ).'</span>';
                                echo '<h2 class="sec-title text-white mb-0">'.esc_html( $ruffer_footer_cta_subtitle ).'</h2>';
                            echo '</div>';
                        echo '</div>';
                        if( !empty( ruffer_opt( 'ruffer_footer_cta_btn_text' ) ) ){
                            echo '<div class="col-lg-auto text-center">';
                                echo '<a href="'.esc_html( ruffer_opt( 'ruffer_footer_cta_btn_url' ) ).'" class="th-btn style2">'.esc_html( ruffer_opt( 'ruffer_footer_cta_btn_text' ) ).'<i class="fa-regular fa-arrow-right ms-2"></i></a>';
                            echo '</div>';
                        }
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        }

        if( $ruffer_footerwidget_enable == 1 ){
            echo '<div class="widget-area">';
                echo '<div class="container">';
                    echo '<div class="row justify-content-between">';
                        if( is_active_sidebar( 'ruffer-footer-1' )){
                            dynamic_sidebar( 'ruffer-footer-1' ); 
                        }
                        if( is_active_sidebar( 'ruffer-footer-2' )){
                            dynamic_sidebar( 'ruffer-footer-2' ); 
                        }
                        if( is_active_sidebar( 'ruffer-footer-3' )){
                            dynamic_sidebar( 'ruffer-footer-3' ); 
                        }
                        if( is_active_sidebar( 'ruffer-footer-4' )){
                            dynamic_sidebar( 'ruffer-footer-4' ); 
                        }
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        }
        if( $ruffer_disable_footer_bottom == 1 ){
            echo '<div class="copyright-wrap">';
                echo '<div class="container">';
                    echo '<div class="row justify-content-between align-items-center">';
                        if( has_nav_menu( 'footer-menu' ) ){
                            echo '<div class="col-lg-6">';
                        }else{
                            echo '<div class="col-lg-12 text-center">';
                        }
                            echo '<p class="copyright-text">'.wp_kses( ruffer_opt( 'ruffer_copyright_text' ), $allowhtml ).'</p>';
                        echo '</div>';
                        if( has_nav_menu( 'footer-menu' ) ){
                            echo '<div class="col-lg-6 text-end d-none d-lg-block">';
                                echo '<div class="footer-links">';
                                    wp_nav_menu( array(
                                        'theme_location'  => 'footer-menu',
                                    ) );
                                echo '</div>';
                            echo '</div>';
                        }
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        }
    echo '</footer>';
}

function ruffer_social_icon(){
    $ruffer_social_icon = ruffer_opt( 'ruffer_social_links' );
    if( ! empty( $ruffer_social_icon ) && isset( $ruffer_social_icon ) ){
        foreach( $ruffer_social_icon as $social_icon ){
            if( ! empty( $social_icon['title'] ) ){
                echo '<a href="'.esc_url( $social_icon['url'] ).'"><i class="'.esc_attr( $social_icon['title'] ).'"></i></a> ';
            }
        }
    }
}

// global header
function ruffer_global_header_option() {
    if( class_exists( 'ReduxFramework' ) ){

        global $woocommerce;
        if( ! empty( $woocommerce->cart->cart_contents_count ) ){
          $count = $woocommerce->cart->cart_contents_count;
        }else{
          $count = "0";
        }

        if(ruffer_opt('ruffer_header_sticky')){
            $sticky = 'yes';
        }else{
            $sticky = '';
        }

        if(ruffer_opt('ruffer_menu_icon')){ 
            $menu_icon = '';
        }else{
            $menu_icon = 'hide-icon';
        } 

        // Ruffer Widget Enable Disable
        $ruffer_header_btn_text = ruffer_opt('ruffer_header_btn_text');
        $ruffer_btn_url = ruffer_opt('ruffer_btn_url');

        $ruffer_header_search_switcher      = ruffer_opt( 'ruffer_header_search_switcher' );
        $ruffer_header_cart_switcher        = ruffer_opt( 'ruffer_header_cart_switcher' );

        echo ruffer_search_box();
        echo ruffer_mobile_menu();

        echo '<header class="th-header header-layout1">';
            echo '<div class="sticky-wrapper '.esc_attr($sticky).'">'; 

                ruffer_header_topbar();

                echo '<!-- Main Menu Area -->';
                echo '<div class="menu-area">';
                    echo '<div class="container th-container">';
                        echo '<div class="row align-items-center justify-content-between">';
                            echo '<div class="col-auto">';
                                echo '<div class="header-logo">';
                                    echo ruffer_theme_logo();
                                echo '</div>';
                            echo '</div>';
                            echo '<div class="col-auto">';
                                if( has_nav_menu( 'primary-menu' ) ){
                                    echo '<nav class="main-menu d-none d-lg-inline-block '.esc_attr($menu_icon).'">';
                                        wp_nav_menu( array(
                                            "theme_location"    => 'primary-menu',
                                            "container"         => '',
                                            "menu_class"        => ''
                                        ) );
                                    echo '</nav>';
                                }
                            echo '</div>';
                            echo '<div class="col-auto">';
                                echo '<div class="header-button">';
                                    if( $ruffer_header_search_switcher == 1 ){
                                        echo '<button type="button" class="simple-icon d-none d-md-block searchBoxToggler"><i class="far fa-search"></i></button>';
                                    }
                                    if( $ruffer_header_cart_switcher == 1 ){
                                        echo '<button type="button" class="simple-icon sideMenuToggler">';
                                            echo '<i class="far fa-shopping-cart"></i>';
                                            echo '<span class="badge">'.esc_html( $count ).'</span>';
                                        echo '</button>';
                                    }
                                    if(!empty( $ruffer_header_btn_text )){
                                        echo '<a href="'.esc_url($ruffer_btn_url).'" class="th-btn">'.esc_html( $ruffer_header_btn_text ).'<i class="fas fa-arrow-right ms-2"></i></a>';
                                    }
                                    echo '<button type="button" class="th-menu-toggle d-block d-lg-none"><i class="far fa-bars"></i></button>';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
                echo '<div class="logo-bg"></div>';
            echo '</div>';
        echo '</header>';
        if( $count > 0 ){
            //Cart sidebar box
            ruffer_cart_box();
        }
    }else{
        ruffer_global_header();
    }
}





// ruffer woocommerce breadcrumb
function ruffer_woo_breadcrumb( $args ) {
    return array(
        'delimiter'   => '',
        'wrap_before' => '<ul class="breadcumb-menu">',
        'wrap_after'  => '</ul>',
        'before'      => '<li>',
        'after'       => '</li>',
        'home'        => _x( 'Home', 'breadcrumb', 'ruffer' ),
    );
}

add_filter( 'woocommerce_breadcrumb_defaults', 'ruffer_woo_breadcrumb' );

function ruffer_custom_search_form( $class ) {
    echo '<!-- Search Form -->';

    echo '<form role="search" method="get" action="'.esc_url( home_url( '/' ) ).'" class="'.esc_attr( $class ).'">';
        echo '<label class="searchIcon">';
            echo ruffer_img_tag( array(
                "url"   => esc_url( get_theme_file_uri( '/assets/img/search-2.svg' ) ),
                "class" => "svg"
            ) );
            echo '<input value="'.esc_html( get_search_query() ).'" name="s" required type="search" placeholder="'.esc_attr__('What are you looking for?', 'ruffer').'">';
        echo '</label>';
    echo '</form>';
    echo '<!-- End Search Form -->';
}



//Fire the wp_body_open action.
if ( ! function_exists( 'wp_body_open' ) ) {
    function wp_body_open() {
        do_action( 'wp_body_open' );
    }
}

//Remove Tag-Clouds inline style
add_filter( 'wp_generate_tag_cloud', 'ruffer_remove_tagcloud_inline_style',10,1 );
function ruffer_remove_tagcloud_inline_style( $input ){
   return preg_replace('/ style=("|\')(.*?)("|\')/','',$input );
}

function ruffer_setPostViews( $postID ) {
    $count_key  = 'post_views_count';
    $count      = get_post_meta( $postID, $count_key, true );
    if( $count == '' ){
        $count = 0;
        delete_post_meta( $postID, $count_key );
        add_post_meta( $postID, $count_key, '0' );
    }else{
        $count++;
        update_post_meta( $postID, $count_key, $count );
    }
}

function ruffer_getPostViews( $postID ){
    $count_key  = 'post_views_count';
    $count      = get_post_meta( $postID, $count_key, true );
    if( $count == '' ){
        delete_post_meta( $postID, $count_key );
        add_post_meta( $postID, $count_key, '0' );
        return __( '0', 'ruffer' );
    }
    return $count;
}


/* This code filters the Categories archive widget to include the post count inside the link */
add_filter( 'wp_list_categories', 'ruffer_cat_count_span' );
function ruffer_cat_count_span( $links ) {
    $links = str_replace('</a> (', '</a> <span class="category-number">', $links);
    $links = str_replace(')', '</span>', $links);
    return $links;
}

/* This code filters the Archive widget to include the post count inside the link */
add_filter( 'get_archives_link', 'ruffer_archive_count_span' );
function ruffer_archive_count_span( $links ) {
    $links = str_replace('</a>&nbsp;(', '</a> <span class="category-number">', $links);
    $links = str_replace(')', '</span>', $links);
    return $links;
}
//header search box
if(! function_exists('ruffer_search_box')){
    function ruffer_search_box(){
        echo '<div class="popup-search-box d-none d-lg-block  ">';
            echo '<button class="searchClose border-theme text-theme"><i class="fal fa-times"></i></button>';
            echo '<form role="search" method="get" action="'.esc_url( home_url( '/' ) ).'">';
                echo '<input value="'.esc_html( get_search_query() ).'" class="border-theme" name="s" required type="search" placeholder="'.esc_attr__('What are you looking for?', 'ruffer').'">';
                echo '<button type="submit"><i class="fal fa-search"></i></button>';
            echo '</form>';
        echo '</div>';
    }
}

// mobile logo
function ruffer_mobile_logo() {
    $logo_url = ruffer_opt('ruffer_mobile_logo', 'url' );
    $mobile_menu = '';
    if( !empty($logo_url )){
        $mobile_menu = '<div class="mobile-logo"><a href="'.home_url('/').'"><img src="'.esc_url($logo_url).'" alt="'.esc_attr__( 'logo', 'ruffer' ).'"></a></div>';
    }else{
        $mobile_menu .= '<div class="mobile-logo">';
        $mobile_menu .= ruffer_theme_logo();
        $mobile_menu .= '</div>';
    }

    return $mobile_menu;
 }

//header Mobile Menu
if( ! function_exists( 'ruffer_mobile_menu' ) ){
    function ruffer_mobile_menu(){
    ?>
    <div class="th-menu-wrapper">
        <div class="th-menu-area text-center">
            <button class="th-menu-toggle"><i class="fal fa-times"></i></button>
            <?php  if( class_exists('ReduxFramework') ):?>
                <?php 
                    if(!empty(ruffer_opt('ruffer_menu_menu_show') )){
                        echo ruffer_mobile_logo(); 
                    }
                ?>
            <?php else: ?>
                <div class="mobile-logo">
                    <?php echo ruffer_theme_logo(); ?>
                </div>
            <?php endif; ?>
            <div class="th-mobile-menu">
                <?php 
                    if( has_nav_menu( 'primary-menu' ) ){
                        wp_nav_menu( array(
                            "theme_location"    => 'primary-menu',
                            "container"         => '',
                            "menu_class"        => ''
                        ) );
                    }
                ?>
            </div>
        </div>
    </div>

<?php
    }
}


//Cart sidebar box
if(! function_exists('ruffer_cart_box')){
    function ruffer_cart_box(){
        echo '<div class="sidemenu-wrapper">';
            echo '<div class="sidemenu-content">';
                echo '<div class="d-flex align-items-center justify-content-between mb-4">';
                    echo '<h3 class="widget_title mb-0">'.esc_html( 'Shopping cart', 'ruffer' ).'</h3>';
                    echo '<button class="closeButton sideMenuCls"><i class="far fa-times"></i></button>';
                echo '</div>';
                echo '<div class="widget woocommerce widget_shopping_cart">';
                    echo '<div class="widget_shopping_cart_content">';
                        if( class_exists( 'woocommerce' ) ){
                            echo woocommerce_mini_cart();
                        }
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        echo '</div>';
   }
}

//Offcanvas box
if(! function_exists('ruffer_offcanvas_box')){
     function ruffer_offcanvas_box(){
        echo '<div class="sidemenu-wrapper d-none d-lg-block ">';
            echo '<div class="sidemenu-content">';
                echo '<button class="closeButton sideMenuCls"><i class="far fa-times"></i></button>';
                    if(is_active_sidebar('ruffer-offcanvth-sidebar')){
                        dynamic_sidebar( 'ruffer-offcanvth-sidebar' );
                    }else{
                        echo '<h4 class="text-white">No Widget Added </h4>';
                        echo '<p>Please add some widget in Offcanvs Sidebar</p>';
                    }
            echo '</div>';
        echo '</div>';
    }
}


// Ruffer Default Header for unit test
if( ! function_exists( 'ruffer_global_header' ) ){
    function ruffer_global_header(){
        echo ruffer_search_box();
        echo ruffer_mobile_menu();

        if( class_exists( 'ReduxFramework' ) ){ 
            $class = '';
        } else {
            $class = 'unittest-header';
        }

        echo '<!--======== Header ========-->';
        echo '<header class="th-header header-layout1 ' . esc_attr($class) . ' ">';
           echo ' <div class="menu-wrapper">';
                echo '<div class="sticky-wrapper">';
                    echo '<div class="menu-area">';
                        echo '<div class="container">';
                            echo '<div class="row gx-20 align-items-center justify-content-between">';
                                echo '<div class="col-auto">';
                                    echo '<div class="header-logo">';
                                        echo ruffer_theme_logo();
                                    echo '</div>';
                                echo '</div>';
                                echo '<div class="col-auto">';
                                    if( has_nav_menu( 'primary-menu' ) ) {
                                        echo '<nav class="main-menu d-none d-lg-inline-block">';
                                            wp_nav_menu( array(
                                                "theme_location"    => 'primary-menu',
                                                "container"         => '',
                                                "menu_class"        => ''
                                            ) );
                                        echo '</nav>';
                                    }                                    
                                    echo '</nav>';
                                    echo '<button type="button" class="th-menu-toggle d-inline-block d-lg-none"><i class="far fa-bars"></i></button>';
                                echo '</div>';
                                echo '<div class="col-auto d-none d-xl-block">';
                                    echo '<div class="header-button">';
                                        echo '<button type="button" class="simple-icon searchBoxToggler"><i class="far fa-search"></i></button>';
                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        echo '</header>';
    }
}

if( ! function_exists( 'ruffer_header_topbar' ) ){
    function ruffer_header_topbar(){
        
        $ruffer_show_header_topbar      = ruffer_opt( 'ruffer_header_topbar_switcher' );
        $ruffer_show_social_icon        = ruffer_opt( 'ruffer_header_topbar_social_icon_switcher' );
        $ruffer_menu_topbar_phone      = ruffer_opt( 'ruffer_menu_topbar_phone' );          
        $ruffer_menu_topbar_email       = ruffer_opt( 'ruffer_menu_topbar_email' );
        $ruffer_header_topbar_language_switcher       = ruffer_opt( 'ruffer_header_topbar_language_switcher' );

        $phone      = $ruffer_menu_topbar_phone;
        $email      = $ruffer_menu_topbar_email;

        if( $ruffer_show_header_topbar ){
            $allowhtml = array(
                'a'    => array(
                    'href' => array(),
                    'class' => array()
                ),
                'u'    => array(
                    'class' => array()
                ),
                'span' => array(
                    'class' => array()
                ),
                'i'    => array(
                    'class' => array()
                )
            );
            echo '<!--header-top-wrapper start-->';

            echo '<div class="header-top">';
                echo '<div class="container th-container">'; 
                    echo '<div class="row justify-content-center justify-content-md-between align-items-center gy-2">';
                        echo '<div class="col-auto d-none d-md-block">';
                            echo '<div class="header-links">';
                                echo '<ul>';
                                    if(!empty($phone )){
                                        echo '<li>'.wp_kses_post($phone).'</li>';
                                    }
                                    if(!empty($email )){
                                        echo '<li>'.wp_kses_post($email).'</li>';
                                    }
                                echo '</ul>';
                            echo '</div>';
                        echo '</div>';
                        echo '<div class="col-auto">';
                            echo '<div class="header-links">';
                                echo '<ul>';
                                    if($ruffer_header_topbar_language_switcher){
                                        echo '<li class="d-none d-lg-inline-block">';
                                            echo '<div class="dropdown-link">';
                                                echo '<a class="dropdown-toggle" href="'.esc_url('#').'" role="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false">'.esc_html__('Language', 'ruffer').'</a>';
                                                echo '<ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">';
                                                    echo '<li>';
                                                        echo do_shortcode('[gtranslate]');
                                                    echo '</li>';
                                                echo '</ul>';
                                            echo '</div>';
                                        echo '</li>';
                                    }
                                    if( $ruffer_show_social_icon ){
                                        echo '<li>';
                                            echo '<div class="social-links">';
                                                ruffer_social_icon();
                                            echo '</div>';
                                        echo '</li>';
                                    }
                                echo '</ul>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        }
    }
}

// Add Extra Class On Comment Reply Button
function ruffer_custom_comment_reply_link( $content ) {
    $extra_classes = 'reply-btn';
    return preg_replace( '/comment-reply-link/', 'comment-reply-link ' . $extra_classes, $content);
}

add_filter('comment_reply_link', 'ruffer_custom_comment_reply_link', 99);

// Add Extra Class On Edit Comment Link
function ruffer_custom_edit_comment_link( $content ) {
    $extra_classes = 'reply-btn';
    return preg_replace( '/comment-edit-link/', 'comment-edit-link ' . $extra_classes, $content);
}

add_filter('edit_comment_link', 'ruffer_custom_edit_comment_link', 99);


function ruffer_post_classes( $classes, $class, $post_id ) {
    if ( get_post_type() === 'post' ) {
        $classes[] = "th-blog blog-single";
    }elseif( get_post_type() === 'product' ){
        // Return Class
    }elseif( get_post_type() === 'page' ){
        $classes[] = "page--item";
    }
    
    return $classes;
}
add_filter( 'post_class', 'ruffer_post_classes', 10, 3 );
add_filter('wpcf7_autop_or_not', '__return_false');