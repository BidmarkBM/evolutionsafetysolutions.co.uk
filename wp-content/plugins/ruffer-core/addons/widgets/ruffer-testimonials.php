<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;
use \Elementor\Repeater;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Box_Shadow;
/**
 *
 * Testimonial Slider Widget .
 *
 */
class Ruffer_Testimonial_Slider extends Widget_Base{

	public function get_name() {
		return 'ruffertestimonialslider';
	}
	public function get_title() {
		return __( 'Testimonial Slider', 'ruffer' );
	}
	public function get_icon() {
		return 'eicon-code';
    }
	public function get_categories() {
		return [ 'ruffer' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'testimonial_slider_section',
			[
				'label' 	=> __( 'Testimonial Slider', 'ruffer' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'layout',
			[
				'label' 		=> __( 'Testimonial Style', 'ruffer' ),
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
				],
			]
		);
		$this->add_control(
			'subtitle', [
				'label' 		=> __( 'Subtitle', 'ruffer' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'rows' 			=> 2,
				'default' 		=> __( 'Testimonial' , 'ruffer' ),
				'label_block' 	=> true,
				'condition'		=> [ 'layout' => [ '1', '9', '10' ] ],
			]
        );
		$this->add_control(
			'title', [
				'label' 		=> __( 'Title', 'ruffer' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'rows' 			=> 2,
				'default' 		=> __( 'Sheltering Dream One Roof at a Time' , 'ruffer' ),
				'label_block' 	=> true,
				'condition'		=> [ 'layout' => [ '1', '9', '10' ] ],
			]
        );
		
		//----------------------------feddback repeter start--------------------------------//
		$repeater = new Repeater();

		$repeater->add_control(
			'client_image',
			[
				'label' 		=> __( 'Client Image', 'ruffer' ),
				'type' 			=> Controls_Manager::MEDIA,
				'default' 		=> [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
		$repeater->add_control(
			'client_name', [
				'label' 		=> __( 'Client Name', 'ruffer' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'rows' 			=> 2,
				'default' 		=> __( 'Rubaida Kanom' , 'ruffer' ),
				'label_block' 	=> true,
			]
        );
		$repeater->add_control(
			'client_designation', [
				'label' 		=> __( 'Client Designation', 'ruffer' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'rows' 			=> 2,
				'default' 		=> __( 'Chef Leader' , 'ruffer' ),
				'label_block' 	=> true,
			]
        );
        $repeater->add_control(
			'client_feedback', [
				'label' 		=> __( 'Client Feedback', 'ruffer' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'default' 		=> __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco ' , 'ruffer' ),
				'label_block' 	=> true,
			]
		);
		$repeater->add_control(
			'client_rating',
			[
				'label' 	=> __( 'Client Rating', 'plumer' ),
				'type' 		=> Controls_Manager::SELECT,
				'default' 	=> '5',
				'options' 	=> [
					'one'  		=> __( 'One Star', 'plumer' ),
					'two' 		=> __( 'Two Star', 'plumer' ),
					'three' 	=> __( 'Three Star', 'plumer' ),
					'four' 		=> __( 'Four Star', 'plumer' ),
					'five' 	 	=> __( 'Five Star', 'plumer' ),
				],
			]
		);
		$this->add_control(
			'slides',
			[
				'label' 		=> __( 'Slides', 'ruffer' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'client_name' 		=> __( 'Rubaida Kanom', 'ruffer' ),
						'client_feedback' 	=> __( '“Synergistically transform 24/7 schemas extensible synergy. Progressively develop inexpensive catalysts for change before transparent customer service.”', 'ruffer' ),
						'client_image' 		=> Utils::get_placeholder_image_src(),
					],
					[
						'client_name' 		=> __( 'Rubaida Kanom', 'ruffer' ),
						'client_feedback' 	=> __( '“Synergistically transform 24/7 schemas extensible synergy. Progressively develop inexpensive catalysts for change before transparent customer service.”', 'ruffer' ),
						'client_image' 		=> Utils::get_placeholder_image_src(),
					],
					[
						'client_name' 		=> __( 'Rubaida Kanom', 'ruffer' ),
						'client_feedback' 	=> __( '“Synergistically transform 24/7 schemas extensible synergy. Progressively develop inexpensive catalysts for change before transparent customer service.”', 'ruffer' ),
						'client_image' 		=> Utils::get_placeholder_image_src(),
					],
				],
				'title_field' 	=> '{{{ client_name }}}',
				'condition'		=> [ 
					'layout' => [ '1', '2' , '4', '5', '6', '9', '10', '11', '12'] 
				],
			]
		);

		//----------------------------feddback repeter start 2--------------------------------//

		$repeater = new Repeater();

		$repeater->add_control(
			'client_image',
			[
				'label' 		=> __( 'Client Image', 'ruffer' ),
				'type' 			=> Controls_Manager::MEDIA,
				'default' 		=> [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
		$repeater->add_control(
			'client_name', [
				'label' 		=> __( 'Client Name', 'ruffer' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'rows' 			=> 2,
				'default' 		=> __( 'Rubaida Kanom' , 'ruffer' ),
				'label_block' 	=> true,
			]
        );
		$repeater->add_control(
			'client_designation', [
				'label' 		=> __( 'Client Designation', 'ruffer' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'rows' 			=> 2,
				'default' 		=> __( 'Chef Leader' , 'ruffer' ),
				'label_block' 	=> true,
			]
        );
        $repeater->add_control(
			'feedback_title', [
				'label' 		=> __( 'Feedback Title', 'ruffer' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'rows' 			=> 2,
				'default' 		=> __( 'Rubaida Kanom' , 'ruffer' ),
				'label_block' 	=> true,
			]
        );
        $repeater->add_control(
			'client_feedback', [
				'label' 		=> __( 'Client Feedback', 'ruffer' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'default' 		=> __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco ' , 'ruffer' ),
				'label_block' 	=> true,
			]
		);
		$repeater->add_control(
			'client_rating',
			[
				'label' 	=> __( 'Client Rating', 'plumer' ),
				'type' 		=> Controls_Manager::SELECT,
				'default' 	=> '5',
				'options' 	=> [
					'one'  		=> __( 'One Star', 'plumer' ),
					'two' 		=> __( 'Two Star', 'plumer' ),
					'three' 	=> __( 'Three Star', 'plumer' ),
					'four' 		=> __( 'Four Star', 'plumer' ),
					'five' 	 	=> __( 'Five Star', 'plumer' ),
				],
			]
		);
		$this->add_control(
			'slides_2',
			[
				'label' 		=> __( 'Slides', 'ruffer' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'client_name' 		=> __( 'Rubaida Kanom', 'ruffer' ),
						'client_feedback' 	=> __( '“Synergistically transform 24/7 schemas extensible synergy. Progressively develop inexpensive catalysts for change before transparent customer service.”', 'ruffer' ),
						'client_image' 		=> Utils::get_placeholder_image_src(),
					],
					[
						'client_name' 		=> __( 'Rubaida Kanom', 'ruffer' ),
						'client_feedback' 	=> __( '“Synergistically transform 24/7 schemas extensible synergy. Progressively develop inexpensive catalysts for change before transparent customer service.”', 'ruffer' ),
						'client_image' 		=> Utils::get_placeholder_image_src(),
					],
					[
						'client_name' 		=> __( 'Rubaida Kanom', 'ruffer' ),
						'client_feedback' 	=> __( '“Synergistically transform 24/7 schemas extensible synergy. Progressively develop inexpensive catalysts for change before transparent customer service.”', 'ruffer' ),
						'client_image' 		=> Utils::get_placeholder_image_src(),
					],
				],
				'title_field' 	=> '{{{ client_name }}}',
				'condition'		=> [ 'layout' => [ '3', '8' ] ],
			]
		);

		//----------------------------feddback repeter start 3--------------------------------//
		$repeater = new Repeater();

		$repeater->add_control(
			'client_image',
			[
				'label' 		=> __( 'Client Image', 'ruffer' ),
				'type' 			=> Controls_Manager::MEDIA,
				'default' 		=> [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
		$repeater->add_control(
			'client_name', [
				'label' 		=> __( 'Client Name', 'ruffer' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'rows' 			=> 2,
				'default' 		=> __( 'Rubaida Kanom' , 'ruffer' ),
				'label_block' 	=> true,
			]
		);
		$repeater->add_control(
			'client_designation', [
				'label' 		=> __( 'Client Designation', 'ruffer' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'rows' 			=> 2,
				'default' 		=> __( 'Chef Leader' , 'ruffer' ),
				'label_block' 	=> true,
			]
		);
		$repeater->add_control(
			'client_feedback', [
				'label' 		=> __( 'Client Feedback', 'ruffer' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'default' 		=> __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco ' , 'ruffer' ),
				'label_block' 	=> true,
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
			'linkedin_link',
			[
				'label' 		=> esc_html__( 'Linkedin Link', 'ruffer' ),
				'type' 			=> Controls_Manager::URL,
				'placeholder' 	=> esc_html__( 'https://your-link.com', 'ruffer' ),
				'show_external' => true,
			]
		);

		$this->add_control(
			'slides_3',
			[
				'label' 		=> __( 'Slides', 'ruffer' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'client_name' 		=> __( 'Rubaida Kanom', 'ruffer' ),
						'client_feedback' 	=> __( '“Synergistically transform 24/7 schemas extensible synergy. Progressively develop inexpensive catalysts for change before transparent customer service.”', 'ruffer' ),
						'client_image' 		=> Utils::get_placeholder_image_src(),
					],
				],
				'title_field' 	=> '{{{ client_name }}}',
				'condition'		=> [ 'layout' => [ '7' ] ],
			]
		);

		$this->add_control(
			'quote',
			[
				'label' 		=> __( 'Quote Image', 'ruffer' ),
				'type' 			=> Controls_Manager::MEDIA,
				'default' 		=> [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition'		=> [ 'layout' => [ '1', '2', '4','5', '6', '7', '8', '9', '10', '11' ] ],
			]
		);
		$this->add_control(
			'shape_img',
			[
				'label' 		=> __( 'Shape Image', 'ruffer' ),
				'type' 			=> Controls_Manager::MEDIA,
				'default' 		=> [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition'		=> [ 'layout' => [ '8', '10' ] ],
			]
		);

		$this->end_controls_section();

        //---------------------------------------
			//Style Section Start
		//---------------------------------------
		ruffer_common_style2_fields( $this, '011', 'Section Subtitle', '{{WRAPPER}} .sub-title', ['9', '10'] );
		ruffer_common_style2_fields( $this, '012', 'Section Title', '{{WRAPPER}} .sec-title', ['9', '10'] );

		ruffer_common_style2_fields( $this, '01', 'Name', '{{WRAPPER}} .n-name' );
		ruffer_common_style2_fields( $this, '02', 'Designation', '{{WRAPPER}} .d-desig' );
		ruffer_common_style2_fields( $this, '03', 'Feedback', '{{WRAPPER}} .f-text' );
		ruffer_common_style2_fields( $this, '04', 'Feedback', '{{WRAPPER}} .f-title', ['3', '8'] );

	}

	protected function render() {

		$settings = $this->get_settings_for_display();

		if( $settings['layout'] == '1' ){
			echo '<div class="row">';
                echo '<div class="col-xl-4">';
                    echo '<div class="text-xl-start text-center">';
                        echo '<div class="title-area mb-35">';
                        	if( !empty( $settings['title'] ) ){
	                            echo '<span class="sub-title">'.esc_html( $settings['title'] ).'</span>';
	                        }
	                        if( !empty( $settings['subtitle'] ) ){
	                            echo '<h2 class="sec-title text-white">'.esc_html( $settings['subtitle'] ).'</h2>';
	                        }
                        echo '</div>';
                        echo '<div class="testimonial-slider-arrow1">';
                            echo '<button data-slick-prev="#testimonial-slider1" class="slick-arrow slick-prev"><i class="fa-regular fa-arrow-left-long"></i></button>';
                            echo '<button data-slick-next="#testimonial-slider1" class="slick-arrow slick-next"><i class="fa-regular fa-arrow-right-long"></i></button>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
                echo '<div class="col-xl-8 mt-40 mt-xl-0">';
                    echo '<div class="th-carousel testi-slider1 row" id="testimonial-slider1" data-slide-show="2" data-ml-slide-show="1" data-lg-slide-show="1" data-md-slide-show="1" data-dots="false" data-arrows="false">';

                        foreach( $settings['slides'] as $singleslide ) { 
	                        echo '<div class="col-lg-6">';
	                            echo '<div class="testi-card">';
	                                echo '<div class="testi-card_bg-shape shape-mockup spin d-xl-block d-none" data-right="-35%" data-top="-35%">';
	                                    echo '<img src="'.RUFFER_PLUGDIRURI . 'assets/img/about_1_2shape.png" alt="img">';
	                                echo '</div>';
	                                echo '<div class="testi-card_profile">';
	                                    echo '<div class="media-left">';
	                                    	if( ! empty( $singleslide['client_image']['url'] ) ){
		                                        echo '<div class="testi-card_avater">';
		                                            echo ruffer_img_tag( array(
														'url'	=> esc_url( $singleslide['client_image']['url'] ),
													) );
		                                        echo '</div>';
		                                    }
	                                        if( ! empty( $settings['quote']['url'] ) ){
		                                        echo '<div class="testi-card_quote">';
		                                            echo ruffer_img_tag( array(
														'url'	=> esc_url( $settings['quote']['url'] ),
													) );
		                                        echo '</div>';
		                                    }
	                                    echo '</div>';
	                                    echo '<div class="media-body">';
	                                        if( ! empty( $singleslide['client_name'] ) ) {
					                            echo '<h3 class="testi-card_name n-name">'.esc_html( $singleslide['client_name'] ).'</h3>';
					                        }
					                        if( ! empty( $singleslide['client_designation'] ) ) {
					                            echo '<span class="testi-card_desig d-desig">'.esc_html( $singleslide['client_designation'] ).'</span>';
					                        }
					                        if( ! empty( $singleslide['client_feedback'] ) ) {
					                            echo '<p class="testi-card_text f-text">'.esc_html( $singleslide['client_feedback'] ).'</p>';
					                        }
	                                    echo '</div>';
	                                echo '</div>';
	                            echo '</div>';
	                        echo '</div>';
	                    }
                    echo '</div>';
                echo '</div>';
            echo '</div>';

	    }elseif( $settings['layout'] == '2' ){
	    	echo '<div class="row slider-shadow th-carousel arrow-style2" data-slide-show="2" data-lg-slide-show="2" data-md-slide-show="1" data-arrows="true">';
                foreach( $settings['slides'] as $singleslide ) {  
	                echo '<div class="col-lg-6">';
	                    echo '<div class="testi-card style2">';
	                        echo '<div class="testi-card_profile">';
	                            echo '<div class="media-left">';
	                            	if( ! empty( $singleslide['client_image']['url'] ) ){
		                                echo '<div class="testi-card_avater">';
		                                    echo ruffer_img_tag( array(
												'url'	=> esc_url( $singleslide['client_image']['url'] ),
											) );
		                                echo '</div>';
		                            }
	                                echo '<div class="testi-box_review">';
	                                    if( $singleslide['client_rating'] == 'one' ){
						                	echo '<i class="fa-solid fa-star-sharp"></i>';
							                echo '<i class="fa-solid fa-star-sharp"></i>';
							                echo '<i class="fa-solid fa-star-sharp"></i>';
							                echo '<i class="fa-solid fa-star-sharp"></i>';
							                echo '<i class="fa-solid fa-star-sharp"></i>';
						                }elseif( $singleslide['client_rating'] == 'two' ){
						                	echo '<i class="fa-solid fa-star-sharp"></i>';
							                echo '<i class="fa-solid fa-star-sharp"></i>';
							                echo '<i class="fa-solid fa-star-sharp"></i>';
							                echo '<i class="fa-solid fa-star-sharp"></i>';
							                echo '<i class="fa-solid fa-star-sharp"></i>';
						                }elseif( $singleslide['client_rating'] == 'three' ){
						                	echo '<i class="fa-solid fa-star-sharp"></i>';
							                echo '<i class="fa-solid fa-star-sharp"></i>';
							                echo '<i class="fa-solid fa-star-sharp"></i>';
							                echo '<i class="fa-solid fa-star-sharp"></i>';
							                echo '<i class="fa-solid fa-star-sharp"></i>';
						                }elseif( $singleslide['client_rating'] == 'four' ){
						                	echo '<i class="fa-solid fa-star-sharp"></i>';
							                echo '<i class="fa-solid fa-star-sharp"></i>';
							                echo '<i class="fa-solid fa-star-sharp"></i>';
							                echo '<i class="fa-solid fa-star-sharp"></i>';
							                echo '<i class="fa-solid fa-star-sharp"></i>';
						                }else{
						                	echo '<i class="fa-solid fa-star-sharp"></i>';
							                echo '<i class="fa-solid fa-star-sharp"></i>';
							                echo '<i class="fa-solid fa-star-sharp"></i>';
							                echo '<i class="fa-solid fa-star-sharp"></i>';
							                echo '<i class="fa-solid fa-star-sharp"></i>';
						                }
	                                echo '</div>';
	                            echo '</div>';
	                            echo '<div class="media-body">';
	                            	if( ! empty( $singleslide['client_feedback'] ) ) {
		                                echo '<p class="testi-card_text f-text">'.esc_html( $singleslide['client_feedback'] ).'</p>';
		                            }
	                                echo '<div class="media">';
	                                	if( ! empty( $settings['quote']['url'] ) ){
		                                    echo '<div class="testi-box_quote">';
		                                        echo ruffer_img_tag( array(
													'url'	=> esc_url( $settings['quote']['url'] ),
												) );
		                                    echo '</div>';
		                                }
	                                    echo '<div class="media-body">';
	                                        if( ! empty( $singleslide['client_name'] ) ) {
					                            echo '<h3 class="testi-card_name n-name">'.esc_html( $singleslide['client_name'] ).'</h3>';
					                        }
					                        if( ! empty( $singleslide['client_designation'] ) ) {
				                                echo '<span class="testi-card_desig d-desig">'.esc_html( $singleslide['client_designation'] ).'</span>';
				                            }
	                                    echo '</div>';
	                                echo '</div>';
	                            echo '</div>';
	                        echo '</div>';
	                    echo '</div>';
	                echo '</div>';
	            }
            echo '</div>';

	    }elseif( $settings['layout'] == '3' ){
	    	echo '<div class="row slider-shadow th-carousel arrow-style2" data-slide-show="3" data-lg-slide-show="2" data-md-slide-show="1" data-arrows="false">';
                foreach( $settings['slides_2'] as $singleslide ) { 
	                echo '<div class="col-xl-6">';
	                    echo '<div class="testi-block">';
	                        echo '<span class="review-rating">';
	                            echo '<span>';
	                                if( $singleslide['client_rating'] == 'one' ){
					                	echo '<i class="fas fa-star"></i>';
						                echo '<i class="far fa-star"></i>';
						                echo '<i class="far fa-star"></i>';
						                echo '<i class="far fa-star"></i>';
						                echo '<i class="far fa-star"></i>';
					                }elseif( $singleslide['client_rating'] == 'two' ){
					                	echo '<i class="fas fa-star"></i>';
						                echo '<i class="fas fa-star"></i>';
						                echo '<i class="far fa-star"></i>';
						                echo '<i class="far fa-star"></i>';
						                echo '<i class="far fa-star"></i>';
					                }elseif( $singleslide['client_rating'] == 'three' ){
					                	echo '<i class="fas fa-star"></i>';
						                echo '<i class="fas fa-star"></i>';
						                echo '<i class="fas fa-star"></i>';
						                echo '<i class="far fa-star"></i>';
						                echo '<i class="far fa-star"></i>';
					                }elseif( $singleslide['client_rating'] == 'four' ){
					                	echo '<i class="fas fa-star"></i>';
						                echo '<i class="fas fa-star"></i>';
						                echo '<i class="fas fa-star"></i>';
						                echo '<i class="fas fa-star"></i>';
						                echo '<i class="far fa-star"></i>';
					                }else{
					                	echo '<i class="fas fa-star"></i>';
						                echo '<i class="fas fa-star"></i>';
						                echo '<i class="fas fa-star"></i>';
						                echo '<i class="fas fa-star"></i>';
						                echo '<i class="fas fa-star"></i>';
					                }
	                            echo '</span>';
	                        echo '</span>';
	                        echo '<div class="quote-icon"><i class="fas fa-quote-left"></i></div>';
	                        if( ! empty( $singleslide['feedback_title'] ) ) {
		                        echo '<h6 class="testi-block_subtitle f-title">'.esc_html( $singleslide['feedback_title'] ).'</h6>';
		                    }
		                    if( ! empty( $singleslide['client_feedback'] ) ) {
		                        echo '<p class="testi-block_text f-text">'.esc_html( $singleslide['client_feedback'] ).'</p>';
		                    }
	                        echo '<div class="testi-block_profile">';
	                        	if( ! empty( $singleslide['client_image']['url'] ) ){
		                            echo '<div class="testi-block_avater">';
		                                echo ruffer_img_tag( array(
											'url'	=> esc_url( $singleslide['client_image']['url'] ),
										) );
		                            echo '</div>';
		                        }

	                            echo '<div class="media-body">';
	                            	if( ! empty( $singleslide['client_name'] ) ) {
		                                echo '<h3 class="box-title n-name">'.esc_html( $singleslide['client_name'] ).'</h3>';
		                            }
		                            if( ! empty( $singleslide['client_designation'] ) ) {
		                                echo '<p class="testi-block_desig d-desig">'.esc_html( $singleslide['client_designation'] ).'</p>';
		                            }
	                            echo '</div>';
	                        echo '</div>';
	                    echo '</div>';
	                echo '</div>';
	            }
            echo '</div>';

	    }elseif( $settings['layout'] == '4' ){
	    	echo '<div class="row th-carousel" data-slide-show="3" data-lg-slide-show="2" data-md-slide-show="1" data-arrows="false">';
                foreach( $settings['slides'] as $singleslide ) {  
	                echo '<div class="col-xl-6">';
	                    echo '<div class="testi-block style2">';
	                        echo '<div class="testi-block_profile">';
	                        	if( ! empty( $singleslide['client_image']['url'] ) ){
		                            echo '<div class="testi-block_avater">';
		                                echo ruffer_img_tag( array(
											'url'	=> esc_url( $singleslide['client_image']['url'] ),
										) );
		                            echo '</div>';
		                        }
		                        if( ! empty( $settings['quote']['url'] ) ){
		                            echo '<div class="quote-icon"><img src="'.esc_url( $settings['quote']['url'] ).'" alt="img"></div>';
		                        }
	                        echo '</div>';
	                        echo '<div class="testi-block_content">';
	                        	if( ! empty( $singleslide['client_feedback'] ) ) {
		                            echo '<p class="testi-block_text f-text">'.esc_html( $singleslide['client_feedback'] ).'</p>';
		                        }
		                        if( ! empty( $singleslide['client_name'] ) ) {
		                            echo '<h3 class="box-title n-name">'.esc_html( $singleslide['client_name'] ).'</h3>';
		                        }
		                        if( ! empty( $singleslide['client_designation'] ) ) {
		                            echo '<p class="testi-block_desig d-desig">'.esc_html( $singleslide['client_designation'] ).'</p>';
		                        }
	                        echo '</div>';
	                    echo '</div>';
	                echo '</div>';
	            }
                
            echo '</div>';

	    }elseif( $settings['layout'] == '5' ){
	    	echo '<div class="row th-carousel slider-shadow testi-slider5" data-slide-show="2" data-lg-slide-show="2" data-md-slide-show="1" data-arrows="false" data-dots="true">';
                foreach( $settings['slides'] as $singleslide ) {  
	                echo '<div class="col-xl-6">';
	                    echo '<div class="testi-block style3">';
	                        echo '<div class="testi-block_profile">';
	                        	if( ! empty( $singleslide['client_image']['url'] ) ){
		                            echo '<div class="testi-block_avater">';
		                                echo ruffer_img_tag( array(
											'url'	=> esc_url( $singleslide['client_image']['url'] ),
										) );
		                            echo '</div>';
		                        }
		                        if( ! empty( $settings['quote']['url'] ) ){
		                            echo '<div class="quote-icon"><img src="'.esc_url( $settings['quote']['url'] ).'" alt="img"></div>';
		                        }
	                        echo '</div>';
	                        echo '<div class="testi-block_content">';
	                        	if( ! empty( $singleslide['client_feedback'] ) ) {
		                            echo '<p class="testi-block_text f-text">'.esc_html( $singleslide['client_feedback'] ).'</p>';
		                        }
		                        if( ! empty( $singleslide['client_name'] ) ) {
		                            echo '<h3 class="box-title n-name">'.esc_html( $singleslide['client_name'] ).'</h3>';
		                        }
		                        if( ! empty( $singleslide['client_designation'] ) ) {
		                            echo '<p class="testi-block_desig d-desig">'.esc_html( $singleslide['client_designation'] ).'</p>';
		                        }
	                        echo '</div>';
	                    echo '</div>';
	                echo '</div>';
	            }
                
            echo '</div>';

	    }elseif( $settings['layout'] == '6' ){
			echo '<div class="row justify-content-between flex-row-reverse">';
                echo '<div class="col-xxl-4 col-xl-5">';
                    echo '<div class="testi-thumb6-wrap">';
                        echo '<ul class="testi-thumb6-indicator" data-asnavfor=".testi-slider6">';
							foreach( $settings['slides'] as $key => $singleslide ) {  
								$active = ($key == 0) ? 'active' : '';
								echo '<li class="testi-indicator-btn '.$active.'">';
									echo ruffer_img_tag( array(
										'url'	=> esc_url( $singleslide['client_image']['url'] ),
									) );
								echo '</li>';
							}
                        echo '</ul>';
						if( ! empty( $settings['quote']['url'] ) ){
							echo '<div class="quote-icon">';
								echo ruffer_img_tag( array(
									'url'	=> esc_url( $settings['quote']['url'] ),
								) );
							echo '</div>';
						}
                    echo '</div>';
                echo '</div>';
                echo '<div class="col-xl-7">';
                    echo '<div class="row th-carousel testi-slider6" data-slide-show="1" data-lg-slide-show="1" data-md-slide-show="1">';
						foreach( $settings['slides'] as $singleslide ) {  
							echo '<div class="col-xl-6">';
								echo '<div class="testi-block style4">';
									echo '<div class="testi-block_review">';
										if( $singleslide['client_rating'] == 'one' ){
											echo '<i class="fas fa-star"></i>';
											echo '<i class="far fa-star"></i>';
											echo '<i class="far fa-star"></i>';
											echo '<i class="far fa-star"></i>';
											echo '<i class="far fa-star"></i>';
										}elseif( $singleslide['client_rating'] == 'two' ){
											echo '<i class="fas fa-star"></i>';
											echo '<i class="fas fa-star"></i>';
											echo '<i class="far fa-star"></i>';
											echo '<i class="far fa-star"></i>';
											echo '<i class="far fa-star"></i>';
										}elseif( $singleslide['client_rating'] == 'three' ){
											echo '<i class="fas fa-star"></i>';
											echo '<i class="fas fa-star"></i>';
											echo '<i class="fas fa-star"></i>';
											echo '<i class="far fa-star"></i>';
											echo '<i class="far fa-star"></i>';
										}elseif( $singleslide['client_rating'] == 'four' ){
											echo '<i class="fas fa-star"></i>';
											echo '<i class="fas fa-star"></i>';
											echo '<i class="fas fa-star"></i>';
											echo '<i class="fas fa-star"></i>';
											echo '<i class="far fa-star"></i>';
										}else{
											echo '<i class="fas fa-star"></i>';
											echo '<i class="fas fa-star"></i>';
											echo '<i class="fas fa-star"></i>';
											echo '<i class="fas fa-star"></i>';
											echo '<i class="fas fa-star"></i>';
										}
									echo '</div>';
									if( ! empty( $singleslide['client_feedback'] ) ) {
										echo '<p class="testi-block_text f-text">'.esc_html( $singleslide['client_feedback'] ).'</p>';
									}
									echo '<div class="testi-block_content">';
										if( ! empty( $singleslide['client_image']['url'] ) ){
											echo '<div class="testi-block_avater">';
												echo ruffer_img_tag( array(
													'url'	=> esc_url( $singleslide['client_image']['url'] ),
												) );
											echo '</div>';
										}
										echo '<div class="testi-block_profile">';
											if( ! empty( $singleslide['client_name'] ) ) {
												echo '<h3 class="testi-block_title n-name">'.esc_html( $singleslide['client_name'] ).'</h3>';
											}
											if( ! empty( $singleslide['client_designation'] ) ) {
												echo '<p class="testi-block_desig d-desig">'.esc_html( $singleslide['client_designation'] ).'</p>';
											}
										echo '</div>';
									echo '</div>';
								echo '</div>';
							echo '</div>';
						}
                    echo '</div>';
                echo '</div>';
            echo '</div>';

		}elseif( $settings['layout'] == '7' ){
			echo '<div class="row gx-30 th-carousel" data-autoplay="false" data-slide-show="3" data-lg-slide-show="2" data-md-slide-show="2" data-arrows="false">';
				foreach( $settings['slides_3'] as $singleslide ) {  
					$f_target = $singleslide['fb_link']['is_external'] ? ' target="_blank"' : '';
					$f_nofollow = $singleslide['fb_link']['nofollow'] ? ' rel="nofollow"' : '';

					$t_target = $singleslide['twitter_link']['is_external'] ? ' target="_blank"' : '';
					$t_nofollow = $singleslide['twitter_link']['nofollow'] ? ' rel="nofollow"' : '';

					$l_target = $singleslide['linkedin_link']['is_external'] ? ' target="_blank"' : '';
					$l_nofollow = $singleslide['linkedin_link']['nofollow'] ? ' rel="nofollow"' : '';

					echo '<div class="col-xl-6">';
						echo '<div class="card testimonial-card">';
							echo '<div class="message">';
								if( ! empty( $settings['quote']['url'] ) ){
									echo '<div class="message-icon">';
										echo ruffer_img_tag( array(
											'url'	=> esc_url( $settings['quote']['url'] ),
										) );
									echo '</div>';
								}
								if( ! empty( $singleslide['client_feedback'] ) ) {
									echo '<p class="message-text m-0 f-text">'.esc_html( $singleslide['client_feedback'] ).'</p>';
								}
							echo '</div>';
							echo '<div class="author-details">';
								if( ! empty( $singleslide['client_image']['url'] ) ){
									echo '<div class="avatar">';
										echo ruffer_img_tag( array(
											'url'	=> esc_url( $singleslide['client_image']['url'] ),
										) );
									echo '</div>';
								}
								if( ! empty( $singleslide['client_name'] ) ) {
									echo '<h6 class="mb-0 n-name">'.esc_html( $singleslide['client_name'] ).'</h6>';
								}
								if( ! empty( $singleslide['client_designation'] ) ) {
									echo '<span class="fw-medium d-desig">'.esc_html( $singleslide['client_designation'] ).'</span>';
								}
								echo '<ul class="d-flex align-items-center">';
									if( ! empty( $singleslide['fb_link']['url']) ){
										echo '<li><a '.wp_kses_post( $f_nofollow.$f_target ).' href="'.esc_url( $singleslide['fb_link']['url'] ).'" class="icon-bg-custom"><i class="fab fa-facebook-f"></i></a></li>';
									}
									if( ! empty( $singleslide['twitter_link']['url']) ){
										echo '<li><a '.wp_kses_post( $t_nofollow.$t_target ).' href="'.esc_url( $singleslide['twitter_link']['url'] ).'" class="icon-bg-custom"><i class="fab fa-twitter"></i></a></li>';
									}
									if( ! empty( $singleslide['linkedin_link']['url']) ){
										echo '<li><a '.wp_kses_post( $l_nofollow.$l_target ).' href="'.esc_url( $singleslide['linkedin_link']['url'] ).'" class="icon-bg-custom"><i class="fab fa-linkedin-in"></i></a></li>';
									}
								echo '</ul>';
								echo '<div class="mask-bg" data-mask-src="'.RUFFER_PLUGDIRURI . 'assets/img/testi-7-mask.png"></div>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				}
			echo '</div>';

		}elseif( $settings['layout'] == '8' ){
			echo '<div class="row gx-3 gx-lg-5 th-carousel testi-slider7" data-arrows="false" data-dots="true" data-adaptive-height="false">';
				foreach( $settings['slides_2'] as $singleslide ) { 
					echo '<div class="col-12 mb-5 mb-lg-3">';
						echo '<div class="testi-block style5">';
							if( ! empty( $settings['quote']['url'] ) ){
								echo '<div class="mask one">';
									echo ruffer_img_tag( array(
										'url'	=> esc_url( $settings['quote']['url'] ),
									) );
								echo '</div>';
							}
							if( ! empty( $settings['shape_img']['url'] ) ){
								echo '<div class="mask two">';
									echo ruffer_img_tag( array(
										'url'	=> esc_url( $settings['shape_img']['url'] ),
									) );
								echo '</div>';
							}
							echo '<div class="d-flex gy-3 gy-sm-0 mb-25 flex-column flex-sm-row align-items-center justify-content-between">';
								echo '<div class="testi-block_profile">';
									if( ! empty( $singleslide['client_image']['url'] ) ){
										echo '<div class="testi-block_avater">';
											echo ruffer_img_tag( array(
												'url'	=> esc_url( $singleslide['client_image']['url'] ),
											) );
										echo '</div>';
									}
									if( ! empty( $singleslide['client_name'] ) ) {
										echo '<h3 class="testi-block_title n-name">'.esc_html( $singleslide['client_name'] ).'</h3>';
									}
									if( ! empty( $singleslide['client_designation'] ) ) {
										echo '<p class="testi-block_desig d-desig">'.esc_html( $singleslide['client_designation'] ).'</p>';
									}
								echo '</div>';
								echo '<div class="testi-block_review">';
									echo '<span>';
										if( $singleslide['client_rating'] == 'one' ){
											echo '<i class="fas fa-star"></i>';
											echo '<i class="far fa-star"></i>';
											echo '<i class="far fa-star"></i>';
											echo '<i class="far fa-star"></i>';
											echo '<i class="far fa-star"></i>';
										}elseif( $singleslide['client_rating'] == 'two' ){
											echo '<i class="fas fa-star"></i>';
											echo '<i class="fas fa-star"></i>';
											echo '<i class="far fa-star"></i>';
											echo '<i class="far fa-star"></i>';
											echo '<i class="far fa-star"></i>';
										}elseif( $singleslide['client_rating'] == 'three' ){
											echo '<i class="fas fa-star"></i>';
											echo '<i class="fas fa-star"></i>';
											echo '<i class="fas fa-star"></i>';
											echo '<i class="far fa-star"></i>';
											echo '<i class="far fa-star"></i>';
										}elseif( $singleslide['client_rating'] == 'four' ){
											echo '<i class="fas fa-star"></i>';
											echo '<i class="fas fa-star"></i>';
											echo '<i class="fas fa-star"></i>';
											echo '<i class="fas fa-star"></i>';
											echo '<i class="far fa-star"></i>';
										}else{
											echo '<i class="fas fa-star"></i>';
											echo '<i class="fas fa-star"></i>';
											echo '<i class="fas fa-star"></i>';
											echo '<i class="fas fa-star"></i>';
											echo '<i class="fas fa-star"></i>';
										}
									echo '</span>';
								echo '</div>';
							echo '</div>';
							echo '<div class="testi-block_content">';
								if( ! empty( $singleslide['feedback_title'] ) ) {
									echo '<h4 class="f-title">'.esc_html( $singleslide['feedback_title'] ).'</h4>';
								}
								if( ! empty( $singleslide['client_feedback'] ) ) {
									echo '<p class="f-text">'.esc_html( $singleslide['client_feedback'] ).'</p>';
								}
							echo '</div>';
						echo '</div>';
					echo '</div>';
				}
			echo '</div>';
			
		}elseif( $settings['layout'] == '9' ){
			echo '<div class="title-area text-center text-lg-start mb-60">';
				echo '<div class="row gy-3 gy-lg-0 justify-content-center justify-content-lg-between align-items-end">';
					echo '<div class="col-md-7 col-xl-5">';
						if( !empty( $settings['subtitle'] ) ){
							echo '<span class="sub-title">'.esc_html( $settings['subtitle'] ).'</span>';
						}
						if( !empty( $settings['title'] ) ){
							echo '<h2 class="sec-title mb-0">'.esc_html( $settings['title'] ).'</h2>';
						}
					echo '</div>';
					echo '<div class="col-lg-4 text-lg-end">';
						echo '<div class="arrow-wrap style2 m-0">';
							echo '<button data-slick-next="#testi-slider1" class="slick-arrow slick-next"><i class="fa-regular fa-arrow-left-long"></i></button>';
							echo '<button data-slick-prev="#testi-slider1" class="slick-arrow slick-prev"><i class="fa-regular fa-arrow-right-long"></i></button>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</div>';

			echo '<div class="row slider-shadow th-carousel gx-30" id="testi-slider1" data-slide-show="3" data-lg-slide-show="2" data-md-slide-show="2" data-sm-slide-show="1" data-xs-slide-show="1" data-autoplay="false">';
				foreach( $settings['slides'] as $singleslide ) { 
					echo '<div class="col-auto">';
						echo '<div class="testi-block style6">';
							if( ! empty( $settings['quote']['url'] ) ){
								echo '<div class="quote-icon">';
									echo ruffer_img_tag( array(
										'url'	=> esc_url( $settings['quote']['url'] ),
									) );
								echo '</div>';
							}
							echo '<div class="review-rating">';
								if( $singleslide['client_rating'] == 'one' ){
									echo '<i class="fas fa-star"></i>';
									echo '<i class="far fa-star"></i>';
									echo '<i class="far fa-star"></i>';
									echo '<i class="far fa-star"></i>';
									echo '<i class="far fa-star"></i>';
								}elseif( $singleslide['client_rating'] == 'two' ){
									echo '<i class="fas fa-star"></i>';
									echo '<i class="fas fa-star"></i>';
									echo '<i class="far fa-star"></i>';
									echo '<i class="far fa-star"></i>';
									echo '<i class="far fa-star"></i>';
								}elseif( $singleslide['client_rating'] == 'three' ){
									echo '<i class="fas fa-star"></i>';
									echo '<i class="fas fa-star"></i>';
									echo '<i class="fas fa-star"></i>';
									echo '<i class="far fa-star"></i>';
									echo '<i class="far fa-star"></i>';
								}elseif( $singleslide['client_rating'] == 'four' ){
									echo '<i class="fas fa-star"></i>';
									echo '<i class="fas fa-star"></i>';
									echo '<i class="fas fa-star"></i>';
									echo '<i class="fas fa-star"></i>';
									echo '<i class="far fa-star"></i>';
								}else{
									echo '<i class="fas fa-star"></i>';
									echo '<i class="fas fa-star"></i>';
									echo '<i class="fas fa-star"></i>';
									echo '<i class="fas fa-star"></i>';
									echo '<i class="fas fa-star"></i>';
								}
							echo '</div>';
							if( ! empty( $singleslide['client_feedback'] ) ) {
								echo '<p class="testi-block_text f-text">'.esc_html( $singleslide['client_feedback'] ).'</p>';
							}
							echo '<div class="testi-block_profile">';
								if( ! empty( $singleslide['client_image']['url'] ) ){
									echo '<div class="testi-block_avater">';
										echo ruffer_img_tag( array(
											'url'	=> esc_url( $singleslide['client_image']['url'] ),
										) );
									echo '</div>';
								}
								echo '<div class="media-body">';
									if( ! empty( $singleslide['client_name'] ) ) {
										echo '<h3 class="box-title n-name">'.esc_html( $singleslide['client_name'] ).'</h3>';
									}
									if( ! empty( $singleslide['client_designation'] ) ) {
										echo '<p class="testi-block_desig d-desig">'.esc_html( $singleslide['client_designation'] ).'</p>';
									}
								echo '</div>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				}
			echo '</div>';

		}elseif( $settings['layout'] == '10' ){
			echo '<div class="row gy-5 gy-xl-0 gx-xl-5 align-items-center justify-content-between flex-row-reverse">';
				echo '<div class="col-xl-7 d-none d-md-block">';
					echo '<div class="thumb-map text-center" data-bg-src="'.esc_url( $settings['shape_img']['url'] ).'">';
						echo '<ul class="thumb-indicators testi-thumb6-indicator" data-asnavfor=".testi-slider7">';
							foreach ($settings['slides'] as $key => $singleslide) {
								$active = ($key == 0) ? 'active' : '';
							
								// Generate the mask image name based on the loop iteration
								$letters = ['b', 'c', 'd', 'e', 'f', 'g']; // Array of letters to use
								$letter = isset($letters[$key - 1]) ? $letters[$key - 1] : 'a'; // Default to 'b' if key is out of bounds
								$mask_image = 'testi-10-' . $letter . '-mask.png';
							
								echo '<li class="testi-indicator-btn ' . esc_attr($active) . '" data-mask-src="' . RUFFER_PLUGDIRURI . 'assets/img/testimonial/' . esc_attr($mask_image) . '">';
									echo ruffer_img_tag(array(
										'url' => esc_url($singleslide['client_image']['url']),
									));
								echo '</li>';
							}
							
						echo '</ul>';
					echo '</div>';
				echo '</div>';

				echo '<div class="col-xl-5">';
					echo '<div class="title-area">';
						if( !empty( $settings['subtitle'] ) ){
							echo '<span class="sub-title">'.esc_html( $settings['subtitle'] ).'</span>';
						}
						if( !empty( $settings['title'] ) ){
							echo '<h2 class="sec-title">'.esc_html( $settings['title'] ).'</h2>';
						}
					echo '</div>';
					echo '<div class="row th-carousel testi-slider7" data-slide-show="1" data-lg-slide-show="1" data-md-slide-show="1">';
						foreach( $settings['slides'] as $singleslide ) { 
							echo '<div class="col-xl-6">';
								echo '<div class="testi-block style7">';
									if( ! empty( $settings['quote']['url'] ) ){
										echo '<div class="mask">';
											echo ruffer_img_tag( array(
												'url'	=> esc_url( $settings['quote']['url'] ),
											) );
										echo '</div>';
									}
									echo '<div class="testi-block_review">';
										if( $singleslide['client_rating'] == 'one' ){
											echo '<i class="fa-solid fa-star-sharp"></i>';
											echo '<i class="far fa-star"></i>';
											echo '<i class="far fa-star"></i>';
											echo '<i class="far fa-star"></i>';
											echo '<i class="far fa-star"></i>';
										}elseif( $singleslide['client_rating'] == 'two' ){
											echo '<i class="fa-solid fa-star-sharp"></i>';
											echo '<i class="fa-solid fa-star-sharp"></i>';
											echo '<i class="far fa-star"></i>';
											echo '<i class="far fa-star"></i>';
											echo '<i class="far fa-star"></i>';
										}elseif( $singleslide['client_rating'] == 'three' ){
											echo '<i class="fa-solid fa-star-sharp"></i>';
											echo '<i class="fa-solid fa-star-sharp"></i>';
											echo '<i class="fa-solid fa-star-sharp"></i>';
											echo '<i class="far fa-star"></i>';
											echo '<i class="far fa-star"></i>';
										}elseif( $singleslide['client_rating'] == 'four' ){
											echo '<i class="fa-solid fa-star-sharp"></i>';
											echo '<i class="fa-solid fa-star-sharp"></i>';
											echo '<i class="fa-solid fa-star-sharp"></i>';
											echo '<i class="fa-solid fa-star-sharp"></i>';
											echo '<i class="far fa-star"></i>';
										}else{
											echo '<i class="fa-solid fa-star-sharp"></i>';
											echo '<i class="fa-solid fa-star-sharp"></i>';
											echo '<i class="fa-solid fa-star-sharp"></i>';
											echo '<i class="fa-solid fa-star-sharp"></i>';
											echo '<i class="fa-solid fa-star-sharp"></i>';
										}
									echo '</div>';
									if( ! empty( $singleslide['client_feedback'] ) ) {
										echo '<p class="testi-block_text f-text">'.esc_html( $singleslide['client_feedback'] ).'</p>';
									}
									echo '<div class="testi-block_content">';
										echo '<div class="testi-block_profile">';
											if( ! empty( $singleslide['client_name'] ) ) {
												echo '<h3 class="testi-block_title n-name">'.esc_html( $singleslide['client_name'] ).'</h3>';
											}
											if( ! empty( $singleslide['client_designation'] ) ) {
												echo '<p class="testi-block_desig d-desig">'.esc_html( $singleslide['client_designation'] ).'</p>';
											}
										echo '</div>';
									echo '</div>';
								echo '</div>';
							echo '</div>';
						}
					echo '</div>';
				echo '</div>';
			echo '</div>';

		}elseif( $settings['layout'] == '11' ){
			echo '<div class="row slider-shadow th-carousel gx-30" data-slide-show="3" data-lg-slide-show="2" data-md-slide-show="1" data-arrows="false">';
				foreach( $settings['slides'] as $singleslide ) { 
					echo '<div class="col-xl-6">';
						echo '<div class="testi-block style8">';
							echo '<div class="d-flex align-items-center justify-content-between mb-20">';
								if( ! empty( $settings['quote']['url'] ) ){
									echo '<div>';
										echo ruffer_img_tag( array(
											'url'	=> esc_url( $settings['quote']['url'] ),
										) );
									echo '</div>';
								}
								echo '<div class="testi-block_review">';
									if( $singleslide['client_rating'] == 'one' ){
										echo '<i class="fas fa-star"></i>';
										echo '<i class="far fa-star"></i>';
										echo '<i class="far fa-star"></i>';
										echo '<i class="far fa-star"></i>';
										echo '<i class="far fa-star"></i>';
									}elseif( $singleslide['client_rating'] == 'two' ){
										echo '<i class="fas fa-star"></i>';
										echo '<i class="fas fa-star"></i>';
										echo '<i class="far fa-star"></i>';
										echo '<i class="far fa-star"></i>';
										echo '<i class="far fa-star"></i>';
									}elseif( $singleslide['client_rating'] == 'three' ){
										echo '<i class="fas fa-star"></i>';
										echo '<i class="fas fa-star"></i>';
										echo '<i class="fas fa-star"></i>';
										echo '<i class="far fa-star"></i>';
										echo '<i class="far fa-star"></i>';
									}elseif( $singleslide['client_rating'] == 'four' ){
										echo '<i class="fas fa-star"></i>';
										echo '<i class="fas fa-star"></i>';
										echo '<i class="fas fa-star"></i>';
										echo '<i class="fas fa-star"></i>';
										echo '<i class="far fa-star"></i>';
									}else{
										echo '<i class="fas fa-star"></i>';
										echo '<i class="fas fa-star"></i>';
										echo '<i class="fas fa-star"></i>';
										echo '<i class="fas fa-star"></i>';
										echo '<i class="fas fa-star"></i>';
									}
								echo '</div>';
							echo '</div>';
							if( ! empty( $singleslide['client_feedback'] ) ) {
								echo '<p class="testi-block_text f-text">'.esc_html( $singleslide['client_feedback'] ).'</p>';
							}
							echo '<div class="testi-block_content">';
								if( ! empty( $singleslide['client_image']['url'] ) ){
									echo '<div class="testi-block_avater">';
										echo ruffer_img_tag( array(
											'url'	=> esc_url( $singleslide['client_image']['url'] ),
										) );
									echo '</div>';
								}
								echo '<div class="testi-block_profile">';
									if( ! empty( $singleslide['client_name'] ) ) {
										echo '<h3 class="testi-block_title n-name">'.esc_html( $singleslide['client_name'] ).'</h3>';
									}
									if( ! empty( $singleslide['client_designation'] ) ) {
										echo '<p class="testi-block_desig d-desig">'.esc_html( $singleslide['client_designation'] ).'</p>';
									}
								echo '</div>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				}
			echo '</div>';

		}elseif( $settings['layout'] == '12' ){
			echo '<div class="row justify-content-center slider-shadow th-carousel arrow-style2" data-slide-show="1" data-md-slide-show="1" data-arrows="true">';
				foreach( $settings['slides'] as $singleslide ) { 
					echo '<div class="col-lg-6">';
						echo '<div class="testi-block style10">';
							echo '<div class="testi-block_profile">';
								if( ! empty( $singleslide['client_image']['url'] ) ){
									echo '<div class="testi-block_avater">';
										echo ruffer_img_tag( array(
											'url'	=> esc_url( $singleslide['client_image']['url'] ),
										) );
									echo '</div>';
								}
								echo '<div class="media text-start">';
									if( ! empty( $singleslide['client_name'] ) ) {
										echo '<h3 class="testi-block_name n-name">'.esc_html( $singleslide['client_name'] ).'</h3>';
									}
									if( ! empty( $singleslide['client_designation'] ) ) {
										echo '<p class="testi-block_desig d-desig">'.esc_html( $singleslide['client_designation'] ).'</p>';
									}
								echo '</div>';
							echo '</div>';
							if( ! empty( $singleslide['client_feedback'] ) ) {
								echo '<p class="testi-block_text f-text">'.esc_html( $singleslide['client_feedback'] ).'</p>';
							}
							echo '<div class="testi-box_review">';
								if( $singleslide['client_rating'] == 'one' ){
									echo '<i class="fas fa-star"></i>';
									echo '<i class="far fa-star"></i>';
									echo '<i class="far fa-star"></i>';
									echo '<i class="far fa-star"></i>';
									echo '<i class="far fa-star"></i>';
								}elseif( $singleslide['client_rating'] == 'two' ){
									echo '<i class="fas fa-star"></i>';
									echo '<i class="fas fa-star"></i>';
									echo '<i class="far fa-star"></i>';
									echo '<i class="far fa-star"></i>';
									echo '<i class="far fa-star"></i>';
								}elseif( $singleslide['client_rating'] == 'three' ){
									echo '<i class="fas fa-star"></i>';
									echo '<i class="fas fa-star"></i>';
									echo '<i class="fas fa-star"></i>';
									echo '<i class="far fa-star"></i>';
									echo '<i class="far fa-star"></i>';
								}elseif( $singleslide['client_rating'] == 'four' ){
									echo '<i class="fas fa-star"></i>';
									echo '<i class="fas fa-star"></i>';
									echo '<i class="fas fa-star"></i>';
									echo '<i class="fas fa-star"></i>';
									echo '<i class="far fa-star"></i>';
								}else{
									echo '<i class="fas fa-star"></i>';
									echo '<i class="fas fa-star"></i>';
									echo '<i class="fas fa-star"></i>';
									echo '<i class="fas fa-star"></i>';
									echo '<i class="fas fa-star"></i>';
								}
							echo '</div>';
						echo '</div>';
					echo '</div>';
				}
			echo '</div>';

		}
		

		
	}
}