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
class Ruffer_Header3 extends Widget_Base {

	public function get_name() {
		return 'rufferheader3';
	}
	public function get_title() {
		return __( 'Header Normal', 'ruffer' );
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
				'label' 	=> __( 'Header Normal', 'ruffer' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );

        ruffer_select_field( $this, 'layout_style', 'Layout Style', ['Style One', 'Style Two', 'Style Three'] );

		$this->add_control(
			'logo_image',

			[
				'label' 		=> __( 'Upload Logo', 'ruffer' ),
				'type' 			=> Controls_Manager::MEDIA,
			]
		);				

		$menus = $this->ruffer_menu_select();

		if( !empty( $menus ) ){
	        $this->add_control(
				'ruffer_menu_select',
				[
					'label'     	=> __( 'Select ruffer Menu', 'ruffer' ),
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
			'show_search_btn',
			[
				'label' 		=> __( 'Show Search Button?', 'ruffer' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Show', 'ruffer' ),
				'label_off' 	=> __( 'Hide', 'ruffer' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'yes',
				// 'condition'		=> [ 
				// 	'layout_style' => [ '2', '4']
				// ],
			]
		);		

		$this->add_control(
			'show_cart_btn',
			[
				'label' 		=> __( 'Show Cart Button?', 'ruffer' ),
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
				'label_block' 	=> true,
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
       
        //---------------------------------------
			//Style Section Start
		//---------------------------------------

		//-------General Style-------
		 $this->start_controls_section(
			'general_styling',
			[
				'label'     => __( 'Background Styling', 'ruffer' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
        );

		ruffer_color_fields( $this, 'menu_bg', 'Background', 'background', '{{WRAPPER}} .sticky-wrapper', ['1', '2', '3'] );                      

		$this->end_controls_section();

		//------Menu Bar Style-------
        $this->start_controls_section(
			'menubar_styling2',
			[
				'label'     => __( 'Menu Styling', 'ruffer' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
        );

		ruffer_color_fields( $this, 'menu_color1', 'Color', 'color', '{{WRAPPER}} .main-menu>ul>li>a', ['1'] );
		ruffer_color_fields( $this, 'menu_color2', 'Hover Color', 'color', '{{WRAPPER}} .main-menu>ul>li>a:hover', ['1'] );
		ruffer_color_fields( $this, 'menu_color3', 'Dropdown Color', 'color', '{{WRAPPER}} .main-menu ul.sub-menu li a' );
		ruffer_color_fields( $this, 'menu_color4', 'Dropdown Hover Color', 'color', '{{WRAPPER}} .main-menu ul.sub-menu li a:hover' );
		ruffer_color_fields( $this, 'menu_color5', 'Menu Icon Color', 'color', '{{WRAPPER}} .main-menu ul.sub-menu li a:before, {{WRAPPER}} .main-menu ul li.menu-item-has-children > a:after' );

		ruffer_typography_fields( $this, 'menu_font', 'Menu Trpography', '{{WRAPPER}} .main-menu>ul>li>a, {{WRAPPER}} .main-menu ul.sub-menu li a' );

		ruffer_dimensions_fields( $this, 'menu_margin', 'Menu Margin', 'margin', '{{WRAPPER}} .main-menu>ul>li>a' );
		ruffer_dimensions_fields( $this, 'menu_padding', 'Menu Padding', 'padding', '{{WRAPPER}} .main-menu>ul>li>a' );

		$this->end_controls_section();

		//------Button Style-------
		ruffer_button_style_fields( $this, '12', 'Button Styling', '{{WRAPPER}} .th-btn' );
       

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


    	if($settings['layout_style'] == 1 ){
            echo '<div class="th-header layout10">';
                echo '<div class="sticky-wrapper '.esc_attr($sticky).'">';
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
											echo '<a href="'.esc_url( $settings['button_url']['url'] ).'" class="th-btn style2 d-none d-xl-block">'.esc_html($settings['button_text']).'<i class="fas fa-arrow-right ms-2"></i></a>';     
										}
                                        echo '<button type="button" class="th-menu-toggle d-inline-block d-xl-none"><i class="far fa-bars"></i></button>';
                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';

		}elseif($settings['layout_style'] == 2 ){
			echo '<div class="th-header layout14">';
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
			
		}elseif($settings['layout_style'] == 3 ){
			echo '<div class="th-header layout15">'; 
				echo '<div class="sticky-wrapper '.esc_attr($sticky).'">';
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

		}


	}
}