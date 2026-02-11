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
class Ruffer_Animated_Image extends Widget_Base {

	public function get_name() {
		return 'ruffershapeimage';
	}

	public function get_title() {
		return __( 'Ruffer Animated Image', 'ruffer' );
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
				'label' 	=> __( 'Image', 'ruffer' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
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
			'effect_style',
			[
				'label' 		=> esc_html__( 'Add Styling Attributes', 'ruffer' ),
				'type' 			=> \Elementor\Controls_Manager::SELECT,
				'options' 		=> [
					'jump'  			=> esc_html__( 'Jumping Effect', 'ruffer' ),
					'jump-reverse'  	=> esc_html__( 'Jumping Reverse Effect', 'ruffer' ),
					'movingX'  			=> esc_html__( 'Moving Effect', 'ruffer' ),
					'movingX-reverse'	=> esc_html__( 'Moving Reverse Effect', 'ruffer' ),
					'spin'			=> esc_html__( 'Rotate Effect', 'ruffer' ),
					''			=> esc_html__( 'No Effect', 'ruffer' ),
				],
				'default' => [ 'jump'],
			]
		);
		$this->add_control(
			'custom_class', [
				'label' 		=> __( 'Custom 	Class', 'ruffer' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'rows' 			=> 2,
				'default' 		=> __( 'Classical' , 'ruffer' ),
				'label_block' 	=> true,
			]
        );
		$this->add_control(
			'from_top',
			[
				'label' 		=> __( 'Top', 'ruffer' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ '%' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
			]
		);
		$this->add_control(
			'from_left',
			[
				'label' 		=> __( 'Left', 'ruffer' ),
				'type' 			=> Controls_Manager::SLIDER,
				'size_units' 	=> '%',
				'range' 		=> [
					'%' 			=> [
						'min' 			=> 0,
						'max' 			=> 100,
					],
				],
			]
		);
		$this->add_control(
			'from_right',
			[
				'label' 		=> __( 'Right', 'ruffer' ),
				'type' 			=> Controls_Manager::SLIDER,
				'size_units' 	=> '%',
				'range' 		=> [
					'%' 			=> [
						'min' 			=> 0,
						'max' 			=> 100,
					],
				],
			]
		);
		$this->add_control(
			'from_bottom',
			[
				'label' 		=> __( 'Bottom', 'ruffer' ),
				'type' 			=> Controls_Manager::SLIDER,
				'size_units' 	=> '%',
				'range' 		=> [
					'%' 			=> [
						'min' 			=> 0,
						'max' 			=> 100,
					],
				],
			]
		);

		$this->add_control(
			'responsive_style',
			[
				'label' 		=> esc_html__( 'Responsive Styling', 'ruffer' ),
				'type' 			=> \Elementor\Controls_Manager::SELECT2,
				'multiple' 		=> true,
				'options' 		=> [
					'z-index-3'  => esc_html__( 'Z Index Nagative', 'ruffer' ),
					'd-xxl-block'  		=> esc_html__( 'Hide From large Device', 'ruffer' ),
					'd-lg-block'  		=> esc_html__( 'Hide From Tablet', 'ruffer' ),
					'd-md-block'  		=> esc_html__( 'Hide From Mobile', 'ruffer' ),
					'd-sm-block'  		=> esc_html__( 'D SM Block', 'ruffer' ),
					'd-none'  			=> esc_html__( 'Display None', 'ruffer' ),
					' '  				=> esc_html__( 'Default', 'ruffer' ),
				],
			]
		);
        $this->end_controls_section();
	}

	protected function render() {

        $settings = $this->get_settings_for_display();

        $this->add_render_attribute('wrapper','class','shape-mockup');
        $this->add_render_attribute('wrapper','class', $settings['effect_style']);
        $this->add_render_attribute('wrapper','class', $settings['responsive_style']);

        if( !empty( $settings['custom_class'] ) ){
        	$this->add_render_attribute('wrapper','class', $settings['custom_class']);
        }
        
        if($settings['from_bottom']['size']){
	        $this->add_render_attribute( 'wrapper', 'data-bottom', $settings['from_bottom']['size'] .'%' );
	    }
	    if($settings['from_top']['size']){
	        $this->add_render_attribute( 'wrapper', 'data-top', $settings['from_top']['size'] .'%' );
	    }
	    if($settings['from_right']['size']){
	        $this->add_render_attribute( 'wrapper', 'data-right', $settings['from_right']['size'] .'%' );
	    }
	    if($settings['from_left']['size']){
	        $this->add_render_attribute( 'wrapper', 'data-left', $settings['from_left']['size'] .'%' );
	    }



        if( !empty( $settings['image']['id'] ) ) {
            echo '<!-- Image -->';
                echo '<div '.$this->get_render_attribute_string('wrapper').'>';
					echo '<img src="'.esc_url( $settings['image']['url']).'" alt="'.esc_html( get_bloginfo('name') ).'" >';
                echo '</div>';
            echo '<!-- End Image -->';
        }
	}
}