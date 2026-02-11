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
 * Project Box Widget .
 *
 */
class Ruffer_Project2 extends Widget_Base {

	public function get_name() {
		return 'rufferprojects2';
	}
	public function get_title() {
		return __( 'Project V2', 'ruffer' );
	}
	public function get_icon() {
		return 'eicon-code';
    }
	public function get_categories() {
		return [ 'ruffer' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'projectv2_section',
			[
				'label' 	=> __( 'Project V2', 'ruffer' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );

        ruffer_select_field( $this, 'layout_style', 'Layout Style', [ 'Style One', 'Style Two', 'Style Three', 'Style Four', 'Style Five', 'Style Six' ] );

        ruffer_common_repeater_field($this, 'projects', 'Project', [ 'image', 'title', 'text', 'link'  ], ['1'] );

        ruffer_common_repeater_field($this, 'projects2', 'Project', [ 'image', 'subtitle', 'title', 'link'  ], ['2', '4', '5', '6'] );

        $repeater = new Repeater();

		ruffer_media_fields($repeater, 'image', 'Choose Image');
		ruffer_general_fields($repeater, 'subtitle', 'Subtitle', 'TEXTAREA2', 'Repair Services');
		ruffer_general_fields($repeater, 'title', 'Title', 'TEXTAREA', 'Gutter Guard Solutions');
		ruffer_url_fields($repeater, 'button_url', 'Button URL');
		ruffer_general_fields($repeater, 'col', 'Column Class', 'TEXTAREA2', 'col-md-6 col-lg-3');
		
		$this->add_control(
			'projects3',
			[
				'label' 		=> __( 'Projects', 'ruffer' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'title' 	=> __( 'Gutter Guard Solutions', 'ruffer' ),
					],
				],
				'condition'	=> [
					'layout_style' => ['3']
				]
			]
		);

        $this->end_controls_section();

        //---------------------------------------
			//Style Section Start
		//---------------------------------------
		ruffer_common_style_fields( $this, '01', 'Subtitle', '{{WRAPPER}} .project-subtitle', ['2', '3', '4', '5', '6'] );
		ruffer_common_style_fields( $this, '02', 'Title', '{{WRAPPER}} .project-title a' );
		ruffer_common_style_fields( $this, '03', 'Content', '{{WRAPPER}} .project-text', ['1'] );

	}

	protected function render() {

        $settings = $this->get_settings_for_display();

        if( $settings['layout_style'] == '1' ){
            echo '<div class="row gy-30">';
                foreach( $settings['projects'] as $key => $data ){
                    echo '<div class="col-12">';
                        echo '<div class="project-card style5">';
                            echo '<div class="row gy-4 align-items-lg-center">';
                                echo '<div class="col-lg-6 col-xl-7">';
                                    echo '<div class="d-flex flex-column flex-xl-row align-items-xl-center gap-3 gap-xl-4">';
                                        echo '<span class="project-count">'.esc_html($key + 1).'</span>';
                                        echo '<div class="ms-lg-2 pe-lg-4">';
                                            if( ! empty( $data['project_title'] ) ){
                                                echo '<h4 class="project-title mb-2"><a href="'.esc_url( $data['project_link']['url'] ).'">'.esc_html( $data['project_title'] ).'</a></h4>';
                                            }
                                            if( ! empty( $data['project_text'] ) ){
                                                echo '<p class="project-text m-0">'.esc_html( $data['project_text'] ).'</p>';
                                            }
                                        echo '</div>';
                                    echo '</div>';

                                echo '</div>';
                                echo '<div class="col-lg-6 col-xl-5 position-relative">';
                                    echo '<div class="project-content">';
                                        if( ! empty( $data['project_image']['url'] ) ){
                                            echo '<div class="project-img">';
                                                echo ruffer_img_tag( array(
                                                    'url'   => esc_url( $data['project_image']['url'] ),
                                                ) );
                                            echo '</div>';
                                        }
                                        if($data['project_link']['url']){
                                            echo '<a href="'.esc_url( $data['project_link']['url'] ).'" class="project-link"><i class="fa-solid fa-arrow-right-long"></i></a>';
                                        }
                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                }
            echo '</div>';

	    }elseif( $settings['layout_style'] == '2' ){
            echo '<div class="row th-carousel layout-11 gx-0" data-speed="600" data-slide-show="5" data-xl-slide-show="3" data-ml-slide-show="3" data-lg-slide-show="3" data-md-slide-show="2" data-sm-slide-show="1" data-arrows="false" data-center-mode="true" data-xl-center-mode="true" data-ml-center-mode="true">';
                foreach( $settings['projects2'] as $key => $data ){
                    echo '<div class="col-md-6 col-xl-4">';
                        echo '<div class="project-card style2 tilt-active">';
                            if( ! empty( $data['project_image']['url'] ) ){
                                echo '<div class="project-img">';
                                    echo ruffer_img_tag( array(
                                        'url'   => esc_url( $data['project_image']['url'] ),
                                    ) );
                                echo '</div>';
                            }
                            echo '<div class="project-content">';
                                if( ! empty( $data['project_subtitle'] ) ){
                                    echo '<h6 class="project-subtitle">'.esc_html( $data['project_subtitle'] ).'</h6>';
                                }
                                if( ! empty( $data['project_title'] ) ){
                                    echo '<h4 class="project-title"><a href="'.esc_url( $data['project_link']['url'] ).'">'.esc_html( $data['project_title'] ).'</a></h4>';
                                }
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                }
            echo '</div>';
	    	
	    }elseif( $settings['layout_style'] == '3' ){
            echo '<div class="row gy-4">';
                foreach( $settings['projects3'] as $data ){
                    if($data['col']){
                        $col = $data['col'];
                    }else{
                        $col = 'col-md-6 col-lg-3';
                    }

                    echo '<div class="'.esc_attr($col).'">';
                        echo '<div class="project-card overflow-hidden style6 bg-overlay-2">';
                            if( ! empty( $data['image']['url'] ) ){
                                echo '<div class="project-img">';
                                    echo ruffer_img_tag( array(
                                        'url'   => esc_url( $data['image']['url'] ),
                                    ) );
                                echo '</div>';
                            }
                            echo '<div class="project-content">';
                                echo '<div>';
                                    if( ! empty( $data['subtitle'] ) ){
                                        echo '<h6 class="project-subtitle">'.esc_html( $data['subtitle'] ).'</h6>';
                                    }
                                    if( ! empty( $data['title'] ) ){
                                        echo '<h4 class="project-title"><a class="d-inline-block" href="'.esc_url( $data['button_url']['url'] ).'">'.esc_html( $data['title'] ).'</a></h4>';
                                    }
                                    echo '<a href="'.esc_url( $data['image']['url'] ).'" class="icon-btn popup-image"><i class="far fa-plus"></i></a>';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                }
            echo '</div>';

        }elseif( $settings['layout_style'] == '4' ){
            echo '<div class="row th-carousel gx-30" data-speed="600" data-slide-show="4" data-lg-slide-show="3" data-md-slide-show="2" data-sm-slide-show="1" data-arrows="false" data-center-mode="true" data-xl-center-mode="true" data-ml-center-mode="true">';
                foreach( $settings['projects2'] as $data ){
                    echo '<div class="col-md-6 col-xl-4">';
                        echo '<div class="project-card style2 tilt-active">';
                            if( ! empty( $data['project_image']['url'] ) ){
                                echo '<div class="project-img">';
                                    echo ruffer_img_tag( array(
                                        'url'   => esc_url( $data['project_image']['url'] ),
                                    ) );
                                echo '</div>';
                            }
                            echo '<div class="project-content">';
                                if( ! empty( $data['project_subtitle'] ) ){
                                    echo '<h6 class="project-subtitle">'.esc_html( $data['project_subtitle'] ).'</h6>';
                                }
                                if( ! empty( $data['project_title'] ) ){
                                    echo '<h4 class="project-title"><a href="'.esc_url( $data['project_link']['url'] ).'">'.esc_html( $data['project_title'] ).'</a></h4>';
                                }
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                }
            echo '</div>';

        }elseif( $settings['layout_style'] == '5' ){
            echo '<div class="row th-carousel layout-14" data-slide-show="1" data-ml-slide-show="2" data-xl-slide-show="2" data-lg-slide-show="2" data-md-slide-show="1" data-sm-slide-show="1" data-center-mode="true" data-center-padding="380px" data-xl-center-mode="true" data-ml-center-mode="true">';
                foreach( $settings['projects2'] as $data ){
                    echo '<div class="col-md-6 col-xl-4">';
                        echo '<div class="project-card style2 tilt-active">';
                            if( ! empty( $data['project_image']['url'] ) ){
                                echo '<div class="project-img">';
                                    echo ruffer_img_tag( array(
                                        'url'   => esc_url( $data['project_image']['url'] ),
                                    ) );
                                echo '</div>';
                            }
                            echo '<div class="project-content">';
                                if( ! empty( $data['project_subtitle'] ) ){
                                    echo '<h6 class="project-subtitle">'.esc_html( $data['project_subtitle'] ).'</h6>';
                                }
                                if( ! empty( $data['project_title'] ) ){
                                    echo '<h4 class="project-title"><a href="'.esc_url( $data['project_link']['url'] ).'">'.esc_html( $data['project_title'] ).'</a></h4>';
                                }
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                }
            echo '</div>';

        }elseif( $settings['layout_style'] == '6' ){
            echo '<div class="row th-carousel layout-15 project-slider7 gx-30" data-slide-show="2" data-ml-slide-show="2" data-lg-slide-show="1" data-md-slide-show="1" data-sm-slide-show="1" data-arrows="false" data-center-mode="true" data-ml-center-mode="true" data-center-padding="200px" data-lg-center-padding="200px">';
                foreach( $settings['projects2'] as $data ){
                    echo '<div class="col-lg-3">';
                        echo '<div class="project-card style8">';
                            if( ! empty( $data['project_image']['url'] ) ){
                                echo '<div class="project-img">';
                                    echo ruffer_img_tag( array(
                                        'url'   => esc_url( $data['project_image']['url'] ),
                                    ) );
                                echo '</div>';
                            }
                            echo '<div class="project-content">';
                                echo '<div>';
                                    if( ! empty( $data['project_title'] ) ){
                                        echo '<h4 class="project-title"><a href="'.esc_url( $data['project_link']['url'] ).'">'.esc_html( $data['project_title'] ).'</a></h4>';
                                    }
                                    if( ! empty( $data['project_subtitle'] ) ){
                                        echo '<span class="project-subtitle">'.esc_html( $data['project_subtitle'] ).'</span>';
                                    }
                                echo '</div>';
                                echo '<a href="'.esc_url( $data['project_image']['url'] ).'" class="icon-btn popup-image"><i class="fa-solid fa-arrow-up-right"></i></a>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                }
            echo '</div>';

        }


	}
}