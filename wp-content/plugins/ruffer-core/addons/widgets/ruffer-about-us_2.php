<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Border;
use \Elementor\Utils;
use \Elementor\Repeater;
use \Elementor\Group_Control_Box_Shadow;
/**
 *
 * about us Widget .
 *
 */
class Ruffer_About_Us extends Widget_Base {

	public function get_name() {
		return 'rufferaboutus';
	}

	public function get_title() {
		return __( 'about us', 'ruffer' );
	}

	public function get_icon() {
		return 'eicon-code';
    }

	public function get_categories() {
		return [ 'ruffer' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'heading_section',
			[
				'label'		 	=> __( 'Section Heading', 'ruffer' ),
				'tab' 			=> Controls_Manager::TAB_CONTENT,
			]
        );

        $this->add_control(
			'section_title',
			[
				'label' 	=> __( 'Section Title', 'ruffer' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
                'default'  	=> __( 'Ut fermentum massa justo', 'ruffer' )
			]
        );
        $this->add_control(
			'section_subtitle',
			[
				'label' 	=> __( 'Section Subtitle', 'ruffer' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
                'default'  	=> __( 'Ut fermentum massa justo', 'ruffer' )
			]
        );
        $this->add_control(
			'section_desc',
			[
				'label' 	=> __( 'Section Description', 'ruffer' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
                'default'  	=> __( 'Ut fermentum massa justo', 'ruffer' )
			]
        );

        $this->add_control(
			'thumb',
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

        $this->end_controls_section();


        $this->start_controls_section(
			'feature_section',
			[
				'label'		 	=> __( 'Features', 'ruffer' ),
				'tab' 			=> Controls_Manager::TAB_CONTENT,
			]
        );

        $repeater = new Repeater();

        $repeater->add_control(
			'title',
			[
				'label' 	=> __( 'Title', 'ruffer' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
                'default'  	=> __( 'Ut fermentum massa justo', 'ruffer' )
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
			'features',
			[
				'label' 		=> __( 'about us', 'ruffer' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				
				'title_field' 	=> '{{{ title }}}',
			]
		);


        $this->end_controls_section();


        $this->start_controls_section(
			'skill_section',
			[
				'label'		 	=> __( 'Progressbar', 'ruffer' ),
				'tab' 			=> Controls_Manager::TAB_CONTENT,
			]
        );
        $this->add_control(
			'title',
			[
				'label' 	=> __( 'Title', 'ruffer' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
                'default'  	=> __( 'Ut fermentum massa justo', 'ruffer' )
			]
        );
        $this->add_control(
			'counter',
			[
				'label' 	=> __( 'Counter', 'ruffer' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
                'default'  	=> __( '78', 'ruffer' )
			]
        );
        $this->add_control(
			'list',
			[
				'label' 	=> __( 'Item List', 'ruffer' ),
                'type' 		=> Controls_Manager::WYSIWYG,
			]
        );

        $this->end_controls_section();

        $this->start_controls_section(
			'extra_info_section',
			[
				'label'		 	=> __( 'Extra Info', 'ruffer' ),
				'tab' 			=> Controls_Manager::TAB_CONTENT,
			]
        );

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
			'author_info',
			[
				'label' 	=> __( 'Author Info', 'ruffer' ),
                'type' 		=> Controls_Manager::WYSIWYG,
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

        echo '<div class="overflow-hidden position-relative space-bottom">';
        	if( ! empty( $settings['thumb']['url'] ) ){
		        echo '<div class="img-half about-thumb-4">';
		            echo '<img src="'.$settings['thumb']['url'].'" alt="img">';
		        echo '</div>';
		    }

	        echo '<div class="container">';
	            echo '<div class="row align-items-center justify-content-end">';
	                echo '<div class="col-lg-6">';
	                    echo '<div class="ms-xl-5">';
	                        echo '<div class="title-area mb-35">';
	                        	if( ! empty( $settings['section_title'] ) ){
		                            echo '<span class="sub-title subtitle-selector">'.esc_html( $settings['section_title'] ).'</span>';
		                        }
		                        if( ! empty( $settings['section_subtitle'] ) ){
		                            echo '<h2 class="sec-title title-selector">'.esc_html( $settings['section_subtitle'] ).'</h2>';
		                        }
	                        echo '</div>';
	                        if( ! empty( $settings['section_desc'] ) ){
		                        echo '<p class="mt-n2 mb-30 desc-selector">'.esc_html( $settings['section_desc'] ).'</p>';
		                    }
	                        echo '<div class="about-feature-wrap3 mb-40">';
	                        	foreach( $settings['features'] as $data ) {  
		                            echo '<div class="about-feature3">';
		                            	if( ! empty( $data['image']['url'] ) ){
			                                echo '<div class="icon">';
			                                    echo '<img src="'.$data['image']['url'].'" alt="Icon">';
			                                echo '</div>';
			                            }
			                            if( ! empty( $data['title'] ) ){
			                                echo '<div class="media-body">';
			                                    echo '<h3 class="about-feature_title">'.esc_html( $data['title'] ).'</h3>';
			                                echo '</div>';
			                            }
		                            echo '</div>';
		                        }
	                            
	                        echo '</div>';
	                        echo '<div class="skill-feature style3">';
	                        	if( ! empty( $settings['title'] ) ){
		                            echo '<h5 class="skill-feature_title">'.esc_html( $settings['title'] ).'</h5>';
		                            if( ! empty( $settings['counter'] ) ){
			                            echo '<div class="progress">';
			                                echo '<div class="progress-bar" style="width: '.esc_attr( $settings['counter'] ).'%; animation: 1.8s ease 0s 1 normal none running animate-positive; opacity: 1;">';
			                                    echo '<div class="progress-value">'.esc_html( $settings['counter'] ).'%</div>';
			                                echo '</div>';
			                            echo '</div>';
			                        }
		                        }
	                        echo '</div>';

	                        echo '<div class="checklist mb-45">';
	                            if( ! empty( $settings['list'] ) ){
	                            	echo wp_kses_post( $settings['list'] );
	                            }
	                        echo '</div>';
	                        echo '<div class="btn-group">';
	                        	if( ! empty( $settings['button_text'] ) ){
		                            echo '<a href="'.esc_url( $settings['button_link']['url'] ).'" class="th-btn">'.esc_html( $settings['button_text'] ).'<i class="fa-regular fa-arrow-right ms-2"></i></a>';
		                        }
		                        if( ! empty( $settings['author_info'] ) ){
		                            echo '<div class="about-profile">';
		                            	echo wp_kses_post( $settings['author_info'] );
		                            echo '</div>';
		                        }
	                        echo '</div>';
	                    echo '</div>';
	                echo '</div>';
	            echo '</div>';
	        echo '</div>';
	    echo '</div>';
	}
}