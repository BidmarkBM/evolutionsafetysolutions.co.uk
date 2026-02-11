<?php
/**
 *
 * @Packge      ruffer
 * @Author      themeholy
 * @Author URI: https://themeforest.net/user/themeholy
 * @version     1.0
 *
 */

/**
 * Enqueue style of child theme
 */
function ruffer_child_enqueue_styles() {

    wp_enqueue_style( 'ruffer-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'ruffer-child-style', get_stylesheet_directory_uri() . '/style.css',array( 'ruffer-style' ),wp_get_theme()->get('Version'));
}
add_action( 'wp_enqueue_scripts', 'ruffer_child_enqueue_styles', 100000 );


add_action('woocommerce_archive_description', 'custom_show_category_name_description', 5);
function custom_show_category_name_description() {
    if (is_product_category()) {
        echo '<div class="custom-category-header">';
            echo '<h1 class="category-title">' . single_cat_title('', false) . '</h1>';
            echo '<div class="category-description">' . category_description() . '</div>';
        echo '</div>';
    }
}

// Looking to send emails in production? Check out our Email API/SMTP product!
function mailtrap($phpmailer) {
  $phpmailer->isSMTP();
  $phpmailer->Host = 'sandbox.smtp.mailtrap.io';
  $phpmailer->SMTPAuth = true;
  $phpmailer->Port = 2525;
  $phpmailer->Username = '1eb2d5144394e1';
  $phpmailer->Password = '6414f025f2224b';
}

add_action('phpmailer_init', 'mailtrap');


add_filter('woocommerce_product_get_gallery_image_ids', 'add_featured_image_to_gallery_slider');

function add_featured_image_to_gallery_slider($gallery_image_ids) {
    global $product;

    if (!$product) return $gallery_image_ids;

    $featured_image_id = $product->get_image_id();

    // Check if featured image is already in gallery
    if ($featured_image_id && !in_array($featured_image_id, $gallery_image_ids)) {
        // Prepend featured image
        array_unshift($gallery_image_ids, $featured_image_id);
    }

    return $gallery_image_ids;
}



// Old (crop on)
add_image_size( 'woocommerce_thumbnail', 300, 300, true );

// New (no crop)
add_image_size( 'woocommerce_thumbnail', 9999, 9999, false );



add_filter( 'woocommerce_thumbnail_cropping', '__return_false' );


add_filter( 'jetpack_photon_override_image_downsize', '__return_true' );
add_filter( 'jetpack_photon_pre_args', function( $args ) {
    if ( isset( $args['resize'] ) {
        $args['fit'] = $args['resize']; // Replace 'resize' with 'fit'
        unset( $args['resize'] );
    }
    return $args;
} );

	
	



