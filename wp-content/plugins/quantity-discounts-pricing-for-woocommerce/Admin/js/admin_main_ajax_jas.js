jQuery(document).ready(function () {

	"use strict";
	
	window.onbeforeunload = null;

	jQuery('#plgfqdp_dynprc').on('change', function(){
		if (jQuery(this).prop('checked')) {
			jQuery('#plgfqdp_hvrrrclr').attr('disabled',false);
			jQuery('#plgfqdp_bg_hvrr_clrr').attr('disabled',false);
		} else {
			jQuery('#plgfqdp_hvrrrclr').attr('disabled','disabled');
			jQuery('#plgfqdp_bg_hvrr_clrr').attr('disabled','disabled');
		}
	});

	if (jQuery('#plgfqdp_dynprc').prop('checked')) {
		jQuery('#plgfqdp_hvrrrclr').attr('disabled',false);
		jQuery('#plgfqdp_bg_hvrr_clrr').attr('disabled',false);
	} else {
		jQuery('#plgfqdp_hvrrrclr').attr('disabled','disabled');
		jQuery('#plgfqdp_bg_hvrr_clrr').attr('disabled','disabled');
	}
	if (jQuery('#plgfqdp_use_Def').prop('checked')) {
		jQuery('#plgfqdp_padding_t').attr('disabled','disabled');
		jQuery('#plgfqdp_padding_r').attr('disabled','disabled');
		jQuery('#plgfqdp_padding_b').attr('disabled','disabled');
		jQuery('#plgfqdp_padding_l').attr('disabled','disabled');
		jQuery('#plgfqdp_enable_shadow').attr('disabled','disabled');
		jQuery('#plgfqdp_brdr_rdius').attr('disabled','disabled');
		jQuery('#plgfqdp_bg_color').attr('disabled','disabled');
		jQuery('#plgfqdp_lbl_txt_color').attr('disabled','disabled');

		jQuery('#plgfqdp_tblhd_bg_color').attr('disabled','disabled');
		jQuery('#plgfqdp_tblhd_lbl_color').attr('disabled','disabled');	
	}

	var datatable = jQuery('#plgfyqdp_datatables').DataTable({
		ajax: {
			url: plgfyqdpData.admin_url + '?action=get_all_qtyrules_from_db'
		},
		columns: [
		{data: 'serial_no'},
		{data: 'Applied On'},
		{data: 'Allowed Roles'},
		{data: 'Status'},
		
		{data: "Action" ,render: function ( data, type, full ) {
			var btnhtml='<button type="button" value="'+data+'" style="background:green;border-color:green;" class="button-primary plgfyqdp_edit_btn"><i class="fa fa-fw fa-edit"></i>Edit</button>';
			
			btnhtml = btnhtml + '<button style="margin-left:2%;background:red;border-color:red;" class="button-primary plgfyqdp_delete_btn" value="'+data+'" type="button" id="" ><i class="fa fa-fw fa-trash"></i>Delete</button>';

			
			return btnhtml;
		}}

		],

	});

	var datatable_cart = jQuery('#plgfyqdp_cart_datatables').DataTable({
		ajax: {
			url: plgfyqdpData.admin_url + '?action=get_all_cart_rules_from_db'
		},
		columns: [
		{data: 'serial_no'},
		// {data: 'Applied On'},
		{data: 'Work with Product Discount'},
		{data: 'Status'},
		
		{data: "Action" ,render: function ( data, type, full ) {
			var btnhtml='<button type="button" value="'+data+'" style="background:green;border-color:green;" class="button-primary plgfyqdp_edit_btn_cart"><i class="fa fa-fw fa-edit"></i>Edit</button>';
			
			btnhtml = btnhtml + '<button style="margin-left:2%;background:red;border-color:red;" class="button-primary plgfyqdp_delete_btn_cart" value="'+data+'" type="button" id="" ><i class="fa fa-fw fa-trash"></i>Delete</button>';

			
			return btnhtml;
		}}

		],

	});
	jQuery('body').on('click', '#plgfyqdp_create_qty_rule' , function(){
		// jQuery('#create_qty_rule_modal').modal();
		// jQuery('#create_qty_rule_modal').show();
	});
	

	jQuery('body').on('click','.plgfyqdp_add_cart_condition', function(){
			jQuery('.plgfy_add_modal_table_cart tr:last').after('<tr><td style="width: 30%;"><select style="width: 99%;" required class="cart_if_value_of">	<option value="">Select</option><option value="coupon">Coupon Code Used</option><option value="sub_total">Cart Subtotal</option><option value="user_role">User Role</option><option value="products_in_cart">Products In Cart</option>	<option value="categories_in_cart">Categories In Cart</option>	</select></td>	<td style="width: 30%;"><select style="width: 99%;" required class="cart_checking_condition">	<option value="">Select</option><option value="==">Equal To</option><option value="!=">Not Equal To</option><option value="<">Less Than</option><option value=">">Greater Than</option>	</select>	</td><td style="width: 30%;"><div id="plgfqpd_sngl_txt" class="plgfyqbd_to_be_check">	<input type="text" class="cart_checking_value plugify_all_values" required style="width: 99%;"></div><div style="display: none;" id="plgfqbd_sngl_pro" class="plgfyqbd_to_be_check"><select name="plgfqdp_productssngl[]"  style="max-width: 99%;width: 99%;font-size: 12px;" class="plugify_all_values plugify_cart_products" id="plgfqdp_productscsngl"></select></div>	<div style="display: none;" id="plgfqbd_sngl_cat" class="plgfyqbd_to_be_check">	<select  name="plgfqdp_selectcat[]" style="max-width:99%;width: 99%;font-size: 12px;" id="plgfqdp_selectcatcsngl" class="plugify_all_values"   >	<option value="">Select Category</option>' + jQuery('#plgfyqbd_cats').val() + '</select>	</div>	<div style="display: none;" id="plgfqbd_sngl_role" class="plgfyqbd_to_be_check"><select name="plgfyqdp_customer_rolesngl[]" multiple class="plugify_all_values plgfyqdp_customer_rolesngl" id="plgfyqdp_customer_rolesngl"  class="form-control " style="width: 99%;">' + jQuery('#plgfyqbd_roles').val() +'</select>	</div>	</td>	<td style="width: 10%;"><span class="plgfyqdp_del_current_row" style="padding: 6px 8px 6px 8px;cursor: pointer;    border: 1px solid red;    border-radius: 4px;"><i style="color:red;" class="fa fa-trash" aria-hidden="true"></i>							</span></td></tr>');
		jQuery('.plgfyqdp_customer_rolesngl').select2({multiple: true});
				jQuery('.plugify_cart_products').select2({
					ajax: {
						url: plgfyqdpData.admin_url, 
						dataType: 'json',
						type: 'post',
						delay: 250, 
						data: function (params) {
							return {
								q: params.term, 
								action: 'plgfyqdp_search_product', 

							};
						},
						processResults: function( data ) {
							var options = [];
							if ( data ) {


								jQuery.each( data, function( index, text ) { 
									options.push( { id: text[0], text: text[1]  } );
								});

							}
							return {
								results: options
							};
						},
						cache: true
					},
					multiple: false,
					placeholder: 'Choose Products',
					minimumInputLength: 3 

				});
	});



	jQuery('body').on('click','.plgfyqdp_add_cart_condition_222', function(){
			jQuery('.plgfy_add_modal_table_cart_222 tr:last').after('<tr><td style="width: 30%;"><select style="width: 99%;" required class="cart_if_value_of_222">	<option value="">Select</option><option value="coupon">Coupon Code Used</option><option value="sub_total">Cart Subtotal</option>	<option value="user_role">User Role</option><option value="products_in_cart">Products In Cart</option>	<option value="categories_in_cart">Categories In Cart</option>	</select></td>	<td style="width: 30%;"><select style="width: 99%;" required class="cart_checking_condition_222">	<option value="">Select</option><option value="==">Equal To</option><option value="!=">Not Equal To</option><option value="<">Less Than</option><option value=">">Greater Than</option>	</select>	</td><td style="width: 30%;"><div id="plgfqpd_sngl_txt" class="plgfyqbd_to_be_check_222">	<input type="text" class="cart_checking_value_222 plugify_all_values_222" required style="width: 99%;"></div><div style="display: none;" id="plgfqbd_sngl_pro" class="plgfyqbd_to_be_check_222"><select name="plgfqdp_productssngl[]"  style="max-width: 99%;width: 99%;font-size: 12px;" class="plugify_all_values_222 plugify_cart_products" id="plgfqdp_productscsngl"></select></div>	<div style="display: none;" id="plgfqbd_sngl_cat" class="plgfyqbd_to_be_check_222">	<select  name="plgfqdp_selectcat[]" style="max-width:99%;width: 99%;font-size: 12px;" id="plgfqdp_selectcatcsngl" class="plugify_all_values_222"   >	<option value="">Select Category</option>' + jQuery('#plgfyqbd_cats_222').val() + '</select>	</div>	<div style="display: none;" id="plgfqbd_sngl_role" class="plgfyqbd_to_be_check_222"><select class="plugify_all_values_222 plgfyqdp_customer_rolesngl"  name="plgfyqdp_customer_rolesngl[]" id="plgfyqdp_customer_rolesngl" multiple class="form-control " style="width: 99%;">' + jQuery('#plgfyqbd_roles_222').val() +'</select>	</div>	</td>	<td style="width: 10%;"><span class="plgfyqdp_del_current_row" style="padding: 6px 8px 6px 8px;cursor: pointer;    border: 1px solid red;    border-radius: 4px;"><i style="color:red;" class="fa fa-trash" aria-hidden="true"></i>							</span></td></tr>');
		jQuery('.plgfyqdp_customer_rolesngl').select2({multiple: true});
		jQuery('.plugify_cart_products').select2({
			ajax: {
				url: plgfyqdpData.admin_url, 
				dataType: 'json',
				type: 'post',
				delay: 250, 
				data: function (params) {
					return {
						q: params.term, 
						action: 'plgfyqdp_search_product', 

					};
				},
				processResults: function( data ) {
					var options = [];
					if ( data ) {


						jQuery.each( data, function( index, text ) { 
							options.push( { id: text[0], text: text[1]  } );
						});

					}
					return {
						results: options
					};
				},
				cache: true
			},
			multiple: false,
			placeholder: 'Choose Products',
			minimumInputLength: 3 

		});
	});

	jQuery('.plugify_cart_products').select2({
		ajax: {
			url: plgfyqdpData.admin_url, 
			dataType: 'json',
			type: 'post',
			delay: 250, 
			data: function (params) {
				return {
					q: params.term, 
					action: 'plgfyqdp_search_product', 
					
				};
			},
			processResults: function( data ) {
				var options = [];
				if ( data ) {

					
					jQuery.each( data, function( index, text ) { 
						options.push( { id: text[0], text: text[1]  } );
					});

				}
				return {
					results: options
				};
			},
			cache: true
		},
		multiple: false,
		placeholder: 'Choose Products',
		minimumInputLength: 3 

		});


	jQuery('.plgfqdp_products').select2({
		ajax: {
			url: plgfyqdpData.admin_url, 
			dataType: 'json',
			type: 'post',
			delay: 250, 
			data: function (params) {
				return {
					q: params.term, 
					action: 'plgfyqdp_search_product', 
					
				};
			},
			processResults: function( data ) {
				var options = [];
				if ( data ) {

					
					jQuery.each( data, function( index, text ) { 
						options.push( { id: text[0], text: text[1]  } );
					});

				}
				return {
					results: options
				};
			},
			cache: true
		},
		multiple: true,
		placeholder: 'Choose Products',
		minimumInputLength: 3 

		});

	

	jQuery('.plgfqdp_selectcat').select2();
	jQuery('.plgfyqdp_customer_roleclass').select2();

	jQuery('#plgfqdp_applied_onc').on('change', function() {
		if (jQuery(this).val() == 'Products') {
			jQuery('#plgfqdp_products1c').show();
			jQuery('#plgfqdp_selectcat1c').hide();
		}else if ('Category'== jQuery(this).val()) {
			jQuery('#plgfqdp_products1c').hide();
			jQuery('#plgfqdp_selectcat1c').show();
		} else {
			jQuery('#plgfqdp_products1c').hide();
			jQuery('#plgfqdp_selectcat1c').hide();
		}
	});


	
	jQuery('body').on('click', '.plgfyqdp_discount_type' , function(){
		jQuery('.plgfyqdp_discount_type').each(function(){
			jQuery(this).removeClass('activatedontype');
			jQuery('.'+jQuery(this).attr('id')).hide();
		});
		jQuery('.'+jQuery(this).attr('id')).show();
		jQuery(this).addClass('activatedontype');
	});

	jQuery('body').on('click', '.plgfyqdp_add_ranges' , function(){
		jQuery('.ranges_based_table').find('.plgfy_add_modal_table tr:last').after('	<tr><td style="width: 22.5%;"><input type="number" min="0" class="start_rng" required style="width: 99%;"></td><td style="width: 22.5%;">							<input type="number" class="end_rng" min="0" required style="width: 99%;">						</td>						<td style="width: 22.5%;">							<select class="discount_typ" style="width: 99%;" required>		<option value="fixed">Fixed Discount</option>								<option value="prcnt">Percentage Discount</option>								<option value="ammend">Discounted Price</option></select>						</td>						<td style="width: 22.5%;">							<input type="number" required class="dis_price" min="0" step="0.001" style="width: 99%;">						</td>						<td style="width: 10%;">							<span class="plgfyqdp_del_current_row" style="padding: 6px 8px 6px 8px;cursor: pointer;    border: 1px solid red;    border-radius: 4px;"><i style="color:red;" class="fa fa-trash" aria-hidden="true"></i>							</span>						</td>					</tr>')
	});


	jQuery('body').on('click', '.plgfyqdp_add_cart_ranges' , function(){
		jQuery('.cart_ranges_based_table').find('.plgfy_add_modal_table tr:last').after('	<tr><td style="width: 22.5%;"><input type="number" min="0" class="start_rng_cart" required style="width: 99%;"></td><td style="width: 22.5%;">							<input type="number" class="end_rng_cart" min="0" required style="width: 99%;">						</td>						<td style="width: 22.5%;">							<select class="discount_typ_cart" style="width: 99%;" required>		<option value="fixed">Fixed Discount</option>								<option value="prcnt">Percentage Discount</option>													</td>						<td style="width: 22.5%;">							<input type="number" required class="dis_price_cart" min="0" step="0.001" style="width: 99%;">						</td>						<td style="width: 10%;">							<span class="plgfyqdp_del_current_row" style="padding: 6px 8px 6px 8px;cursor: pointer;    border: 1px solid red;    border-radius: 4px;"><i style="color:red;" class="fa fa-trash" aria-hidden="true"></i>							</span>						</td>					</tr>')
	});
	

	jQuery('body').on('click', '.plgfyqdp_add_cart_ranges_222' , function(){
		jQuery('.cart_ranges_based_table_222').find('.plgfy_add_modal_table tr:last').after('	<tr><td style="width: 22.5%;"><input type="number" min="0" class="start_rng_cart_222" required style="width: 99%;"></td><td style="width: 22.5%;">							<input type="number" class="end_rng_cart_222" min="0" required style="width: 99%;">						</td>						<td style="width: 22.5%;">							<select class="discount_typ_cart_222" style="width: 99%;" required>		<option value="fixed">Fixed Discount</option>								<option value="prcnt">Percentage Discount</option>							</td>						<td style="width: 22.5%;">							<input type="number" required class="dis_price_cart_222" min="0" step="0.001" style="width: 99%;">						</td>						<td style="width: 10%;">							<span class="plgfyqdp_del_current_row" style="padding: 6px 8px 6px 8px;cursor: pointer;    border: 1px solid red;    border-radius: 4px;"><i style="color:red;" class="fa fa-trash" aria-hidden="true"></i>							</span>						</td>					</tr>')
	});
	

	jQuery('body').on('click', '.plgfyqdp_add_rangesq' , function(){
		jQuery('.qty_based_table').find('.plgfy_add_modal_table tr:last').after('	<tr><td style="width: 22.5%;"><input type="number" min="0" class="start_rngq" required style="width: 99%;"></td><td style="width: 22.5%;">						<select class="end_rngq"><option value="==">Equal To</option><option value=">=">Equal or More than</option>			</td>	<td style="width: 22.5%;">							<select class="discount_typq" style="width: 99%;" required>		<option value="fixed">Fixed Discount</option>								<option value="prcnt">Percentage Discount</option>								<option value="ammend">Discounted Price</option></select>						</td>						<td style="width: 22.5%;">							<input type="number" required class="dis_priceq" min="0" step="0.001" style="width: 99%;">						</td>						<td style="width: 10%;">							<span class="plgfyqdp_del_current_row" style="padding: 6px 8px 6px 8px;cursor: pointer;    border: 1px solid red;    border-radius: 4px;"><i style="color:red;" class="fa fa-trash" aria-hidden="true"></i>							</span>						</td>					</tr>')
	});
	jQuery('body').on('click', '.plgfyqdp_del_current_row' , function(){
		jQuery(this).parent().parent().remove();
	});

	jQuery('body').on('click', '#plgfyqdp_save_cart_rule' , function(){

		var flag=false;

		jQuery('.start_rng_cart').each(function(){
			if (jQuery(this).val() == '' && jQuery('#plgfy_apl_al_qntits').prop('checked') == false ) {
				alert('Please fill all fields in Ranges Table');	
				flag=true;			
				return false;
			}
		});
		if(flag){
			return;
		}
		jQuery('.end_rng_cart').each(function(){
			if (jQuery(this).val() == '' && jQuery('#plgfy_apl_al_qntits').prop('checked') == false ) {
				alert('Please fill all fields in Ranges Table');
				flag=true;					
				return false;
			}
		});
		if(flag){
			return;
		}
		jQuery('.discount_typ_cart').each(function(){
			if (jQuery(this).val() == '' && jQuery(this).prop('disabled') == false ) {
				alert('Please fill all fields in Ranges Table');
				flag=true;					
				return false;
			}
		});
		if(flag){
			return;
		}
		jQuery('.dis_price_cart').each(function(){
			if (jQuery(this).val() == '' && jQuery(this).prop('disabled') == false ) {
				if (jQuery('#plgfy_apl_al_qntits').prop('checked') == true) {
					alert('Please add discount amount');
				} else {
					alert('Please fill all fields in Ranges Table');
				}	
				flag=true;					
				return false;
			}
		});

		if(flag){
			return;
		}

		var start_rng=[];
		var end_rng=[];
		var discount_typ=[];
		var dis_price=[];
		jQuery('body').find('.start_rng_cart').each(function(){
			start_rng.push(jQuery(this).val());
		});
		jQuery('body').find('.end_rng_cart').each(function(){
			end_rng.push(jQuery(this).val());
		});
		jQuery('body').find('.discount_typ_cart').each(function(){
			discount_typ.push(jQuery(this).val());
		});
		jQuery('body').find('.dis_price_cart').each(function(){
			dis_price.push(jQuery(this).val());
		});




		var flag=false;

		var if_val_flag=false;
		var checking_condition_flag=false;
		var checking_val_flag=false;

		jQuery('body').find('.cart_if_value_of').each(function(){
			if (jQuery(this).val() == '') {
				if_val_flag=true;
				flag=true;
			}
		});
		jQuery('body').find('.cart_checking_condition').each(function(){
			if (jQuery(this).val() == '') {
				checking_condition_flag=true;
				flag=true;
			}
		});
		
		jQuery('body').find('.cart_checking_value').each(function(){
			if (jQuery(this).val() == '') {
				// console.log(jQuery(this).val());
				checking_val_flag=true;
				flag=true;
			}
		});


		if (jQuery('body').find('.cart_checking_condition').length == 1) {

			var counttt = 0;

			if (if_val_flag) {
				counttt +=1;
			}
			if (checking_val_flag) {
				counttt +=1;
			}
			if (checking_condition_flag) {
				counttt +=1;
			}
			if (counttt > 0 && counttt < 3) {
				alert('Please fill all fields in Condition Table.');	
				return false;
			}


		} else if(flag){
			alert('Please fill all fields in Condition Table');	
			return false;
		}
		

		var cart_if_value_of=[];
		var cart_checking_condition=[];
		var cart_checking_value=[];
		jQuery('.cart_if_value_of').each(function(){
			cart_if_value_of.push(jQuery(this).val());
		});
		jQuery('.cart_checking_condition').each(function(){
			cart_checking_condition.push(jQuery(this).val());
		});
		jQuery('.cart_checking_value').each(function(){
			cart_checking_value.push(jQuery(this).val());
		});

	

		var plgfydc_activate_rule=jQuery('#plgfydc_activate_cart_rule').prop('checked');
		var plgfydc_work_with_quant=jQuery('#plgfydc_work_with_quant').prop('checked');
		var plgfy_apl_al_qntits=jQuery('#plgfy_apl_al_qntits').prop('checked');
		// var plugify_custom_editor=jQuery('#plugify_custom_editor').val();
		

		var plugify_cart_discount_text = jQuery('#plugify_cart_discount_text').val();

		if (plugify_cart_discount_text.trim() == '') {
			alert('Please add "Cart Discount Text"');
			return false;
		}

		jQuery('#plgfyqdp_save_cart_rule').attr('disabled','disabled');


		jQuery.ajax({
			url : plgfyqdpData.admin_url,

			type : 'post',
			data : {
				action : 'plgfyqdp_add_cart_rule_in_db',
				start_rng:start_rng,
				end_rng:end_rng,
				discount_typ:discount_typ,
				dis_price:dis_price,
				cart_if_value_of:cart_if_value_of,
				cart_checking_condition:cart_checking_condition,
				cart_checking_value:cart_checking_value,
				plgfydc_activate_rule:plgfydc_activate_rule,
				plgfy_apl_al_qntits:plgfy_apl_al_qntits,
				plgfydc_work_with_quant:plgfydc_work_with_quant,
				// plugify_custom_editor:plugify_custom_editor,
				plugify_r_lbl:jQuery('#plugify_cart_r_name').val(),		     
				plugify_cart_discount_text:jQuery('#plugify_cart_discount_text').val(),		     
			},
			success : function( response ) {
				window.onbeforeunload = null;
				datatable_cart.ajax.reload();
				jQuery('#plgfyqdp_save_cart_rule').attr('disabled',false);
				jQuery('.close').click();
				jQuery('.plgfyqdp').remove();
				jQuery('#plgfyqdp_savediv_cart').after('<div class="notice notice-success is-dismissible plgfyqdp" ><p id="plgfyqdp_saveeditmsg">Done</p><button type="button" class="notice-dismiss hidedivv"><span class="screen-reader-text">Dismiss this notice.</span></button></div>')

				jQuery('#plgfyqdp_saveeditmsg').html('Rule has been added Successfully!');
				jQuery("html, body").animate({ scrollTop: 0 }, "slow");
				jQuery('.start_rng_cart').each(function(){
					jQuery(this).val('');
				});
				jQuery('.end_rng_cart').each(function(){
					jQuery(this).val('');
				});

				jQuery('.dis_price_cart').each(function(){
					jQuery(this).val('');
				});
			

			}

		});	

	});





	jQuery('body').on('click', '#plgfyqdp_edit_cart_rule_details' , function(){

		var flag=false;

		


		jQuery('.start_rng_cart_222').each(function(){
			if (jQuery(this).val() == '' && jQuery('#plgfy_apl_al_qntits_222').prop('checked') == false ) {
				alert('Please fill all fields in Ranges Table');	
				flag=true;			
				return false;
			}
		});
		if(flag){
			return;
		}
		jQuery('.end_rng_cart_222').each(function(){
			if (jQuery(this).val() == '' && jQuery('#plgfy_apl_al_qntits_222').prop('checked') == false ) {
				alert('Please fill all fields in Ranges Table');
				flag=true;			
				return false;
			}
		});
		if(flag){
			return;
		}
		jQuery('.discount_typ_cart_222').each(function(){
			if (jQuery(this).val() == '' && jQuery(this).prop('disabled') == false ) {
				alert('Please fill all fields in Ranges Table');
				flag=true;		
				return false;
			}
		});
		if(flag){
			return;
		}
		jQuery('.dis_price_cart_222').each(function(){
			if (jQuery(this).val() == '' && jQuery(this).prop('disabled') == false ) {
				if (jQuery('#plgfy_apl_al_qntits_222').prop('checked') == true) {
					alert('Please add discount amount');
				} else {
					alert('Please fill all fields in Ranges Table');
				}
				flag=true;	
				return false;
			}
		});
		if(flag){
			return;
		}






		var start_rng=[];
		var end_rng=[];
		var discount_typ=[];
		var dis_price=[];
		jQuery('body').find('.start_rng_cart_222').each(function(){
			start_rng.push(jQuery(this).val());
		});
		jQuery('body').find('.end_rng_cart_222').each(function(){
			end_rng.push(jQuery(this).val());
		});
		jQuery('body').find('.discount_typ_cart_222').each(function(){
			discount_typ.push(jQuery(this).val());
		});
		jQuery('body').find('.dis_price_cart_222').each(function(){
			dis_price.push(jQuery(this).val());
		});



		var flag=false;

		var if_val_flag=false;
		var checking_val_flag=false;
		var checking_condition_flag=false;

		jQuery('body').find('.cart_if_value_of_222').each(function(){
			if (jQuery(this).val() == '') {
				flag=true;			
				if_val_flag=true;			
			}
		});
		jQuery('body').find('.cart_checking_condition_222').each(function(){
			if (jQuery(this).val() == '') {
				flag=true;					
				checking_val_flag=true;					
			}
		});
		jQuery('body').find('.cart_checking_value_222').each(function(){
			if (jQuery(this).val() == '') {
				flag=true;					
				checking_condition_flag=true;					
			}
		});



		if (jQuery('body').find('.cart_checking_condition_222').length == 1) {

			var counttt = 0;

			if (if_val_flag) {
				counttt +=1;
			}

			if (checking_val_flag) {
				counttt +=1;
			}
			if (checking_condition_flag) {
				counttt +=1;
			}
			if (counttt >0 && counttt < 3) {
				alert('Please fill all fields in Condition Table.');	
				return false;
			}


		} else if(flag){
			alert('Please fill all fields in Condition Table');	
			return false;
		}
		
		

		var cart_if_value_of=[];
		var cart_checking_condition=[];
		var cart_checking_value=[];
		jQuery('.cart_if_value_of_222').each(function(){
			cart_if_value_of.push(jQuery(this).val());
		});
		jQuery('.cart_checking_condition_222').each(function(){
			cart_checking_condition.push(jQuery(this).val());
		});
		jQuery('.cart_checking_value_222').each(function(){
			cart_checking_value.push(jQuery(this).val());
		});

	
		var plgfydc_activate_rule=jQuery('#plgfydc_activate_cart_rule_222').prop('checked');
		var plgfydc_work_with_quant=jQuery('#plgfydc_work_with_quant_222').prop('checked');
		var plgfy_apl_al_qntits=jQuery('#plgfy_apl_al_qntits_222').prop('checked');
	


		var plugify_cart_discount_text = jQuery('#plugify_cart_discount_text_222').val();

		if (plugify_cart_discount_text.trim() == '') {
			alert('Please add "Cart Discount Text"');
			return false;
		}


		jQuery('#plgfyqdp_edit_cart_rule_details').attr('disabled','disabled');
		jQuery.ajax({
			url : plgfyqdpData.admin_url,

			type : 'post',
			data : {
				action : 'plgfyqdp_edit_cart_rule_in_db',
				start_rng:start_rng,
				end_rng:end_rng,
				discount_typ:discount_typ,
				dis_price:dis_price,
				cart_if_value_of:cart_if_value_of,
				cart_checking_condition:cart_checking_condition,
				cart_checking_value:cart_checking_value,
				plgfydc_activate_rule:plgfydc_activate_rule,
				plgfy_apl_al_qntits:plgfy_apl_al_qntits,
				plgfydc_work_with_quant:plgfydc_work_with_quant,
				// plugify_custom_editor:plugify_custom_editor,
				plugify_r_lbl:jQuery('#plugify_cart_r_name_222').val(),
				plugify_cart_discount_text:jQuery('#plugify_cart_discount_text_222').val(),
				index:jQuery(this).val()
			},
			success : function( response ) {
				window.onbeforeunload = null;

				datatable_cart.ajax.reload();
				jQuery('#plgfyqdp_edit_cart_rule_details').attr('disabled',false);
				jQuery('.close').click();
				jQuery('.plgfyqdp').remove();
				jQuery('#plgfyqdp_savediv_cart').after('<div class="notice notice-success is-dismissible plgfyqdp" ><p id="plgfyqdp_saveeditmsg">Done</p><button type="button" class="notice-dismiss hidedivv"><span class="screen-reader-text">Dismiss this notice.</span></button></div>')

				jQuery('#plgfyqdp_saveeditmsg').html('Rule has been edited Successfully!');
				jQuery("html, body").animate({ scrollTop: 0 }, "slow");
				jQuery('.start_rng_cart_222').each(function(){
					jQuery(this).val('');
				});
				jQuery('.end_rng_cart_222').each(function(){
					jQuery(this).val('');
				});

				jQuery('.dis_price_cart_222').each(function(){
					jQuery(this).val('');
				});	

				jQuery('.discount_typ_cart_222').each(function(){
					jQuery(this).val('');
				});
				jQuery('.cart_if_value_of_222').each(function(){
					jQuery(this).val('');
				});

				jQuery('.cart_checking_condition_222').each(function(){
					jQuery(this).val('');
				});
				
				jQuery('.cart_checking_value_222').each(function(){
					jQuery(this).val('');
				});
				
			}

		});	
	});




	jQuery('body').on('click', '#plgfyqdp_save_qty_rule' , function(){
		
		
		var flag=false;

		jQuery('.start_rng').each(function(){
			if (jQuery(this).val() == '') {
				alert('Please fill all fields in Ranges Table');	
				flag=true;			
				return false;
			}
		});
		if(flag){
			return;
		}
		jQuery('.end_rng').each(function(){
			if (jQuery(this).val() == '') {
				alert('Please fill all fields in Ranges Table');flag=true;					
				return false;
			}
		});
		if(flag){
			return;
		}
		jQuery('.discount_typ').each(function(){
			if (jQuery(this).val() == '') {
				alert('Please fill all fields in Ranges Table');flag=true;					
				return false;
			}
		});
		if(flag){
			return;
		}
		jQuery('.dis_price').each(function(){
			if (jQuery(this).val() == '') {
				alert('Please fill all fields in Ranges Table');flag=true;					
				return false;
			}
		});
		if(flag){
			return;
		}

		var start_rng=[];
		var end_rng=[];
		var discount_typ=[];
		var dis_price=[];
		jQuery('.start_rng').each(function(){
			start_rng.push(jQuery(this).val());
		});
		jQuery('.end_rng').each(function(){
			end_rng.push(jQuery(this).val());
		});
		jQuery('.discount_typ').each(function(){
			discount_typ.push(jQuery(this).val());
		});
		jQuery('.dis_price').each(function(){
			dis_price.push(jQuery(this).val());
		});
		var applied_on=jQuery('#plgfqdp_applied_onc').val();
		
		var include_pro = 'false';
		var include_cat = 'false';

		if ('Products'==applied_on ) {
			var apllied_on_ids=jQuery('#plgfqdp_productsc').val();
			include_pro = jQuery('#plugify_whole_product').prop('checked');
		} else {
			var apllied_on_ids=jQuery('#plgfqdp_selectcatc').val();
			include_cat =  jQuery('#plugify_whole_category').prop('checked');
		}
		

		var allowed_roles=jQuery('#plgfyqdp_customer_role').val();
		var plgfydc_activate_rule=jQuery('#plgfydc_activate_rule').prop('checked');
		var plgfydc_is_guest=jQuery('#plgfydc_is_guest').prop('checked');
		jQuery('#plgfyqdp_save_qty_rule').attr('disabled','disabled');
		jQuery.ajax({
			url : plgfyqdpData.admin_url,

			type : 'post',
			data : {
				action : 'plgfyqdp_add_rule_in_db',
				tabletyp : 'ranges',
				include_pro : include_pro,
				include_cat : include_cat,
				start_rng:start_rng,
				end_rng:end_rng,
				discount_typ:discount_typ,
				dis_price:dis_price,
				applied_on:applied_on,
				apllied_on_ids:apllied_on_ids,
				allowed_roles:allowed_roles,
				plgfydc_activate_rule:plgfydc_activate_rule,		     
				plgfydc_is_guest:plgfydc_is_guest,	
				plugify_r_lbl:jQuery('#plugify_qty_r_name').val(),		     

			},
			success : function( response ) {
				window.onbeforeunload = null;
				datatable.ajax.reload();
				jQuery('#plgfyqdp_save_qty_rule').attr('disabled',false);
				jQuery('.close').click();
				jQuery('.plgfyqdp').remove();
				jQuery('#plgfyqdp_savediv').after('<div class="notice notice-success is-dismissible plgfyqdp" ><p id="plgfyqdp_saveeditmsg">Done</p><button type="button" class="notice-dismiss hidedivv"><span class="screen-reader-text">Dismiss this notice.</span></button></div>')

				jQuery('#plgfyqdp_saveeditmsg').html('Rule has been added Successfully!');
				jQuery("html, body").animate({ scrollTop: 0 }, "slow");
				jQuery('.start_rng').each(function(){
					jQuery(this).val('');
				});
				jQuery('.end_rng').each(function(){
					jQuery(this).val('');
				});

				jQuery('.dis_price').each(function(){
					jQuery(this).val('');
				});
				
			}

		});	


	});


	jQuery('body').on('click', '.plgfyqdp_edit_btn' , function(){
		jQuery('#myModaledit_qtyrules').find('.modal-body').html('<center><img width="200px" src="'+plgfyqdpData.loaderrr+'" ></center>');
		var index=jQuery(this).val();
		jQuery('#plgfyqdp_edit_rule_details').val(index);
		
		


		jQuery.ajax({
			url : plgfyqdpData.admin_url,

			type : 'post',
			data : {
				action : 'plgfyqdp_get_myModaledit_qtyrules',      
				index : index       

			},
			success : function( response ) {
				window.onbeforeunload = null;

				jQuery('#myModaledit_qtyrules').find('.modal-body').html(response);
				jQuery('.plgfqdp_products').select2({
					ajax: {
						url: plgfyqdpData.admin_url, 
						dataType: 'json',
						type: 'post',
						delay: 250, 
						data: function (params) {
							return {
								q: params.term, 
								action: 'plgfyqdp_search_product', 

							};
						},
						processResults: function( data ) {
							var options = [];
							if ( data ) {


								jQuery.each( data, function( index, text ) { 
									options.push( { id: text[0], text: text[1]  } );
								});

							}
							return {
								results: options
							};
						},
						cache: true
					},
					multiple: true,
					placeholder: 'Choose Products',
					minimumInputLength: 3 

					});
				jQuery('.plgfqdp_selectcat').select2();
				jQuery('.plgfyqdp_customer_roleclass').select2();


				datatable.ajax.reload();


			}

		});
	});


	jQuery('body').on('click', '.plgfyqdp_edit_btn_cart' , function(){
		jQuery('#myModaledit_cart_qtyrules').find('.modal-body').html('<center><img width="200px" src="'+plgfyqdpData.loaderrr+'" ></center>');
		var index=jQuery(this).val();
		jQuery('#plgfyqdp_edit_cart_rule_details').val(index);
		

		jQuery("#myModaledit_cart_qtyrules").show();
		jQuery.ajax({
			url : plgfyqdpData.admin_url,

			type : 'post',
			data : {
				action : 'plgfyqdp_get_cart_edit_qtyrules',      
				index : index       

			},
			success : function( response ) {
				window.onbeforeunload = null;

				jQuery('#myModaledit_cart_qtyrules').find('.modal-body').html(response);
				jQuery('.plgfyqdp_customer_rolesngl').select2({multiple: true});

				var is_checked = jQuery('body').find('.plgfy_apl_al_qntits_222').prop('checked');
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


				jQuery('.plugify_cart_products').select2({
					ajax: {
						url: plgfyqdpData.admin_url, 
						dataType: 'json',
						type: 'post',
						delay: 250, 
						data: function (params) {
							return {
								q: params.term, 
								action: 'plgfyqdp_search_product', 

							};
						},
						processResults: function( data ) {
							var options = [];
							if ( data ) {


								jQuery.each( data, function( index, text ) { 
									options.push( { id: text[0], text: text[1]  } );
								});

							}
							return {
								results: options
							};
						},
						cache: true
					},
					multiple: false,
					placeholder: 'Choose Products',
					minimumInputLength: 3 

				});


			}

		});
	});
	jQuery('body').on('change', '#plgfqdp_applied_onc1' , function(){

		if (jQuery(this).val() == 'Products') {

			jQuery('#plgfqdp_products1c1').show();
			jQuery('#plgfqdp_selectcat1c1').hide();

		}else if ('Category'== jQuery(this).val()) {
			jQuery('#plgfqdp_products1c1').hide();
			jQuery('#plgfqdp_selectcat1c1').show();
		} else {
			jQuery('#plgfqdp_products1c1').hide();
			jQuery('#plgfqdp_selectcat1c1').hide();
		}
	});
	jQuery('body').on('click', '.plgfyqdp_add_ranges1' , function(){

		jQuery('.plgfy_add_modal_table1 tr:last').after('	<tr><td style="width: 22.5%;"><input type="number" min="0" class="start_rng1" required style="width: 99%;"></td><td style="width: 22.5%;">							<input type="number" min="0" class="end_rng1" required style="width: 99%;">						</td>						<td style="width: 22.5%;">							<select class="discount_typ1" style="width: 99%;" required>		<option value="fixed">Fixed Discount</option>								<option value="prcnt">Percentage Discount</option>								<option value="ammend">Discounted Price</option></select>						</td>						<td style="width: 22.5%;">							<input type="number" required class="dis_price1" min="0" step="0.001" style="width: 99%;">						</td>						<td style="width: 10%;">							<span class="plgfyqdp_del_current_row" style="padding: 6px 8px 6px 8px;cursor: pointer;    border: 1px solid red;    border-radius: 4px;"><i style="color:red;" class="fa fa-trash" aria-hidden="true"></i>							</span>						</td>					</tr>')
	});
	jQuery('body').on('click', '.plgfyqdp_add_rangesq1' , function(){

		jQuery('.plgfy_add_modal_table1 tr:last').after('	<tr><td style="width: 22.5%;"><input type="number" min="0" class="start_rngq1" required style="width: 99%;"></td><td style="width: 22.5%;">						<select class="end_rngq1"><option value="==">Equal To</option><option value=">=">Equal or More than</option>					</td>						<td style="width: 22.5%;">							<select class="discount_typq1" style="width: 99%;" required>		<option value="fixed">Fixed Discount</option>								<option value="prcnt">Percentage Discount</option>								<option value="ammend">Discounted Price</option></select>						</td>						<td style="width: 22.5%;">							<input type="number" required class="dis_priceq1" min="0" step="0.001" style="width: 99%;">						</td>						<td style="width: 10%;">							<span class="plgfyqdp_del_current_row" style="padding: 6px 8px 6px 8px;cursor: pointer;    border: 1px solid red;    border-radius: 4px;"><i style="color:red;" class="fa fa-trash" aria-hidden="true"></i>							</span>						</td>					</tr>')
	});




	
	jQuery('body').on('click', '#plgfyqdp_edit_rule_details' , function(){
		var flag=false;

		jQuery('.start_rng'+jQuery('#qtybasedmain').val()+'1').each(function(){
			if (jQuery(this).val() == '') {
				alert('Please fill all fields in Ranges/Quantity Table');	
				flag=true;			
				return false;
			}
		});
		if(flag){
			return;
		}
		jQuery('.end_rng'+jQuery('#qtybasedmain').val()+'1').each(function(){
			if (jQuery(this).val() == '') {
				alert('Please fill all fields in Ranges/Quantity Table');	flag=true;					
				return false;
			}
		});
		if(flag){
			return;
		}
		jQuery('.discount_typ'+jQuery('#qtybasedmain').val()+'1').each(function(){
			if (jQuery(this).val() == '') {
				alert('Please fill all fields in Ranges/Quantity Table');	flag=true;						
				return false;
			}
		});
		if(flag){
			return;
		}
		jQuery('.dis_price'+jQuery('#qtybasedmain').val()+'1').each(function(){
			if (jQuery(this).val() == '') {
				alert('Please fill all fields in Ranges/Quantity Table');	flag=true;					
				return false;
			}
		});
		if(flag){
			return;
		}

		var start_rng=[];
		var end_rng=[];
		var discount_typ=[];
		var dis_price=[];
		jQuery('.start_rng'+jQuery('#qtybasedmain').val()+'1').each(function(){
			start_rng.push(jQuery(this).val());
		});
		jQuery('.end_rng'+jQuery('#qtybasedmain').val()+'1').each(function(){
			end_rng.push(jQuery(this).val());
		});
		jQuery('.discount_typ'+jQuery('#qtybasedmain').val()+'1').each(function(){
			discount_typ.push(jQuery(this).val());
		});
		jQuery('.dis_price'+jQuery('#qtybasedmain').val()+'1').each(function(){
			dis_price.push(jQuery(this).val());
		});
		var applied_on=jQuery('#plgfqdp_applied_onc1').val();

		var include_pro = 'false';
		var include_cat = 'false';

		if ('Products'==applied_on ) {
			var apllied_on_ids=jQuery('#plgfqdp_productsc1').val();
			include_pro = jQuery('#plugify_whole_product1').prop('checked');
		} else {
			var apllied_on_ids=jQuery('#plgfqdp_selectcatc1').val();
			include_cat =  jQuery('#plugify_whole_category1').prop('checked');
		}
		var allowed_roles=jQuery('#plgfyqdp_customer_role1').val();
		var plgfydc_activate_rule=jQuery('#plgfydc_activate_rule1').prop('checked');
		var plgfydc_is_guest=jQuery('#plgfydc_is_guest1').prop('checked');
		
		jQuery.ajax({
			url : plgfyqdpData.admin_url,

			type : 'post',
			data : {
				action : 'plgfyqdp_edit_rule_in_db',
				tabletyp:'ranges',
				include_pro : include_pro,
				include_cat : include_cat,
				start_rng:start_rng,
				end_rng:end_rng,
				discount_typ:discount_typ,
				dis_price:dis_price,
				applied_on:applied_on,
				apllied_on_ids:apllied_on_ids,
				allowed_roles:allowed_roles,
				plgfydc_activate_rule:plgfydc_activate_rule,		     
				plgfydc_is_guest:plgfydc_is_guest,		     
				index:jQuery(this).val(),	
				plugify_r_lbl:jQuery('#plugify_qty_r_name1').val(),		     

			},
			success : function( response ) {
				window.onbeforeunload = null;
				jQuery('.close').click();
				datatable.ajax.reload();
				jQuery('.plgfyqdp').remove();
				jQuery('#plgfyqdp_savediv').after('<div class="notice notice-success is-dismissible plgfyqdp" ><p id="plgfyqdp_saveeditmsg">Done</p><button type="button" class="notice-dismiss hidedivv"><span class="screen-reader-text">Dismiss this notice.</span></button></div>')

				jQuery('#plgfyqdp_saveeditmsg').html('Rule has been updated Successfully!');
				jQuery("html, body").animate({ scrollTop: 0 }, "slow");
				
			}

		});	

	});
	jQuery('body').on('click', '.plgfyqdp_delete_btn' , function(){
		if(!confirm('Are you sure you want to permanently remove this rule?')){
			return;
		}
		jQuery.ajax({
			url : plgfyqdpData.admin_url,

			type : 'post',
			data : {
				action : 'plgfyqdp_delete_rule_data_db', 
				index:jQuery(this).val(),

			},
			success : function( response ) {
				window.onbeforeunload = null;

				jQuery('.close').click();

				datatable.ajax.reload();
				jQuery('.plgfyqdp').remove();
				jQuery('#plgfyqdp_savediv').after('<div class="notice notice-success is-dismissible plgfyqdp" ><p id="plgfyqdp_saveeditmsg">Done</p><button type="button" class="notice-dismiss hidedivv"><span class="screen-reader-text">Dismiss this notice.</span></button></div>')

				jQuery('#plgfyqdp_saveeditmsg').html('Rule has been deleted');
				jQuery("html, body").animate({ scrollTop: 0 }, "slow");


			}

		});
	});

	jQuery('body').on('click', '.plgfyqdp_delete_btn_cart' , function(){
		if(!confirm('Are you sure you want to permanently remove this rule?')){
			return;
		}
		jQuery.ajax({
			url : plgfyqdpData.admin_url,

			type : 'post',
			data : {
				action : 'plgfyqdp_delete_cart_rule_data_db', 
				index:jQuery(this).val(),

			},
			success : function( response ) {
				window.onbeforeunload = null;

				jQuery('.close').click();

				datatable_cart.ajax.reload();
				jQuery('.plgfyqdp').remove();
				jQuery('#plgfyqdp_savediv_cart').after('<div class="notice notice-success is-dismissible plgfyqdp" ><p id="plgfyqdp_saveeditmsg">Done</p><button type="button" class="notice-dismiss hidedivv"><span class="screen-reader-text">Dismiss this notice.</span></button></div>')

				jQuery('#plgfyqdp_saveeditmsg').html('Rule has been deleted');
				jQuery("html, body").animate({ scrollTop: 0 }, "slow");


			}

		});
	});
	jQuery('body').on('click', '.hidedivv' , function(){
		jQuery('.plgfyqdp').remove();
	});

	if (jQuery('input[name="plgfqdp_coupon_settings"]:checked').val() == 'plgfqdp_aply_nly_qt_ds') {
		jQuery('#coupon_remove_message').removeAttr('disabled');
	} else {
		jQuery('#coupon_remove_message').prop('disabled', 'disabled');
	}

	jQuery('.plgfqdp_coupon_settings').on('change', function() {

		if (jQuery('input[name="plgfqdp_coupon_settings"]:checked').val() == 'plgfqdp_aply_nly_qt_ds') {
			jQuery('#coupon_remove_message').removeAttr('disabled');
		} else {
			jQuery('#coupon_remove_message').prop('disabled', 'disabled');
		}

	});

	jQuery('body').on('click', '#plgfyqdp_save_gnrl_settings' , function(){
		


		jQuery('#before_content_plugify-html').click();
		jQuery('#after_content_plugify-html').click();
		jQuery('#plgfqdp_offers_popup_content-html').click();



		jQuery.ajax({
			url : plgfyqdpData.admin_url,

			type : 'post',
			data : {
				action : 'plgfyqdp_save_gnrl_settings', 
				plgfqdp_dynprc:jQuery('#plgfqdp_dynprc').prop('checked'),
				plgfqdp_dynprc:jQuery('#plgfqdp_dynprc').prop('checked'),
				plgfqdp_shw_strt:jQuery('#plgfqdp_shw_strt').prop('checked'),
				plgfqdp_use_Def:jQuery('#plgfqdp_use_Def').prop('checked'),
				hide_qty_data_from_email:jQuery('#hide_qty_data_from_email').prop('checked'),
				plgfqdp_shw_strt_txt:jQuery('#plgfqdp_shw_strt_txt').val(),
				before_content_plugify:jQuery('#before_content_plugify').val(),
				after_content_plugify:jQuery('#after_content_plugify').val(),				
				plgfyqdp_table_position:jQuery('#plgfyqdp_table_position').val(),

				plgfqdp_padding_t:jQuery('#plgfqdp_padding_t').val(),
				plgfqdp_padding_r:jQuery('#plgfqdp_padding_r').val(),
				plgfqdp_padding_b:jQuery('#plgfqdp_padding_b').val(),
				plgfqdp_padding_l:jQuery('#plgfqdp_padding_l').val(),
				plgfqdp_enable_shadow:jQuery('#plgfqdp_enable_shadow').prop('checked'),
				plgfqdp_apply_multiple_discount:jQuery('#plgfqdp_apply_multiple_discount').prop('checked'),
				plgfqdp_show_offers_button:jQuery('#plgfqdp_show_offers_button').prop('checked'),
				plgfqdp_offers_button_shadow:jQuery('#plgfqdp_offers_button_shadow').prop('checked'),
				plgfqdp_brdr_rdius:jQuery('#plgfqdp_brdr_rdius').val(),
				plgfqdp_bg_color:jQuery('#plgfqdp_bg_color').val(),
				plgfqdp_lbl_txt_color:jQuery('#plgfqdp_lbl_txt_color').val(),
				
				plgfqdp_tblhd_bg_color:jQuery('#plgfqdp_tblhd_bg_color').val(),
				plgfqdp_tblhd_lbl_color:jQuery('#plgfqdp_tblhd_lbl_color').val(),
				
				quantitycol:jQuery('#quantitycol').prop('checked'),
				discountcol:jQuery('#discountcol').prop('checked'),
				peritemcol:jQuery('#peritemcol').prop('checked'),
				style_plugify_content:jQuery('#style_plugify_content').val(),


				plgfqdp_hvrrrclr:jQuery('#plgfqdp_hvrrrclr').val(),
				plgfqdp_bg_hvrr_clrr:jQuery('#plgfqdp_bg_hvrr_clrr').val(),
				col1qtytext:jQuery('#col1qtytext').val(),
				col1distext:jQuery('#col1distext').val(),
				col1pertext:jQuery('#col1pertext').val(),


				plgfqdp_shw_dscnt_totl:jQuery('#plgfqdp_shw_dscnt_totl').prop('checked'),
				plgfqdp_shw_dscnt_totl_txt:jQuery('#plgfqdp_shw_dscnt_totl_txt').val(),
				plgfyqdp_dt_and_as_position:jQuery('#plgfyqdp_dt_and_as_position').val(),

				plgfqdp_shw_amnt_svd:jQuery('#plgfqdp_shw_amnt_svd').prop('checked'),
				plgfqdp_shw_amnt_svd_txt:jQuery('#plgfqdp_shw_amnt_svd_txt').val(),

				plgfqdp_coupon_settings : jQuery('input[name="plgfqdp_coupon_settings"]:checked').val(),
				coupon_remove_message : jQuery('#coupon_remove_message').val(),


				plgfqdp_offers_button_text:jQuery('#plgfqdp_offers_button_text').val(),
				plgfqdp_offers_button_text_color:jQuery('#plgfqdp_offers_button_text_color').val(),
				plgfqdp_offers_button_text_weight:jQuery('#plgfqdp_offers_button_text_weight').val(),
				plgfqdp_offers_button_text_size:jQuery('#plgfqdp_offers_button_text_size').val(),
				plgfqdp_offers_button_bg_color:jQuery('#plgfqdp_offers_button_bg_color').val(),
				plugify_button_select_pages:jQuery('#plugify_button_select_pages').val(),
				plgfqdp_offers_button_shadow_color:jQuery('#plgfqdp_offers_button_shadow_color').val(),
				plgfqdp_offers_button_radius:jQuery('#plgfqdp_offers_button_radius').val(),
				plgfqdp_offers_popup_bg_color:jQuery('#plgfqdp_offers_popup_bg_color').val(),
				plgfqdp_offers_popup_txt_color:jQuery('#plgfqdp_offers_popup_txt_color').val(),
				plgfqdp_offers_popup_hd_text:jQuery('#plgfqdp_offers_popup_hd_text').val(),
				plgfqdp_offers_popup_hd_text_color:jQuery('#plgfqdp_offers_popup_hd_text_color').val(),
				plgfqdp_offers_popup_hd_bg_clr:jQuery('#plgfqdp_offers_popup_hd_bg_clr').val(),
				plugify_discount_tobe_applied:jQuery('#plugify_discount_tobe_applied').val(),
				plgfqdp_offers_popup_content:jQuery('#plgfqdp_offers_popup_content').val(),

			},
			success : function( response ) {
				window.onbeforeunload = null;
				jQuery('#before_content_plugify-tmce').click();
				jQuery('#after_content_plugify-tmce').click();
				jQuery('#plgfqdp_offers_popup_content-tmce').click();
				jQuery('.close').click();

				datatable.ajax.reload();
				jQuery('.plgfyqdp').remove();
				jQuery('#plgfyqdp_savediv1').after('<div class="notice notice-success is-dismissible plgfyqdp" ><p id="plgfyqdp_saveeditmsg">Done</p><button type="button" class="notice-dismiss hidedivv"><span class="screen-reader-text">Dismiss this notice.</span></button></div>')

				jQuery('#plgfyqdp_saveeditmsg').html('Settings has been saved!');
				jQuery("html, body").animate({ scrollTop: 0 }, "slow");


			}

		});
	});
	jQuery('body').on('click', '#plgfqdp_use_Def' , function(){
		if (jQuery(this).prop('checked')) {
			jQuery('#plgfqdp_padding_t').attr('disabled','disabled');
			jQuery('#plgfqdp_padding_r').attr('disabled','disabled');
			jQuery('#plgfqdp_padding_b').attr('disabled','disabled');
			jQuery('#plgfqdp_padding_l').attr('disabled','disabled');
			jQuery('#plgfqdp_enable_shadow').attr('disabled','disabled');
			jQuery('#plgfqdp_brdr_rdius').attr('disabled','disabled');
			jQuery('#plgfqdp_bg_color').attr('disabled','disabled');
			jQuery('#plgfqdp_lbl_txt_color').attr('disabled','disabled');

			jQuery('#plgfqdp_tblhd_bg_color').attr('disabled','disabled');
			jQuery('#plgfqdp_tblhd_lbl_color').attr('disabled','disabled');			
		} else {
			jQuery('#plgfqdp_padding_t').attr('disabled',false);
			jQuery('#plgfqdp_padding_r').attr('disabled',false);
			jQuery('#plgfqdp_padding_b').attr('disabled',false);
			jQuery('#plgfqdp_padding_l').attr('disabled',false);
			jQuery('#plgfqdp_enable_shadow').attr('disabled',false);
			jQuery('#plgfqdp_brdr_rdius').attr('disabled',false);
			jQuery('#plgfqdp_bg_color').attr('disabled',false);
			jQuery('#plgfqdp_lbl_txt_color').attr('disabled',false);

			jQuery('#plgfqdp_tblhd_bg_color').attr('disabled',false);
			jQuery('#plgfqdp_tblhd_lbl_color').attr('disabled',false);	
		}
	});
	jQuery('.plugify_shown_on_load').show();
	
});
