<?php
// Block direct access
if( !defined( 'ABSPATH' ) ){
    exit();
}
/**
 * @Packge     : Ruffer
 * @Version    : 1.0
 * @Author     : Themeholy
 * @Author URI : https://www.themeholy.com/
 *
 */

// enqueue css
function ruffer_common_custom_css(){
    wp_enqueue_style( 'ruffer-color-schemes', get_template_directory_uri().'/assets/css/color.schemes.css' );

    $CustomCssOpt  = ruffer_opt( 'ruffer_css_editor' );
    if( $CustomCssOpt ){
        $CustomCssOpt = $CustomCssOpt;
    }else{
        $CustomCssOpt = '';
    }

    $customcss = "";
    
    if( get_header_image() ){
        $ruffer_header_bg =  get_header_image();
    }else{
        if( ruffer_meta( 'page_breadcrumb_settings' ) == 'page' ){
            if( ! empty( ruffer_meta( 'breadcumb_image' ) ) ){
                $ruffer_header_bg = ruffer_meta( 'breadcumb_image' );
            }
        }
    }
    
    if( !empty( $ruffer_header_bg ) ){
        $customcss .= ".breadcumb-wrapper{
            background-image:url('{$ruffer_header_bg}')!important;
        }";
    }
    
    // theme color 1
    $rufferthemecolor = ruffer_opt('ruffer_theme_color');
    if( !empty( $rufferthemecolor ) ){
        list($r, $g, $b) = sscanf( $rufferthemecolor, "#%02x%02x%02x");

        $ruffer_real_color = $r.','.$g.','.$b;
        if( !empty( $rufferthemecolor ) ) {
            $customcss .= ":root {
              --theme-color: rgb({$ruffer_real_color});
            }";
        }
    }
    // Heading  color
    $rufferheadingcolor = ruffer_opt('ruffer_heading_color');
    if( !empty( $rufferheadingcolor ) ){
        list($r, $g, $b) = sscanf( $rufferheadingcolor, "#%02x%02x%02x");

        $ruffer_real_color = $r.','.$g.','.$b;
        if( !empty( $rufferheadingcolor ) ) {
            $customcss .= ":root {
                --title-color: rgb({$ruffer_real_color});
            }";
        }
    }
    // Body color
    $rufferbodycolor = ruffer_opt('ruffer_body_color');
    if( !empty( $rufferbodycolor ) ){
        list($r, $g, $b) = sscanf( $rufferbodycolor, "#%02x%02x%02x");

        $ruffer_real_color = $r.','.$g.','.$b;
        if( !empty( $rufferbodycolor ) ) {
            $customcss .= ":root {
                --body-color: rgb({$ruffer_real_color});
            }";
        }
    }

    // Body font
    $rufferbodyfont = ruffer_opt('ruffer_theme_body_font', 'font-family');
    if( !empty( $rufferbodyfont ) ) {
        $customcss .= ":root {
            --body-font: $rufferbodyfont ;
        }";
    }

    // Heading font
    $rufferheadingfont = ruffer_opt('ruffer_theme_heading_font', 'font-family');
    if( !empty( $rufferheadingfont ) ) {
        $customcss .= ":root {
            --title-font: $rufferheadingfont ;
        }";
    }

    // Navbar submenu icon
    if(ruffer_opt('ruffer_menu_icon_class')){
        $menu_icon_class = ruffer_opt( 'ruffer_menu_icon_class' );
    }else{
        $menu_icon_class = 'f105';
    }

    if( !empty( $menu_icon_class ) ) {
        $customcss .= ".main-menu ul.sub-menu li a:before {
                content: \"\\$menu_icon_class\" !important;
            }";
    }
        

    if( !empty( $CustomCssOpt ) ){
        $customcss .= $CustomCssOpt;
    }

    wp_add_inline_style( 'ruffer-color-schemes', $customcss );
}
add_action( 'wp_enqueue_scripts', 'ruffer_common_custom_css', 100 );