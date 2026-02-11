<?php
namespace Barn2\Plugin\WC_Product_Options\Handlers;

use Barn2\Plugin\WC_Product_Options\Model\Option as Option_Model;
use Barn2\Plugin\WC_Product_Options\Util\Price as Price_Util;
use Barn2\Plugin\WC_Product_Options\Util\Util;
use Barn2\Plugin\WC_Product_Options\Dependencies\Lib\Registerable;
use Barn2\Plugin\WC_Product_Options\Dependencies\Lib\Service\Standard_Service;

use Automattic\WooCommerce\StoreApi\Utilities\CartTokenUtils;
use WC_Cache_Helper;
use const WC_SESSION_CACHE_GROUP;

/**
 * Cart Handler
 *
 * @package   Barn2\woocommerce-product-options
 * @author    Barn2 Plugins <support@barn2.com>
 * @license   GPL-3.0
 * @copyright Barn2 Media Ltd
 */
class Cart implements Registerable, Standard_Service {

	/**
	 * {@inheritdoc}
	 */
	public function register() {
		add_action( 'woocommerce_before_calculate_totals', [ $this, 'option_price_calculation' ], 11, 1 );
		add_action( 'woocommerce_before_mini_cart', [ $this, 'force_mini_cart_calculation' ], 1 );
		// add_action( 'get_template_part_content', [ $this, 'add_checkout_link' ] );
	}

	/**
	 * Calculates the product addon pricing in the cart.
	 *
	 * @param WC_Cart $cart
	 */
	public function option_price_calculation( $cart ) {
		// Prevent multiple recalculations in a single request
		// which might happen if WooCommerce or other third-party components
		// need to recalculate the cart multiple times
		if ( did_action( 'woocommerce_before_calculate_totals' ) > 1 ) {
			return;
		}

		do_action( 'wc_product_options_before_cart_items_calculation', $cart );

		foreach ( $cart->get_cart_contents() as $cart_item_key => $cart_item ) {
			do_action( 'wc_product_options_before_cart_item_calculation', $cart, $cart_item );

			if ( ! isset( $cart_item['wpo_options'] ) ) {
				continue;
			}

			$product = $cart_item['data'];

			if ( ! Util::is_allowed_product_type( $product->get_type() ) ) {
				continue;
			}

			/**
			 * Filters whether to allow product option price calculation on a product.
			 *
			 * @param bool $enable Whether to allow product option price calculation on a product.
			 * @param \WC_Product $product The product which is being calculated.
			 * @param array|null $cart_item The cart item if this is calculated in the cart.
			 */
			$calculation_enabled = apply_filters( 'wc_product_options_enable_price_calculation', true, $product, $cart_item );

			if ( ! $calculation_enabled ) {
				continue;
			}

			if ( isset( $cart_item['wholesale_pro']['is_wholesale_price'] ) && $cart_item['wholesale_pro']['is_wholesale_price'] === true ) {
				$product_price = $product->get_price();
			} else {
				$product_price = $product->is_on_sale() ? $product->get_sale_price() : $product->get_regular_price();
			}

			$options_price = $this->calculate_options_price( $cart_item, $product_price );

			// if $option_data was changed, update it in the cart
			$cart->cart_contents[ $cart_item_key ] = $cart_item;
			$cart->set_session();

			// Calculate the final price
			$final_price = Option_Model::get_product_price_exclusion_status( $product ) ? $options_price : (float) $product_price + $options_price;

			/**
			 * Filters the condition determing whether negative prices are allowed.
			 *
			 * @param bool $allow_negative_prices Whether negative prices are allowed.
			 * @param \WC_Product $product The product which is being calculated.
			 * @param array $cart_item The cart item.
			 */
			$allow_negative_prices = apply_filters( 'wc_product_options_allow_negative_prices', false, $product, $cart_item );

			if ( ! $allow_negative_prices ) {
				$final_price = max( 0, $final_price );
			}

			// Set the final price of the cart item product
			$product->set_price( $final_price );

			do_action( 'wc_product_options_after_cart_item_calculation', $cart, $cart_item );
		}

		do_action( 'wc_product_options_after_cart_items_calculation', $cart );
	}

	/**
	 * Workaround - https://github.com/woocommerce/woocommerce/issues/26422
	 */
	public function force_mini_cart_calculation() {
		if ( is_cart() || is_checkout() || ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) {
			return;
		}

		// if ( ! defined( 'WOOCOMMERCE_CART' ) ) {
		// define( 'WOOCOMMERCE_CART', true );
		// }

		WC()->cart->calculate_totals();
	}


	/**
	 * Calculates the price of the product options.
	 *
	 * @param array $cart_item
	 * @param float $product_price
	 * @return float
	 */
	private function calculate_options_price( &$cart_item, $product_price ): float {
		$options_price  = 0;
		$options_data   = $cart_item['wpo_options'];
		$product        = $cart_item['data'];
		$quantity       = $cart_item['quantity'];
		$is_order_again = filter_input( INPUT_GET, 'order_again', FILTER_VALIDATE_INT ) > 0;

		foreach ( $options_data as $option_id => $option_data ) {
			if ( ! isset( $option_data['choice_data'] ) ) {
				continue;
			}

			$price_change = 0;
			$option_type  = $option_data['type'];

			foreach ( $option_data['choice_data'] as $choice_index => $choice_data ) {
				if ( ! isset( $choice_data['pricing'] ) ) {
					continue;
				}

				if ( $option_type === 'price_formula' && ( $is_order_again || Option_Model::formula_includes_product_quantity( $option_id ) ) ) {
					$choice_data['pricing']['amount']                           = Price_Util::evaluate_cart_item_formula( $option_data['option_id'], $cart_item ) ?? 0;
					$options_data[ $option_id ]['choice_data'][ $choice_index ] = $choice_data;
				}

				$price_change += Price_Util::calculate_option_cart_price( $choice_data['pricing'], $product, $quantity, $product_price );
			}

			$options_price += $price_change;
		}

		$cart_item['wpo_options'] = $options_data;

		return $options_price;
	}

	/**
	 * Adds a checkout link above the cart for shop managers to share the cart with customers.
	 *
	 * This feature requires WooCommerce Store API to be active.
	 * The link includes a session token that allows customers to access the cart without logging in.
	 * Only shop managers can see this link.
	 *
	 * @return void
	 */
	public function add_checkout_link() {
		if (
			! is_cart() ||
			! class_exists( 'Automattic\WooCommerce\StoreApi\Utilities\CartTokenUtils' ) ||
			! current_user_can( 'manage_woocommerce' ) ||
			WC()->cart->is_empty()
		) {
			return;
		}

		global $wpdb;
		$customer_id     = wc()->session->get_customer_id();
		$session_data    = wc()->session->get_session( $customer_id, [] );
		$session_data    = array_diff_key( $session_data, [ 'customer' => true ] );
		$serialized_data = maybe_serialize( $session_data );

		// Search for a session with the same exact cart content
		$session_key = $wpdb->get_var(
			$wpdb->prepare(
				'SELECT `session_key` FROM %i WHERE `session_key` LIKE "t_%%" and `session_value` = %s LIMIT 1',
				$wpdb->prefix . 'woocommerce_sessions',
				$serialized_data
			)
		);

		if ( $session_key ) {
			// A guest session was found with the same exact cart content.
			// Use that session key instead of generating a new one.
			$guest_user_id = $session_key;
		} else {
			// Insert a new session row with the current session data
			$guest_user_id = wc_rand_hash( 't_', 30 );
			$expiration    = time() + intval( apply_filters( 'wc_session_expiration', 2 * DAY_IN_SECONDS ) );

			$wpdb->query(
				$wpdb->prepare(
					'INSERT INTO %i (`session_key`, `session_value`, `session_expiry`) VALUES (%s, %s, %d)
						ON DUPLICATE KEY UPDATE `session_value` = VALUES(`session_value`), `session_expiry` = VALUES(`session_expiry`)',
					$wpdb->prefix . 'woocommerce_sessions',
					$guest_user_id,
					$serialized_data,
					$expiration
				)
			);
			wp_cache_set( WC_Cache_Helper::get_cache_prefix( WC_SESSION_CACHE_GROUP ) . $guest_user_id, $session_data, WC_SESSION_CACHE_GROUP, $expiration - time() );
		}

		$session_token     = CartTokenUtils::get_cart_token( (string) $guest_user_id );
		$checkout_link_url = add_query_arg( 'session', $session_token, wc_get_checkout_url() );
		?>

		<div class="wpo-checkout-link woocommerce-info">
			<div class="notice-title">Shop managers only!</div>
			<div class="notice-description">Share this cart with your customers by sending them the checkout link below:</div>
			<div class="copy-wrapper" title="Share this checkout link with your customers.">
				<input type="text" class="copy-url" value="<?php echo esc_url( $checkout_link_url ); ?>" readonly>
				<button type="button" class="copy-button button alt">
					<svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px" fill="currentColor"><path d="M360-240q-29.7 0-50.85-21.15Q288-282.3 288-312v-480q0-29.7 21.15-50.85Q330.3-864 360-864h384q29.7 0 50.85 21.15Q816-821.7 816-792v480q0 29.7-21.15 50.85Q773.7-240 744-240H360Zm0-72h384v-480H360v480ZM216-96q-29.7 0-50.85-21.15Q144-138.3 144-168v-552h72v552h456v72H216Zm144-216v-480 480Z"/></svg>
					Copy
				</button>
				<div class="copy-tooltip">Copied!</div>
			</div>
		</div>
		<?php
	}
}
