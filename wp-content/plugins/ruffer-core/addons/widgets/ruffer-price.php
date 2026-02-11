<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Border;
use \Elementor\Repeater;
/**
 *
 * Price Widget .
 *
 */
class Ruffer_Price extends Widget_Base {

	public function get_name() {
		return 'rufferprice';
	}
	public function get_title() {
		return __( 'Price Box', 'ruffer' );
	}
	public function get_icon() {
		return 'eicon-code';
    }
	public function get_categories() {
		return [ 'ruffer' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'price_section',
			[
				'label' 	=> __( 'Price Box', 'ruffer' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );

		ruffer_select_field( $this, 'layout_style', 'Layout Style', [ 'Style One' ] );

		ruffer_media_fields( $this, 'bg', 'Choose Shape', ['1'] );

		$repeater = new Repeater();

		ruffer_media_fields( $repeater, 'icon', 'Icon' );
		ruffer_general_fields($repeater, 'title', 'Title', 'TEXTAREA2', 'Basic Plan');
		ruffer_general_fields($repeater, 'price', 'Price', 'TEXTAREA', '$99.00'); 
		ruffer_general_fields($repeater, 'content', 'Content', 'TEXTAREA', 'Save 35% For all Roofing services'); 

		ruffer_code_fields($repeater, 'features', 'Features', ''); 

		ruffer_general_fields($repeater, 'button_text', 'Button Text', 'TEXT', 'Get Started');
		ruffer_url_fields($repeater, 'button_url', 'Button URL');

		$this->add_control(
			'price_lists',
			[
				'label' 		=> __( 'Price Lists', 'ruffer' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'title' 	=> __( 'Basic Plan', 'ruffer' ),
					],
				],
				'condition'	=> [
					'layout_style' => ['1']
				]
			]
		);

		$this->end_controls_section();

        //---------------------------------------
			//Style Section Start
		//---------------------------------------

		ruffer_common_style_fields( $this, '01', 'Title', '{{WRAPPER}} .price-card_title' );
		ruffer_common_style_fields( $this, '02', 'Price', '{{WRAPPER}} .price-card_price' );
		ruffer_common_style_fields( $this, '03', 'Content', '{{WRAPPER}} .price-card_text' );
		ruffer_common_style_fields( $this, '04', 'Features', '{{WRAPPER}} .checklist li' );

		//------Button Style-------
		ruffer_button_style_fields( $this, '10', 'Button Styling', '{{WRAPPER}} .th-btn' );

	}

	protected function render() {

	$settings = $this->get_settings_for_display();

		if( $settings['layout_style'] == '1' ){
			echo '<div class="row gy-4 justify-content-center">';
				foreach( $settings['price_lists'] as $data ){
                    echo '<div class="col-md-6">';
                        echo '<div class="price-card ">';
                            if(!empty($settings['bg']['url'])){
								echo '<div class="bg-shape-img">';
									echo ruffer_img_tag( array(
										'url'	=> esc_url( $settings['bg']['url'] ),
									) );
								echo '</div>';
							}
                            if(!empty($data['icon']['url'])){
								echo '<div class="service-default-icon icon-invert-white">';
									echo ruffer_img_tag( array(
										'url'	=> esc_url( $data['icon']['url'] ),
									) );
								echo '</div>';
							}
                            echo '<div class="price-card_top">';
                                if(!empty($data['title'])){
                                    echo '<h3 class="price-card_title">'.esc_html($data['title']).'</h3>';
                                }
                                if(!empty($data['price'])){
                                    echo '<h4 class="price-card_price">'.wp_kses_post($data['price']).'</h4>';
                                }
                                if(!empty($data['content'])){
                                    echo '<p class="price-card_text">'.wp_kses_post($data['content']).'</p>';
                                }
                            echo '</div>';
                            echo '<div class="price-card_content">';
                                if(!empty($data['features'])){
                                    echo '<div class="checklist style2">'.wp_kses_post($data['features']).'</div>';
                                }
                                if(!empty($data['button_text'])){
                                    echo '<a href="'.esc_url( $data['button_url']['url'] ).'" class="th-btn style3">'.wp_kses_post($data['button_text']).'<i class="fa-regular fa-arrow-right ms-2"></i></a>';
                                }
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
				}
			echo '</div>';

		}elseif( $settings['layout_style'] == '2' ){
		

		}


	}

}