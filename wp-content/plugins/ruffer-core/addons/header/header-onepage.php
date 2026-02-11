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
 * Header Onepage Widget .
 *
 */
class Ruffer_Header_Onepage extends Widget_Base {

	public function get_name() {
		return 'rufferheaderonepage';
	}
	public function get_title() {
		return __( 'Header Onepage', 'ruffer' );
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
            'logo_color',
            [
                'label' 		=> __( 'Logo Background', 'ruffer' ),
                'type' 			=> Controls_Manager::COLOR,
                'selectors' 	=> [
                    '{{WRAPPER}} .logo-bg:before' => 'background-color: {{VALUE}} !important;',
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

        // Header sub-menu icon
		if( class_exists( 'ReduxFramework' ) ){ 
			if(ruffer_opt('ruffer_header_sticky')){
				$sticky = 'yes';
			}else{
				$sticky = '';
			}
		}


    	if($settings['header_style'] == 1 ){
            echo '<div class="th-header header-layout8 onepage-nav">';
               echo ' <div class="th-menu-wrapper2 sticky-wrapper '.esc_attr($sticky).'">';
                    echo '<div class="th-menu-area2 text-center">';
                        echo '<button class="th-menu-toggle2"><i class="far fa-bars"></i></button>';
                        if( ! empty( $settings['logo_image']['url'] ) ){
                            echo '<div class="mobile-logo">';
                                echo '<a href="'.esc_url( home_url( '/' ) ).'"><img src="'.esc_url( $settings['logo_image']['url'] ).'" alt="Ruffer"></a>';
                            echo '</div>';
                        }
                        echo '<div class="th-mobile-menu2">';
                            if( ! empty( $settings['ruffer_menu_select'] ) ){
                                wp_nav_menu( $args );
                            } 
                            echo '<div class="th-social style2 justify-content-center">';
                                foreach( $settings['social_icon_list'] as $social_icon ){
                                    $social_target    = $social_icon['icon_link']['is_external'] ? ' target="_blank"' : '';
                                    $social_nofollow  = $social_icon['icon_link']['nofollow'] ? ' rel="nofollow"' : '';

                                echo '<a '.wp_kses_post( $social_target.$social_nofollow ).' href="'.esc_url( $social_icon['icon_link']['url'] ).'">';

                                \Elementor\Icons_Manager::render_icon( $social_icon['social_icon'], [ 'aria-hidden' => 'true' ] );

                                    echo '</a> ';
                                } 
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';

		}


	}
}