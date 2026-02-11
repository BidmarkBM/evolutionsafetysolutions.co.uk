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
 * Service Widget .
 *
 */
class Ruffer_Service extends Widget_Base {

	public function get_name() {
		return 'rufferservice';
	}

	public function get_title() {
		return __( 'Ruffer Service', 'ruffer' );
	}

	public function get_icon() {
		return 'eicon-code';
    }

	public function get_categories() {
		return [ 'ruffer' ];
	}


	protected function register_controls() {

		$this->start_controls_section(
			'service_section',
			[
				'label'     => __( 'Service Slider', 'ruffer' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
			]
        );

		$this->add_control(
			'service_style',
			[
				'label' 	=> __( 'Service Style', 'ruffer' ),
				'type' 		=> Controls_Manager::SELECT,
				'default' 	=> '1',
				'options' 	=> [
					'1'  		=> __( 'Style One', 'ruffer' ),
					'2'  		=> __( 'Style Two', 'ruffer' ),
					'3'  		=> __( 'Style Three', 'ruffer' ),
					'4'  		=> __( 'Style Four', 'ruffer' ),
					'5'  		=> __( 'Style Five', 'ruffer' ),
					'6'  		=> __( 'Style Six', 'ruffer' ),
					'7'  		=> __( 'Style Seven', 'ruffer' ),
					'8'  		=> __( 'Style Eight', 'ruffer' ),

				],
			]
		);

		// ------------------------------------style 2------------------------------------ //
		$repeater = new Repeater();

		$repeater->add_control(
			'service_slider_icon_image',
			[
				'label'     => __( 'Service Icon', 'ruffer' ),
				'type'      => Controls_Manager::MEDIA,
				'dynamic'   => [
					'active' => true,
				],
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
		$repeater->add_control(
			'service_slider_image',
			[
				'label'     => __( 'Service Image', 'ruffer' ),
				'type'      => Controls_Manager::MEDIA,
				'dynamic'   => [
					'active' => true,
				],
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

        $repeater->add_control(
			'service_title',
            [
				'label'         => __( 'Service Title', 'ruffer' ),
				'type'          => Controls_Manager::TEXTAREA,
				'rows' 			=> 2,
				'default'       => __( 'Neurology Specialist' , 'ruffer' ),
				'label_block'   => true,
			]
		);
        $repeater->add_control(
			'service_description',
            [
				'label'         => __( 'Service Description', 'ruffer' ),
				'type'          => Controls_Manager::TEXTAREA,
				'rows' 			=> 3,
				'default'       => __( 'There are many variations injected many alteration humour believable.' ,'ruffer' ),
				'label_block'   => true,
			]
		);

        $repeater->add_control(
            'button_text',
            [
                'label'         => __( 'Button Text', 'ruffer' ),
                'type'          => Controls_Manager::TEXTAREA,
                'rows' 			=> 2,
                'label_block'   => true,
				'default'		=> __( 'View Details','ruffer' )
            ]
        );

        $repeater->add_control(
            'button_url',
            [
                'label'         => __( 'Details Url', 'ruffer' ),
                'type'          => Controls_Manager::TEXTAREA,
                'rows' 			=> 3,
                'label_block'   => true,
				'default'		=> '#'
            ]
        );
        
		$this->add_control(
			'slides2',
			[
				'label' 		=> __( 'Service Slider', 'ruffer' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'service_slider_icon_image' 	=> Utils::get_placeholder_image_src(),
					],
					[
						'service_slider_icon_image' 	=> Utils::get_placeholder_image_src(),
					],
				],
				'title_field' 	=> '{{service_title}}',
			]
		);
		$this->add_control(
			'service_shape',
			[
				'label'     => __( 'Service Shape Image', 'ruffer' ),
				'type'      => Controls_Manager::MEDIA,
				'dynamic'   => [
					'active' => true,
				],
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition'		=> [ 'service_style' => [ '1', '5', '7' ] ],
			]
		);


        $this->end_controls_section();


        //------------------------------------feature Control------------------------------------//

		$this->start_controls_section(
			'service_control',
			[
				'label'     => __( 'Service Control', 'dealato' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition'		=> [ 'service_style' => [ '1','2','3','4','5' ] ],
			]
        );
        $this->add_control(
			'make_it_slider',
			[
				'label' 		=> __( 'Use it as slider ?', 'dealato' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Show', 'dealato' ),
				'label_off' 	=> __( 'Hide', 'dealato' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'yes',
			]
		);
		$this->add_control(
			'desktop_items',
			[
				'label' 		=> __( 'Items To Show', 'dealato' ),
				'type' 			=> Controls_Manager::SLIDER,
				'size_units' 	=> [ '%' ],
				'range' 		=> [
					'%' 	=> [
						'min' 		=> 0,
						'step' 		=> 1,
						'max' 		=> 10,
					],
				],
				'default' 		=> [
					'unit' 			=> '%',
					'size' 			=> 5,
				],
				'condition'		=> [ 'make_it_slider' => [ 'yes' ] ],
			]
		);
		$this->add_control(
			'laptop_items',
			[
				'label' 		=> __( 'Laptop Items', 'dealato' ),
				'type' 			=> Controls_Manager::SLIDER,
				'size_units' 	=> [ '%' ],
				'range' 		=> [
					'%' 	=> [
						'min' 	=> 0,
						'step' 	=> 1,
						'max' 	=> 10,
					],
				],
				'default' 	=> [
					'unit' 		=> '%',
					'size' 		=> 2,
				],
				'condition'		=> [ 'make_it_slider' => [ 'yes' ] ],
			]
		);

        $this->add_control(
			'tablet_items',
			[
				'label' 		=> __( 'Tablet Items', 'dealato' ),
				'type' 			=> Controls_Manager::SLIDER,
				'size_units' 	=> [ '%' ],
				'range' 		=> [
					'%' 	=> [
						'min' 	=> 0,
						'step' 	=> 1,
						'max' 	=> 10,
					],
				],
				'default' 	=> [
					'unit' 		=> '%',
					'size' 		=> 2,
				],
				'condition'		=> [ 'make_it_slider' => [ 'yes' ] ],
			]
		);

        $this->add_control(
			'mobile_items',
			[
				'label' 		=> __( 'Mobile Items', 'dealato' ),
				'type' 			=> Controls_Manager::SLIDER,
				'size_units' 	=> [ '%' ],
				'range' 		=> [
					'%' 	=> [
						'min' 	=> 0,
						'step' 	=> 1,
						'max' 	=> 10,
					],
				],
				'default' 	=> [
					'unit' 		=> '%',
					'size' 		=> 1,
				],
				'condition'		=> [ 'make_it_slider' => [ 'yes' ] ],
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


		$this->start_controls_tab(
			'style_normal_tab2',
			[
				'label' => esc_html__( 'Button', 'ruffer' ),
				'condition'		=> [ 'service_style' => [ '1' , '5'] ],
			]
		);
        $this->add_control(
			'button_color',
			[
				'label' 		=> __( 'Button Color', 'ruffer' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .themeholy-btn' => 'color: {{VALUE}}',
					'{{WRAPPER}} .link-btn' => '--theme-color: {{VALUE}}',
                ],
			]
        );

        $this->add_control(
			'button_color_hover',
			[
				'label' 		=> __( 'Button Color Hover', 'ruffer' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .themeholy-btn:hover' => 'color: {{VALUE}}',
                ],
			]
        );

        $this->add_control(
			'button_bg_color',
			[
				'label' 		=> __( 'Button Background Color', 'ruffer' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .themeholy-btn' => 'background-color:{{VALUE}}',
                ],
			]
        );

        $this->add_control(
			'button_bg_hover_color',
			[
				'label' 		=> __( 'Button Background Hover Color', 'ruffer' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .themeholy-btn:before' => 'background-color:{{VALUE}}',
                ],
			]
        );

        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 		=> 'border',
				'label' 	=> __( 'Border', 'ruffer' ),
                'selector' 	=> '{{WRAPPER}} .themeholy-btn',
			]
		);

        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 		=> 'border_hover',
				'label' 	=> __( 'Border Hover', 'ruffer' ),
                'selector' 	=> '{{WRAPPER}} .themeholy-btn:hover',
			]
		);

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'button_typography',
				'label' 	=> __( 'Button Typography', 'ruffer' ),
                'selector' 	=> '{{WRAPPER}} .themeholy-btn',
			]
        );

        $this->add_responsive_control(
			'button_margin',
			[
				'label' 		=> __( 'Button Margin', 'ruffer' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .themeholy-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
			]
        );

        $this->add_responsive_control(
			'button_padding',
			[
				'label' 		=> __( 'Button Padding', 'ruffer' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .themeholy-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
			]
		);
        $this->add_responsive_control(
			'button_border_radius',
			[
				'label' 		=> __( 'Button Border Radius', 'ruffer' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .themeholy-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'label' => esc_html__( 'Button Shadow', 'ruffer' ),
				'selector' => '{{WRAPPER}} .themeholy-btn',
			]
		);
		$this->end_controls_tab();

		//-------------------------------------bnutton or-------------------------------------//

		$this->start_controls_tab(
			'style_normal_tab6',
			[
				'label' => esc_html__( 'Button', 'ruffer' ),
				'condition'		=> [ 'service_style' => [ '2' ] ],
			]
		);
        $this->add_control(
			'button_2_color',
			[
				'label' 		=> __( 'Button Color', 'ruffer' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .th-btn' => 'color: {{VALUE}}',
                ],
			]
        );

        $this->add_control(
			'button_2_color_hover',
			[
				'label' 		=> __( 'Button Color Hover', 'ruffer' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .th-btn:hover' => 'color: {{VALUE}}',
                ],
			]
        );

        $this->add_control(
			'button_2_bg_color',
			[
				'label' 		=> __( 'Button Background Color', 'ruffer' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .th-btn' => 'background-color:{{VALUE}}',
                ],
			]
        );

        $this->add_control(
			'button_2_bg_hover_color',
			[
				'label' 		=> __( 'Button Background Hover Color', 'ruffer' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .th-btn.style6:hover::after' => 'background-color:{{VALUE}}',
                ],
			]
        );

        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 		=> 'border2',
				'label' 	=> __( 'Border', 'ruffer' ),
                'selector' 	=> '{{WRAPPER}} .th-btn',
			]
		);

        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 		=> 'border_hover2',
				'label' 	=> __( 'Border Hover', 'ruffer' ),
                'selector' 	=> '{{WRAPPER}} .th-btn:hover',
			]
		);

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'button_2_typography',
				'label' 	=> __( 'Button Typography', 'ruffer' ),
                'selector' 	=> '{{WRAPPER}} .th-btn',
			]
        );

        $this->add_responsive_control(
			'button_2_margin',
			[
				'label' 		=> __( 'Button Margin', 'ruffer' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .th-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
			]
        );

        $this->add_responsive_control(
			'button_2_padding',
			[
				'label' 		=> __( 'Button Padding', 'ruffer' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .th-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
			]
		);
        $this->add_responsive_control(
			'button_2_border_radius',
			[
				'label' 		=> __( 'Button Border Radius', 'ruffer' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .th-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow2',
				'label' => esc_html__( 'Button Shadow', 'ruffer' ),
				'selector' => '{{WRAPPER}} .th-btn',
			]
		);
		$this->end_controls_tab();

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
					'{{WRAPPER}} h3 a'	=> 'color: {{VALUE}}!important;',
					'{{WRAPPER}} .service-box.style2 .box-title a'	=> '--title-color: {{VALUE}}!important;',
					'{{WRAPPER}} .service-featured.style2 .service-featured_content .box-title a'	=> '--white-color: {{VALUE}}!important;',
				],
			]
        );
        $this->add_group_control(
		Group_Control_Typography::get_type(),
		 	[
				'name' 			=> 'overview_content_typography',
		 		'label' 		=> __( 'Typography', 'ruffer' ),
		 		'selector' 	=> '{{WRAPPER}} h3 a',
			]
		);

        $this->add_responsive_control(
			'overview_content_margin',
			[
				'label' 		=> __( 'Margin', 'ruffer' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} h3 a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} h3 a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

        
   
		if($settings['make_it_slider'] == 'yes'){
			if( $settings['service_style'] == '3' ){
				$this->add_render_attribute( 'wrapper', 'class', 'row slider-shadow th-carousel service-slider3' );	
			}elseif( $settings['service_style'] == '4' ){
				$this->add_render_attribute( 'wrapper', 'class', 'row th-carousel' );	
			}else{
				$this->add_render_attribute( 'wrapper', 'class', 'row slider-shadow th-carousel' );	
			}

			$this->add_render_attribute( 'wrapper', 'data-slide-show', $settings['desktop_items']['size'] );
	        $this->add_render_attribute( 'wrapper', 'data-lg-slide-show', $settings['laptop_items']['size'] );
	        $this->add_render_attribute( 'wrapper', 'data-md-slide-show', $settings['tablet_items']['size'] );
	        $this->add_render_attribute( 'wrapper', 'data-sm-slide-show', $settings['mobile_items']['size'] );
		}else{
			$this->add_render_attribute( 'wrapper', 'class', 'row gy-30' );
		}
		
		if( $settings['service_style'] == '1' ){

			echo '<div '.$this->get_render_attribute_string('wrapper').'>';
				foreach( $settings['slides2'] as $service_slider ){
	                echo '<div class="col-md-6 col-lg-4">';
	                    echo '<div class="service-featured">';
	                    	if( ! empty( $service_slider['service_slider_image']['url'] ) ){
		                        echo '<div class="service-featured_img">';
		                            echo '<img src="'.esc_url($service_slider['service_slider_image']['url']).'" alt="service">';
		                        echo '</div>';
		                    }
	                        echo '<div class="service-featured_content">'; 
	                        	if( ! empty( $settings['service_shape']['url'] ) ){
		                            echo '<div class="service-bg-shape">';
		                                echo '<img src="'.esc_url( $settings['service_shape']['url'] ).'" alt="img">';
		                            echo '</div>';
		                        }
		                        if( !empty( $service_slider['service_slider_icon_image']['url'] ) ) {
		                            echo '<div class="service-default-icon">';
		                                echo '<img src="'.esc_url( $service_slider['service_slider_icon_image']['url'] ).'" alt="Icon">';
		                            echo '</div>';
		                        }
		                        if( ! empty( $service_slider['service_title'] ) ){
		                            echo '<h3 class="box-title"><a href="'.esc_url( $service_slider['button_url'] ).'">'.esc_html( $service_slider['service_title'] ).'</a></h3>';
		                        }
		                        if( ! empty( $service_slider['service_description'] ) ){
		                            echo '<p class="service-featured_text">'.esc_html( $service_slider['service_description'] ).'</p>';
		                        }
		                        if( ! empty( $service_slider['button_text'] ) ){
		                            echo '<a href="'.esc_url( $service_slider['button_url'] ).'" class="link-btn">'.esc_html( $service_slider['button_text'] ).'<i class="fa-solid fa-arrow-up-right ms-2"></i></a>';
		                        }
	                        echo '</div>';
	                    echo '</div>';
	                echo '</div>';
	            }
            echo '</div>';
		}elseif( $settings['service_style'] == '2' ){
			echo '<div '.$this->get_render_attribute_string('wrapper').'>';
                foreach( $settings['slides2'] as $service_slider ){
	                echo '<div class="col-md-6 col-xl-4">';
	                    echo '<div class="service-card">';
	                    	if( ! empty( $service_slider['service_slider_image']['url'] ) ){
		                        echo '<div class="service-bg-shape"><img src="'.esc_url($service_slider['service_slider_image']['url']).'" alt="img"></div>';
		                    }
	                        echo '<div class="service-content">';
	                        	if( !empty( $service_slider['service_slider_icon_image']['url'] ) ) {
		                            echo '<div class="shape-icon">';
		                                echo '<img src="'.esc_url($service_slider['service_slider_icon_image']['url']).'" alt="Icon">';
		                            echo '</div>';
		                        }
		                        if( ! empty( $service_slider['service_title'] ) ){
		                            echo '<h3 class="box-title"><a href="'.esc_url( $service_slider['button_url'] ).'">'.esc_html( $service_slider['service_title'] ).'</a></h3>';
		                        }
		                        if( ! empty( $service_slider['service_description'] ) ){
		                            echo '<p class="service-card_text">'.esc_html( $service_slider['service_description'] ).'</p>';
		                        }
	                        echo '</div>';
	                        if( ! empty( $service_slider['button_text'] ) ){
		                        echo '<a href="'.esc_url( $service_slider['button_url'] ).'" class="th-btn style6">'.esc_html( $service_slider['button_text'] ).'<i class="fa-solid fa-arrow-up-right ms-3"></i></a>';
		                    }
	                    echo '</div>';
	                echo '</div>';
	            }
            echo '</div>';
		}elseif( $settings['service_style'] == '3' ){
			echo '<div '.$this->get_render_attribute_string('wrapper').'>';
               	foreach( $settings['slides2'] as $service_slider ){ 
	                echo '<div class="col-md-6 col-lg-4">';
	                    echo '<div class="service-box">';
	                    	if( ! empty( $service_slider['service_slider_image']['url'] ) ){
		                        echo '<div class="service-bg-shape">';
		                            echo '<img src="'.esc_url($service_slider['service_slider_image']['url']).'" alt="img">';
		                        echo '</div>';
		                    }
	                        echo '<div class="service-box_content">';
	                        	if( !empty( $service_slider['service_slider_icon_image']['url'] ) ) {
		                            echo '<div class="service-default-icon">';
		                                echo '<img src="'.esc_url($service_slider['service_slider_icon_image']['url']).'" alt="Icon">';
		                            echo '</div>';
		                        }
	                            if( ! empty( $service_slider['service_title'] ) ){
		                            echo '<h3 class="box-title"><a href="'.esc_url( $service_slider['button_url'] ).'">'.esc_html( $service_slider['service_title'] ).'</a></h3>';
		                        }
		                        if( ! empty( $service_slider['service_description'] ) ){
		                            echo '<p class="service-box_text">'.esc_html( $service_slider['service_description'] ).'</p>';
		                        }
	                        echo '</div>';
	                    echo '</div>';
	                echo '</div>';
	            }
                
            echo '</div>';
		}elseif( $settings['service_style'] == '4' ){
			echo '<div '.$this->get_render_attribute_string('wrapper').'>';
                foreach( $settings['slides2'] as $service_slider ){ 
	                echo '<div class="col-md-6 col-lg-4">';
	                    echo '<div class="service-box style2">';
	                        echo '<div class="service-box_content">';
	                        	if( !empty( $service_slider['service_slider_icon_image']['url'] ) ) {
		                            echo '<div class="service-default-icon">';
		                                echo '<img src="'.esc_url($service_slider['service_slider_icon_image']['url']).'" alt="img">';
		                            echo '</div>';
		                        }
		                        if( ! empty( $service_slider['service_title'] ) ){
		                            echo '<h3 class="box-title"><a href="'.esc_url( $service_slider['button_url'] ).'">'.esc_html( $service_slider['service_title'] ).'</a></h3>';
		                        }
		                        if( ! empty( $service_slider['service_description'] ) ){
		                            echo '<p class="service-box_text">'.esc_html( $service_slider['service_description'] ).'</p>';
		                        }
	                        echo '</div>';
	                        if( ! empty( $service_slider['service_slider_image']['url'] ) ){
		                        echo '<div class="thumb">';
		                            echo '<img src="'.esc_url($service_slider['service_slider_image']['url']).'" alt="img">';
		                            echo '<a href="'.esc_url( $service_slider['button_url'] ).'" class="icon">';
		                                echo '<i class="fas fa-arrow-right"></i>';
		                            echo '</a>';
		                        echo '</div>';
		                    }
	                    echo '</div>';
	                echo '</div>';
	            }
                
            echo '</div>';
		}elseif( $settings['service_style'] == '5' ){
			echo '<div '.$this->get_render_attribute_string('wrapper').'>';
                foreach( $settings['slides2'] as $service_slider ){ 
	                echo '<div class="col-md-6 col-lg-4">';
	                    echo '<div class="service-featured style2">';
	                    	if( ! empty( $service_slider['service_slider_image']['url'] ) ){
		                        echo '<div class="service-featured_img">';
		                            echo '<img src="'.esc_url($service_slider['service_slider_image']['url']).'" alt="service">';
		                        echo '</div>';
		                    }
	                        echo '<div class="service-featured_content">';
	                        	if( ! empty( $settings['service_shape']['url'] ) ){
		                            echo '<div class="service-bg-shape">';
		                                echo '<img src="'.esc_url( $settings['service_shape']['url'] ).'" alt="img">';
		                            echo '</div>';
		                        }
		                        if( !empty( $service_slider['service_slider_icon_image']['url'] ) ) {
		                            echo '<div class="service-default-icon">';
		                                echo '<img src="'.esc_url( $service_slider['service_slider_icon_image']['url'] ).'" alt="Icon">';
		                            echo '</div>';
		                        }
		                        if( ! empty( $service_slider['service_title'] ) ){
		                            echo '<h3 class="box-title"><a href="'.esc_url( $service_slider['button_url'] ).'">'.esc_html( $service_slider['service_title'] ).'</a></h3>';
		                        }
	                            echo '<div class="service-hover-wrap">';
	                            	if( ! empty( $service_slider['service_description'] ) ){
		                                echo '<p class="service-featured_text">'.esc_html( $service_slider['service_description'] ).'</p>';
		                            }
		                            if( ! empty( $service_slider['button_text'] ) ){
		                                echo '<a href="'.esc_url( $service_slider['button_url'] ).'" class="link-btn">'.esc_html( $service_slider['button_text'] ).'<i class="fa-solid fa-arrow-up-right ms-2"></i></a>';
		                            }
	                            echo '</div>';
	                        echo '</div>';
	                    echo '</div>';
	                echo '</div>';
	            } 
            echo '</div>';
		}elseif( $settings['service_style'] == '6' ){
			echo '<div class="row th-carousel g-0 service-slider7" data-slide-show="4" data-lg-slide-show="3" data-md-slide-show="2" data-sm-slide-show="1" data-xs-slide-show="1" data-arrows="true" data-center-mode="true">';

				$i = 0;
				foreach( $settings['slides2'] as $service_slider ){
					$i++;
		        	$k = str_pad($i, 2, '0', STR_PAD_LEFT);
	                echo '<div class="col-md-6 col-xl-4">';
	                    echo '<div class="service-card style3">';
	                        echo '<div class="service-bg-num">'.esc_html($k).'</div>';
	                        echo '<div class="service-content">';
	                        	if( !empty( $service_slider['service_slider_icon_image']['url'] ) ) {
		                            echo '<div class="shape-icon">';
		                                echo '<img src="'.esc_url( $service_slider['service_slider_icon_image']['url'] ).'" alt="Icon">';
		                            echo '</div>';
		                        }
	                            if( ! empty( $service_slider['service_title'] ) ){
		                            echo '<h3 class="box-title"><a href="'.esc_url( $service_slider['button_url'] ).'">'.esc_html( $service_slider['service_title'] ).'</a></h3>';
		                        }
		                        if( ! empty( $service_slider['service_description'] ) ){
		                            echo '<p class="service-card_text">'.esc_html( $service_slider['service_description'] ).'</p>';
		                        }
		                        if( ! empty( $service_slider['button_text'] ) ){
		                            echo '<a href="'.esc_url( $service_slider['button_url'] ).'" class="link-btn">'.esc_html( $service_slider['button_text'] ).'<i class="fa-solid fa-arrow-up-right ms-3"></i></a>';
		                        }
	                        echo '</div>';
	                    echo '</div>';
	                echo '</div>';
	            }
            echo '</div>';
		}elseif( $settings['service_style'] == '7' ){
			echo '<div class="row th-carousel arrow-style2 service-slider8 slider-shadow gy-4" data-slide-show="3" data-lg-slide-show="3" data-md-slide-show="2" data-sm-slide-show="1" data-xs-slide-show="1" data-arrows="true" data-center-mode="true">';
				foreach( $settings['slides2'] as $service_slider ){ 
					echo '<div class="col-md-6 col-xl-4">';
						echo '<div class="service-card style4">';
							if( ! empty( $service_slider['service_slider_image']['url'] ) ){
		                        echo '<div class="service-card_img">';
		                            echo '<img src="'.esc_url($service_slider['service_slider_image']['url']).'" alt="service">';
		                        echo '</div>';
		                    }
							echo '<div class="service-content">';
								if( ! empty( $settings['service_shape']['url'] ) ){
		                            echo '<div class="service-card-shape">';
		                                echo '<img src="'.esc_url( $settings['service_shape']['url'] ).'" alt="img">';
		                            echo '</div>';
		                        }
								if( !empty( $service_slider['service_slider_icon_image']['url'] ) ) {
		                            echo '<div class="service-card_icon">';
		                                echo '<img src="'.esc_url( $service_slider['service_slider_icon_image']['url'] ).'" alt="Icon">';
		                            echo '</div>';
		                        }
								if( ! empty( $service_slider['service_title'] ) ){
		                            echo '<h3 class="box-title"><a href="'.esc_url( $service_slider['button_url'] ).'">'.esc_html( $service_slider['service_title'] ).'</a></h3>';
		                        }
								if( ! empty( $service_slider['service_description'] ) ){
									echo '<p class="service-card_text">'.esc_html( $service_slider['service_description'] ).'</p>';
								}
								if( ! empty( $service_slider['button_text'] ) ){
									echo '<a href="'.esc_url( $service_slider['button_url'] ).'" class="link-btn">'.esc_html( $service_slider['button_text'] ).'<i class="fa-solid fa-arrow-up-right ms-2"></i></a>';
								}
								
							echo '</div>';
						echo '</div>';
					echo '</div>';
				}
			echo '</div>';
		}else{
			echo '<div class="row gx-0">';
				foreach( $settings['slides2'] as $service_slider ){ 
					echo '<div class="col-md-6 col-xl-4 service-list-wrap">';
						echo '<div class="service-list">';
							if( !empty( $service_slider['service_slider_icon_image']['url'] ) ) {
								echo '<div class="service-list_icon">';
									echo '<img src="'.esc_url( $service_slider['service_slider_icon_image']['url'] ).'" alt="Icon">';
								echo '</div>';
							}
							echo '<div class="service-list_content">';
								if( ! empty( $service_slider['service_title'] ) ){
									echo '<h3 class="service-list_title box-title"><a href="'.esc_url( $service_slider['button_url'] ).'">'.esc_html( $service_slider['service_title'] ).'</a></h3>';
								}
								if( ! empty( $service_slider['service_description'] ) ){
									echo '<p class="service-list_text">'.esc_html( $service_slider['service_description'] ).'</p>';
								}
								if( ! empty( $service_slider['button_text'] ) ){
									echo '<a href="'.esc_url( $service_slider['button_url'] ).'" class="link-btn">'.esc_html( $service_slider['button_text'] ).'<i class="fa-solid fa-arrow-up-right ms-3"></i></a>';
								}
							
							echo '</div>';
						echo '</div>';
					echo '</div>';
				}
            echo '</div>';
		}


	}
}

