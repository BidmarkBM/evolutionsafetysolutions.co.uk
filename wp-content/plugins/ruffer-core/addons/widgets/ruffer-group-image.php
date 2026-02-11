<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Border;
/**
 *
 * Image Widget .
 *
 */
class Ruffer_Group_Image extends Widget_Base {

	public function get_name() {
		return 'ruffergroupimage';
	}

	public function get_title() {
		return __( 'Ruffer Group Image', 'ruffer' );
	}


	public function get_icon() {
		return 'eicon-code';
    }


	public function get_categories() {
		return [ 'ruffer' ];
	}


	protected function register_controls() {

		$this->start_controls_section(
			'image_section',
			[
				'label' 	=> __( 'Group Image', 'ruffer' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );
        $this->add_control(
			'iamge_style',
			[
				'label' 	=> __( 'Group Style', 'ruffer' ),
				'type' 		=> Controls_Manager::SELECT,
				'default' 	=> '1',
				'options' 	=> [
					'1'  		=> __( 'Style One', 'ruffer' ),
					'2' 		=> __( 'Style Two', 'ruffer' ),
					'3' 		=> __( 'Style Three', 'ruffer' ),
					'4' 		=> __( 'Style Four', 'ruffer' ),
					'5' 		=> __( 'Style Five', 'ruffer' ),
					'6' 		=> __( 'Style Six', 'ruffer' ),
					'7' 		=> __( 'Style Seven', 'ruffer' ),
					'8' 		=> __( 'Style Eight', 'ruffer' ),
					'9' 		=> __( 'Style Nine', 'ruffer' ),
					'10' 		=> __( 'Style Ten', 'ruffer' ),
					'11' 		=> __( 'Style Eleven', 'ruffer' ),
					'12' 		=> __( 'Style Twelve', 'ruffer' ),
				],
			]
		);

        $this->add_control(
			'image1',
			[
				'label' 		=> __( 'Image 1', 'ruffer' ),
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
			'image2',
			[
				'label' 		=> __( 'Image 2', 'ruffer' ),
				'type' 			=> Controls_Manager::MEDIA,
				'dynamic' 		=> [
					'active' 		=> true,
				],
				'default' 		=> [
					'url' 			=> Utils::get_placeholder_image_src(),
				],
				'condition'		=> [ 'iamge_style' => [ '1','2','3', '5','6','7', '8', '9', '10', '11' ] ],
			]
		);
		$this->add_control(
			'image3',
			[
				'label' 		=> __( 'Image 3', 'ruffer' ),
				'type' 			=> Controls_Manager::MEDIA,
				'dynamic' 		=> [
					'active' 		=> true,
				],
				'condition'		=> [ 'iamge_style' => [ '2', '6','7', '11' ] ],
			]
		);
		$this->add_control(
			'image4',
			[
				'label' 		=> __( 'Image 4', 'ruffer' ),
				'type' 			=> Controls_Manager::MEDIA,
				'dynamic' 		=> [
					'active' 		=> true,
				],
				'condition'		=> [ 'iamge_style' => [ '2','7', '11' ] ],
			]
		);
		$this->add_control(
			'image5',
			[
				'label' 		=> __( 'Image 5', 'ruffer' ),
				'type' 			=> Controls_Manager::MEDIA,
				'dynamic' 		=> [
					'active' 		=> true,
				],
				'condition'		=> [ 'iamge_style' => [ '11' ] ],
			]
		);
		
		$this->add_control(
			'counter_area',
			[
				'label' 		=> __( 'Counter Area', 'ruffer' ),
				'type' 			=> Controls_Manager::WYSIWYG,
				'default'  	=> __( 'BEST CAR DEALER AWARD', 'ruffer' ),
				'condition'		=> [ 'iamge_style' => [ '1', '4', '6', '10', '11', '12' ] ],
			]
		);
		$this->add_control(
			'counter_label',
			[
				'label' 		=> __( 'Counter Label', 'ruffer' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'rows' 			=> 2,
				'default'  	=> __( 'BEST CAR DEALER AWARD', 'ruffer' ),
				'condition'		=> [ 'iamge_style' => ['4', '10', '11', '12' ] ],
			]
		);
		$this->add_control(
			'curve',
			[
				'label' 		=> __( 'Curve Text', 'ruffer' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'rows' 			=> 2,
				'default'  	=> __( 'BEST CAR DEALER AWARD', 'ruffer' ),
				'condition'		=> [ 'iamge_style' => ['7' ] ],
			]
		);
		$this->add_control(
			'title',
			[
				'label' 		=> __( 'Text', 'ruffer' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'rows' 			=> 2,
				'default'  	=> __( 'Globally Clients', 'ruffer' ),
				'condition'		=> [ 'iamge_style' => ['11' ] ],
			]
		);
		$this->add_control(
			'video_url',
			[
				'label' 		=> __( 'Video URL', 'ruffer' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'default'  		=> __( 'BEST CAR DEALER AWARD', 'ruffer' ),
				'rows' 			=> 2,
				'condition'		=> [ 'iamge_style' => [ '3'] ],
			]
		);
		$this->add_control(
			'video_url2',
			[
				'label' 		=> esc_html__( 'Video Link', 'ruffer' ),
				'type' 			=> Controls_Manager::URL,
				'placeholder' 	=> esc_html__( 'https://your-link.com', 'ruffer' ),
				'show_external' => true,
				'default' 		=> [
					'url' 			=> '#',
					'is_external' 	=> false,
					'nofollow' 		=> false,
				],
				'condition'		=> [ 'iamge_style' => [ '9'] ],
			]
		);
		
        $this->end_controls_section();
	}

	protected function render() {

        $settings = $this->get_settings_for_display();

        if( $settings['iamge_style'] == '1' ){
        	echo '<div class="img-box1">';
        		if (!empty( $settings['image1']['url'] )) {
	                echo '<div class="img1">';
	                    echo '<img class="tilt-active" src="'.esc_url( $settings['image1']['url']  ).'" alt="About">';
	                echo '</div>';
	            }
                if( !empty( $settings['counter_area'] ) ){
                	echo wp_kses_post( $settings['counter_area'] );
                }

                if (!empty( $settings['image2']['url'] )) {
	                echo '<div class="img2">';
	                    echo '<img class="tilt-active" src="'.esc_url( $settings['image2']['url']  ).'" alt="About">';
	                echo '</div>';
	            }
            echo '</div>';  

	    }elseif( $settings['iamge_style'] == '2' ){
	    	echo '<div class="img-box2 pb-50">';
	    		if (!empty( $settings['image1']['url'] )) {
		            echo '<div class="img1">';
		                echo '<img class="tilt-active" src="'.esc_url( $settings['image1']['url']  ).'" alt="About">';
		            echo '</div>';
		        }
		        if (!empty( $settings['image2']['url'] )) {
		            echo '<div class="img2">';
		                echo '<img class="tilt-active" src="'.esc_url( $settings['image2']['url']  ).'" alt="About">';
		            echo '</div>';
		        }
		        if (!empty( $settings['image3']['url'] )) {
		            echo '<div class="img3">';
		                echo '<img class="tilt-active" src="'.esc_url( $settings['image3']['url']  ).'" alt="About">';
		            echo '</div>';
		        }
		        if (!empty( $settings['image4']['url'] )) {
		            echo '<div class="shape1 shape-mockup jump" data-bottom="0" data-left="0">';
		                echo '<img src="'.esc_url( $settings['image4']['url']  ).'" alt="About">';
		            echo '</div>';
		        }
	        echo '</div>';

	    }elseif( $settings['iamge_style'] == '3' ){
	    	echo '<div class="img-box3">';
	    		if (!empty( $settings['image1']['url'] )) {
		            echo '<img class="img-1 tilt-active" src="'.esc_url( $settings['image1']['url']  ).'" alt="About">';
		        }
		        if (!empty( $settings['image2']['url'] )) {
		            echo '<img class="img-2 tilt-active" src="'.esc_url( $settings['image2']['url']  ).'" alt="About">';
		        }
		        if( !empty( $settings['video_url'] ) ){
		            echo '<a href="'.esc_url( $settings['video_url'] ).'" class="play-btn popup-video style5" tabindex="0"><i class="fas fa-play"></i></a>';
		        }
	        echo '</div>';

	    }elseif( $settings['iamge_style'] == '4' ){
	    	echo '<div class="img-box4">';
	    		if (!empty( $settings['image1']['url'] )) {
	                echo '<div class="img1">';
	                    echo '<img src="'.esc_url( $settings['image1']['url']  ).'" alt="Why">';
	                echo '</div>';
	            }
                echo '<div class="customer-wrap">';
                    echo '<div class="customer-wrap-icon"><img src="'.RUFFER_PLUGDIRURI . 'assets/img/customer-check-icon.svg" alt="icon"></div>';
                    if( !empty( $settings['counter_area'] ) ){
	                    echo '<h2 class="customer-wrap-title">'.wp_kses_post( $settings['counter_area'] ).'</h2>';
	                }
	                if( !empty( $settings['counter_label'] ) ){
	                    echo '<p class="customer-wrap-text">'.wp_kses_post( $settings['counter_label'] ).'</p>';
	                }
                echo '</div>';
            echo '</div>';

	    }elseif( $settings['iamge_style'] == '5' ){
	    	echo '<div class="award-thumb">';
	    		if (!empty( $settings['image1']['url'] )) {
	                echo '<div class="thumb"><img src="'.esc_url( $settings['image1']['url']  ).'" alt="img"></div>';
	            }
	            if (!empty( $settings['image2']['url'] )) {
	                echo '<div class="award"><img src="'.esc_url( $settings['image2']['url']  ).'" alt="img"></div>';
	            }
            echo '</div>';

	    }elseif( $settings['iamge_style'] == '6' ){
	    	echo '<div class="img-box5">';
	    		if (!empty( $settings['image1']['url'] )) {
	                echo '<div class="img1">';
	                    echo '<img class="tilt-active" src="'.esc_url( $settings['image1']['url']  ).'" alt="About">';
	                echo '</div>';
	            }
                echo '<div class="about-grid bg-title">';
                if( !empty( $settings['counter_area'] ) ){
                 	echo wp_kses_post( $settings['counter_area'] );
                }  

                echo '</div>';
                if (!empty( $settings['image2']['url'] )) {
	                echo '<div class="img2">';
	                    echo '<img class="tilt-active" src="'.esc_url( $settings['image2']['url']  ).'" alt="About">';
	                echo '</div>';
	            }
	            if (!empty( $settings['image3']['url'] )) {
	                echo '<div class="shape1 shape-mockup jump" data-bottom="0" data-left="-46px">';
	                    echo '<img src="'.esc_url( $settings['image3']['url']  ).'" alt="About">';
	                echo '</div>';
	            }
            echo '</div>';

	    }elseif( $settings['iamge_style'] == '7' ){
	    	echo '<div class="img-box6">';
	    		if (!empty( $settings['image1']['url'] )) {
	                echo '<div class="img2">';
	                    echo '<img class="tilt-active" src="'.esc_url( $settings['image1']['url']  ).'" alt="About">';
	                echo '</div>';
	            }
	            if (!empty( $settings['image2']['url'] )) {
	                echo '<div class="img1">';
	                    echo '<img class="tilt-active" src="'.esc_url( $settings['image2']['url']  ).'" alt="About">';
	                echo '</div>';
	            }
	            if (!empty( $settings['image3']['url'] )) {
	                echo '<div class="shape1 shape-mockup jump" data-bottom="0" data-left="-46px">';
	                    echo '<img src="'.esc_url( $settings['image3']['url']  ).'" alt="About">';
	                echo '</div>';
	            }
	            if (!empty( $settings['image4']['url'] )) {
	                echo '<div class="about-experience-wrap">';
	                    echo '<div class="about-experience-icon">';
	                        echo '<img src="'.esc_url( $settings['image4']['url']  ).'" alt="img">';
	                    echo '</div>';
	                    if( !empty( $settings['curve'] ) ){
		                    echo '<div class="about-experience-tag">';
		                        echo '<span class="about-title-anime">'.esc_html( $settings['curve'] ).'</span>';
		                   echo ' </div>';
		               }
	                echo '</div>';
	            }
            echo '</div>';

	    }elseif( $settings['iamge_style'] == '8' ){
	    	echo '<div class="testi-thumb5">';
	    		if (!empty( $settings['image1']['url'] )) {
	                echo '<div class="img1">';
	                    echo '<img src="'.esc_url( $settings['image1']['url']  ).'" alt="img">';
	                echo '</div>';
	            }
	            if (!empty( $settings['image2']['url'] )) {
	                echo '<div class="img2">';
	                    echo '<img src="'.esc_url( $settings['image2']['url']  ).'" alt="img">';
	                echo '</div>';
	            }
            echo '</div>';

	    }elseif( $settings['iamge_style'] == '9' ){
			echo '<div class="img-box7">';
				if (!empty( $settings['image1']['url'] )) {
					echo '<div class="img1">';
						echo '<img class="tilt-active" src="'.esc_url( $settings['image1']['url']  ).'" alt="img">';
					echo '</div>';
				}
				if (!empty( $settings['image2']['url'] )) {
					echo '<div class="img2">';
						echo '<img class="tilt-active" src="'.esc_url( $settings['image2']['url']  ).'" alt="img">';
					echo '</div>';
				}
				if( !empty( $settings['video_url2']['url'] ) ){
		            echo '<a href="'.esc_url( $settings['video_url2']['url'] ).'" class="play-btn style5 popup-video" tabindex="0"><i class="fas fa-play"></i></a>';
		        }
			echo '</div>';

		}elseif( $settings['iamge_style'] == '10' ){ 
			echo '<div class="experience2-thumb">';
				if (!empty( $settings['image1']['url'] )) {
					echo '<img src="'.esc_url( $settings['image1']['url'] ).'" alt="img">';
				}
				echo '<div class="customer-wrap">';
					if( !empty( $settings['counter_area'] ) ){
						echo '<h2 class="customer-wrap-title">';
							echo wp_kses_post( $settings['counter_area'] );
						echo '</h2>';

					}
					if( !empty( $settings['counter_label'] ) ){
	                    echo '<p class="customer-wrap-text">'.wp_kses_post( $settings['counter_label'] ).'</p>';
	                }
					if (!empty( $settings['image2']['url'] )) {
						echo '<div class="customer-wrap-icon">';
							echo '<img src="'.esc_url( $settings['image2']['url']  ).'" alt="About">';
						echo '</div>';
					}
				echo '</div>';
			echo '</div>';

		}elseif( $settings['iamge_style'] == '11' ){
			echo '<div class="img-box8">';
				if (!empty( $settings['image1']['url'] )) {
					echo '<div class="img1">';
						echo '<img class="tilt-active" src="'.esc_url( $settings['image1']['url'] ).'" alt="About">';
					echo '</div>';
				}
				if (!empty( $settings['image2']['url'] )) {
					echo '<div class="img2">';
						echo '<img class="tilt-active" src="'.esc_url( $settings['image2']['url'] ).'" alt="About">';
					echo '</div>';
				}
				if (!empty( $settings['image3']['url'] )) {
					echo '<div class="img3">';
						echo '<img class="tilt-active" src="'.esc_url( $settings['image3']['url'] ).'" alt="About">';
					echo '</div>';
				}
				echo '<div class="about-grid" data-bg-src="'.esc_url( $settings['image5']['url'] ).'">';
					if( !empty( $settings['counter_area'] ) ){
						echo '<h3 class="about-grid_year">';
							echo wp_kses_post( $settings['counter_area'] );
						echo '</h3>';
					}
					if( !empty( $settings['counter_label'] ) ){
	                    echo '<p class="about-grid_text">'.wp_kses_post( $settings['counter_label'] ).'</p>';
	                }
					if (!empty( $settings['image4']['url'] )) {
						echo '<img class="about-grid_thumb" src="'.esc_url( $settings['image4']['url'] ).'" alt="about">';
					}
					if( !empty( $settings['title'] ) ){
	                    echo '<p class="about-grid_text">'.wp_kses_post( $settings['title'] ).'</p>';
	                }
				echo '</div>';
			echo '</div>';

		}else{
			echo '<div class="map-thumb">';
				if (!empty( $settings['image1']['url'] )) {
					echo '<img src="'.esc_url( $settings['image1']['url'] ).'" alt="About">';
				}
				echo '<div class="map-branch">';
					if( !empty( $settings['counter_area'] ) ){
						echo '<h3 class="map-branch_num">';
							echo wp_kses_post( $settings['counter_area'] );
						echo '</h3>';
					}
					if( !empty( $settings['counter_label'] ) ){
	                    echo '<p class="map-branch_text">'.wp_kses_post( $settings['counter_label'] ).'</p>';
	                }
				echo '</div>';
			echo '</div>';

		}


	}

}