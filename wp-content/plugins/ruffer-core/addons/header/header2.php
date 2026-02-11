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
class Ruffer_Header2 extends Widget_Base {

	public function get_name() {
		return 'rufferheader2';
	}
	public function get_title() {
		return __( 'Header 2', 'ruffer' );
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

		$this->add_control(
			'show_lang',
			[
				'label' 		=> __( 'Show Language ?', 'ruffer' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Show', 'ruffer' ),
				'label_off' 	=> __( 'Hide', 'ruffer' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'yes',
				'condition'		=> [ 
					'show_topbar' => [ 'yes' ] ,
					'header_style' => ['2', '3', '4', '5']
				],
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
			'topbar_phone_icon',
			[
				'label' 		=> __( 'Phone Icon', 'ruffer' ),
				'type' 			=> Controls_Manager::TEXT,
				'label_block' => true,
				'condition'		=> [ 'show_topbar' => [ 'yes' ] ],
			]
		);				
		$this->add_control(
			'topbar_phone',
			[
				'label' 		=> __( 'Phone', 'ruffer' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'label_block' => true,
				'default' 	=> __( '+111 (564) 568 2', 'ruffer' ),
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
				'type' 			=> Controls_Manager::TEXTAREA,
				'label_block' => true,
				'default' 	=> __( 'info@ruffer.com', 'ruffer' ),
				'condition'		=> [ 'show_topbar' => [ 'yes' ] ],
			]
		);

		//----------------------------maim menu control----------------------------//
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
			'logo_shape',
			[
				'label' 		=> __( 'Upload Logo Shape', 'ruffer' ),
				'type' 			=> Controls_Manager::MEDIA,
				'condition'		=> [ 
					'header_style' => ['4']
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
				'default' 	=> __( 'Get a Quote', 'ruffer' ),
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

        $this->end_controls_section();
       
        //-----------------------------------General BG Styling-------------------------------------//
        $this->start_controls_section(
            'general_styling',
            [
                'label'     => __( 'Background Styling', 'ruffer' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'topbar_background_color',
            [
                'label'     => __( 'TopBar Background', 'ruffer' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .header-top' => 'background-color: {{VALUE}}!important',
                ],
            ]
        );
        $this->add_control(
            'topbar_background_color2',
            [
                'label'     => __( 'TopBar 2 Background', 'ruffer' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .header-top:before' => 'background-color: {{VALUE}}!important',
                ],
				'condition'		=> [ 
					'header_style' => ['2']
				],
            ]
        );

        $this->add_control(
            'logo_color',
            [
                'label' 		=> __( 'Logo Background', 'ruffer' ),
                'type' 			=> Controls_Manager::COLOR,
                'selectors' 	=> [
                    '{{WRAPPER}} .logo-bg:before' => 'background-color: {{VALUE}} !important;',
                ],
				'condition'		=> [ 
					'header_style' => ['1']
				],
            ]
        ); 
        $this->add_control(
            'logo_color2',
            [
                'label' 		=> __( 'Logo Background', 'ruffer' ),
                'type' 			=> Controls_Manager::COLOR,
                'selectors' 	=> [
                    '{{WRAPPER}} .header-logo:before' => 'background-color: {{VALUE}} !important;',
                ],
				'condition'		=> [ 
					'header_style' => ['3']
				],
            ]
        ); 
        $this->add_control(
            'logo_color3',
            [
                'label' 		=> __( 'Logo Background', 'ruffer' ),
                'type' 			=> Controls_Manager::COLOR,
                'selectors' 	=> [
                    '{{WRAPPER}} .logo-mask' => 'background-color: {{VALUE}} !important;',
                ],
				'condition'		=> [ 
					'header_style' => ['4']
				],
            ]
        ); 
        $this->add_control(
            'header_menu_bg',
            [
                'label' 		=> __( 'Menu Background', 'ruffer' ),
                'type' 			=> Controls_Manager::COLOR,
                'selectors' 	=> [
                    '{{WRAPPER}} .sticky-wrapper' => 'background-color: {{VALUE}} !important;',
                ],
            ]
        );      

        $this->end_controls_section();

       //-----------------------------------Menubar Styling-------------------------------------//
       $this->start_controls_section(
            'menubar_styling',
            [
                'label'     => __( 'Menu Styling', 'ruffer' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'menu_etxt_color',
            [
                'label' 			=> __( 'Menu Text Color', 'ruffer' ),
                'type' 				=> Controls_Manager::COLOR,
                'selectors' 		=> [
                    '{{WRAPPER}} .main-menu>ul>li>a' => 'color: {{VALUE}} !important;',
                ]
            ]
        );
        $this->add_control(
            'menu_text_hover_color',
            [
                'label' 			=> __( 'Menu Hover Color', 'ruffer' ),
                'type' 				=> Controls_Manager::COLOR,
                'selectors' 		=> [
                    '{{WRAPPER}} .main-menu>ul>li>a:hover' => 'color: {{VALUE}} !important;',
                ]
            ]
        );
        $this->add_control(
            'dropdown_txt_color',
            [
                'label' 			=> __( 'Dropdown Text Color', 'ruffer' ),
                'type' 				=> Controls_Manager::COLOR,
                'selectors' 		=> [
                    '{{WRAPPER}} .main-menu ul.sub-menu li a' => 'color: {{VALUE}} !important;',
                ]
            ]
        );
        $this->add_control(
            'dropdown_txt_hover_color',
            [
                'label' 			=> __( 'Dropdown Hover Color', 'ruffer' ),
                'type' 				=> Controls_Manager::COLOR,
                'selectors' 		=> [
                    '{{WRAPPER}} .main-menu ul.sub-menu li a:hover' => 'color: {{VALUE}} !important;',
                ]
            ]
        );
        $this->add_control(
            'dropdown_icon_color',
            [
                'label' 			=> __( 'Dropdown Icon Color', 'ruffer' ),
                'type' 				=> Controls_Manager::COLOR,
                'selectors' 		=> [
                    '{{WRAPPER}} .main-menu ul.sub-menu li a:before' => 'color: {{VALUE}} !important;',
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' 			=> 'menu_typography',
                'label' 		=> __( 'Menu Typography', 'ruffer' ),
                'selector' 		=> '{{WRAPPER}} .main-menu>ul>li>a, {{WRAPPER}} .main-menu ul.sub-menu li a',
            ]
        );
        $this->add_responsive_control(
            'menu_margin',
            [
                'label' 		=> __( 'Menu Margin', 'ruffer' ),
                'type' 			=> Controls_Manager::DIMENSIONS,
                'size_units' 	=> [ 'px', '%', 'em' ],
                'selectors' 	=> [
                    '{{WRAPPER}} .main-menu>ul>li>a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ]
            ]
        );
        $this->add_responsive_control(
            'menu_padding',
            [
                'label' 		=> __( 'Menu Padding', 'ruffer' ),
                'type' 			=> Controls_Manager::DIMENSIONS,
                'size_units' 	=> [ 'px', '%', 'em' ],
                'selectors' 	=> [
                    '{{WRAPPER}} .main-menu>ul>li>a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ]
            ]
        );

        $this->end_controls_section();

		ruffer_button_style_fields( $this, '10', 'Button Styling', '{{WRAPPER}} .th-btn' );
       

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


	    echo ruffer_mobile_menu();
	    echo ruffer_search_box();

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
			echo '<div class="th-header header-layout7">';
                if( $settings['show_topbar'] == 'yes' ){
                    echo '<div class="header-top">';
                        echo '<div class="container-fluid p-0">';
                            echo '<div class="row justify-content-center justify-content-lg-between align-items-center gy-2">';
                                echo '<div class="col-auto">';
                                    echo '<div class="header-links">';
                                        echo '<ul>';
											if(!empty($settings['topbar_phone'])){
												echo '<li>'.wp_kses_post( $settings['topbar_phone_icon'] . $settings['topbar_phone'] ).'</li>';
											}
											if(!empty($settings['topbar_email'])){
												echo '<li>'.wp_kses_post( $settings['topbar_email_icon'] . $settings['topbar_email'] ).'</li>';
											}
                                        echo '</ul>';
                                    echo '</div>';
                                echo '</div>';
                                if( ! empty( $settings['social_icon_list'] ) ){
                                echo '<div class="col-auto">';
                                    echo '<div class="header-links">';
                                        echo '<ul>';
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
                                        echo '</ul>';
                                    echo '</div>';
                                echo '</div>';
                                }
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                }
				echo '<div class="sticky-wrapper '.esc_attr($sticky).'">';
					echo '<!-- Main Menu Area -->';
					echo '<div class="menu-area">';
						echo '<div class="container-fluid p-0">';
							echo '<div class="row align-items-center justify-content-between">';
                                if( ! empty( $settings['logo_image']['url'] ) ){
                                    echo '<div class="col-auto">';
                                        echo '<div class="header-logo">';
											echo '<a href="'.esc_url( home_url( '/' ) ).'">';
												echo ruffer_img_tag( array(
													'url'   => esc_url( $settings['logo_image']['url'] ),
												));
											echo '</a>';
                                        echo '</div>';
                                    echo '</div>';
                                }
								echo '<div class="col-auto me-lg-auto d-none d-xl-inline-block">';
									echo '<nav class="main-menu '.esc_attr($menu_icon).'">';
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
										echo '<button type="button" class="th-menu-toggle d-block d-xl-none"><i class="far fa-bars"></i></button>';
									echo '</div>';
								echo '</div>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
					echo '<div class="logo-bg"></div>';
				echo '</div>';
			echo '</div>';

		}elseif($settings['header_style'] == 2 ){
			echo '<div class="th-header layout9">';
				if( $settings['show_topbar'] == 'yes' ){
					echo '<div class="header-top">';
						echo '<div class="container">';
							echo '<div class="row justify-content-center justify-content-lg-between align-items-center gy-2">';
								echo '<div class="col-auto d-none d-lg-block">';
									echo '<div class="header-links sep-none">';
										echo '<ul>';
											if(!empty($settings['topbar_phone'])){
												echo '<li>'.wp_kses_post( $settings['topbar_phone_icon'] . $settings['topbar_phone'] ).'</li>';
											}
											if(!empty($settings['topbar_email'])){
												echo '<li>'.wp_kses_post( $settings['topbar_email_icon'] . $settings['topbar_email'] ).'</li>';
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
					echo '<div class="container">';
						echo '<div class="menu-area">';
							echo '<div class="row align-items-center justify-content-between">';
								if( ! empty( $settings['logo_image']['url'] ) ){
                                    echo '<div class="col-auto">';
                                        echo '<div class="header-logo">';
											echo '<a href="'.esc_url( home_url( '/' ) ).'">';
												echo ruffer_img_tag( array(
													'url'   => esc_url( $settings['logo_image']['url'] ),
												));
											echo '</a>';
                                        echo '</div>';
                                    echo '</div>';
                                }
								echo '<div class="col-auto">';
									echo '<nav class="main-menu d-none d-xl-inline-block '.esc_attr($menu_icon).'">';
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
											echo '<a href="'.esc_url( $settings['button_url']['url'] ).'" class="th-btn d-none d-lg-block">'.esc_html($settings['button_text']).'<i class="fas fa-arrow-right ms-2"></i></a>';     
										}
										echo '<button type="button" class="th-menu-toggle d-inline-block d-xl-none"><i class="far fa-bars"></i></button>';
									echo '</div>';
								echo '</div>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</div>';

		}elseif($settings['header_style'] == 3 ){
			echo '<header class="th-header layout11">';
				if( $settings['show_topbar'] == 'yes' ){
					echo '<div class="header-top">';
						echo '<div class="container">';
							echo '<div class="row justify-content-center justify-content-lg-between align-items-center gy-2">';
								echo '<div class="col-auto col-xl-4 offset-xl-3 d-none d-lg-block">';
									echo '<div class="header-links sep-none">';
										echo '<ul>';
											if(!empty($settings['topbar_phone'])){
												echo '<li>'.wp_kses_post( $settings['topbar_phone_icon'] . $settings['topbar_phone'] ).'</li>';
											}
											if(!empty($settings['topbar_email'])){
												echo '<li>'.wp_kses_post( $settings['topbar_email_icon'] . $settings['topbar_email'] ).'</li>';
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
					echo '<div class="container">';
						echo '<div class="menu-area">';
							echo '<div class="row align-items-center justify-content-between">';
								if( ! empty( $settings['logo_image']['url'] ) ){
									echo '<div class="col-auto">';
										echo '<div class="header-logo">';
											echo '<a href="'.esc_url( home_url( '/' ) ).'">';
												echo ruffer_img_tag( array(
													'url'   => esc_url( $settings['logo_image']['url'] ),
												));
											echo '</a>';
										echo '</div>';
									echo '</div>';
								}
								echo '<div class="col-auto">';
									echo '<nav class="main-menu d-none d-xl-inline-block '.esc_attr($menu_icon).'">';
										if( ! empty( $settings['ruffer_menu_select'] ) ){
											wp_nav_menu( $args );
										} 
									echo '</nav>';
								echo '</div>';
								echo '<div class="col-auto">';
									echo '<div class="header-button">';
										if( $settings['show_search_btn'] == 'yes' ){
											echo '<button type="button" class="simple-icon searchBoxToggler d-none d-md-block"><i class="far fa-search"></i></button>';
										}
										if( $settings['show_cart_btn'] == 'yes' ){
											echo '<button type="button" class="simple-icon sideMenuToggler">';
												echo '<i class="far fa-shopping-cart"></i>';
												echo '<span class="badge">'.esc_html($count).'</span>';
											echo '</button>';
										}
										if(!empty($settings['button_text'])){
											echo '<a href="'.esc_url( $settings['button_url']['url'] ).'" class="th-btn d-none d-xxl-block"">'.esc_html($settings['button_text']).'<i class="fas fa-arrow-right ms-2"></i></a>';     
										}
										echo '<button type="button" class="th-menu-toggle d-inline-block d-xl-none"><i class="far fa-bars"></i></button>';
									echo '</div>';
								echo '</div>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</header>';

		}elseif($settings['header_style'] == 4 ){
			echo '<div class="th-header layout12">';
				if( $settings['show_topbar'] == 'yes' ){
					echo '<div class="header-top">';
						echo '<div class="container-fluid">';
							echo '<div class="row justify-content-end justify-content-xl-between align-items-center gy-2">';
								echo '<div class="col-auto offset-lg-3 d-none d-xl-block">';
									echo '<div class="header-links sep-none ms-lg-4">';
										echo '<ul>';
											if(!empty($settings['topbar_phone'])){
												echo '<li>'.wp_kses_post( $settings['topbar_phone_icon'] . $settings['topbar_phone'] ).'</li>';
											}
											if(!empty($settings['topbar_email'])){
												echo '<li>'.wp_kses_post( $settings['topbar_email_icon'] . $settings['topbar_email'] ).'</li>';
											}
										echo '</ul>';
									echo '</div>';
								echo '</div>';
								echo '<div class="col-auto">';
									echo '<div class="header-links">';
										echo '<ul>';
											if( $settings['show_lang'] == 'yes' ){
												echo '<li class="d-none d-md-inline-block">';
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
					if(!empty($settings['logo_shape']['url'])){
						echo '<div class="logo-mask" data-bg-src="'.esc_url($settings['logo_shape']['url']).'"></div>';
					}
					echo '<!-- Main Menu Area -->';
					echo '<div class="container-fluid">';
						echo '<div class="menu-area">';
							echo '<div class="row align-items-center justify-content-between">';
								if( ! empty( $settings['logo_image']['url'] ) ){
									echo '<div class="col-auto">';
										echo '<div class="header-logo">';
											echo '<a href="'.esc_url( home_url( '/' ) ).'">';
												echo ruffer_img_tag( array(
													'url'   => esc_url( $settings['logo_image']['url'] ),
												));
											echo '</a>';
										echo '</div>';
									echo '</div>';
								}
								echo '<div class="col-auto">';
									echo '<nav class="main-menu d-none d-xl-inline-block '.esc_attr($menu_icon).'">';
										if( ! empty( $settings['ruffer_menu_select'] ) ){
											wp_nav_menu( $args );
										} 
									echo '</nav>';
								echo '</div>';
								echo '<div class="col-auto">';
									echo '<div class="header-button">';
										if( $settings['show_search_btn'] == 'yes' ){
											echo '<button type="button" class="simple-icon searchBoxToggler d-none d-md-block"><i class="far fa-search"></i></button>';
										}
										if( $settings['show_cart_btn'] == 'yes' ){
											echo '<button type="button" class="simple-icon sideMenuToggler">';
												echo '<i class="far fa-shopping-cart"></i>';
												echo '<span class="badge">'.esc_html($count).'</span>';
											echo '</button>';
										}
										if(!empty($settings['button_text'])){
											echo '<a href="'.esc_url( $settings['button_url']['url'] ).'" class="th-btn d-none d-lg-block">'.esc_html($settings['button_text']).'<i class="fas fa-arrow-right ms-2"></i></a>';     
										}
										echo '<button type="button" class="th-menu-toggle d-inline-block d-xl-none"><i class="far fa-bars"></i></button>';
									echo '</div>';
								echo '</div>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</div>';

		}elseif($settings['header_style'] == 5 ){
			echo '<div class="th-header layout13">';
				if( $settings['show_topbar'] == 'yes' ){
					echo '<div class="header-top d-none d-md-block">';
						echo '<div class="container">';
							echo '<div class="row justify-content-center justify-content-lg-between align-items-center gy-2">';
								echo '<div class="col-auto">';
									echo '<div class="header-links sep-none">';
										echo '<ul>';
											if(!empty($settings['topbar_phone'])){
												echo '<li>'.wp_kses_post( $settings['topbar_phone_icon'] . $settings['topbar_phone'] ).'</li>';
											}
											if(!empty($settings['topbar_email'])){
												echo '<li>'.wp_kses_post( $settings['topbar_email_icon'] . $settings['topbar_email'] ).'</li>';
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
					echo '<div class="container">';
						echo '<div class="menu-area">';
							echo '<div class="row align-items-center justify-content-between">';
								if( ! empty( $settings['logo_image']['url'] ) ){
									echo '<div class="col-auto">';
										echo '<div class="header-logo">';
											echo '<a href="'.esc_url( home_url( '/' ) ).'">';
												echo ruffer_img_tag( array(
													'url'   => esc_url( $settings['logo_image']['url'] ),
												));
											echo '</a>';
										echo '</div>';
									echo '</div>';
								}
								echo '<div class="col-auto">';
									echo '<nav class="main-menu d-none d-xl-inline-block '.esc_attr($menu_icon).'">';
										if( ! empty( $settings['ruffer_menu_select'] ) ){
											wp_nav_menu( $args );
										} 
									echo '</nav>';
								echo '</div>';
								echo '<div class="col-auto">';
									echo '<div class="header-button">';
										if( $settings['show_search_btn'] == 'yes' ){
											echo '<button type="button" class="simple-icon searchBoxToggler d-none d-md-block"><i class="far fa-search"></i></button>';
										}
										if( $settings['show_cart_btn'] == 'yes' ){
											echo '<button type="button" class="simple-icon sideMenuToggler">';
												echo '<i class="far fa-shopping-cart"></i>';
												echo '<span class="badge">'.esc_html($count).'</span>';
											echo '</button>';
										}
										if(!empty($settings['button_text'])){
											echo '<a href="'.esc_url( $settings['button_url']['url'] ).'" class="th-btn d-none d-lg-block">'.esc_html($settings['button_text']).'<i class="fas fa-arrow-right ms-2"></i></a>';     
										}
										echo '<button type="button" class="th-menu-toggle d-inline-block d-xl-none"><i class="far fa-bars"></i></button>';
									echo '</div>';
								echo '</div>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</div>';

		}


	}
}