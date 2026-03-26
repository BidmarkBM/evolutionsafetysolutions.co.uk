<?php

namespace Elementor;

if (! defined('ABSPATH')) {
    exit;
}

class Evo_Filterable_Products_Elementor_Widget extends Widget_Base
{
    public function get_name()
    {
        return 'evo_filterable_products';
    }

    public function get_title()
    {
        return 'Evo Filterable Products';
    }

    public function get_icon()
    {
        return 'eicon-products';
    }

    public function get_categories()
    {
        return array('general');
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'section_content',
            array(
                'label' => 'Filterable Products',
            )
        );

        $this->add_control(
            'category',
            array(
                'label'       => 'Category Scope',
                'type'        => Controls_Manager::SELECT2,
                'multiple'    => true,
                'options'     => $this->get_product_category_options(),
                'label_block' => true,
                'description' => 'Choose one or more parent categories used as the base scope.',
            )
        );

        $this->add_control(
            'per_page',
            array(
                'label'   => 'Products Per Page',
                'type'    => Controls_Manager::NUMBER,
                'default' => 12,
                'min'     => 1,
                'max'     => 96,
            )
        );

        $this->add_control(
            'columns',
            array(
                'label'   => 'Columns',
                'type'    => Controls_Manager::SELECT,
                'default' => 4,
                'options' => array(
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                ),
            )
        );

        $this->add_control(
            'orderby',
            array(
                'label'   => 'Default Order By',
                'type'    => Controls_Manager::SELECT,
                'default' => 'menu_order title',
                'options' => array(
                    'menu_order title' => 'Menu Order + Title',
                    'date'             => 'Date',
                    'title'            => 'Title',
                    'ID'               => 'ID',
                    'rand'             => 'Random',
                ),
            )
        );

        $this->add_control(
            'order',
            array(
                'label'   => 'Default Order',
                'type'    => Controls_Manager::SELECT,
                'default' => 'ASC',
                'options' => array(
                    'ASC'  => 'ASC',
                    'DESC' => 'DESC',
                ),
            )
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        if (! function_exists('evo_products_shortcode')) {
            echo '<p>' . esc_html__('Evo products shortcode function is missing.', 'ruffer') . '</p>';
            return;
        }

        $settings = $this->get_settings_for_display();

        $selected_categories = isset($settings['category']) ? (array) $settings['category'] : array();
        $category_slugs      = array_filter(array_map('sanitize_title', $selected_categories));

        $atts = array(
            'category' => implode(',', $category_slugs),
            'per_page' => isset($settings['per_page']) ? absint($settings['per_page']) : 12,
            'columns'  => isset($settings['columns']) ? absint($settings['columns']) : 4,
            'orderby'  => isset($settings['orderby']) ? sanitize_text_field($settings['orderby']) : 'menu_order title',
            'order'    => isset($settings['order']) ? sanitize_text_field($settings['order']) : 'ASC',
        );

        echo evo_products_shortcode($atts);
    }

    private function get_product_category_options()
    {
        $options = array();

        $terms = get_terms(
            array(
                'taxonomy'   => 'product_cat',
                'hide_empty' => false,
            )
        );

        if (is_wp_error($terms) || empty($terms)) {
            return $options;
        }

        foreach ($terms as $term) {
            $options[$term->slug] = $term->name . ' (' . $term->slug . ')';
        }

        return $options;
    }
}
