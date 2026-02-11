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
class Ruffer_Skill_Box extends Widget_Base {

	public function get_name() {
		return 'rufferskillbox';
	}

	public function get_title() {
		return __( 'Ruffer Skill', 'ruffer' );
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
				'label' 	=> __( 'Skill', 'ruffer' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
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
			'parcetige',
			[
				'label'     => __( 'Number', 'ruffer' ),
                'type'      => Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
			]
        );
        $this->add_control(
			'skills',
			[
				'label' 		=> __( 'Skills', 'ruffer' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'title' 		=> __( 'Your Name', 'ruffer' ),
					],
				],
				'title_field' 	=> '{{{ title }}}',
			]
		);
        $this->end_controls_section();

        //-------------------------------------subtitle styling-------------------------------------//

        $this->start_controls_section(
			'style',
			[
				'label' => __( 'Style', 'ruffer' ),
				'tab' 	=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'bg_color',
			[
				'label' 		=> __( 'Bar Color', 'ruffer' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .progress-bar' => '--theme-color: {{VALUE}}!important',
                ],
			]
        );
        $this->add_control(
			'bg_color_bar',
			[
				'label' 		=> __( 'Bar BG Color', 'ruffer' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .skill-feature .progress' => '--white-color: {{VALUE}}!important',
                ],
			]
        );
        $this->end_controls_section();

        /*-----------------------------------------features styling------------------------------------*/

		$this->start_controls_section(
			'button_style_section',
			[
				'label' 	=> __( 'Title Style', 'ruffer' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
        );
		$this->add_control(
			'overview_content_color',
			[
				'label' 		=> __( 'Color', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .progress, {{WRAPPER}} .skill-feature_title'	=> '--title-color: {{VALUE}}!important;',
				],
			]
        );
        $this->add_group_control(
		Group_Control_Typography::get_type(),
		 	[
				'name' 			=> 'overview_content_typography',
		 		'label' 		=> __( 'Typography', 'appku' ),
		 		'selector' 	=> '{{WRAPPER}} .skill-feature_title',
			]
		);

        $this->add_responsive_control(
			'overview_content_margin',
			[
				'label' 		=> __( 'Margin', 'appku' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .skill-feature_title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
        );

        $this->add_responsive_control(
			'overview_content_padding',
			[
				'label' 		=> __( 'Padding', 'appku' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .skill-feature_title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
        );
        $this->end_controls_section();
	}

	protected function render() {

        $settings = $this->get_settings_for_display();

        

    	foreach( $settings['skills'] as $data ) {

    		echo '<div class="skill-feature">';
    			if(!empty($data['title'])){
                    echo '<h5 class="skill-feature_title">'.esc_html($data['title']).'</h5>';
                }
                if(!empty($data['parcetige'])){
                    echo '<div class="progress">';
                        echo '<div class="progress-bar" style="width: '.esc_attr($data['parcetige']).'%;">';
                            echo '<div class="progress-value">'.esc_attr($data['parcetige']).'%</div>';
                        echo '</div>';
                    echo '</div>';
                }
            echo '</div>';
        } 
	}
}