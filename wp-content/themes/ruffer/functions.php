<?php

/**
 * @Packge     : Ruffer
 * @Version    : 1.0
 * @Author     : Themeholy
 * @Author URI : https://www.themeholy.com/
 *
 */

// Block direct access
if (! defined('ABSPATH')) {
	exit;
}

/**
 * Include File
 *
 */

// Constants
require_once get_parent_theme_file_path() . '/inc/ruffer-constants.php';

//theme setup
require_once RUFFER_DIR_PATH_INC . 'theme-setup.php';

//essential scripts
require_once RUFFER_DIR_PATH_INC . 'essential-scripts.php';

// Woo Hooks
require_once RUFFER_DIR_PATH_INC . 'woo-hooks/ruffer-woo-hooks.php';

// Woo Hooks Functions
require_once RUFFER_DIR_PATH_INC . 'woo-hooks/ruffer-woo-hooks-functions.php';

// plugin activation
require_once RUFFER_DIR_PATH_FRAM . 'plugins-activation/ruffer-active-plugins.php';

// theme dynamic css
require_once RUFFER_DIR_PATH_INC . 'ruffer-commoncss.php';

// meta options
require_once RUFFER_DIR_PATH_FRAM . 'ruffer-meta/ruffer-config.php';

// page breadcrumbs
require_once RUFFER_DIR_PATH_INC . 'ruffer-breadcrumbs.php';

// sidebar register
require_once RUFFER_DIR_PATH_INC . 'ruffer-widgets-reg.php';

//essential functions
require_once RUFFER_DIR_PATH_INC . 'ruffer-functions.php';

// helper function
require_once RUFFER_DIR_PATH_INC . 'wp-html-helper.php';

// Demo Data
require_once RUFFER_DEMO_DIR_PATH . 'demo-import.php';

// pagination
require_once RUFFER_DIR_PATH_INC . 'wp_bootstrap_pagination.php';

// ruffer options
require_once RUFFER_DIR_PATH_FRAM . 'ruffer-options/ruffer-options.php';

// hooks
require_once RUFFER_DIR_PATH_HOOKS . 'hooks.php';

// hooks funtion
require_once RUFFER_DIR_PATH_HOOKS . 'hooks-functions.php';

/**
 * AJAX Load More Posts Function
 */
function load_more_posts()
{
	// Verify nonce for security
	check_ajax_referer('load_more_posts_nonce', 'nonce');

	// Get the page number from the AJAX request
	$paged = isset($_POST['page']) ? intval($_POST['page']) : 1;

	// Set up query arguments for loading more posts
	$args = array(
		'post_type'      => 'post',
		'post_status'    => 'publish',
		'paged'          => $paged,
		'posts_per_page' => get_option('posts_per_page'),
	);

	$query = new WP_Query($args);

	// Check if there are posts
	if ($query->have_posts()) :
		ob_start();
		while ($query->have_posts()) : $query->the_post();
			get_template_part('template-parts/content', get_post_format());
		endwhile;
		$output = ob_get_clean();
		wp_reset_postdata();
		wp_send_json_success($output);
	else :
		wp_send_json_error(array('message' => 'No more posts'));
	endif;
	wp_die();
}

// Hook for logged-in users
add_action('wp_ajax_load_more_posts', 'load_more_posts');
// Hook for non-logged-in users
add_action('wp_ajax_nopriv_load_more_posts', 'load_more_posts');

// Remove default pagination (if using Load More)
remove_action('ruffer_blog_pagination', 'ruffer_blog_pagination_cb', 10);

/**
 * Display Category Name, Description, and Search Bar at the Top of Product Category Page
 */
add_action('woocommerce_before_main_content', 'custom_show_category_name_description', 5);
function custom_show_category_name_description()
{
	if (is_product_category()) {
		$category_name = esc_html(single_cat_title('', false));
		$category_description = wp_kses_post(category_description());
		$current_category = get_queried_object();
		$category_slug = $current_category->slug;
?>
		<div class="custom-category-header" style="margin-bottom: 20px; padding: 20px; background-color: #f8f9fa; border-radius: 5px;">
			<h1 class="category-title" style="font-size: 2em; margin-bottom: 10px; color: #333;"><?php echo $category_name; ?></h1>
			<?php if (!empty($category_description)) : ?>
				<div class="category-description" style="font-size: 1em; color: #666; line-height: 1.6; margin-bottom: 15px;"><?php echo $category_description; ?></div>
			<?php endif; ?>
			<form role="search" method="get" class="category-search-form" action="<?php echo esc_url(home_url('/')); ?>" style="display: flex; align-items: center; gap: 10px;">
				<input type="search" class="search-field" placeholder="Search products in this category..." value="<?php echo get_search_query(); ?>" name="s" style="padding: 8px; border: 1px solid #ddd; border-radius: 4px;" />
				<input type="hidden" name="post_type" value="product" />
				<input type="hidden" name="product_cat" value="<?php echo esc_attr($category_slug); ?>" />
				<button type="submit" style="padding: 8px 15px; background-color: #007bff; color: #fff; border: none; border-radius: 4px; cursor: pointer;">Search</button>
			</form>
		</div>
	<?php
	}
}


/**
 * Replace 'Ruffer' with 'Evolution Safety Solutions' in content
 */
add_filter('the_content', 'ess_replace_ruffer_in_content');
function ess_replace_ruffer_in_content($content)
{
	return str_replace('Ruffer', 'Evolution Safety Solutions', $content);
}



function disable_multiple_anchors_script()
{
	?>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			// Target both selectors
			$('.service-box h3.box-title a, .service-featured_content h3.box-title a')
				.removeAttr('href')
				.css({
					'pointer-events': 'none',
					'cursor': 'default',
					'text-decoration': 'none',
					'color': 'inherit'
				})
				.hover(
					function() {
						$(this).css('color', 'white'); // Hover in
					},
					function() {
						$(this).css('color', 'inherit'); // Hover out
					}
				);
		});
	</script>
<?php
}
add_action('wp_footer', 'disable_multiple_anchors_script');


// Single product page par "Add to cart" button ka text change karna
add_filter('woocommerce_product_single_add_to_cart_text', 'custom_single_add_to_cart_text');
function custom_single_add_to_cart_text()
{
	return __('Book Now', 'woocommerce'); // Apna custom text yahan likhein
}


// Add "View Course" button after each product in the loop
add_action('woocommerce_after_shop_loop_item', 'add_view_course_button', 10);

function add_view_course_button()
{
	global $product;
	$product = wc_get_product();
	$link = $product->get_permalink();
	echo '<a href="' . esc_url($link) . '" class="view-course-button">View Course</a>';
}




// 
// 
// 
// 
// 
// 

/*
 * Internal Function for Fluent Forms Custom Slug
 * Do not EDIT this function
 */
function customFfLandingPageSlug($slug)
{
	add_action('init', function () use ($slug) {
		add_rewrite_endpoint($slug, EP_ALL);
	});
	add_action('wp', function () use ($slug) {
		global $wp_query;
		if (isset($wp_query->query_vars[$slug])) {
			$formString = $wp_query->query_vars[$slug];
			if (!$formString) {
				return;
			}
			$array = explode('/', $formString);

			$formId = $array[0];

			if (!$formId || !is_numeric($formId)) {
				return;
			}

			$secretKey = '';
			if (count($array) > 1) {
				$secretKey = $array[1];
			}

			$paramKey = apply_filters('fluentform/conversational_url_slug', 'fluent-form');

			$_GET[$paramKey] = $formId;
			$_REQUEST[$paramKey] = $formId;

			$request = wpFluentForm('request');
			$request->set($paramKey, $formId);
			$request->set('form', $secretKey);
		}
	});
}

/*
 * Creating custom slug for conversational form landing page
 *
 * my-forms is your custom slug for the form
 * if your form id is 123 then the landing page url will be then
 * https://your-domain.com/my-forms/123
 * if you use Security Code on conversational form then the url will be
 * https://your-domain.com/my-forms-x/123/SECURITY-CODE
 *
 * After paste the code to your theme's functions.php file please re-save the permalink settings
*/

customFfLandingPageSlug('https://evolutionsafetysolutions.co.uk/contact-us-evolution-safety-solutions/'); // you may change the "my-forms" for your own page slug



add_action('fluentform_submission_success', 'custom_redirect_with_entry_id', 10, 3);
function custom_redirect_with_entry_id($entryId, $formData, $form)
{
	if ($form->id == 1) { // Form ID 1 ke liye
		$redirect_url = 'https://staging-6489-evolutionsafetysolutions.wpcomstaging.com/thank-you/?ff_entry_id=' . $entryId;
		// Fields ke data pass karna (agar Redirect Query String use kar rahe hain)
		if (!empty($formData['full_name'])) {
			$redirect_url .= '&name=' . urlencode($formData['full_name']);
		}
		if (!empty($formData['input_email'])) {
			$redirect_url .= '&email=' . urlencode($formData['input_email']);
		}
		wp_redirect($redirect_url);
		exit;
	}
}

add_shortcode('display_url_submission', 'show_url_submission_data');
function show_url_submission_data()
{
	$name = isset($_GET['name']) ? sanitize_text_field($_GET['name']) : 'N/A';
	$email = isset($_GET['email']) ? sanitize_email($_GET['email']) : 'N/A';
	$output = '<p>Name: ' . esc_html($name) . '</p>';
	$output .= '<p>Email: ' . esc_html($email) . '</p>';
	return $output;
}

function open_links_in_new_tab_about_slides()
{
?>
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			const links = document.querySelectorAll(".about-slides a");

			links.forEach(link => {
				link.setAttribute("target", "_blank");
				link.setAttribute("rel", "noopener noreferrer");
			});
		});
	</script>
	<?php
}
add_action('wp_footer', 'open_links_in_new_tab_about_slides');

/*

function force_post_only_search_results( $query ) {
    if (
        $query->is_search() &&
        !is_admin() &&
        $query->is_main_query() &&
        isset($_GET['force_post_only_search']) &&
        $_GET['force_post_only_search'] === '1'
    ) {
        // Include posts and products in search results
        $query->set( 'post_type', array( 'post', 'product' ) );
    }
}
add_action( 'pre_get_posts', 'force_post_only_search_results' );

*/

add_action('wp_footer', 'cf7_redirect_thank_you');
function cf7_redirect_thank_you()
{
	if (is_page()) {
	?>
		<script>
			document.addEventListener('wpcf7mailsent', function(event) {
				window.location.href = "https://evolutionsafetysolutions.co.uk/thank-you/";
			}, false);
		</script>
	<?php
	}
}


// 	add_action('the_content', 'add_title_above_post_content');

// function add_title_above_post_content($content) {
//     if (is_single() && in_the_loop() && is_main_query()) {
//         $title = '<h1 style="text-align:center; margin-bottom:20px;" class="heading-name">' . get_the_title() . '</h1>';
//         return $title . $content;
//     }
//     return $content;
// }


function replace_view_course_buffer_start()
{
	ob_start('replace_view_course_text_in_buffer');
}
add_action('template_redirect', 'replace_view_course_buffer_start');

function replace_view_course_text_in_buffer($buffer)
{
	return str_replace('View Course', 'View Options', $buffer);
}


function display_single_post_title_h1()
{
	if (is_single()) { // Check karta hai ke single post page hai
		echo '<h1 style="text-align: center;">' . get_the_title() . '</h1>';
	}
}
add_action('wp_hook_before_content', 'display_single_post_title_h1');


add_action('woocommerce_before_shop_loop', 'add_ivory_search_shortcode_to_specific_categories', 20);
function add_ivory_search_shortcode_to_specific_categories()
{
	// Check if we are on the HSEQ Consultancy or Learning & Development category pages
	if (is_product_category('hseq-consultancy') || is_product_category('learning-development')) {
		echo do_shortcode('[ivory-search id="23816" title="AJAX Search Form for WooCommerce"]');
	}
}

function custom_universal_search_form()
{
	ob_start();
	?>
	<form role="search" method="get" class="custom-search-form" action="<?php echo home_url('/'); ?>">
		<input type="search" class="search-field" placeholder="Search..." value="<?php echo get_search_query(); ?>" name="s" />
		<input type="hidden" name="post_type" value="product" />
		<button type="submit" class="search-submit">
			<img src="https://upload.wikimedia.org/wikipedia/commons/5/55/Magnifying_glass_icon.svg" alt="Search">
		</button>
	</form>
<?php
	return ob_get_clean();
}
add_shortcode('universal_search', 'custom_universal_search_form');



// Add search icon with custom class inside .header-button
add_action('wp_footer', 'insert_icon_into_header_button_with_class');
function insert_icon_into_header_button_with_class()
{
?>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			if ($('.header-button').length && $('.header-button i.far.fa-search.my-custom-icon').length === 0) {
				$('.header-button').append('<i class="far fa-search my-custom-icon"></i>');
			}
		});
	</script>
<?php
}


// Insert icon and trigger .search-icon a.elementor-icon on click
add_action('wp_footer', 'insert_icon_and_trigger_search_anchor');
function insert_icon_and_trigger_search_anchor()
{
?>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			// Step 1: Add the icon with custom class if not already added
			if ($('.header-button').length && $('.header-button i.far.fa-search.my-custom-icon').length === 0) {
				$('.header-button').append('<i class="far fa-search my-custom-icon"></i>');
			}

			// Step 2: On icon click, trigger anchor click
			$(document).on('click', 'i.my-custom-icon', function() {
				$('.search-icon a.elementor-icon')[0]?.click();
			});
		});
	</script>
	<?php
}



add_action('wp_footer', 'add_call_us_link_script_clean');
function add_call_us_link_script_clean()
{
	if (is_product()) {
	?>
		<script type="text/javascript">
			document.addEventListener("DOMContentLoaded", function() {
				let bookNowBtn = document.querySelector('.single-product .cart .th-btn[name="add-to-cart"]');
				if (bookNowBtn) {
					let callLink = document.createElement("a");
					callLink.href = "tel:03333399037";
					callLink.className = "call-us";
					callLink.textContent = "CALL US";
					bookNowBtn.parentNode.insertBefore(callLink, bookNowBtn.nextSibling);
				}
			});
		</script>
	<?php
	}
}
add_action('woocommerce_before_shop_loop', 'add_search_to_shop_page', 5);

function add_search_to_shop_page()
{
	if (is_shop()) {
		echo do_shortcode('[ivory-search id="23816" title="AJAX Search Form for WooCommerce"]');
	}
}

// Change the "Have a coupon?" banner text
add_filter('woocommerce_checkout_coupon_message', function () {
	return 'Got a promo? <a href="#" class="showcoupon">Click here to enter it</a>';
});

// Change the "Apply coupon" button text
add_filter('woocommerce_coupon_apply_button_text', function ($text) {
	return 'Apply Promo';
});

// Change the coupon input placeholder using JavaScript
add_action('wp_footer', function () {
	if (is_checkout()) {
	?>
		<script type="text/javascript">
			document.addEventListener('DOMContentLoaded', function() {
				var input = document.querySelector('#coupon_code');
				if (input) {
					input.placeholder = 'Enter Promo Code';
				}
				var button = document.querySelector('button[name="apply_coupon"]');
				if (button) {
					button.textContent = 'Apply Promo';
				}
			});
		</script>
	<?php
	}
});
add_action('wp_footer', 'move_custom_note_below_heading');
function move_custom_note_below_heading()
{
	if (is_checkout()) {
	?>
		<script>
			document.addEventListener("DOMContentLoaded", function() {
				let heading = document.querySelector('h3#order_review_heading');
				let noteSection = document.querySelector('.custom-note-above-order-notes');
				let orderNotes = document.querySelector('#order_comments_field');

				if (!noteSection && orderNotes) {
					const customNote = document.createElement('div');
					customNote.className = 'custom-note-above-order-notes';
					customNote.style.cssText = 'margin-bottom: 10px; font-size: 14px;';
					customNote.innerHTML = 'Please note: Learner details are required. Whether you are booking for one person or multiple people, please ensure you include their full names and email addresses so we can send them the joining instructions.';
					orderNotes.parentNode.insertBefore(customNote, orderNotes);
				}
			});
		</script>
	<?php
	}
}


add_filter('woocommerce_checkout_fields', 'make_company_name_optional');

function make_company_name_optional($fields)
{
	// Set the 'company' field as not required
	$fields['billing']['billing_company']['required'] = false;

	return $fields;
}
/*

// Enqueue the ../assets/js/evo-woo-products.js file
function enqueue_evo_woo_products_script()
{
	wp_enqueue_script('evo-woo-products', get_stylesheet_directory_uri() . '/assets/js/evo-woo-products.js', array('jquery'), '1.0', true);

	// This makes 'evo_ajax_obj.ajax_url' available in your JS file
	wp_localize_script('evo-woo-products', 'evo_ajax_obj', array(
		'ajax_url' => admin_url('admin-ajax.php'),
	));
}
add_action('wp_enqueue_scripts', 'enqueue_evo_woo_products_script');

add_action('wp_ajax_evo_filter_products', 'evo_handle_ajax_filter');
add_action('wp_ajax_nopriv_evo_filter_products', 'evo_handle_ajax_filter');

function evo_handle_ajax_filter()
{
	$ids = isset($_POST['restricted']) ? $_POST['restricted'] : [];
	$tag = isset($_POST['tag']) ? sanitize_text_field($_POST['tag']) : '';
	$cat = isset($_POST['cat']) ? sanitize_text_field($_POST['cat']) : '';

	$widget = new \Elementor\Evo_Woo_Products_Widget();
	$widget->get_ajax_products($ids, $tag, $cat);

	wp_die();
}

function register_evo_woo_widget($widgets_manager)
{

	// 1. Point to the file location
	require_once(get_stylesheet_directory() . '/widgets/evo-woo-products.php');

	// 2. Register the class (ensure the namespace matches your file!)
	$widgets_manager->register(new \Elementor\Evo_Woo_Products_Widget());
}
add_action('elementor/widgets/register', 'register_evo_woo_widget');



function ess_elementor_admin_i18n_fallback($hook = '')
{
	if (
		! did_action('elementor/loaded')
		&& ! defined('ELEMENTOR_VERSION')
	) {
		return;
	}

	$is_elementor_screen = false;

	if (is_string($hook) && strpos($hook, 'elementor') !== false) {
		$is_elementor_screen = true;
	}

	if (isset($_GET['page']) && strpos(sanitize_text_field(wp_unslash($_GET['page'])), 'elementor') !== false) {
		$is_elementor_screen = true;
	}

	if (isset($_GET['action']) && sanitize_text_field(wp_unslash($_GET['action'])) === 'elementor') {
		$is_elementor_screen = true;
	}

	if (! $is_elementor_screen) {
		return;
	}

	wp_enqueue_script('wp-i18n');
	wp_enqueue_script('wp-util');

	wp_add_inline_script(
		'wp-i18n',
		'window.sprintf = window.sprintf || (window.wp && window.wp.i18n ? window.wp.i18n.sprintf : undefined);'
	);
}

add_action('admin_enqueue_scripts', 'ess_elementor_admin_i18n_fallback', 5);
add_action('elementor/editor/after_enqueue_scripts', 'ess_elementor_admin_i18n_fallback', 5);*/
/*

add_filter('woocommerce_is_shop', function ($is_shop) {
	if (is_page('your-landing-page-slug')) {
		return true;
	}
	return $is_shop;
});
add_shortcode('native_filterable_grid', function () {
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

	$args = array(
		'post_type'      => 'product',
		'posts_per_page' => 12,
		'paged'          => $paged,
		'status'         => 'publish',
	);

	// Apply the filters from the sidebar to the query
	$args = apply_filters('woocommerce_shortcode_products_query', $args);

	$query = new WP_Query($args);

	ob_start();

	if ($query->have_posts()) {

		echo '<div class="woocommerce columns-4">';
		// We use the standard WC loop start which usually outputs <ul>
		woocommerce_product_loop_start();

		while ($query->have_posts()) : $query->the_post();
			// This renders the theme's 'content-product.php'
			wc_get_template_part('content', 'product');
		endwhile;

		woocommerce_product_loop_end();

		// Pagination
		echo '<div class="pagination-wrapper">';
		echo paginate_links(array(
			'base'    => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
			'format'  => '?paged=%#%',
			'current' => max(1, $paged),
			'total'   => $query->max_num_pages
		));
		echo '</div>';
		echo '</div>';
	} else {
		echo '<p class="woocommerce-info">No products found matching your filters.</p>';
	}

	wp_reset_postdata();
	return ob_get_clean();
});


add_action('wp_footer', 'add_custom_css_for_woocommerce_grid');
function add_custom_css_for_woocommerce_grid()
{ ?>
	<style>
		.page .woocommerce.columns-4 .row {
			display: flex;
			flex-wrap: wrap;
			margin-right: -15px;
			margin-left: -15px;
		}

		.page .woocommerce.columns-4 .row .product-wrapper.product.type-product {
			flex: 0 0 25%;
			max-width: 25%;
			padding: 15px;
			box-sizing: border-box;
		}

		@media (max-width: 991px) {
			.page .woocommerce.columns-4 .row .product-wrapper.product.type-product {
				flex: 0 0 50%;
				max-width: 50%;
			}
		}

		@media (max-width: 575px) {
			.page .woocommerce.columns-4 .row .product-wrapper.product.type-product {
				flex: 0 0 100%;
				max-width: 100%;
			}
		}
	</style>
<?php }
*/


/**
 * Evo Filterable Products – a self-contained WooCommerce shortcode
 * that renders products from chosen categories with AJAX-powered filters.
 *
 * Usage:  [evo_products category="shoes,hats" per_page="12" columns="4"]
 *
 * Place this file in your theme (or child-theme) and require it from functions.php:
 *   require_once get_stylesheet_directory() . '/inc/evo-filterable-products.php';
 */

if (! defined('ABSPATH')) {
	exit;
}

/* ------------------------------------------------------------------ */
/*  1. Register the shortcode                                         */
/* ------------------------------------------------------------------ */
add_shortcode('evo_products', 'evo_products_shortcode');

function evo_products_shortcode($atts)
{

	$atts = shortcode_atts(array(
		'category'  => '',      // comma-separated category slugs
		'per_page'  => 12,
		'columns'   => 4,
		'orderby'   => 'menu_order title',
		'order'     => 'ASC',
	), $atts, 'evo_products');

	$categories = array_filter(array_map('trim', explode(',', $atts['category'])));
	$per_page   = absint($atts['per_page']);
	$columns    = absint($atts['columns']);

	// Generate a unique ID so multiple shortcodes on one page don't clash
	$uid = 'evo-' . substr(md5(wp_json_encode($atts) . wp_rand()), 0, 8);

	// Pre-compute facets for the initial state (no user filters yet, just category scope)
	$initial_facets = evo_compute_facets(array(
		'categories' => $categories,
		'orderby'    => $atts['orderby'],
		'order'      => $atts['order'],
	));

	ob_start();
	?>
	<div
		id="<?php echo esc_attr($uid); ?>"
		class="evo-filterable-products woocommerce columns-<?php echo esc_attr($columns); ?>"
		data-categories="<?php echo esc_attr(wp_json_encode($categories)); ?>"
		data-per-page="<?php echo esc_attr($per_page); ?>"
		data-columns="<?php echo esc_attr($columns); ?>"
		data-orderby="<?php echo esc_attr($atts['orderby']); ?>"
		data-order="<?php echo esc_attr($atts['order']); ?>"
		data-initial-facets="<?php echo esc_attr(wp_json_encode($initial_facets)); ?>">

		<div class="evo-layout">

			<!-- Sidebar filters -->
			<aside class="evo-sidebar">
				<div class="evo-sidebar-inner">
					<h3 class="evo-sidebar-title">Filter Products</h3>
					<?php evo_render_filters($categories, $uid); ?>
				</div>
			</aside>

			<!-- Main content area -->
			<div class="evo-main">

				<!-- Active-filter pills -->
				<div class="evo-active-filters" id="<?php echo esc_attr($uid); ?>-active"></div>

				<!-- Product grid (initial server-side render) -->
				<div class="evo-product-grid" id="<?php echo esc_attr($uid); ?>-grid">
					<?php
					evo_render_product_grid(array(
						'categories' => $categories,
						'per_page'   => $per_page,
						'paged'      => max(1, get_query_var('paged')),
						'orderby'    => $atts['orderby'],
						'order'      => $atts['order'],
					));
					?>
				</div>

				<!-- Loading overlay -->
				<div class="evo-loading" style="display:none;">
					<span class="evo-spinner"></span> Loading&hellip;
				</div>

			</div><!-- /.evo-main -->

		</div><!-- /.evo-layout -->

	</div>
<?php

	return ob_get_clean();
}

/* ------------------------------------------------------------------ */
/*  2. Render the filter controls                                     */
/* ------------------------------------------------------------------ */
function evo_render_filters($categories, $uid)
{

	// --- Search within results ---
	echo '<div class="evo-filter-group">';
	echo '<label class="evo-filter-label">Search</label>';
	echo '<input type="text" class="evo-filter-search" data-uid="' . esc_attr($uid) . '" placeholder="Search products…" />';
	echo '</div>';

	// --- Sort ---
	$sort_options = array(
		''           => 'Default sorting',
		'popularity' => 'Most popular',
		'rating'     => 'Highest rated',
		'date'       => 'Latest',
		'price'      => 'Price: low → high',
		'price-desc' => 'Price: high → low',
	);
	echo '<div class="evo-filter-group">';
	echo '<label class="evo-filter-label">Sort by</label>';
	echo '<select class="evo-filter-sort" data-uid="' . esc_attr($uid) . '">';
	foreach ($sort_options as $val => $label) {
		echo '<option value="' . esc_attr($val) . '">' . esc_html($label) . '</option>';
	}
	echo '</select>';
	echo '</div>';

	// --- Sub-categories (only children of the supplied cats) ---
	if (! empty($categories)) {
		$parent_ids = array();
		foreach ($categories as $slug) {
			$term = get_term_by('slug', $slug, 'product_cat');
			if ($term) {
				$parent_ids[] = $term->term_id;
			}
		}

		// Gather all descendant terms of the supplied categories
		$sub_terms = array();
		foreach ($parent_ids as $pid) {
			$kids = get_terms(array(
				'taxonomy'   => 'product_cat',
				'hide_empty' => true,
				'child_of'   => $pid,
			));
			if (! is_wp_error($kids)) {
				$sub_terms = array_merge($sub_terms, $kids);
			}
		}

		if (! empty($sub_terms)) {
			echo '<div class="evo-filter-group">';
			echo '<label class="evo-filter-label">Category</label>';
			echo '<select class="evo-filter-subcat" data-uid="' . esc_attr($uid) . '">';
			echo '<option value="">All categories</option>';
			foreach ($sub_terms as $t) {
				echo '<option value="' . esc_attr($t->slug) . '">' . esc_html($t->name) . '</option>';
			}
			echo '</select>';
			echo '</div>';
		}
	}

	// --- Product tags ---
	$tags = get_terms(array(
		'taxonomy'   => 'product_tag',
		'hide_empty' => true,
	));
	if (! empty($tags) && ! is_wp_error($tags)) {
		echo '<div class="evo-filter-group">';
		echo '<label class="evo-filter-label">Tag</label>';
		echo '<select class="evo-filter-tag" data-uid="' . esc_attr($uid) . '">';
		echo '<option value="">All tags</option>';
		foreach ($tags as $tag) {
			echo '<option value="' . esc_attr($tag->slug) . '">' . esc_html($tag->name) . '</option>';
		}
		echo '</select>';
		echo '</div>';
	}

	// --- Product attributes (e.g. colour, size) ---
	$attribute_taxonomies = wc_get_attribute_taxonomies();
	if ($attribute_taxonomies) {
		foreach ($attribute_taxonomies as $attr) {
			$taxonomy = wc_attribute_taxonomy_name($attr->attribute_name);
			$terms    = get_terms(array(
				'taxonomy'   => $taxonomy,
				'hide_empty' => true,
			));
			if (! empty($terms) && ! is_wp_error($terms)) {
				echo '<div class="evo-filter-group">';
				echo '<label class="evo-filter-label">' . esc_html($attr->attribute_label) . '</label>';
				echo '<select class="evo-filter-attribute" data-taxonomy="' . esc_attr($taxonomy) . '" data-uid="' . esc_attr($uid) . '">';
				echo '<option value="">All ' . esc_html($attr->attribute_label) . '</option>';
				foreach ($terms as $term) {
					echo '<option value="' . esc_attr($term->slug) . '">' . esc_html($term->name) . '</option>';
				}
				echo '</select>';
				echo '</div>';
			}
		}
	}

	// --- Price range (min / max inputs) ---
	echo '<div class="evo-filter-group">';
	echo '<label class="evo-filter-label">Price range</label>';
	echo '<div class="evo-price-filter" data-uid="' . esc_attr($uid) . '">';
	echo '<input type="number" class="evo-filter-min-price" placeholder="Min" min="0" step="1" />';
	echo '<input type="number" class="evo-filter-max-price" placeholder="Max" min="0" step="1" />';
	echo '<button type="button" class="evo-price-go button">Apply</button>';
	echo '</div>';
	echo '</div>';
}
/* ------------------------------------------------------------------ */
/*  3a. Query-args builder – shared helper used by render + facets    */
/* ------------------------------------------------------------------ */
function evo_build_query_args($params)
{
	$categories  = isset($params['categories'])  ? (array) $params['categories'] : array();
	$orderby_raw = isset($params['orderby'])      ? sanitize_text_field($params['orderby']) : 'menu_order title';
	$order_raw   = isset($params['order'])        ? sanitize_text_field($params['order']) : 'ASC';
	$sub_cat     = isset($params['sub_cat'])      ? sanitize_text_field($params['sub_cat']) : '';
	$tag         = isset($params['tag'])          ? sanitize_text_field($params['tag']) : '';
	$attributes  = isset($params['attributes'])   ? (array) $params['attributes'] : array();
	$min_price   = isset($params['min_price'])    ? $params['min_price'] : '';
	$max_price   = isset($params['max_price'])    ? $params['max_price'] : '';
	$search      = isset($params['search'])       ? sanitize_text_field($params['search']) : '';
	$sort        = isset($params['sort'])         ? sanitize_text_field($params['sort']) : '';

	$args = array(
		'post_type'   => 'product',
		'post_status' => 'publish',
	);

	switch ($sort) {
		case 'popularity':
			$args['meta_key'] = 'total_sales';
			$args['orderby']  = 'meta_value_num';
			$args['order']    = 'DESC';
			break;
		case 'rating':
			$args['meta_key'] = '_wc_average_rating';
			$args['orderby']  = 'meta_value_num';
			$args['order']    = 'DESC';
			break;
		case 'date':
			$args['orderby'] = 'date';
			$args['order']   = 'DESC';
			break;
		case 'price':
			$args['meta_key'] = '_price';
			$args['orderby']  = 'meta_value_num';
			$args['order']    = 'ASC';
			break;
		case 'price-desc':
			$args['meta_key'] = '_price';
			$args['orderby']  = 'meta_value_num';
			$args['order']    = 'DESC';
			break;
		default:
			$args['orderby'] = $orderby_raw;
			$args['order']   = $order_raw;
			break;
	}

	if ($search) {
		$args['s'] = $search;
	}

	$tax_query = array('relation' => 'AND');

	if (! empty($categories)) {
		$tax_query[] = array(
			'taxonomy' => 'product_cat',
			'field'    => 'slug',
			'terms'    => $categories,
			'operator' => 'IN',
		);
	}

	if ($sub_cat) {
		$tax_query[] = array(
			'taxonomy' => 'product_cat',
			'field'    => 'slug',
			'terms'    => array($sub_cat),
		);
	}

	if ($tag) {
		$tax_query[] = array(
			'taxonomy' => 'product_tag',
			'field'    => 'slug',
			'terms'    => array($tag),
		);
	}

	foreach ($attributes as $taxonomy => $slug) {
		if ($slug) {
			$tax_query[] = array(
				'taxonomy' => sanitize_text_field($taxonomy),
				'field'    => 'slug',
				'terms'    => array(sanitize_text_field($slug)),
			);
		}
	}

	$tax_query[] = array(
		'taxonomy' => 'product_visibility',
		'field'    => 'name',
		'terms'    => 'exclude-from-catalog',
		'operator' => 'NOT IN',
	);

	$args['tax_query'] = $tax_query;

	$meta_query = array();
	if ($min_price !== '' && $min_price !== false) {
		$meta_query[] = array(
			'key'     => '_price',
			'value'   => floatval($min_price),
			'compare' => '>=',
			'type'    => 'NUMERIC',
		);
	}
	if ($max_price !== '' && $max_price !== false) {
		$meta_query[] = array(
			'key'     => '_price',
			'value'   => floatval($max_price),
			'compare' => '<=',
			'type'    => 'NUMERIC',
		);
	}
	if (! empty($meta_query)) {
		$meta_query['relation'] = 'AND';
		$args['meta_query']     = $meta_query;
	}

	return $args;
}

/* ------------------------------------------------------------------ */
/*  3b. Render the product grid (used both server-side & via AJAX)    */
/* ------------------------------------------------------------------ */
function evo_render_product_grid($params)
{
	$per_page = isset($params['per_page']) ? absint($params['per_page']) : 12;
	$paged    = isset($params['paged'])    ? absint($params['paged']) : 1;
	$columns  = isset($params['columns'])  ? absint($params['columns']) : 4;

	$args                   = evo_build_query_args($params);
	$args['posts_per_page'] = $per_page;
	$args['paged']          = $paged;

	$query = new WP_Query($args);

	if ($query->have_posts()) {

		// Set WC loop properties so the theme's content-product.php
		// template has the correct context
		wc_set_loop_prop('columns', $columns);
		wc_set_loop_prop('total', $query->found_posts);
		wc_set_loop_prop('total_pages', $query->max_num_pages);
		wc_set_loop_prop('current_page', $paged);
		wc_set_loop_prop('per_page', $per_page);

		/*
		 * DO NOT add an extra <div class="woocommerce columns-N"> here.
		 * The outer shortcode wrapper already provides that class.
		 *
		 * woocommerce_product_loop_start() in the Ruffer theme outputs
		 * <div class="row"> (not <ul class="products">), and
		 * woocommerce_product_loop_end() outputs </div>.
		 *
		 * Each product is rendered by content-product.php which outputs
		 * <div class="product-wrapper product …"> … </div>
		 */
		woocommerce_product_loop_start();

		while ($query->have_posts()) {
			$query->the_post();

			/**
			 * Hook: woocommerce_shop_loop.
			 */
			do_action('woocommerce_shop_loop');

			wc_get_template_part('content', 'product');
		}

		woocommerce_product_loop_end();

		// Pagination
		$big = 999999999;
		$pagination = paginate_links(array(
			'base'    => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
			'format'  => '?paged=%#%',
			'current' => $paged,
			'total'   => $query->max_num_pages,
			'type'    => 'list',
		));

		if ($pagination) {
			echo '<nav class="woocommerce-pagination">' . $pagination . '</nav>';
		}

		// Result count
		$first = ($per_page * ($paged - 1)) + 1;
		$last  = min($query->found_posts, $per_page * $paged);
		echo '<p class="woocommerce-result-count">Showing ' . $first . '&ndash;' . $last . ' of ' . $query->found_posts . ' results</p>';
	} else {
		echo '<p class="woocommerce-info">No products found matching your selection.</p>';
	}

	wp_reset_postdata();
}

/* ------------------------------------------------------------------ */
/*  3c. Compute available facets for the current filter state         */
/*                                                                    */
/*  Uses "exclusive" faceting: each dimension is computed WITHOUT its */
/*  own constraint, so users always see values they can switch to.    */
/* ------------------------------------------------------------------ */
function evo_compute_facets($params)
{
	$categories = isset($params['categories']) ? (array) $params['categories'] : array();

	// Run a lightweight ID-only query for a given params set
	$get_ids = function ($p) {
		$args                         = evo_build_query_args($p);
		$args['posts_per_page']       = -1;
		$args['fields']               = 'ids';
		$args['no_found_rows']        = true;
		$args['update_post_meta_cache'] = false;
		$args['update_post_term_cache'] = false;
		$q = new WP_Query($args);
		wp_reset_postdata();
		return (array) $q->posts;
	};

	// Return slugs of a taxonomy that appear across the given post IDs
	$slugs_for = function ($taxonomy, $ids) {
		if (empty($ids)) {
			return array();
		}
		$terms = get_terms(array(
			'taxonomy'   => $taxonomy,
			'object_ids' => $ids,
			'hide_empty' => true,
			'fields'     => 'slugs',
		));
		return is_wp_error($terms) ? array() : array_values((array) $terms);
	};

	$facets = array();

	// sub_cat: query without sub_cat constraint so users can switch between sub-cats
	$ids       = $get_ids(array_merge($params, array('sub_cat' => '')));
	$all_slugs = $slugs_for('product_cat', $ids);
	if (! empty($categories)) {
		// Restrict to children of the scoped parent categories only
		$child_slugs = array();
		foreach ($categories as $cat_slug) {
			$t = get_term_by('slug', $cat_slug, 'product_cat');
			if ($t) {
				$kids = get_terms(array(
					'taxonomy'   => 'product_cat',
					'child_of'   => $t->term_id,
					'fields'     => 'slugs',
					'hide_empty' => false,
				));
				if (! is_wp_error($kids)) {
					$child_slugs = array_merge($child_slugs, (array) $kids);
				}
			}
		}
		$facets['sub_cat'] = array_values(array_intersect($all_slugs, $child_slugs));
	} else {
		$facets['sub_cat'] = $all_slugs;
	}

	// tag: query without tag constraint
	$ids           = $get_ids(array_merge($params, array('tag' => '')));
	$facets['tag'] = $slugs_for('product_tag', $ids);

	// attributes: for each attribute, query without that attribute's value
	$attribute_taxonomies = wc_get_attribute_taxonomies();
	foreach ($attribute_taxonomies as $attr) {
		$taxonomy       = wc_attribute_taxonomy_name($attr->attribute_name);
		$params_no_attr = $params;
		if (isset($params_no_attr['attributes'][$taxonomy])) {
			$params_no_attr['attributes'][$taxonomy] = '';
		}
		$ids               = $get_ids($params_no_attr);
		$facets[$taxonomy] = $slugs_for($taxonomy, $ids);
	}

	return $facets;
}

/* ------------------------------------------------------------------ */
/*  4. AJAX endpoint                                                  */
/* ------------------------------------------------------------------ */
add_action('wp_ajax_evo_filter_products',        'evo_ajax_filter_products');
add_action('wp_ajax_nopriv_evo_filter_products', 'evo_ajax_filter_products');

function evo_ajax_filter_products()
{

	check_ajax_referer('evo_filter_nonce', 'nonce');

	$params = array(
		'categories' => isset($_POST['categories']) ? json_decode(stripslashes($_POST['categories']), true) : array(),
		'per_page'   => isset($_POST['per_page'])   ? absint($_POST['per_page']) : 12,
		'columns'    => isset($_POST['columns'])     ? absint($_POST['columns']) : 4,
		'paged'      => isset($_POST['paged'])       ? absint($_POST['paged']) : 1,
		'orderby'    => isset($_POST['orderby'])     ? sanitize_text_field($_POST['orderby']) : 'menu_order title',
		'order'      => isset($_POST['order'])       ? sanitize_text_field($_POST['order']) : 'ASC',
		'sort'       => isset($_POST['sort'])        ? sanitize_text_field($_POST['sort']) : '',
		'sub_cat'    => isset($_POST['sub_cat'])     ? sanitize_text_field($_POST['sub_cat']) : '',
		'tag'        => isset($_POST['tag'])         ? sanitize_text_field($_POST['tag']) : '',
		'attributes' => isset($_POST['attributes'])  ? (array) json_decode(stripslashes($_POST['attributes']), true) : array(),
		'min_price'  => isset($_POST['min_price'])   ? sanitize_text_field($_POST['min_price']) : '',
		'max_price'  => isset($_POST['max_price'])   ? sanitize_text_field($_POST['max_price']) : '',
		'search'     => isset($_POST['search'])      ? sanitize_text_field($_POST['search']) : '',
	);

	ob_start();
	evo_render_product_grid($params);
	$html = ob_get_clean();

	$facets = evo_compute_facets($params);

	wp_send_json_success(array(
		'html'   => $html,
		'facets' => $facets,
	));
}

/* ------------------------------------------------------------------ */
/*  5. Enqueue JS and CSS                                             */
/* ------------------------------------------------------------------ */
add_action('wp_enqueue_scripts', 'evo_filterable_products_assets');

function evo_filterable_products_assets()
{

	// Only load on pages that might have the shortcode
	// (you can refine this with a global flag if needed)
	if (! is_singular('page')) {
		return;
	}

	wp_enqueue_script(
		'evo-filterable-products',
		get_stylesheet_directory_uri() . '/js/evo-filterable-products.js',
		array('jquery'),
		'1.0.0',
		true
	);

	wp_localize_script('evo-filterable-products', 'evoProducts', array(
		'ajaxurl' => admin_url('admin-ajax.php'),
		'nonce'   => wp_create_nonce('evo_filter_nonce'),
	));

	wp_enqueue_style(
		'evo-filterable-products',
		get_stylesheet_directory_uri() . '/css/evo-filterable-products.css',
		array(),
		'1.0.0'
	);
}

//require_once get_template_directory() . '/inc/evo-filterable-products.php';
