<?php

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

	ob_start();
?>
	<div
		id="<?php echo esc_attr($uid); ?>"
		class="evo-filterable-products woocommerce columns-<?php echo esc_attr($columns); ?>"
		data-categories="<?php echo esc_attr(wp_json_encode($categories)); ?>"
		data-per-page="<?php echo esc_attr($per_page); ?>"
		data-columns="<?php echo esc_attr($columns); ?>"
		data-orderby="<?php echo esc_attr($atts['orderby']); ?>"
		data-order="<?php echo esc_attr($atts['order']); ?>">
		<!-- Filters bar -->
		<div class="evo-filters-bar">
			<?php evo_render_filters($categories, $uid); ?>
		</div>

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
	</div>
<?php

	return ob_get_clean();
}

/* ------------------------------------------------------------------ */
/*  2. Render the filter controls                                     */
/* ------------------------------------------------------------------ */
function evo_render_filters($categories, $uid)
{

	// --- Sort ---
	$sort_options = array(
		''           => 'Default sorting',
		'popularity' => 'Sort by popularity',
		'rating'     => 'Sort by average rating',
		'date'       => 'Sort by latest',
		'price'      => 'Sort by price: low to high',
		'price-desc' => 'Sort by price: high to low',
	);
	echo '<select class="evo-filter-sort" data-uid="' . esc_attr($uid) . '">';
	foreach ($sort_options as $val => $label) {
		echo '<option value="' . esc_attr($val) . '">' . esc_html($label) . '</option>';
	}
	echo '</select>';

	// --- Sub-categories (only children of the supplied cats) ---
	if (! empty($categories)) {
		$parent_ids = array();
		foreach ($categories as $slug) {
			$term = get_term_by('slug', $slug, 'product_cat');
			if ($term) {
				$parent_ids[] = $term->term_id;
			}
		}

		$children = get_terms(array(
			'taxonomy'   => 'product_cat',
			'hide_empty' => true,
			'child_of'   => 0,
			'parent'     => 0, // we'll query per parent below
		));

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
			echo '<select class="evo-filter-subcat" data-uid="' . esc_attr($uid) . '">';
			echo '<option value="">All sub-categories</option>';
			foreach ($sub_terms as $t) {
				echo '<option value="' . esc_attr($t->slug) . '">' . esc_html($t->name) . '</option>';
			}
			echo '</select>';
		}
	}

	// --- Product tags ---
	$tags = get_terms(array(
		'taxonomy'   => 'product_tag',
		'hide_empty' => true,
	));
	if (! empty($tags) && ! is_wp_error($tags)) {
		echo '<select class="evo-filter-tag" data-uid="' . esc_attr($uid) . '">';
		echo '<option value="">All tags</option>';
		foreach ($tags as $tag) {
			echo '<option value="' . esc_attr($tag->slug) . '">' . esc_html($tag->name) . '</option>';
		}
		echo '</select>';
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
				echo '<select class="evo-filter-attribute" data-taxonomy="' . esc_attr($taxonomy) . '" data-uid="' . esc_attr($uid) . '">';
				echo '<option value="">All ' . esc_html($attr->attribute_label) . '</option>';
				foreach ($terms as $term) {
					echo '<option value="' . esc_attr($term->slug) . '">' . esc_html($term->name) . '</option>';
				}
				echo '</select>';
			}
		}
	}

	// --- Price range (min / max inputs) ---
	echo '<div class="evo-price-filter" data-uid="' . esc_attr($uid) . '">';
	echo '<input type="number" class="evo-filter-min-price" placeholder="Min price" min="0" step="1" />';
	echo '<input type="number" class="evo-filter-max-price" placeholder="Max price" min="0" step="1" />';
	echo '<button type="button" class="evo-price-go button">Filter</button>';
	echo '</div>';

	// --- Search within results ---
	echo '<input type="text" class="evo-filter-search" data-uid="' . esc_attr($uid) . '" placeholder="Search products…" />';
}

/* ------------------------------------------------------------------ */
/*  3. Render the product grid (used both server-side & via AJAX)     */
/* ------------------------------------------------------------------ */
function evo_render_product_grid($params)
{

	$categories  = isset($params['categories'])  ? (array) $params['categories'] : array();
	$per_page    = isset($params['per_page'])     ? absint($params['per_page']) : 12;
	$paged       = isset($params['paged'])        ? absint($params['paged']) : 1;
	$orderby_raw = isset($params['orderby'])      ? $params['orderby'] : 'menu_order title';
	$order_raw   = isset($params['order'])        ? $params['order'] : 'ASC';
	$sub_cat     = isset($params['sub_cat'])      ? sanitize_text_field($params['sub_cat']) : '';
	$tag         = isset($params['tag'])          ? sanitize_text_field($params['tag']) : '';
	$attributes  = isset($params['attributes'])   ? (array) $params['attributes'] : array();
	$min_price   = isset($params['min_price'])    ? $params['min_price'] : '';
	$max_price   = isset($params['max_price'])    ? $params['max_price'] : '';
	$search      = isset($params['search'])       ? sanitize_text_field($params['search']) : '';
	$sort        = isset($params['sort'])         ? sanitize_text_field($params['sort']) : '';

	// Build query args
	$args = array(
		'post_type'      => 'product',
		'post_status'    => 'publish',
		'posts_per_page' => $per_page,
		'paged'          => $paged,
	);

	// Sorting
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

	// Search
	if ($search) {
		$args['s'] = $search;
	}

	// Tax query
	$tax_query = array('relation' => 'AND');

	// Parent categories (always enforced)
	if (! empty($categories)) {
		$tax_query[] = array(
			'taxonomy' => 'product_cat',
			'field'    => 'slug',
			'terms'    => $categories,
			'operator' => 'IN',
		);
	}

	// Sub-category refinement
	if ($sub_cat) {
		$tax_query[] = array(
			'taxonomy' => 'product_cat',
			'field'    => 'slug',
			'terms'    => array($sub_cat),
		);
	}

	// Tag
	if ($tag) {
		$tax_query[] = array(
			'taxonomy' => 'product_tag',
			'field'    => 'slug',
			'terms'    => array($tag),
		);
	}

	// Product attributes
	foreach ($attributes as $taxonomy => $slug) {
		if ($slug) {
			$tax_query[] = array(
				'taxonomy' => sanitize_text_field($taxonomy),
				'field'    => 'slug',
				'terms'    => array(sanitize_text_field($slug)),
			);
		}
	}

	// Only add tax_query if we have actual clauses beyond 'relation'
	if (count($tax_query) > 1) {
		$args['tax_query'] = $tax_query;
	}

	// Price meta query
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

	// Exclude hidden products from the catalog
	$args['tax_query'][] = array(
		'taxonomy' => 'product_visibility',
		'field'    => 'name',
		'terms'    => 'exclude-from-catalog',
		'operator' => 'NOT IN',
	);

	$query = new WP_Query($args);

	if ($query->have_posts()) {

		// Tell WC how many columns (used by content-product.php)
		wc_set_loop_prop('columns', isset($params['columns']) ? absint($params['columns']) : 4);
		wc_set_loop_prop('total', $query->found_posts);
		wc_set_loop_prop('total_pages', $query->max_num_pages);
		wc_set_loop_prop('current_page', $paged);
		wc_set_loop_prop('per_page', $per_page);

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
		echo '<nav class="woocommerce-pagination">';
		echo paginate_links(array(
			'base'    => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
			'format'  => '?paged=%#%',
			'current' => $paged,
			'total'   => $query->max_num_pages,
			'type'    => 'list',
		));
		echo '</nav>';

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

	wp_send_json_success(array('html' => $html));
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
