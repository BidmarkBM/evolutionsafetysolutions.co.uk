<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Border;
/**
 *
 * Image Widget .
 *
 */
class Ruffer_info_Box extends Widget_Base {

	public function get_name() {
		return 'rufferinfobox';
	}
	public function get_title() {
		return __( 'Info Box', 'ruffer' );
	}
	public function get_icon() {
		return 'eicon-code';
    }
	public function get_categories() {
		return [ 'ruffer' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'image_section',
			[
				'label' 	=> __( 'Info Box', 'ruffer' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );

        ruffer_select_field( $this, 'layout_style', 'Layout Style', [ 'Style One', 'Style Two' ] );

		ruffer_media_fields( $this, 'number_img', 'Number Bg Image', ['1'] );

		ruffer_general_fields( $this, 'number', 'Number', 'TEXTAREA2', '25', ['1'] );
		ruffer_general_fields( $this, 'desc', 'Description', 'TEXTAREA2', 'Years Of Experience', ['1'] );

        ruffer_media_fields( $this, 'icon', 'Choose Icon', ['1'] );
		ruffer_general_fields( $this, 'content', 'Content', 'TEXTAREA2', 'Globally Clients', ['1'] );

		ruffer_media_fields( $this, 'image', 'Choose Image', ['2'] );
		ruffer_general_fields( $this, 'desc2', 'Description', 'TEXTAREA', 'Look out for signs like missing shingles', ['2'] );

		ruffer_general_fields( $this, 'button_text', 'Button Text', 'TEXT', 'Contact Us', ['2'] );
		ruffer_url_fields( $this, 'button_url', 'Button URL', ['2'] );
		
        $this->end_controls_section();
        
		//---------------------------------------
			//Style Section Start
		//---------------------------------------

		ruffer_common_style_fields( $this, '03', 'Description', '{{WRAPPER}} p', ['2'] );
		//------Button Style-------
		ruffer_button_style_fields( $this, '10', 'Button Styling', '{{WRAPPER}} .th_btn', ['2'] );

	}

	protected function render() {

        $settings = $this->get_settings_for_display();

        if( $settings['layout_style'] == '1' ){
            echo '<div class="row align-items-center">';
                echo '<div class="col-md-6 col-xl-12">';
                    echo '<div class="row g-3 g-sm-3 about-grid3 mb-3 mb-md-0 mb-xl-4">';
                        if(!empty($settings['number'])){
                            echo '<h3 class="col-auto about-grid_year" data-bg-src="'.esc_url( $settings['number_img']['url'] ).'">';
                                echo wp_kses_post($settings['number']);
                            echo '</h3>';
                        }
                        if(!empty($settings['desc'])){
							echo '<span class="col-auto about-grid_text">'.wp_kses_post($settings['desc']).'</span>';
						}
                    echo '</div>'; 
                echo '</div>';
                echo '<div class="col-md-6 col-xl-12">';
                    echo '<div class="card abt-feature-info1 mb-3 mb-md-0 mb-xl-4">';
                        echo '<div class="card-body flex-wrap flex-lg-nowrap">';
                            if(!empty($settings['icon']['url'])){
                                echo '<div class="card-icon">';
                                    echo ruffer_img_tag( array(
                                        'url'   => esc_url( $settings['icon']['url'] ),
                                    ));
                                echo '</div>';
                            }
                            if(!empty($settings['content'])){
                                echo '<h4 class="card-title m-0">'.esc_html($settings['content']).'</h4>';
                            }
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';


	    }elseif( $settings['layout_style'] == '2' ){
			echo '<div class="solution-content">';
				if(!empty($settings['image']['url'])){
					echo '<div class="avatar">';
						echo ruffer_img_tag( array(
							'url'   => esc_url( $settings['image']['url'] ),
						));
					echo '</div>';
				}
				echo '<div>';
					if(!empty($settings['desc2'])){
						echo '<p>'.wp_kses_post($settings['desc2']).'</p>';
					}
					if(!empty($settings['button_text'])){
						echo '<a href="'.esc_url( $settings['button_url']['url'] ).'" class="th-btn style3 mt-20">'.wp_kses_post($settings['button_text']).'<i class="fa-regular fa-arrow-right ms-2"></i></a>';
					}
				echo '</div>';
			echo '</div>';

		}elseif( $settings['layout_style'] == '3' ){


		}

		


	}

}