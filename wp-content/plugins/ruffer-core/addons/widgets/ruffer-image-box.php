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
class Ruffer_Image extends Widget_Base {

	public function get_name() {
		return 'rufferimage';
	}

	public function get_title() {
		return __( 'Ruffer Image Box', 'ruffer' );
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

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' 			=> 'image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
				'default' 		=> 'large',
				'separator' 	=> 'none',
			]
		);

        $this->add_responsive_control(
			'image_align',
			[
				'label' 		=> __( 'Alignment', 'ruffer' ),
				'type' 			=> Controls_Manager::CHOOSE,
				'options' 		=> [
					'left' 	=> [
						'title' 		=> __( 'Left', 'ruffer' ),
						'icon' 			=> 'eicon-text-align-left',
					],
					'center' 	=> [
						'title' 		=> __( 'Center', 'ruffer' ),
						'icon' 			=> 'eicon-text-align-center',
					],
					'right' 	=> [
						'title' 		=> __( 'Right', 'ruffer' ),
						'icon' 			=> 'eicon-text-align-right',
					],
				],
				'default' 	=> 'left',
				'toggle' 	=> true,
				'selectors' => [
					'{{WRAPPER}} .custom_css_handelar' => 'text-align: {{VALUE}};',
				],
			]
        );

        $this->add_control(
			'link',
			[
				'label' 		=> __( 'Link', 'ruffer' ),
				'type' 			=> Controls_Manager::URL,
                'placeholder' 	=> __( 'https://your-link.com', 'ruffer' ),
                'show_external' => true,
				'default' 		=> [
					'url' 			=> '',
					'is_external' 	=> true,
					'nofollow' 		=> true,
				],
			]
        );
        
		$this->add_control(
			'image_wrapper_class',
			[
				'label'     => __( 'Image Wrapper Class', 'ruffer' ),
                'type'      => Controls_Manager::TEXT,
			]
        );
        $this->add_control(
			'show_vdo',
			[
				'label' 		=> __( 'Show Video Button?', 'ruffer' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Show', 'ruffer' ),
				'label_off' 	=> __( 'Hide', 'ruffer' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'yes',
			]
		);
		$this->add_control(
			'video_link',
			[
				'label' 		=> __( 'Video Url', 'ruffer' ),
				'type' 			=> Controls_Manager::URL,
                'placeholder' 	=> __( 'https://your-link.com', 'ruffer' ),
                'show_external' => true,
				'default' 		=> [
					'url' 			=> '',
					'is_external' 	=> true,
					'nofollow' 		=> true,
				],
				'condition'		=> [ 'show_vdo' => [ 'yes' ] ],
			]
        );
        $this->add_control(
			'image_class',
			[
				'label'     => __( 'Image Class', 'ruffer' ),
                'type'      => Controls_Manager::TEXT,
			]
        );
        $this->end_controls_section();


        $this->start_controls_section(
			'image_style_section',
			[
				'label' 	=> __( 'Image Style', 'ruffer' ),
                'tab' 		=> Controls_Manager::TAB_STYLE,
			]
        );

        $this->add_responsive_control(
			'width',
			[
				'label' 	=> __( 'Width', 'ruffer' ),
				'type' 		=> Controls_Manager::SLIDER,
				'default' 	=> [
					'unit' 		=> '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'size_units' => [ '%', 'px', 'vw' ],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 100,
					],
					'px' => [
						'min' => 1,
						'max' => 1000,
					],
					'vw' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .custom_css_handelar img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'space',
			[
				'label' 	=> __( 'Max Width', 'ruffer' ) . ' (%)',
				'type' 		=> Controls_Manager::SLIDER,
				'default' 	=> [
					'unit' 		=> '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'size_units' => [ '%' ],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .custom_css_handelar img' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'height',
			[
				'label' 	=> __( 'Height', 'ruffer' ),
				'type' 		=> Controls_Manager::SLIDER,
				'default' 	=> [
					'unit' 		=> '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'size_units' => [ '%', 'px', 'vw' ],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 100,
					],
					'px' => [
						'min' => 1,
						'max' => 1000,
					],
					'vw' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .custom_css_handelar img' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'separator_panel_style',
			[
				'type' 	=> Controls_Manager::DIVIDER,
				'style' => 'thick',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 		=> 'image_border',
				'selector' 	=> '{{WRAPPER}} .custom_css_handelar img',
			]
		);

		$this->add_responsive_control(
			'image_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'ruffer' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .custom_css_handelar img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 		=> 'image_box_shadow',
				'exclude' 	=> [
					'box_shadow_position',
				],
				'selector' => '{{WRAPPER}} .custom_css_handelar img',
			]
		);

		$this->end_controls_section();



		//-------------------------------video button styling------------------------------- //

		$this->start_controls_section(
			'video_btn_style_section',
			[
				'label' 	=> __( 'Video Button Style', 'mechon' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
				'condition'		=> [ 'show_vdo' => [ 'yes' ] ],
			]
		);

		$this->add_control(
			'video_btn_color',
			[
				'label' 	=> __( 'Video Button Color', 'vendora' ),
				'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .play-btn i' => 'color: {{VALUE}}',
                ]
			]
        );

		$this->add_control(
			'video_btn_hover_color',
			[
				'label' 	=> __( 'Video Button Hover Color', 'vendora' ),
				'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .play-btn:hover i' => 'color: {{VALUE}}!important;',
                ]
			]
        );

		$this->add_control(
			'video_btn_background_color',
			[
				'label' 	=> __( 'Video Button Background Color', 'vendora' ),
				'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .play-btn i' => 'background-color: {{VALUE}}!important;',
                ]
			]
		);

		$this->add_control(
			'video_btn_background_hover_color',
			[
				'label' 	=> __( 'Video Button Background Hover Color', 'vendora' ),
				'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .play-btn:hover i' => 'background-color: {{VALUE}}!important;',
                ]
			]
		);

		$this->add_control(
			'video_btn_ripple_effect_color',
			[
				'label' 		=> __( 'Video Button Ripple Effect Color', 'vendora' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .play-btn:after,{{WRAPPER}} .play-btn:before' => 'background-color: {{VALUE}}!important;',
                ]
			]
        );

		$this->end_controls_section();
		
	}

	protected function render() {

        $settings = $this->get_settings_for_display();

        $this->add_render_attribute('wrapper','class','custom_css_handelar');

        $this->add_render_attribute('wrapper','class',esc_attr( $settings['image_wrapper_class'] ));

        if( !empty( $settings['link']['url'] ) ) {
            $this->add_render_attribute('link','href',esc_url( $settings['link']['url'] ));
        }

        if( !empty( $settings['link']['nofollow'] ) ) {
            $this->add_render_attribute('link','rel', 'nofollow' );
        }

        if( !empty( $settings['link']['is_external'] ) ) {
            $this->add_render_attribute('link','target','_blank');
        }


        if($settings['show_vdo'] == 'yes'){
        	echo '<div class="video-area-1 text-center " data-bg-src="'.esc_url( Group_Control_Image_Size::get_attachment_image_src($settings['image']['id'],'image',$settings) ).'" data-overlay="black" data-opacity="8">';
		        echo '<div class="container">';
		            echo '<div class="video-box1">';
		                echo '<a href="'.esc_url($settings['video_link']['url']).'" class="play-btn style4 popup-video"><i class="fa-sharp fa-solid fa-play"></i></a>';
		            echo '</div>';
		        echo '</div>';
		    echo '</div>';
        }else{
        	if( !empty( $settings['image']['id'] ) ) {
	            echo '<!-- Image -->';
	                echo '<div '.$this->get_render_attribute_string('wrapper').'>';
						if( ! empty( $settings['link']['url'] ) ){
		                    echo '<a '.$this->get_render_attribute_string('link').'>';
						}

						echo '<img class="'.esc_attr( $settings['image_class'] ).'" src="'.esc_url( Group_Control_Image_Size::get_attachment_image_src($settings['image']['id'],'image',$settings) ).'" alt="'.esc_attr( ruffer_image_alt( Group_Control_Image_Size::get_attachment_image_src($settings['image']['id'],'image',$settings) ) ).'" >';

						if( ! empty( $settings['link']['url'] ) ){
		                   echo '</a>';
						}
						if($settings['show_vdo'] == 'yes'){
							if( !empty( $settings['video_link']['url'] ) ) {
								echo '<a href="'.esc_url($settings['video_link']['url']).'" class="play-btn style4 popup-video"><i class="fa-sharp fa-solid fa-play"></i></a>';
							}						
						}
	                echo '</div>';
	            echo '<!-- End Image -->';
	        }
        }
	}
}