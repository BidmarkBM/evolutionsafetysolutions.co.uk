<?php
/**
 * Single Product Up-Sells
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/up-sells.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$ruffer_woo_upsellproduct_display = ruffer_opt('ruffer_woo_upsellproduct_display');

if ( $upsells && $ruffer_woo_upsellproduct_display ) : ?>

	<div class="releted-product pt-50 th-product-layout1">
        <div class="section-title mb-20">
		    <h2><?php esc_html_e( 'You may also like', 'ruffer' ); ?></h2>
        </div>

		<?php woocommerce_product_loop_start(); ?>
        <?php
            if( class_exists('ReduxFramework') ) {
                $ruffer_woo_upsell_product_col = ruffer_opt('ruffer_woo_upsell_product_col');
            } else{
                $ruffer_woo_upsell_product_col = '4';
            }
        ?>

			<?php foreach ( $upsells as $upsell ) : ?>
                <div class="col-lg-<?php echo esc_attr($ruffer_woo_upsell_product_col); ?> col-sm-6">
				<?php
					$post_object = get_post( $upsell->get_id() );

					setup_postdata( $GLOBALS['post'] =& $post_object );

					wc_get_template_part( 'content', 'product' ); ?>
                </div>
			<?php endforeach; ?>

		<?php woocommerce_product_loop_end(); ?>

	</div>

<?php endif;

wp_reset_postdata();
