<?php

add_action( 'woocommerce_cart_calculate_fees', 'plugify_add_cart_fee' );

add_action('wp_footer', 'plugify_show_button_on_bottom');






function plugify_show_button_on_bottom() {
	?>
	<script>
		jQuery(document).ready(function(){

			jQuery('body').on('click', '#plugify_offer_button', function(){

				jQuery('#plugify_offers_model').addClass('active_modal');
				jQuery('#plugify_offers_model').find('.h1class').css('display', 'block');
				jQuery('#plugify_offers_model').find('.plugify_close').css('display', 'block');
			});
			jQuery('body').on('click', '.plugify_close', function(){
				jQuery(this).parent().parent().parent().parent().removeClass('active_modal');
				jQuery(this).parent().parent().parent().parent().find('.h1class').css('display', 'none');
				jQuery(this).parent().parent().parent().parent().find('.plugify_close').css('display', 'none');
			});
			jQuery(document).on('click', function (event) {
				if (!jQuery(event.target).closest('#plugify_offer_button').length && !jQuery(event.target).closest('.plugify_model-content').length) {
					if (jQuery('.active_modal').length >0) {
						jQuery('.plugify_model').each(function(){
							jQuery(this).removeClass('active_modal');

						});
					}
				}
			});


		});
	</script>
	<?php
	$plgfy_cd_all_data=get_option('plgfyqdp_save_All_general_settings_db_in');


	if ('' == $plgfy_cd_all_data) {
		$plgfy_cd_all_data=array(
			'plgfqdp_use_Def'=>'true',
			'plgfqdp_dynprc'=>'true',
			'plgfqdp_shw_strt'=>'true',
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
			'plgfqdp_offers_button_text_size'=>'13',
			'plgfqdp_offers_button_text_weight'=>'400',
			'plgfqdp_offers_button_bg_color'=>'#4485ca',
			'plugify_button_select_pages'=> array(),
			'plgfqdp_offers_button_shadow_color'=> '#dedede',
			'plgfqdp_offers_button_radius'=> '0',

			'plgfqdp_offers_popup_bg_color'=> '#FEFEFE',
			'plgfqdp_offers_popup_txt_color'=> '#101010',
			'plgfqdp_offers_popup_hd_text'=> 'Discount Offers',
			'plgfqdp_offers_popup_hd_text_color'=> '#262626',
			'plgfqdp_offers_popup_hd_bg_clr'=> '#ededed',

			'plgfqdp_apply_multiple_discount'=> 'false',
			'plugify_discount_tobe_applied'=> 'min_in_rule',

		);
	}


	if (!isset($plgfy_cd_all_data['plgfqdp_show_offers_button'])) {
		$plgfy_cd_all_data['plgfqdp_show_offers_button']='true';
	}
	if (!isset($plgfy_cd_all_data['plgfqdp_offers_button_text'])) {
		$plgfy_cd_all_data['plgfqdp_offers_button_text']='Discount Offers';
	}
	if (!isset($plgfy_cd_all_data['plgfqdp_offers_button_text_color'])) {
		$plgfy_cd_all_data['plgfqdp_offers_button_text_color']='#ffffff';
	}
	if (!isset($plgfy_cd_all_data['plgfqdp_offers_button_bg_color'])) {
		$plgfy_cd_all_data['plgfqdp_offers_button_bg_color']='#4485ca';
	}
	if (!isset($plgfy_cd_all_data['plugify_button_select_pages'])) {
		$plgfy_cd_all_data['plugify_button_select_pages']=array();
	}
	if (!isset($plgfy_cd_all_data['plgfqdp_offers_button_shadow_color'])) {
		$plgfy_cd_all_data['plgfqdp_offers_button_shadow_color']='#dedede';
	}
	if (!isset($plgfy_cd_all_data['plgfqdp_offers_button_radius'])) {
		$plgfy_cd_all_data['plgfqdp_offers_button_radius']='0';
	}

	if (!isset($plgfy_cd_all_data['plgfqdp_offers_button_text_size'])) {
		$plgfy_cd_all_data['plgfqdp_offers_button_text_size']='13';
	}
	if (!isset($plgfy_cd_all_data['plgfqdp_offers_button_text_weight'])) {
		$plgfy_cd_all_data['plgfqdp_offers_button_text_weight']='400';
	}


	if (!isset($plgfy_cd_all_data['plgfqdp_apply_multiple_discount'])) {
		$plgfy_cd_all_data['plgfqdp_apply_multiple_discount']='false';
	}
	if (!isset($plgfy_cd_all_data['plugify_discount_tobe_applied'])) {
		$plgfy_cd_all_data['plugify_discount_tobe_applied']='min_in_rule';
	}


	if (!isset($plgfy_cd_all_data['plgfqdp_offers_popup_bg_color'])) {
		$plgfy_cd_all_data['plgfqdp_offers_popup_bg_color']='#FEFEFE';
	}
	if (!isset($plgfy_cd_all_data['plgfqdp_offers_popup_hd_text'])) {
		$plgfy_cd_all_data['plgfqdp_offers_popup_hd_text']='Discount Offers';
	}
	if (!isset($plgfy_cd_all_data['plgfqdp_offers_popup_hd_text_color'])) {
		$plgfy_cd_all_data['plgfqdp_offers_popup_hd_text_color']='#262626';
	}

	if (!isset($plgfy_cd_all_data['plgfqdp_offers_popup_hd_bg_clr'])) {
		$plgfy_cd_all_data['plgfqdp_offers_popup_hd_bg_clr']='#ededed';
	}
	if (!isset($plgfy_cd_all_data['plgfqdp_offers_popup_txt_color'])) {
		$plgfy_cd_all_data['plgfqdp_offers_popup_txt_color']='#101010';
	}


	if (isset($plgfy_cd_all_data['plgfqdp_show_offers_button']) && 'true' == $plgfy_cd_all_data['plgfqdp_show_offers_button']) {

		if (is_shop()) {
			$page_id = wc_get_page_id('shop');
		} else {
			global $wp_query;
			$post_obj = $wp_query->get_queried_object();
			if (is_object($post_obj)) {
				$page_id = $post_obj->ID;
			}
		}
		$button_text = '';
		if ('' != $plgfy_cd_all_data['plgfqdp_offers_button_text']) {
			$button_text = $plgfy_cd_all_data['plgfqdp_offers_button_text'];
		} else {
			$button_text = 'Discount Offers';
		}

		$plgfyqdp_all_rules=get_option('plgfyqdp_all_cart_rules');
		$active_rule_count = 0;
		if (is_array($plgfyqdp_all_rules)) {
			foreach ($plgfyqdp_all_rules as $key => $value) {
				if ( 'true' == $value['plgfydc_activate_rule'] ) {
					++$active_rule_count;
				}
			}
		}

		if ( 0 == $active_rule_count) {
			return;
		}



		if (isset($plgfy_cd_all_data['plugify_button_select_pages']) && 0 != count($plgfy_cd_all_data['plugify_button_select_pages'])) {
			if (in_array($page_id, $plgfy_cd_all_data['plugify_button_select_pages'])) {
				?>
				<div style="width:100%;"><button id="plugify_offer_button"><?php echo esc_html($button_text); ?></button></div>
				<?php
			}
		} else {
			?>
			<div style="width:100%;"><button id="plugify_offer_button"><?php echo esc_html($button_text); ?></button></div>
			<?php
		}
		?>


		<div class="plugify_model main_detailed_divss"  id="plugify_offers_model">
			<div class="plugify_model-dialog">
				<div class="plugify_model-content myclass" style="display:block !important;">
					<div class="plugify_model_heading"> 
						<h4 style="margin:unset !important;padding: unset !important;width: 100%;text-align: center; color:<?php echo esc_attr($plgfy_cd_all_data['plgfqdp_offers_popup_hd_text_color']); ?> !important;" > <strong> <?php echo esc_html($plgfy_cd_all_data['plgfqdp_offers_popup_hd_text']); ?> </strong> </h4>
						<span class="plugify_close">&times;</span>
					</div>
					
					<div style="width:100%;max-height: 550px;overflow: auto; padding: 20px;">
						<?php echo do_shortcode('[show_cart_discount_conditions]'); ?>
					</div>


				</div>
			</div>
		</div>


		<style type="text/css">
			#plugify_offer_button {
				background-color: <?php echo esc_attr($plgfy_cd_all_data['plgfqdp_offers_button_bg_color']); ?>;
				color: <?php echo esc_attr($plgfy_cd_all_data['plgfqdp_offers_button_text_color']); ?>;
				border-radius: <?php echo esc_attr($plgfy_cd_all_data['plgfqdp_offers_button_radius']); ?>px;
				font-size: <?php echo esc_attr($plgfy_cd_all_data['plgfqdp_offers_button_text_size']); ?>px;
				font-weight: <?php echo esc_attr($plgfy_cd_all_data['plgfqdp_offers_button_text_weight']); ?>;
				padding: 15px 32px;
				text-align: center;
				position: fixed;
				bottom: 10px !important;
				left: 10px !important;
				border: unset;
				z-index: 9999999;
				cursor: pointer;

			}

			.plugify_model_heading {
				display: flex;
				padding: 16px;
				color: <?php echo esc_attr($plgfy_cd_all_data['plgfqdp_offers_popup_hd_text_color']); ?> !important;
				background-color: <?php echo esc_attr($plgfy_cd_all_data['plgfqdp_offers_popup_hd_bg_clr']); ?> !important;
			}


			<?php if ('true' == $plgfy_cd_all_data['plgfqdp_offers_button_shadow']) { ?>

				#plugify_offer_button {
					box-shadow: 0 8px 16px 0 <?php echo esc_attr($plgfy_cd_all_data['plgfqdp_offers_button_shadow_color']); ?>, 0 6px 20px 0 <?php echo esc_attr($plgfy_cd_all_data['plgfqdp_offers_button_shadow_color']); ?>;
				}

			<?php } ?>


			.plugify_model-dialog{
				max-width: 90% !important;
				width: 90% !important;
				position: absolute !important;
				left: 50% !important;
				top: 52% !important;
				transform: translate(-50%, -50%) !important;
			}




			.active_modal{
				display: block !important;
				opacity: 1;
			}
			.plugify_model {
				display: none; 
				position: fixed; 
				z-index: 9999999999;
				padding-top: 110px; 
				left: 0;
				top: 0;
				width: 100%;
				height: 100%; 

				background-color: rgb(0,0,0); 
				background-color: rgba(0,0,0,0.4);
			}


			.plugify_model-content {
				background-color: <?php echo esc_attr($plgfy_cd_all_data['plgfqdp_offers_popup_bg_color']); ?> !important;
				color: <?php echo esc_attr($plgfy_cd_all_data['plgfqdp_offers_popup_txt_color']); ?> !important;
				margin: auto;
				/*padding: 20px !important;*/
				border: 1px solid #888;
				width: 60%;
				border-radius: 5px;
			}

			@media only screen and (max-width: 950px) {
				.plugify_model-content {
					width: 90%;
				}
			}

			@media only screen and (max-width: 767px) {
				#plugify_offer_button {
					margin-bottom: 60px;
				}
			}

			/*.plugify_cart_parent h1,.plugify_cart_parent h2,.plugify_cart_parent h3,.plugify_cart_parent h4,.plugify_cart_parent h5,.plugify_cart_parent h6 {*/

				.plugify_cart_parent * :not(a){
					color: <?php echo esc_attr($plgfy_cd_all_data['plgfqdp_offers_popup_txt_color']); ?> !important;
				}

				.plugify_cart_parent a{
					/*color: unset !important;*/
				}

			.plugify_close {
				/*color: #aaaaaa;*/
				float: right;
				font-size: 28px;
				font-weight: bold;
				opacity: 1 !important;
			}

			.plugify_close:hover,
			.plugify_close:focus {
				/*color: #000;*/
				text-decoration: none;
				cursor: pointer;
			}


		</style>

		<?php

	}


}



function numberToRomanRepresentation( $number ) {
	$map = array( 'M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'xl' => 40, 'x' => 10, 'ix' => 9, 'v' => 5, 'iv' => 4, 'i' => 1 );
	$returnValue = '';
	while ($number > 0) {
		foreach ($map as $roman => $int) {
			if ($number >= $int) {
				$number -= $int;
				$returnValue .= $roman;
				break;
			}
		}
	}
	return $returnValue;
}




add_shortcode('show_cart_discount_conditions', 'plugify_show_cart_discount_conditions');


function plugify_show_cart_discount_conditions() {
	ob_start();

	$plgfyqdp_all_rules=get_option('plgfyqdp_all_cart_rules');


	


	$plgfy_cd_all_data=get_option('plgfyqdp_save_All_general_settings_db_in');


	$plgfy_cd_all_data=get_option('plgfyqdp_save_All_general_settings_db_in');

	if (!isset($plgfy_cd_all_data['plgfqdp_offers_popup_content'])) {
		$editor_content = '<h4><strong>You can avail undermentioned discount amounts</strong></h4>
		[quantity_table]<br><strong>Conditions to be met: </strong><br>[conditions_table]';
		$plgfy_cd_all_data['plgfqdp_offers_popup_content']= $editor_content;
	}


	


	foreach ($plgfyqdp_all_rules as $key => $value) {

		if ( 'true' == $value['plgfydc_activate_rule'] ) {



			$content_all = $plgfy_cd_all_data['plgfqdp_offers_popup_content'];
			// $content_all=$value['plugify_custom_editor'];
			if ('' != $content_all ) {
				?>
				<div class="plugify_cart_parent" style="border: 1px solid #ddd;border-radius: 5px;padding: 12px;width: 100%;overflow: auto;margin:1% 0%;">
					<?php
					$cond_html = '';

					foreach ($value['cart_if_value_of'] as $cond_key => $cond_value) {
						if (!empty($cond_value)) {
							$cond_html .= '<br>';
							$cond_html .=returnstrings($cond_key+1, $cond_value, $value['cart_checking_condition'][$cond_key], $value['cart_checking_value'][$cond_key]);
						}
					}

					
					$qty_html = '';

					if ('true' == $value['plgfy_apl_al_qntits']) {

						$check_disc = '';
						if ( 'prcnt' == $value['discount_typ'][0]) {
							$check_disc = $value['dis_price'][0] . '%';
						} else if ( 'fixed' == $value['discount_typ'][0]) {
							$check_disc = '-' . wc_price($value['dis_price'][0]);
						}

						$qty_html .= __('Get ', 'plugify_qdp') . $check_disc . __(' discount', 'plugify_qdp');
						$qty_html .= '<br>';

					} else {
						foreach ($value['start_rng'] as $range_key => $range_value) {
							$check_disc = '';
							if ( 'prcnt' == $value['discount_typ'][$range_key]) {
								$check_disc = $value['dis_price'][$range_key] . '%';
							} else if ( 'fixed' == $value['discount_typ'][$range_key]) {
								$check_disc = '-' . wc_price($value['dis_price'][$range_key]);
							}
							$end_range = $value['end_rng'][$range_key];
							if ('1' == $range_value && '999999' == $end_range) {
								$range_message = '';
							} else {
								$range_message = '';
								if ( '999999' == $end_range) {
									$range_message =  $range_value . '+';
								} else {
									$range_message = __('between ', 'plugify_qdp') . $range_value . '-' . $end_range;
								}

								$qty_html .= '<br>';
								$qty_html .= numberToRomanRepresentation($range_key + 1) . __('. If cart item quantity range is ', 'plugify_qdp') . $range_message . __(', get ', 'plugify_qdp') . $check_disc . __(' discount.', 'plugify_qdp');
							}
						}
						$qty_html .= '<br>';
					}

					if (empty(trim($cond_html))) {
						$content_all=str_replace('Conditions to be met:', '', $content_all);
					}
					$cond_html .= '<br>';
					$content_all=str_replace('[conditions_table]', $cond_html, $content_all);
					$content_all=str_replace('[quantity_table]', $qty_html, $content_all);
					$content_all=str_replace('../', get_site_url() . '/' , $content_all);
					// phpcs:ignore WordPress.Security.ValidatedSanitizedInput
					// echo filter_var(stripslashes($content_all));

					do_action('plugify_allll_contenttt', $content_all);

					?>
				</div>
				<?php
			}

		}
	}



	$contents=ob_get_contents();
	ob_end_clean();
	return $contents;
}



	
add_action('plugify_allll_contenttt', 'plugify_allll_contenttt');

function plugify_allll_contenttt ( $content_all ) {
	echo filter_var($content_all);
}








function returnstrings( $key, $if_val_of, $condition, $conditional_value ) {
	
	$string='';

	if (empty($if_val_of)) {
		return $string;
	}

	if ('coupon' == $if_val_of) {
		$string .= numberToRomanRepresentation($key) . __('. If Coupon Code ', 'plugify_qdp');
	} else if ('sub_total' == $if_val_of) {
		$string .= numberToRomanRepresentation($key) . __('. If Cart Subtotal ', 'plugify_qdp');
	} else if ('user_role' == $if_val_of) {
		$string .= numberToRomanRepresentation($key) . __('. If User Role ', 'plugify_qdp');
	} else if ('products_in_cart' == $if_val_of) {
		$string .= numberToRomanRepresentation($key) . __('. If Product in Cart ', 'plugify_qdp');
	} else if ('categories_in_cart' == $if_val_of) {
		$string .= numberToRomanRepresentation($key) . __('. If Category in Cart ', 'plugify_qdp');
	}


	if ( '==' == $condition) {
		$string .= __('equal to ', 'plugify_qdp');
	} else if ( '!=' == $condition) {
		$string .= __('not equal to ', 'plugify_qdp');
	} else if ( '>' == $condition) {
		$string .= __('greater than ', 'plugify_qdp');
	} else if ( '<' == $condition) {
		$string .= __('smaller than ', 'plugify_qdp');
	}

	if ('products_in_cart' == $if_val_of) {
		$string .= '<a href="' . filter_var(get_permalink($conditional_value)) . '" >' . get_the_title($conditional_value) . '</a>';
	} else if ('categories_in_cart' == $if_val_of) {
		$string .= '<a href="' . filter_var(get_category_link($conditional_value)) . '" >' . get_the_category_by_ID( $conditional_value ) . '</a>';
	} else if ('user_role' == $if_val_of) {

		foreach ($conditional_value as $condi_key => $condi_value) {
			if ( 0 != $condi_key ) {
				$string .= __(' or ', 'plugify_qdp');
			}
			$string .= ucfirst($condi_value);
		}
	} else {
		$string .= $conditional_value;
	}

	return $string;
}
function plugify_add_cart_fee( $cart ) {

	$plgfy_cd_all_data=get_option('plgfyqdp_save_All_general_settings_db_in');

	if (!isset($plgfy_cd_all_data['plgfqdp_apply_multiple_discount'])) {
		$plgfy_cd_all_data['plgfqdp_apply_multiple_discount']='false';
	}
	if (!isset($plgfy_cd_all_data['plugify_discount_tobe_applied'])) {
		$plgfy_cd_all_data['plugify_discount_tobe_applied']='min_in_rule';
	}




	$plgfyqdp_all_rules=get_option('plgfyqdp_all_cart_rules');

	$cart_discount_array = array();


	$subtotal_excl_tax = 0;

	foreach ( $cart->get_cart() as $cart_item ) {
		$subtotal_excl_tax += $cart_item['line_subtotal'];
	}

	$cart_subtotal = $subtotal_excl_tax;

	if (is_array($plgfyqdp_all_rules)) {
		foreach ($plgfyqdp_all_rules as $key => $value) {

			if ( 'true' == $value['plgfydc_activate_rule'] ) {

				$is_cond_true = true;

				foreach ($value['cart_if_value_of'] as $cond_key => $cond_value) {

					if ('coupon' == $cond_value) {

						if ( !in_array($value['cart_checking_value'][$cond_key], WC()->cart->get_applied_coupons())) {
							if ('==' == $value['cart_checking_condition'][$cond_key]) {
								$is_cond_true = false;
							}
						} else if ('!=' == $value['cart_checking_condition'][$cond_key]) {
							$is_cond_true = false;
						}




					} else if ('sub_total' == $cond_value) {

						$is_true = false;

						if ('==' == $value['cart_checking_condition'][$cond_key]) {

							if ( $cart_subtotal == $value['cart_checking_value'][$cond_key] ) {
								$is_true = true;
							}

						} else if ('!=' == $value['cart_checking_condition'][$cond_key]) {

							if ( $cart_subtotal != $value['cart_checking_value'][$cond_key] ) {
								$is_true = true;
							}

						} else if ('<' == $value['cart_checking_condition'][$cond_key]) {

							if ( $cart_subtotal < $value['cart_checking_value'][$cond_key] ) {
								$is_true = true;
							}

						} else if ('>' == $value['cart_checking_condition'][$cond_key]) {

							if ( $cart_subtotal > $value['cart_checking_value'][$cond_key] ) {
								$is_true = true;
							}

						}

						if ( false != $is_cond_true ) {
							$is_cond_true = $is_true;
						}

					} else if ('user_role' == $cond_value) {

						$user = wp_get_current_user();
						$is_user_true = false;

						$user_rolesss = (array) $user->roles ;

						if (!is_user_logged_in()) {
							$user_rolesss[] = 'guest';
						}

						foreach ($value['cart_checking_value'][$cond_key] as $user_key => $user_value) {

							if ( in_array( $user_value, $user_rolesss ) ) {

								if ('==' == $value['cart_checking_condition'][$cond_key]) {
									$is_user_true = true;
								}
							} elseif ('!=' == $value['cart_checking_condition'][$cond_key]) {
								$is_user_true = true;
							}



						}

						if (!$is_user_true) {
							$is_cond_true = false;
						}

					} else if ('categories_in_cart' == $cond_value) {

						$has_category = false;

						foreach ( WC()->cart->get_cart() as $cart_item ) {

							if ( has_term( $value['cart_checking_value'][$cond_key], 'product_cat', $cart_item['product_id'] ) ) {
								$has_category = true;
								break;
							}
						}


						if (!$has_category) {
							if ('==' == $value['cart_checking_condition'][$cond_key]) {
								$is_cond_true = false;
							}
						} elseif ('!=' == $value['cart_checking_condition'][$cond_key]) {
							$is_cond_true = false;
						}



					} else if ('products_in_cart' == $cond_value) {


						$has_prod = false;

						foreach ( WC()->cart->get_cart() as $cart_item ) {

							if ( $value['cart_checking_value'][$cond_key] == $cart_item['product_id'] ) {
								$has_prod = true;
								break;
							}
						}

						if (!$has_prod) {
							if ('==' == $value['cart_checking_condition'][$cond_key]) {
								$is_cond_true = false;
							}
						} elseif ('!=' == $value['cart_checking_condition'][$cond_key]) {
							$is_cond_true = false;
						}




					}

				}



				$is_prod_discount_applied = true;

				if ( 'false' == $value['plgfydc_work_with_quant'] ) {

					foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {

						if (isset($cart_item['plugify_discount']) && 'valid' == $cart_item['plugify_discount']) {
							$is_prod_discount_applied = false;
						}

					}

				}


				if ($is_cond_true && $is_prod_discount_applied) {

					$cart_item_count = WC()->cart->get_cart_contents_count();

					foreach ($value['start_rng'] as $rules_key => $rules_value) {


						if ('true' == $value['plgfy_apl_al_qntits']) {
							$offer_discount = 0;
							if ('fixed' == $value['discount_typ'][0] ) {

								$offer_discount = $value['dis_price'][0];

							} else if ('prcnt' == $value['discount_typ'][0] ) {

								$old_price = $cart_subtotal;
								$new_price=$old_price/100;
								$offer_discount=$new_price*$value['dis_price'][0];

							}

							if ( 0 < $offer_discount ) {

								$plugify_cart_dis_text=$value['plugify_cart_discount_text'];
								if ('' == $plugify_cart_dis_text) {
									$plugify_cart_dis_text='Cart Discount';
								}


								// WC()->cart->add_fee( $plugify_cart_dis_text, -$offer_discount);
								// WC()->cart->set_session();

								$cart_text_array = array();
								$cart_text_array['text'] = $plugify_cart_dis_text;
								$cart_text_array['discount'] = $offer_discount;
								$cart_discount_array[] = $cart_text_array;
							}

							break;
						}



						if ( $rules_value <= $cart_item_count && $cart_item_count <= $value['end_rng'][$rules_key] ) {
							$offer_discount = 0;
							if ('fixed' == $value['discount_typ'][$rules_key] ) {

								$offer_discount = $value['dis_price'][$rules_key];

							} else if ('prcnt' == $value['discount_typ'][$rules_key] ) {

								$old_price = $cart_subtotal;
								$new_price=$old_price/100;
								$offer_discount=$new_price*$value['dis_price'][$rules_key];

							}

							if ( 0 < $offer_discount ) {

								$plugify_cart_dis_text=$value['plugify_cart_discount_text'];
								if ('' == $plugify_cart_dis_text) {
									$plugify_cart_dis_text='Cart Discount';
								}


								// WC()->cart->add_fee( $plugify_cart_dis_text, -$offer_discount);
								// WC()->cart->set_session();
								$cart_text_array = array();
								$cart_text_array['text'] = $plugify_cart_dis_text;
								$cart_text_array['discount'] = $offer_discount;
								$cart_discount_array[] = $cart_text_array;

							}

							break;
						}
					}
				}
			}
		}
	}

	$keys = array_column($cart_discount_array, 'discount');
	
	if ( 'false' == $plgfy_cd_all_data['plgfqdp_apply_multiple_discount']) {
		if ( 'min_in_rule' == $plgfy_cd_all_data['plugify_discount_tobe_applied'] ) {
			array_multisort($keys, SORT_ASC, $cart_discount_array);
		} else {
			array_multisort($keys, SORT_DESC, $cart_discount_array);
		}
	}

	foreach ($cart_discount_array as $key => $value) {
		WC()->cart->add_fee( $value['text'], -$value['discount']);
		WC()->cart->set_session();
		if ( 'false' == $plgfy_cd_all_data['plgfqdp_apply_multiple_discount']) {
			break;
		}


	}
}
