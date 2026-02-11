<?php
$plgfyqdp_all_rules=get_option('plgfyqdp_all_rules');
if ('' == $plgfyqdp_all_rules) {
	$plgfyqdp_all_rules = array();
}


$count123=count($plgfyqdp_all_rules);


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
<input value='<?php echo esc_html($plgfyqbd_product_category_html); ?>' type="hidden" id="plgfyqbd_cats" >
<input value='<?php echo esc_html($plgfyqbd_roles_html); ?>' type="hidden" id="plgfyqbd_roles" >




<input type="hidden" id="plgfyqdp_savediv_cart">
<h3 style="font-weight:600; font-size: 21px;font-family: ver;">	
	<i class="fa fa-hand-o-right" aria-hidden="true"></i>
	All Rules  <i style="font-size:14px;font-style: italic;color: green;">(These rules will add discount in cart totals based on cart items count or some other specific conditions.)</i>           
</h3>
<hr>
<table style="width: 100%;">
	<tr>
		<td style="vertical-align:bottom;float: right;">
			<button class="button-primary" type="button" style="background-color: green;border-color: green;" id="plgfyqdp_create_qty_rule_cart">
				<i class="fa fa-fw fa-plus"></i>
			Add Rule(s)</button>
			

		</td>
	</tr>
</table>
<br>
<br>
<div style="overflow:auto; width: 100%;">
<table id="plgfyqdp_cart_datatables" class="table table-striped" style="width: 100%;">
	<thead>
		<tr> 
			<th style="width:15%;" class="name"><?php echo esc_html__('Rule Name' , 'plugify_qdp'); ?></th>
			 <!-- <th class="name" ><?php //echo esc_html__('Applied On' , 'plugify_qdp'); ?></th>			 -->
			<th class="" ><?php echo esc_html__('Work with Product Discount' , 'plugify_qdp'); ?></th>
			<th class="status" ><?php echo esc_html__('Status' , 'plugify_qdp'); ?></th>			
			<th style="width: 20%;" class="" ><?php echo esc_html__('Action' , 'plugify_qdp'); ?></th> 
			
		</tr>
	</thead>
	<tbody >

	</tbody>
	<tfoot>
		<tr>
			<th style="width:15%;" class="name"><?php echo esc_html__('Rule Name' , 'plugify_qdp'); ?></th>
			<!-- <th class="name" ><?php //echo esc_html__('Applied On' , 'plugify_qdp'); ?></th> -->
			<th class="" ><?php echo esc_html__('Work with Product Discount' , 'plugify_qdp'); ?></th>
			<th class="status" ><?php echo esc_html__('Status' , 'plugify_qdp'); ?></th>			
			<th style="width: 20%;" class="" ><?php echo esc_html__('Action' , 'plugify_qdp'); ?></th> 
			
		</tr>
	</tfoot>
</table>
</div>
<div class="modal " id="modalplgfy_cart" role="dialog" style="display: none;">
		<div class="modal-content modal-content112">
			<div class="modal-header" style="">
				<button type="button" class="close"style="color: red !important; opacity: 1;" data-dismiss="modal">&times;</button>
				
				<h1 class="modal-title" style="color: #000 !important; font-family: verdena;">Add Cart Discount Rule</h1>

				
			</div>
			<hr>
			<div class="modal-body animate__animated animate__flash" >
				

				<div class="plugify_bordered">
					<div style="display: inline-flex;width:100%;">
						<div style="width:60%;">
							<strong>Activate Rule</strong>
							<label class="switch">
								<input type="checkbox" checked id="plgfydc_activate_cart_rule">
								<span class="slider"></span>
							</label>
						</div>
						<div style="width:40%;text-align: right;">
							<strong>Rule Name</strong>
							<input type="text" id="plugify_cart_r_name" value="">
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
								<input type="checkbox" id="plgfydc_work_with_quant">
								<!-- <span class="slider"></span> -->
							</label>
						</div>

						<div style="width:50%; text-align: right;">
							<strong>Cart Discount Text <abbr class="required" title="required">*</abbr></strong>
							<div class="plugify_tooltip">
								<span class="dashicons dashicons-editor-help"></span>
								<span class="plugify_tooltiptext">This text will be shown in cart totals. It must be unique and two different rules should not have same text.</span>
							</div>
							<input type="text" id="plugify_cart_discount_text" value="" placeholder="e.g Special Discount">
							<br>
							<i>Please use unique cart discount text in all rules</i>
						</div>

					</div>

					<br>
				</div>
				<div class="cart_ranges_based_table plugify_bordered" style="margin-top:1%;">
					<label><strong>Don't want to apply a discount based on cart item quantity?</strong>
						<div class="plugify_tooltip">
						<span class="dashicons dashicons-editor-help"></span>
						<span class="plugify_tooltiptext">If checked, number of cart items will be ignored while applying discount on the cart totals.</span>
					</div>
					<input type="checkbox" class='plgfy_apl_al_qntits' id="plgfy_apl_al_qntits" name="plgfy_apl_al_qntits"></label><br>
					<button class="button-primary plgfyqdp_add_cart_ranges plugfy_hd_sh_qnty"  type="button" style="background-color: green;border-color: green;float: right;">
						<i class="fa fa-fw fa-plus"></i>
					Add Range(s)</button>
					<!-- <strong>Set Discount on Cart</strong> <strong class="plugfy_hd_sh_qnty"> Item's Quantity Ranges</strong> -->
					<table class="plgfy_add_modal_table last_tbl_gnrl_stng " style="margin-top: 2%;">
						<tr>
							<th class="plugfy_hd_sh_qnty" style="width: 22.5%;">
								Start Range <abbr class="required" title="required">*</abbr>
							</th>
							<th class="plugfy_hd_sh_qnty" style="width: 22.5%;">
								End Range <abbr class="required" title="required">*</abbr>
							</th>
							<th style="width: 22.5%;">
								Discount Type <abbr class="required" title="required">*</abbr>
							</th>
							<th style="width: 22.5%;">
								Discount Amount <abbr class="required" title="required">*</abbr>
							</th>
							<th class="plugfy_hd_sh_qnty" style="width: 10%;">
								Remove
							</th>
						</tr>
						<tr>
							<td class="plugfy_hd_sh_qnty"  style="width: 22.5%;">
								<input type="number" min="0" class="start_rng_cart" required style="width: 99%;">
							</td>
							<td class="plugfy_hd_sh_qnty"  style="width: 22.5%;">
								<input type="number" min="0" class="end_rng_cart" required style="width: 99%;">
							</td>
							<td style="width: 22.5%;">
								<select style="width: 99%;" required class="discount_typ_cart">								
									<option value="fixed">Fixed Discount</option>
									<option value="prcnt">Percentage Discount</option>
								</select>
							</td>
							<td style="width: 22.5%;">
								<input type="number" required class="dis_price_cart" min="0" step="any" style="width: 99%;">
							</td>
							<td class="plugfy_hd_sh_qnty" style="width: 10%;">

							</td>
						</tr>

					</table>
					<p  class="plugfy_hd_sh_qnty" >
						<i>Set End Range as <strong>“999999”</strong> for <strong>unlimited</strong> quantity. For example, set range 5 to 999999 and it will display like 5+ on the frontend for customers.</i>
						<br>
						<i>Range will be checked on <strong>total number of items</strong> in the cart</i>
					</p>
				</div>
			
				<br>
				<div  class="plugify_bordered" >
					<button class="button-primary plgfyqdp_add_cart_condition" type="button" style="background-color: green;border-color: green;float: right;">
						<i class="fa fa-fw fa-plus"></i>
					Add Condition(s)</button><br>
					<table class="plgfy_add_modal_table_cart last_tbl_gnrl_stng " style="margin-top: 2%;">
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
						<tr>
							<td style="width: 30%;">
								<select style="width: 99%;" required class="cart_if_value_of">								
									<option value="">Select</option>
									<option value="coupon">Coupon Code Used</option>
									<option value="sub_total">Cart Subtotal</option>
									<option value="user_role">User Role</option>
									<option value="products_in_cart">Products In Cart</option>
									<option value="categories_in_cart">Categories In Cart</option>
								</select>
							</td>
							<td style="width: 30%;">
								<select style="width: 99%;" required class="cart_checking_condition">								
									<option value="">Select</option>
									<option value="==">Equal To</option>
									<option value="!=">Not Equal To</option>
									<option value="<">Less Than</option>
									<option value=">">Greater Than</option>
								</select>
							</td>
							<td style="width: 30%;">
								<div id="plgfqpd_sngl_txt" class="plgfyqbd_to_be_check">
								<input type="text" class="cart_checking_value plugify_all_values" required style="width: 99%;">
							</div>
							<div style="display: none;" id="plgfqbd_sngl_pro" class="plgfyqbd_to_be_check">
								<select name="plgfqdp_productssngl[]"  style="max-width: 99%;width: 99%;font-size: 12px;" class="plugify_all_values plugify_cart_products" id="plgfqdp_productscsngl">
									<?php
									// echo filter_var($plgfyqbd_product_options_html);
									?>
								</select>
							</div>
							<div style="display: none;" id="plgfqbd_sngl_cat" class="plgfyqbd_to_be_check">
								<select  name="plgfqdp_selectcat[]" style="max-width:99%;width: 99%;font-size: 12px;" id="plgfqdp_selectcatcsngl" class="plugify_all_values"   >
									<option value="">Select Category</option>
									<?php
									echo filter_var($plgfyqbd_product_category_html);
									?>
								</select>
							</div>
							<div style="display: none;" id="plgfqbd_sngl_role" class="plgfyqbd_to_be_check">

								<select class="plugify_all_values plgfyqdp_customer_rolesngl" id="plgfyqdp_customer_rolesngl"  multiple style="width: 99%;">
									<?php
									echo filter_var($plgfyqbd_roles_html);
									?>

								</select>
							</div>



							</td>
							<td style="width: 10%;">

							</td>
						</tr> 
					</table>
					<i>Relation between upper conditions is <strong>“AND”</strong></i>
				</div>

			<br>



		</div>
		<hr>
		<div class="modal-footer">			
			<button type="button" id="plgfyqdp_save_cart_rule" class="button-primary">Save</button>
			<br>
			<br>
			<br>
			
		</div>
	</div>

</div>



<div class="modal " id="myModaledit_cart_qtyrules" role="dialog" style="display: none;">
	
		<div class="modal-content">
			<div class="modal-header" style="">
				<button type="button" class="close"style="color: red !important; opacity: 1;" data-dismiss="modal">&times;</button>
				<h1 class="modal-title" style="color: #000 !important; font-family: verdena;">Edit Cart Discount Rule</h1>
			</div>
			<hr>
			<div class="modal-body animate__animated animate__flash" >

			</div>
			<hr>
			<div class="modal-footer">
				<button type="button" id="plgfyqdp_edit_cart_rule_details" class="button-primary">Save</button>
				<br>
				<br>
				<br>	
			</div>
		</div>
	
</div>

<style type="text/css">
	.switch {
		position: relative;
		display: inline-block;
		width: 50px;
		height: 26px;
	}

	.switch input { 
		opacity: 0;
		width: 0;
		height: 0;
	}

	.slider {
		border-radius: 3px;
		position: absolute;
		cursor: pointer;
		top: 0;
		left: 0;
		right: 0;
		bottom: 0;
		background-color: #dcdcde;
		-webkit-transition: .4s;
		transition: .4s;
	}

	.slider:before {
		border-radius: 3px;
		position: absolute;
		content: "";
		height: 18px;
		width: 18px;
		left: 4px;
		bottom: 4px;
		background-color: white;
		-webkit-transition: .4s;
		transition: .4s;
	}

	input:checked + .slider {
		background-color: #ae7b3b;
		background-image: linear-gradient(#ae7b3b, #d69323);
	}

	input:focus + .slider {
		box-shadow: 0 0 1px #ae7b3b;
		
	}

	input:checked + .slider:before {
		-webkit-transform: translateX(26px);
		-ms-transform: translateX(26px);
		transform: translateX(26px);

	}
	.last_tbl_gnrl_stng {
		font-family: Arial, Helvetica, sans-serif;
		border-collapse: collapse;
		width: 98%;
	}

	.last_tbl_gnrl_stng td, .last_tbl_gnrl_stng th {
		border: 1px solid #f1f1f1;
		padding: 4px;

	}
	.last_tbl_gnrl_stng td:first-child, .last_tbl_gnrl_stng th:first-child { border-left:3px solid green; }

	.brdr td:first-child, .brdr th:first-child { border-left:3px solid #ae7b3b; }


	.modal{
		color: #3c434a !important;
	}
	
	.plgfyqdp_main{
		background-color: #FFF !important;
		}.plgfyqdp_main ~ .plgfyqdp_main {
			border: 1px solid white;
			padding: 18px;
			background-color: white;
			box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
			border-radius: 5px;
			margin-top: -20px;
			background: #f7f7ef;  
		}
		.activatedontype{
			background: #ae7b3b !important;
			border-color: #ae7b3b !important;
			color: #FFF !important;
		}

		.active_modal{
				display: block !important;
				opacity: 1;
			}
			.modal {
				display: none; 
				position: fixed; 
				z-index: 1050;
				
				padding-top: 50px;
				width: 100%;
				height: 100%; 
				overflow: auto; 
				background-color: rgb(0,0,0); 
				background-color: rgba(0,0,0,0.4);
			
				left: 0% !important;
				top: 0% !important;
				/*transform: translate(-50%, -50%) !important;*/
			}


			.modal-content {
				background-color: #fefefe;
				margin: auto;
				padding: 20px !important;
				border: 1px solid #888;
				width: 60%;
				border-radius: 5px;

			}
			/*.select2-drop, .select2-dropdown{
				z-index: 99999 !important;
			}*/

			.close {
				color: #aaaaaa;
				float: right;
				font-size: 28px;
				font-weight: bold;
				opacity: 1 !important;
			}

			.close:hover,
			.close:focus {
				color: #000;
				text-decoration: none;
				cursor: pointer;
			}
			.close{
				background-color: transparent !important;
				border: 0px !important;
			}
			#plgfyqdp_cart_datatables td, #plgfyqdp_cart_datatables th {
				text-align: center !important;
			}
		

			#wp-plugify_custom_editor_222-wrap, #wp-plugify_custom_editor-wrap {
				margin-top: 10px;
			}

			.plugify_bordered {
				border: 1px dotted;
				border-radius: 5px;
				padding: 10px;
			}






			.plugify_tooltip {
				position: relative;
				display: inline-block;
				black;
			}

			.plugify_tooltip .plugify_tooltiptext {
				visibility: hidden;
				width: 120px;
				background-color: #363636;
				color: #fff;
				text-align: center;
				border-radius: 6px;
				padding: 10px;
				position: absolute;
				z-index: 9999999;
				left:  -50px;
				margin-top: 20px;

			}

			.plugify_tooltip:hover {
				cursor: help;
			}

			.plugify_tooltip:hover .plugify_tooltiptext {
				visibility: visible;
			}


	</style>

	<script type="text/javascript">
		jQuery(document).ready(function(){

			jQuery('body').on('click', '#plgfyqdp_create_qty_rule_cart', function(){

				jQuery('#modalplgfy_cart').addClass('active_modal');
				
			});
			jQuery('body').on('click', '.plgfyqdp_edit_btn_cart', function(){

				jQuery('#myModaledit_cart_qtyrules').addClass('active_modal');
				
			});



			jQuery('body').on('click', '.close', function(){
				jQuery(this).parent().parent().parent().removeClass('active_modal');
				
			});


			jQuery('body').on('change','.cart_if_value_of', function(){
				jQuery(this).parent().parent().find('.plgfyqbd_to_be_check').hide();
				jQuery(this).parent().parent().find('.plugify_all_values').removeClass('cart_checking_value');



				if (jQuery(this).val() == 'products_in_cart') {
					jQuery(this).parent().parent().find('#plgfqbd_sngl_pro').show();
					jQuery(this).parent().parent().find('#plgfqbd_sngl_pro').find('.plugify_all_values').addClass('cart_checking_value');


					jQuery(this).parent().parent().find('.cart_checking_condition').html('<option value="">Select</option><option value="==">Equal To</option><option value="!=">Not Equal To</option>');

				} else if (jQuery(this).val() == 'categories_in_cart') {
					jQuery(this).parent().parent().find('#plgfqbd_sngl_cat').show();
					jQuery(this).parent().parent().find('#plgfqbd_sngl_cat').find('.plugify_all_values').addClass('cart_checking_value');

					jQuery(this).parent().parent().find('.cart_checking_condition').html('<option value="">Select</option><option value="==">Equal To</option><option value="!=">Not Equal To</option>');


				} else if (jQuery(this).val() == 'user_role') {
					jQuery(this).parent().parent().find('#plgfqbd_sngl_role').show();
					jQuery(this).parent().parent().find('#plgfqbd_sngl_role').find('.plugify_all_values').addClass('cart_checking_value');

					jQuery(this).parent().parent().find('.cart_checking_condition').html('<option value="">Select</option><option value="==">Equal To</option><option value="!=">Not Equal To</option>');

				} else {
					jQuery(this).parent().parent().find('#plgfqpd_sngl_txt').show();
					jQuery(this).parent().parent().find('#plgfqpd_sngl_txt').find('.plugify_all_values').addClass('cart_checking_value');

					if (jQuery(this).val() == 'coupon') {
						jQuery(this).parent().parent().find('.cart_checking_condition').html('<option value="">Select</option><option value="==">Equal To</option><option value="!=">Not Equal To</option>');
					} else {
						jQuery(this).parent().parent().find('.cart_checking_condition').html('<option value="">Select</option><option value="==">Equal To</option><option value="!=">Not Equal To</option><option value="<">Less Than</option><option value=">">Greater Than</option>');
					}
				}
			});




			jQuery('body').on('change','.cart_if_value_of_222', function(){
				jQuery(this).parent().parent().find('.plgfyqbd_to_be_check_222').hide();
				jQuery(this).parent().parent().find('.plugify_all_values_222').removeClass('cart_checking_value_222');

				if (jQuery(this).val() == 'products_in_cart') {
					jQuery(this).parent().parent().find('#plgfqbd_sngl_pro').show();
					jQuery(this).parent().parent().find('#plgfqbd_sngl_pro').find('.plugify_all_values_222').addClass('cart_checking_value_222');

					jQuery(this).parent().parent().find('.cart_checking_condition_222').html('<option value="">Select</option><option value="==">Equal To</option><option value="!=">Not Equal To</option>');

				} else if (jQuery(this).val() == 'categories_in_cart') {
					jQuery(this).parent().parent().find('#plgfqbd_sngl_cat').show();
					jQuery(this).parent().parent().find('#plgfqbd_sngl_cat').find('.plugify_all_values_222').addClass('cart_checking_value_222');

					jQuery(this).parent().parent().find('.cart_checking_condition_222').html('<option value="">Select</option><option value="==">Equal To</option><option value="!=">Not Equal To</option>');

				} else if (jQuery(this).val() == 'user_role') {
					jQuery(this).parent().parent().find('#plgfqbd_sngl_role').show();
					jQuery(this).parent().parent().find('#plgfqbd_sngl_role').find('.plugify_all_values_222').addClass('cart_checking_value_222');

					jQuery(this).parent().parent().find('.cart_checking_condition_222').html('<option value="">Select</option><option value="==">Equal To</option><option value="!=">Not Equal To</option>');

				} else {
					jQuery(this).parent().parent().find('#plgfqpd_sngl_txt').show();
					jQuery(this).parent().parent().find('#plgfqpd_sngl_txt').find('.plugify_all_values_222').addClass('cart_checking_value_222');

					if (jQuery(this).val() == 'coupon') {
						jQuery(this).parent().parent().find('.cart_checking_condition_222').html('<option value="">Select</option><option value="==">Equal To</option><option value="!=">Not Equal To</option>');

					} else {
						jQuery(this).parent().parent().find('.cart_checking_condition_222').html('<option value="">Select</option><option value="==">Equal To</option><option value="!=">Not Equal To</option><option value="<">Less Than</option><option value=">">Greater Than</option>');
					}

				}
			});


			jQuery('body').on('click','.plgfy_apl_al_qntits', function(){
				var is_checked = jQuery(this).prop('checked');
				if (is_checked) {
					jQuery('.start_rng_cart').prop('disabled', 'disabled');
					jQuery('.end_rng_cart').prop('disabled', 'disabled');
					jQuery('.discount_typ_cart:not(:first)').prop('disabled', 'disabled');
					jQuery('.dis_price_cart:not(:first)').prop('disabled', 'disabled');
					jQuery('.plgfyqdp_add_cart_ranges').prop('disabled', 'disabled');

					jQuery('.plugfy_hd_sh_qnty').hide();
					var xyziop=0;
					jQuery('.cart_ranges_based_table').find(".plgfy_add_modal_table").find('tr').each(function(){
						if (xyziop> 1) {
							jQuery(this).remove();
						}
						xyziop++;
					});
				} else {
					jQuery('.start_rng_cart').prop('disabled', false);
					jQuery('.end_rng_cart').prop('disabled', false);
					jQuery('.discount_typ_cart:not(:first)').prop('disabled', false);
					jQuery('.dis_price_cart:not(:first)').prop('disabled', false);
					jQuery('.plgfyqdp_add_cart_ranges').prop('disabled', false);
					jQuery('.plugfy_hd_sh_qnty').show();
				}

			});



			jQuery('body').on('click','.plgfy_apl_al_qntits_222', function(){
				var is_checked = jQuery(this).prop('checked');
				if (is_checked) {
					jQuery('.start_rng_cart_222').prop('disabled', 'disabled');
					jQuery('.end_rng_cart_222').prop('disabled', 'disabled');
					jQuery('.discount_typ_cart_222:not(:first)').prop('disabled', 'disabled');
					jQuery('.dis_price_cart_222:not(:first)').prop('disabled', 'disabled');
					jQuery('.plgfyqdp_add_cart_ranges_222').prop('disabled', 'disabled');
					jQuery('.plugfy_hd_sh_qnty1').hide();


					var xyziop=0;
					jQuery('.cart_ranges_based_table_222').find(".plgfy_add_modal_table").find('tr').each(function(){
						if (xyziop> 1) {
							jQuery(this).remove();
						}
						xyziop++;
					});



				} else {
					jQuery('.start_rng_cart_222').prop('disabled', false);
					jQuery('.end_rng_cart_222').prop('disabled', false);
					jQuery('.discount_typ_cart_222:not(:first)').prop('disabled', false);
					jQuery('.dis_price_cart_222:not(:first)').prop('disabled', false);
					jQuery('.plgfyqdp_add_cart_ranges_222').prop('disabled', false);
					jQuery('.plugfy_hd_sh_qnty1').show();
				}

			});


			jQuery('.plgfyqdp_customer_rolesngl').select2({multiple: true});

		});
	</script>
