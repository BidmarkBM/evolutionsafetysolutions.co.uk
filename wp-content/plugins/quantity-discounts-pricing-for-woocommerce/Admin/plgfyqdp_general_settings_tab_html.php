<?php
$all_gnrl_plgfyqdp_set=get_option('plgfyqdp_save_All_general_settings_db_in');
if ('' == $all_gnrl_plgfyqdp_set) {
	$all_gnrl_plgfyqdp_set=array(
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
		'hide_qty_data_from_email'=> 'false',


	);
}


if (!isset($all_gnrl_plgfyqdp_set['plgfqdp_shw_strt']) && !isset($all_gnrl_plgfyqdp_set['plgfqdp_shw_strt_txt']) && !isset($all_gnrl_plgfyqdp_set['plgfqdp_dynprc']) ) {

	$all_gnrl_plgfyqdp_set['plgfqdp_shw_strt']='true';
	$all_gnrl_plgfyqdp_set['plgfqdp_shw_strt_txt']='Starting From: [min_price]';
	$all_gnrl_plgfyqdp_set['plgfqdp_dynprc']='true';
}
if (isset($all_gnrl_plgfyqdp_set['plgfqdp_dynprc']) && !isset($all_gnrl_plgfyqdp_set['col1pertext']) ) {
	$all_gnrl_plgfyqdp_set['plgfqdp_dynprc']='false';
}
if (!isset($all_gnrl_plgfyqdp_set['plgfqdp_hvrrrclr'])) {
	$all_gnrl_plgfyqdp_set['plgfqdp_hvrrrclr']='#ffffff';
}
if (!isset($all_gnrl_plgfyqdp_set['hide_qty_data_from_email'])) {
	$all_gnrl_plgfyqdp_set['hide_qty_data_from_email']='false';
}
if (!isset($all_gnrl_plgfyqdp_set['plgfqdp_bg_hvrr_clrr'])) {
	$all_gnrl_plgfyqdp_set['plgfqdp_bg_hvrr_clrr']='#110b40';
}
if (!isset($all_gnrl_plgfyqdp_set['col1qtytext'])) {
	$all_gnrl_plgfyqdp_set['col1qtytext']='Quantity';
}
if (!isset($all_gnrl_plgfyqdp_set['col1distext'])) {
	$all_gnrl_plgfyqdp_set['col1distext']='Discount';
}
if (!isset($all_gnrl_plgfyqdp_set['col1pertext'])) {
	$all_gnrl_plgfyqdp_set['col1pertext']='Per Item Price';
}


if (!isset($all_gnrl_plgfyqdp_set['plgfqdp_show_offers_button'])) {
	$all_gnrl_plgfyqdp_set['plgfqdp_show_offers_button']='true';
}
if (!isset($all_gnrl_plgfyqdp_set['plgfqdp_offers_button_shadow'])) {
	$all_gnrl_plgfyqdp_set['plgfqdp_offers_button_shadow']='true';
}
if (!isset($all_gnrl_plgfyqdp_set['plgfqdp_offers_button_text'])) {
	$all_gnrl_plgfyqdp_set['plgfqdp_offers_button_text']='Discount Offers';
}
if (!isset($all_gnrl_plgfyqdp_set['plgfqdp_offers_button_text_color'])) {
	$all_gnrl_plgfyqdp_set['plgfqdp_offers_button_text_color']='#ffffff';
}
if (!isset($all_gnrl_plgfyqdp_set['plgfqdp_offers_button_text_size'])) {
	$all_gnrl_plgfyqdp_set['plgfqdp_offers_button_text_size']='13';
}
if (!isset($all_gnrl_plgfyqdp_set['plgfqdp_offers_button_text_weight'])) {
	$all_gnrl_plgfyqdp_set['plgfqdp_offers_button_text_weight']='400';
}
if (!isset($all_gnrl_plgfyqdp_set['plgfqdp_offers_button_bg_color'])) {
	$all_gnrl_plgfyqdp_set['plgfqdp_offers_button_bg_color']='#4485ca';
}
if (!isset($all_gnrl_plgfyqdp_set['plugify_button_select_pages'])) {
	$all_gnrl_plgfyqdp_set['plugify_button_select_pages']= array();
}
if (!isset($all_gnrl_plgfyqdp_set['plgfqdp_offers_button_shadow_color'])) {
	$all_gnrl_plgfyqdp_set['plgfqdp_offers_button_shadow_color']='#dedede';
}
if (!isset($all_gnrl_plgfyqdp_set['plgfqdp_offers_button_radius'])) {
	$all_gnrl_plgfyqdp_set['plgfqdp_offers_button_radius']='0';
}

if (!isset($all_gnrl_plgfyqdp_set['plgfqdp_apply_multiple_discount'])) {
	$all_gnrl_plgfyqdp_set['plgfqdp_apply_multiple_discount']='false';
}
if (!isset($all_gnrl_plgfyqdp_set['plugify_discount_tobe_applied'])) {
	$all_gnrl_plgfyqdp_set['plugify_discount_tobe_applied']='min_in_rule';
}

if (!isset($all_gnrl_plgfyqdp_set['plgfqdp_offers_popup_bg_color'])) {
	$all_gnrl_plgfyqdp_set['plgfqdp_offers_popup_bg_color']='#FEFEFE';
}

if (!isset($all_gnrl_plgfyqdp_set['plgfqdp_offers_popup_hd_text'])) {
	$all_gnrl_plgfyqdp_set['plgfqdp_offers_popup_hd_text']='Discount Offers';
}
if (!isset($all_gnrl_plgfyqdp_set['plgfqdp_offers_popup_hd_text_color'])) {
	$all_gnrl_plgfyqdp_set['plgfqdp_offers_popup_hd_text_color']='#262626';
}
if (!isset($all_gnrl_plgfyqdp_set['plgfqdp_offers_popup_hd_bg_clr'])) {
	$all_gnrl_plgfyqdp_set['plgfqdp_offers_popup_hd_bg_clr']='#ededed';
}
if (!isset($all_gnrl_plgfyqdp_set['plgfqdp_offers_popup_txt_color'])) {
	$all_gnrl_plgfyqdp_set['plgfqdp_offers_popup_txt_color']='#101010';
}


if (!isset($all_gnrl_plgfyqdp_set['plgfqdp_shw_dscnt_totl'])) {
	$all_gnrl_plgfyqdp_set['plgfqdp_shw_dscnt_totl']='false';
}
if (!isset($all_gnrl_plgfyqdp_set['plgfqdp_shw_dscnt_totl_txt'])) {
	$all_gnrl_plgfyqdp_set['plgfqdp_shw_dscnt_totl_txt']='Discounted Total: [discounted_total]';
}
if (!isset($all_gnrl_plgfyqdp_set['plgfqdp_shw_amnt_svd'])) {
	$all_gnrl_plgfyqdp_set['plgfqdp_shw_amnt_svd']='false';
}
if (!isset($all_gnrl_plgfyqdp_set['plgfqdp_shw_amnt_svd_txt'])) {
	$all_gnrl_plgfyqdp_set['plgfqdp_shw_amnt_svd_txt']='Total amount saved: [amount_saved]';
}

if (!isset($all_gnrl_plgfyqdp_set['plgfqdp_coupon_settings'])) {
	$all_gnrl_plgfyqdp_set['plgfqdp_coupon_settings']='plgfqdp_apply_both';
}

if (!isset($all_gnrl_plgfyqdp_set['coupon_remove_message'])) {
	$all_gnrl_plgfyqdp_set['coupon_remove_message']='Coupon code can not be applied as you already got a discount.';
}

if (!isset($all_gnrl_plgfyqdp_set['plgfyqdp_dt_and_as_position'])) {
	$all_gnrl_plgfyqdp_set['plgfyqdp_dt_and_as_position']='before_discount_table';
}


$args = array(
	'sort_order' => 'asc',
	'sort_column' => 'post_title',
	'hierarchical' => 1,
	'posts_per_page' => '-1',  
	'child_of' => 0,
	'parent' => -1,   
	'offset' => 0,
	'post_type' => 'page',
	'post_status' => 'publish',
); 

$pages12 = get_pages($args); 

?>

<div style="display: flow-root;">


	<button type="button" class="active_btn_g_sett plugify_hide_show_g_settings" id-atr="plgfy_g_tab1" ><i class="fa fa-fw fa-archive" aria-hidden="true"></i> <?php echo esc_html__('Product Discount Settings', 'plugify_qdp'); ?></button>
	<button type="button"  class="plugify_hide_show_g_settings" id-atr="plgfy_g_tab3" ><i class="fa fa-fw fa-shopping-cart" aria-hidden="true"></i> <?php echo esc_html__('Cart Discount Settings', 'plugify_qdp'); ?></button>


<input type="hidden" id="plgfyqdp_savediv1">
<div  id="plgfy_g_tab1" class="plugify_settings_tb" >


<h3 style="font-weight:600; font-size: 21px;font-family: ver;">Shop/Category & Product Page Settings</h3>
<hr >
<table style="width: 97%;margin-left: 1.5%;" class="last_tbl_gnrl_stng stylee">
	<tr>
		<td style="width: 40%;">
			
			<strong>
				Change Color Of Active Discount Range (On Product Page)
			</strong>
			
		</td>
		<td style="width: 60%;">
			<label class="switch">
				<input type="checkbox" id="plgfqdp_dynprc"
				<?php
				if ('true' == $all_gnrl_plgfyqdp_set['plgfqdp_dynprc']) {
					echo filter_var('checked');
				}
				?>
				>
				<span class="slider"></span>
			</label>
			
		</td>

	</tr>
	<tr>
		<td style="width: 40%;">
			
			<strong>
				Active Row Background Color
			</strong>
			
		</td>
		<td style="width: 60%;">
			<input style="width: 32%;" value="<?php echo esc_attr($all_gnrl_plgfyqdp_set['plgfqdp_bg_hvrr_clrr']); ?>" type="color" id="plgfqdp_bg_hvrr_clrr">
		</td>
	</tr>
	<tr>
		<td style="width: 40%;">
			
			<strong>
				Active Row Text Color
			</strong>
			
		</td>
		<td style="width: 60%;">
			<input style="width: 32%;" value="<?php echo esc_attr($all_gnrl_plgfyqdp_set['plgfqdp_hvrrrclr']); ?>" type="color" id="plgfqdp_hvrrrclr">
		</td>
	</tr>
	<tr>
		<td style="width: 40%;">
			
			<strong>
				Show Starting Price (On Shop Page)
			</strong>
			
		</td>
		<td style="width: 60%;">
			<label class="switch">
				<input type="checkbox" id="plgfqdp_shw_strt"
				<?php
				if ('true' == $all_gnrl_plgfyqdp_set['plgfqdp_shw_strt']) {
					echo filter_var('checked');
				}
				?>
				>
				<span class="slider"></span>
			</label>
			
		</td>

	</tr>
	<tr>
		<td style="width: 40%;">
			
			<strong>
				Starting Price Text
			</strong>
			
		</td>
		<td style="width: 60%;">
			
			<input style="width: 32%;"  type="text" id="plgfqdp_shw_strt_txt" value="<?php echo esc_attr($all_gnrl_plgfyqdp_set['plgfqdp_shw_strt_txt']); ?>"	>
			<br>
			<i style="font-size: 12px;">(Use <span style="color: green;">[min_price]</span> shortcode to display minimum price of a product)</i>
				
			
		</td>
	</tr>


	<tr>
		<td style="width: 40%;">
			
			<strong>
				Show Discounted total (On Single Product Page)
			</strong>
			
		</td>
		<td style="width: 60%;">
			<label class="switch">
				<input type="checkbox" id="plgfqdp_shw_dscnt_totl"
				<?php
				if ('true' == $all_gnrl_plgfyqdp_set['plgfqdp_shw_dscnt_totl']) {
					echo filter_var('checked');
				}
				?>
				>
				<span class="slider"></span>
			</label>
			
		</td>

	</tr>
	<tr>
		<td style="width: 40%;">
			
			<strong>
				Discounted Price Label
			</strong>
			
		</td>
		<td style="width: 60%;">
			
			<input type="text" style="width: 32%;"  id="plgfqdp_shw_dscnt_totl_txt" value="<?php echo esc_attr($all_gnrl_plgfyqdp_set['plgfqdp_shw_dscnt_totl_txt']); ?>"	>
			<br>
			<i style="font-size: 12px;">(Use <span style="color: green;">[discounted_total]</span> shortcode to display discounted total of a product)</i>

			
		</td>

	</tr>

	<tr>
		<td style="width: 40%;">
			
			<strong>
				Show Total Amount Saved (On Single Product Page)
			</strong>
			
		</td>
		<td style="width: 60%;">
			<label class="switch">
				<input type="checkbox" id="plgfqdp_shw_amnt_svd"
				<?php
				if ('true' == $all_gnrl_plgfyqdp_set['plgfqdp_shw_amnt_svd']) {
					echo filter_var('checked');
				}
				?>
				>
				<span class="slider"></span>
			</label>
			
		</td>

	</tr>
	<tr>
		<td style="width: 40%;">
			
			<strong>
				Discounted Price Label
			</strong>
			
		</td>
		<td style="width: 60%;">
			
			<input type="text" style="width: 32%;"  id="plgfqdp_shw_amnt_svd_txt" value="<?php echo esc_attr($all_gnrl_plgfyqdp_set['plgfqdp_shw_amnt_svd_txt']); ?>"	>
			<br>
			<i style="font-size: 12px;">(Use <span style="color: green;">[amount_saved]</span> shortcode to display total amount saved of a product)</i>

			
		</td>

	</tr>

	<tr>
		<td style="width: 40%;">
			<br>
			<strong>
				"Discounted Total" and "Amount Saved" Position
			</strong>
			
		</td>
		<td style="width: 60%;">
			<br>
			<select style="width: 32%;" id="plgfyqdp_dt_and_as_position">
				<option value="before_discount_table"
				<?php
				if ('before_discount_table' == $all_gnrl_plgfyqdp_set['plgfyqdp_dt_and_as_position']) {
					echo filter_var('selected');
				}
				?>
				>Before Discount Table</option>
				<option value="after_discount_table"
				<?php
				if ('after_discount_table' == $all_gnrl_plgfyqdp_set['plgfyqdp_dt_and_as_position']) {
					echo filter_var('selected');
				}
				?>
				>After Discount Table</option>
			</select>
			
		</td>

	</tr>


</table>
<hr >
<h3 style="font-weight:600; font-size: 21px;font-family: ver;">Quantity Discount and Coupon Priority Settings</h3>
<hr >
<table style="width: 97%;margin-left: 1.5%;" class="last_tbl_gnrl_stng stylee">
	<tr>
		<td style="width: 40%;">
			
			<strong>
				Discount Priority Settings
			</strong>
			
		</td>
		<td style="width: 60%;">
			
			<input type="radio" id="plgfqdp_apply_both" <?php echo ( 'plgfqdp_apply_both' == $all_gnrl_plgfyqdp_set['plgfqdp_coupon_settings'] ) ? 'checked' : ''; ?> class="plgfqdp_coupon_settings" name="plgfqdp_coupon_settings" value="plgfqdp_apply_both">
			<label for="plgfqdp_apply_both">Apply Both Coupon and Quantity Discounts</label><br>
			<input type="radio" id="plgfqdp_aply_nly_qt_ds" <?php echo ( 'plgfqdp_aply_nly_qt_ds' == $all_gnrl_plgfyqdp_set['plgfqdp_coupon_settings'] ) ? 'checked' : ''; ?> class="plgfqdp_coupon_settings" name="plgfqdp_coupon_settings" value="plgfqdp_aply_nly_qt_ds">
			<label for="plgfqdp_aply_nly_qt_ds">Apply Only Quantity Discount</label><br>  
			<input type="radio" id="plgfqdp_aply_nly_cpn" <?php echo ( 'plgfqdp_aply_nly_cpn' == $all_gnrl_plgfyqdp_set['plgfqdp_coupon_settings'] ) ? 'checked' : ''; ?> class="plgfqdp_coupon_settings" name="plgfqdp_coupon_settings" value="plgfqdp_aply_nly_cpn">
			<label for="plgfqdp_aply_nly_cpn">Apply Only Coupon Discount</label><br>
			<!-- <input type="radio" id="plgfqdp_aply_max" <?php //echo ( 'plgfqdp_aply_max' == $all_gnrl_plgfyqdp_set['plgfqdp_coupon_settings']) ? 'checked' : ''; ?> class="plgfqdp_coupon_settings" name="plgfqdp_coupon_settings" value="plgfqdp_aply_max">
			<label for="plgfqdp_aply_max">Apply Maximum Discount Between Coupon or Quantity Discount</label> -->
		</td>
	</tr>

	<tr>
		<td style="width: 40%;">
			
			<strong>
				Message to Show on Removing Coupon
			</strong>
			
		</td>
		<td style="width: 60%;">
			<input style="width: 70%;" value="<?php echo esc_attr($all_gnrl_plgfyqdp_set['coupon_remove_message']); ?>" type="text" id="coupon_remove_message" >
		</td>
	</tr>


</table>
<hr >
<h3 style="font-weight:600; font-size: 21px;font-family: ver;">Email Data</h3>
<hr>
<table  style="width: 97%;margin-left: 1.5%;" class="last_tbl_gnrl_stng stylee">
	<tr>
		<td style="width: 40%;">
			
			<strong>
				Hide Quantity Discount Data From Emails
			</strong>
			
		</td>
		<td style="width: 60%;">
			<label class="switch">
				<input type="checkbox" id="hide_qty_data_from_email"
				<?php
				if ('true' == $all_gnrl_plgfyqdp_set['hide_qty_data_from_email']) {
					echo filter_var('checked');
				}
				?>
				>
				<span class="slider"></span>
			</label>
			
		</td>

	</tr>
</table>
<hr>
<h3 style="font-weight:600; font-size: 21px;font-family: ver;">Pricing Table Settings</h3>
<hr >
<table style="width: 97%;margin-left: 1.5%;" class="last_tbl_gnrl_stng stylee">
	<tr>
		<td style="width: 40%;">
			
			<strong>
				Use Default Theme Styling
			</strong>
			
		</td>
		<td style="width: 60%;">
			<label class="switch">
				<input type="checkbox" id="plgfqdp_use_Def"
				<?php
				if ('true' == $all_gnrl_plgfyqdp_set['plgfqdp_use_Def']) {
					echo filter_var('checked');
				}
				?>
				>
				<span class="slider"></span>
			</label>
			
		</td>

	</tr>
	<tr>
		<td style="width: 40%;">
			
			<strong>
				Enable Shadow?
			</strong>
			
		</td>
		<td style="width: 60%;">
			<label class="switch">
				<input type="checkbox" id="plgfqdp_enable_shadow"
				<?php
				if ('true' == $all_gnrl_plgfyqdp_set['plgfqdp_enable_shadow']) {
					echo filter_var('checked');
				}
				?>
				>
				<span class="slider"></span>
			</label>
			
		</td>

	</tr>

	<tr>
		<td style="width: 40%;">
			
			<strong>
				Border Radius (px)
			</strong>
			
		</td>
		<td style="width: 60%;">
			<input style="width: 32%;" value="<?php echo esc_attr($all_gnrl_plgfyqdp_set['plgfqdp_brdr_rdius']); ?>" type="number" id="plgfqdp_brdr_rdius" step="0.1" min="0" max="20">
		</td>
	</tr>

	
	<tr>
		<td style="width: 40%;">
			<strong>
				Background Color
			</strong>
			
		</td>
		<td style="width: 60%;">
			<input style="width: 32%;" value="<?php echo esc_attr($all_gnrl_plgfyqdp_set['plgfqdp_bg_color']); ?>" type="color"  id="plgfqdp_bg_color">
		</td>
	</tr>

	<tr>
		<td style="width: 40%;">
			
			<strong>
				Labels Text Color
			</strong>
			
		</td>
		<td style="width: 60%;">
			<input style="width: 32%;" value="<?php echo esc_attr($all_gnrl_plgfyqdp_set['plgfqdp_lbl_txt_color']); ?>" type="color" id="plgfqdp_lbl_txt_color">
		</td>
	</tr>
		<tr>
		<td style="width: 40%;">
			<strong>
				Table Head Background Color
			</strong>
			
		</td>
		<td style="width: 60%;">
			<input style="width: 32%;" value="<?php echo esc_attr($all_gnrl_plgfyqdp_set['plgfqdp_tblhd_bg_color']); ?>" type="color"  id="plgfqdp_tblhd_bg_color">
		</td>
	</tr>
	<tr>
		<td style="width: 40%;">
			<strong>
				Table Head Labels Color
			</strong>
			
		</td>
		<td style="width: 60%;">
			<input style="width: 32%;" value="<?php echo esc_attr($all_gnrl_plgfyqdp_set['plgfqdp_tblhd_lbl_color']); ?>" type="color"  id="plgfqdp_tblhd_lbl_color">
		</td>
	</tr>
	<tr style="border-bottom: 1px solid #f1f1f1;">
		<td style="width: 40%;">
			
			<strong>
				Padding (px)
			</strong>
			<br>
			<br>
			
		</td>
		<td style="width: 60%;">
			<input value="<?php echo esc_attr($all_gnrl_plgfyqdp_set['plgfqdp_padding_t']); ?>" type="number" style="width: 11%;" id="plgfqdp_padding_t" step="0.1" min="0" max="20" >
			<input value="<?php echo esc_attr($all_gnrl_plgfyqdp_set['plgfqdp_padding_r']); ?>" type="number" style="width: 11%;" id="plgfqdp_padding_r" step="0.1" min="0" max="20">
			<input value="<?php echo esc_attr($all_gnrl_plgfyqdp_set['plgfqdp_padding_b']); ?>" type="number" style="width: 11%;" id="plgfqdp_padding_b" step="0.1" min="0" max="20">
			<input value="<?php echo esc_attr($all_gnrl_plgfyqdp_set['plgfqdp_padding_l']); ?>" type="number" style="width: 11%;" id="plgfqdp_padding_l" step="0.1" min="0" max="20">
			<br>
			<i style="margin-left: 3%;">Top</i>
			<i style="margin-left: 6.5%;">Right</i>
			<i style="margin-left: 4.5%;">Bottom</i>
			<i style="margin-left: 5.5%;">Left</i>
			<br>
			<br>
		</td>
	</tr>
	<tr>
		<td style="width: 40%;">
			<strong>
				Check Coulumns To Show & Set Texts
			</strong>
			
		</td>
		<td style="width: 60%;">
			<?php
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
			?>
			<table style="width:100%;">
				<tr>
					<th>Column 1
						<input type="checkbox" id="quantitycol" style="margin: 0px 5px !important;"
						<?php
						if ('true' == $quantitycol) {
							echo filter_var('checked');
						}
						?>
						>
					</th>
					<th>
						Column 2
						<input type="checkbox" id="discountcol" style="margin: 0px 5px !important;"
						<?php
						if ('true' == $discountcol) {
							echo filter_var('checked');
						}
						?>
						>
					</th>
					<th>
						Column 3
						<input type="checkbox" id="peritemcol" style="margin: 0px 5px !important;"
						<?php
						if ('true' == $peritemcol) {
							echo filter_var('checked');
						}
						?>
						>
					</th>

				</tr>
				<tr>
					<td>
						<input style="width: 100%;" type="text" id="col1qtytext" value="<?php echo esc_attr($all_gnrl_plgfyqdp_set['col1qtytext']); ?>">
					</td>
					<td>
						<input style="width: 100%;" type="text" id="col1distext" value="<?php echo esc_attr($all_gnrl_plgfyqdp_set['col1distext']); ?>">
					</td>
					<td>
						<input style="width: 100%;" type="text" id="col1pertext" value="<?php echo esc_attr($all_gnrl_plgfyqdp_set['col1pertext']); ?>">
					</td>
				</tr>

			</table>



		</td>
	</tr>
	<tr>
		<td style="width: 40%;">
			<br>
			<strong>
				Table Position
			</strong>
			
		</td>
		<td style="width: 60%;">
			<br>
			<select style="width: 32%;" id="plgfyqdp_table_position">
				<option value="woocommerce_before_add_to_cart_form"
				<?php
				if ('woocommerce_before_add_to_cart_form' == $all_gnrl_plgfyqdp_set['plgfyqdp_table_position']) {
					echo filter_var('selected');
				}
				?>
				>Before Add To Cart Form</option>
				<option value="woocommerce_after_add_to_cart_form"
				<?php
				if ('woocommerce_after_add_to_cart_form' == $all_gnrl_plgfyqdp_set['plgfyqdp_table_position']) {
					echo filter_var('selected');
				}
				?>
				>After Add To Cart Form</option>
				<option value="woocommerce_after_single_product_summary"
				<?php
				if ('woocommerce_after_single_product_summary' == $all_gnrl_plgfyqdp_set['plgfyqdp_table_position']) {
					echo filter_var('selected');
				}
				?>
				>After Product Summary</option>
			</select>
			
		</td>

	</tr>
	<tr>
		<td style="width: 40%;">
			
			<strong>
				Content Before Table
			</strong>
			
		</td>
		<td style="width: 60%;">
			<?php 

			$plgfyqdp_content   = preg_replace('/\\\\/', '', stripcslashes( $all_gnrl_plgfyqdp_set['before_content_plugify']) );
			$plgfyqdp_editor_ep_id = 'before_content_plugify';
			$plgfyqdp_settings_array = array(
				'editor_height' => 120,
			);
			wp_editor( $plgfyqdp_content, $plgfyqdp_editor_ep_id, $plgfyqdp_settings_array );
			?>
			<hr>
		</td>

	</tr>
	<tr>
		<td style="width: 40%;">
			
			<strong>
				Content After Table
			</strong>
			
		</td>
		<td style="width: 60%;">
			<?php 
			$plgfyqdp_content   = preg_replace('/\\\\/', '', stripcslashes( $all_gnrl_plgfyqdp_set['after_content_plugify']) );
			$plgfyqdp_editor_ep_id = 'after_content_plugify';
			$plgfyqdp_settings_array = array(
				'editor_height' => 120,
			);
			wp_editor( $plgfyqdp_content, $plgfyqdp_editor_ep_id, $plgfyqdp_settings_array );
			?>
			
		</td>

	</tr>
</table>
<hr >
<h3 style="font-weight:600; font-size: 21px;font-family: ver;">Custom Styling</h3>
<hr >
<table style="width: 97%;margin-left: 1.5%;" class="last_tbl_gnrl_stng stylee">
	<tr>
		<td style="width: 40%;">
			<strong>
				Custom Css
			</strong>
		</td>
		<td style="width: 60%;">
			<?php
			$style_plugify_content=$all_gnrl_plgfyqdp_set['style_plugify_content'];

			?>
			<textarea id="style_plugify_content" cols="70" rows="5" placeholder="<style>&#10;.plugify_before_table_content_parent_div {&#10;   width:50% !important;&#10;}&#10;</style>"><?php echo esc_attr($style_plugify_content); ?></textarea>
		</td>

	</tr>
	<tr>
		<td style="width: 40%;">
			<strong>Use These classes in custom css</strong>
		</td>
		<td style="width: 60%;border: 1px solid #eee !important;font-style: italic;">
			Main parent class: .plugify_main_parent_div<br>
			.plugify_before_table_content_parent_div<br>
			.plugify_after_table_content_parent_div<br><br>

			Table's Parent class: .plugify_table_parent_div<br>
			Table Class: .tbloo_fine_trash_plugifyy<br>
			Table rows: .plugify_tbl_row<br><br>
			Columns: <br>
			.plugify_qty_col<br>
			.plugify_typ_col<br>
			.plugify_pip_col<br>
		</td>
	</tr>
</table>
</div>

<div  id="plgfy_g_tab3" class="plugify_settings_tb" style="display:none;" >
	
	<h3 style="font-weight:600; font-size: 21px;font-family: ver;">Cart Discount Rule Settings</h3>

	<hr>
	<table style="width: 97%;margin-left: 1.5%;" class="last_tbl_gnrl_stng stylee">


		<tr>
			<td style="width: 40%;">

				<strong>
					Apply Multiple Discount
				</strong> <br>
				<i>(If checked, multiple discount rules (cart discount) will be applied if the rules fulfill the required conditions.)</i>

			</td>
			<td style="width: 40%;">
				<label class="switch">
					<input type="checkbox" id="plgfqdp_apply_multiple_discount"
					<?php
					if ('true' == $all_gnrl_plgfyqdp_set['plgfqdp_apply_multiple_discount']) {
						echo filter_var('checked');
					}
					?>
					>
					<span class="slider"></span>
				</label>

			</td>
			<td style="width: 20%;">

			</td>

		</tr>

		<tr>
			<td style="width: 40%;">

				<strong>
					Choose Discount Rule to be Applied
				</strong>

			</td>
			<td style="width: 40%;">
				<select class="plugify_multiple_disble_check" style="width: 50%;" value="<?php echo esc_attr($all_gnrl_plgfyqdp_set['plugify_discount_tobe_applied']); ?>" id="plugify_discount_tobe_applied">
					<option value='min_in_rule' <?php echo ( isset( $all_gnrl_plgfyqdp_set['plugify_discount_tobe_applied'] ) && 'min_in_rule' == $all_gnrl_plgfyqdp_set['plugify_discount_tobe_applied'] ) ? 'selected' : ''; ?> >Rule with Minimum Discount</option>
					<option value='max_in_rule' <?php echo ( isset( $all_gnrl_plgfyqdp_set['plugify_discount_tobe_applied'] ) && 'max_in_rule' == $all_gnrl_plgfyqdp_set['plugify_discount_tobe_applied'] ) ? 'selected' : ''; ?> >Rule with Maximum Discount</option>
				</select>
			</td>
			<td style="width: 20%;">
			</td>
		</tr>



	</table>

	<hr>
	<h3 style="font-weight:600; font-size: 21px;font-family: ver;">Discount Offers Button Settings</h3>

	<hr>
	<table style="width: 97%;margin-left: 1.5%;" class="last_tbl_gnrl_stng stylee">
		<tr>
			<td style="width: 40%;">

				<strong>
					Show Button to View Discount Offers
				</strong> <br>
				<i>(Show button if any cart rule exists)</i>

			</td>
			<td style="width: 40%;">
				<label class="switch">
					<input type="checkbox" id="plgfqdp_show_offers_button"
					<?php
					if ('true' == $all_gnrl_plgfyqdp_set['plgfqdp_show_offers_button']) {
						echo filter_var('checked');
					}
					?>
					>
					<span class="slider"></span>
				</label>

			</td>
			<td style="width: 20%;">

				<?php
				if (isset($all_gnrl_plgfyqdp_set['plgfqdp_offers_button_text']) && !empty($all_gnrl_plgfyqdp_set['plgfqdp_offers_button_text'])) {
					$button_text = $all_gnrl_plgfyqdp_set['plgfqdp_offers_button_text'];
				} else {
					$button_text = 'Sample Button';
				}
				?>

				<button type="button" id="plugify_sample_button"><?php echo esc_attr($button_text); ?></button>
			</td>

		</tr>


		<tr>
			<td style="width: 40%;">

				<strong>
					Discount Offers Button Text
				</strong>

			</td>
			<td style="width: 40%;">

				<input class="plugify_offer_disble_check" style="width: 50%;"  type="text" id="plgfqdp_offers_button_text" value="<?php echo esc_attr($all_gnrl_plgfyqdp_set['plgfqdp_offers_button_text']); ?>" >
				<br>
			</td>
			<td style="width: 20%;">
			</td>
		</tr>


		<tr>
			<td style="width: 40%;">

				<strong>
					Discount Offers Button Text Color
				</strong>

			</td>
			<td style="width: 40%;">
				<input class="plugify_offer_disble_check" style="width: 50%;" value="<?php echo esc_attr($all_gnrl_plgfyqdp_set['plgfqdp_offers_button_text_color']); ?>" type="color" id="plgfqdp_offers_button_text_color">
			</td>
			<td style="width: 20%;">
			</td>
		</tr>

		<tr>
			<td style="width: 40%;">

				<strong>
					Discount Offers Button Font Size (px)
				</strong>

			</td>
			<td style="width: 40%;">
				<input class="plugify_offer_disble_check" style="width: 50%;" value="<?php echo esc_attr($all_gnrl_plgfyqdp_set['plgfqdp_offers_button_text_size']); ?>" type="number" id="plgfqdp_offers_button_text_size">
			</td>
			<td style="width: 20%;">
			</td>
		</tr>

		<tr>
			<td style="width: 40%;">

				<strong>
					Discount Offers Button Font Weight
				</strong>

			</td>
			<td style="width: 40%;">
				<select class="plugify_offer_disble_check" style="width: 50%;" value="<?php echo esc_attr($all_gnrl_plgfyqdp_set['plgfqdp_offers_button_text_weight']); ?>" id="plgfqdp_offers_button_text_weight">
					
					<option value=''>Select Font Weight</option>
					<option value='200' <?php echo ( isset( $all_gnrl_plgfyqdp_set['plgfqdp_offers_button_text_weight'] ) && '200' == $all_gnrl_plgfyqdp_set['plgfqdp_offers_button_text_weight'] ) ? 'selected' : ''; ?> >200</option>
					<option value='300' <?php echo ( isset( $all_gnrl_plgfyqdp_set['plgfqdp_offers_button_text_weight'] ) && '300' == $all_gnrl_plgfyqdp_set['plgfqdp_offers_button_text_weight'] ) ? 'selected' : ''; ?> >300</option>
					<option value='400' <?php echo ( isset( $all_gnrl_plgfyqdp_set['plgfqdp_offers_button_text_weight'] ) && '400' == $all_gnrl_plgfyqdp_set['plgfqdp_offers_button_text_weight'] ) ? 'selected' : ''; ?> >400</option>
					<option value='500' <?php echo ( isset( $all_gnrl_plgfyqdp_set['plgfqdp_offers_button_text_weight'] ) && '500' == $all_gnrl_plgfyqdp_set['plgfqdp_offers_button_text_weight'] ) ? 'selected' : ''; ?> >500</option>
					<option value='600' <?php echo ( isset( $all_gnrl_plgfyqdp_set['plgfqdp_offers_button_text_weight'] ) && '600' == $all_gnrl_plgfyqdp_set['plgfqdp_offers_button_text_weight'] ) ? 'selected' : ''; ?> >600</option>
					<option value='700' <?php echo ( isset( $all_gnrl_plgfyqdp_set['plgfqdp_offers_button_text_weight'] ) && '700' == $all_gnrl_plgfyqdp_set['plgfqdp_offers_button_text_weight'] ) ? 'selected' : ''; ?> >700</option>
					<option value='800' <?php echo ( isset( $all_gnrl_plgfyqdp_set['plgfqdp_offers_button_text_weight'] ) && '800' == $all_gnrl_plgfyqdp_set['plgfqdp_offers_button_text_weight'] ) ? 'selected' : ''; ?> >800</option>
					<option value='900' <?php echo ( isset( $all_gnrl_plgfyqdp_set['plgfqdp_offers_button_text_weight'] ) && '900' == $all_gnrl_plgfyqdp_set['plgfqdp_offers_button_text_weight'] ) ? 'selected' : ''; ?> >900</option>

				</select>
			</td>
			<td style="width: 20%;">
			</td>
		</tr>

		<tr>
			<td style="width: 40%;">

				<strong>
					Discount Offers Button Background Color
				</strong>

			</td>
			<td style="width: 40%;">
				<input class="plugify_offer_disble_check" style="width: 50%;" value="<?php echo esc_attr($all_gnrl_plgfyqdp_set['plgfqdp_offers_button_bg_color']); ?>" type="color" id="plgfqdp_offers_button_bg_color">
			</td>
			<td style="width: 20%;">
			</td>
		</tr>
		<tr>
			<td style="width: 40%;">

				<strong>
					Discount Offers Button Radius
				</strong>

			</td>
			<td style="width: 40%;">
				<input class="plugify_offer_disble_check" style="width: 50%;" value="<?php echo esc_attr($all_gnrl_plgfyqdp_set['plgfqdp_offers_button_radius']); ?>" type="number" id="plgfqdp_offers_button_radius">
			</td>
			<td style="width: 20%;">
			</td>
		</tr>
		<tr>
			<td style="width: 40%;">

				<strong>
					Enable Discount Button Shadow
				</strong>

			</td>
			<td style="width: 40%;">
				<label class="switch">
					<input class="plugify_offer_disble_check" type="checkbox" id="plgfqdp_offers_button_shadow"
					<?php
					if ('true' == $all_gnrl_plgfyqdp_set['plgfqdp_offers_button_shadow']) {
						echo filter_var('checked');
					}
					?>
					>
					<span class="plugify_offer_disble_check slider"></span>
				</label>

			</td>
			<td style="width: 20%;">
				
			</td>

		</tr>
		<tr>
			<td style="width: 40%;">

				<strong>
					Discount Offers Button Shadow Color
				</strong>

			</td>
			<td style="width: 40%;">
				<input  class="plugify_offer_disble_check"  style="width: 50%;" value="<?php echo esc_attr($all_gnrl_plgfyqdp_set['plgfqdp_offers_button_shadow_color']); ?>" type="color" id="plgfqdp_offers_button_shadow_color">
			</td>
			<td style="width: 20%;">
			</td>
		</tr>


		<tr>
			<td style="width:40%;">
				<strong >
					Show Discount Offers Button On Specific Pages
				</strong>
			</td>
			<td style="width:40%;margin-left: 3%;">

				<select  class="plugify_offer_disble_check"  multiple style="max-width: 70%;width: 70%;font-size: 11px;"id="plugify_button_select_pages">
					<?php
					foreach ($pages12 as $page5) { 

						?>
						<option value="<?php echo filter_var($page5->ID); ?>"
							<?php
							if (isset($all_gnrl_plgfyqdp_set['plugify_button_select_pages'])) {
								if (in_array($page5->ID, $all_gnrl_plgfyqdp_set['plugify_button_select_pages'])) {
									echo filter_var('selected');
								}
							}
							?>
						><?php echo filter_var(get_the_title($page5->ID)); ?></option>
						<?php

					}
					?>
					</select><br>
					<i>(Discount offers button will be shown on whole site if no page is selected.)</i>
				</td>
				<td style="width: 20%;">
			</td>
			</tr>
		</table>
		<hr>
		<h3 style="font-weight:600; font-size: 21px;font-family: ver;">Pop Up Settings</h3>

		<hr>
		<table style="width: 97%;margin-left: 1.5%;" class="last_tbl_gnrl_stng stylee">

			<tr>
				<td style="width: 40%;">

					<strong>
						Discount Offers Popup Background Color
					</strong>

				</td>
				<td style="width: 40%;">
					<input  class="plugify_offer_disble_check"  style="width: 33%;" value="<?php echo esc_attr($all_gnrl_plgfyqdp_set['plgfqdp_offers_popup_bg_color']); ?>" type="color" id="plgfqdp_offers_popup_bg_color">
				</td>
				
			</tr>
			<tr>
				<td style="width: 40%;">

					<strong>
						Discount Offers Popup Text Color
					</strong>

				</td>
				<td style="width: 40%;">
					<input  class="plugify_offer_disble_check"  style="width: 33%;" value="<?php echo esc_attr($all_gnrl_plgfyqdp_set['plgfqdp_offers_popup_txt_color']); ?>" type="color" id="plgfqdp_offers_popup_txt_color">
				</td>
				
			</tr>
			<tr>
				<td style="width: 40%;">

					<strong>
						Discount Offers Popup Heading Text
					</strong>

				</td>
				<td style="width: 40%;">
					<input  class="plugify_offer_disble_check"  style="width: 33%;" value="<?php echo esc_attr($all_gnrl_plgfyqdp_set['plgfqdp_offers_popup_hd_text']); ?>" type="text" id="plgfqdp_offers_popup_hd_text">
				</td>
			
			</tr>
			<tr>
				<td style="width: 40%;">

					<strong>
						Discount Offers Popup Heading Background Color
					</strong>

				</td>
				<td style="width: 40%;">
					<input  class="plugify_offer_disble_check"  style="width: 33%;" value="<?php echo esc_attr($all_gnrl_plgfyqdp_set['plgfqdp_offers_popup_hd_bg_clr']); ?>" type="color" id="plgfqdp_offers_popup_hd_bg_clr">
				</td>
				
			</tr>

			<tr>
				<td style="width: 40%;">

					<strong>
						Discount Offers Popup Heading Text Color
					</strong>

				</td>
				<td style="width: 40%;">
					<input  class="plugify_offer_disble_check"  style="width: 33%;" value="<?php echo esc_attr($all_gnrl_plgfyqdp_set['plgfqdp_offers_popup_hd_text_color']); ?>" type="color" id="plgfqdp_offers_popup_hd_text_color">
				</td>
				
			</tr>

			<tr>
				<td style="width: 40%;">

					<strong>
						Discount Offer Popup Content
					</strong>

				</td>
				<td style="width: 60%;">
					<?php


					if (isset($all_gnrl_plgfyqdp_set['plgfqdp_offers_popup_content'])) {
						$editor_content = $all_gnrl_plgfyqdp_set['plgfqdp_offers_popup_content'];
					} else {
						$editor_content = '<h4><strong>You can avail undermentioned discount amounts</strong></h4>
						[quantity_table]<br><strong>Conditions to be met: </strong><br>[conditions_table]';
					}


					$args = array(
						'editor_height' => 170,
					);
					wp_editor( $editor_content, 'plgfqdp_offers_popup_content', $args );
					?>
					<p>
						<i>Use shortcode <strong>[quantity_table]</strong> to display Quantity range table and <strong>[conditions_table]</strong> to display Conditions in popup (front-end).</i>
					</p>
				</td>
				
			</tr>



		</table>
	<hr>

</div>
		<button style="float: left;" type="button" id="plgfyqdp_save_gnrl_settings" class="button-primary">Save Settings</button>
</div>

<script type="text/javascript">
	jQuery(document).ready(function(){
		jQuery('body').on('click', '.plugify_hide_show_g_settings', function(){
			jQuery('.plugify_settings_tb').hide();
			jQuery('.plugify_hide_show_g_settings').removeClass('active_btn_g_sett');
			jQuery(this).addClass('active_btn_g_sett');
			jQuery('#'+jQuery(this).attr('id-atr')).show();

		});
	
		jQuery('#plugify_button_select_pages').select2();



		jQuery('#plugify_sample_button').on('click', function(e){
			e.preventDefault();
		});



		jQuery('#plgfqdp_offers_button_shadow_color').on('input', function(e){
			jQuery('#plugify_sample_button').css('box-shadow', '0 8px 16px 0 '+jQuery(this).val()+', 0 6px 20px 0 '+jQuery(this).val());
		});

		jQuery('#plgfqdp_offers_button_bg_color').on('input', function(e){
			jQuery('#plugify_sample_button').css('background-color', jQuery(this).val());
		});

		jQuery('#plgfqdp_offers_button_text_color').on('input', function(e){
			jQuery('#plugify_sample_button').css('color', jQuery(this).val());
		});

		jQuery('#plgfqdp_offers_button_text').on('input', function(e){
			jQuery('#plugify_sample_button').html(jQuery(this).val());
		});

		jQuery('#plgfqdp_offers_button_text_size').on('input', function(e){
			jQuery('#plugify_sample_button').css('font-size', jQuery(this).val()+'px');
		});

		jQuery('#plgfqdp_offers_button_text_weight').on('input', function(e){
			jQuery('#plugify_sample_button').css('font-weight', jQuery(this).val());
		});

		jQuery('#plgfqdp_offers_button_radius').on('input', function(e){
			jQuery('#plugify_sample_button').css('border-radius', jQuery(this).val()+'px');
		});

		jQuery('#plgfqdp_show_offers_button').on('change', function(){
			if (jQuery(this).prop('checked') == false) {
				jQuery('.plugify_offer_disble_check').css('cursor', 'not-allowed');
				jQuery('.plugify_offer_disble_check').prop('disabled', 'disabled');
			} else {
				jQuery('.plugify_offer_disble_check').css('cursor', 'default');
				jQuery('.plugify_offer_disble_check').prop('disabled', false);	
			}
		});


		if (jQuery('#plgfqdp_show_offers_button').prop('checked') == false) {
			jQuery('.plugify_offer_disble_check').css('cursor', 'not-allowed');
			jQuery('.plugify_offer_disble_check').prop('disabled', 'disabled');
		} else {
			jQuery('.plugify_offer_disble_check').css('cursor', 'default');
			jQuery('.plugify_offer_disble_check').prop('disabled', false);
			if (jQuery('#plgfqdp_offers_button_shadow').prop('checked') == false) {
				jQuery('#plgfqdp_offers_button_shadow_color').css('cursor', 'not-allowed');
				jQuery('#plgfqdp_offers_button_shadow_color').prop('disabled', 'disabled');
				jQuery('#plugify_sample_button').css('box-shadow', 'unset');
			} else {
				jQuery('#plgfqdp_offers_button_shadow_color').css('cursor', 'default');
				jQuery('#plgfqdp_offers_button_shadow_color').prop('disabled', false);
				jQuery('#plugify_sample_button').css('box-shadow', '0 8px 16px 0 '+jQuery('#plgfqdp_offers_button_shadow_color').val()+', 0 6px 20px 0 '+jQuery('#plgfqdp_offers_button_shadow_color').val());			
			}
		}



		jQuery('#plgfqdp_offers_button_shadow').on('change', function(){
			if (jQuery(this).prop('checked') == false) {
				jQuery('#plgfqdp_offers_button_shadow_color').css('cursor', 'not-allowed');
				jQuery('#plgfqdp_offers_button_shadow_color').prop('disabled', 'disabled');
				jQuery('#plugify_sample_button').css('box-shadow', 'unset');
			} else {
				jQuery('#plgfqdp_offers_button_shadow_color').css('cursor', 'default');
				jQuery('#plgfqdp_offers_button_shadow_color').prop('disabled', false);
				jQuery('#plugify_sample_button').css('box-shadow', '0 8px 16px 0 '+jQuery('#plgfqdp_offers_button_shadow_color').val()+', 0 6px 20px 0 '+jQuery('#plgfqdp_offers_button_shadow_color').val());			
			}
		});






		jQuery('#plgfqdp_apply_multiple_discount').on('change', function(){
			if (jQuery(this).prop('checked') == true) {
				jQuery('.plugify_multiple_disble_check').css('cursor', 'not-allowed');
				jQuery('.plugify_multiple_disble_check').prop('disabled', 'disabled');
			} else {
				jQuery('.plugify_multiple_disble_check').css('cursor', 'default');
				jQuery('.plugify_multiple_disble_check').prop('disabled', false);
			}
		});

		if (jQuery('#plgfqdp_apply_multiple_discount').prop('checked') == true) {
			jQuery('.plugify_multiple_disble_check').css('cursor', 'not-allowed');
			jQuery('.plugify_multiple_disble_check').prop('disabled', 'disabled');
		} else {
			jQuery('.plugify_multiple_disble_check').css('cursor', 'default');
			jQuery('.plugify_multiple_disble_check').prop('disabled', false);
		}


		jQuery('#plgfqdp_shw_strt').on('change', function(){
			if (jQuery(this).prop('checked') == false) {
				jQuery('#plgfqdp_shw_strt_txt').css('cursor', 'not-allowed');
				jQuery('#plgfqdp_shw_strt_txt').prop('disabled', 'disabled');
			} else {
				jQuery('#plgfqdp_shw_strt_txt').css('cursor', 'default');
				jQuery('#plgfqdp_shw_strt_txt').prop('disabled', false);
			}
		});

		if (jQuery('#plgfqdp_shw_strt').prop('checked') == false) {
			jQuery('#plgfqdp_shw_strt_txt').css('cursor', 'not-allowed');
			jQuery('#plgfqdp_shw_strt_txt').prop('disabled', 'disabled');
		} else {
			jQuery('#plgfqdp_shw_strt_txt').css('cursor', 'default');
			jQuery('#plgfqdp_shw_strt_txt').prop('disabled', false);
		}



		jQuery('#plgfqdp_shw_dscnt_totl').on('change', function(){
			if (jQuery(this).prop('checked') == false) {
				jQuery('#plgfqdp_shw_dscnt_totl_txt').css('cursor', 'not-allowed');
				jQuery('#plgfqdp_shw_dscnt_totl_txt').prop('disabled', 'disabled');
			} else {
				jQuery('#plgfqdp_shw_dscnt_totl_txt').css('cursor', 'default');
				jQuery('#plgfqdp_shw_dscnt_totl_txt').prop('disabled', false);
			}
		});

		if (jQuery('#plgfqdp_shw_dscnt_totl').prop('checked') == false) {
			jQuery('#plgfqdp_shw_dscnt_totl_txt').css('cursor', 'not-allowed');
			jQuery('#plgfqdp_shw_dscnt_totl_txt').prop('disabled', 'disabled');
		} else {
			jQuery('#plgfqdp_shw_dscnt_totl_txt').css('cursor', 'default');
			jQuery('#plgfqdp_shw_dscnt_totl_txt').prop('disabled', false);
		}


		jQuery('#plgfqdp_shw_amnt_svd').on('change', function(){
			if (jQuery(this).prop('checked') == false) {
				jQuery('#plgfqdp_shw_amnt_svd_txt').css('cursor', 'not-allowed');
				jQuery('#plgfqdp_shw_amnt_svd_txt').prop('disabled', 'disabled');
			} else {
				jQuery('#plgfqdp_shw_amnt_svd_txt').css('cursor', 'default');
				jQuery('#plgfqdp_shw_amnt_svd_txt').prop('disabled', false);
			}
		});

		if (jQuery('#plgfqdp_shw_amnt_svd').prop('checked') == false) {
			jQuery('#plgfqdp_shw_amnt_svd_txt').css('cursor', 'not-allowed');
			jQuery('#plgfqdp_shw_amnt_svd_txt').prop('disabled', 'disabled');
		} else {
			jQuery('#plgfqdp_shw_amnt_svd_txt').css('cursor', 'default');
			jQuery('#plgfqdp_shw_amnt_svd_txt').prop('disabled', false);
		}






	});
</script>

<style type="text/css">
	.stylee td, .stylee th {
		border: unset !important;
		padding: 6px;

	}

	.plugify_hide_show_g_settings{
		cursor: pointer;
		line-height: 2.15384615;
		min-height: 30px;
		border-radius: 0px !important;		
		background-color: #f0f0f1 !important;		
		color: #46494c !important;
		margin-right: 5px !important;
		border: unset !important;
		font-weight: 600 !important;
	}

	.active_btn_g_sett{
		color: #ae7b3b !important;		
		font-weight: 900 !important;
		border-bottom: unset !important;
	}


	#plugify_sample_button {
		background-color: <?php echo esc_attr($all_gnrl_plgfyqdp_set['plgfqdp_offers_button_bg_color']); ?>;
		color: <?php echo esc_attr($all_gnrl_plgfyqdp_set['plgfqdp_offers_button_text_color']); ?>;
		border-radius: <?php echo esc_attr($all_gnrl_plgfyqdp_set['plgfqdp_offers_button_radius']); ?>px;
		font-size: <?php echo esc_attr($all_gnrl_plgfyqdp_set['plgfqdp_offers_button_text_size']); ?>px;
		font-weight: <?php echo esc_attr($all_gnrl_plgfyqdp_set['plgfqdp_offers_button_text_weight']); ?>;
		padding: 15px 32px;
		text-align: center;
		/*z-index: 9999999;*/
		cursor: pointer;
		position: absolute;
		border: unset;
		box-shadow: 0 8px 16px 0 <?php echo esc_attr($all_gnrl_plgfyqdp_set['plgfqdp_offers_button_shadow_color']); ?>, 0 6px 20px 0 <?php echo esc_attr($all_gnrl_plgfyqdp_set['plgfqdp_offers_button_shadow_color']); ?>;
	}
	.modal-content{
		filter: blur(0px) !important;
	}
 
</style>
