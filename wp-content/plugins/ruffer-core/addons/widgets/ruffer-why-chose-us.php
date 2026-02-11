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
 * WCU Box Widget .
 *
 */
class Ruffer_WCU extends Widget_Base {

	public function get_name() {
		return 'rufferwhychoseus ';
	}
	public function get_title() {
		return __( 'Why Chose Us', 'ruffer' );
	}
	public function get_icon() {
		return 'eicon-code';
    }
	public function get_categories() {
		return [ 'ruffer' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'checklist_section',
			[
				'label' 	=> __( 'WCU', 'ruffer' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );
        $this->add_control(
			'layout',
			[
				'label' 		=> __( 'Style', 'ruffer' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> '1',
				'options'		=> [
					'1'  			=> __( 'Style One', 'ruffer' ),
					'2' 			=> __( 'Style Two', 'ruffer' ),
				],
			]
		);
        $repeater = new Repeater();

		$repeater->add_control(
			'title',
			[
				'label'     => __( 'Title', 'ruffer' ),
                'type'      => Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
			]
        );
        $repeater->add_control(
			'content',
			[
				'label'     => __( 'Content', 'ruffer' ),
                'type'      => Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
			]
        );
        $repeater->add_control(
			'url',
			[
				'label'     => __( 'Details Page', 'ruffer' ),
                'type'      => Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
			]
        );
        $repeater->add_control(
			'image',
			[
				'label' 		=> __( 'Image', 'ruffer' ),
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
			'wcu',
			[
				'label' 		=> __( 'Why Chose Us', 'ruffer' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'title' 		=> __( 'title', 'ruffer' ),
					],
				],
			]
		);
         

        $this->end_controls_section();

        /*-----------------------------------------Feedback styling------------------------------------*/

		$this->start_controls_section(
			'overview_con_styling',
			[
				'label' 	=> __( 'Content Styling', 'ruffer' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
        );
        $this->start_controls_tabs(
			'style_tabs2'
		);
//--------------------secound--------------------//

		$this->start_controls_tab(
			'style_hover_tab2',
			[
				'label' => esc_html__( 'Title', 'ruffer' ),
			]
		);
		$this->add_control(
			'overview_content_color',
			[
				'label' 		=> __( 'Color', 'ruffer' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wcu-card_title a'	=> '--title-color: {{VALUE}}!important;',
				],
			]
        );
        $this->add_group_control(
		Group_Control_Typography::get_type(),
		 	[
				'name' 			=> 'overview_content_typography',
		 		'label' 		=> __( 'Typography', 'ruffer' ),
		 		'selector' 	=> '{{WRAPPER}} h5',
			]
		);

        $this->add_responsive_control(
			'overview_content_margin',
			[
				'label' 		=> __( 'Margin', 'ruffer' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} h5' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
        );

        $this->add_responsive_control(
			'overview_content_padding',
			[
				'label' 		=> __( 'Padding', 'ruffer' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} h5' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
        );

		$this->end_controls_tab();


		//--------------------three--------------------//

		$this->start_controls_tab(
			'style_hover_tab3',
			[
				'label' => esc_html__( 'Description', 'ruffer' ),
			]
		);
		$this->add_control(
			'counter_color',
			[
				'label' 		=> __( 'Color', 'ruffer' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} p'	=> 'color: {{VALUE}}!important;',
				],
			]
        );
        $this->add_group_control(
		Group_Control_Typography::get_type(),
		 	[
				'name' 			=> 'counter_typography',
		 		'label' 		=> __( 'Typography', 'ruffer' ),
		 		'selector' 	=> '{{WRAPPER}} p',
			]
		);

        $this->add_responsive_control(
			'counter_margin',
			[
				'label' 		=> __( 'Margin', 'ruffer' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
        );

        $this->add_responsive_control(
			'counter_padding',
			[
				'label' 		=> __( 'Padding', 'ruffer' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
        );



		$this->end_controls_tab();

		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	protected function render() {

        $settings = $this->get_settings_for_display();

        if( $settings['layout'] == '1' ){

        	echo '<div class="row th-carousel" data-slide-show="3" data-ml-slide-show="2" data-md-slide-show="3" data-sm-slide-show="2" data-dots="false">';
                foreach( $settings['wcu'] as $data ) {              
	                echo '<div class="col-sm-6">';
	                    echo '<div class="wcu-card">';
	                    	if( ! empty( $data['image']['url'] ) ){
		                        echo '<div class="wcu-card_icon">';
		                            echo '<img src="'.$data['image']['url'].'" alt="Icon">';
		                        echo '</div>';
		                    }
	                        echo '<div class="wcu-card_details">';
	                        	if( ! empty( $data['title'] ) ){
		                            echo '<h3 class="h5 wcu-card_title"><a href="'.esc_url( $data['url'] ).'">'.esc_html( $data['title'] ).'</a></h3>';
		                        }
		                        if( ! empty( $data['content'] ) ){
		                            echo '<p class="wcu-card_text">'.esc_html( $data['content'] ).'</p>';
		                        }
	                        echo '</div>';
	                    echo '</div>';
	                echo '</div>';
	            }
            echo '</div>';
	    }else{
	    	echo '<div class="wcu-card-slider th-carousel row g-0" data-slide-show="3" data-ml-slide-show="3" data-md-slide-show="3" data-sm-slide-show="2" data-dots="false">';

	    		foreach( $settings['wcu'] as $data ) { 
	                echo '<div class="col-sm-6">';
	                    echo '<div class="wcu-card-wrap mt-10 bg-white">';
	                        echo '<div class="wcu-card style3">';
	                        	if( ! empty( $data['image']['url'] ) ){
		                            echo '<div class="wcu-card_icon">';
		                                echo '<img src="'.$data['image']['url'].'" alt="Icon">';
		                            echo '</div>';
		                        }
	                            echo '<div class="wcu-card_details">';
	                                if( ! empty( $data['title'] ) ){
			                            echo '<h3 class="h5 wcu-card_title"><a href="'.esc_url( $data['url'] ).'">'.esc_html( $data['title'] ).'</a></h3>';
			                        }
	                                if( ! empty( $data['content'] ) ){
			                            echo '<p class="wcu-card_text">'.esc_html( $data['content'] ).'</p>';
			                        }
	                            echo '</div>';
	                        echo '</div>';
	                    echo '</div>';
	                echo '</div>';
	            } 
            echo '</div>';
	    }
	}
}