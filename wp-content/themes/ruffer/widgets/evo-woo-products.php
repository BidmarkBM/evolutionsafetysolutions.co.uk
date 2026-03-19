<?php

namespace Elementor;

if (! defined('ABSPATH')) exit;

class Evo_Woo_Products_Widget extends Widget_Base
{

	public function get_name()
	{
		return 'evo_woo_products';
	}
	public function get_title()
	{
		return 'Evo WooCommerce Products';
	}
	public function get_icon()
	{
		return 'eicon-products';
	}
	public function get_categories()
	{
		return ['general'];
	}

	protected function register_controls()
	{
		$this->start_controls_section('section_query', ['label' => 'Query Settings']);

		// Manual Product Selection
		$this->add_control(
			'restricted_products',
			[
				'label' => 'Restrict to Products',
				'type' => Controls_Manager::SELECT2,
				'multiple' => true,
				'options' => $this->get_all_woo_products(),
				'label_block' => true,
			]
		);

		$this->end_controls_section();
	}

	private function get_all_woo_products()
	{
		$products = wc_get_products(['limit' => -1, 'status' => 'publish']);
		$options = [];
		foreach ($products as $product) {
			$options[$product->get_id()] = $product->get_name();
		}
		return $options;
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$is_restricted = !empty($settings['restricted_products']);

		// Pass data to JS via data attributes
		echo '<div class="evo-products-wrapper" data-restricted="' . esc_attr(json_encode($settings['restricted_products'])) . '">';

		echo '<div class="evo-filters">';
		// Always show Tags
		echo $this->render_taxonomy_filter('product_tag', 'All Tags');

		// Only show Categories if NOT restricted
		if (! $is_restricted) {
			echo $this->render_taxonomy_filter('product_cat', 'All Categories');
		}
		echo '</div>';

		echo '<div class="evo-results-grid">';
		$this->get_ajax_products($settings['restricted_products']);
		echo '</div>';

		echo '</div>';
	}

	private function render_taxonomy_filter($taxonomy, $placeholder)
	{
		$terms = get_terms(['taxonomy' => $taxonomy, 'hide_empty' => true]);
		$html = '<select class="evo-ajax-filter" data-tax="' . $taxonomy . '">';
		$html .= '<option value="">' . $placeholder . '</option>';
		foreach ($terms as $term) {
			$html .= '<option value="' . $term->slug . '">' . $term->name . '</option>';
		}
		$html .= '</select>';
		return $html;
	}

	// This handles both initial load and Ajax calls
	public function get_ajax_products($ids = [], $tag = '', $cat = '')
	{
		$args = [
			'post_type' => 'product',
			'posts_per_page' => 8,
		];

		if (!empty($ids)) {
			$args['post__in'] = $ids;
		}

		$tax_query = [];
		if (!empty($tag)) $tax_query[] = ['taxonomy' => 'product_tag', 'field' => 'slug', 'terms' => $tag];
		if (!empty($cat)) $tax_query[] = ['taxonomy' => 'product_cat', 'field' => 'slug', 'terms' => $cat];

		if (!empty($tax_query)) {
			$tax_query['relation'] = 'AND';
			$args['tax_query'] = $tax_query;
		}

		$query = new \WP_Query($args);
		if ($query->have_posts()) {
			while ($query->have_posts()) : $query->the_post();
				wc_get_template_part('content', 'product');
			endwhile;
		} else {
			echo 'No products found.';
		}
		wp_reset_postdata();
	}
}
