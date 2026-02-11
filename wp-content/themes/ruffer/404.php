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

    if( class_exists( 'ReduxFramework' ) ) {
        $ruffer404title        = ruffer_opt( 'ruffer_fof_title' );
        $ruffer404description  = ruffer_opt( 'ruffer_fof_description' );
        $ruffer404bg           = ruffer_opt( 'ruffer_404_bg','url' );
        $ruffer404btntext      = ruffer_opt( 'ruffer_fof_btn_text' );
    } else {
        $ruffer404title        = __( 'Ooops Page Not Found', 'ruffer' );
        $ruffer404description  = __( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'ruffer' );
        $ruffer404bg           = ''.RUFFER_DIR_ASSIST_URI.'img/error.svg';
        $ruffer404btntext      = __( ' Back To Home', 'ruffer');

        
    }

    // get header
    get_header();

    echo '<div class="space">';
        echo '<div class="container">';
            echo '<div class="error-img">';
                echo ruffer_img_tag( array(
                    'url'   => esc_url($ruffer404bg),
                ) ); 
            echo '</div>';
            echo '<div class="error-content">';
                echo '<h2 class="error-title">'.wp_kses_post( $ruffer404title ).'</h3>';
                echo '<p class="error-text">'.esc_html( $ruffer404description ).'</p>';
                echo '<a href="'.esc_url( home_url('/') ).'" class="th-btn">'.esc_html( $ruffer404btntext ).'<i class="far fa-paper-plane ms-2"></i></a>';
            echo '</div>';
        echo '</div>';
    echo '</div>';
    //footer
    get_footer();