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
 * Skill Box Widget .
 *
 */
class Ruffer_Experience_area extends Widget_Base {

	public function get_name() {
		return 'rufferexperiencearea';
	}

	public function get_title() {
		return __( 'Ruffer Experience Area', 'ruffer' );
	}


	public function get_icon() {
		return 'eicon-code';
    }


	public function get_categories() {
		return [ 'ruffer' ];
	}


	protected function register_controls() {

		$this->start_controls_section(
			'feature_section',
			[
				'label' 	=> __( 'Experience Area', 'ruffer' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );

		$this->add_control(
			'title',
			[
				'label'     => __( 'Title', 'ruffer' ),
                'type'      => Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
			]
        );
        $this->add_control(
			'experience',
			[
				'label'     => __( 'Experience Area', 'ruffer' ),
                'type'      => Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
			]
        );
        $this->add_control(
			'suffix',
			[
				'label'     => __( 'Suffix', 'ruffer' ),
				'type'      => Controls_Manager::TEXTAREA,
				'rows' 		=> 2,
				'default' 	=> __( 'k+', 'ruffer' ),
			]
		);
        $this->add_control(
			'image',
			[
				'label' 		=> __( 'Choose Image', 'ruffer' ),
				'type' 			=> Controls_Manager::MEDIA,
				'dynamic' 		=> [
					'active' 		=> true,
				],
				'default' 		=> [
					'url' 			=> Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_control(
			'icon_img',
			[
				'label' 		=> __( 'Icon Image', 'ruffer' ),
				'type' 			=> Controls_Manager::MEDIA,
				'dynamic' 		=> [
					'active' 		=> true,
				],
				'default' 		=> [
					'url' 			=> Utils::get_placeholder_image_src(),
				],
			]
		);
        
        $this->end_controls_section();

	}

	protected function render() {

        $settings = $this->get_settings_for_display();


        echo'<div class="experience-thumb">';
        	if( ! empty( $settings['image']['url'] ) ){
	            echo ruffer_img_tag( array(
					'url'   => esc_url( $settings['image']['url'] ),
				) );
	        }
            echo'<div class="customer-wrap">';
            	if( ! empty( $settings['experience'] ) ){
            		$suffix = ( $settings['suffix'] ) ? $settings['suffix'] : '';
            		echo'<h2 class="customer-wrap-title"><span class="counter-number">'.esc_html( $settings['experience'] ).'</span>'.esc_html($suffix).'</h2>';
                    
                }
                if( ! empty( $settings['title'] ) ){
	                echo'<p class="customer-wrap-text">'.wp_kses_post( $settings['title'] ).'</p>';
	            }
	            if( ! empty( $settings['icon_img']['url'] ) ){
	                echo'<div class="customer-wrap-icon"><img src="'.esc_url( $settings['icon_img']['url'] ).'" alt="icon"></div>';
	            }
            echo'</div>';
        echo'</div>';
	}
}