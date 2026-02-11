<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     3.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$ruffer_woo_relproduct_display = ruffer_opt('ruffer_woo_relproduct_display');

if ( $related_products && $ruffer_woo_relproduct_display) : ?>

    <div class="related-products space-extra-top">

        <div class="row justify-content-between align-items-center">

            <?php
            if( class_exists('ReduxFramework') ) {
                $subtitle = ruffer_opt('ruffer_woo_relproduct_subtitle');
                $title = ruffer_opt('ruffer_woo_relproduct_title');
            }else{
                $subtitle = esc_html__('Some Others Product','ruffer');
                $title = esc_html__('Related products','ruffer');
            }
            ?>

            <div class="col-auto">
                <h2 class="sec-title"><?php echo esc_html($title) ?></h2>
            </div>
            <div class="col d-none d-sm-block">
                <hr class="title-line">
            </div>
            <div class="col-auto">
                <div class="sec-btn">
                    <div class="icon-box">
                        <button data-slick-prev="#productCarousel" class="slick-arrow default"><i class="far fa-arrow-left"></i></button>
                        <button data-slick-next="#productCarousel" class="slick-arrow default"><i class="far fa-arrow-right"></i></button>
                    </div>
                </div>
            </div>
        </div>








        <div class="title-area text-center">
            <?php
            if( class_exists('ReduxFramework') ) {
                $subtitle = ruffer_opt('ruffer_woo_relproduct_subtitle');
                $title = ruffer_opt('ruffer_woo_relproduct_title');
            }else{
                $subtitle = esc_html__('Some Others Product','ruffer');
                $title = esc_html__('Related products','ruffer');
            }
            ?>
            <span class="sub-title justify-content-center">
                    <span class="shape left"><span class="dots"></span></span><?php echo esc_html($subtitle) ?><span class="shape right"><span class="dots"></span></span>
            </span>
            <h2 class="sec-title"><?php echo esc_html($title) ?></h2>
        </div>

        <?php
            if( class_exists('ReduxFramework') ) { ?>
        <div class="row th-carousel" id="productCarousel" data-slide-show="4" data-lg-slide-show="3" data-md-slide-show="2" data-sm-slide-show="2" data-xs-slide-show="1">
        <?php }else{ ?>


        <div class="row related-products-carousel" id="productCarousel">

        <?php }
            
            if( class_exists('ReduxFramework') ) {
                $ruffer_woo_related_product_col = ruffer_opt('ruffer_woo_related_product_col');
                if( $ruffer_woo_related_product_col == '2' ) {
                    $ruffer_woo_product_col_val = 'col-xl-2 col-lg-4 col-sm-6 mb-30';
                } elseif( $ruffer_woo_related_product_col == '3' ) {
                    $ruffer_woo_product_col_val = 'col-xl-3 col-lg-4 col-sm-6 mb-30';
                } elseif( $ruffer_woo_related_product_col == '4' ) {
                    $ruffer_woo_product_col_val = 'col-xl-4 col-lg-4 col-sm-6 mb-30';
                } elseif( $ruffer_woo_related_product_col == '6' ) {
                    $ruffer_woo_product_col_val = 'col-lg-6 col-sm-6 mb-30';
                }
            } else {
                $ruffer_woo_product_col_val = 'col-xl-3 col-lg-4 col-sm-6 mb-30';
            }
        ?>

            <?php foreach ( $related_products as $related_product ) : ?>
                <div class="<?php echo esc_attr($ruffer_woo_product_col_val) ?>">
                    <?php
                        $post_object = get_post( $related_product->get_id() );

                        setup_postdata( $GLOBALS['post'] =& $post_object );

                        wc_get_template_part( 'content', 'product' );
                    ?>
                </div>

            <?php endforeach; ?>

        </div>

    </div>

<?php endif;

wp_reset_postdata();