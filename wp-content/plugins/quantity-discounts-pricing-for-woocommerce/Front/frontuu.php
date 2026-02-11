<?php
$plgfqdp_save_All_general_settings_db_in=plgfyspi_get_all_gnrl_settttings_onfrnt();
add_action($plgfqdp_save_All_general_settings_db_in['plgfyqdp_table_position'], 'plgfyqdp_create_table');

function plgfyqdp_create_table() {

	$main_product_id=get_the_ID();
	$idsarray=array();
	$plgfyspi_all_rules=get_option('plgfyqdp_all_rules');

	if ( '' == $plgfyspi_all_rules ) {
		$plgfyspi_all_rules=array();
	}
	$pro=array();
	$cat=array();
	$who=array();
	foreach ($plgfyspi_all_rules as $key => $value) {
		if ('Category' == $value['applied_on']) {
			$cat[]=$value;
		} else if ('Products' == $value['applied_on']) {
			$pro[]=$value;
		} else {
			$who[]=$value;
		}
	}


	foreach ($cat as $key => $value) {
		$who[]=$value;
	}
	foreach ($pro as $key => $value) {
		$who[]=$value;
	}
	$idsarray=checkeligibleids_plgfy($main_product_id, $who);

	$plgfqdp_save_All_general_settings_db_in=plgfyspi_get_all_gnrl_settttings_onfrnt();

	if ( 'before_discount_table' == $plgfqdp_save_All_general_settings_db_in['plgfyqdp_dt_and_as_position']) {
		plugify_create_price_and_discounted_price ($idsarray, $main_product_id);
	}
	
	foreach ($idsarray as $key => $value) {
		create_tbloo_plgfy($who[$value], $value, $key);
	}


	if ( 'after_discount_table' == $plgfqdp_save_All_general_settings_db_in['plgfyqdp_dt_and_as_position']) {
		plugify_create_price_and_discounted_price ($idsarray, $main_product_id);
	}

}




function plugify_create_price_and_discounted_price ( $idsarray, $main_product_id ) {
	$product = wc_get_product($main_product_id);

	$dis='display:block;';
	if ('variable' == $product->get_type()) {
		$dis=' display:none; ';
	}

	
	if (is_array($idsarray) && !empty($idsarray)) {
		?>
		<div >
			<input type="hidden" id ="plgfy_product_original_price" value="<?php echo filter_var( $product->get_price() ); ?>">
			<?php
			$all_gnrl_plgfyqdp_set=plgfyspi_get_all_gnrl_settttings_onfrnt();
			if ('true' == $all_gnrl_plgfyqdp_set['plgfqdp_shw_dscnt_totl']) {
				$discounted_text = '<b><span id="plugify_total_discounted_price">' . wc_price($product->get_price()) . '</span></b>';
				?>
				<div class="plugify_orgnl_prc_savd" style="<?php echo esc_attr($dis); ?>">
					
					<?php
					echo filter_var(str_replace( '[discounted_total]', $discounted_text, $all_gnrl_plgfyqdp_set['plgfqdp_shw_dscnt_totl_txt'] ));
					?>
				</div>
				<?php
			}

			if ('true' == $all_gnrl_plgfyqdp_set['plgfqdp_shw_amnt_svd']) {
				?>
				<div class="plugify_orgnl_prc_savd" style="<?php echo esc_attr($dis); ?>">
					<?php
					$amount_saved_text = '<b><span id="plugify_total_saved_price"></span></b>';
					echo filter_var(str_replace( '[amount_saved]', $amount_saved_text, $all_gnrl_plgfyqdp_set['plgfqdp_shw_amnt_svd_txt'] ));
					?>
				</div>
				<?php
			}
			?>
		</div>
		<?php
	}
}

function plgfyqdp_alter_price_on_quantity_change() {
	plgfyqdp_alter_price_cart( WC()->cart );
}
add_action( 'woocommerce_after_cart_item_quantity_update', 'plgfyqdp_alter_price_on_quantity_change' );


add_action( 'woocommerce_before_calculate_totals', 'plgfyqdp_alter_price_cart', 9999 );

function plgfyqdp_alter_price_cart( $cart ) {
	if ( did_action( 'woocommerce_before_calculate_totals' ) >= 2 ) {
		return;
	} 
	if ( is_admin() && ! defined( ‘DOING_AJAX’ ) ) {
		return;
	}


	$all_gnrl_plgfyqdp_set=plgfyspi_get_all_gnrl_settttings_onfrnt();
	

	if ( count( WC()->cart->get_applied_coupons() ) > 0 ) {
		if ('plgfqdp_aply_nly_cpn' == $all_gnrl_plgfyqdp_set['plgfqdp_coupon_settings']) {
			return;
		}
	}

	$plgfyspi_all_rules=get_option('plgfyqdp_all_rules');

	if ( '' == $plgfyspi_all_rules ) {
		$plgfyspi_all_rules=array();
	}

	$is_discount_appied = false;

	$pro=array();
	$cat=array();
	$who=array();
	foreach ($plgfyspi_all_rules as $key => $value) {
		if ('Category' == $value['applied_on']) {
			$cat[]=$value;
		} else if ('Products' == $value['applied_on']) {
			$pro[]=$value;
		} else {
			$who[]=$value;
		}
	}


	foreach ($cat as $key => $value) {
		$who[]=$value;
	}
	foreach ($pro as $key => $value) {
		$who[]=$value;
	}
	$idsarray=array();
	foreach ( $cart->get_cart() as $cart_item_key => $cart_item ) {
		$product = $cart_item['data'];
		$old_price = $product->get_price();
		$main_product_id = $cart_item['product_id'];

		$idsarrayx=checkeligibleids_plgfy($main_product_id, $who);





		foreach ($idsarrayx as $key => $value) {
			$idsarray[$key]=$value;
		}
	}

	foreach ( $cart->get_cart() as $cart_item_key => $cart_item ) {
		// $product = $cart_item['data'];
		
		// $main_product_id = $cart_item['product_id'];



		if (0 == $cart_item['variation_id']) {
			$main_product_id = $cart_item['product_id'];
		} else {
			$main_product_id = $cart_item['variation_id'];
		}
		
		
		$product = wc_get_product($main_product_id);
		$old_price = $product->get_price();
		
		if (isset($idsarray[$product->get_id()])) {
			$value=$who[$idsarray[$product->get_id()]];

			if (!isset($value['include_cat'])) {
				$value['include_cat']='false';
			}

			if (!isset($value['include_pro'])) {
				$value['include_pro']='false';
			}

			$checkforpro=$value['include_pro'];
			$checkforcat=$value['include_cat'];
			
			$cat_ids = wp_get_post_terms($cart_item['product_id'], 'product_cat', array( 'fields'=>'ids' ));
			$quantityxyz=$cart_item['quantity'];
			if ('true' == $checkforcat) {
				

				$quantityxyz=0;
				foreach ( $cart->get_cart() as $cart_item_keyee => $cart_itemee ) {

					$cat_ids123 = wp_get_post_terms($cart_itemee['product_id'], 'product_cat', array( 'fields'=>'ids' ));

					if ( isset($idsarray[$cart_itemee['data']->get_id()]) && $idsarray[$product->get_id()] == $idsarray[$cart_itemee['data']->get_id()]) {
						$quantityxyz=$quantityxyz+intval($cart_itemee['quantity']);
					}
				}

			}

			if ('true' == $checkforpro) {
				$quantityxyz=0;
				foreach ( $cart->get_cart() as $cart_item_keyee => $cart_itemee ) {


					if ( isset($idsarray[$cart_itemee['data']->get_id()]) && $idsarray[$product->get_id()] == $idsarray[$cart_itemee['data']->get_id()]) {
						$quantityxyz=$quantityxyz+intval($cart_itemee['quantity']);
					}
				}
			}
			

			$new_price=plgfyqdp_get_latest_price($old_price, $value, $product->get_id(), $quantityxyz);
			
			$addons=0;
			if (isset($cart_item['addons'])) {
				foreach ($cart_item['addons'] as $key01 => $value01) {

					$addons=$addons+$value01['price'];

				}
			}


			if ('old' != $new_price || '0' == $new_price) {

				

				WC()->cart->cart_contents[$cart_item_key]['old_price_with_tax'] =wc_get_price_including_tax( $product );
				WC()->cart->cart_contents[$cart_item_key]['old_price'] =$cart_item['data']->get_price();
				
				
				
				WC()->cart->cart_contents[$cart_item_key]['plugify_discount'] ='valid';
				
				$cart_item['data']->set_price($new_price+$addons );
				WC()->cart->cart_contents[$cart_item_key]['new_price'] =$cart_item['data']->get_price();
				WC()->cart->set_session();

				$is_discount_appied = true;
				
			} else {
				
				// $cart_item['data']->set_price($old_price); //////// IMPORTANT ////////  commented this code because it was setting the price which is set on product edit page (causing issues for those who where using any other plugin to change the product price dynamically). This line was added to update the price on blocks checkout and cart. But the prices updated on second change so not big issue.

				WC()->cart->cart_contents[$cart_item_key]['plugify_discount'] ='not valid';
				
				WC()->cart->set_session();
			}
		} 

	}


	if ($is_discount_appied && 'plgfqdp_aply_nly_qt_ds' == $all_gnrl_plgfyqdp_set['plgfqdp_coupon_settings']) {
		$coupons = WC()->cart->get_applied_coupons();
		foreach ($coupons as $cou_key => $coupon) {
			WC()->cart->remove_coupon($coupon);
		}


		$notices = WC()->session->get('wc_notices', array());
		if ( isset( $notices['success'] ) ) {
			foreach ( $notices['success'] as $key => &$notice) {
				if ( 'Coupon code applied successfully.' == $notice['notice'] ) {
					unset( $notices['success'][$key] );
					$notices['error'] = array(
						0 => array( 
							'notice' => $all_gnrl_plgfyqdp_set['coupon_remove_message'], 
							'data' => array(), 
						),
					); 

				}


			}

		}

		WC()->session->set('wc_notices', $notices);

	}
}

use Automattic\WooCommerce\StoreApi\Exceptions\RouteException;
add_action( 'woocommerce_applied_coupon', 'plugify_qdp_restrict_applied_coupon');
function plugify_qdp_restrict_applied_coupon ( $coupon_code ) {
	$all_gnrl_plgfyqdp_set=plgfyspi_get_all_gnrl_settttings_onfrnt();
	foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
		if (isset($cart_item['plugify_discount']) && 'valid' == $cart_item['plugify_discount'] && 'plgfqdp_aply_nly_qt_ds' == $all_gnrl_plgfyqdp_set['plgfqdp_coupon_settings']) {
			if (woospo_is_cart_checkout_page_using_blocks_qdp()) {
				throw new RouteException( 'wc_qty_error_message', $all_gnrl_plgfyqdp_set['coupon_remove_message'], 400 );
			}
		}
	}
}

use Automattic\WooCommerce\Blocks\Utils\CartCheckoutUtils;
function woospo_is_cart_checkout_page_using_blocks_qdp() {

	
	if ( is_checkout() ) {
		return  CartCheckoutUtils::is_checkout_block_default();
	} else {
		return CartCheckoutUtils::is_cart_block_default();
	}
}

// add_filter( 'woocommerce_cart_item_price', 'plgfyqdp_woocommerce_cart_item_price_filter', 9999, 3 );
// function plgfyqdp_woocommerce_cart_item_price_filter( $price, $cart_item, $cart_item_key ) {
// $product = $cart_item['data'];

// 	if ('valid' == $cart_item['plugify_discount']) {

// 		if ( 'incl' == get_option('woocommerce_tax_display_cart') && 'yes' == get_option('woocommerce_calc_taxes')) {
// 			if (wc_get_price_including_tax($product) != $cart_item['old_price_with_tax']) {

// 				return '<strike>' . wc_price($cart_item['old_price_with_tax']) . '</strike> ' . wc_price(  wc_get_price_including_tax( $product ) );
// 			}

// 		} else {
// 			if ($cart_item['old_price']!=$cart_item['new_price']) {
// 				return '<strike>' . wc_price($cart_item['old_price']) . '</strike> ' . wc_price( $cart_item['new_price'] );
// 			}

// 		}
// 	}
// 	return $price;
// }

add_filter( 'woocommerce_cart_item_price', 'plgfyqdp_woocommerce_cart_item_price_filter', 9999, 3 );
function plgfyqdp_woocommerce_cart_item_price_filter( $price, $cart_item, $cart_item_key ) {

	$all_gnrl_plgfyqdp_set=plgfyspi_get_all_gnrl_settttings_onfrnt();
	if ( count( WC()->cart->get_applied_coupons() ) > 0 ) {
		if ('plgfqdp_aply_nly_cpn' == $all_gnrl_plgfyqdp_set['plgfqdp_coupon_settings']) {
			return $price;
		}
	}

	
	$product = $cart_item['data'];
	if (is_cart()) {
		if (isset($cart_item['plugify_discount']) && 'valid' == $cart_item['plugify_discount']) {

			if ( 'incl' == get_option('woocommerce_tax_display_cart') && 'yes' == get_option('woocommerce_calc_taxes')) {
				if (wc_get_price_including_tax($product) != $cart_item['old_price_with_tax']) {

					return '<strike>' . wc_price($cart_item['old_price_with_tax']) . '</strike> ' . wc_price(  wc_get_price_including_tax( $product ) );
				}
				
			} elseif ($cart_item['old_price']!=$cart_item['new_price']) {
				return '<strike>' . wc_price($cart_item['old_price']) . '</strike> ' . wc_price( $cart_item['new_price'] );
			}
				
			

		}

	}
	if (isset($cart_item['plugify_discount']) && 'valid' == $cart_item['plugify_discount']) {
		if ( 'incl' == get_option('woocommerce_tax_display_cart') && 'yes' == get_option('woocommerce_calc_taxes')) {


			return wc_price(  wc_get_price_including_tax( $product ) );
			

		} else {

			return wc_price( $cart_item['new_price'] );
			
			
		}
	}

	return $price;
}



function plgfyqdp_get_latest_price( $old_price, $value, $current_product_id, $quantity ) {

	$new_price='old';
	foreach ($value['start_rng'] as $key__1 => $value__1) {
		if ('qty' == $value['tabletyp']) {
			if ('==' == $value['end_rng'][$key__1]) {
				$plgfyqdp_end_range=$value['start_rng'][$key__1];
			} else if ('>=' == $value['end_rng'][$key__1]) {
				$plgfyqdp_end_range=999999999999;
			}
		} else {
			$plgfyqdp_end_range=$value['end_rng'][$key__1];
		}

		if ($quantity>=$value__1 && $quantity<=$plgfyqdp_end_range) {
			if ('fixed' == $value['discount_typ'][$key__1]) {
				$new_price=$old_price-$value['dis_price'][$key__1];
				if (0>$new_price) {
					$new_price=0;
				}
				return $new_price;
			} else if ('prcnt' == $value['discount_typ'][$key__1]) {

				$new_price=$old_price/100;
				$new_price=$new_price*$value['dis_price'][$key__1];
				$new_price=$old_price-$new_price;
				if (0>$new_price) {
					$new_price=0;
				}

				return $new_price;

			} else if ('ammend' == $value['discount_typ'][$key__1]) {
				$new_price=$value['dis_price'][$key__1];
				if (0>$new_price) {
					$new_price=0;
				}
				return $new_price;
			}



		}

	}
	return 'old';
}

function plugifycheck_eligible_user( $value ) {
	$found_user_role=false;

	if (!is_user_logged_in()) {
		if ('true' == $value['plgfydc_is_guest']) {
			$found_user_role=true;
		}

	} else {
		$user_meta=get_userdata(get_current_user_ID());
		$user_roles=$user_meta->roles;
		foreach ($user_roles as $key_1 => $value_1) {
			if (isset($value['allowed_roles']) && 0 < count($value['allowed_roles'])) {
				if (in_array($value_1, $value['allowed_roles'])) {
					$found_user_role=true;
					break;
				}
			} else {
				$found_user_role=true;
				break;
			}

		}
		
	}

	return $found_user_role;
}

function create_tbloo_plgfy( $value, $keyindex, $product_id ) {
	$product=wc_get_product($product_id);

	$all_gnrl_plgfyqdp_set=plgfyspi_get_all_gnrl_settttings_onfrnt();
	$plgfqdp_save_All_general_settings_db_in=$all_gnrl_plgfyqdp_set;

	if (isset($all_gnrl_plgfyqdp_set['quantitycol'])) {
		$quantitycol=$all_gnrl_plgfyqdp_set['quantitycol'];
	} else {
		$quantitycol='true';
	}
	if (isset($all_gnrl_plgfyqdp_set['discountcol'])) {
		$discountcol=$all_gnrl_plgfyqdp_set['discountcol'];
	} else {
		$discountcol='true';
	}
	if (isset($all_gnrl_plgfyqdp_set['peritemcol'])) {
		$peritemcol=$all_gnrl_plgfyqdp_set['peritemcol'];
	} else {
		$peritemcol='true';
	}
	$countera=0;
	if ('true' == $quantitycol) {
		$countera++;
	}
	if ('true' == $discountcol) {
		$countera++;
	}
	if ('true' == $peritemcol) {
		$countera++;
	}
	$percent='10%';
	if ('1' == $countera) {
		$percent='100%';
	} else if ('2'== $countera) {
		$percent='50%';
	} else if ('3' == $countera) {
		$percent='33.33%';
	}

	$dis='  ';
	$dis_hide='  ';
	if ('variation' == $product->get_type()) {
		$dis=' display:none; ';
	}

	if ( 0 == $countera) {
		$dis_hide=' display:none; ';
	}


	?>

	


	<div style="<?php echo filter_var($dis); ?>" class="plugify_main_parent_div" id="plugify_main_parent_div<?php echo filter_var($product_id); ?>">
		<div class="plugify_before_table_content_parent_div" >
			<?php
			echo filter_var(preg_replace('/\\\\/', '', stripcslashes( $plgfqdp_save_All_general_settings_db_in['before_content_plugify']) ));
			?>
		</div>
		<?php

		$old_price=$product->get_price();
		
		?>

		<div style="width:100%;overflow:auto; <?php echo filter_var($dis_hide); ?>" class="plugify_table_parent_div">
			<table id="tbloo_fine_trash_plugifyy<?php echo filter_var($product_id); ?>" style="width: 98%;"  data-toggle="table" attr-value="<?php echo filter_var($keyindex); ?>" class="table-responsive tablez tbloo_fine_trash_plugifyy">
				<tr class="plugify_tbl_row">
					<?php
					$qty_display = '';

					if ('true' != $quantitycol) {
						$qty_display = 'display: none;';
					} elseif ( 'true' != $plgfqdp_save_All_general_settings_db_in['plgfqdp_use_Def']) {
						$qty_display .= 'border-top-left-radius:' . $plgfqdp_save_All_general_settings_db_in['plgfqdp_brdr_rdius'] . 'px !important;';


						if ('true' != $peritemcol && 'true' != $discountcol) {
							$qty_display .= 'border-top-right-radius:' . $plgfqdp_save_All_general_settings_db_in['plgfqdp_brdr_rdius'] . 'px !important;';
						}
					}
						

					?>
						<th class="plugify_qty_col" style="width:<?php echo filter_var($percent); ?>; <?php echo filter_var($qty_display); ?>"><?php echo esc_html__($all_gnrl_plgfyqdp_set['col1qtytext'], 'plugify_qdp'); ?></th>
						<?php


						$type_display = '';

						if ('true' != $discountcol) {
							$type_display = 'display: none;';
						} elseif ( 'true' != $plgfqdp_save_All_general_settings_db_in['plgfqdp_use_Def']) {

							if ('true' != $peritemcol ) {

								$type_display .= 'border-top-right-radius:' . $plgfqdp_save_All_general_settings_db_in['plgfqdp_brdr_rdius'] . 'px !important;';
							}


							if ('true' != $quantitycol) {
								$type_display .= 'border-top-left-radius:' . $plgfqdp_save_All_general_settings_db_in['plgfqdp_brdr_rdius'] . 'px !important;';
							}
						}

						?>
						<th class="plugify_typ_col" style="width:<?php echo filter_var($percent); ?>; <?php echo filter_var($type_display); ?>"><?php echo esc_html__($all_gnrl_plgfyqdp_set['col1distext'], 'plugify_qdp'); ?></th>
						<?php

						$peritem_display = '';

						if ('true' != $peritemcol) {
							$peritem_display = 'display: none;';
						} elseif ( 'true' != $plgfqdp_save_All_general_settings_db_in['plgfqdp_use_Def']) {


							$peritem_display .= 'border-top-right-radius:' . $plgfqdp_save_All_general_settings_db_in['plgfqdp_brdr_rdius'] . 'px !important;';


							if ('true' != $quantitycol && 'true' != $discountcol) {
								$peritem_display .= 'border-top-left-radius:' . $plgfqdp_save_All_general_settings_db_in['plgfqdp_brdr_rdius'] . 'px !important;';

							}
						}



						?>
						<th class="plugify_pip_col" style="width:<?php echo filter_var($percent); ?>; <?php echo filter_var($peritem_display); ?>"><?php echo esc_html__($all_gnrl_plgfyqdp_set['col1pertext'], 'plugify_qdp'); ?></th>	
				</tr>

				<?php
				foreach ($value['start_rng'] as $key__1 => $value__1) {
					// echo sizeof($value['start_rng']);
					// echo $key__1;

					$qty_display = '';

					if ('true' != $quantitycol) {
						$qty_display = 'display: none;';
					}

					$type_display = '';
					if ('true' != $discountcol) {
						$type_display = 'display: none;';
					}
					$peritem_display = '';
					if ('true' != $peritemcol) {
						$peritem_display = 'display: none;';
					}

					if ( count($value['start_rng']) == $key__1+1 ) {

						if ('true' == $quantitycol && 'true' != $plgfqdp_save_All_general_settings_db_in['plgfqdp_use_Def']) {
							$qty_display .= 'border-bottom-left-radius:' . $plgfqdp_save_All_general_settings_db_in['plgfqdp_brdr_rdius'] . 'px !important;';

							if ('true' != $peritemcol && 'true' != $discountcol && 'true' != $plgfqdp_save_All_general_settings_db_in['plgfqdp_use_Def']) {
								$qty_display .= 'border-bottom-right-radius:' . $plgfqdp_save_All_general_settings_db_in['plgfqdp_brdr_rdius'] . 'px !important;';
							}
						}

						if ('true' == $discountcol) {
							if ('true' != $peritemcol && 'true' != $plgfqdp_save_All_general_settings_db_in['plgfqdp_use_Def']) {
								$type_display .= 'border-bottom-right-radius:' . $plgfqdp_save_All_general_settings_db_in['plgfqdp_brdr_rdius'] . 'px !important;';
							}

							if ('true' != $quantitycol && 'true' != $plgfqdp_save_All_general_settings_db_in['plgfqdp_use_Def']) {
								$type_display .= 'border-bottom-left-radius:' . $plgfqdp_save_All_general_settings_db_in['plgfqdp_brdr_rdius'] . 'px !important;';
							}
						}

						if ('true' == $peritemcol && 'true' != $plgfqdp_save_All_general_settings_db_in['plgfqdp_use_Def']) {
							$peritem_display .= 'border-bottom-right-radius:' . $plgfqdp_save_All_general_settings_db_in['plgfqdp_brdr_rdius'] . 'px !important;';


							if ('true' != $quantitycol && 'true' != $discountcol && 'true' != $plgfqdp_save_All_general_settings_db_in['plgfqdp_use_Def']) {
								$peritem_display .= 'border-bottom-left-radius:' . $plgfqdp_save_All_general_settings_db_in['plgfqdp_brdr_rdius'] . 'px !important;';
							}
						}


					}

					
					?>
					<tr class="plugify_tbl_row">
						
							<td class="plugify_qty_col" style="width:<?php echo filter_var($percent); ?>; <?php echo filter_var($qty_display); ?>">
								<?php 
								if ('==' == $value['end_rng'][$key__1]) {
									$value['end_rng'][$key__1]=$value__1;
								} else if ('>=' == $value['end_rng'][$key__1] ) {
									$value['end_rng'][$key__1]='999999';
								}



								if ($value__1 == $value['end_rng'][$key__1]) {
									echo filter_var($value__1);
								} elseif ('999999' == $value['end_rng'][$key__1]) {
									echo filter_var($value__1 . '+'); 
								} else {
									echo filter_var($value__1 . '-' . $value['end_rng'][$key__1]); 
								}
								

								

								?>
								<input type="hidden" id="qtystrt" value="<?php echo filter_var($value__1); ?>">
								<input type="hidden" id="qtyend" value="<?php echo filter_var($value['end_rng'][$key__1]); ?>">
							</td>
							
							<td class="plugify_typ_col" style="width:<?php echo filter_var($percent); ?>; <?php echo filter_var($type_display); ?>">
								<?php 
								if ('fixed' == $value['discount_typ'][$key__1]) {
									echo filter_var('-' . wc_price($value['dis_price'][$key__1])); 
								} else if ('prcnt' == $value['discount_typ'][$key__1]) {
									echo filter_var($value['dis_price'][$key__1] . '%'); 
								} else if ('ammend' == $value['discount_typ'][$key__1]) {
									echo filter_var('<strike>' . wc_price($old_price) . '</strike> ' . wc_price($value['dis_price'][$key__1])); 
								}

								?>
							</td>
							
							<td class="plugify_pip_col" style="width:<?php echo filter_var($percent); ?>; <?php echo filter_var($peritem_display); ?>">
								<?php

								$new_price='';
								if ('fixed' == $value['discount_typ'][$key__1]) {
									$new_price=$old_price-$value['dis_price'][$key__1];
								} else if ('prcnt' == $value['discount_typ'][$key__1]) {
									$new_price=$old_price/100;
									$new_price=$new_price*$value['dis_price'][$key__1];
									$new_price=$old_price-$new_price;

								} else if ('ammend' == $value['discount_typ'][$key__1]) {
									$new_price=$value['dis_price'][$key__1];
								}
								if (0>$new_price) {
									$new_price=0;
								}
								

								
								if (wc_get_price_including_tax($product) != $old_price && 'incl' == get_option('woocommerce_tax_display_shop') ) {
									$howprcnt=0;
									$tax_amount=wc_get_price_including_tax($product) - $product->get_price();
									$howprcnt= ( $tax_amount/$product->get_price() ) * 100;
									$new_price=$new_price+( ( $howprcnt/100 ) * $new_price );
									echo filter_var(wc_price($new_price) . ' ' . get_option('woocommerce_price_display_suffix')); 
								} else {
									echo filter_var(wc_price($new_price)); 
								}





								?>
							</td>

							<input type="hidden" name="plgfy_price_after_discount"  class="plgfy_price_after_discount" value="<?php echo filter_var($new_price); ?>">
					</tr>
					<?php
				}
				?>
			</table>
		</div>
		
		<div class="plugify_after_table_content_parent_div">
			<?php
			echo filter_var(preg_replace('/\\\\/', '', stripcslashes( $plgfqdp_save_All_general_settings_db_in['after_content_plugify']) ));
			?>
		</div>
	</div>
	
	<?php
}





add_action('wp_footer', 'plgfyscriptu');
function plgfyscriptu() {
	if (!is_product() ) {
		return;
	}
	$all_gnrl_plgfyqdp_set=plgfyspi_get_all_gnrl_settttings_onfrnt();
	$plgfqdp_save_All_general_settings_db_in=$all_gnrl_plgfyqdp_set;
	if (!isset($all_gnrl_plgfyqdp_set['plgfqdp_shw_strt']) && !isset($all_gnrl_plgfyqdp_set['plgfqdp_shw_strt_txt']) && !isset($all_gnrl_plgfyqdp_set['plgfqdp_dynprc']) ) {

		$all_gnrl_plgfyqdp_set['plgfqdp_shw_strt']='true';
		$all_gnrl_plgfyqdp_set['plgfqdp_shw_strt_txt']='Starting From: [min_price]';
		$all_gnrl_plgfyqdp_set['plgfqdp_dynprc']='true';
	}

	$product=wc_get_product(get_the_ID());
	if ( ! is_a( $product, 'WC_Product' ) ) {
		return;
	}
	
	if ('variable' != $product->get_type() && 'simple' != $product->get_type()) {
		return;
	}
	?>
	<style type="text/css">
		.tablez > tbody > tr > td, .tablez > tbody > tr > th, .tablez > tfoot > tr > td, .tablez > tfoot > tr > th, .tablez > thead > tr > td, .tablez > thead > tr > th{
			padding: 8px;
		}

		
	</style>
	
	<script type="text/javascript">
		jQuery(document).ready(function(){
			var prod_id='<?php echo filter_var(get_the_ID()); ?>';

			jQuery( ".variations_form" ).on( "woocommerce_variation_select_change", function () {

				jQuery('.plugify_main_parent_div').hide();
				jQuery('.plugify_orgnl_prc_savd').hide();
				console.log('hide_upper')

			});

			jQuery( ".single_variation_wrap" ).on( "show_variation", function ( event, variation ) {

				jQuery('.plugify_main_parent_div').hide();
				jQuery('#plugify_main_parent_div'+variation.variation_id).show();
			
					if ( jQuery('#plugify_main_parent_div'+variation.variation_id).length > 0 ) {
						console.log('show')
						jQuery('.plugify_orgnl_prc_savd').show();				
					} else {
						console.log('hide')
						jQuery('.plugify_orgnl_prc_savd').hide();
					}	
				
			
				// jQuery('.plugify_orgnl_prc_savd').show();
			
				prod_id=variation.variation_id;
		
				jQuery('#plgfy_product_original_price').val(variation.display_price);
				call_it(jQuery(this));
			});

			call_it(jQuery('input[name="quantity"]'));
			
			jQuery('body').on('input change click', 'input[name="quantity"], .plus, .minus', function(){
				call_it(jQuery(this));
			});


			function updateDiscountedPrice(customValue) {
				var originalPrice = jQuery('#plgfy_product_original_price').val();

				var saved_single = originalPrice - customValue;


				var quantity = parseFloat(jQuery('.quantity input.input-text').val());
				var totalPrice = (quantity * customValue); 

				var totalsaved = (quantity * saved_single); 

				totalPrice  = totalPrice.toFixed(<?php echo filter_var(wc_get_price_decimals()); ?>);

				totalsaved  = totalsaved.toFixed(<?php echo filter_var(wc_get_price_decimals()); ?>);
				var zero_number = 0;
				zero_number = zero_number.toFixed(<?php echo filter_var(wc_get_price_decimals()); ?>);

				totalPrice = qd_checkGermanFormatPrice(totalPrice);
				zero_number = qd_checkGermanFormatPrice(zero_number);
				totalsaved = qd_checkGermanFormatPrice(totalsaved);

				var formattedPrice = '<?php echo filter_var(wc_price(0)); ?>'.replace(zero_number, totalPrice);

				jQuery('#plugify_total_discounted_price').html(formattedPrice);

				var formatted_saved_Price = '<?php echo filter_var(wc_price(0)); ?>'.replace(zero_number, totalsaved);
				jQuery('#plugify_total_saved_price').html(formatted_saved_Price);
			




			}


			function call_it(element){

				var originalPrice = jQuery('#plgfy_product_original_price').val();


				var qty=jQuery('input[name="quantity"]').val();
				qty=parseInt(qty);
				if ('' != qty ) {
					jQuery('#tbloo_fine_trash_plugifyy'+prod_id).find('tr').removeClass('activeclasstr');
					
					jQuery('#tbloo_fine_trash_plugifyy'+prod_id).find('tr').each(function(){
						var strtval=jQuery(this).find('#qtystrt').val();
						strtval=parseInt(strtval);
						var endval=jQuery(this).find('#qtyend').val();
						endval=parseInt(endval);
						

						if (qty>=strtval && qty<=endval) {

							var discounted_price = jQuery(this).find('.plgfy_price_after_discount').val();

							// console.log( originalPrice - discounted_price);

							updateDiscountedPrice(discounted_price);
							
							jQuery(this).addClass('activeclasstr');
							return false;
							
						} else {
							updateDiscountedPrice(originalPrice);

						}
						
					});
				} else {
					jQuery('#tbloo_fine_trash_plugifyy'+prod_id).find('tr').removeClass('activeclasstr');
				}

			}

			function qd_checkGermanFormatPrice(price) {

				<?php if ( ',' == get_option('woocommerce_price_decimal_sep')) { ?>
					return parseFloat(price).toLocaleString('de-DE', {
						minimumFractionDigits: <?php echo filter_var(get_option('woocommerce_price_num_decimals')); ?>,
						maximumFractionDigits: <?php echo filter_var(get_option('woocommerce_price_num_decimals')); ?>,
					});

				<?php } else { ?>
					return parseFloat(price).toLocaleString('en-US', {
						minimumFractionDigits: <?php echo filter_var(get_option('woocommerce_price_num_decimals')); ?>,
						maximumFractionDigits: <?php echo filter_var(get_option('woocommerce_price_num_decimals')); ?>,
					});
				<?php } ?>

			}


		});			
	</script>
	<?php
	if ('true' != $plgfqdp_save_All_general_settings_db_in['plgfqdp_use_Def']) {
		if ('true' == $plgfqdp_save_All_general_settings_db_in['plgfqdp_enable_shadow']) {
			$box_shadow='0 0 8px -2px rgba(0,0,0,.3)';
		} else {
			$box_shadow='unset';
		}

		?>
		<style type="text/css">
			.tbloo_fine_trash_plugifyy{
				border-radius: <?php echo filter_var($plgfqdp_save_All_general_settings_db_in['plgfqdp_brdr_rdius']); ?>px !important;

				padding-top: <?php echo filter_var($plgfqdp_save_All_general_settings_db_in['plgfqdp_padding_t']); ?>px !important;
				padding-right: <?php echo filter_var($plgfqdp_save_All_general_settings_db_in['plgfqdp_padding_r']); ?>px !important;
				padding-bottom: <?php echo filter_var($plgfqdp_save_All_general_settings_db_in['plgfqdp_padding_b']); ?>px !important;
				padding-left: <?php echo filter_var($plgfqdp_save_All_general_settings_db_in['plgfqdp_padding_l']); ?>px !important;
				box-shadow: <?php echo filter_var($box_shadow); ?> !important; 
			}

			/*.tbloo_fine_trash_plugifyy tr:first-child th:first-child {
				border-top-left-radius: <?php echo filter_var($plgfqdp_save_All_general_settings_db_in['plgfqdp_brdr_rdius']); ?>px !important;
			}

			.tbloo_fine_trash_plugifyy tr:first-child th:last-child {
				border-top-right-radius: <?php echo filter_var($plgfqdp_save_All_general_settings_db_in['plgfqdp_brdr_rdius']); ?>px !important;
			}

			.tbloo_fine_trash_plugifyy tr:last-child td:first-child {
				border-bottom-left-radius: <?php echo filter_var($plgfqdp_save_All_general_settings_db_in['plgfqdp_brdr_rdius']); ?>px !important;
			}
			.tbloo_fine_trash_plugifyy tr:last-child td:last-child {
				border-bottom-right-radius: <?php echo filter_var($plgfqdp_save_All_general_settings_db_in['plgfqdp_brdr_rdius']); ?>px !important;
			}*/

			.tbloo_fine_trash_plugifyy th{
				background-color: <?php echo filter_var($plgfqdp_save_All_general_settings_db_in['plgfqdp_tblhd_bg_color']); ?> !important;
				color: <?php echo filter_var($plgfqdp_save_All_general_settings_db_in['plgfqdp_tblhd_lbl_color']); ?> !important;

			}
			.tbloo_fine_trash_plugifyy td{
				background-color: <?php echo filter_var($plgfqdp_save_All_general_settings_db_in['plgfqdp_bg_color']); ?> !important;
				color: <?php echo filter_var($plgfqdp_save_All_general_settings_db_in['plgfqdp_lbl_txt_color']); ?> !important;

			}
			.table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th{
				padding: 8px;
			}
		</style>
		<?php
	}
	if ('true' == $all_gnrl_plgfyqdp_set['plgfqdp_dynprc']) {
		if (isset($all_gnrl_plgfyqdp_set['plgfqdp_hvrrrclr']) && isset($all_gnrl_plgfyqdp_set['plgfqdp_bg_hvrr_clrr'])) {

			?>
			<style type="text/css">
				.activeclasstr th{
					background-color: <?php echo filter_var($all_gnrl_plgfyqdp_set['plgfqdp_bg_hvrr_clrr']); ?> !important;
					color: <?php echo filter_var($all_gnrl_plgfyqdp_set['plgfqdp_hvrrrclr']); ?> !important;
					

				}
				.activeclasstr td{
					background-color: <?php echo filter_var($all_gnrl_plgfyqdp_set['plgfqdp_bg_hvrr_clrr']); ?> !important;
					color: <?php echo filter_var($all_gnrl_plgfyqdp_set['plgfqdp_hvrrrclr']); ?> !important;

				}
			</style>
			<?php
		}

	}
	$style_plugify_content=get_option('plgfyqdp_save_All_general_settings_db_in');

	if (isset($style_plugify_content['style_plugify_content']) && !empty($style_plugify_content['style_plugify_content'])) {
		// echo esc_attr($style_plugify_content['style_plugify_content']);
		do_action('plugify_set_custom_style', $style_plugify_content['style_plugify_content']);
	}
}


add_action('plugify_set_custom_style', 'plugify_set_custom_style', 10, 1);
function plugify_set_custom_style ($custom_style) {
	echo filter_var($custom_style);
}







































function checkeligibleids_plgfy( $main_product_id, $who ) {

	$product=wc_get_product($main_product_id);
	$typeee=$product->get_type();
	$idsarray=array();
	
	
	
	$ayafrom='';
	foreach ($who as $rulenumber => $ruledata) {
		$found_user_role=plugifycheck_eligible_user($ruledata);
		if ('true' == $ruledata['plgfydc_activate_rule'] && $found_user_role) {


			if ('Products' == $ruledata['applied_on']) {
				if ('variable' == $typeee) {

					// Removed Below Code which was causing the slow page load for multiple variations
					// $variations = $product->get_available_variations();
					// $variations_id = wp_list_pluck( $variations, 'variation_id' );


					// Used the below code instead to get only the varation ids instead of getting whole variation data
					$variations_id = $product->get_children();

					if (isset($ruledata['apllied_on_ids']) && in_array($main_product_id, $ruledata['apllied_on_ids'])) {
						foreach ($variations_id as $keys => $var_id) {
							if (!isset($idsarray[$var_id])) {

								$idsarray[$var_id]=$rulenumber;

							} elseif ('category' == $ayafrom || 'whole' == $ayafrom) {
								$idsarray[$var_id]=$rulenumber;

							}
							

						}
						$ayafrom='variable';
					} else {
						foreach ($variations_id as $keys => $var_id) {
							if (isset($ruledata['apllied_on_ids']) && in_array($var_id, $ruledata['apllied_on_ids'])) {

								$idsarray[$var_id]=$rulenumber;
								$ayafrom='variation';
								

							}
						}

					}



				} elseif (isset($ruledata['apllied_on_ids']) && in_array($main_product_id, $ruledata['apllied_on_ids'])) {
					if (!isset($idsarray[$main_product_id])) {
						$idsarray[$main_product_id]=$rulenumber;
						$ayafrom='simple';
					} else {
						if ('category' == $ayafrom || 'whole' == $ayafrom) {
							$idsarray[$main_product_id]=$rulenumber;
							$ayafrom='simple';
						}

					}


				} 
				





			} else if ('Category' == $ruledata['applied_on']) {
				if (isset($ruledata['apllied_on_ids'])) {
					$cat_ids = wp_get_post_terms($main_product_id, 'product_cat');
					foreach ($cat_ids as $key1 => $value1) {
						if (isset($ruledata['apllied_on_ids']) && ( in_array($value1->term_id, $ruledata['apllied_on_ids']) || in_array($value1->parent, $ruledata['apllied_on_ids'] ) ) ) {
							if ('variable' == $typeee) {

								// Removed Below Code which was causing the slow page load for multiple variations
								// $variations = $product->get_available_variations();
								// $variations_id = wp_list_pluck( $variations, 'variation_id' );


								// Used the below code instead to get only the varation ids instead of getting whole variation data
								$variations_id = $product->get_children();


								foreach ($variations_id as $keys => $var_id) {
									if (!isset($idsarray[$var_id])) {
										$idsarray[$var_id]=$rulenumber;

									} elseif ('whole' == $ayafrom) {
										$idsarray[$var_id]=$rulenumber;

									}
									


								}

								$ayafrom='category';


							} elseif (!isset($idsarray[$main_product_id])) {
								$idsarray[$main_product_id]=$rulenumber;
								$ayafrom='category';
							} elseif ('whole' == $ayafrom) {
								$idsarray[$main_product_id]=$rulenumber;
								$ayafrom='category';
							}






							
							break;
						}
					}
				}

			} elseif ('variable' == $typeee) {
				
				// Removed Below Code which was causing the slow page load for multiple variations
				// $variations = $product->get_available_variations();
				// $variations_id = wp_list_pluck( $variations, 'variation_id' );


				// Used the below code instead to get only the varation ids instead of getting whole variation data
				$variations_id = $product->get_children();

				foreach ($variations_id as $keys => $var_id) {
					$idsarray[$var_id]=$rulenumber;

				}
				$ayafrom='whole';




			} else {

				$idsarray[$main_product_id]=$rulenumber;
				$ayafrom='whole';


			}
			



		}
		
	}

	return $idsarray;
}



function plgfyspi_get_all_gnrl_settttings_onfrnt() {

	$plgfqdp_save_All_general_settings_db_in=get_option('plgfyqdp_save_All_general_settings_db_in');
	if ('' == $plgfqdp_save_All_general_settings_db_in) {
		$plgfqdp_save_All_general_settings_db_in=array(
			'plgfqdp_use_Def'=>'true',
			'plgfqdp_shw_strt'=>'true',
			'plgfqdp_dynprc'=>'true',
			'colrhvrr'=>'#f1f1f1',
			'bgclrhvr'=>'#dddddd',
			'plgfqdp_shw_strt_txt'=>'Starting From: [min_price]',
			'before_content_plugify'=>'',
			'after_content_plugify'=>'',
			'plgfyqdp_table_position'=>'woocommerce_before_add_to_cart_form',
			'plgfqdp_tblhd_bg_color'=>'#5b6b7c',
			'plgfqdp_tblhd_lbl_color'=>'#ffffff',
			'plgfqdp_padding_t'=>'0',
			'plgfqdp_padding_r'=>'0',
			'plgfqdp_padding_b'=>'0',
			'plgfqdp_padding_l'=>'0',
			'plgfqdp_enable_shadow'=>'false',
			'plgfqdp_brdr_rdius'=>'5',
			'plgfqdp_bg_color'=>'#f1f1f1',
			'plgfqdp_lbl_txt_color'=>'#000000',

			'quantitycol'=>'true',
			'discountcol'=>'true',
			'peritemcol'=>'true',
			'plgfqdp_hvrrrclr'=>'#ffffff',
			'plgfqdp_bg_hvrr_clrr'=>'#110b40',
			'col1qtytext'=>'Quantity',
			'col1distext'=>'Discount',
			'col1pertext'=>'Per Item Price',

			'plgfqdp_show_offers_button'=>'true',
			'plgfqdp_offers_button_shadow'=>'true',
			'plgfqdp_offers_button_text'=>'Discount Offers',
			'plgfqdp_offers_button_text_color'=>'#ffffff',
			'plgfqdp_offers_button_bg_color'=>'#4485ca',
			'plugify_button_select_pages'=> array(),
			'plgfqdp_offers_button_shadow_color'=> '#dedede',
			'plgfqdp_offers_button_radius'=> '0',

			'plgfqdp_shw_dscnt_totl'=> 'false',
			'plgfqdp_shw_dscnt_totl_txt'=> 'Discounted Total: [discounted_total]',
			'plgfqdp_shw_amnt_svd'=> 'false',
			'plgfqdp_shw_amnt_svd_txt'=> 'Total amount saved: [amount_saved]',

			'plgfqdp_coupon_settings'=> 'plgfqdp_apply_both',
			'coupon_remove_message'=> 'Coupon code can not be applied as you already got a discount.',

		);
	}


	
	if (!isset($plgfqdp_save_All_general_settings_db_in['col1qtytext'])) {
		$plgfqdp_save_All_general_settings_db_in['col1qtytext']='Quantity';
	}
	if (!isset($plgfqdp_save_All_general_settings_db_in['col1distext'])) {
		$plgfqdp_save_All_general_settings_db_in['col1distext']='Discount';
	}
	if (!isset($plgfqdp_save_All_general_settings_db_in['col1pertext'])) {
		$plgfqdp_save_All_general_settings_db_in['col1pertext']='Per Item Price';
	}


	if (!isset($plgfqdp_save_All_general_settings_db_in['plgfqdp_shw_dscnt_totl'])) {
		$plgfqdp_save_All_general_settings_db_in['plgfqdp_shw_dscnt_totl']='false';
	}
	if (!isset($plgfqdp_save_All_general_settings_db_in['plgfqdp_shw_dscnt_totl_txt'])) {
		$plgfqdp_save_All_general_settings_db_in['plgfqdp_shw_dscnt_totl_txt']='Discounted Total: [discounted_total]';
	}
	if (!isset($plgfqdp_save_All_general_settings_db_in['plgfqdp_shw_amnt_svd'])) {
		$plgfqdp_save_All_general_settings_db_in['plgfqdp_shw_amnt_svd']='false';
	}
	if (!isset($plgfqdp_save_All_general_settings_db_in['plgfqdp_shw_amnt_svd_txt'])) {
		$plgfqdp_save_All_general_settings_db_in['plgfqdp_shw_amnt_svd_txt']='Total amount saved: [amount_saved]';
	}

	if (!isset($plgfqdp_save_All_general_settings_db_in['plgfqdp_coupon_settings'])) {
		$plgfqdp_save_All_general_settings_db_in['plgfqdp_coupon_settings']='plgfqdp_apply_both';
	}

	if (!isset($plgfqdp_save_All_general_settings_db_in['coupon_remove_message'])) {
		$plgfqdp_save_All_general_settings_db_in['coupon_remove_message']='Coupon code can not be applied as you already got a discount.';
	}

	if (!isset($plgfqdp_save_All_general_settings_db_in['plgfyqdp_dt_and_as_position'])) {
		$plgfqdp_save_All_general_settings_db_in['plgfyqdp_dt_and_as_position']='before_discount_table';
	}

	if (!isset($plgfqdp_save_All_general_settings_db_in['before_content_plugify'])) {
		$plgfqdp_save_All_general_settings_db_in['before_content_plugify']='';
	}

	if (!isset($plgfqdp_save_All_general_settings_db_in['after_content_plugify'])) {
		$plgfqdp_save_All_general_settings_db_in['after_content_plugify']='';
	}

	return $plgfqdp_save_All_general_settings_db_in;
}



add_filter( 'woocommerce_get_price_html', 'plgfyqty_change_html_price_for_flat_discount', 100, 2 );
function plgfyqty_change_html_price_for_flat_discount( $price, $product ) {
	if ('simple' != $product->get_type()) {
		return $price;
	}
	if (is_product()) {
		return $price;
	}
	
	$all_gnrl_plgfyqdp_set=get_option('plgfyqdp_save_All_general_settings_db_in');
	if ('' == $all_gnrl_plgfyqdp_set) {
		$all_gnrl_plgfyqdp_set=array(
			'plgfqdp_use_Def'=>'true',
			'plgfqdp_shw_strt'=>'true',
			'plgfqdp_dynprc'=>'true',
			'plgfqdp_shw_strt_txt'=>'Starting From: [min_price]',
			'before_content_plugify'=>'',
			'after_content_plugify'=>'',
			'plgfyqdp_table_position'=>'woocommerce_before_add_to_cart_form',
			'plgfqdp_tblhd_bg_color'=>'#f1f1f1',
			'plgfqdp_tblhd_lbl_color'=>'#000000',
			'plgfqdp_padding_t'=>'0',
			'plgfqdp_padding_r'=>'0',
			'plgfqdp_padding_b'=>'0',
			'plgfqdp_padding_l'=>'0',
			'plgfqdp_enable_shadow'=>'false',
			'plgfqdp_brdr_rdius'=>'5',
			'plgfqdp_bg_color'=>'#f1f1f1',
			'plgfqdp_lbl_txt_color'=>'#000000',

			'quantitycol'=>'true',
			'discountcol'=>'true',
			'peritemcol'=>'true',



		);
	}
	if (!isset($all_gnrl_plgfyqdp_set['plgfqdp_shw_strt']) && !isset($all_gnrl_plgfyqdp_set['plgfqdp_shw_strt_txt'])) {
		$all_gnrl_plgfyqdp_set['plgfqdp_shw_strt']='true';
		$all_gnrl_plgfyqdp_set['plgfqdp_shw_strt_txt']='Starting From: [min_price]';
	}
	$main_product_id=$product->get_id();
	$idsarray=array();
	$plgfyspi_all_rules=get_option('plgfyqdp_all_rules');

	if ( '' == $plgfyspi_all_rules ) {
		$plgfyspi_all_rules=array();
	}
	$pro=array();
	$cat=array();
	$who=array();
	foreach ($plgfyspi_all_rules as $key => $value) {
		if ('Category' == $value['applied_on'] ) {
			$cat[]=$value;
		} else if ('Products' == $value['applied_on']) {
			$pro[]=$value;
		} else {
			$who[]=$value;
		}
	}


	foreach ($cat as $key => $value) {
		$who[]=$value;
	}
	foreach ($pro as $key => $value) {
		$who[]=$value;
	}
	$idsarray=checkeligibleids_plgfy($main_product_id, $who);

	
	foreach ($idsarray as $key => $value) {
		
		$lowest=get_lowest_price($who[$value], $main_product_id);
		$text=$all_gnrl_plgfyqdp_set['plgfqdp_shw_strt_txt'];
		if ('true' == $all_gnrl_plgfyqdp_set['plgfqdp_shw_strt']) {


			if ($product->get_price()!= wc_get_price_including_tax($product) && 'incl' == get_option('woocommerce_tax_display_shop') ) {
				$howprcnt=0;
				$tax_amount=wc_get_price_including_tax($product) - $product->get_price();
				$howprcnt= ( $tax_amount/$product->get_price() ) * 100;
				$lowest=$lowest+( ( $howprcnt/100 ) * $lowest );


				return str_replace('[min_price]', wc_price($lowest), $text) . ' ' . get_option('woocommerce_price_display_suffix');


			} else {
				return str_replace('[min_price]', wc_price($lowest), $text);
			}

			
		}
		break;
	}


	return $price;
}

function get_lowest_price( $value, $id ) {
	
	$product=wc_get_product($id);
	$old_price=$product->get_price();
	$lowest_price=array();
	foreach ($value['start_rng'] as $key__1 => $value__1) {
		$new_price='';
		if ('fixed' == $value['discount_typ'][$key__1]) {
			$new_price=$old_price-$value['dis_price'][$key__1];
		} else if ('prcnt' == $value['discount_typ'][$key__1]) {
			$new_price=$old_price/100;
			$new_price=$new_price*$value['dis_price'][$key__1];
			$new_price=$old_price-$new_price;

		} else if ('ammend' == $value['discount_typ'][$key__1]) {
			$new_price=$value['dis_price'][$key__1];
		}
		if (0>$new_price) {
			$new_price=0;
		}
		array_push($lowest_price, $new_price);
		


		

	}

	
	return min($lowest_price); 
}
add_action( 'woocommerce_checkout_create_order_line_item', 'plgfyqdp_add_custom_data_to_order', 9999, 4 );

function plgfyqdp_add_custom_data_to_order( $item, $cart_item_key, $values, $order ) {

	

	$all_gnrl_plgfyqdp_set=plgfyspi_get_all_gnrl_settttings_onfrnt();
	

	if ( count( WC()->cart->get_applied_coupons() ) > 0 ) {
		if ('plgfqdp_aply_nly_cpn' == $all_gnrl_plgfyqdp_set['plgfqdp_coupon_settings']) {
			return;
		}
	}

	$product = $values['data'];
	if (isset($values['plugify_discount'])) {
		if ('valid' == $values['plugify_discount']) {
			if ( 'incl' == get_option('woocommerce_tax_display_cart') && 'yes' == get_option('woocommerce_calc_taxes')) {
				if (wc_get_price_including_tax($product) != $values['old_price_with_tax']) {
					
					$item->add_meta_data( __( 'Quantity Discount', 'plugify_qdp'), __('Applied', 'plugify_qdp'), true );
					$item->add_meta_data( __( 'Original Price (Per Item)', 'plugify_qdp'), wc_price($values['old_price_with_tax']), true );
				}
				
			} elseif ($values['old_price']!=$values['new_price']) {

				$item->add_meta_data( __( 'Quantity Discount', 'plugify_qdp'), __('Applied', 'plugify_qdp'), true );
				$item->add_meta_data( __( 'Original Price (Per Item)', 'plugify_qdp'), wc_price($values['old_price']), true );
			}

			

		}
	}
}

add_filter('woocommerce_order_item_get_formatted_meta_data', 'hide_quantity_discount_labels_from_email', 10, 2);
function hide_quantity_discount_labels_from_email( $formatted_meta, $item ) {

	$all_gnrl_plgfyqdp_set=get_option('plgfyqdp_save_All_general_settings_db_in');
	if ('' == $all_gnrl_plgfyqdp_set) {
		$all_gnrl_plgfyqdp_set=array(
			'hide_qty_data_from_email'=> 'false',
		);
	}

	if (!isset($all_gnrl_plgfyqdp_set['hide_qty_data_from_email'])) {
		$all_gnrl_plgfyqdp_set['hide_qty_data_from_email']='false';
	}
	if ( 'true' == $all_gnrl_plgfyqdp_set['hide_qty_data_from_email']) {
		if ( is_admin() || is_wc_endpoint_url() ) {
			return $formatted_meta;
		}
		$removed_email_key_qty_dis =  __( 'Quantity Discount', 'plugify_qdp');
		$removed_email_key_orinal_price =  __( 'Original Price (Per Item)', 'plugify_qdp');
		foreach ($formatted_meta as $key => $meta) {


			if (in_array($meta->key, array($removed_email_key_qty_dis)) || in_array($meta->key, array($removed_email_key_orinal_price))) {
				unset($formatted_meta[$key]);
			}
		}
	}
	

	return $formatted_meta;
}


function plugify_qdp_fw_enqueue_my_plugin_assets123() {

	$all_gnrl_plgfyqdp_set=plgfyspi_get_all_gnrl_settttings_onfrnt();

	$settings_array = array();
	$settings_array['plgfqdp_coupon_settings'] =  $all_gnrl_plgfyqdp_set['plgfqdp_coupon_settings'];
	// $settings_array['txt_for_view_details'] =  $all_gnrl_plgfyqdp_set['txt_for_view_details'];

	wp_enqueue_script('plgfyqdp_blocks_compatibilty', plugins_url('Assets/blocks_compatibility.js', __FILE__), array('wc-blocks-checkout'), '1.1', true);
	wp_localize_script('plgfyqdp_blocks_compatibilty', 'general_settings', $settings_array);
}

add_action('wp_enqueue_scripts', 'plugify_qdp_fw_enqueue_my_plugin_assets123');
