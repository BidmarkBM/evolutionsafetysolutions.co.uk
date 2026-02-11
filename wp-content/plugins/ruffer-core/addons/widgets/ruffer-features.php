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
 * Features Box Widget .
 *
 */
class Ruffer_Features extends Widget_Base {

	public function get_name() {
		return 'rufferfeatures';
	}
	public function get_title() {
		return __( 'Ruffer Features', 'ruffer' );
	}
	public function get_icon() {
		return 'eicon-code';
    }
	public function get_categories() {
		return [ 'ruffer' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'checklist_section',
			[
				'label' 	=> __( 'Features', 'ruffer' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );
        $this->add_control(
			'layout',
			[
				'label' 		=> __( 'Style', 'ruffer' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> '1',
				'options'		=> [
					'1'  			=> __( 'Style One', 'ruffer' ),
					'2' 			=> __( 'Style Two', 'ruffer' ),
					'3' 			=> __( 'Style Three', 'ruffer' ),
					'4' 			=> __( 'Style Four', 'ruffer' ),
					'5' 			=> __( 'Style Five', 'ruffer' ),
					'6' 			=> __( 'Style Six', 'ruffer' ),
					'7' 			=> __( 'Style Seven', 'ruffer' ),
					'8' 			=> __( 'Style Eight', 'ruffer' ),
					'9' 			=> __( 'Style Nine', 'ruffer' ),
					'10' 			=> __( 'Style Ten', 'ruffer' ),
					'11' 			=> __( 'Style Eleven', 'ruffer' ),
					'12' 			=> __( 'Style Twelve', 'ruffer' ),
					'13' 			=> __( 'Style Thirteen', 'ruffer' ),
					'14' 			=> __( 'Style fourteen', 'ruffer' ),
				],
			]
		);

        $repeater = new Repeater();

		$repeater->add_control(
			'title',
			[
				'label'     => __( 'Title', 'ruffer' ),
                'type'      => Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
			]
        );
        $repeater->add_control(
			'content',
			[
				'label'     => __( 'Content', 'ruffer' ),
                'type'      => Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
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
		$repeater->add_control(
			'url',
			[
				'label'     => __( 'URL', 'ruffer' ),
                'type'      => Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
			]
        );
        $this->add_control(
			'features',
			[
				'label' 		=> __( 'Steps', 'ruffer' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'title' 		=> __( 'title', 'ruffer' ),
					],
				],
				'condition'		=> [ 'layout' => [ '1','3' ,'7'] ],
			]
		);
         //-----------------------------style 2 -----------------------------2//
		$repeater = new Repeater();

		$repeater->add_control(
			'title',
			[
				'label'     => __( 'Title', 'ruffer' ),
                'type'      => Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
			]
        );
        $repeater->add_control(
			'url',
			[
				'label'     => __( 'URL', 'ruffer' ),
                'type'      => Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
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
			'features2',
			[
				'label' 		=> __( 'Steps', 'ruffer' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'title' 		=> __( 'title', 'ruffer' ),
					],
				],
				'condition'		=> [ 'layout' => [ '2', '6' ] ],
			]
		);

		 //-----------------------------style 3 -----------------------------2//
		$repeater = new Repeater();

		$repeater->add_control(
			'title',
			[
				'label'     => __( 'Title', 'ruffer' ),
                'type'      => Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
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
		$repeater->add_control(
			'icon',
			[
				'label' 		=> __( 'Icon', 'ruffer' ),
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
			'features3',
			[
				'label' 		=> __( 'Steps', 'ruffer' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'title' 		=> __( 'title', 'ruffer' ),
					],
				],
				'condition'		=> [ 'layout' => [ '4','5' ] ],
			]
		);

		//-----------------------------style 4 -----------------------------2//
		$repeater = new Repeater();

		$repeater->add_control(
			'title',
			[
				'label'     => __( 'Title', 'ruffer' ),
				'type'      => Controls_Manager::TEXTAREA,
				'rows' 		=> 2,
			]
		);
		$repeater->add_control(
			'icon',
			[
				'label' 		=> __( 'Icon', 'ruffer' ),
				'type' 			=> Controls_Manager::MEDIA,
				'dynamic' 		=> [
					'active' 		=> true,
				],
			]
		);
		$this->add_control(
			'features4',
			[
				'label' 		=> __( 'Steps', 'ruffer' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'title' 		=> __( 'title', 'ruffer' ),
					],
				],
				'condition'		=> [ 'layout' => [ '8', '11', '12'] ],
			]
		);

		//-----------------------------style 9 -----------------------------2//
		$repeater = new Repeater();

		ruffer_media_fields( $repeater, 'icon', 'Choose Icon' );

		ruffer_general_fields( $repeater, 'title', 'Title', 'TEXTAREA2', '25' );
		ruffer_general_fields( $repeater, 'desc', 'Description', 'TEXTAREA', 'Years Of Experience' );

		$this->add_control(
			'features5',
			[
				'label' 		=> __( 'Steps', 'ruffer' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'title' 		=> __( 'title', 'ruffer' ),
					],
				],
				'condition'		=> [ 'layout' => [ '9', '10', '13', '14'] ],
			]
		);

        $this->end_controls_section();

		//---------------------------------------
			//Style Section Start
		//---------------------------------------
		ruffer_common_style2_fields( $this, '01', 'Title', '{{WRAPPER}} .title', ['1', '3', '4', '5', '8', '9', '10', '11', '12', '13', '14'] );
		ruffer_common2_style2_fields( $this, '011', 'Title', '{{WRAPPER}} .title a', ['2', '6', '7'] );
		ruffer_common_style2_fields( $this, '02', 'Description', '{{WRAPPER}} .desc', ['1', '3', '7', '9', '10', '13', '14'] );


	}

	protected function render() {

        $settings = $this->get_settings_for_display();

        if( $settings['layout'] == '1' ){
        	echo '<div class="about-feature-wrap">';
                foreach( $settings['features'] as $data ) {             
		            echo '<div class="about-feature">';
		            	if( ! empty( $data['image']['url'] ) ){
			                echo '<div class="about-feature_icon">';
			                    echo '<img src="'.$data['image']['url'].'" alt="Icon">';
			                echo '</div>';
			            }
		                echo '<div class="media-body">';
		                	if( ! empty( $data['title'] ) ){
			                    echo '<h3 class="about-feature_title title">'.esc_html( $data['title'] ).'</h3>';
			                }
			                if( ! empty( $data['content'] ) ){
			                    echo '<p class="about-feature_text desc">'.esc_html( $data['content'] ).'</p>';
			                }
		                echo '</div>';
		            echo '</div>';
		        }
	        echo '</div>';

	    }elseif( $settings['layout'] == '2' ){
	    	echo '<div class="row gy-30">';
                foreach( $settings['features2'] as $data ) {                   
	                echo '<div class="col-sm-6">';
	                    echo '<div class="wcu-box">';
	                    	if( ! empty( $data['image']['url'] ) ){
		                        echo '<div class="wcu-box_icon">';
		                            echo '<img src="'.$data['image']['url'].'" alt="img">';
		                        echo '</div>';
		                    }
		                    if( ! empty( $data['title'] ) ){
		                        echo '<div class="wcu-box_details">';
		                            echo '<h3 class="h5 wcu-box_title"><a href="'.esc_url( $data['url'] ).'">'.esc_html( $data['title'] ).'</a></h3>';
		                        echo '</div>';
		                    }
	                    echo '</div>';
	                echo '</div>';
	            }
            echo '</div>';

	    }elseif( $settings['layout'] == '3' ){
	    	 echo '<div class="row gy-30 justify-content-center">';
                foreach( $settings['features'] as $data ) {    
	                echo '<div class="col-sm-6 col-xl-4 col-lg-6 col-md-4">';
	                    echo '<div class="about-feature2">';
	                    	if( ! empty( $data['image']['url'] ) ){
		                        echo '<div class="feature_icon">';
		                            echo '<img src="'.$data['image']['url'].'" alt="Icon">';
		                        echo '</div>';
		                    }
	                        echo '<div class="media-body">';
	                        	if( ! empty( $data['title'] ) ){
	                           		echo ' <h3 class="box-title title">'.esc_html( $data['title'] ).'</h3>';
	                           	}
	                           	if( ! empty( $data['content'] ) ){
		                            echo '<p class="about-feature_text desc">'.esc_html( $data['content'] ).'</p>';
		                        }
	                        echo '</div>';
	                    echo '</div>';
	                echo '</div>';
	            }
            echo '</div>';

	    }elseif( $settings['layout'] == '4' ){
	    	echo '<div class="row gy-30 gx-30 justify-content-center">';
                foreach( $settings['features3'] as $data ) {  
	                echo '<div class="col-lg-4 col-md-6">';
	                	if( ! empty( $data['image']['url'] ) ){
		                    echo '<div class="feature-card style2 align-items-center" data-bg-src="'.$data['image']['url'].'" data-overlay="black" data-opacity="8">';
		                    	if( ! empty( $data['icon']['url'] ) ){
			                        echo '<div class="feature_icon">';
			                            echo '<img src="'.$data['icon']['url'].'" alt="Icon">';
			                        echo '</div>';
			                    }
			                    if( ! empty( $data['title'] ) ){
			                        echo '<div class="media-body">';
			                            echo '<h3 class="box-title mb-0 title">'.esc_html( $data['title'] ).'</h3>';
			                        echo '</div>';
			                    }
		                    echo '</div>';
		                }
	                echo '</div>';
	            }
            echo '</div>';

	    }elseif( $settings['layout'] == '5' ){
	    	echo '<div class="about-feature-wrap3 mb-40">';
                foreach( $settings['features3'] as $data ) {              
	                echo '<div class="about-feature3">';
	                	if( ! empty( $data['icon']['url'] ) ){
		                    echo '<div class="icon">';
		                        echo '<img src="'.$data['icon']['url'].'" alt="Icon">';
		                    echo '</div>';
		                }
		                if( ! empty( $data['title'] ) ){
		                    echo '<div class="media-body">';
		                        echo '<h3 class="about-feature_title title">'.esc_html( $data['title'] ).'</h3>';
		                    echo '</div>';
		                }
	                echo '</div>';
	            }
            echo '</div>';

	    }elseif( $settings['layout'] == '6' ){
	    	echo '<div class="row wcu-card-slider th-carousel" data-slide-show="3" data-ml-slide-show="2" data-md-slide-show="3" data-sm-slide-show="2" data-dots="false">';
                foreach( $settings['features2'] as $data ) {         
	                echo '<div class="col-sm-6">';
	                    echo '<div class="wcu-card style4">';
	                    	if( ! empty( $data['image']['url'] ) ){
		                        echo '<div class="wcu-card_icon">';
		                            echo '<img src="'.$data['image']['url'].'" alt="img">';
		                        echo '</div>';
		                    }
		                    if( ! empty( $data['title'] ) ){
		                        echo '<div class="wcu-card_details">';
		                            echo '<h3 class="h5 wcu-card_title title"><a href="'.esc_url( $data['url'] ).'">'.esc_html( $data['title'] ).'</a></h3>';
		                        echo '</div>';
		                    }
	                    echo '</div>';
	                echo '</div>';
	            }
            echo '</div>';

	    }elseif( $settings['layout'] == '7' ){
	    	echo '<div class="service-area-6 space-bottom">';
		        echo '<div class="container">';
		            echo '<div class="row slider-shadow th-carousel gx-30" data-slide-show="3" data-lg-slide-show="2" data-md-slide-show="2" data-sm-slide-show="1" data-xs-slide-show="1" data-adaptive-height="true">';
		                foreach( $settings['features'] as $data ) {  
			                echo '<div class="col-md-6 col-lg-4">';
			                    echo '<div class="service-box style3">';
			                        echo '<div class="service-box_content">';
			                        	if( ! empty( $data['image']['url'] ) ){
					                        echo '<div class="service-default-icon">';
					                            echo '<img src="'.$data['image']['url'].'" alt="Icon">';
					                        echo '</div>';
					                    }
					                    if( ! empty( $data['title'] ) ){
					                        echo '<h3 class="box-title title"><a href="'.esc_url( $data['url'] ).'">'.esc_html( $data['title'] ).'</a></h3>';
					                    }
			                            if( ! empty( $data['content'] ) ){
				                            echo '<p class="service-box_text desc">'.esc_html( $data['content'] ).'</p>';
				                        }
			                        echo '</div>';
			                    echo '</div>';
			                echo '</div>';
			            }
		            echo '</div>';
		        echo '</div>';
		    echo '</div>';

	    }elseif( $settings['layout'] == '8' ){
			echo '<div class="about-feature-wrap4">';
				foreach( $settings['features4'] as $data ) {  
					echo '<div class="about-feature3">';
						if( ! empty( $data['icon']['url'] ) ){
							echo '<div class="icon">';
								echo '<img src="'.$data['icon']['url'].'" alt="Icon">';
							echo '</div>';
						}
						if( ! empty( $data['title'] ) ){
							echo '<div class="media-body">';
								echo '<h3 class="about-feature_title title">'.esc_html( $data['title'] ).'</h3>';
							echo '</div>';
						}
					echo '</div>';
				}
			echo '</div>';

		}elseif( $settings['layout'] == '9' ){
			echo '<div class="row gy-5 gx-30">';
				foreach( $settings['features5'] as $data ) {  
					echo '<div class="col-md-6">';
						echo '<div class="card variant-1">';
							echo '<div class="card-body">';
								if($data['icon']['url'] ){
									echo '<div class="card-icon">';
										echo ruffer_img_tag( array(
											'url'   => esc_url( $data['icon']['url'] ),
										));
									echo '</div>';
								}
								if( ! empty( $data['title'] ) ){
									echo '<h5 class="title">'.esc_html( $data['title'] ).'</h5>';
								}
								if( ! empty( $data['desc'] ) ){
									echo '<p class="m-0 desc">'.esc_html( $data['desc'] ).'</p>';
								}
							echo '</div>';
						echo '</div>';
					echo '</div>';
				}
			echo '</div>';
 
		}elseif( $settings['layout'] == '10' ){
			echo '<div class="row gy-5 gy-xl-4 gx-5 mt-4 mt-sm-0 ms-lg-2">';
				foreach( $settings['features5'] as $data ) {  
					echo '<div class="col-lg-6 col-xl-12">';
						echo '<div class="card variant-3">';
							echo '<div class="card-body">';
								if($data['icon']['url'] ){
									echo '<div class="card-icon">';
										echo ruffer_img_tag( array(
											'url'   => esc_url( $data['icon']['url'] ),
										));
									echo '</div>';
								}
								if( ! empty( $data['title'] ) ){
									echo '<h5 class="title">'.esc_html( $data['title'] ).'</h5>';
								}
								if( ! empty( $data['desc'] ) ){
									echo '<p class="m-0 desc">'.esc_html( $data['desc'] ).'</p>';
								}
							echo '</div>';
						echo '</div>';
					echo '</div>';
				}
			echo '</div>';

		}elseif( $settings['layout'] == '11' ){
			echo '<div class="row justify-content-center justify-content-xl-start mt-sm-5 g-sm-5 g-xl-3">';
				foreach( $settings['features4'] as $data ) {  
					echo '<div class="col-sm-4">';
						echo '<div class="hut d-none d-sm-block">';
							echo '<div class="hut-bg-mask">';
								echo '<svg width="190" height="180" viewBox="0 0 190 180" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M187.48 65.5866L163.96 65.5934L163.46 65.5935V66.0934V123.047V179.5H25.5854V86.7894V66.0934V65.5934H25.0854H1.56849C1.9486 65.3281 2.33027 65.0657 2.71319 64.8065L2.71935 64.8022L94.5231 0.610105C105.048 7.96872 115.593 15.3074 126.139 22.6471C146.628 36.9056 167.121 51.1677 187.48 65.5866Z" fill="white" stroke="#E6E6E6" />
								</svg>';
							echo '</div>';
							echo '<div class="hut-content">';
								if( ! empty( $data['icon']['url'] ) ){
									echo '<div class="hut-icon">';
										echo '<img src="'.$data['icon']['url'].'" alt="'.esc_attr__('Icon', 'ruffer').'">';
									echo '</div>';
								}
								if( ! empty( $data['title'] ) ){
									echo '<h4 class="hut-title title">'.esc_html( $data['title'] ).'</h4>';
								}
							echo '</div>';
						echo '</div>';
					echo '</div>';
				}
			echo '</div>';

		}elseif( $settings['layout'] == '12' ){
			echo '<div class="about-feature-wrap3">';
				foreach( $settings['features4'] as $data ) {  
					echo '<div class="about-feature3">';
						if( ! empty( $data['icon']['url'] ) ){
							echo '<div class="hicon">';
								echo '<img src="'.$data['icon']['url'].'" alt="'.esc_attr__('Icon', 'ruffer').'">';
							echo '</div>';
						}
						if( ! empty( $data['title'] ) ){
						echo '<div class="media-body">';
							echo '<h3 class="about-feature_title title">'.esc_html( $data['title'] ).'</h3>';
						echo '</div>';
						}
					echo '</div>';
				}
			echo '</div>';

		}elseif( $settings['layout'] == '13' ){
			echo '<div class="about-feature-wrap5">';
				foreach( $settings['features5'] as $data ) {  
					echo '<div class="about-feature3">';
						if($data['icon']['url'] ){
							echo '<div class="card-icon">';
								echo ruffer_img_tag( array(
									'url'   => esc_url( $data['icon']['url'] ),
								));
							echo '</div>';
						}
						echo '<div class="media-body">';
							if( ! empty( $data['title'] ) ){
								echo '<h5 class="about-feature_title title">'.esc_html( $data['title'] ).'</h5>';
							}
							if( ! empty( $data['desc'] ) ){
								echo '<p class="desc">'.esc_html( $data['desc'] ).'</p>';
							}
						echo '</div>';
					echo '</div>';
				}
			echo '</div>';

		}elseif( $settings['layout'] == '14' ){
			foreach( $settings['features5'] as $data ) {  
				echo '<div class="card variant-5">';
					echo '<div class="card-body">';
						if($data['icon']['url'] ){
							echo '<div class="card-icon">';
								echo ruffer_img_tag( array(
									'url'   => esc_url( $data['icon']['url'] ),
								));
							echo '</div>';
						}
						echo '<div>';
							if( ! empty( $data['title'] ) ){
								echo '<h3 class="card-title title">'.esc_html( $data['title'] ).'</h3>';
							}
							if( ! empty( $data['desc'] ) ){
								echo '<p class="m-0 desc">'.esc_html( $data['desc'] ).'</p>';
							}
						echo '</div>';
					echo '</div>';
				echo '</div>';
			}

		}


	}
}