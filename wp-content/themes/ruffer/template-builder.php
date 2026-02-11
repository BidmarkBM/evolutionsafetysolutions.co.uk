<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( );
}
/**
 * @Packge    : Ruffer
 * @version   : 1.0
 * @Author    : Themeholy
 * @Author URI: https://www.themeholy.com/
 * Template Name: Template Builder
 */

//Header
get_header();

// Container or wrapper div
$ruffer_layout = ruffer_meta( 'custom_page_layout' );

if( $ruffer_layout == '1' ){
	echo '<div class="ruffer-main-wrapper">';
		echo '<div class="container">';
			echo '<div class="row">';
				echo '<div class="col-sm-12">';
}elseif( $ruffer_layout == '2' ){
    echo '<div class="ruffer-main-wrapper">';
		echo '<div class="container-fluid">';
			echo '<div class="row">';
				echo '<div class="col-sm-12">';
}else{
	echo '<div class="ruffer-fluid">';
}
	echo '<div class="builder-page-wrapper">';
	// Query
	if( have_posts() ){
		while( have_posts() ){
			the_post();
			the_content();
		}
        wp_reset_postdata();
	}

	echo '</div>';
if( $ruffer_layout == '1' ){
				echo '</div>';
			echo '</div>';
		echo '</div>';
	echo '</div>';
}elseif( $ruffer_layout == '2' ){
				echo '</div>';
			echo '</div>';
		echo '</div>';
	echo '</div>';
}else{
	echo '</div>';
}

//footer
get_footer();