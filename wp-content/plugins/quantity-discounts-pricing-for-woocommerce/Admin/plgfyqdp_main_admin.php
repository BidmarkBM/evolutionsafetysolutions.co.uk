<?php
class PlugifyQDP_Admin_Main {
	public function __construct() {
		add_action('woocommerce_settings_plgfyqdp', array( $this, 'plgfyqdp_callback_against_mainsetting_content' ));
		add_filter('woocommerce_settings_tabs_array', array( $this, 'plgfyqdp_filter_woocommerce_settings_tabs' ), 50);
		add_action('admin_enqueue_scripts', array( $this, 'plgfyqdp_scripts_on_load1' ));
		add_action('init', array( $this, 'plgfyqdp_scripts_on_load1' ));
		add_action('admin_head', array( $this, 'plgfyqdp_scripts_on_load1' ));
		add_action('init', array($this, 'plugify_configure_old_rules' ));
	}




	public function plugify_configure_old_rules() {


		$plgfyqdp_all_rules=get_option('plgfyqdp_all_rules');
		if ('' == $plgfyqdp_all_rules) {
			$plgfyqdp_all_rules = array();
		}

		$all_new_rule = array();

		foreach ($plgfyqdp_all_rules as $rule_key => $rule_value) {

			if ('qty' == $rule_value['tabletyp'] ) {

				$rule_value['tabletyp'] = 'ranges';

				foreach ($rule_value['start_rng'] as $rng_key => $rng_value) {

					if ('==' == $rule_value['end_rng'][$rng_key]) {
						$rule_value['end_rng'][$rng_key]=$rng_value;
					} else if ('>=' == $rule_value['end_rng'][$rng_key]) {
						$rule_value['end_rng'][$rng_key]='999999';
					}
				}
			}
			array_push($all_new_rule , $rule_value);
		}
		$is_already_updated=get_option('plgfy_is_rules_updated');
		if ('yes_already_updated' != $is_already_updated) {
			update_option('plgfyqdp_all_rules', $all_new_rule);
			update_option('plgfy_is_rules_updated', 'yes_already_updated');
		}
	}

	
	public function plgfyqdp_filter_woocommerce_settings_tabs( $tabs ) {
		$tabs['plgfyqdp'] = __('Quantity Based Discounts', 'plugify_qdp');
		return $tabs;
	}
	public function plgfyqdp_callback_against_mainsetting_content() {
		?>
		
		
	
		<div class="">
			<button type="button" class="active_btn_pld butons_hide_shpw_ebem" id-atr="plgfytab1" ><i class="fa fa-fw fa-archive" aria-hidden="true"></i> <?php echo esc_html__('Product Discount Rules', 'plugify_qdp'); ?></button>
			<button type="button"  class="butons_hide_shpw_ebem" id-atr="plgfytab3" ><i class="fa fa-fw fa-shopping-cart" aria-hidden="true"></i> <?php echo esc_html__('Cart Discount Rules', 'plugify_qdp'); ?></button>
			<button type="button"  class="butons_hide_shpw_ebem" id-atr="plgfytab2" ><i class="fa fa-fw fa-cogs" aria-hidden="true"></i> <?php echo esc_html__('General Settings', 'plugify_qdp'); ?></button>
			

		</div>
		<div>

			<div id="plgfytab1" class="upperplfy" style="overflow:auto;">
				<div class=" plgfyqdp_main" style="padding:10px;">
					<?php include 'plgfyqdp_rules_qty.php'; ?>
				</div>
			</div>
			<div id="plgfytab3" class="upperplfy" style="display:none;overflow:auto;">
				<div class=" plgfyqdp_main" style="padding:10px;">
					<?php include 'plgfyqdp_cart_rules_qty.php'; ?>
				</div>
			</div>
			<div class="upperplfy" id="plgfytab2" style="display:none;overflow: auto;">
				<div class=" plgfyqdp_main" style="padding:10px;">
					<?php include 'plgfyqdp_general_settings_tab_html.php'; ?>
				</div>
			</div>

		</div>
		<script type="text/javascript">
			jQuery(document).ready(function(){
				jQuery('body').on('click', '.butons_hide_shpw_ebem', function(){
					jQuery('.upperplfy').hide();
					jQuery('.butons_hide_shpw_ebem').removeClass('active_btn_pld');
					jQuery(this).addClass('active_btn_pld');
					jQuery('#'+jQuery(this).attr('id-atr')).show();

				});
			});
		</script>

		<style type="text/css">
			.butons_hide_shpw_ebem:hover{
				color: #ae7b3b !important;
			}
			.butons_hide_shpw_ebem{
				cursor: pointer;
				line-height: 2.15384615;
				min-height: 30px;
				border-radius: 0px !important;		
				background-color: #f0f0f1 !important;		
				color: #46494c !important;
				margin-right: 5px !important;
				border: 1px solid #ae7b3b !important;
				border-bottom: unset !important;
				font-weight: 600 !important;
			}
			.active_btn_pld:hover{
				color: #FFF !important;
			}
			.active_btn_pld{
				background-color: #ae7b3b !important;	
				border: 1px solid #ae7b3b !important;	
				color: #fff !important;		
				font-weight: 900 !important;
				border-bottom: unset !important;
			}
		</style>
		<?php
	}
	public function plgfyqdp_scripts_on_load1() {

		if ( isset ($_GET['page']) && ( 'wc-settings' == $_GET['page'] && isset ( $_GET['tab'] ) && 'plgfyqdp' == $_GET['tab'] ) ) {
			wp_enqueue_script('datatables12', plugins_url( 'datatables.min.js', __FILE__ ), array( 'jquery' ), '1.0', 'all' );
			wp_enqueue_style('datatables21', 'https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.css', '1.0', 'all');
			wp_enqueue_style('date_picker_css_plgfyqdp', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css', false, '1.0', 'all');
			
			wp_enqueue_script('datepicker_plgfyqdp_alpha');
			wp_enqueue_script('colorpickearjs', plugins_url('js/jscolor.js', __FILE__), false, '1.0', 'all');
			wp_enqueue_style('demo_acss', plugins_url('css/plgfyqdp_admin_style.css', __FILE__), false, '1.0', 'all');
			wp_enqueue_script('my_custom_script_plgfyqdp', plugins_url('js/admin_main_ajax_jas.js', __FILE__) , false, '2.4', 'all' );
			$plgfyqdpData = array(
				'admin_url' => admin_url('admin-ajax.php'),
				'icon_url' => plugin_dir_url(__FILE__) . 'js/icons.yml',
				'loaderrr' => plugins_url() . '/quantity-discounts-pricing-for-woocommerce/Admin/Spinnerplgyfy.gif',
			);
			wp_localize_script('my_custom_script_plgfyqdp', 'plgfyqdpData', $plgfyqdpData);
			wp_enqueue_script( 'cselect2', plugins_url( 'js/select2.min.js', __FILE__ ), false, '1.0', 'all');
			wp_enqueue_style( 'cselect2css', plugins_url( 'js/select2.min.css', __FILE__ ), false, '1.0', 'all' );
			
		}
	}
}

new PlugifyQDP_Admin_Main();
