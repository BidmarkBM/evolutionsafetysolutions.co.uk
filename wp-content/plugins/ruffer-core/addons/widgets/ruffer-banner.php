<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Group_Control_Border;
/**
 *
 * Banner Widget.
 *
 */
class Ruffer_Banner extends Widget_Base {

	public function get_name() {
		return 'rufferbanner';
	}

	public function get_title() {
		return __( 'Banner', 'ruffer' );
	}

	public function get_icon() {
		return 'eicon-code';
    }

	public function get_categories() {
		return [ 'ruffer_header_elements' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'Banner_section',
			[
				'label' 	=> __( 'Banner', 'ruffer' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );

		$this->add_control(
			'layout',
			[
				'label' 		=> __( 'Ruffer Banner Style', 'ruffer' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> '1',
				'options' 		=> [
					'1'  		=> __( 'Style One', 'ruffer' ),
					'2' 		=> __( 'Style Two', 'ruffer' ),
					'3' 		=> __( 'Style Three', 'ruffer' ),
					'4' 		=> __( 'Style Four', 'ruffer' ),
					'5' 		=> __( 'Style Five', 'ruffer' ),
					'6' 		=> __( 'Style Six', 'ruffer' ),
				],
			]
		);

		/*-----------------------------------------style one ------------------------------------*/
		$repeater = new Repeater();
		$repeater->add_control(
            'banner_img',
            [
                'label'     => __( 'Banner Image', 'ruffer' ),
                'type'      => Controls_Manager::MEDIA,
                'dynamic' 		=> [
					'active' 		=> true,
				],
				'default' 		=> [
					'url' 		=> Utils::get_placeholder_image_src(),
				],
            ]
        );
        $repeater->add_control(
			'title', [
				'label' 		=> __( 'Title', 'ruffer' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'rows' 			=> 2,
				'default' 		=> __( 'Classical Education' , 'ruffer' ),
				'label_block' 	=> true,
			]
        );
        $repeater->add_control(
			'subtitle', [
				'label' 		=> __( 'Subtitle', 'ruffer' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'rows' 			=> 2,
				'default' 		=> __( 'For The Future...' , 'ruffer' ),
				'label_block' 	=> true,
			]
        );

        $repeater->add_control(
			'video_link',
			[
				'label' 		=> esc_html__( 'Video Link', 'ruffer' ),
				'type' 			=> Controls_Manager::URL,
				'placeholder' 	=> esc_html__( 'https://your-link.com', 'ruffer' ),
				'show_external' => true,
				'default' 		=> [
					'url' 			=> '#',
					'is_external' 	=> false,
					'nofollow' 		=> false,
				],
			]
		);
		$repeater->add_control(
			'button_text',
			[
				'label' 	=> esc_html__( 'Button Text', 'ruffer' ),
                'type' 		=> Controls_Manager::TEXT,
                'default'  	=> esc_html__( 'Get More Info', 'ruffer' ),
			]
        );

        $repeater->add_control(
			'button_link',
			[
				'label' 		=> esc_html__( 'Button Link', 'ruffer' ),
				'type' 			=> Controls_Manager::URL,
				'placeholder' 	=> esc_html__( 'https://your-link.com', 'ruffer' ),
				'show_external' => true,
				'default' 		=> [
					'url' 			=> '#',
					'is_external' 	=> false,
					'nofollow' 		=> false,
				],
			]
		);
		$repeater->add_control(
            'banner_small_img',
            [
                'label'     => __( 'Banner Small Image', 'ruffer' ),
                'type'      => Controls_Manager::MEDIA,
                'dynamic' 		=> [
					'active' 		=> true,
				],
				'default' 		=> [
					'url' 		=> Utils::get_placeholder_image_src(),
				],
            ]
        );
		
        $this->add_control(

			'banner_1',
			[
				'label' 		=> __( 'Banner Slider', 'ruffer' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'title' => __( 'Add Title','ruffer' ),
					],
				],
				'title_field' 	=> '{{{ title.value }}}',
				'condition'		=> [ 'layout' => [ '1', '3', '4', '6' ] ],
			]
		);

		/*-----------------------------------------style two ------------------------------------*/

		$this->add_control(
			'title', [
				'label' 		=> __( 'Title', 'ruffer' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'rows' 			=> 2,
				'default' 		=> __( 'Classical Education' , 'ruffer' ),
				'label_block' 	=> true,
				'condition'		=> [ 'layout' => [ '2', '5' ] ],
			]
        );
        $this->add_control(
			'subtitle', [
				'label' 		=> __( 'Subtitle', 'ruffer' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'rows' 			=> 2,
				'default' 		=> __( 'For The Future...' , 'ruffer' ),
				'label_block' 	=> true,
				'condition'		=> [ 'layout' => [ '2', '5' ] ],
			]
        );

		$this->add_control(
			'desc', [
				'label' 		=> __( 'Description', 'ruffer' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'rows' 			=> 2,
				'default' 		=> __( 'For The Future...' , 'ruffer' ),
				'label_block' 	=> true,
				'condition'		=> [ 'layout' => [ '2', '5' ] ],
			]
        );

        $this->add_control(
			'button_text',
			[
				'label' 	=> esc_html__( 'Button Text', 'plumer' ),
                'type' 		=> Controls_Manager::TEXT,
                'default'  	=> esc_html__( 'Get More Info', 'plumer' ),
                'condition'		=> [ 'layout' => [ '2', '5' ] ],
			]
        );

        $this->add_control(
			'button_link',
			[
				'label' 		=> esc_html__( 'Button Link', 'plumer' ),
				'type' 			=> Controls_Manager::URL,
				'placeholder' 	=> esc_html__( 'https://your-link.com', 'plumer' ),
				'show_external' => true,
				'default' 		=> [
					'url' 			=> '#',
					'is_external' 	=> false,
					'nofollow' 		=> false,
				],
				'condition'		=> [ 'layout' => [ '2', '5' ] ],
			]
		);
		$this->add_control(
			'button_text2',
			[
				'label' 	=> esc_html__( 'Button Text 2', 'plumer' ),
                'type' 		=> Controls_Manager::TEXT,
                'default'  	=> esc_html__( 'Get More Info', 'plumer' ),
                'condition'		=> [ 'layout' => [ '2' ] ],
			]
        );

        $this->add_control(
			'button_link2',
			[
				'label' 		=> esc_html__( 'Button Link 2', 'plumer' ),
				'type' 			=> Controls_Manager::URL,
				'placeholder' 	=> esc_html__( 'https://your-link.com', 'plumer' ),
				'show_external' => true,
				'default' 		=> [
					'url' 			=> '#',
					'is_external' 	=> false,
					'nofollow' 		=> false,
				],
				'condition'		=> [ 'layout' => [ '2' ] ],
			]
		);

		$this->add_control(
            'bg_shape',
            [
                'label'     => __( 'Banner Shape', 'ruffer' ),
                'type'      => Controls_Manager::MEDIA,
                'dynamic' 		=> [
					'active' 		=> true,
				],
				'default' 		=> [
					'url' 		=> Utils::get_placeholder_image_src(),
				],
				'condition'		=> [ 'layout' => [ '2' ] ],
            ]
        );
        $this->add_control(
            'bg_iamge',
            [
                'label'     => __( 'Banner Image', 'ruffer' ),
                'type'      => Controls_Manager::MEDIA,
                'dynamic' 		=> [
					'active' 		=> true,
				],
				'default' 		=> [
					'url' 		=> Utils::get_placeholder_image_src(),
				],
				'condition'		=> [ 'layout' => [ '2', '5' ] ],
            ]
        );
        $this->end_controls_section();

        //---------------------------------------Subtitle Style---------------------------------------//

		$this->start_controls_section(
			'subtitle_style',
			[
				'label' 	=> __( 'Subtitle Style', 'plumer' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'subtitle_color',
			[
				'label' 		=> __( 'Subtitle Color', 'plumer' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .hero-style1 .text-theme' => '--theme-color: {{VALUE}}',
					'{{WRAPPER}} .hero-style3 .text-theme' => '--theme-color: {{VALUE}}',
					'{{WRAPPER}} .hero-style4 .text-theme' => '--theme-color: {{VALUE}}',
					'{{WRAPPER}} .hero-subtitle' => 'color: {{VALUE}}',
                ],
			]
        );
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'subtitle_typography',
				'label' 	=> __( 'Subtitle Typography', 'plumer' ),
                'selector' 	=> '{{WRAPPER}} .hero-subtitle',
			]
        );
        $this->add_responsive_control(
			'subtitle_margin',
			[
				'label' 		=> __( 'Subtitle Margin', 'plumer' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .hero-subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
			]
        );

        $this->add_responsive_control(
			'subtitle_padding',
			[
				'label' 		=> __( 'Subtitle Padding', 'plumer' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .hero-subtitle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
			]
		);
		$this->end_controls_section();

		//---------------------------------------title Style---------------------------------------//

		$this->start_controls_section(
			'title_style',
			[
				'label' 	=> __( 'Title Style', 'plumer' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' 		=> __( 'Title Color', 'plumer' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .hero-style1 .text-white' => '--white-color: {{VALUE}}',
					'{{WRAPPER}} .hero-style3 .text-white' => '--white-color: {{VALUE}}',
					'{{WRAPPER}} .hero-style4 .text-white' => '--white-color: {{VALUE}}',
					'{{WRAPPER}} .hero-style5 .text-white' => '--white-color: {{VALUE}}',
					'{{WRAPPER}} .hero-title' => 'color: {{VALUE}}',
                ],
			]
        );
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'title_typography',
				'label' 	=> __( 'Title Typography', 'plumer' ),
                'selector' 	=> '{{WRAPPER}} h1',
			]
        );
        $this->add_responsive_control(
			'title_margin',
			[
				'label' 		=> __( 'Title Margin', 'plumer' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} h1' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
			]
        );

        $this->add_responsive_control(
			'title_padding',
			[
				'label' 		=> __( 'Title Padding', 'plumer' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} h1' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
			]
		);
		$this->end_controls_section();

		//---------------------------------------description Style---------------------------------------//

		$this->start_controls_section(
			'desc_style',
			[
				'label' 	=> __( 'Description Style', 'plumer' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
				'condition'		=> [ 'layout' => [ '2','5' ] ],
			]
		);
		$this->add_control(
			'desc_color',
			[
				'label' 		=> __( ' Color', 'plumer' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .hero-style2 p, {{WRAPPER}} .hero-style5 p' => 'color: {{VALUE}}',
                ],
			]
        );
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'desc_typography',
				'label' 	=> __( ' Typography', 'plumer' ),
                'selector' 	=> '{{WRAPPER}} .hero-style2 p, {{WRAPPER}} .hero-style5 p',
			]
        );
        $this->add_responsive_control(
			'desc_margin',
			[
				'label' 		=> __( ' Margin', 'plumer' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .hero-style2 p, {{WRAPPER}} .hero-style5 p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
			]
        );

        $this->add_responsive_control(
			'desc_padding',
			[
				'label' 		=> __( ' Padding', 'plumer' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .hero-style2 p, {{WRAPPER}} .hero-style5 p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
			]
		);
		$this->end_controls_section();

		//--------------------------button style--------------------------//

		$this->start_controls_section(
			'button_style_section',
			[
				'label' 	=> __( 'Button Style', 'ruffer' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
				'condition'		=> [ 'layout' => [ '1' ] ],
			]
        );

        $this->add_control(
			'button_color',
			[
				'label' 		=> __( 'Button Color', 'ruffer' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .th-btn' => 'color: {{VALUE}}',
                ],
			]
        );

        $this->add_control(
			'button_color_hover',
			[
				'label' 		=> __( 'Button Color Hover', 'ruffer' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .th-btn:hover' => 'color: {{VALUE}}',
                ],
			]
        );

        $this->add_control(
			'button_bg_color',
			[
				'label' 		=> __( 'Button Background Color', 'ruffer' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .th-btn' => 'background-color:{{VALUE}}',
                ],
			]
        );

        $this->add_control(
			'button_bg_hover_color',
			[
				'label' 		=> __( 'Button Background Hover Color', 'ruffer' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .th-btn.style3:hover::after' => 'background-color:{{VALUE}}',
                ],
			]
        );

        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 		=> 'border',
				'label' 	=> __( 'Border', 'ruffer' ),
                'selector' 	=> '{{WRAPPER}} .th-btn',
			]
		);

        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 		=> 'border_hover',
				'label' 	=> __( 'Border Hover', 'ruffer' ),
                'selector' 	=> '{{WRAPPER}} .th-btn:hover',
			]
		);

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'button_typography',
				'label' 	=> __( 'Button Typography', 'ruffer' ),
                'selector' 	=> '{{WRAPPER}} .th-btn',
			]
        );

        $this->add_responsive_control(
			'button_margin',
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
			'button_padding',
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
			'button_border_radius',
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
				'name' => 'box_shadow',
				'label' => esc_html__( 'Button Shadow', 'ruffer' ),
				'selector' => '{{WRAPPER}} .th-btn',
			]
		);
        $this->end_controls_section();

    }

	protected function render() {

        $settings = $this->get_settings_for_display();
        if( $settings['layout'] == '1' ){

        	echo '<div class="th-hero-wrapper hero-1" id="hero">';
		        echo '<div class="hero-slider-1 th-carousel" data-fade="true" data-slide-show="1" data-md-slide-show="1" data-arrows="true">';

		        	foreach( $settings['banner_1'] as $data ){
			            echo '<div class="th-hero-slide">';
			            	if( !empty( $data['banner_img']['url'] ) ){
				                echo '<div class="th-hero-bg" data-bg-src="'.esc_url( $data['banner_img']['url'] ).'"></div>';
				            }
			                echo '<div class="container">';
			                    echo '<div class="row align-items-center justify-content-center">';
			                        echo '<div class="col-lg-8 col-md-10">';
			                            echo '<div class="hero-style1">';
			                            	if(!empty($data['title'])){
				                                echo '<span class="hero-subtitle text-theme" data-ani="slideinleft" data-ani-delay="0.1s">'.esc_html($data['title']).'</span>';
				                            }
				                            if(!empty($data['subtitle'])){
				                                echo '<h1 class="hero-title text-white" data-ani="slideinleft" data-ani-delay="0.4s">'.esc_html($data['subtitle']).'</h1>';
				                            }
				                            if(!empty($data['button_text'])){
				                                echo '<div class="btn-group" data-ani="slideinleft" data-ani-delay="0.7s">';
				                                    echo '<a href="'.esc_url( $data['button_link']['url'] ).'" class="th-btn style3">'.esc_html($data['button_text']).'<i class="fa-regular fa-arrow-right ms-2"></i></a>';
				                                echo '</div>';
				                            }
			                            echo '</div>';
			                        echo '</div>';
			                        if(!empty($data['video_link'])){
				                        echo '<div class="col-lg-4 text-lg-end text-center">';
				                            echo '<div class="hero-video-1">';
				                                echo '<a href="'.esc_url( $data['video_link']['url'] ).'" class="play-btn style2 popup-video"><i class="fas fa-play"></i></a>';
				                            echo '</div>';
				                        echo '</div>';
				                    }
			                    echo '</div>';
			                echo '</div>';
			            echo '</div>';
			        } 
		        echo '</div>';
		    echo '</div>';
		}elseif( $settings['layout'] == '2' ){
			echo '<div class="th-hero-wrapper hero-2">';
				if( !empty( $settings['bg_shape']['url'] ) ){
			        echo '<div class="banner-img" data-bg-src="'.esc_url( $settings['bg_shape']['url'] ).'">';
			        echo '</div>';
			    }

		        echo '<div class="hero-bg-anime2-1 shape-mockup moving" data-left="40%" data-bottom="10%">';
		            echo '<img src="'.RUFFER_PLUGDIRURI . 'assets/img/hero_bg_anime2-1.jpg" alt="hero">';
		        echo '</div>';
		        echo '<div class="hero-bg-anime2-2 shape-mockup movingX" data-left="51%" data-top="23%">';
		            echo '<img src="'.RUFFER_PLUGDIRURI . 'assets/img/hero_bg_anime2-2.jpg" alt="hero">';
		        echo '</div>';
		        echo '<div class="container">';
		            echo '<div class="row justify-content-center">';
		                echo '<div class="col-md-7">';
		                    echo '<div class="hero-style2">';
		                    	if(!empty($settings['title'])){
			                        echo '<span class="hero-subtitle">'.esc_html($settings['title']).'</span>';
			                    }
			                    if(!empty($settings['subtitle'])){
			                        echo '<h1 class="hero-title">'.esc_html($settings['subtitle']).'</h1>';
			                    }
			                    if(!empty($settings['desc'])){
			                        echo '<p class="hero-text">'.esc_html($settings['desc']).'</p>';
			                    }
		                        echo '<div class="btn-group">';
		                        	if(!empty($settings['button_text'])){
			                            echo '<a href="'.esc_url( $settings['button_link']['url'] ).'" class="th-btn ">'.esc_html($settings['button_text']).'<i class="fa-regular fa-arrow-right ms-3"></i></a>';
			                        }
			                        if(!empty($settings['button_text2'])){
			                            echo '<a href="'.esc_url( $settings['button_link2']['url'] ).'" class="th-btn style7 ">'.esc_html($settings['button_text2']).'<i class="fa-regular fa-arrow-right ms-3"></i></a>';
			                        }
		                        echo '</div>';
		                    echo '</div>';
		                echo '</div>';
		                if( !empty( $settings['bg_iamge']['url'] ) ){
			                echo '<div class="col-md-5 col-sm-7 align-self-end d-sm-block d-none">';
			                    echo '<div class="hero-thumb"><img src="'.esc_url( $settings['bg_iamge']['url'] ).'" alt="hero"></div>';
			                echo '</div>';
			            }
		            echo '</div>';
		        echo '</div>';
		    echo '</div>';
		}elseif( $settings['layout'] == '3' ){
			 echo '<div class="th-hero-wrapper hero-3" id="hero">';
		        echo '<div class="hero-slider-2 th-carousel" data-fade="true" data-slide-show="1" data-md-slide-show="1" data-arrows="true">';

		        	foreach( $settings['banner_1'] as $data ){
			            echo '<div class="th-hero-slide">';
			            	if( !empty( $data['banner_img']['url'] ) ){
				                echo '<div class="th-hero-bg" data-bg-src="'.esc_url( $data['banner_img']['url'] ).'" data-overlay="black" data-opacity="7"></div>';
				            }
			                echo '<div class="container">';
			                    echo '<div class="row align-items-center justify-content-center">';
			                        echo '<div class="col-lg-9">';
			                            echo '<div class="hero-style3 text-center">';
			                            	if(!empty($data['title'])){
				                                echo '<span class="hero-subtitle text-theme" data-ani="slideinup" data-ani-delay="0.1s">'.esc_html($data['title']).'</span>';
				                            }
				                            if(!empty($data['subtitle'])){
				                                echo '<h1 class="hero-title text-white" data-ani="slideinup" data-ani-delay="0.4s">'.esc_html($data['subtitle']).'</h1>';
				                            }
				                            if(!empty($data['button_text'])){
				                                echo '<div class="btn-group justify-content-center" data-ani="slideinup" data-ani-delay="0.7s">';
				                                    echo '<a href="'.esc_url( $data['button_link']['url'] ).'" class="th-btn style3">'.esc_html($data['button_text']).'<i class="fa-regular fa-arrow-right ms-3"></i></a>';
				                                echo '</div>';
				                            }
			                            echo '</div>';
			                        echo '</div>';
			                    echo '</div>';
			                echo '</div>';
			            echo '</div>';
			        }
		        echo '</div>';
		    echo '</div>';
		}elseif( $settings['layout'] == '4' ){
			echo '<div class="th-hero-wrapper hero-4" id="hero">';
		        echo '<div class="hero-slider-3 th-carousel" data-fade="true" data-slide-show="1" data-md-slide-show="1" data-arrows="false" data-dots="true">';

		        	foreach( $settings['banner_1'] as $data ){
			            echo '<div class="th-hero-slide">';
			            	if( !empty( $data['banner_img']['url'] ) ){
				                echo '<div class="th-hero-bg" data-bg-src="'.esc_url( $data['banner_img']['url'] ).'"></div>';
				            }
			                echo '<div class="container">';
			                    echo '<div class="row align-items-center">';
			                        echo '<div class="col-xxl-7 col-xl-6 col-md-7">';
			                            echo '<div class="hero-style4">';
			                            	if(!empty($data['title'])){
				                                echo '<span class="hero-subtitle text-theme" data-ani="slideinleft" data-ani-delay="0.1s">'.esc_html($data['title']).'</span>';
				                            }
				                            if(!empty($data['subtitle'])){
				                                echo '<h1 class="hero-title text-white" data-ani="slideinleft" data-ani-delay="0.4s">'.esc_html($data['subtitle']).'</h1>';
				                            }
				                            if(!empty($data['button_text'])){
				                                echo '<div class="btn-group" data-ani="slideinleft" data-ani-delay="0.7s">';
				                                    echo '<a href="'.esc_url( $data['button_link']['url'] ).'" class="th-btn style3">'.esc_html($data['button_text']).'<i class="fa-regular fa-arrow-right ms-2"></i></a>';
				                                echo '</div>';
				                            }
			                            echo '</div>';
			                        echo '</div>';
			                    echo '</div>';
			                echo '</div>';
			            echo '</div>';
			        }
		        echo '</div>';
		    echo '</div>';
		}elseif( $settings['layout'] == '5' ){
			if( !empty( $settings['bg_iamge']['url'] ) ){
				echo '<div class="th-hero-wrapper hero-5" data-bg-src="'.esc_url( $settings['bg_iamge']['url'] ).'">';
			}
		        echo '<div class="container">';
		            echo '<div class="row justify-content-lg-start justify-content-center">';
		                echo '<div class="col-xl-7 col-md-8">';
		                    echo '<div class="hero-style5 text-lg-start text-center">';
		                    	if(!empty($settings['title'])){
			                        echo '<span class="hero-subtitle">'.esc_html($settings['title']).'</span>';
			                    }
			                    if(!empty($settings['subtitle'])){
			                        echo '<h1 class="hero-title text-white">'.esc_html($settings['subtitle']).'</h1>';
			                    }
			                    if(!empty($settings['desc'])){
			                        echo '<p class="hero-text text-white">'.esc_html($settings['desc']).'</p>';
			                    }
			                    if(!empty($settings['button_text'])){
			                        echo '<a href="'.esc_url( $settings['button_link']['url'] ).'" class="th-btn style3">'.esc_html($settings['button_text']).'<i class="fa-regular fa-arrow-right ms-3"></i></a>';
			                    }
		                    echo '</div>';
		                echo '</div>';
		            echo '</div>';
		        echo '</div>';
		    echo '</div>';
		}else{
			echo '<div class="th-hero-wrapper hero-6" id="hero-sec">';
		        echo '<div class="hero-slider-6 th-carousel" data-fade="true" data-slide-show="1" data-md-slide-show="1" data-arrows="false" data-adaptive-height="true">';

		        	foreach( $settings['banner_1'] as $data ){
			            echo '<div class="th-hero-slide">';
			            	if( !empty( $data['banner_img']['url'] ) ){
				                echo '<div class="th-hero-bg" data-bg-src="'.esc_url( $data['banner_img']['url'] ).'" data-overlay="black" data-opacity="7"></div>';
				            }
			                echo '<div class="container">';
			                    echo '<div class="row align-items-center">';
			                        echo '<div class="col-xl-7 col-lg-8">';
			                            echo '<div class="hero-style6 text-lg-start text-center">';
			                            	if(!empty($data['title'])){
				                                echo '<span class="hero-subtitle text-theme" data-ani="slideinup" data-ani-delay="0.1s">'.esc_html($data['title']).'</span>';
				                            }
				                            if(!empty($data['subtitle'])){
				                                echo '<h1 class="hero-title text-white" data-ani="slideinup" data-ani-delay="0.4s">'.esc_html($data['subtitle']).'</h1>';
				                            }

				                            if(!empty($data['button_text'])){
				                                echo '<div class="btn-group justify-content-lg-start justify-content-center" data-ani="slideinup" data-ani-delay="0.7s">';
				                                    echo '<a href="'.esc_url( $data['button_link']['url'] ).'" class="th-btn style6">'.esc_html($data['button_text']).'<i class="fa-regular fa-arrow-right ms-3"></i></a>';
				                                echo '</div>';
				                            }
			                            echo '</div>';
			                        echo '</div>';
			                        if(!empty($data['video_link'])){
				                        echo '<div class="col-lg-4 text-center">';
				                            echo '<div class="hero-video-1">';
				                                echo '<a href="'.esc_url( $data['video_link']['url'] ).'" class="play-btn style2 popup-video"><i class="fas fa-play"></i></a>';
				                            echo '</div>';
				                        echo '</div>';
				                    }
			                    echo '</div>';
			                echo '</div>';
			            echo '</div>';
			        }


		            
		        echo '</div>';
		        echo '<div class="hero-slider-indicator overflow-hidden" data-asnavfor=".hero-slider-6">';
		        	$i = 0;
		        	foreach( $settings['banner_1'] as $data ){
		        		$i++;
		        		$active_class = ($i == 1) ? 'active' : '';
			            echo '<span class="indicator-btn '.esc_attr( $active_class ).'"><img src="'.esc_url( $data['banner_small_img']['url'] ).'" alt="hero"></span>';
			        }
		        echo '</div>';
		    echo '</div>';
		}
	}
}