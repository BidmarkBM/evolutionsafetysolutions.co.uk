<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;
use \Elementor\Repeater;
use \Elementor\Group_Control_Image_Size;
/**
 *
 * Project Info Widget .
 *
 */
class Ruffer_Project_Info_Widget extends Widget_Base{

	public function get_name() {
		return 'rufferprojectinfo';
	}

	public function get_title() {
		return esc_html__( 'Ruffer Project Info', 'ruffer' );
	}

	public function get_icon() {
		return 'eicon-code';
    }

	public function get_categories() {
		return [ 'ruffer' ];
	}


	protected function register_controls() {

		$this->start_controls_section(
			'project_content',
			[
				'label'		=> esc_html__( 'Project Info','ruffer' ),
				'tab'		=> Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'heading',
			[
				'label' 	=> esc_html__( 'Heading', 'ruffer' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
                'default'  	=> esc_html__( 'Ruffer - Heading', 'ruffer' ),
			]
        );

        $this->add_control(
			'category_l',
			[
				'label' 	=> esc_html__( 'Category Label', 'ruffer' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
                'default'  	=> esc_html__( 'Category Label', 'ruffer' ),
			]
        );
        $this->add_control(
			'category',
			[
				'label' 	=> esc_html__( 'Category', 'ruffer' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
                'default'  	=> esc_html__( 'Category', 'ruffer' ),
			]
        );

        $this->add_control(
			'client_l',
			[
				'label' 	=> esc_html__( 'Client Label', 'ruffer' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
                'default'  	=> esc_html__( 'Clinet Label', 'ruffer' ),
			]
        );
        $this->add_control(
			'client',
			[
				'label' 	=> esc_html__( 'Client Name', 'ruffer' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
                'default'  	=> esc_html__( 'Client Name', 'ruffer' ),
			]
        );

        $this->add_control(
			'date_l',
			[
				'label' 	=> esc_html__( 'Date Label', 'ruffer' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
                'default'  	=> esc_html__( 'Date Label', 'ruffer' ),
			]
        );
        $this->add_control(
			'date',
			[
				'label' 	=> esc_html__( 'Date', 'ruffer' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
                'default'  	=> esc_html__( 'Date', 'ruffer' ),
			]
        );

		$this->end_controls_section();

		//-----------------------------------------Heading STYLING---------------------------------------------//

		$this->start_controls_section(
			'content_heading',
			[
				'label' 	=> esc_html__( 'Heading Styling', 'ruffer' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
        );

        $this->add_control(
			'heading_color',
			[
				'label' 		=> esc_html__( 'Heading Color', 'ruffer' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .project-information h3'=> 'color: {{VALUE}}!important;',
				],
			]
        );

        $this->add_group_control(
		Group_Control_Typography::get_type(),
		 	[
				'name' 			=> 'heading_typography',
		 		'label' 		=> esc_html__( 'Heading Typography', 'ruffer' ),
		 		'selector' 		=> '{{WRAPPER}} .project-information h3',
			]
		);

        $this->add_responsive_control(
			'heading_margin',
			[
				'label' 		=> esc_html__( 'Heading Margin', 'ruffer' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .project-information h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
        );

        $this->add_responsive_control(
			'heading_padding',
			[
				'label' 		=> esc_html__( 'Heading Padding', 'ruffer' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .project-information h3' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
        );

        $this->end_controls_section();
	}

	protected function render() {

		$settings = $this->get_settings_for_display();

    	echo '<!-----------------------Start Project Info----------------------->';


    	echo '<aside class="sidebar-area">';
            echo '<div class="widget widget_info  ">';
            	if(!empty($settings['heading'])){
	                echo '<h3 class="widget_title">'.esc_html($settings['heading']).'</h3>';
	            }
                echo '<div class="project-info-list">';
                	if(!empty($settings['client'])){
	                    echo '<div class="contact-feature">';
	                        echo '<div class="media-body">';
	                            echo '<p class="contact-feature_label">'.esc_html($settings['client_l']).'</p>';
	                            echo '<span class="contact-feature_link">'.esc_html($settings['client']).'</span>';
	                        echo '</div>';
	                    echo '</div>';
	                }
	                if(!empty($settings['category'])){
	                    echo '<div class="contact-feature">';
	                        echo '<div class="media-body">';
	                            echo '<p class="contact-feature_label">'.esc_html($settings['category_l']).'</p>';
	                            echo '<span class="contact-feature_link">'.esc_html($settings['category']).'</span>';
	                        echo '</div>';
	                    echo '</div>';
	                }
	                if(!empty($settings['date_l'])){
	                    echo '<div class="contact-feature">';
	                        echo '<div class="media-body">';
	                            echo '<p class="contact-feature_label">'.esc_html($settings['date_l']).'</p>';
	                            echo '<span class="contact-feature_link">'.esc_html($settings['date']).'</span>';
	                        echo '</div>';
	                    echo '</div>';
	                }

                echo '</div>';
            echo '</div>';
        echo '</aside>';
		echo '<!-----------------------End Project Info----------------------->';
	}
}