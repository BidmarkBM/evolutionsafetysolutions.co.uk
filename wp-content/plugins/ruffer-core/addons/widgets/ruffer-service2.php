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
 * Service Widget .
 *
 */
class Ruffer_Service2 extends Widget_Base {

	public function get_name() {
		return 'rufferservice2';
	}
	public function get_title() {
		return __( 'Services V2', 'ruffer' );
	}
	public function get_icon() {
		return 'th-icon';
    }
	public function get_categories() {
		return [ 'ruffer' ];
	}

	protected function register_controls() {

		 $this->start_controls_section(
			'service_section',
			[
				'label'     => __( 'Services', 'ruffer' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
			]
        );

		ruffer_select_field( $this, 'layout_style', 'Layout Style', [ 'Style One', 'Style Two', 'Style Three', 'Style Four', 'Style Five', 'Style Six', 'Style Seven' ] );

		ruffer_media_fields($this, 'shape', 'Choose Shape', ['2', '3']);
		$this->add_control(
			'video_position',
			[
				'label' 		=> __( 'Show Video Position?', 'ruffer' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Top', 'ruffer' ),
				'label_off' 	=> __( 'Bottom', 'ruffer' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'yes',
				'condition'		=> [ 
					'layout_style' => [ '6' ] 
				],
			]
		);
		ruffer_media_fields($this, 'video_image', 'Choose Video Image', ['6']);
		ruffer_url_fields( $this, 'video_url', 'Video URL', ['6'] );

		$repeater = new Repeater();

		ruffer_media_fields($repeater, 'icon', 'Choose Icon');
		ruffer_general_fields($repeater, 'title', 'Title', 'TEXTAREA2', 'Electrical Inspections');
		ruffer_general_fields($repeater, 'description', 'Description', 'TEXTAREA', ''); 
		ruffer_general_fields($repeater, 'button_text', 'Button Text', 'TEXT', 'Read More');
		ruffer_url_fields($repeater, 'button_url', 'Button URL');

		$this->add_control(
			'service_list',
			[
				'label' 		=> __( 'Service Lists', 'ruffer' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'title' 	=> __( 'Electrical Inspections', 'ruffer' ),
					],
				],
				'condition'	=> [
					'layout_style' => ['1', '4', '6']
				]
			]
		);

		$repeater = new Repeater();

		ruffer_media_fields($repeater, 'image', 'Choose Image');
		ruffer_media_fields($repeater, 'icon', 'Choose Icon');
		ruffer_general_fields($repeater, 'title', 'Title', 'TEXTAREA2', 'Electrical Inspections');
		ruffer_general_fields($repeater, 'description', 'Description', 'TEXTAREA', ''); 
		ruffer_general_fields($repeater, 'button_text', 'Button Text', 'TEXT', 'Read More');
		ruffer_url_fields($repeater, 'button_url', 'Button URL');

		$this->add_control(
			'service_list2',
			[
				'label' 		=> __( 'Service Lists', 'ruffer' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'title' 	=> __( 'Electrical Inspections', 'ruffer' ),
					],
				],
				'condition'	=> [
					'layout_style' => ['2', '3', '5', '7']
				]
			]
		);


        $this->end_controls_section();

        //---------------------------------------
			//Style Section Start
		//---------------------------------------

        ruffer_common2_style_fields( $this, '02', 'Title', '{{WRAPPER}} .box-title a', ['1', '2', '3', '4', '5', '6', '7'] );
		ruffer_common_style_fields( $this, '03', 'Description', '{{WRAPPER}} .service-card_text', ['1', '3']  );
		ruffer_common_style_fields( $this, '04', 'Description', '{{WRAPPER}} .service-featured_text', ['2', '5', '7']  );
		ruffer_common_style_fields( $this, '05', 'Description', '{{WRAPPER}} .service-box_text', ['4', '6']  );

	}

	protected function render() {

        $settings = $this->get_settings_for_display();

		if( $settings['layout_style'] == '1' ){
            echo '<div class="row g-4">';
                foreach( $settings['service_list'] as $data ){
                    echo '<div class="col-md-6 col-xxl-4">';
                        echo '<div class="service-card style5 h-100">';
                            if(!empty($data['icon']['url'])){
                                echo '<div class="service-bg-shape">';
                                    echo ruffer_img_tag( array(
                                        'url'   => esc_url( $data['icon']['url'] ),
                                    ));
                                echo '</div>';
                            }
                            echo '<div class="service-content">';
                                echo '<div class="d-flex align-items-center justify-content-between">';
                                    if(!empty($data['icon']['url'])){
										echo '<div class="shape-icon">';
											echo ruffer_img_tag( array(
												'url'   => esc_url( $data['icon']['url'] ),
											));
										echo '</div>';
									}
                                    echo '<div class="project-count"></div>';
                                echo '</div>';
                                if(!empty($data['title'])){
                                    echo '<h3 class="box-title"><a href="'.esc_url( $data['button_url']['url'] ).'">'.esc_html($data['title']).'</a></h3>';
                                }
                                if(!empty($data['description'])){
                                    echo '<p class="service-card_text">'.esc_html($data['description']).'</p>';
                                }
                                if(!empty($data['button_text'])){
                                    echo '<a href="'.esc_url( $data['button_url']['url'] ).'" class="link-btn style6">'.wp_kses_post($data['button_text']).'<i class="fa-solid fa-arrow-up-right ms-3"></i></a>';
                                }
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                }
            echo '</div>';

		}elseif( $settings['layout_style'] == '2' ){
			echo '<div class="row slider-shadow th-carousel gx-30" data-slide-show="3" data-lg-slide-show="3" data-md-slide-show="2" data-sm-slide-show="1">';
				foreach( $settings['service_list2'] as $data ){
					echo '<div class="col-md-6 col-lg-4">';
						echo '<div class="service-featured style3">';
							if(!empty($data['image']['url'])){
								echo '<div class="service-featured_img">';
									echo ruffer_img_tag( array(
										'url'   => esc_url( $data['image']['url'] ),
									));
								echo '</div>';
							}
							echo '<div class="service-featured_content shadow">';
								if(!empty($settings['shape']['url'])){
									echo '<div class="service-bg-shape">';
										echo ruffer_img_tag( array(
											'url'   => esc_url( $settings['shape']['url'] ),
										));
									echo '</div>';
								}
								if(!empty($data['icon']['url'])){
									echo '<div class="service-default-icon icon-invert-white">';
										echo ruffer_img_tag( array(
											'url'   => esc_url( $data['icon']['url'] ),
										));
									echo '</div>';
								}
								if(!empty($data['title'])){
                                    echo '<h3 class="box-title"><a href="'.esc_url( $data['button_url']['url'] ).'">'.esc_html($data['title']).'</a></h3>';
                                }
                                if(!empty($data['description'])){
                                    echo '<p class="service-featured_text">'.esc_html($data['description']).'</p>';
                                }
                                if(!empty($data['button_text'])){
                                    echo '<a href="'.esc_url( $data['button_url']['url'] ).'" class="link-btn">'.wp_kses_post($data['button_text']).'<i class="fa-solid fa-arrow-up-right ms-2"></i></a>';
                                }
							echo '</div>';
						echo '</div>';
					echo '</div>';
				}
			echo '</div>';

		}elseif( $settings['layout_style'] == '3' ){
			echo ' <div class="row th-carousel layout-service arrow-style2 service-slider8 slider-shadow gy-4" data-slide-show="3" data-lg-slide-show="2" data-md-slide-show="2" data-sm-slide-show="1" data-xs-slide-show="1" data-arrows="false" data-center-mode="true">';
				foreach( $settings['service_list2'] as $data ){
					echo '<div class="col-md-6 col-xl-4">';
						echo '<div class="service-card style6">';
							echo '<div class="service-card_img">';
								echo ruffer_img_tag( array(
									'url'   => esc_url( $data['image']['url'] ),
								));
								if(!empty($data['icon']['url'])){
									echo '<div class="service-card_icon">';
										echo ruffer_img_tag( array(
											'url'   => esc_url( $data['icon']['url'] ),
										));
									echo '</div>';
								}
							echo '</div>';
							echo '<div class="service-content">';
								if(!empty($settings['shape']['url'])){
									echo '<div class="service-card-shape">';
										echo ruffer_img_tag( array(
											'url'   => esc_url( $settings['shape']['url'] ),
										));
									echo '</div>';
								}
								if(!empty($data['title'])){
                                    echo '<h3 class="box-title"><a href="'.esc_url( $data['button_url']['url'] ).'">'.esc_html($data['title']).'</a></h3>';
                                }
                                if(!empty($data['description'])){
                                    echo '<p class="service-card_text">'.esc_html($data['description']).'</p>';
                                }
                                if(!empty($data['button_text'])){
                                    echo '<a href="'.esc_url( $data['button_url']['url'] ).'" class="link-btn">'.wp_kses_post($data['button_text']).'<i class="fa-solid fa-arrow-up-right ms-3"></i></a>';
                                }
							echo '</div>';
						echo '</div>'; 
					echo '</div>'; 
				}
			echo '</div>';

		}elseif( $settings['layout_style'] == '4' ){
			echo '<div class="row slider-shadow th-carousel gx-30" data-slide-show="3" data-lg-slide-show="2" data-md-slide-show="2" data-sm-slide-show="1" data-xs-slide-show="1" data-adaptive-height="true">';
				foreach( $settings['service_list'] as $data ){
					echo '<div class="col-md-6 col-lg-4">';
						echo '<div class="service-box style3">';
							echo '<div class="service-box_content">';
								if(!empty($data['icon']['url'])){
									echo '<div class="service-default-icon">';
										echo ruffer_img_tag( array(
											'url'   => esc_url( $data['icon']['url'] ),
										));
									echo '</div>';
								}
								if(!empty($data['title'])){
                                    echo '<h3 class="box-title"><a href="'.esc_url( $data['button_url']['url'] ).'">'.esc_html($data['title']).'</a></h3>';
                                }
                                if(!empty($data['description'])){
                                    echo '<p class="service-box_text">'.esc_html($data['description']).'</p>';
                                }
                                if(!empty($data['button_text'])){
                                    echo '<a href="'.esc_url( $data['button_url']['url'] ).'" class="link-btn">'.wp_kses_post($data['button_text']).'<i class="fa-sharp fa-solid fa-arrow-right ms-2"></i></a>';
                                }
							echo '</div>';
						echo '</div>';
					echo '</div>';
				}
			echo '</div>';

		}elseif( $settings['layout_style'] == '5' ){
			echo '<div class="row slider-shadow th-carousel gx-30" data-slide-show="3" data-lg-slide-show="2" data-md-slide-show="2" data-sm-slide-show="1">';
				foreach( $settings['service_list2'] as $data ){
					echo '<div class="col-md-6 col-lg-4">';
						echo '<div class="service-featured style4">';
							echo '<div class="service-featured_img">';
								echo ruffer_img_tag( array(
									'url'   => esc_url( $data['image']['url'] ),
								));
								if(!empty($data['icon']['url'])){
									echo '<div class="service-default-icon">';
										echo ruffer_img_tag( array(
											'url'   => esc_url( $data['icon']['url'] ),
										));
									echo '</div>';
								}
							echo '</div>';
							echo '<div class="service-featured_content">';
								if(!empty($data['title'])){
									echo '<h3 class="box-title"><a href="'.esc_url( $data['button_url']['url'] ).'">'.esc_html($data['title']).'</a></h3>';
								}
								if(!empty($data['description'])){
									echo '<p class="service-featured_text">'.esc_html($data['description']).'</p>';
								}
								if(!empty($data['button_text'])){
                                    echo '<a href="'.esc_url( $data['button_url']['url'] ).'" class="link-btn">'.wp_kses_post($data['button_text']).'<i class="fa-solid fa-arrow-up-right ms-2"></i></a>';
                                }
							echo '</div>';
						echo '</div>';
					echo '</div>';
				}
			echo '</div>';

		}elseif( $settings['layout_style'] == '6' ){
			echo '<div class="row gy-4">';
				if( $settings['video_position'] == 'yes' ){
					if(!empty($settings['video_image']['url'])){
						echo '<div class="col-12 order-3 order-lg-0">';
							echo '<div class="video-content" data-bg-src="'.esc_url( $settings['video_image']['url'] ).'">';
								if(!empty($settings['video_url']['url'])){
									echo '<a href="'.esc_url( $settings['video_url']['url'] ).'" class="play-btn popup-video style5"><i class="fas fa-play"></i></a>';
								}
							echo '</div>';
						echo '</div>';
					}
				}
				foreach( $settings['service_list'] as $data ){
					echo '<div class="col-lg-6 col-xl-12">';
						echo '<div class="service-box style4">';
							echo '<div class="service-box_content justify-content-center justify-content-md-start">';
								if(!empty($data['icon']['url'])){
									echo '<div class="service-default-icon">';
										echo ruffer_img_tag( array(
											'url'   => esc_url( $data['icon']['url'] ),
										));
									echo '</div>';
								}
								echo '<div>';
									if(!empty($data['title'])){
										echo '<h3 class="box-title"><a href="'.esc_url( $data['button_url']['url'] ).'">'.esc_html($data['title']).'</a></h3>';
									}
									if(!empty($data['description'])){
										echo '<p class="service-box_text">'.esc_html($data['description']).'</p>';
									}
									if(!empty($data['button_text'])){
										echo '<a href="'.esc_url( $data['button_url']['url'] ).'" class="link-btn">'.wp_kses_post($data['button_text']).'<i class="fa-solid fa-arrow-up-right ms-2"></i></a>';
									}
								echo '</div>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				}
				if( $settings['video_position'] != 'yes' ){
					if(!empty($settings['video_image']['url'])){
						echo '<div class="col-12">';
							echo '<div class="video-content" data-bg-src="'.esc_url( $settings['video_image']['url'] ).'">';
								if(!empty($settings['video_url']['url'])){
									echo '<a href="'.esc_url( $settings['video_url']['url'] ).'" class="play-btn popup-video style5"><i class="fas fa-play"></i></a>';
								}
							echo '</div>';
						echo '</div>';
					}
				}
			echo '</div>';

		}elseif( $settings['layout_style'] == '7' ){
            echo '<div class="row gy-5">';
				foreach( $settings['service_list2'] as $data ){
					echo '<div class="col-lg-6 col-xl-4">';
						echo '<div class="service-featured style5">';
							if(!empty($data['image']['url'])){
								echo '<div class="service-featured_img">';
									echo ruffer_img_tag( array(
										'url'   => esc_url( $data['image']['url'] ),
									));
								echo '</div>';
							}
							echo '<div class="service-featured_content">';
								if(!empty($data['icon']['url'])){
									echo '<div class="service-default-icon">';
										echo ruffer_img_tag( array(
											'url'   => esc_url( $data['icon']['url'] ),
										));
									echo '</div>';
								}
								if(!empty($data['title'])){
									echo '<h3 class="box-title"><a href="'.esc_url( $data['button_url']['url'] ).'">'.esc_html($data['title']).'</a></h3>';
								}
								echo '<div class="inner-content">';
									if(!empty($data['description'])){
										echo '<p class="service-featured_text">'.esc_html($data['description']).'</p>';
									}
									if(!empty($data['button_text'])){
										echo '<a href="'.esc_url( $data['button_url']['url'] ).'" class="link-btn">'.wp_kses_post($data['button_text']).'<i class="fa-solid fa-arrow-up-right ms-2"></i></a>';
									}
								echo '</div>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				}
            echo '</div>';

		}


	}

}