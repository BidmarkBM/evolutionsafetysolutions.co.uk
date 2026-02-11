<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
/**
 *
 * Button Widget .
 *
 */
class Ruffer_Button extends Widget_Base {

	public function get_name() {
		return 'rufferbutton';
	}

	public function get_title() {
		return __( 'Button', 'ruffer' );
	}

	public function get_icon() {
		return 'eicon-code';
    }

	public function get_categories() {
		return [ 'ruffer' ];
	}


	protected function register_controls() {

		$this->start_controls_section(
			'button_section',
			[
				'label' 	=> __( 'Button', 'ruffer' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );
  //       $this->add_control(
		// 	'button_style',
		// 	[
		// 		'label' 	=> __( 'Button Style', 'ruffer' ),
		// 		'type' 		=> Controls_Manager::SELECT,
		// 		'default' 	=> '1',
		// 		'options' 	=> [
		// 			'1'  		=> __( 'Style One', 'ruffer' ),
		// 			'2' 		=> __( 'Style Two', 'ruffer' ),
		// 		],
		// 	]
		// );

        $this->add_control(
			'button_text',
			[
				'label' 	=> __( 'Button Text', 'ruffer' ),
                'type' 		=> Controls_Manager::TEXT,
                'default'  	=> __( 'Button Text', 'ruffer' )
			]
        );

        $this->add_control(
			'button_link',
			[
				'label' 		=> __( 'Link', 'ruffer' ),
				'type' 			=> Controls_Manager::URL,
				'placeholder' 	=> __( 'https://your-link.com', 'ruffer' ),
				'show_external' => true,
				'default' 		=> [
					'url' 			=> '#',
					'is_external' 	=> false,
					'nofollow' 		=> false,
				],
			]
		);
		$this->add_control(
			'button_icon',
			[
				'label' 	=> __( 'Button Icon Class', 'ruffer' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'rows' 		=> 2
			]
        );

		$this->add_control(
			'button_icon_position',
			[
				'label' 	=> __( 'Button Icon Position', 'ruffer' ),
				'type' 		=> Controls_Manager::SELECT,
				'default' 	=> '1',
				'options' 	=> [
					'1'  		=> __( 'Before Text', 'ruffer' ),
					'2' 		=> __( 'After Text', 'ruffer' ),
				],
			]
		);

        $this->add_responsive_control(
			'button_align',
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
				'default' 		=> 'left',
				'toggle' 		=> true,
				'selectors' 	=> [
					'{{WRAPPER}} .btn-wrapper' => 'text-align: {{VALUE}}',
                ],
			]
        );

        $this->end_controls_section();

        $this->start_controls_section(
			'button_style_section',
			[
				'label' 	=> __( 'Button Style', 'ruffer' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
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
					'{{WRAPPER}} .th-btn.style2:hover::after' => 'background-color:{{VALUE}}',
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

        $this->add_render_attribute( 'wrapper', 'class', 'btn-wrapper');

		if ( isset( $settings['button_align'] ) ) {
			$this->add_render_attribute( 'wrapper', 'class', esc_attr( $settings['button_align'] ) );
		}
        
		$this->add_render_attribute( 'button', 'class', 'th-btn style2' );
		
	    


        if( ! empty( $settings['button_link']['url'] ) ) {
            $this->add_render_attribute( 'button', 'href', esc_url( $settings['button_link']['url'] ) );
        }

        if( ! empty( $settings['button_link']['nofollow'] ) ) {
            $this->add_render_attribute( 'button', 'rel', 'nofollow' );
        }

        if( ! empty( $settings['button_link']['is_external'] ) ) {
            $this->add_render_attribute( 'button', 'target', '_blank' );
        }

        echo '<!-- Button -->';
        echo '<div '.$this->get_render_attribute_string('wrapper').'>';
        	
        	if( ! empty( $settings['button_text'] ) ) {
                echo '<a '.$this->get_render_attribute_string('button').'>';
                if( ! empty( $settings['button_icon'] ) && $settings['button_icon_position'] == '1'  ){
					echo wp_kses_post($settings['button_icon']);
				}
                echo esc_html( $settings['button_text'] );
                if( ! empty( $settings['button_icon'] ) && $settings['button_icon_position'] == '2'  ){
					echo wp_kses_post($settings['button_icon']);
				}
                echo '</a>';
	        }
        echo '</div>';
        echo '<!-- End Button -->';
	}

}