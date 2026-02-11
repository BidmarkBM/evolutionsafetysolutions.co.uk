<?php
/**
 * Plugin Name: Quantity Discounts & Pricing For Woocommerce
 * Plugin URI: https://woocommerce.com/products/quantity-discounts-pricing-for-woocommerce/
 * Author: Plugify
 * Author URI: https://woocommerce.com/vendor/plugify/
 * Version: 5.0.3
 * Developed By: Plugify Team
 * Description: Enable quantity-based discounts and prices on products and categories for specific user roles.
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Requires at least: 4.4
 * Tested up to: 6.7
 * Text Domain: plugify_qdp
 * WC requires at least: 3.0
 * WC tested up to: 9.*.*
 * Woo: 8232229:821836f9b59cfc0372b13a4492f24e01

 */
if ( ! defined( 'ABSPATH' ) ) { 
	exit; // Exit if accessed directly
}
/**
 * Check if WooCommerce is active
 * if wooCommerce is not active Quantity Discounts & Pricing For Woocommerce will not work.
 **/



// error_reporting(0);
class PlugfyQDP_Main_Class_Alpha {
	public function __construct() {

		if (!is_multisite()) {
			if ( !in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
				add_action( 'admin_notices', array( $this, 'qdp_admin_notice' ) );
			}
		}

		add_action('wp_loaded', array( $this, 'plugify_qdp_load_translations'));
		register_activation_hook( __FILE__, array( $this, 'plgfyqdp_activation_plugin_for_gnrl_Set'));
		if (is_admin()) {
			include 'Admin/plgfyqdp_main_admin.php';
		} else {
			include 'Front/frontuu.php';
			include 'Front/plgfyqdp_cart_rule_front.php';
		}
		add_action('wp_ajax_plgfyqdp_save_gnrl_settings', array( $this, 'plgfyqdp_save_gnrl_settings'));
		add_action('wp_ajax_plgfyqdp_delete_rule_data_db', array( $this, 'plgfyqdp_delete_rule_data_db'));
		add_action('wp_ajax_plgfyqdp_delete_cart_rule_data_db', array( $this, 'plgfyqdp_delete_cart_rule_data_db'));
		add_action('wp_ajax_plgfyqdp_edit_rule_in_db', array( $this, 'plgfyqdp_edit_rule_in_db'));
		add_action('wp_ajax_plgfyqdp_edit_cart_rule_in_db', array( $this, 'plgfyqdp_edit_cart_rule_in_db'));
		add_action('wp_ajax_get_all_qtyrules_from_db', array( $this, 'plgfyqdp_get_all_qtyrules_from_db'));
		add_action('wp_ajax_get_all_cart_rules_from_db', array( $this, 'plgfyqdp_get_all_cart_rules_from_db'));
		add_action('wp_ajax_plgfyqdp_add_rule_in_db', array( $this, 'plgfyqdp_add_rule_in_db'));
		add_action('wp_ajax_plgfyqdp_add_cart_rule_in_db', array( $this, 'plgfyqdp_add_cart_rule_in_db'));
		add_action('wp_ajax_plgfyqdp_get_cart_edit_qtyrules', array( $this, 'plgfyqdp_get_cart_edit_qtyrules'));
		add_action('wp_ajax_plgfyqdp_get_myModaledit_qtyrules', array( $this, 'plgfyqdp_get_myModaledit_qtyrules'));
		// add_action('wp_ajax_plgfyqdp_get_price_lbl_product_page', array( $this, 'plgfyqdp_get_price_lbl_product_page'));
		// add_action('wp_ajax_nopriv_plgfyqdp_get_price_lbl_product_page', array( $this, 'plgfyqdp_get_price_lbl_product_page'));

		add_action( 'before_woocommerce_init', array($this, 'plugify_qdp_hpos_compatibility'));
	}

	public function qdp_admin_notice() {
		deactivate_plugins(__FILE__);
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}
		?>
		<div id="message" class="error">
			<p>Quantity Discounts & Pricing For Woocommerce requires <a href="https://wordpress.org/extend/plugins/woocommerce/">WooCommerce</a> plugin to be installed and active!</p> 
		</div>
		<?php
	}

	public function plugify_qdp_hpos_compatibility() {
		if ( class_exists( \Automattic\WooCommerce\Utilities\FeaturesUtil::class ) ) {
			\Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility( 'custom_order_tables', __FILE__, true );
		}

		if ( class_exists( '\Automattic\WooCommerce\Utilities\FeaturesUtil' ) ) {
			\Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility( 'cart_checkout_blocks', __FILE__, true );
		}

	}
	public function plugify_qdp_load_translations() {
		if ( function_exists( 'plugify_qdp_load_translations' ) ) {
			plugify_qdp_load_translations( 'plugify_qdp', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
		}
		
	}

	public function plgfyqdp_delete_cart_rule_data_db() {
		$plgfyqdp_all_cart_rules=get_option('plgfyqdp_all_cart_rules');
		if ( '' == $plgfyqdp_all_cart_rules ) {
			$plgfyqdp_all_cart_rules=array();
		}
		if (isset($_REQUEST['index']) ) {
			$index = sanitize_text_field($_REQUEST['index']);
		}
		unset($plgfyqdp_all_cart_rules[$index]);
		$plgfyqdp_all_cart_rules=array_values($plgfyqdp_all_cart_rules);
		
		update_option('plgfyqdp_all_cart_rules', $plgfyqdp_all_cart_rules);
		wp_die();
	}


	// public function plgfyqdp_get_price_lbl_product_page() {
	// 	$plgfyqdp_all_rules=get_option('plgfyqdp_all_rules');
	// 	if (isset($_REQUEST['keyindex'])) {
	// 		$index=sanitize_text_field($_REQUEST['keyindex']);
	// 	}
		
	// 	if (isset($_REQUEST['qty'])) {
	// 		$qty=sanitize_text_field($_REQUEST['qty']);
	// 	}
	// 	if (isset($_REQUEST['old_price'])) {
	// 		$old_price=sanitize_text_field($_REQUEST['old_price']);
	// 	}

	// 	if (isset($_REQUEST['type'])) {
	// 		$type=sanitize_text_field($_REQUEST['type']);
	// 	}
	// 	$value=$plgfyqdp_all_rules[$index];
	// 	if ('variable' == $type) {
	// 		$old_price=$old_price;
	// 		$prodd=wc_get_product($old_price);
	// 		$old_price=$prodd->get_price();
	// 		$old_price11=$prodd->get_price();
	// 	} else {
	// 		$old_price=$old_price;
	// 		$old_price11=$old_price;
	// 	}
		
	// 	$new_price='';

	// 	if ('ranges' == $value['tabletyp']) {

	// 		foreach ($value['start_rng'] as $key__1 => $value__1) {

	// 			if ($value__1 <= $qty && $qty <= $value['end_rng'][$key__1]) {
	// 				$new_price='';
	// 				if ('fixed' == $value['discount_typ'][$key__1]) {
	// 					$new_price=$old_price-$value['dis_price'][$key__1];
	// 				} else if ('prcnt' == $value['discount_typ'][$key__1]) {
	// 					$new_price=$old_price/100;
	// 					$new_price=$new_price*$value['dis_price'][$key__1];
	// 					$new_price=$old_price-$new_price;

	// 				} else if ('ammend' == $value['discount_typ'][$key__1]) {
	// 					$new_price=$value['dis_price'][$key__1];
	// 				}
	// 				if (0>$new_price) {
	// 					$new_price=0;
	// 				}

	// 				echo filter_var('<strike>' . wc_price($old_price) . '</strike> ' . wc_price($new_price)); 
	// 				wp_die();

	// 			} else {

	// 				$new_price=$old_price;

	// 				if (0>$new_price) {
	// 					$new_price=0;
	// 				}
	// 			}

	// 		}
	// 		echo filter_var(wc_price($new_price)); 
	// 		wp_die();
	// 	} else {
	// 		foreach ($value['start_rng'] as $key__1 => $value__1) {
	// 			if ('==' == $value['end_rng'][$key__1]) {
	// 				if ($value__1 == $qty) {
	// 					$new_price='';
	// 					if ('fixed' == $value['discount_typ'][$key__1]) {
	// 						$new_price=$old_price-$value['dis_price'][$key__1];
	// 					} else if ('prcnt' == $value['discount_typ'][$key__1]) {
	// 						$new_price=$old_price/100;
	// 						$new_price=$new_price*$value['dis_price'][$key__1];
	// 						$new_price=$old_price-$new_price;

	// 					} else if ('ammend' == $value['discount_typ'][$key__1]) {
	// 						$new_price=$value['dis_price'][$key__1];
	// 					}
	// 					if (0>$new_price) {
	// 						$new_price=0;
	// 					}
	// 					$old_price=$new_price;

						
	// 				}


	// 			} elseif ($value__1 <= $qty) {
	// 				$new_price='';
	// 				if ('fixed' == $value['discount_typ'][$key__1]) {
	// 					$new_price=$old_price-$value['dis_price'][$key__1];
	// 				} else if ('prcnt' == $value['discount_typ'][$key__1]) {
	// 					$new_price=$old_price/100;
	// 					$new_price=$new_price*$value['dis_price'][$key__1];
	// 					$new_price=$old_price-$new_price;

	// 				} else if ('ammend' == $value['discount_typ'][$key__1]) {
	// 					$new_price=$value['dis_price'][$key__1];
	// 				}
	// 				if (0>$new_price) {
	// 					$new_price=0;
	// 				}
	// 				$old_price=$new_price;


	// 			}






	// 		}
	// 		if ($old_price11!=$old_price) {
	// 			echo filter_var('<strike>' . wc_price($old_price11) . '</strike> ' . wc_price($old_price)); 
	// 		} else {
	// 			echo filter_var(wc_price($old_price)); 
	// 		}
			
	// 		wp_die();
	// 	}
	// 	echo filter_var(wc_price($old_price)); 
	// 	wp_die();
	// }

	public function plgfyqdp_activation_plugin_for_gnrl_Set() {
		$plgfqdp_save_All_general_settings_db_in=get_option('plgfyqdp_save_All_general_settings_db_in');
		if ('' == $plgfqdp_save_All_general_settings_db_in) {
			$plgfqdp_def_gen_settings=array(
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

				'plgfqdp_shw_dscnt_totl'=> 'false',
				'plgfqdp_shw_dscnt_totl_txt'=> 'Discounted Total: [discounted_total]',
				'plgfqdp_shw_amnt_svd'=> 'false',
				'plgfqdp_shw_amnt_svd_txt'=> 'Total amount saved: [amount_saved]',

				'plgfqdp_coupon_settings'=> 'plgfqdp_apply_both',
				'coupon_remove_message'=> 'Coupon code can not be applied as you already got a discount.',

			);
			update_option('plgfyqdp_save_All_general_settings_db_in', $plgfqdp_def_gen_settings);
		}
	}
	public function plgfyqdp_delete_rule_data_db() {
		$plgfyqdp_all_rules=get_option('plgfyqdp_all_rules');
		if ( '' == $plgfyqdp_all_rules ) {
			$plgfyqdp_all_rules=array();
		}
		if (isset($_REQUEST['index']) ) {
			$index = sanitize_text_field($_REQUEST['index']);
		}
		unset($plgfyqdp_all_rules[$index]);
		$plgfyqdp_all_rules=array_values($plgfyqdp_all_rules);
		
		update_option('plgfyqdp_all_rules', $plgfyqdp_all_rules);
		wp_die();
	}
	public function plgfyqdp_edit_rule_in_db() {
		$plgfyqdp_all_rules=get_option('plgfyqdp_all_rules');
		if ( '' == $plgfyqdp_all_rules ) {
			$plgfyqdp_all_rules=array();
		}
		if (isset($_REQUEST['index']) ) {
			$index = sanitize_text_field($_REQUEST['index']);
		}
		$plgfyqdp_all_rules[$index]=$_REQUEST;
		
		update_option('plgfyqdp_all_rules', $plgfyqdp_all_rules);
		wp_die();
	}

	public function plgfyqdp_edit_cart_rule_in_db() {
		$plgfyqdp_all_rules=get_option('plgfyqdp_all_cart_rules');
		if ( '' == $plgfyqdp_all_rules ) {
			$plgfyqdp_all_rules=array();
		}
		if (isset($_REQUEST['index']) ) {
			$index = sanitize_text_field($_REQUEST['index']);
		}
		$plgfyqdp_all_rules[$index]=$_REQUEST;
		
		update_option('plgfyqdp_all_cart_rules', $plgfyqdp_all_rules);
		wp_die();
	}

	public function plgfyqdp_add_rule_in_db() {
		$plgfyqdp_all_rules=get_option('plgfyqdp_all_rules');
		if ( '' == $plgfyqdp_all_rules ) {
			$plgfyqdp_all_rules=array();
		}
		array_push($plgfyqdp_all_rules, $_REQUEST);
		update_option('plgfyqdp_all_rules', $plgfyqdp_all_rules);
		wp_die();
	}

	public function plgfyqdp_add_cart_rule_in_db() {
		$plgfyqdp_all_cart_rules=get_option('plgfyqdp_all_cart_rules');
		if ( '' == $plgfyqdp_all_cart_rules ) {
			$plgfyqdp_all_cart_rules=array();
		}
		array_push($plgfyqdp_all_cart_rules, $_REQUEST);
		update_option('plgfyqdp_all_cart_rules', $plgfyqdp_all_cart_rules);
		wp_die();
	}
	
	public function plgfyqdp_save_gnrl_settings() {
		
		
		update_option('plgfyqdp_save_All_general_settings_db_in', $_REQUEST);
		wp_die();
	}
	public function plgfyqdp_get_all_qtyrules_from_db() {
		$plgfyqdp_all_rules=get_option('plgfyqdp_all_rules');
		if ( '' == $plgfyqdp_all_rules ) {
			$plgfyqdp_all_rules=array();
		}
		$return_json=array();
		foreach ($plgfyqdp_all_rules as $key => $value) {
			if ('true' == $value['plgfydc_activate_rule']) {
				$html='Active <i style="color:green;" class="fa fa-check" aria-hidden="true"></i>';
			} else {
				$html='Deactive <i style="color:red;" class="fa fa-remove"></i>';
			}
			if ('' == $value['allowed_roles'] || 0 == count($value['allowed_roles'])) {
				$writeit='(All Roles)';
			} else {
				$writeit=$value['allowed_roles'];
			}
			$rulenamee=$value['plugify_r_lbl'];
			if ('' == $rulenamee) {
				$rulenamee='Rule# ' . ( $key+1 );
			}
			$plgfy_row = array(
				'serial_no' => $rulenamee,
				'Applied On' => $value['applied_on'],
				'Allowed Roles' => $writeit,
				'Status' =>  $html,

				'Action' => $key,
			);
			$return_json[] = $plgfy_row;

		}

		echo json_encode(array( 'data' => $return_json ));
		wp_die();
	}

	public function plgfyqdp_get_all_cart_rules_from_db() {

		$plgfyqdp_all_cart_rules=get_option('plgfyqdp_all_cart_rules');
		if ( '' == $plgfyqdp_all_cart_rules ) {
			$plgfyqdp_all_cart_rules=array();
		}
		$return_json=array();
		foreach ($plgfyqdp_all_cart_rules as $key => $value) {
			if ('true' == $value['plgfydc_activate_rule']) {
				$html='Active <i style="color:green;" class="fa fa-check" aria-hidden="true"></i>';
			} else {
				$html='Deactive <i style="color:red;" class="fa fa-remove"></i>';
			}
			if ('true' == $value['plgfydc_work_with_quant'] ) {
				$writeit='Yes';
			} else {
				$writeit='No';
			}
			$rulenamee=$value['plugify_r_lbl'];
			if ('' == $rulenamee) {
				$rulenamee='Rule# ' . ( $key+1 );
			}
			$plgfy_row = array(
				'serial_no' => $rulenamee,
				'Applied On' => $value['applied_on'],
				'Work with Product Discount' => $writeit,
				'Status' =>  $html,

				'Action' => $key,
			);
			$return_json[] = $plgfy_row;

		}

		echo json_encode(array( 'data' => $return_json ));
		wp_die();
	}


	public function plgfyqdp_get_cart_edit_qtyrules() {
	
		if (isset($_REQUEST['index']) ) {
			$index = sanitize_text_field($_REQUEST['index']);
		}
		$plgfyqdp_all_rules=get_option('plgfyqdp_all_cart_rules');
		if ( '' == $plgfyqdp_all_rules ) {
			$plgfyqdp_all_rules=array();
		}
	
		$to_be_sent=$plgfyqdp_all_rules[$index];
		

		$rulenamee=$to_be_sent['plugify_r_lbl'];
		if ('' == $rulenamee) {
			$rulenamee='Rule# ' . ( $index+1 );
		}

		$plugify_cart_dis_text=$to_be_sent['plugify_cart_discount_text'];
		if ('' == $plugify_cart_dis_text) {
			$plugify_cart_dis_text='Cart Discount';
		}

		$plgfyqbd_product_category_html='';
		$plgfqdp_parentid = get_queried_object_id();
		$plgfqdp_args = array(
			'numberposts' => -1,
			'taxonomy' => 'product_cat',
		);
		$plgfqdp_terms = get_terms($plgfqdp_args);
		if ( $plgfqdp_terms ) {   
			foreach ( $plgfqdp_terms as $plgfqdp_term1 ) {
				$plgfyqbd_product_category_html = $plgfyqbd_product_category_html . '<option class="plgfqdp_catopt" value="' . $plgfqdp_term1->term_id . '">' . $plgfqdp_term1->name . '</option>';

			}
		}
		global $wp_roles;
		$plgfyqdp_all_roles = $wp_roles->get_names();
		$plgfyqbd_roles_html='';
		$plgfyqbd_roles_html .= $plgfyqbd_roles_html . '<option value="guest">Guest (Not logged in)</option>';
		foreach ($plgfyqdp_all_roles as $key_role => $value_role) {
			$plgfyqbd_roles_html = $plgfyqbd_roles_html . '<option value="' . $key_role . '">' . ucfirst($value_role) . '</option>';

		}
		?>
		<input value='<?php echo esc_html($plgfyqbd_product_category_html); ?>' type="hidden" id="plgfyqbd_cats_222" >
		<input value='<?php echo esc_html($plgfyqbd_roles_html); ?>' type="hidden" id="plgfyqbd_roles_222" >


		<div class="plugify_bordered">
			<div style="display: inline-flex;width:100%;">
				<div style="width:60%;">
					<strong>Activate Rule</strong>
					<label class="switch">
						<input type="checkbox" id="plgfydc_activate_cart_rule_222"
						<?php
						if ('true' == $to_be_sent['plgfydc_activate_rule']) {
							echo filter_var('checked');
						}
						?>
						>
						<span class="slider"></span>
					</label>
				</div>
				<div style="width:40%;text-align: right;">
					<strong>Rule Name</strong>
					<input type="text" id="plugify_cart_r_name_222" value="<?php echo esc_attr($rulenamee); ?>">
				</div>
			</div>

			<br>

			<div style="display: flex; margin-top: 10px;">
				<div style="width:50%">
					<strong >Work with product discount rules?</strong> 
					<div class="plugify_tooltip">
						<span class="dashicons dashicons-editor-help"></span>
						<span class="plugify_tooltiptext">If unchecked, this rule will be excluded if the product discount rule is already applied to any cart item(s).</span>
					</div>
					<label class="">
						<input type="checkbox" id="plgfydc_work_with_quant_222"
						<?php
						if ('true' == $to_be_sent['plgfydc_work_with_quant']) {
							echo filter_var('checked');
						}
						?>
						>
					</label>
				</div>

				<div style="width:50%; text-align: right;">
					<strong>Cart Discount Text <abbr class="required" title="required">*</abbr></strong>
					<div class="plugify_tooltip">
						<span class="dashicons dashicons-editor-help"></span>
						<span class="plugify_tooltiptext">This text will be shown in cart totals. It must be unique and two different rules should not have same text.</span>
					</div>
					<input type="text" id="plugify_cart_discount_text_222" value="<?php echo esc_attr($plugify_cart_dis_text); ?>"  placeholder="e.g Special Discount">
					<br>
					<i>Please use unique cart discount text in all rules</i>
				</div>

			</div>
		</div>
		<br>
		<div class="cart_ranges_based_table_222 plugify_bordered" style="margin-top:1%;">
			<label><strong>Don't want to apply a discount based on cart item quantity?</strong>
				<div class="plugify_tooltip">
					<span class="dashicons dashicons-editor-help"></span>
					<span class="plugify_tooltiptext">If checked, number of cart items will be ignored while applying discount on the cart totals.</span>
				</div>

					<input type="checkbox" class='plgfy_apl_al_qntits_222' id="plgfy_apl_al_qntits_222" name="plgfy_apl_al_qntits_222" 
					<?php
					if ('true' == $to_be_sent['plgfy_apl_al_qntits']) {
						echo filter_var('checked');
					}
					?>
					></label><br>

				<button class="button-primary plgfyqdp_add_cart_ranges_222 plugfy_hd_sh_qnty1"  type="button" style="background-color: green;border-color: green;float: right;">
					<i class="fa fa-fw fa-plus"></i>
				Add Range(s)</button>
			<!-- <strong >Set Discount on Cart</strong> <strong class="plugfy_hd_sh_qnty1" > Item's Quantity Ranges</strong> -->
			<table class="plgfy_add_modal_table last_tbl_gnrl_stng " style="margin-top: 2%;">
				<tr>
					<th  class="plugfy_hd_sh_qnty1"  style="width: 22.5%;">
						Start Range  <abbr class="required" title="required">*</abbr>
					</th>
					<th  class="plugfy_hd_sh_qnty1"  style="width: 22.5%;">
						End Range  <abbr class="required" title="required">*</abbr>
					</th>
					<th style="width: 22.5%;">
						Discount Type  <abbr class="required" title="required">*</abbr>
					</th>
					<th style="width: 22.5%;">
						Discount Amount  <abbr class="required" title="required">*</abbr>
					</th>
					<th  class="plugfy_hd_sh_qnty1"  style="width: 10%;">
						Remove
					</th>
				</tr>

				<?php
				foreach ($to_be_sent['start_rng'] as $key => $value) {
					?>
				<tr>
					<td  class="plugfy_hd_sh_qnty1"  style="width: 22.5%;">
						<input type="number" min="0" class="start_rng_cart_222" value="<?php echo esc_attr($value); ?>" required style="width: 99%;">
					</td>
					<td  class="plugfy_hd_sh_qnty1"  style="width: 22.5%;">
						<input type="number" min="0" class="end_rng_cart_222"  value="<?php echo esc_attr($to_be_sent['end_rng'][$key]); ?>"  required style="width: 99%;">
					</td>
					<td style="width: 22.5%;">
						<select style="width: 99%;" required class="discount_typ_cart_222">								
							<option value="fixed" 
							<?php 
							if ( 'fixed' == $to_be_sent['discount_typ'][$key]) {
								echo 'selected';
							}
							?>
							>Fixed Discount</option>
							<option value="prcnt"
							<?php 
							if ( 'prcnt' == $to_be_sent['discount_typ'][$key]) {
								echo 'selected';
							}
							?>
							>Percentage Discount</option>
							
						</select>
					</td>
					<td style="width: 22.5%;">
						<input type="number" required class="dis_price_cart_222" min="0" value="<?php echo esc_attr($to_be_sent['dis_price'][$key]); ?>" step="any" style="width: 99%;">
					</td>
					<td  class="plugfy_hd_sh_qnty1"  style="width: 10%;">
						<?php
						if ( 0 != $key ) {
							?>
					<span class="plgfyqdp_del_current_row" style="padding: 6px 8px 6px 8px;cursor: pointer;    border: 1px solid red;    border-radius: 4px;"><i style="color:red;" class="fa fa-trash" aria-hidden="true"></i>							</span>
						<?php } ?>
					</td>
				</tr>

					<?php
				}
				?>

			</table>

			<p  class="plugfy_hd_sh_qnty1" >
				<i>Set End Range as <strong>“999999”</strong> for <strong>unlimited</strong> quantity. For example, set range 5 to 999999 and it will display like 5+ on the frontend for customers.</i>
				<br>
				<i>Range will be checked on <strong>total number of items</strong> in the cart</i>
			</p>

		</div>
		<br>
		<div class="plugify_bordered" >
		<button class="button-primary plgfyqdp_add_cart_condition_222" type="button" style="background-color: green;border-color: green;float: right;">
			<i class="fa fa-fw fa-plus"></i>
		Add Condition(s)</button><br>
		<table class="plgfy_add_modal_table_cart_222 last_tbl_gnrl_stng " style="margin-top: 2%;">
			<tr>
				<th style="width: 30%;">
					If 
				</th>
				<th style="width: 30%;">
					Condition 
				</th> 
				<th style="width: 30%;">
					Conditional Value 
				</th>
				<th style="width: 10%;">
					Remove
				</th>
			</tr>

			<?php

			foreach ($to_be_sent['cart_if_value_of'] as $key1 => $value1) {
			
				?>

			<tr>
				<td style="width: 30%;">
					<select style="width: 99%;" required class="cart_if_value_of_222">								
						<option value="">Select</option>
						<option value="coupon"
						<?php 
						if ( 'coupon' == $to_be_sent['cart_if_value_of'][$key1]) {
							echo 'selected';
						}
						?>
						>Coupon Code Used</option>
						<option value="sub_total"
						<?php 
						if ( 'sub_total' == $to_be_sent['cart_if_value_of'][$key1]) {
							echo 'selected';
						}
						?>
						>Cart Subtotal</option>
						<option value="user_role"
						<?php 
						if ( 'user_role' == $to_be_sent['cart_if_value_of'][$key1]) {
							echo 'selected';
						}
						?>
						>User Role</option>
						<option value="products_in_cart"
						<?php 
						if ( 'products_in_cart' == $to_be_sent['cart_if_value_of'][$key1]) {
							echo 'selected';
						}
						?>
						>Products In Cart</option>
						<option value="categories_in_cart"
						<?php 
						if ( 'categories_in_cart' == $to_be_sent['cart_if_value_of'][$key1]) {
							echo 'selected';
						}
						?>
						>Categories In Cart</option>
					</select>
				</td>
				<td style="width: 30%;">
					<select style="width: 99%;" required class="cart_checking_condition_222">								
						<option value="">Select</option>
						<option value="=="
						<?php 
						if ( '==' == $to_be_sent['cart_checking_condition'][$key1]) {
							echo 'selected';
						}
						?>
						>Equal To</option>
						<option value="!="
						<?php 
						if ( '!=' == $to_be_sent['cart_checking_condition'][$key1]) {
							echo 'selected';
						}
						?>
						>Not Equal To</option>

						<?php

						if ( 'sub_total' == $to_be_sent['cart_if_value_of'][$key1] || 'cart_total' == $to_be_sent['cart_if_value_of'][$key1] ) {
							?>

							<option value="<"
							<?php 
							if ( '<' == $to_be_sent['cart_checking_condition'][$key1]) {
								echo 'selected';
							}
							?>
							>Less Than</option>
							<option value=">"
								<?php 
								if ( '>' == $to_be_sent['cart_checking_condition'][$key1]) {
									echo 'selected';
								}
								?>
								>Greater Than</option>

								<?php
						}
						?>


						</select>
					</td>
					<td style="width: 30%;">
						<div id="plgfqpd_sngl_txt" class="plgfyqbd_to_be_check_222"
						<?php 

						$field_value = '';
						$current_class = '';

						if ( 'user_role' == $to_be_sent['cart_if_value_of'][$key1] ||  'products_in_cart' == $to_be_sent['cart_if_value_of'][$key1] ||  'categories_in_cart' == $to_be_sent['cart_if_value_of'][$key1] ) {
							echo 'style="display:none;"';

						} else {
							$field_value = $to_be_sent['cart_checking_value'][$key1];
							$current_class = 'cart_checking_value_222';
						}
						?>
						>
							<input type="text" class="<?php echo esc_attr($current_class); ?> plugify_all_values_222" value="<?php echo esc_attr($field_value); ?>" required style="width: 99%;">
						</div>
						<div id="plgfqbd_sngl_pro" class="plgfyqbd_to_be_check_222"

						<?php 

						$field_value = '';
						$current_class = '';
						if ( 'products_in_cart' != $to_be_sent['cart_if_value_of'][$key1] ) {
							echo 'style="display:none;"';
						} else {
							$field_value = $to_be_sent['cart_checking_value'][$key1];
							$current_class = 'cart_checking_value_222';
						}
						?>
						>
						<select name="plgfqdp_productssngl[]"  style="max-width: 99%;width: 99%;font-size: 12px;" class="<?php echo esc_attr($current_class); ?> plugify_all_values_222 plugify_cart_products" id="plgfqdp_productscsngl">
							<?php	
							echo '<option  class="plgfqdp_option-item" selected value=" ' . esc_attr($to_be_sent['cart_checking_value'][$key1]) . '">' . esc_attr(get_the_title($to_be_sent['cart_checking_value'][$key1])) . '</option>';
							?>
						</select>
						</div>
						<div id="plgfqbd_sngl_cat" class="plgfyqbd_to_be_check_222"
						<?php 
						$field_value = '';
						$current_class = '';
						if ( 'categories_in_cart' != $to_be_sent['cart_if_value_of'][$key1] ) {
							echo 'style="display:none;"';
						} else {
							$field_value =  $to_be_sent['cart_checking_value'][$key1];
							$current_class = 'cart_checking_value_222';
						}
						?>
						>
							<select  name="plgfqdp_selectcat[]" style="max-width:99%;width: 99%;font-size: 12px;" id="plgfqdp_selectcatcsngl" class="plugify_all_values_222 <?php echo filter_var($current_class); ?>"   >
								<option value="">Select Category</option>
								<?php


								$plgfyqbd_product_category_html='';
								$plgfqdp_parentid = get_queried_object_id();
								$plgfqdp_args = array(
									'numberposts' => -1,
									'taxonomy' => 'product_cat',
								);
								$plgfqdp_terms = get_terms($plgfqdp_args);
								if ( $plgfqdp_terms ) {   
									foreach ( $plgfqdp_terms as $plgfqdp_term1 ) {

										$selected = '';
										if ($plgfqdp_term1->term_id == $field_value) {
											$selected = 'selected';
										}

										echo '<option ' . filter_var($selected) . ' class="plgfqdp_catopt" value="' . filter_var($plgfqdp_term1->term_id) . '">' . filter_var($plgfqdp_term1->name) . '</option>';

									}
								}

								?>
							</select>
						</div>
						<div id="plgfqbd_sngl_role" class="plgfyqbd_to_be_check_222"
						<?php 
						$current_class = '';
						if ( 'user_role' != $to_be_sent['cart_if_value_of'][$key1]) {
							echo 'style="display:none;"';
						} else {
							$current_class = 'cart_checking_value_222';
						}
						?>
						>

							<select class="plugify_all_values_222 plgfyqdp_customer_rolesngl <?php echo filter_var($current_class); ?>" name="plgfyqdp_customer_rolesngl[]" id="plgfyqdp_customer_rolesngl" multiple class="form-control " style="width: 99%;">

								<?php
								$selected = '';
								if (is_array($to_be_sent['cart_checking_value'][$key1]) && in_array('guest', $to_be_sent['cart_checking_value'][$key1])) {
									$selected = 'selected';
								}
								?>

								<option value="guest" <?php echo filter_var($selected); ?> >Guest (Not logged in)</option>
								<?php

								global $wp_roles;
								$plgfyqdp_all_roles = $wp_roles->get_names();
								$plgfyqbd_roles_html='';



								foreach ($plgfyqdp_all_roles as $key_role => $value_role) {

									$selected = '';
									if (is_array($to_be_sent['cart_checking_value'][$key1]) && in_array($key_role, $to_be_sent['cart_checking_value'][$key1])) {
										$selected = 'selected';
									}
									echo '<option ' . filter_var($selected) . ' value="' . filter_var($key_role) . '">' . filter_var(ucfirst($value_role)) . '</option>';
								}
								?>

							</select>
						</div>



					</td>
					<td style="width: 10%;">
						<?php
						if ( 0 != $key1 ) {
							?>
							<span class="plgfyqdp_del_current_row" style="padding: 6px 8px 6px 8px;cursor: pointer;    border: 1px solid red;    border-radius: 4px;"><i style="color:red;" class="fa fa-trash" aria-hidden="true"></i>							</span>

						<?php } ?>
					</td>
				</tr>

			<?php } ?>


			</table>
			<i>Relation between upper conditions is <strong>“AND”</strong></i>
		</div>
			<br>

		<?php
		wp_die();
	}



	public function plgfyqdp_get_myModaledit_qtyrules() {
		if (isset($_REQUEST['index']) ) {
			$index = sanitize_text_field($_REQUEST['index']);
		}
		$plgfyqdp_all_rules=get_option('plgfyqdp_all_rules');
		if ( '' == $plgfyqdp_all_rules ) {
			$plgfyqdp_all_rules=array();
		}
	
		$to_be_sent=$plgfyqdp_all_rules[$index];
		

		$rulenamee=$to_be_sent['plugify_r_lbl'];
		if ('' == $rulenamee) {
			$rulenamee='Rule# ' . ( $index+1 );
		}
		?>
			<input type="hidden" id="qtybasedmain" value="">

			<div style="display: inline-flex;width:100%;">
				<div style="width:60%;">
					<strong>Activate Rule</strong>
					<label class="switch">
						<input type="checkbox" id="plgfydc_activate_rule1"
						<?php
						if ('true' == $to_be_sent['plgfydc_activate_rule']) {
							echo filter_var('checked');
						}
						?>
						>
						<span class="slider"></span>
					</label>
				</div>

				<div style="width:40%;text-align: right;">
					<strong>Rule Name</strong>
					<input type="text" id="plugify_qty_r_name1" value="<?php echo esc_attr($rulenamee); ?>">
				</div>
			</div>

			

			<button class="button-primary plgfyqdp_add_ranges1" type="button" style="margin-top: 1%;background-color: green;border-color: green;float: right;">
				<i class="fa fa-fw fa-plus"></i>
			Add Range(s)</button>
			<table class="plgfy_add_modal_table1 last_tbl_gnrl_stng" style="margin-top: 2%;">
				<tr>
					<th style="width: 22.5%;">
						Start Range <abbr class="required" title="required">*</abbr>
					</th>
					<th style="width: 22.5%;">
						End Range <abbr class="required" title="required">*</abbr>
					</th>
					<th style="width: 22.5%;">
						Discount Type <abbr class="required" title="required">*</abbr>
					</th>
					<th style="width: 22.5%;">
						Discount Amount <abbr class="required" title="required">*</abbr>
					</th>
					<th style="width: 10%;">
						Remove
					</th>
				</tr>
				<?php
				
				foreach ($to_be_sent['start_rng'] as $key => $value) {
					
					?>
					<tr>
						<td style="width: 22.5%;">
							<input value="<?php echo esc_attr($value); ?>" min="0" type="number" class="start_rng1"  required style="width: 99%;">
						</td>
						<td style="width: 22.5%;">
							<input value="<?php echo esc_attr($to_be_sent['end_rng'][$key]); ?>" min="0" type="number" class="end_rng1" required style="width: 99%;">
						</td>
						<td style="width: 22.5%;">
							<select style="width: 99%;" required class="discount_typ1">								
								<option value="fixed"
								<?php
								if ('fixed'== $to_be_sent['discount_typ'][$key]) {
									echo filter_var('selected');
								}
								?>
								>Fixed Discount</option>
								<option value="prcnt"
								<?php
								if ('prcnt'== $to_be_sent['discount_typ'][$key]) {
									echo filter_var('selected');
								}
								?>
								>Percentage Discount</option>
								<option value="ammend"
								<?php
								if ('ammend'== $to_be_sent['discount_typ'][$key]) {
									echo filter_var('selected');
								}
								?>
								>Discounted Price</option>
							</select>
						</td>
						<td style="width: 22.5%;">
							<input value="<?php echo esc_attr($to_be_sent['dis_price'][$key]); ?>" type="number" required class="dis_price1" min="0" step="any" style="width: 99%;">
						</td>
						<td style="width: 10%;">
							<?php
							if ( 0 != $key ) {
								?>
								<span class="plgfyqdp_del_current_row" style="padding: 6px 8px 6px 8px;cursor: pointer;    border: 1px solid red;    border-radius: 4px;"><i style="color:red;" class="fa fa-trash" aria-hidden="true"></i>							</span>
								<?php
							}
							?>
						</td>
					</tr>
					
					<?php
				}
				?>
			</table>
			<p>
				<i>a. Set End Range as <strong>“999999”</strong> for <strong>unlimited quantity</strong>. For example, set range 5 to 999999 and it will display like 5+ on the frontend for customers.<br>b. If start and end range is same, only start range will be displayed. For example, set range 5 to 5 and it will display like 5 on the frontend for customers. </i>
			</p>
			<br>

		<table class="last_tbl_gnrl_stng brdr" > 
			<tr>
				<th>
					Applied On
				</th>
				<th>
					Select Products/Categories
				</th>
			</tr>
			<tr>
				<td style="width: 30%;">
					<select id="plgfqdp_applied_onc1" style="width: 90%;" name="applied_plgfqdp_on1">

						<option value="Products"
						<?php
		
						if ('Products' == $to_be_sent['applied_on']) {
							echo filter_var('selected');
						}
						?>
						>Products</option>
						<option value="Category"
						<?php
						if ('Category' == $to_be_sent['applied_on']) {
							echo filter_var('selected');
						}
						?>
						>Category</option>
					</select>
				</td>
				<td style="width: 70%;">
					<div id="plgfqdp_products1c1" 
					<?php
					if ('Products' != $to_be_sent['applied_on'] && '' != $to_be_sent['applied_on']) {

						echo filter_var(' style="display:none; "');
					}
					?>
					>

					<select name="plgfqdp_products1[]" multiple="multiple"  style="max-width: 100%;width: 100%;font-size: 12px;" class=" plgfqdp_products" id="plgfqdp_productsc1"   >


						<?php
						if (isset($to_be_sent['apllied_on_ids']) && 'Products' == $to_be_sent['applied_on']) {
							foreach ($to_be_sent['apllied_on_ids'] as $keylopoi => $valuelooupi) {
								?>
								<option  class="plgfqdp_option-item" value="<?php echo esc_attr($valuelooupi); ?>" selected >
									<?php
									echo esc_attr(get_the_title($valuelooupi));
									?>

								</option>
								<?php     
							}
						}
						
						?>
					</select><br>
					<i>(These quantity discount ranges will be applicable to selected products)</i><br>
					

					<i style="color:red;"><input type="checkbox" id="plugify_whole_product1" name="plugify_whole_product" style="margin:unset;" 
						<?php 
						echo filter_var(isset($to_be_sent['include_pro']) && 'true' == $to_be_sent['include_pro']) ? 'checked' : ''; 
						?>
						>  By Checking this option, a discount will be applied to the above-selected items if the quantity count of all above-selected items reaches to the range mentioned in this rule</i>
					</div>
					<div id="plgfqdp_selectcat1c1" 
					<?php
		
					if ('Category' != $to_be_sent['applied_on']) {
						echo filter_var(' style="display:none; "');
					}
					?>
					>

					<select  name="plgfqdp_selectcat1[]" style="max-width: 100%;width: 100%;font-size: 12px;" id="plgfqdp_selectcatc1" class="plgfqdp_selectcat"   multiple='multiple[]'>
						<?php
						$plgfqdp_parentid = get_queried_object_id();
						$plgfqdp_args = array(
							'numberposts' => -1,
							'taxonomy' => 'product_cat',
						);
						$plgfqdp_terms = get_terms($plgfqdp_args);
						if ( $plgfqdp_terms ) {   
							foreach ( $plgfqdp_terms as $plgfqdp_term1 ) {
								
								?>
								<option class="plgfqdp_catopt"
								<?php 
								if ('Category' == $to_be_sent['applied_on'] && isset($to_be_sent['apllied_on_ids']) && in_array($plgfqdp_term1->term_id, $to_be_sent['apllied_on_ids'])) {
									echo filter_var('selected');
								}
								?>
								value="<?php echo esc_attr($plgfqdp_term1->term_id); ?> ">
								<?php
								echo esc_attr($plgfqdp_term1->name);
								?>
							</option>
								<?php
							}          
						}
						?>
				</select><br>
				<i>(These quantity discount ranges will be applicable to selected categories)</i><br>
				
				<i style="color:red;"><input type="checkbox" id="plugify_whole_category1" name="plugify_whole_category" style="margin:unset;" 
					<?php 
					echo filter_var(isset($to_be_sent['include_cat']) && 'true' == $to_be_sent['include_cat']) ? 'checked' : ''; 
					?>
					>  By Checking this option, a discount will be applied to the items from the above-selected categories if the quantity count of the products from all above-selected categories reaches the range mentioned in this rule</i>
			</div>
			</td>
		</tr>				
	</table>
	<br>
	<strong >Allowed Roles</strong>

	<div >
		<?php 
		
		global $wp_roles;
		$plgfyqdp_all_roles = $wp_roles->get_names();
		?>
		<select class="plgfyqdp_customer_roleclass" id="plgfyqdp_customer_role1" multiple="multiple" class="form-control " style="width: 98%;">
			<?php
			foreach ($plgfyqdp_all_roles as $key_role => $value_role) {
				?>
				<option value="<?php echo filter_var($key_role); ?>"
					<?php
					if (isset($to_be_sent['allowed_roles']) && in_array($key_role, $to_be_sent['allowed_roles'])) {
						echo filter_var('selected');
					}
					?>
					><?php echo filter_var(ucfirst($value_role)); ?></option>
				<?php
			}
			?>

			</select>
			<br><i style="color: green;">(Leave empty to allow all roles as selected)</i>

		</div>
		<br>
		<strong >Enable Rule For Guest Users?</strong>
		<label class="switch">
			<input type="checkbox" id="plgfydc_is_guest1"
			<?php
			if ('true' == $to_be_sent['plgfydc_is_guest']) {
				echo filter_var('checked');
			}
			?>
			>
			<span class="slider"></span>
		</label>
		<?php
		wp_die();
	}
}


new PlugfyQDP_Main_Class_Alpha();
add_filter( 'plugin_action_links', 'plugify_cup_action_links11qty' , 10, 2 );
function plugify_cup_action_links11qty( $links, $file ) {
	
	if ( 'quantity-discounts-pricing-for-woocommerce/quantity-discounts-pricing-for-woocommerce.php' == $file ) {
		
		$settings = '<a href="' . admin_url( 'admin.php?page=wc-settings&tab=plgfyqdp' ) . '">' . esc_html__( 'Configure Rules', 'woocommerce' ) . '</a>';

		array_push( $links, $settings);

	}


	return (array) $links;
}


add_action( 'wp_ajax_plgfyqdp_search_product', 'plgfyqdp_search_product1' );
function plgfyqdp_search_product1() {

	if (isset($_REQUEST['q'])) {
		$pro = sanitize_text_field( $_REQUEST['q'] );
	} else {
		$pro = '';
	}

	$data_array = array();
	$args       = array(
		'post_type' => array( 'product', 'product_variation' ),
		'post_status' => 'publish',
		'numberposts' => -1,
		's' => $pro,
	);

	$pros       = get_posts($args);

	if ( !empty($pros)) {

		foreach ($pros as $proo) {
			
			$product=wc_get_product($proo->ID);


			if ( 'variation' == $product->get_type() ) {
				$var_custom_attributes = $product->get_variation_attributes();
				if (count($var_custom_attributes) > 2) {
					$attribute = wc_get_formatted_variation( $var_custom_attributes, true );
					$title = $proo->post_title . ' ' . $attribute;
				} else {
					$title        = ( mb_strlen( $proo->post_title ) > 50 ) ? mb_substr( $proo->post_title, 0, 49 ) . '...' : $proo->post_title;
				}

			} else {
				$title        = ( mb_strlen( $proo->post_title ) > 50 ) ? mb_substr( $proo->post_title, 0, 49 ) . '...' : $proo->post_title;
			}

				// $title        = ( mb_strlen( $proo->post_title ) > 50 ) ? mb_substr( $proo->post_title, 0, 49 ) . '...' : $proo->post_title;
			$data_array[] = array( $proo->ID, $title );
		}
	}

	echo wp_json_encode( $data_array );

	die();
}
