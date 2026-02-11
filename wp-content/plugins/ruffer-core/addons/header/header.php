<?php

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
/**
 *
 * Header Widget .
 *
 */
class Ruffer_Header extends Widget_Base {

	public function get_name() {
		return 'rufferheader';
	}
	public function get_title() {
		return __( 'Header', 'ruffer' );
	}

	public function get_icon() {
		return 'eicon-code';
    }

	public function get_categories() {
		return [ 'ruffer_header_elements' ];
	}
	protected function register_controls() {

		$this->start_controls_section(
			'header_section',
			[
				'label' 	=> __( 'Header', 'ruffer' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );
        $this->add_control(
			'header_style',
			[
				'label' 		=> __( 'Header Style', 'ruffer' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> '1',
				'options' 		=> [
					'1'  		=> __( 'Style One', 'ruffer' ),
					'2' 		=> __( 'Style Two', 'ruffer' ),
					'3' 		=> __( 'Style Three', 'ruffer' ),
					'4' 		=> __( 'Style Four', 'ruffer' ),
					'5' 		=> __( 'Style Five', 'ruffer' ),
				],
			]
		);

		$this->add_control(
			'show_topbar',
			[
				'label' 		=> __( 'Show Topbar ?', 'ruffer' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Show', 'ruffer' ),
				'label_off' 	=> __( 'Hide', 'ruffer' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'yes',
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'social_icon',
			[
				'label' 	=> __( 'Social Icon', 'ruffer' ),
				'type' 		=> Controls_Manager::ICONS,
				'default' 	=> [
					'value' 	=> 'fab fa-facebook-f',
					'library' 	=> 'solid',
				],
			]
		);

		$repeater->add_control(
			'icon_link',
			[
				'label' 		=> __( 'Link', 'ruffer' ),
				'type' 			=> Controls_Manager::URL,
				'placeholder' 	=> __( 'https://your-link.com', 'ruffer' ),
				'show_external' => true,
				'default' 		=> [
					'url' 			=> '#',
					'is_external' 	=> true,
					'nofollow' 		=> true,
				],
			]
		);

		$this->add_control(

			'social_icon_list',
			[
				'label' 		=> __( 'Social Icon', 'ruffer' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'social_icon' => __( 'Add Social Icon','ruffer' ),
					],
				],
				'condition'		=> [ 'show_topbar' => [ 'yes' ] ],
			]
		);
		$this->add_control(
			'show_lang',
			[
				'label' 		=> __( 'Show Language ?', 'ruffer' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Show', 'ruffer' ),
				'label_off' 	=> __( 'Hide', 'ruffer' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'yes',
				'condition'		=> [ 'show_topbar' => [ 'yes' ] ],
			]
		);
		$this->add_control(
			'topbar_phone_icon',
			[
				'label' 		=> __( 'Phone Icon', 'ruffer' ),
				'type' 			=> Controls_Manager::TEXT,
				'label_block' => true,
				'condition'		=> [ 'show_topbar' => [ 'yes' ] ],
			]
		);	
		$this->add_control(
			'topbar_phone_label',
			[
				'label' 		=> __( 'Phone Label', 'ruffer' ),
				'type' 			=> Controls_Manager::TEXT,
				'label_block' => true,
				'condition'		=> [ 'show_topbar' => [ 'yes' ] ],
			]
		);			
		$this->add_control(
			'topbar_phone',
			[
				'label' 		=> __( 'Phone', 'ruffer' ),
				'type' 			=> Controls_Manager::TEXT,
				'label_block' => true,
				'condition'		=> [ 'show_topbar' => [ 'yes' ] ],
			]
		);		
		$this->add_control(
			'topbar_email_icon',
			[
				'label' 		=> __( 'Email Icon', 'ruffer' ),
				'type' 			=> Controls_Manager::TEXT,
				'label_block' => true,
				'condition'		=> [ 'show_topbar' => [ 'yes' ] ],
			]
		);		
		$this->add_control(
			'topbar_email',
			[
				'label' 		=> __( 'Email', 'ruffer' ),
				'type' 			=> Controls_Manager::TEXT,
				'label_block' => true,
				'condition'		=> [ 'show_topbar' => [ 'yes' ] ],
			]
		);
		$this->add_control(
			'topbar_email_label',
			[
				'label' 		=> __( 'Email Label', 'ruffer' ),
				'type' 			=> Controls_Manager::TEXT,
				'label_block' => true,
				'condition'		=> [ 'show_topbar' => [ 'yes' ] ],
			]
		);

		$this->add_control(
			'topbar_location_icon',
			[
				'label' 		=> __( 'Location Icon', 'ruffer' ),
				'type' 			=> Controls_Manager::TEXT,
				'label_block' => true,
				'condition'		=> [ 'show_topbar' => [ 'yes' ] ],
			]
		);		
		$this->add_control(
			'topbar_location',
			[
				'label' 		=> __( 'Location', 'ruffer' ),
				'type' 			=> Controls_Manager::TEXT,
				'label_block' => true,
				'condition'		=> [ 'show_topbar' => [ 'yes' ] ],
			]
		);
		$this->add_control(
			'topbar_location_map',
			[
				'label' 		=> __( 'Location Map', 'ruffer' ),
				'type' 			=> Controls_Manager::TEXT,
				'label_block' => true,
				'condition'		=> [ 'show_topbar' => [ 'yes' ] ],
			]
		);
		$this->add_control(
			'topbar_location_label',
			[
				'label' 		=> __( 'Location Label', 'ruffer' ),
				'type' 			=> Controls_Manager::TEXT,
				'label_block' => true,
				'condition'		=> [ 'show_topbar' => [ 'yes' ] ],
				
			]
		);

		//----------------------------maim menu control----------------------------//

		$this->add_control(

			'logo_image',

			[
				'label' 		=> __( 'Upload Logo', 'ruffer' ),
				'type' 			=> Controls_Manager::MEDIA,
				'default' 		=> [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
		
		$this->add_control(
			'show_search_btn',
			[
				'label' 		=> __( 'Show Search ?', 'ruffer' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Show', 'ruffer' ),
				'label_off' 	=> __( 'Hide', 'ruffer' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'yes',
			]
		);
		$this->add_control(
			'show_cart_btn',
			[
				'label' 		=> __( 'Show Cart ?', 'ruffer' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Show', 'ruffer' ),
				'label_off' 	=> __( 'Hide', 'ruffer' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'yes',
			]
		);
		$this->add_control(
			'button_text',
			[
				'label' 		=> __( 'Button Text', 'ruffer' ),
				'type' 			=> Controls_Manager::TEXT,
			]
		);
		$this->add_control(
			'button_url',
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

		$menus = $this->ruffer_menu_select();

		if( !empty( $menus ) ){
	        $this->add_control(
				'ruffer_menu_select',
				[
					'label'     	=> __( 'Select Taxseco Menu', 'ruffer' ),
					'type'      	=> Controls_Manager::SELECT,
					'options'   	=> $menus,
					'description' 	=> sprintf( __( 'Go to the <a href="%s" target="_blank">Menus screen</a> to manage your menus.', 'ruffer' ), admin_url( 'nav-menus.php' ) ),
				]
			);
		}else {
			$this->add_control(
				'no_menu',
				[
					'type' 				=> Controls_Manager::RAW_HTML,
					'raw' 				=> '<strong>' . __( 'There are no menus in your site.', 'ruffer' ) . '</strong><br>' . sprintf( __( 'Go to the <a href="%s" target="_blank">Menus screen</a> to create one.', 'ruffer' ), admin_url( 'nav-menus.php?action=edit&menu=0' ) ),
					'separator' 		=> 'after',
					'content_classes' 	=> 'elementor-panel-alert elementor-panel-alert-info',
				]
			);
		}

        $this->end_controls_section();
       
        //-----------------------------------General Styling-------------------------------------//
         $this->start_controls_section(
			'general_styling',
			[
				'label'     => __( 'General Styling', 'ruffer' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'header_style' => '3'
				]
			]
        );

        $this->add_control(
			'general_bg_color',
			[
				'label' 		=> __( 'Topbar Background Color', 'ruffer' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .header-top' => 'background-color: {{VALUE}} !important;',
                ]
			]
        );        
        $this->add_control(
			'general_shape_color',
			[
				'label' 		=> __( 'Topbar Shape Color', 'ruffer' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .header-top:before' => 'background-color: {{VALUE}} !important;',
                ]
			]
        );       
        $this->add_control(
			'general_menu_color',
			[
				'label' 		=> __( 'Menu Background Color', 'ruffer' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .menu-area' => 'background-color: {{VALUE}} !important;',
                ]
			]
        );
        $this->add_control(
			'general_logo_color',
			[
				'label' 		=> __( 'Logo Background Color', 'ruffer' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .logo-style3:before' => 'background-color: {{VALUE}} !important;',
                ]
			]
        );


          $this->end_controls_section();

            //-----------------------------------General Styling-------------------------------------//
         $this->start_controls_section(
			'content_styling',
			[
				'label'     => __( 'Content Styling', 'ruffer' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'header_style' => '3'
				]
			]
        );

        $this->add_control(
			'content_icon_color',
			[
				'label' 		=> __( 'Content Icon Color', 'ruffer' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .header-links li > i' => 'color: {{VALUE}} !important;',
                ]
			]
        );        
        $this->add_control(
			'content_color',
			[
				'label' 		=> __( 'Content Color', 'ruffer' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .header-top a' => 'color: {{VALUE}} !important;',
                ]
			]
        );         
        $this->add_control(
			'content_hover_color',
			[
				'label' 		=> __( 'Content Hover Color', 'ruffer' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .header-top a:hover' => 'color: {{VALUE}} !important;',
                ]
			]
        );    
        $this->add_control(
			'social_color',
			[
				'label' 		=> __( 'Social Color', 'ruffer' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .header-links .header-social i' => 'color: {{VALUE}} !important;',
                ]
			]
        );         
        $this->add_control(
			'social_hover_color',
			[
				'label' 		=> __( 'Social Hover Color', 'ruffer' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .header-social i:hover' => 'color: {{VALUE}} !important;',
                ]
			]
        );    

          $this->end_controls_section();


        //-----------------------------------Menubar Styling-------------------------------------//
        $this->start_controls_section(
			'menubar_styling',
			[
				'label'     => __( 'Menubar Styling', 'ruffer' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
        );

        $this->add_control(
			'top_level_menu_bg_color',
			[
				'label' 		=> __( 'Menu Background Color', 'ruffer' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .main-menu' => 'background-color: {{VALUE}} !important;',
                ]
			]
        );
        $this->add_control(
			'top_level_menu_txt_color',
			[
				'label' 			=> __( 'Menu Text Color', 'ruffer' ),
				'type' 				=> Controls_Manager::COLOR,
				'selectors' 		=> [
					'{{WRAPPER}} .main-menu ul > li > a' => 'color: {{VALUE}} !important;',
                ]
			]
        );
        $this->add_control(
			'top_level_menu_hover_color',
			[
				'label' 			=> __( 'Menu Hover Color', 'ruffer' ),
				'type' 				=> Controls_Manager::COLOR,
				'selectors' 		=> [
					'{{WRAPPER}} .main-menu > ul > li > a:hover' => 'background-color: {{VALUE}} !important;',
                ]
			]
        );
        $this->add_control(
			'top_level_menu_hover_txt_color',
			[
				'label' 			=> __( 'Menu Hover Text Color', 'ruffer' ),
				'type' 				=> Controls_Manager::COLOR,
				'selectors' 		=> [
					'{{WRAPPER}} .main-menu ul > li > a:hover' => 'color: {{VALUE}} !important;',
                ]
			]
        );
        $this->add_control(
			'top_level_menu_hover_bottom_color',
			[
				'label' 			=> __( 'Menu Bottom Hover Color', 'ruffer' ),
				'type' 				=> Controls_Manager::COLOR,
				'selectors' 		=> [
					'{{WRAPPER}} .menu-style1 > ul > li > a::before' => 'background-color: {{VALUE}} !important;',
                ]
			]
        );

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'top_level_menu_typography',
				'label' 		=> __( 'Menu Typography', 'ruffer' ),
                'selector' 		=> '{{WRAPPER}} .main-menu ul > li > a',
			]
		);

        $this->add_responsive_control(
			'top_level_menu_margin',
			[
				'label' 		=> __( 'Menu Margin', 'ruffer' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .main-menu ul > li > a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ]
			]
        );

        $this->add_responsive_control(
			'top_level_menu_padding',
			[
				'label' 		=> __( 'Menu Padding', 'ruffer' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .main-menu ul > li > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ]
			]
		);

		$this->add_control(
			'top_level_menu_height',
			[
				'label' 		=> __( 'Height', 'ruffer' ),
				'type' 			=> Controls_Manager::SLIDER,
				'size_units' 	=> [ 'px' ],
				'range' 	=> [
					'px' 	=> [
						'min' 	=> 0,
						'step' 	=> 1,
						'max'	=> 500
					],
				],
				'selectors' => [
					'{{WRAPPER}} .main-menu ul > li > a' => 'height: {{SIZE}}{{UNIT}} !important;line-height: {{SIZE}}{{UNIT}} !important;'
                ]
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

    public function ruffer_menu_select(){
	    $ruffer_menu = wp_get_nav_menus();
	    $menu_array  = array();
		$menu_array[''] = __( 'Select A Menu', 'ruffer' );
	    foreach( $ruffer_menu as $menu ){
	        $menu_array[ $menu->slug ] = $menu->name;
	    }
	    return $menu_array;
	}




	protected function render() {

        $settings = $this->get_settings_for_display();


        $ruffer_avaiable_menu   = $this->ruffer_menu_select();

		if( ! $ruffer_avaiable_menu ){
			return;
		}

		$args = [
			'menu' 			=> $settings['ruffer_menu_select'],
			'menu_class' 	=> 'ruffer-menu',
			'container' 	=> '',
		];


	    echo '<!--=========================Mobile Menu========================= -->';
	    echo ruffer_mobile_menu();

	    echo ruffer_search_box();

        $phone      = $settings['topbar_phone'];
        $email      = $settings['topbar_email'];

        $replace        = array(' ','-',' - ');
        $with           = array('','','');

        $phoneurl       = str_replace( $replace, $with, $phone );
        $eamilurl       = str_replace( $replace, $with, $email );

        if( class_exists( 'woocommerce' ) ){
    		global $woocommerce;
            if( ! empty( $woocommerce->cart->cart_contents_count ) ){
              $count = $woocommerce->cart->cart_contents_count;
            }else{
              $count = "0";
            } 

            if( $count > 0 ){
	            //Cart sidebar box
				ruffer_cart_box();
	        }
    	}

		// Header sub-menu icon
		if( class_exists( 'ReduxFramework' ) ){ 
			if(ruffer_opt('ruffer_header_sticky')){
				$sticky = 'yes';
			}else{
				$sticky = '';
			}

			if(ruffer_opt('ruffer_menu_icon')){
				$menu_icon = '';
			}else{
				$menu_icon = 'hide-icon';
			}
		}


    	if($settings['header_style'] == 1 ){
    		echo '<div class="th-header header-layout2">';
    			if( $settings['show_topbar'] == 'yes' ){
			        echo '<div class="header-top">';
			            echo '<div class="container th-container">';
			                echo '<div class="row justify-content-center justify-content-md-between align-items-center gy-2">';
			                    echo '<div class="col-auto">';
			                        echo '<div class="header-links d-none d-md-block">';
			                            echo '<ul>';
			                            	if(!empty($phone )){
				                                echo '<li><i class="far fa-phone"></i><a href="'.esc_attr( 'tel:'.$phoneurl ).'">'.esc_html($phone).'</a></li>';
				                            }
				                            if(!empty($email )){
				                                echo '<li><i class="far fa-envelope"></i><a href="'.esc_attr( 'mailto:'.$email ).'">'.esc_html($email).'</a></li>';
				                            }
			                            echo '</ul>';
			                        echo '</div>';
			                    echo '</div>';
			                    echo '<div class="col-auto">';
			                        echo '<div class="header-links">';
			                            echo '<ul>';
			                            	if( $settings['show_lang'] == 'yes' ){
		                                        echo '<li class="d-none d-lg-inline-block">';
		                                            echo '<div class="dropdown-link">';
		                                                echo '<a class="dropdown-toggle" href="'.esc_url('#').'" role="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false">'.esc_html__('Language', 'ruffer').'</a>';
		                                                echo '<ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">';
		                                                    echo '<li>';
		                                                        echo do_shortcode('[gtranslate]');
		                                                    echo '</li>';
		                                                echo '</ul>';
		                                            echo '</div>';
		                                        echo '</li>';
		                                    }
		                                    if( ! empty( $settings['social_icon_list'] ) ){
				                                echo '<li>';
				                                    echo '<div class="social-links">';
				                                        foreach( $settings['social_icon_list'] as $social_icon ){
								                          	$social_target    = $social_icon['icon_link']['is_external'] ? ' target="_blank"' : '';
								                          	$social_nofollow  = $social_icon['icon_link']['nofollow'] ? ' rel="nofollow"' : '';

								                            echo '<a '.wp_kses_post( $social_target.$social_nofollow ).' href="'.esc_url( $social_icon['icon_link']['url'] ).'">';

								                            \Elementor\Icons_Manager::render_icon( $social_icon['social_icon'], [ 'aria-hidden' => 'true' ] );

								                          	echo '</a> ';
								                      	} 
				                                    echo '</div>';
				                                echo '</li>';
				                            }
			                            echo '</ul>';
			                        echo '</div>';
			                    echo '</div>';
			                echo '</div>';
			            echo '</div>';
			        echo '</div>';
			    }
		        echo '<div class="sticky-wrapper '.esc_attr($sticky).'">';
		            echo '<!-- Main Menu Area -->';
		           echo ' <div class="container th-container">';
		                echo '<div class="menu-area">';
		                    echo '<div class="row align-items-center justify-content-between">';
		                    	if( ! empty( $settings['logo_image']['url'] ) ){
		                    		echo '<div class="col-auto">';
			                            echo '<div class="header-logo">';
			                                echo '<a href="'.esc_url( home_url( '/' ) ).'"><img src="'.esc_url( $settings['logo_image']['url'] ).'" alt="Ruffer"></a>';
			                            echo '</div>';
		                            echo '</div>';
		                        }
		                        echo '<div class="col-auto">';
		                            echo '<nav class="main-menu d-none d-lg-inline-block '.esc_attr($menu_icon).'">';
		                              	if( ! empty( $settings['ruffer_menu_select'] ) ){
											wp_nav_menu( $args );
										}  
		                            echo '</nav>';
		                        echo '</div>';
		                        echo '<div class="col-auto">';
		                            echo '<div class="header-button">';
		                            	if( $settings['show_search_btn'] == 'yes' ){
			                                echo '<button type="button" class="simple-icon d-none d-md-block searchBoxToggler"><i class="far fa-search"></i></button>';
			                            }
			                            if( $settings['show_cart_btn'] == 'yes' ){
			                                echo '<button type="button" class="simple-icon sideMenuToggler">';
			                                    echo '<i class="far fa-shopping-cart"></i>';
			                                    echo '<span class="badge">'.esc_html($count).'</span>';
			                                echo '</button>';
			                            }
			                            if(!empty($settings['button_text'])){
			                               echo '<a href="'.esc_url( $settings['button_url']['url'] ).'" class="th-btn style2">'.esc_html($settings['button_text']).'<i class="fas fa-arrow-right ms-2"></i></a>';     
			                            }
										echo '<button type="button" class="th-menu-toggle d-inline-block d-lg-none"><i class="far fa-bars"></i></button>';
		                            echo '</div>';
		                        echo '</div>';
		                    echo '</div>';
		                echo '</div>';
		            echo '</div>';
		        echo '</div>';
		    echo '</div>';

		}elseif($settings['header_style'] == 2 ){
			echo '<div class="th-header header-layout3">';
		        echo '<div class="container th-container3">';
		        	if( $settings['show_topbar'] == 'yes' ){
			            echo '<div class="header-top">';
			                echo '<div class="row justify-content-between align-items-center">';
			                    echo '<div class="col-auto d-xxl-block d-none">';
			                        echo '<div class="header-links">';
			                            echo '<ul>';
			                                if( ! empty( $settings['social_icon_list'] ) ){
				                                echo '<li>';
				                                    echo '<div class="th-social">';
				                                        foreach( $settings['social_icon_list'] as $social_icon ){
								                          	$social_target    = $social_icon['icon_link']['is_external'] ? ' target="_blank"' : '';
								                          	$social_nofollow  = $social_icon['icon_link']['nofollow'] ? ' rel="nofollow"' : '';

								                            echo '<a '.wp_kses_post( $social_target.$social_nofollow ).' href="'.esc_url( $social_icon['icon_link']['url'] ).'">';

								                            \Elementor\Icons_Manager::render_icon( $social_icon['social_icon'], [ 'aria-hidden' => 'true' ] );

								                          	echo '</a> ';
								                      	} 
				                                    echo '</div>';
				                                echo '</li>';
				                            }
			                            echo '</ul>';
			                        echo '</div>';
			                    echo '</div>';
			                    echo '<div class="col-auto">';
			                        echo '<div class="header-links">';
			                            echo '<ul>';

			                            	if(!empty($phone )){
				                                echo '<li>';
				                                    echo '<span class="header-info">';
				                                        echo '<span class="icon">'.wp_kses_post( $settings['topbar_phone_icon'] ).'</span>';
				                                        echo '<span class="details">';
				                                            echo '<span class="header-info-title d-block">'.esc_html( $settings['topbar_phone_label'] ).'</span>';
				                                            echo '<a class="header-info-link" href="'.esc_attr( 'tel:'.$phoneurl ).'">'.esc_html($phone).'</a>';
				                                        echo '</span>';
				                                    echo '</span>';
				                                echo '</li>';
				                            }

				                            if(!empty($email )){
				                                echo '<li>';
				                                    echo '<span class="header-info">';
				                                        echo '<span class="icon">'.wp_kses_post( $settings['topbar_email_icon'] ).'</span>';
				                                        echo '<span class="details">';
				                                            echo '<span class="header-info-title d-block">'.esc_html( $settings['topbar_email_label'] ).'</span>';
				                                            echo '<a class="header-info-link" href="'.esc_attr( 'mailto:'.$email ).'">'.esc_html($email).'</a>';
				                                        echo '</span>';
				                                    echo '</span>';
				                                echo '</li>';
				                            }
				                            if(!empty($settings['topbar_location_label'] )){
				                                echo '<li>';
				                                    echo '<span class="header-info">';
				                                        echo '<span class="icon">'.wp_kses_post( $settings['topbar_location_icon'] ).'</span>';
				                                        echo '<span class="details">';
				                                            echo '<span class="header-info-title d-block">'.esc_html( $settings['topbar_location_label'] ).'</span>';
				                                            echo '<a class="header-info-link" href="'.esc_url( $settings['topbar_location_map'] ).'">'.esc_html( $settings['topbar_location'] ).'</a>';
				                                        echo '</span>';
				                                    echo '</span>';
				                                echo '</li>';
				                            }
			                            echo '</ul>';
			                        echo '</div>';
			                    echo '</div>';
			                echo '</div>';
			            echo '</div>';
			        }
		        echo '</div>';
		        echo '<div class="sticky-wrapper '.esc_attr($sticky).'">';
		            echo '<!-- Main Menu Area -->';
		            echo '<div class="container th-container3">';
		                echo '<div class="menu-area">';
		                    echo '<div class="menu-area-left">';
		                        echo '<div class="row align-items-center justify-content-between">';
		                        	if( ! empty( $settings['logo_image']['url'] ) ){
			                            echo '<div class="col-auto">';
			                                echo '<div class="header-logo">';
			                                    echo '<a href="'.esc_url( home_url( '/' ) ).'">';
			                                        echo '<img src="'.esc_url( $settings['logo_image']['url'] ).'" alt="Ruffer">';
			                                    echo '</a>';
			                                echo '</div>';
			                            echo '</div>';
			                        }
		                            echo '<div class="col-auto">';
		                                echo '<nav class="main-menu d-none d-lg-inline-block '.esc_attr($menu_icon).'">';
		                                    if( ! empty( $settings['ruffer_menu_select'] ) ){
												wp_nav_menu( $args );
											} 
		                                echo '</nav>';
		                            echo '</div>';
		                            echo '<div class="col-auto">';
		                                echo '<div class="header-button">';
		                                	if( $settings['show_search_btn'] == 'yes' ){
			                                    echo '<button type="button" class="simple-icon d-none d-md-block searchBoxToggler"><i class="far fa-search"></i></button>';
			                                }
			                                if( $settings['show_cart_btn'] == 'yes' ){
			                                    echo '<button type="button" class="simple-icon sideMenuToggler">';
			                                        echo '<i class="far fa-shopping-cart"></i>';
			                                        echo '<span class="badge">'.esc_html($count).'</span>';
			                                    echo '</button>';
			                                }
											echo '<button type="button" class="th-menu-toggle d-inline-block d-lg-none"><i class="far fa-bars"></i></button>';
		                                echo '</div>';
		                            echo '</div>';
		                        echo '</div>';
		                    echo '</div>';
		                    if(!empty($settings['button_text'])){
			                    echo '<a href="'.esc_url( $settings['button_url']['url'] ).'" class="header-btn th-btn style3">'.esc_html($settings['button_text']).'<i class="fas fa-arrow-right ms-2"></i></a>';
			                }
		                    echo '<div class="logo-bg" data-bg-src="'.RUFFER_PLUGDIRURI . 'assets/img/logo3-bg.png"></div>';
		                echo '</div>';
		            echo '</div>';
		        echo '</div>';
		    echo '</div>';	

		}elseif($settings['header_style'] == 3 ){
			echo '<div class="th-header header-layout4">'; 
		        echo '<div class="sticky-wrapper '.esc_attr($sticky).'">';
		        	if( $settings['show_topbar'] == 'yes' ){
			            echo '<div class="header-top">';
			                echo '<div class="container th-container">';
			                    echo '<div class="row justify-content-center justify-content-lg-between align-items-center gy-2">';
			                        echo '<div class="col-auto">';
			                            echo '<div class="header-links d-none d-md-block">';
			                                echo '<ul>';
			                                	if(!empty($phone )){
					                                echo '<li><i class="far fa-phone"></i><a href="'.esc_attr( 'tel:'.$phoneurl ).'">'.esc_html($phone).'</a></li>';
					                            }
					                            if(!empty($email )){
					                                echo '<li><i class="far fa-envelope"></i><a href="'.esc_attr( 'mailto:'.$email ).'">'.esc_html($email).'</a></li>';
					                            }
			                                echo '</ul>';
			                            echo '</div>';
			                        echo '</div>';
			                        echo '<div class="col-auto">';
			                            echo '<div class="header-links">';
			                                echo '<ul>';

			                                	if( $settings['show_lang'] == 'yes' ){
			                                        echo '<li class="d-none d-lg-inline-block">';
			                                            echo '<div class="dropdown-link">';
			                                                echo '<a class="dropdown-toggle" href="'.esc_url('#').'" role="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false">'.esc_html__('Language', 'ruffer').'</a>';
			                                                echo '<ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">';
			                                                    echo '<li>';
			                                                        echo do_shortcode('[gtranslate]');
			                                                    echo '</li>';
			                                                echo '</ul>';
			                                            echo '</div>';
			                                        echo '</li>';
			                                    }
			                                    if( ! empty( $settings['social_icon_list'] ) ){
				                                    echo '<li>';
				                                        echo '<div class="social-links">';
				                                            foreach( $settings['social_icon_list'] as $social_icon ){
									                          	$social_target    = $social_icon['icon_link']['is_external'] ? ' target="_blank"' : '';
									                          	$social_nofollow  = $social_icon['icon_link']['nofollow'] ? ' rel="nofollow"' : '';

									                            echo '<a '.wp_kses_post( $social_target.$social_nofollow ).' href="'.esc_url( $social_icon['icon_link']['url'] ).'">';

									                            \Elementor\Icons_Manager::render_icon( $social_icon['social_icon'], [ 'aria-hidden' => 'true' ] );

									                          	echo '</a> ';
									                      	} 
				                                        echo '</div>';
				                                    echo '</li>';
				                                }
			                                echo '</ul>';
			                            echo '</div>';
			                        echo '</div>';
			                    echo '</div>';
			                echo '</div>';
			            echo '</div>';
			        }

		            echo '<!-- Main Menu Area -->';
		            echo '<div class="menu-area">';
		                echo '<div class="container th-container">';
		                    echo '<div class="row align-items-center justify-content-between">';
		                    	if( ! empty( $settings['logo_image']['url'] ) ){
			                        echo '<div class="col-auto">';
			                            echo '<div class="header-logo">';
			                                echo '<a href="'.esc_url( home_url( '/' ) ).'"><img src="'.esc_url( $settings['logo_image']['url'] ).'" alt="Ruffer"></a>';
			                            echo '</div>';
			                        echo '</div>';
			                    }
		                        echo '<div class="col-auto">';
		                            echo '<nav class="main-menu d-none d-lg-inline-block '.esc_attr($menu_icon).'">';
		                            	if( ! empty( $settings['ruffer_menu_select'] ) ){
											wp_nav_menu( $args );
										} 
		                            echo '</nav>';
		                        echo '</div>';
		                        echo '<div class="col-auto">';
		                            echo '<div class="header-button">';
		                            	if( $settings['show_search_btn'] == 'yes' ){
			                                echo '<button type="button" class="simple-icon d-none d-md-block searchBoxToggler"><i class="far fa-search"></i></button>';
			                            }
		                                if( $settings['show_cart_btn'] == 'yes' ){
			                                echo '<button type="button" class="simple-icon sideMenuToggler">';
			                                    echo '<i class="far fa-shopping-cart"></i>';
			                                    echo '<span class="badge">'.esc_html($count).'</span>';
			                                echo '</button>';
			                            }
			                            if(!empty($settings['button_text'])){
			                               echo '<a href="'.esc_url( $settings['button_url']['url'] ).'" class="th-btn">'.esc_html($settings['button_text']).'<i class="fas fa-arrow-right ms-2"></i></a>';     
			                            }
										echo '<button type="button" class="th-menu-toggle d-block d-lg-none"><i class="far fa-bars"></i></button>';
		                            echo '</div>';
		                        echo '</div>';
		                    echo '</div>';
		                echo '</div>';
		            echo '</div>';
		            echo '<div class="logo-bg"></div>';
		        echo '</div>';
		    echo '</div>';

		}elseif($settings['header_style'] == 4 ){
			echo '<div class="th-header header-layout5">';
				if( $settings['show_topbar'] == 'yes' ){
					echo '<div class="header-top d-none d-xl-block">';
						echo '<div class="container-fluid">';
							echo '<div class="row justify-content-center justify-content-lg-between align-items-center gy-2">';
								echo '<div class="col-auto">';
									echo '<div class="header-links">';
										echo '<ul>';
											if(!empty($phone )){
												echo '<li><i class="far fa-phone"></i><a href="'.esc_attr( 'tel:'.$phoneurl ).'">'.esc_html($phone).'</a></li>';
											}
											if(!empty($email )){
												echo '<li><i class="far fa-envelope"></i><a href="'.esc_attr( 'mailto:'.$email ).'">'.esc_html($email).'</a></li>';
											}
										echo '</ul>';
									echo '</div>';
								echo '</div>';
								echo '<div class="col-auto d-none d-xl-block">';
									echo '<div class="header-links">';
										echo '<ul>';
											if( $settings['show_lang'] == 'yes' ){
												echo '<li class="d-none d-lg-inline-block">';
													echo '<div class="dropdown-link">';
														echo '<a class="dropdown-toggle" href="'.esc_url('#').'" role="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false">'.esc_html__('Language', 'ruffer').'</a>';
														echo '<ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">';
															echo '<li>';
																echo do_shortcode('[gtranslate]');
															echo '</li>';
														echo '</ul>';
													echo '</div>';
												echo '</li>';
											}
											if( ! empty( $settings['social_icon_list'] ) ){
												echo '<li>';
													echo '<div class="social-links">';
														foreach( $settings['social_icon_list'] as $social_icon ){
															$social_target    = $social_icon['icon_link']['is_external'] ? ' target="_blank"' : '';
															$social_nofollow  = $social_icon['icon_link']['nofollow'] ? ' rel="nofollow"' : '';

															echo '<a '.wp_kses_post( $social_target.$social_nofollow ).' href="'.esc_url( $social_icon['icon_link']['url'] ).'">';

															\Elementor\Icons_Manager::render_icon( $social_icon['social_icon'], [ 'aria-hidden' => 'true' ] );

															echo '</a> ';
														}  
													echo '</div>';
												echo '</li>';
											}
										echo '</ul>';
									echo '</div>';
								echo '</div>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				}
		        echo '<div class="sticky-wrapper '.esc_attr($sticky).'">';
		            echo '<!-- Main Menu Area -->';
		            echo '<div class="menu-area">';
		                echo '<div class="container-fluid">';
		                    echo '<div class="row align-items-center justify-content-lg-start justify-content-between">';
		                    	if( ! empty( $settings['logo_image']['url'] ) ){
			                        echo '<div class="col-auto">';
			                            echo '<div class="header-logo">';
			                                echo '<a href="'.esc_url( home_url( '/' ) ).'"><img src="'.esc_url( $settings['logo_image']['url'] ).'" alt="Ruffer"></a>';
			                            echo '</div>';
			                        echo '</div>';
			                    }

		                        echo '<div class="col-auto d-none d-xl-inline-block">';
		                            echo '<nav class="main-menu '.esc_attr($menu_icon).'">';
		                                if( ! empty( $settings['ruffer_menu_select'] ) ){
											wp_nav_menu( $args );
										} 
		                            echo '</nav>';
		                        echo '</div>';
		                        echo '<div class="col-auto ms-auto">';
		                            echo '<div class="header-button">';
		                            	if( $settings['show_search_btn'] == 'yes' ){
			                                echo '<button type="button" class="simple-icon d-none d-md-block searchBoxToggler"><i class="far fa-search"></i></button>';
			                            }
		                                if( $settings['show_cart_btn'] == 'yes' ){
			                                echo '<button type="button" class="simple-icon sideMenuToggler">';
			                                    echo '<i class="far fa-shopping-cart"></i>';
			                                    echo '<span class="badge">'.esc_html($count).'</span>';
			                                echo '</button>';
			                            }
			                            if(!empty($settings['button_text'])){
			                               echo '<a href="'.esc_url( $settings['button_url']['url'] ).'" class="th-btn style3">'.esc_html($settings['button_text']).'<i class="fas fa-arrow-right ms-2"></i></a>';     
			                            }
										echo '<button type="button" class="th-menu-toggle d-block d-xl-none"><i class="far fa-bars"></i></button>';
		                            echo '</div>';
		                        echo '</div>';
		                   echo ' </div>';
		                echo '</div>';
		            echo '</div>';
		        echo '</div>';
		    echo '</div>';

		}else{
			echo '<div class="th-header header-layout6">';
				if( $settings['show_topbar'] == 'yes' ){
					echo '<div class="header-top d-xl-block d-none">';
						echo '<div class="container th-container">';
							echo '<div class="row justify-content-center justify-content-lg-between align-items-center gy-2">';
								echo '<div class="col-auto">';
									echo '<div class="header-links">';
										echo '<ul>';
											if(!empty($phone )){
												echo '<li><i class="far fa-phone"></i><a href="'.esc_attr( 'tel:'.$phoneurl ).'">'.esc_html($phone).'</a></li>';
											}
											echo '<li class="d-xxl-block d-none"><i class="far fa-location-dot"></i><a href="'.esc_url( $settings['topbar_location_map'] ).'">'.esc_html( $settings['topbar_location'] ).'</a></li>';
											if(!empty($email )){
												echo '<li><i class="far fa-envelope"></i><a href="'.esc_attr( 'mailto:'.$email ).'">'.esc_html($email).'</a></li>';
											}
										echo '</ul>';
									echo '</div>';
								echo '</div>';
								echo '<div class="col-auto d-none d-lg-block">';
									echo '<div class="header-links">';
										echo '<ul>';
											if( $settings['show_lang'] == 'yes' ){
												echo '<li class="d-none d-lg-inline-block">';
													echo '<div class="dropdown-link">';
														echo '<a class="dropdown-toggle" href="'.esc_url('#').'" role="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false">'.esc_html__('Language', 'ruffer').'</a>';
														echo '<ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">';
															echo '<li>';
																echo do_shortcode('[gtranslate]');
															echo '</li>';
														echo '</ul>';
													echo '</div>';
												echo '</li>';
											}
											if( ! empty( $settings['social_icon_list'] ) ){
												echo '<li>';
													echo '<div class="social-links">';
														foreach( $settings['social_icon_list'] as $social_icon ){
															$social_target    = $social_icon['icon_link']['is_external'] ? ' target="_blank"' : '';
															$social_nofollow  = $social_icon['icon_link']['nofollow'] ? ' rel="nofollow"' : '';

															echo '<a '.wp_kses_post( $social_target.$social_nofollow ).' href="'.esc_url( $social_icon['icon_link']['url'] ).'">';

															\Elementor\Icons_Manager::render_icon( $social_icon['social_icon'], [ 'aria-hidden' => 'true' ] );

															echo '</a> ';
														}  
													echo '</div>';
												echo '</li>';
											}
										echo '</ul>';
									echo '</div>';
								echo '</div>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				}
		       echo ' <div class="sticky-wrapper '.esc_attr($sticky).'">';
		            echo '<!-- Main Menu Area -->';
		            echo '<div class="container th-container">';
		                echo '<div class="menu-area">';
		                    echo '<div class="row align-items-center justify-content-xl-start justify-content-between">';
		                        if( ! empty( $settings['logo_image']['url'] ) ){
			                        echo '<div class="col-auto">';
			                            echo '<div class="header-logo">';
			                                echo '<a href="'.esc_url( home_url( '/' ) ).'"><img src="'.esc_url( $settings['logo_image']['url'] ).'" alt="Ruffer"></a>';
			                            echo '</div>';
			                        echo '</div>';
			                    }
		                        echo '<div class="col-auto d-none d-lg-block">';
		                            echo '<nav class="main-menu '.esc_attr($menu_icon).'">';
		                                if( ! empty( $settings['ruffer_menu_select'] ) ){
																			wp_nav_menu( $args );
																		} 
		                            echo '</nav>';
		                        echo '</div>';
		                        echo '<div class="col-auto ms-auto">';
		                            echo '<div class="header-button">';
		                            	if( $settings['show_search_btn'] == 'yes' ){
			                                echo '<button type="button" class="simple-icon d-none d-md-block searchBoxToggler"><i class="far fa-search"></i></button>';
			                            }
		                                if( $settings['show_cart_btn'] == 'yes' ){
			                                echo '<button type="button" class="simple-icon sideMenuToggler">';
			                                    echo '<i class="far fa-shopping-cart"></i>';
			                                    echo '<span class="badge">'.esc_html($count).'</span>';
			                                echo '</button>';
			                            }
			                            if(!empty($settings['button_text'])){
			                               echo '<a href="'.esc_url( $settings['button_url']['url'] ).'" class="th-btn d-none d-xxl-block">'.esc_html($settings['button_text']).'<i class="fas fa-arrow-right ms-2"></i></a>';     
			                            }
										echo '<button type="button" class="th-menu-toggle d-block d-xl-none"><i class="far fa-bars"></i></button>';
		                            echo '</div>';
		                        echo '</div>';
		                    echo '</div>';
		                    echo '<div class="logo-bg"><img src="'.RUFFER_PLUGDIRURI . 'assets/img/logo6-bg.svg" alt="img"></div>';
		                echo '</div>';
		            echo '</div>';
		        echo '</div>';
		    echo '</div>';

		}


	}
}