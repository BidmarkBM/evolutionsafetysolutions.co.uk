<?php
$plgfyqdp_all_rules=get_option('plgfyqdp_all_rules');
if ('' == $plgfyqdp_all_rules) {
	$plgfyqdp_all_rules = array();
}


$count123=count($plgfyqdp_all_rules);

?>

<input type="hidden" id="plgfyqdp_savediv">
<h3 style="font-weight:600; font-size: 21px;font-family: ver;">	
	<i class="fa fa-hand-o-right" aria-hidden="true"></i>
	All Rules <i style="font-size:14px;font-style: italic;color: green;">(These rules will apply discount on product price i.e cart item, based on quantity count.)</i>          
</h3>
<hr>
<table style="width: 100%;">
	<tr>
		<td style="vertical-align:bottom;float: right;">
			<button class="button-primary" type="button" style="background-color: green;border-color: green;" id="plgfyqdp_create_qty_rule">
				<i class="fa fa-fw fa-plus"></i>
			Add Rule(s)</button>
			

		</td>
	</tr>
</table>
<br>
<br>
<div style="overflow:auto; width: 100%;">
<table id="plgfyqdp_datatables" class="table table-striped" style="width: 100%;">
	<thead>
		<tr> 
			<th style="width:15%;" class="name"><?php echo esc_html__('Rule Name' , 'plugify_qdp'); ?></th>
			<th class="name" ><?php echo esc_html__('Applied On' , 'plugify_qdp'); ?></th>			
			<th class="" ><?php echo esc_html__('Allowed Roles' , 'plugify_qdp'); ?></th>
			<th class="status" ><?php echo esc_html__('Status' , 'plugify_qdp'); ?></th>			
			<th style="width: 20%;" class="" ><?php echo esc_html__('Action' , 'plugify_qdp'); ?></th> 
			
		</tr>
	</thead>
	<tbody >

	</tbody>
	<tfoot>
		<tr>
			<th style="width:15%;" class="name"><?php echo esc_html__('Rule Name' , 'plugify_qdp'); ?></th>
			<th class="name" ><?php echo esc_html__('Applied On' , 'plugify_qdp'); ?></th>
			<th class="" ><?php echo esc_html__('Allowed Roles' , 'plugify_qdp'); ?></th>
			<th class="status" ><?php echo esc_html__('Status' , 'plugify_qdp'); ?></th>			
			<th style="width: 20%;" class="" ><?php echo esc_html__('Action' , 'plugify_qdp'); ?></th> 
			
		</tr>
	</tfoot>
</table>
</div>
<div class="modal " id="modalplgfy" role="dialog" style="display: none;">
		<div class="modal-content modal-content112">
			<div class="modal-header" style="">
				<button type="button" class="close"style="color: red !important; opacity: 1;" data-dismiss="modal">&times;</button>
				
				<h1 class="modal-title" style="color: #000 !important; font-family: verdena;">Add Quantity Rule</h1>

				
			</div>
			<hr>
			<div class="modal-body animate__animated animate__flash" >
				

			
				<div style="display: inline-flex;width:100%;">
					<div style="width:60%;">
						<strong>Activate Rule</strong>
						<label class="switch">
							<input type="checkbox" checked id="plgfydc_activate_rule">
							<span class="slider"></span>
						</label>
					</div>
					<div style="width:40%;text-align: right;">
						<strong>Rule Name</strong>
						<input type="text" id="plugify_qty_r_name" value="">
					</div>
				</div>
				
				<br>
				
				<div class="ranges_based_table" style="margin-top:1%;">
					<button class="button-primary plgfyqdp_add_ranges" type="button" style="background-color: green;border-color: green;float: right;">
						<i class="fa fa-fw fa-plus"></i>
					Add Range(s)</button><br>
					<table class="plgfy_add_modal_table last_tbl_gnrl_stng " style="margin-top: 2%;">
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
						<tr>
							<td style="width: 22.5%;">
								<input type="number" min="0" class="start_rng" required style="width: 99%;">
							</td>
							<td style="width: 22.5%;">
								<input type="number" min="0" class="end_rng" required style="width: 99%;">
							</td>
							<td style="width: 22.5%;">
								<select style="width: 99%;" required class="discount_typ">								
									<option value="fixed">Fixed Discount</option>
									<option value="prcnt">Percentage Discount</option>
									<option value="ammend">Discounted Price</option>
								</select>
							</td>
							<td style="width: 22.5%;">
								<input type="number" required class="dis_price" min="0" step="any" style="width: 99%;">
							</td>
							<td style="width: 10%;">

							</td>
						</tr>

					</table>
					<p>
						<i>a. Set End Range as <strong>“999999”</strong> for <strong>unlimited quantity</strong>. For example, set range 5 to 999999 and it will display like 5+ on the frontend for customers.<br>b. If start and end range is same, only start range will be displayed. For example, set range 5 to 5 and it will display like 5 on the frontend for customers. </i>
					</p>
				</div>
			
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
							<select id="plgfqdp_applied_onc" style="width: 90%;" name="applied_plgfqdp_on">
								
								<option value="Products">Products</option>
								<option value="Category">Category</option>
							</select>
						</td>
						<td style="width: 70%;">
							<div id="plgfqdp_products1c" >
								
								<select name="plgfqdp_products[]" multiple="multiple"  style="max-width: 98%;width: 98%;font-size: 12px;" class=" plgfqdp_products" id="plgfqdp_productsc"   >

							
								</select><br>
								<i>(These quantity discount ranges will be applicable to selected products)</i><br>
								<i style="color: red;"><input type="checkbox" id="plugify_whole_product" name="plugify_whole_product" style="margin:unset;">  By Checking this option, a discount will be applied to the above-selected items if the quantity count of all above-selected items reaches to the range mentioned in this rule</i>
							</div>
							<div id="plgfqdp_selectcat1c" style="display: none;">
								
								<select  name="plgfqdp_selectcat[]" style="max-width: 98%;width: 98%;font-size: 12px;" id="plgfqdp_selectcatc" class="plgfqdp_selectcat"   multiple='multiple[]'>
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
							<i style="color:red;"><input type="checkbox" id="plugify_whole_category" name="plugify_whole_category" style="margin:unset;">  By Checking this option, a discount will be applied to the items from the above-selected categories if the quantity count of the products from all above-selected categories reaches the range mentioned in this rule</i>
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
				<select class="plgfyqdp_customer_roleclass" id="plgfyqdp_customer_role" multiple="multiple" class="form-control " style="width: 98%;">
					<?php
					foreach ($plgfyqdp_all_roles as $key_role => $value_role) {
						?>
						<option value="<?php echo filter_var($key_role); ?>"><?php echo filter_var(ucfirst($value_role)); ?></option>
						<?php
					}
					?>

				</select>
				<br><i style="color: green;">(Leave empty to allow all roles as selected)</i>

			</div>
			<br>
			<strong >Enable Rule For Guest Users?</strong>
			<label class="switch">
				<input type="checkbox" checked id="plgfydc_is_guest">
				<span class="slider"></span>
			</label>

		</div>
		<hr>
		<div class="modal-footer">			
			<button type="button" id="plgfyqdp_save_qty_rule" class="button-primary">Save</button>
			<br>
			<br>
			
		</div>
	</div>

</div>



<div class="modal " id="myModaledit_qtyrules" role="dialog" style="display: none;">
	
		<div class="modal-content">
			<div class="modal-header" style="">
				<button type="button" class="close"style="color: red !important; opacity: 1;" data-dismiss="modal">&times;</button>
				<h1 class="modal-title" style="color: #000 !important; font-family: verdena;">Edit Rule</h1>
			</div>
			<hr>
			<div class="modal-body animate__animated animate__flash" >

			</div>
			<hr>
			<div class="modal-footer">
				<button type="button" id="plgfyqdp_edit_rule_details" class="button-primary">Save</button>
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
			#plgfyqdp_datatables td, #plgfyqdp_datatables th {
				text-align: center !important;
			}
		
	</style>

	<script type="text/javascript">
		jQuery(document).ready(function(){

			jQuery('body').on('click', '#plgfyqdp_create_qty_rule', function(){

				jQuery('#modalplgfy').addClass('active_modal');
				
			});
			jQuery('body').on('click', '.plgfyqdp_edit_btn', function(){

				jQuery('#myModaledit_qtyrules').addClass('active_modal');
				
			});
			jQuery('body').on('click', '.close', function(){
				jQuery(this).parent().parent().parent().removeClass('active_modal');
				
			});
			// jQuery(document).on('click', function (event) {
			// 	if ((!jQuery(event.target).closest('.plgfyqdp_edit_btn').length && !jQuery(event.target).closest('#plgfyqdp_create_qty_rule').length) && !jQuery(event.target).closest('.modal-content').length) {
			// 		if (jQuery('.active_modal').length >0) {
			// 			jQuery('.modal').each(function(){
			// 				jQuery(this).removeClass('active_modal');

			// 			});
			// 		}
			// 	}
			// });


		});
	</script>
