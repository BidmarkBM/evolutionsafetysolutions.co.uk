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
 * Team Widget .
 *
 */
class Ruffer_Team extends Widget_Base {

	public function get_name() {
		return 'rufferteam';
	}
	public function get_title() {
		return __( 'Ruffer Team', 'ruffer' );
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
				'label'     => __( 'Team Slider', 'ruffer' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
			]
        );

		$this->add_control(
			'team_style',
			[
				'label' 	=> __( 'Team Style', 'ruffer' ),
				'type' 		=> Controls_Manager::SELECT,
				'default' 	=> '1',
				'options' 	=> [
					'1'  		=> __( 'Style One', 'ruffer' ),
					'2'  		=> __( 'Style Two', 'ruffer' ),
					'3'  		=> __( 'Style Three', 'ruffer' ),
					'4'  		=> __( 'Style Four', 'ruffer' ),
				],
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'name', [
				'label' 		=> __( 'Name', 'ruffer' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'default' 		=> __( 'Brooklyn Simmons' , 'ruffer' ),
				'rows' 			=> 2,
				'label_block' 	=> true,
			]
        );
        $repeater->add_control(
			'profile_link',
			[
				'label' 		=> esc_html__( 'Profile Link', 'ruffer' ),
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
			'designation', [
				'label' 		=> __( 'Designation', 'ruffer' ),
				'type' 			=> Controls_Manager::TEXT,
				'default' 		=> __( 'Customer' , 'ruffer' ),
				'label_block' 	=> true,
			]
        );
        $repeater->add_control(
			'team_image',
			[
				'label' 		=> esc_html__( 'Speaker Image', 'ruffer' ),
				'type' 			=> Controls_Manager::MEDIA,
				'default' 		=> [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
        );
        $repeater->add_control(
			'fb_link',
			[
				'label' 		=> esc_html__( 'Facebook Link', 'ruffer' ),
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
			'twitter_link',
			[
				'label' 		=> esc_html__( 'Twitter Link', 'ruffer' ),
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
			'driblle_link',
			[
				'label' 		=> esc_html__( 'Dribble Link', 'ruffer' ),
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
			'linkedin_link',
			[
				'label' 		=> esc_html__( 'Linkedin Link', 'ruffer' ),
				'type' 			=> Controls_Manager::URL,
				'placeholder' 	=> esc_html__( 'https://your-link.com', 'ruffer' ),
				'show_external' => true,
			]
		);

		$this->add_control(
			'team_members',
			[
				'label' 		=> __( 'Speaker Member', 'ruffer' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'title' 		=> __( 'Your Name', 'ruffer' ),
					],
				],
				'title_field' 	=> '{{{ name }}}',
			]
		);
		
		$this->add_control(
			'bg_img',
			[
				'label' 		=> esc_html__( 'Shape Image', 'ruffer' ),
				'type' 			=> Controls_Manager::MEDIA,
				'default' 		=> [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition'		=> [ 'team_style' => [ '2', '3' ] ],
			]
        );

        $this->end_controls_section();

        //------------------------------------feature Control------------------------------------//

		$this->start_controls_section(
			'slider_control',
			[
				'label'     => __( 'Slider Control', 'ruffer' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
			]
        );
        $this->add_control(
			'make_it_slider',
			[
				'label' 		=> __( 'Use it as slider ?', 'ruffer' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Show', 'ruffer' ),
				'label_off' 	=> __( 'Hide', 'ruffer' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'yes',
			]
		);
		$this->add_control(
			'desktop_items',
			[
				'label' 		=> __( 'Items To Show', 'ruffer' ),
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
				'label' 		=> __( 'Laptop Items', 'ruffer' ),
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
				'label' 		=> __( 'Tablet Items', 'ruffer' ),
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
				'label' 		=> __( 'Mobile Items', 'ruffer' ),
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
				'label' => esc_html__( 'Name', 'ruffer' ),
			]
		);
        $this->add_control(
			'overview_title_color',
			[
				'label' 		=> __( 'Color', 'ruffer' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .th-title a'	=> 'color: {{VALUE}}!important;',
				],
			]
        );
        $this->add_group_control(
		Group_Control_Typography::get_type(),
		 	[
				'name' 			=> 'overview_title_typography',
		 		'label' 		=> __( 'Typography', 'ruffer' ),
		 		'selector' 	=> '{{WRAPPER}} .th-title a',
			]
		);

        $this->add_responsive_control(
			'overview_title_margin',
			[
				'label' 		=> __( 'Margin', 'ruffer' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .th-title a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
        );

        $this->add_responsive_control(
			'overview_title_padding',
			[
				'label' 		=> __( 'Padding', 'ruffer' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}}  .th-title a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
        );
		$this->end_controls_tab();

		//--------------------secound--------------------//

		$this->start_controls_tab(
			'style_hover_tab2',
			[
				'label' => esc_html__( 'Designation', 'ruffer' ),
			]
		);
		$this->add_control(
			'overview_content_color',
			[
				'label' 		=> __( 'Color', 'ruffer' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .team-desig'	=> 'color: {{VALUE}}!important;',
				],
			]
        );
        $this->add_group_control(
		Group_Control_Typography::get_type(),
		 	[
				'name' 			=> 'overview_content_typography',
		 		'label' 		=> __( 'Typography', 'ruffer' ),
		 		'selector' 	=> '{{WRAPPER}} .team-desig',
			]
		);

        $this->add_responsive_control(
			'overview_content_margin',
			[
				'label' 		=> __( 'Margin', 'ruffer' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .team-desig' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .team-desig' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
        );

		$this->end_controls_tab();

		//--------------------three--------------------//

		$this->start_controls_tab(
			'style_hover_tab4',
			[
				'label' => esc_html__( 'General', 'ruffer' ),
				'condition'		=> [ 'team_style' => [ '1' ] ],
			]
		);
		$this->add_control(
			'gen_clr',
			[
				'label' 		=> __( 'Color', 'ruffer' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .team-card .team-social-hover_btn'	=> '--white-color: {{VALUE}}!important;',
				],
			]
        );
       

		$this->end_controls_tab();

		$this->end_controls_tabs();
		$this->end_controls_section();

	}
	

	protected function render() {

        $settings = $this->get_settings_for_display();
   
		if( ! empty( $settings['team_members'] ) ){
			if($settings['make_it_slider'] == 'yes'){
				if( $settings['team_style'] == '2' ){
					$this->add_render_attribute( 'wrapper', 'class', 'row th-carousel arrow-style2' );
				}elseif( $settings['team_style'] == '3' ){
					$this->add_render_attribute( 'wrapper', 'class', 'row th-carousel gx-30' );
				}elseif( $settings['team_style'] == '4' ){
					$this->add_render_attribute( 'wrapper', 'class', 'row slider-shadow th-carousel team-slider1' );
				}else{
					$this->add_render_attribute( 'wrapper', 'class', ' row th-carousel' );
				}
				$this->add_render_attribute( 'wrapper', 'data-slide-show', $settings['desktop_items']['size'] );
		        $this->add_render_attribute( 'wrapper', 'data-lg-slide-show', $settings['laptop_items']['size'] );
		        $this->add_render_attribute( 'wrapper', 'data-md-slide-show', $settings['tablet_items']['size'] );
		        $this->add_render_attribute( 'wrapper', 'data-sm-slide-show', $settings['mobile_items']['size'] );	
			}else{
				$this->add_render_attribute( 'wrapper', 'class', 'row gy-30' );
			}

			echo '<div '.$this->get_render_attribute_string('wrapper').'>';
            	foreach( $settings['team_members'] as $data ) {
            		$target = $data['profile_link']['is_external'] ? ' target="_blank"' : '';
					$nofollow = $data['profile_link']['nofollow'] ? ' rel="nofollow"' : '';

					$f_target = $data['fb_link']['is_external'] ? ' target="_blank"' : '';
					$f_nofollow = $data['fb_link']['nofollow'] ? ' rel="nofollow"' : '';

					$t_target = $data['twitter_link']['is_external'] ? ' target="_blank"' : '';
					$t_nofollow = $data['twitter_link']['nofollow'] ? ' rel="nofollow"' : '';

					$i_target = $data['driblle_link']['is_external'] ? ' target="_blank"' : '';
					$i_nofollow = $data['driblle_link']['nofollow'] ? ' rel="nofollow"' : '';

					$l_target = $data['linkedin_link']['is_external'] ? ' target="_blank"' : '';
					$l_nofollow = $data['linkedin_link']['nofollow'] ? ' rel="nofollow"' : '';

					if( $settings['team_style'] == '1' ){
						echo '<div class="col-sm-6 col-lg-4 col-xl-3">';
	                        echo '<div class="th-team team-card">';
	                            echo '<div class="team-img-wrap">';
	                            	if( ! empty( $data['team_image']['url'] ) ){
		                                echo '<div class="team-thumb">';
		                                    echo '<div class="team-img">';
		                                        echo ruffer_img_tag( array(
						                            'url'       => esc_url( $data['team_image']['url'] ),
						                        ) );
		                                    echo '</div>';
		                                echo '</div>';
		                            }
	                                echo '<div class="team-social-hover">';
	                                    echo '<a href="#" class="team-social-hover_btn">';
	                                        echo '<i class="far fa-plus"></i>';
	                                    echo '</a>';
	                                    echo '<div class="team-social">';
	                                    	if( ! empty( $data['fb_link']['url']) ){
				                                echo '<a '.wp_kses_post( $f_nofollow.$f_target ).' href="'.esc_url( $data['fb_link']['url'] ).'" class="icon-bg-custom"><i class="fab fa-facebook-f"></i></a>';
				                            }
				                            if( ! empty( $data['twitter_link']['url']) ){
				                                echo '<a '.wp_kses_post( $t_nofollow.$t_target ).' href="'.esc_url( $data['twitter_link']['url'] ).'" class="icon-bg-custom"><i class="fab fa-twitter"></i></a>';
				                            }
				                            if( ! empty( $data['driblle_link']['url']) ){
				                                echo '<a '.wp_kses_post( $i_nofollow.$i_target ).' href="'.esc_url( $data['driblle_link']['url'] ).'" class="icon-bg-custom"><i class="fa-brands fa-dribbble"></i></a>';
				                            }
				                            if( ! empty( $data['linkedin_link']['url']) ){
				                                echo '<a '.wp_kses_post( $l_nofollow.$l_target ).' href="'.esc_url( $data['linkedin_link']['url'] ).'" class="icon-bg-custom"><i class="fab fa-linkedin-in"></i></a>';
				                            }
	                                    echo '</div>';
	                                echo '</div>';
	                            echo '</div>';
	                            echo '<div class="team-content">';
	                            	if( ! empty( $data['name']) ){
		                                echo '<h3 class="team-title th-title"><a '.wp_kses_post( $nofollow.$target ).' href="'.esc_url( $data['profile_link']['url'] ).'">'.esc_html($data['name']).'</a></h3>';
		                            }
		                            if( ! empty( $data['designation']) ){
		                                echo '<span class="team-desig">'.esc_html($data['designation']).'</span>';
		                            }
	                            echo '</div>';
	                        echo '</div>';
	                    echo '</div>';
			        }elseif( $settings['team_style'] == '2' ){
		                echo '<div class="col-md-6 col-lg-4 col-xl-3">';
		                    echo '<div class="team-box">';
		                    	if( ! empty( $data['team_image']['url'] ) ){
			                        echo '<div class="team-img">';
			                            echo ruffer_img_tag( array(
				                            'url'       => esc_url( $data['team_image']['url'] ),
				                        ) );
			                        echo '</div>';
			                    }
		                        echo '<div class="team-content">';
		                        	if( ! empty( $settings['bg_img']['url'] ) ){
			                            echo '<div class="bg-shape-thumb">';
			                                echo ruffer_img_tag( array(
					                            'url'       => esc_url( $settings['bg_img']['url'] ),
					                        ) );
			                            echo '</div>';
			                        }
		                            if( ! empty( $data['designation']) ){
			                            echo '<span class="team-desig">'.esc_html($data['designation']).'</span>';
			                        }
			                        if( ! empty( $data['name']) ){
			                            echo '<h3 class="box-title th-title"><a '.wp_kses_post( $nofollow.$target ).' href="'.esc_url( $data['profile_link']['url'] ).'">'.esc_html($data['name']).'</a></h3>';
			                        }
		                            echo '<div class="th-social style-white">';
		                                if( ! empty( $data['fb_link']['url']) ){
			                                echo '<a '.wp_kses_post( $f_nofollow.$f_target ).' href="'.esc_url( $data['fb_link']['url'] ).'" class="icon-bg-custom"><i class="fab fa-facebook-f"></i></a>';
			                            }
			                            if( ! empty( $data['twitter_link']['url']) ){
			                                echo '<a '.wp_kses_post( $t_nofollow.$t_target ).' href="'.esc_url( $data['twitter_link']['url'] ).'" class="icon-bg-custom"><i class="fab fa-twitter"></i></a>';
			                            }
			                            if( ! empty( $data['driblle_link']['url']) ){
			                                echo '<a '.wp_kses_post( $i_nofollow.$i_target ).' href="'.esc_url( $data['driblle_link']['url'] ).'" class="icon-bg-custom"><i class="fa-brands fa-dribbble"></i></a>';
			                            }
			                            if( ! empty( $data['linkedin_link']['url']) ){
			                                echo '<a '.wp_kses_post( $l_nofollow.$l_target ).' href="'.esc_url( $data['linkedin_link']['url'] ).'" class="icon-bg-custom"><i class="fab fa-linkedin-in"></i></a>';
			                            }
		                            echo '</div>';
		                        echo '</div>';
		                    echo '</div>';
		                echo '</div>';
			        }elseif( $settings['team_style'] == '3' ){
						echo '<div class="col-sm-6 col-lg-4 col-xl-3">';
							echo '<div class="th-team team-card style3">';
								echo '<div class="team-img-wrap">';
									echo '<div class="team-thumb">';
										echo '<div class="team-border" data-mask-src="'.esc_url( $settings['bg_img']['url'] ).'"></div>';
										echo '<div class="team-img">';
											echo ruffer_img_tag( array(
												'url'       => esc_url( $data['team_image']['url'] ),
											) );
										echo '</div>';
									echo '</div>';
									echo '<div class="team-social-hover">';
										echo '<a href="#" class="team-social-hover_btn"><i class="far fa-plus"></i></a>';
										echo '<div class="team-social">';
											if( ! empty( $data['fb_link']['url']) ){
												echo '<a '.wp_kses_post( $f_nofollow.$f_target ).' href="'.esc_url( $data['fb_link']['url'] ).'" class="icon-bg-custom"><i class="fab fa-facebook-f"></i></a>';
											}
											if( ! empty( $data['twitter_link']['url']) ){
												echo '<a '.wp_kses_post( $t_nofollow.$t_target ).' href="'.esc_url( $data['twitter_link']['url'] ).'" class="icon-bg-custom"><i class="fab fa-twitter"></i></a>';
											}
											if( ! empty( $data['driblle_link']['url']) ){
												echo '<a '.wp_kses_post( $i_nofollow.$i_target ).' href="'.esc_url( $data['driblle_link']['url'] ).'" class="icon-bg-custom"><i class="fa-brands fa-dribbble"></i></a>';
											}
											if( ! empty( $data['linkedin_link']['url']) ){
												echo '<a '.wp_kses_post( $l_nofollow.$l_target ).' href="'.esc_url( $data['linkedin_link']['url'] ).'" class="icon-bg-custom"><i class="fab fa-linkedin-in"></i></a>';
											}
										echo '</div>';
									echo '</div>';
								echo '</div>';
								echo '<div class="team-content">';
									if( ! empty( $data['name']) ){
										echo '<h3 class="team-title th-title"><a '.wp_kses_post( $nofollow.$target ).' href="'.esc_url( $data['profile_link']['url'] ).'">'.esc_html($data['name']).'</a></h3>';
									}
									if( ! empty( $data['designation']) ){
			                            echo '<span class="team-desig">'.esc_html($data['designation']).'</span>';
			                        }
								echo '</div>';
							echo '</div>';
						echo '</div>';
					}else{
						echo '<div class="col-sm-6 col-lg-4 col-xl-3">';
							echo '<div class="th-team team-card style4">';
								echo '<div class="team-img-wrap">';
									echo '<div class="team-thumb">';
										echo '<div class="team-img">';
											echo ruffer_img_tag( array(
												'url'       => esc_url( $data['team_image']['url'] ),
											) );
										echo '</div>';
									echo '</div>';
									echo '<div class="team-social-hover">';
										echo '<a href="#" class="team-social-hover_btn"><i class="far fa-plus"></i></a>';
										echo '<div class="team-social">';
											if( ! empty( $data['fb_link']['url']) ){
												echo '<a '.wp_kses_post( $f_nofollow.$f_target ).' href="'.esc_url( $data['fb_link']['url'] ).'" class="icon-bg-custom"><i class="fab fa-facebook-f"></i></a>';
											}
											if( ! empty( $data['twitter_link']['url']) ){
												echo '<a '.wp_kses_post( $t_nofollow.$t_target ).' href="'.esc_url( $data['twitter_link']['url'] ).'" class="icon-bg-custom"><i class="fab fa-twitter"></i></a>';
											}
											if( ! empty( $data['driblle_link']['url']) ){
												echo '<a '.wp_kses_post( $i_nofollow.$i_target ).' href="'.esc_url( $data['driblle_link']['url'] ).'" class="icon-bg-custom"><i class="fa-brands fa-dribbble"></i></a>';
											}
											if( ! empty( $data['linkedin_link']['url']) ){
												echo '<a '.wp_kses_post( $l_nofollow.$l_target ).' href="'.esc_url( $data['linkedin_link']['url'] ).'" class="icon-bg-custom"><i class="fab fa-linkedin-in"></i></a>';
											}
										echo '</div>';
									echo '</div>';
								echo '</div>';
								echo '<div class="team-content">';
									if( ! empty( $data['name']) ){
										echo '<h3 class="team-title th-title"><a '.wp_kses_post( $nofollow.$target ).' href="'.esc_url( $data['profile_link']['url'] ).'">'.esc_html($data['name']).'</a></h3>';
									}
									if( ! empty( $data['designation']) ){
										echo '<span class="team-desig">'.esc_html($data['designation']).'</span>';
									}
								echo '</div>';
							echo '</div>';
						echo '</div>';
					}
		        }
	        echo '</div>';
		}
	}
}