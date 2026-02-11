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

    if( class_exists( 'ReduxFramework' ) && defined('ELEMENTOR_VERSION') ) {
        if( is_page() || is_page_template('template-builder.php') ) {
            $ruffer_post_id = get_the_ID();

            // Get the page settings manager
            $ruffer_page_settings_manager = \Elementor\Core\Settings\Manager::get_settings_managers( 'page' );

            // Get the settings model for current post
            $ruffer_page_settings_model = $ruffer_page_settings_manager->get_model( $ruffer_post_id );

            // Retrieve the color we added before
            $ruffer_header_style = $ruffer_page_settings_model->get_settings( 'ruffer_header_style' );
            $ruffer_header_builder_option = $ruffer_page_settings_model->get_settings( 'ruffer_header_builder_option' );

            if( $ruffer_header_style == 'header_builder'  ) {

                if( !empty( $ruffer_header_builder_option ) ) {
                    $rufferheader = get_post( $ruffer_header_builder_option );
                    echo '<header class="header">';
                        echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $rufferheader->ID );
                    echo '</header>';
                }
            } else {
                // global options
                $ruffer_header_builder_trigger = ruffer_opt('ruffer_header_options');
                if( $ruffer_header_builder_trigger == '2' ) {
                    echo '<header>';
                    $ruffer_global_header_select = get_post( ruffer_opt( 'ruffer_header_select_options' ) );
                    $header_post = get_post( $ruffer_global_header_select );
                    echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $header_post->ID );
                    echo '</header>';
                } else {
                    // wordpress Header
                    ruffer_global_header_option();
                }
            }
        } else {
            $ruffer_header_options = ruffer_opt('ruffer_header_options');
            if( $ruffer_header_options == '1' ) {
                ruffer_global_header_option();
            } else {
                $ruffer_header_select_options = ruffer_opt('ruffer_header_select_options');
                $rufferheader = get_post( $ruffer_header_select_options );
                echo '<header class="header">';
                    echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $rufferheader->ID );
                echo '</header>';
            }
        }
    } else {
        ruffer_global_header_option();
    }