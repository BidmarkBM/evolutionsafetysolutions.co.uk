<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Border;
use \Elementor\Utils;
/**
 *
 * Section Title Widget .
 *
 */
class Ruffer_Section_Title_Widget extends Widget_Base {

	public function get_name() {
		return 'ruffersectiontitle';
	}

	public function get_title() {
		return __( 'Section Title', 'ruffer' );
	}

	public function get_icon() {
		return 'eicon-code';
    }

	public function get_categories() {
		return [ 'ruffer' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_title_section',
			[
				'label'		 	=> __( 'Section Title', 'ruffer' ),
				'tab' 			=> Controls_Manager::TAB_CONTENT,
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
        $this->add_control(
			'section_subtitle',
			[
				'label' 	=> __( 'Section Subtitle', 'ruffer' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'default'  	=> __( 'Section Subtitle', 'ruffer' ),
			]
        );

        $this->add_control(
			'section_subtitle_tag',
			[
				'label' 	=> __( 'Subitle Tag', 'ruffer' ),
				'type' 		=> Controls_Manager::SELECT,
				'options' 	=> [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'p'  => 'P',
					'span'  => 'span',
				],
				'default' 	=> 'span',
				'condition'	=> ['section_subtitle!' => '']
			]
		);
		$this->add_control(
			'section_title',
			[
				'label' 	=> __( 'Section Title', 'ruffer' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'default'  	=> __( 'Section Title', 'ruffer' )
			]
        );
        $this->add_control(
			'section_title_tag',
			[
				'label' 	=> __( 'Title Tag', 'ruffer' ),
				'type' 		=> Controls_Manager::SELECT,
				'options' 	=> [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'span'  => 'span',
				],
				'default' => 'h2',
			]
        );
		$this->add_control(
			'section_description',
			[
				'label' 	=> __( 'Section Description', 'ruffer' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'default'  	=> __( 'Section Description', 'ruffer' )
			]
        );
        $this->add_responsive_control(
			'section_align',
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
				'selectors' 	=> [
					'{{WRAPPER}} .title-area-wrap' => 'text-align: {{VALUE}};',
                ]
			]
		);

        $this->end_controls_section();

        //-------------------------------------SHADOW title styling-------------------------------------//

        $this->start_controls_section(
			'shadow_title_style_section',
			[
				'label' => __( 'Shadow Title Style', 'ruffer' ),
				'tab' 	=> Controls_Manager::TAB_STYLE,
				'condition' 	=> [
                    'shadow_title!'    => '',
                ]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'types' => ['gradient'],
				'selector' => '{{WRAPPER}} .shadow-title',
			]
		);

        $this->end_controls_section();

        //-------------------------------------title styling-------------------------------------//

        $this->start_controls_section(
			'section_title_style_section',
			[
				'label' => __( 'Title Style', 'ruffer' ),
				'tab' 	=> Controls_Manager::TAB_STYLE,
				'condition' 	=> [
                    'section_title!'    => ''
                ]
			]
		);

        $this->add_control(
			'section_title_color',
			[
				'label' 	=> __( 'Title Color', 'ruffer' ),
				'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .title-selector' => 'color: {{VALUE}};',
                ],
			]
        );

        $this->add_control(
			'section_title_highlight_color',
			[
				'label' 	=> __( 'Title Highlighted Color', 'ruffer' ),
				'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .title-selector b' => 'color: {{VALUE}};',
					'{{WRAPPER}} .title-selector span' => 'color: {{VALUE}};',
                ],
			]
        );

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'section_title_typography',
				'label' 	=> __( 'Title Typography', 'ruffer' ),
                'selector' 	=> '{{WRAPPER}} .title-selector',
			]
		);

        $this->add_responsive_control(
			'section_title_margin',
			[
				'label' 		=> __( 'Title Margin', 'ruffer' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .title-selector' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
        );

        $this->add_responsive_control(
			'section_title_padding',
			[
				'label' 		=> __( 'Title Padding', 'ruffer' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .title-selector' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
		);

        $this->end_controls_section();


        //-------------------------------------subtitle styling-------------------------------------//

        $this->start_controls_section(
			'section_subtitle_style_section',
			[
				'label' => __( 'Subtitle Style', 'ruffer' ),
				'tab' 	=> Controls_Manager::TAB_STYLE,
				'condition' => [
                    'section_subtitle!'    => ''
                ],
			]
		);

		$this->add_control(
			'section_subtitle_color',
			[
				'label' 		=> __( 'Subtitle Color', 'ruffer' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .subtitle-selector' => 'color: {{VALUE}}!important',
                ],
			]
        );

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'section_subtitle_typography',
				'label' 	=> __( 'Subtitle Typography', 'ruffer' ),
                'selector' 	=> '{{WRAPPER}} .subtitle-selector',
			]
        );

        $this->add_responsive_control(
			'section_subtitle_margin',
			[
				'label' 		=> __( 'Subtitle Margin', 'ruffer' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .subtitle-selector' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],

			]
        );
        $this->add_responsive_control(
			'section_subtitle_padding',
			[
				'label' 		=> __( 'Subtitle Padding', 'ruffer' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .subtitle-selector' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
        );
        $this->end_controls_section();

        
        //-------------------------------------description styling-------------------------------------//

        $this->start_controls_section(
			'section_desc_style_section',
			[
				'label' => __( 'Description Style', 'ruffer' ),
				'tab' 	=> Controls_Manager::TAB_STYLE,
				'condition' 	=> [
                    'section_description!'    => ''
                ]
			]
		);

		$this->add_control(
			'section_desc_color',
			[
				'label' 		=> __( 'Description Color', 'ruffer' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .desc-selector' => 'color: {{VALUE}}!important',
                ],
			]
        );

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'section_desc_typography',
				'label' 	=> __( 'Description Typography', 'ruffer' ),
                'selector' 	=> '{{WRAPPER}} .desc-selector',
			]
        );

        $this->add_responsive_control(
			'section_desc_margin',
			[
				'label' 		=> __( 'Description Margin', 'ruffer' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .desc-selector' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
        );
        $this->add_responsive_control(
			'section_desc_padding',
			[
				'label' 		=> __( 'Description Padding', 'ruffer' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .desc-selector' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
        );
        $this->end_controls_section();

	}

	protected function render() {

        $settings = $this->get_settings_for_display();

		if( ! empty( $settings['section_description'] ) ) {
			$this->add_render_attribute( 'wrapper', 'class', 'title-area mb-30' );
		} else {
			$this->add_render_attribute( 'wrapper', 'class', 'title-area' );
		}


		echo '<div class="title-area-wrap">';
			echo '<div '.$this->get_render_attribute_string( 'wrapper' ).' >';
				
				if( !empty( $settings['section_subtitle'] ) ) {
					
					echo '<'.esc_attr($settings['section_subtitle_tag']).' class="sub-title subtitle-selector">';
						echo wp_kses_post( $settings['section_subtitle'] );
					echo '</'.esc_attr($settings['section_subtitle_tag']).'>';
				}
				if( ! empty( $settings['section_title'] ) ) {
					echo '<'.esc_attr($settings['section_title_tag']).' class="sec-title title-selector">'.wp_kses_post( $settings['section_title'] ).'</'.esc_attr($settings['section_title_tag']).'>';
				}
				
			echo '</div>';
			if( ! empty( $settings['section_description'] ) ){
				echo ruffer_paragraph_tag( array(
					'text'	=> wp_kses_post( $settings['section_description'] ),
					'class'	=> 'desc-selector mt-n2 mb-30'
				) );
			}
		echo '</div>';
        	
	}
}