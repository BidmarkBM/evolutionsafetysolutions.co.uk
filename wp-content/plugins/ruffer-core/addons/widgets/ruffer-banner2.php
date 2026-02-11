<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Group_Control_Border;
/**
 *
 * Banner Widget.
 *
 */
class Ruffer_Banner2 extends Widget_Base {

	public function get_name() {
		return 'rufferbanner2';
	}
	public function get_title() {
		return __( 'Banner 2', 'ruffer' );
	}
	public function get_icon() {
		return 'eicon-code';
    }
	public function get_categories() {
		return [ 'ruffer_header_elements' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'Banner_section',
			[
				'label' 	=> __( 'Banner', 'ruffer' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );

		$this->add_control(
			'layout_style',
			[
				'label' 		=> __( 'Ruffer Banner Style', 'ruffer' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> '1',
				'options' 		=> [
					'1'  		=> __( 'Style One', 'ruffer' ),
					'2' 		=> __( 'Style Two', 'ruffer' ),
					'3' 		=> __( 'Style Three', 'ruffer' ),
					'4' 		=> __( 'Style Four', 'ruffer' ),
					'5' 		=> __( 'Style Five', 'ruffer' ),
					'6' 		=> __( 'Style Six', 'ruffer' ),
				],
			]
		);

		/*-----------------------------------------style one ------------------------------------*/
		$this->add_control(
            'banner_bg',
            [
                'label'     => __( 'Banner Background', 'ruffer' ),
                'type'      => Controls_Manager::MEDIA,
                'dynamic' 		=> [
					'active' 		=> true,
				],
				'default' 		=> [
					'url' 		=> Utils::get_placeholder_image_src(),
				],
				'condition'		=> [ 
					'layout_style' => [ '1'] 
				],
            ]
        );

		$this->add_control(
            'banner_img',
            [
                'label'     => __( 'Banner Image', 'ruffer' ),
                'type'      => Controls_Manager::MEDIA,
                'dynamic' 		=> [
					'active' 		=> true,
				],
				'default' 		=> [
					'url' 		=> Utils::get_placeholder_image_src(),
				],
				'condition'		=> [ 
					'layout_style' => [ '1'] 
				],
            ]
        );

        $this->add_control(
			'title', [
				'label' 		=> __( 'Title', 'ruffer' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'rows' 			=> 2,
				'default' 		=> __( 'The Roofing Pros You Can Trust' , 'ruffer' ),
				'label_block' 	=> true,
				'condition'		=> [ 
					'layout_style' => [ '1'] 
				],
			]
        );
        $this->add_control(
			'desc', [
				'label' 		=> __( 'Description', 'ruffer' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'rows' 			=> 4,
				'default' 		=> __( '' , 'ruffer' ),
				'condition'		=> [ 
					'layout_style' => [ '1'] 
				],
			]
        );
		$this->add_control(
			'show_form',
			[
				'label' 		=> __( 'Show Form?', 'ruffer' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Show', 'ruffer' ),
				'label_off' 	=> __( 'Hide', 'ruffer' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'yes',
				'condition'		=> [ 
					'layout_style' => [ '1'] 
				],
			]
		);

        $this->add_control(
			'placeholder_text', [
				'label' 		=> __( 'Placeholder Text', 'ruffer' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'rows' 			=> 2,
				'default' 		=> __( 'Your Email Address' , 'ruffer' ),
				'label_block' 	=> true,
				'condition'		=> [ 
					'show_form' => [ 'yes' ],
					'layout_style' => [ '1'] 
				],
			]
        );
        $this->add_control(
			'form_btn_text', [
				'label' 		=> __( 'Form Button Text', 'ruffer' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'rows' 			=> 2,
				'default' 		=> __( 'Subscribe' , 'ruffer' ),
				'label_block' 	=> true,
				'condition'		=> [ 
					'show_form' => [ 'yes' ],
					'layout_style' => [ '1'] 
				],
			]
        );
		$this->add_control(
			'show_author',
			[
				'label' 		=> __( 'Show Author box?', 'ruffer' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Show', 'ruffer' ),
				'label_off' 	=> __( 'Hide', 'ruffer' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'yes',
				'condition'		=> [ 
					'layout_style' => [ '1'] 
				],
			]
		);
		$this->add_control(
            'author_img',
            [
                'label'     => __( 'Authro Image', 'ruffer' ),
                'type'      => Controls_Manager::MEDIA,
                'dynamic' 		=> [
					'active' 		=> true,
				],
				'condition'		=> [ 
					'show_author' => [ 'yes' ],
					'layout_style' => [ '1'] 
				],
            ]
        );
		$this->add_control(
			'author_title', [
				'label' 		=> __( 'Author Title', 'ruffer' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'rows' 			=> 3,
				'default' 		=> __( '' , 'ruffer' ),
				'label_block' 	=> true,
				'condition'		=> [ 
					'show_author' => [ 'yes' ],
					'layout_style' => [ '1'] 
				],
			]
        );
		$this->add_control(
			'author_rating', [
				'label' 		=> __( 'Author rating', 'ruffer' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'rows' 			=> 4,
				'default' 		=> __( '' , 'ruffer' ),
				'label_block' 	=> true,
				'condition'		=> [ 
					'show_author' => [ 'yes' ],
					'layout_style' => [ '1'] 
				],
			]
        );


		$repeater = new Repeater();
		
		$repeater->add_control(
            'banner_img',
            [
                'label'     => __( 'Banner Image', 'ruffer' ),
                'type'      => Controls_Manager::MEDIA,
                'dynamic' 		=> [
					'active' 		=> true,
				],
				'default' 		=> [
					'url' 		=> Utils::get_placeholder_image_src(),
				],
            ]
        );

		$repeater->add_control(
            'banner_overlay',
            [
                'label'     => __( 'Overlay Image', 'ruffer' ),
                'type'      => Controls_Manager::MEDIA,
                'dynamic' 		=> [
					'active' 		=> true,
				],
				'default' 		=> [
					'url' 		=> Utils::get_placeholder_image_src(),
				],
            ]
        );

        $repeater->add_control(
			'title', [
				'label' 		=> __( 'Title', 'ruffer' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'rows' 			=> 2,
				'default' 		=> __( 'Classical Education' , 'ruffer' ),
				'label_block' 	=> true,
			]
        );

        $repeater->add_control(
			'desc', [
				'label' 		=> __( 'Description', 'ruffer' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'rows' 			=> 2,
				'default' 		=> __( '' , 'ruffer' ),
				'label_block' 	=> true,
			]
        );

		$repeater->add_control(
			'button_text',
			[
				'label' 	=> esc_html__( 'Button Text', 'ruffer' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'default'  	=> esc_html__( 'All Services', 'ruffer' ),
				'rows' 		=> 2,
			]
        );

        $repeater->add_control(
			'button_link',
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

		$repeater->add_control(
			'button_text2',
			[
				'label' 	=> esc_html__( 'Button Text', 'ruffer' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'default'  	=> esc_html__( 'About us', 'ruffer' ),
				'rows' 		=> 2,
			]
        );

        $repeater->add_control(
			'button_link2',
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
		
        $this->add_control(
			'banner_1',
			[
				'label' 		=> __( 'Banner Slider', 'ruffer' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'title' => __( 'Add Title','ruffer' ),
					],
				],
				'title_field' 	=> '{{{ title.value }}}',
				'condition'		=> [ 
					'layout_style' => [ '2'] 
				],
			]
		);

		$this->add_control(
			'video_url',
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
				'condition'		=> [ 
					'layout_style' => [ '2'] 
				],
			]
		);
		$this->add_control(
			'phone_label',
			[
				'label' 		=> __( 'Phone Label', 'ruffer' ),
				'type' 			=> Controls_Manager::TEXT,
				'label_block' => true,
				'condition'		=> [ 
					'layout_style' => [ '2'] 
				],
			]
		);			
		$this->add_control(
			'phone',
			[
				'label' 		=> __( 'Phone', 'ruffer' ),
				'type' 			=> Controls_Manager::TEXT,
				'label_block' => true,
				'condition'		=> [ 
					'layout_style' => [ '2'] 
				],
			]
		);		
		$this->add_control(
			'email_label',
			[
				'label' 		=> __( 'Email Label', 'ruffer' ),
				'type' 			=> Controls_Manager::TEXT,
				'label_block' => true,
				'condition'		=> [ 
					'layout_style' => [ '2'] 
				],
			]
		);
		$this->add_control(
			'email',
			[
				'label' 		=> __( 'Email', 'ruffer' ),
				'type' 			=> Controls_Manager::TEXT,
				'label_block' => true,
				'condition'		=> [ 
					'layout_style' => [ '2'] 
				],
			]
		);


		$repeater = new Repeater();

		ruffer_media_fields($repeater, 'bg', 'Choose Background');
		ruffer_media_fields($repeater, 'image', 'Choose Image');
		ruffer_general_fields($repeater, 'subtitle', 'Subtitle', 'TEXTAREA2', 'Ridge Shield Inspections');
		ruffer_general_fields($repeater, 'title', 'Title', 'TEXTAREA', 'Guardians of Your Roofing Peace');
		ruffer_general_fields($repeater, 'desc', 'Description', 'TEXTAREA', '');
		ruffer_general_fields($repeater, 'button_text', 'Button Text', 'TEXT', 'CONTACT US');
		ruffer_url_fields($repeater, 'button_url', 'Button URL');
		
		$this->add_control(
			'banner_slides',
			[
				'label' 		=> __( 'Banners', 'ruffer' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'title' 	=> __( 'Guardians of Your Roofing Peace', 'ruffer' ),
					],
				],
				'condition'	=> [
					'layout_style' => ['3']
				]
			]
		);

		$repeater = new Repeater();

		ruffer_media_fields($repeater, 'bg', 'Choose Background');
		ruffer_media_fields($repeater, 'image', 'Choose Image');
		ruffer_general_fields($repeater, 'subtitle', 'Subtitle', 'TEXTAREA2', 'Ridge Shield Inspections');
		ruffer_general_fields($repeater, 'title', 'Title', 'TEXTAREA', 'Guardians of Your Roofing Peace');
		ruffer_general_fields($repeater, 'desc', 'Description', 'TEXTAREA', '');
		ruffer_general_fields($repeater, 'button_text', 'Button Text', 'TEXT', 'All Services');
		ruffer_url_fields($repeater, 'button_url', 'Button URL');
		ruffer_general_fields($repeater, 'button_text2', 'Button Text', 'TEXT', 'About us');
		ruffer_url_fields($repeater, 'button_url2', 'Button URL');
		
		$this->add_control(
			'banner_slides2',
			[
				'label' 		=> __( 'Banners', 'ruffer' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'title' 	=> __( 'Guardians of Your Roofing Peace', 'ruffer' ),
					],
				],
				'condition'	=> [
					'layout_style' => ['4', '5']
				]
			]
		);

		$repeater = new Repeater();

		ruffer_media_fields($repeater, 'bg', 'Choose Background');
		ruffer_general_fields($repeater, 'subtitle', 'Subtitle', 'TEXTAREA2', 'Ridge Shield Inspections');
		ruffer_general_fields($repeater, 'title', 'Title', 'TEXTAREA', 'Guardians of Your Roofing Peace');
		ruffer_general_fields($repeater, 'desc', 'Description', 'TEXTAREA', '');
		ruffer_general_fields($repeater, 'button_text', 'Button Text', 'TEXT', 'All Services');
		ruffer_url_fields($repeater, 'button_url', 'Button URL');
		
		$this->add_control(
			'banner_slides3',
			[
				'label' 		=> __( 'Banners', 'ruffer' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'title' 	=> __( 'Guardians of Your Roofing Peace', 'ruffer' ),
					],
				],
				'condition'	=> [
					'layout_style' => ['6']
				]
			]
		);

		$this->add_control(
            'shape',
            [
                'label'     => __( 'Choose Shape', 'ruffer' ),
                'type'      => Controls_Manager::MEDIA,
                'dynamic' 		=> [
					'active' 		=> true,
				],
				'condition'		=> [ 
					'layout_style' => [ '3', '5', '6'] 
				],
            ]
        );
		$this->add_control(
			'show_shape',
			[
				'label' 		=> __( 'Show All Shape?', 'ruffer' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Show', 'ruffer' ),
				'label_off' 	=> __( 'Hide', 'ruffer' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'yes',
				'condition'		=> [ 
					'layout_style' => [ '3'] 
				],
			]
		);

		$repeater = new Repeater();

		ruffer_media_fields($repeater, 'icon', 'Choose Icon');
		ruffer_general_fields($repeater, 'title', 'Title', 'TEXTAREA', 'Guardians of Your Roofing Peace');
		ruffer_url_fields($repeater, 'button_url', 'Button URL');
		
		$this->add_control(
			'banner_marquee',
			[
				'label' 		=> __( 'Marquee', 'ruffer' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'title' 	=> __( 'Flash Point Repairs', 'ruffer' ),
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
		ruffer_common_style_fields( $this, '01', 'Subtitle', '{{WRAPPER}} .hero-subtitle', ['3', '4', '5', '6'] );
		ruffer_common_style_fields( $this, '02', 'Title', '{{WRAPPER}} .hero-title' );
		ruffer_common_style_fields( $this, '03', 'Description', '{{WRAPPER}} .hero-text' );
		//------Button Style-------
		ruffer_button_style_fields( $this, '10', 'Button Styling', '{{WRAPPER}} .th_btn', ['2', '3', '4', '5', '6'] );
		ruffer_button_style_fields( $this, '11', 'Button 2 Styling', '{{WRAPPER}} .th_btn2', ['2', '4', '5'] );


    }

	protected function render() {

        $settings = $this->get_settings_for_display();

        if( $settings['layout_style'] == '1' ){
			echo '<div class="th-hero-wrapper hero-7" id="hero-sec" data-bg-src="'.esc_url( $settings['banner_bg']['url'] ).'">';
				echo '<div class="hero-7-thumb">';
					echo ruffer_img_tag( array(
						'url'   => esc_url( $settings['banner_img']['url'] ),
					));
				echo '</div>';
				echo '<div class="container">';
					echo '<div class="row align-items-center">';
						echo '<div class="col-xl-7 col-lg-8 col-md-7">';
							echo '<div class="hero-style7">';
								if( ! empty( $settings['title'] ) ){
									echo '<h1 class="hero-title th-title">'.esc_html( $settings['title'] ).'</h1>';
								}
								if( ! empty( $settings['desc'] ) ){
									echo '<p class="hero-text th-desc">'.esc_html( $settings['desc'] ).'</p>';
								}
								if( $settings['show_form'] == 'yes' ){
								echo '<form class="newsletter-form">';
									echo '<input class="form-control" type="email" placeholder="'.esc_html( $settings['placeholder_text'] ).'" required="">';
									echo '<button type="submit" class="th-btn">'.esc_html( $settings['form_btn_text'] ).'</button>';
								echo '</form>';
								}
								if( $settings['show_author'] == 'yes' ){
								echo '<div class="hero-profile">';
									echo '<div class="avater">';
										echo ruffer_img_tag( array(
											'url'   => esc_url( $settings['author_img']['url'] ),
										));
									echo '</div>';
									echo '<div class="media-body">';
										echo '<h4 class="title">'.wp_kses_post( $settings['author_title'] ).'</h4>';
										echo '<span class="ratting">'.wp_kses_post( $settings['author_rating'] ).'</span>';
									echo '</div>';
								echo '</div>';
								}
							echo '</div>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</div>';

		}elseif( $settings['layout_style'] == '2' ){
			echo '<div class="th-hero-wrapper hero-8" id="hero-sec">';
				echo '<div class="hero-slider-8 th-carousel" data-fade="true" data-slide-show="1" data-md-slide-show="1" data-arrows="false" data-adaptive-height="true">';
					foreach( $settings['banner_1'] as $data ){
						echo '<div class="th-hero-slide">';
							echo '<div class="th-hero-bg" data-bg-src="'.esc_url( $data['banner_img']['url'] ).'">';
								echo ruffer_img_tag( array(
									'url'   => esc_url( $data['banner_overlay']['url'] ),
								));
							echo '</div>';
							echo '<div class="container">';
								echo '<div class="row align-items-center justify-content-center">';
									echo '<div class="col-xxl-8 col-xl-8 col-lg-9">';
										echo '<div class="hero-style8 text-center">';
											if(!empty($data['title'])){
												echo '<h1 class="hero-title th-title" data-ani="slideinup" data-ani-delay="0.4s">'.wp_kses_post($data['title']).'</h1>';
											}
											if(!empty($data['desc'])){
												echo '<p class="hero-text th-desc" data-ani="slideinup" data-ani-delay="0.6s">'.esc_html($data['desc']).'</p>';
											}
											echo '<div class="btn-group justify-content-center" data-ani="slideinup" data-ani-delay="0.7s">';
												if(!empty($data['button_text'])){
													echo '<a href="'.esc_url( $data['button_link']['url'] ).'" class="th-btn style3 th_btn">'.wp_kses_post($data['button_text']).'</a>';
												}
												if(!empty($data['button_text2'])){
													echo '<a href="'.esc_url( $data['button_link2']['url'] ).'" class="th-btn style7 th_btn2">'.wp_kses_post($data['button_text2']).'</a>';
												}
											echo '</div>';
										echo '</div>';
									echo '</div>';
								echo '</div>';
							echo '</div>';
						echo '</div>';
					}
				echo '</div>';

				echo '<div class="hero-slider-indicator" data-asnavfor=".hero-slider-8">';
					foreach( $settings['banner_1'] as $key => $data ){
						$active_class = ($key == 0) ? 'active' : '';
						echo '<span class="indicator-btn '.esc_attr( $active_class ).'">';
							echo ruffer_img_tag( array(
								'url'   => esc_url( $data['banner_img']['url'] ),
							));
						echo '</span>';
					}
				echo '</div>';

				$phone      = $settings['phone'];
				$email      = $settings['email'];

				$replace        = array(' ','-',' - ');
				$replace_phone        = array(' ','-',' - ', '(', ')');
				$with           = array('','','');
		
				$emailurl       = str_replace( $replace, $with, $email );
				$phoneurl       = str_replace( $replace_phone, $with, $phone );	

				echo '<div class="hero-video-wrap">';
					if( !empty( $settings['video_url']['url'] ) ){
						echo '<a href="'.esc_url( $settings['video_url']['url'] ).'" class="play-btn popup-video"><i class="fas fa-play"></i></a>';
					}
					if(!empty($phone )){
						echo '<div class="hero-contact-wrap">';
							echo '<div class="title">'.wp_kses_post($settings['phone_label']).'</div>';
							echo '<h6><a href="'.esc_attr( 'tel:'.$phoneurl ).'">'.esc_html($phone).'</a></h6>';
						echo '</div>';
					}
					if(!empty($email )){
						echo '<div class="hero-contact-wrap">';
							echo '<div class="title">'.wp_kses_post($settings['email_label']).'</div>';
							echo '<h6><a href="'.esc_attr( 'mailto:'.$emailurl ).'">'.esc_html($email).'</a></h6>';
						echo '</div>';
					}
				echo '</div>';

			echo '</div>';

		}elseif( $settings['layout_style'] == '3' ){
			echo '<div class="th-hero-wrapper hero-10" id="hero-sec">';
				if(!empty($settings['shape']['url'])){
					echo '<div class="content-right" data-bg-src="'.esc_url( $settings['shape']['url'] ).'"></div>';
				}
				echo '<div class="hero-slider-10 th-carousel" data-fade="true" data-slide-show="1" data-md-slide-show="1" data-arrows="true" data-adaptive-height="true">'; 
					foreach( $settings['banner_slides'] as $data ){
						echo '<div class="th-hero-slide">';
							echo '<div class="content-slider-bg" data-bg-src="'.esc_url( $data['bg']['url'] ).'" data-overlay="overlay1" data-opacity="8">';
								if($settings['show_shape'] == 'yes'){
									echo '<div class="shape-mockup th-animation pulse" data-left="51%" data-top="60px">';
										echo '<img src="'.RUFFER_PLUGDIRURI . 'assets/img/icon/sparkles.svg" alt="'.esc_attr__('hero', 'ruffer').'">';
									echo '</div>';
									echo '<div class="shape-mockup th-animation pulse-1" data-left="38px" data-bottom="30px">';
										echo '<img src="'.RUFFER_PLUGDIRURI . 'assets/img/icon/sparkles.svg" alt="'.esc_attr__('hero', 'ruffer').'">';
									echo '</div>';
									echo '<div class="shape-mockup th-animation pulse-2" data-right="30%" data-bottom="180px">';
										echo '<img src="'.RUFFER_PLUGDIRURI . 'assets/img/icon/sparkles.svg" alt="'.esc_attr__('hero', 'ruffer').'">';
									echo '</div>';
								}
							echo '</div>';
							
							echo '<div class="container">';
								echo '<div class="row align-items-center justify-content-center">';
									echo '<div class="col-lg-7">';
										echo '<div class="hero-style10">';
											if(!empty($data['subtitle'])){
												echo '<span class="hero-subtitle text-theme" data-ani="slideinleft" data-ani-delay="0.1s">'.esc_html($data['subtitle']).'</span>';
											}
											if(!empty($data['title'])){
												echo '<h1 class="hero-title" data-ani="slideinleft" data-ani-delay="0.4s">'.wp_kses_post($data['title']).'</h1>';
											}
											if(!empty($data['desc'])){
												echo '<p class="hero-text" data-ani="slideinleft" data-ani-delay="0.5s">'.esc_html($data['desc']).'</p>';
											}
											if(!empty($data['button_text'])){
												echo '<div class="btn-group" data-ani="slideinleft" data-ani-delay="0.7s">';
													echo '<a href="'.esc_url( $data['button_url']['url'] ).'" class="th-btn style3 th_btn">'.esc_html($data['button_text']).'<i class="fa-regular fa-arrow-right ms-2"></i></a>';
												echo '</div>';
											}
										echo '</div>';
									echo '</div>';
									echo '<div class="col-lg-5">';
										if(!empty($data['image']['url'])){
											echo '<div class="hero-thumb">';
												echo ruffer_img_tag( array(
													'url'   => esc_url( $data['image']['url'] ),
												)); 
											echo '</div>';
										}
									echo '</div>';
								echo '</div>';
							echo '</div>';
						echo '</div>';
					}
				echo '</div>';

				echo '<div class="marquee-area ">';
					echo '<div class="container-fluid p-0">';
						echo '<div class="row">';
							echo '<div class="col-xl-8 px-lg-0">';
								echo '<div class="slider__marquee clearfix marquee-wrap overflow-hidden">';
									echo '<div class="marquee_mode marquee__group">';
										foreach( $settings['banner_marquee'] as $data ){
											echo '<h6 class="item m-item">';
												echo ruffer_img_tag( array(
													'url'   => esc_url( $data['icon']['url'] ),
													'class' => 'th-animation pulse-2',
												)); 
												if(!empty($data['title'])){
													echo '<a href="'.esc_url( $data['button_url']['url'] ).'">'.esc_html($data['title']).'</a>';
												}
											echo '</h6>';
										}
									echo '</div>';
								echo '</div>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				echo '</div>';

			echo '</div>';

		}elseif( $settings['layout_style'] == '4' ){
			echo '<div class="th-hero-wrapper hero-11" id="hero-sec">';
				echo '<div class="hero-slider-11 th-carousel" data-fade="true" data-slide-show="1" data-md-slide-show="1" data-arrows="true" data-adaptive-height="true">';
				foreach( $settings['banner_slides2'] as $data ){
					echo '<div class="th-hero-slide" data-bg-src="'.esc_url( $data['bg']['url'] ).'" data-overlay="overlay1" data-opacity="8">';
						if(!empty($data['image']['url'])){
							echo '<div class="hero-mask d-none d-lg-block">';
								echo ruffer_img_tag( array(
									'url'   => esc_url( $data['image']['url'] ),
								)); 
							echo '</div>';
						}
						echo '<div class="container">';
							echo '<div class="row align-items-center">';
								echo '<div class="col-lg-8">';
									echo '<div class="slider-content">';
										if(!empty($data['subtitle'])){
											echo '<span class="hero-subtitle" data-ani="slideinleft" data-ani-delay="0.1s">'.esc_html($data['subtitle']).'</span>';
										}
										if(!empty($data['title'])){
											echo '<h1 class="hero-title mb-lg-3" data-ani="slideinleft" data-ani-delay="0.4s">'.wp_kses_post($data['title']).'</h1>';
										}
										if(!empty($data['desc'])){
											echo '<p class="hero-text" data-ani="slideinleft" data-ani-delay="0.6s">'.esc_html($data['desc']).'</p>';
										}
										echo '<div class="btn-group" data-ani="slideinleft" data-ani-delay="0.7s">';
											if(!empty($data['button_text'])){
												echo '<a href="'.esc_url( $data['button_url']['url'] ).'" class="th-btn style2 th_btn">'.esc_html($data['button_text']).'<i class="fa-regular fa-arrow-right ms-1"></i></a>';
											}
											if(!empty($data['button_text2'])){
												echo '<a href="'.esc_url( $data['button_url2']['url'] ).'" class="th-btn style4 th_btn2">'.esc_html($data['button_text2']).'<i class="fa-regular fa-arrow-right ms-1"></i></a>';
											}
										echo '</div>';
									echo '</div>';
								echo '</div>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				}
				echo '</div>';
			echo '</div>';

		}elseif( $settings['layout_style'] == '5' ){
			echo '<div class="th-hero-wrapper hero-12" id="hero-sec">';
				echo '<div class="hero-slider-11 th-carousel" data-fade="true" data-slide-show="1" data-md-slide-show="1" data-arrows="false" data-adaptive-height="true">';
					foreach( $settings['banner_slides2'] as $data ){
						echo '<div class="th-hero-slide">';
							echo '<div class="th-hero-bg" data-bg-src="'.esc_url( $data['bg']['url'] ).'">';
							if(!empty($settings['shape']['url'])){
								echo ruffer_img_tag( array(
									'url'   => esc_url( $settings['shape']['url'] ),
								)); 
							}
							echo '</div>';
							echo '<div class="container-fluid">';
								echo '<div class="row align-items-center">';
									echo '<div class="col-md-8 col-xxl-5 offset-xxl-2">';
										echo '<div class="slider-content">';
											if(!empty($data['subtitle'])){
												echo '<span class="hero-subtitle" data-ani="slideinleft" data-ani-delay="0.1s">'.esc_html($data['subtitle']).'</span>';
											}
											if(!empty($data['title'])){
												echo '<h1 class="hero-title" data-ani="slideinup" data-ani-delay="0.4s">'.wp_kses_post($data['title']).'</h1>';
											}
											if(!empty($data['desc'])){
												echo '<p class="hero-text fw-medium" data-ani="slideinup" data-ani-delay="0.6s">'.esc_html($data['desc']).'</p>';
											}
											echo '<div class="btn-group" data-ani="slideinup" data-ani-delay="0.7s">';
												if(!empty($data['button_text'])){
													echo '<a href="'.esc_url( $data['button_url']['url'] ).'" class="th-btn style3 th_btn">'.esc_html($data['button_text']).'<i class="fa-regular fa-arrow-right ms-1"></i></a>';
												}
												if(!empty($data['button_text2'])){
													echo '<a href="'.esc_url( $data['button_url2']['url'] ).'" class="th-btn style7 th_btn2">'.esc_html($data['button_text2']).'<i class="fa-regular fa-arrow-right ms-1"></i></a>';
												}
											echo '</div>';
										echo '</div>';
									echo '</div>';
								echo '</div>';
							echo '</div>';
						echo '</div>';
					}
				echo '</div>';
				echo '<div class="hero-slider-indicator" data-asnavfor=".hero-slider-11">';
					foreach( $settings['banner_slides2'] as $key => $data ){
						$active = ($key == 0) ? 'active':'';
						echo '<span class="indicator-btn '.esc_attr($active).'">';
							echo ruffer_img_tag( array(
								'url'   => esc_url( $data['image']['url'] ),
							)); 
						echo '</span>';
					}
				echo '</div>';
			echo '</div>';

		}elseif( $settings['layout_style'] == '6' ){
			echo '<div class="th-hero-wrapper position-relative z-1 hero-13" id="hero-sec">';
				if(!empty($settings['shape']['url'])){
					echo '<div class="mask-clip">';
						echo ruffer_img_tag( array(
							'url'   => esc_url( $settings['shape']['url'] ),
						)); 
					echo '</div>';
				}
				echo '<div class="th-carousel" data-fade="true" data-slide-show="1" data-md-slide-show="1" data-arrows="false" data-dots="true" data-adaptive-height="true">';
				foreach( $settings['banner_slides3'] as $data ){
					echo '<div class="th-hero-slide">';
						echo '<div class="th-hero-bg" data-bg-src="'.esc_url( $data['bg']['url'] ).'" data-overlay="overlay1" data-opacity="8"></div>';
						echo '<div class="container">';
							echo '<div class="row align-items-center">';
								echo '<div class="col-xxl-7  col-md-8">';
									echo '<div class="hero-style9">';
										if(!empty($data['subtitle'])){
											echo '<span class="hero-subtitle sub-title" data-ani="slideinleft" data-ani-delay="0.1s">'.esc_html($data['subtitle']).'</span>';
										}
										if(!empty($data['title'])){
											echo '<h1 class="hero-title " data-ani="slideinleft" data-ani-delay="0.4s">'.wp_kses_post($data['title']).'</h1>';
										}
										if(!empty($data['desc'])){
											echo '<p class="hero-text fw-medium" data-ani="slideinup" data-ani-delay="0.6s">'.esc_html($data['desc']).'</p>';
										}
										if(!empty($data['button_text'])){
											echo '<div class="btn-group" data-ani="slideinleft" data-ani-delay="0.7s">';
												echo '<a href="'.esc_url( $data['button_url']['url'] ).'" class="th-btn style3 th_btn">'.esc_html($data['button_text']).'<i class="fa-regular fa-arrow-right ms-1"></i></a>';
											echo '</div>';
										}
									echo '</div>';
								echo '</div>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				}
				echo '</div>';
			echo '</div>';

		}


	}
}