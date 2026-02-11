<?php

/**
 * Plugin Name: WooCommerce Zoho Bookings Importer
 * Description: Syncs Bookings data using Zoho Books standard CSV headers and maintains SKU visibility.
 * Version: 1.2.0
 * Author: DevWP
 */

if (! defined('ABSPATH')) exit;

class Zoho_Bookings_Sync_Importer
{

	private $csv_filename = 'items.csv';

	public function __construct()
	{
		// Admin Menu
		add_action('admin_menu', [$this, 'add_admin_menu']);

		// SKU UI Fixes: Keeps SKU field visible for Bookable products
		add_action('woocommerce_product_options_general_product_data', [$this, 'show_sku_field_in_general_tab']);
		add_action('woocommerce_process_product_meta', [$this, 'save_bookings_sku']);
	}

	public function add_admin_menu()
	{
		add_management_page(
			'Zoho Bookings Sync',
			'Zoho Sync',
			'manage_options',
			'zoho-bookings-sync',
			[$this, 'render_admin_page']
		);
	}

	/**
	 * UI FIX: Renders the SKU field in the General tab because Bookings hides the Inventory tab.
	 */
	public function show_sku_field_in_general_tab()
	{
		global $post;
		$product = wc_get_product($post->ID);

		// Only show this extra field if the product is a booking product (otherwise it shows in Inventory tab)
		if ($product && $product->is_type('booking')) {
			echo '<div class="options_group">';
			woocommerce_wp_text_input([
				'id'          => '_sku',
				'label'       => 'SKU (Zoho Sync)',
				'desc_tip'    => 'true',
				'description' => 'This SKU matches the Item SKU in Zoho Books.',
			]);
			echo '</div>';
		}
	}

	/**
	 * UI FIX: Ensures the SKU is saved correctly when the product is updated manually.
	 */
	public function save_bookings_sku($post_id)
	{
		$sku = isset($_POST['_sku']) ? wc_clean($_POST['_sku']) : '';
		if (!empty($sku)) {
			update_post_meta($post_id, '_sku', $sku);
		}
	}

	private function get_csv_path()
	{
		return plugin_dir_path(__FILE__) . $this->csv_filename;
	}

	public function run_sync($overwrite_content = false)
	{
		$file_path = $this->get_csv_path();

		if (! file_exists($file_path) || ! ($handle = fopen($file_path, "r"))) {
			return new WP_Error('file_missing', 'CSV file not found in: ' . $file_path);
		}

		$header = fgetcsv($handle);
		$updated_count = 0;
		$skipped_count = 0;

		while (($row = fgetcsv($handle)) !== FALSE) {
			$data = array_combine($header, $row);

			$sku = trim($data['SKU']);
			if (empty($sku)) continue;

			$product_id = wc_get_product_id_by_sku($sku);

			if ($product_id) {
				$this->process_zoho_row($product_id, $data, $overwrite_content);
				$updated_count++;
			} else {
				$skipped_count++;
			}
		}

		fclose($handle);
		return ['updated' => $updated_count, 'skipped' => $skipped_count];
	}

	private function process_zoho_row($product_id, $data, $overwrite_content)
	{
		// 1. FORCE TYPE: Ensure product is a booking product
		wp_set_object_terms($product_id, 'booking', 'product_type', false);

		// 2. Data Cleaning
		$cost = filter_var($data['Rate'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
		$qty  = filter_var($data['Stock On Hand'], FILTER_SANITIZE_NUMBER_INT);

		// 3. Set Critical Booking Meta
		$booking_product = get_wc_product_booking($product_id);
		if (! $booking_product) {
			return;
		}

		$booking_product->set_block_cost($cost);
		$booking_product->set_cost($cost);
		$booking_product->set_display_cost($cost);
		$booking_product->set_qty($qty);
		$booking_product->set_virtual(true);
		$booking_product->set_manage_stock(false);
		$booking_product->set_downloadable(false);
		$booking_product->set_sold_individually(false);
		$booking_product->save();

		// 4. Optional Title and Description Overwrite
		if ($overwrite_content) {
			wp_update_post([
				'ID'           => $product_id,
				'post_title'   => $data['Item Name'],
				'post_content' => $data['Description']
			]);
		}

		// 5. Clear cache and transients
		wc_delete_product_transients($product_id);
	}

	public function render_admin_page()
	{
		$results = null;

		if (isset($_POST['run_zoho_sync'])) {
			check_admin_referer('zoho_sync_action', 'zoho_nonce');
			$overwrite = isset($_POST['overwrite_content']) ? true : false;
			$results = $this->run_sync($overwrite);
		}
?>
		<div class="wrap">
			<h1>Zoho Books → WooCommerce Bookings</h1>
			<div class="card" style="max-width: 600px; padding: 20px;">
				<p><strong>Step 1:</strong> Export "Items" from Zoho Books as a CSV.</p>
				<p><strong>Step 2:</strong> Rename the file to <code>items.csv</code> and upload it to:<br>
					<code><?php echo $this->get_csv_path(); ?></code>
				</p>

				<hr>

				<form method="post">
					<?php wp_nonce_field('zoho_sync_action', 'zoho_nonce'); ?>

					<p>
						<label>
							<input type="checkbox" name="overwrite_content" value="1">
							<strong>Overwrite Titles & Descriptions?</strong>
						</label>
						<br><small>If unchecked, only Pricing (Rate) and Quantity (Stock on Hand) will be synced.</small>
					</p>

					<input type="submit" name="run_zoho_sync" class="button button-primary" value="Sync from Zoho CSV">
				</form>
			</div>

			<?php if (is_array($results)) : ?>
				<div class="updated notice is-dismissible" style="margin-top: 20px;">
					<p><strong>Sync Complete:</strong></p>
					<ul>
						<li>Products Updated: <?php echo $results['updated']; ?></li>
						<li>SKUs not found in WooCommerce: <?php echo $results['skipped']; ?></li>
					</ul>
				</div>
			<?php elseif (is_wp_error($results)) : ?>
				<div class="error notice">
					<p><?php echo $results->get_error_message(); ?></p>
				</div>
			<?php endif; ?>
		</div>
<?php
	}
}

new Zoho_Bookings_Sync_Importer();
