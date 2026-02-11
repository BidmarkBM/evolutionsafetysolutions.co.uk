<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Border;
use \Elementor\Utils;
use \Elementor\Repeater;
use \Elementor\Group_Control_Box_Shadow;
/**
 *
 * WCU Widget .
 *
 */
class Ruffer_Chose_Us_2 extends Widget_Base {

	public function get_name() {
		return 'rufferwcu2';
	}
	public function get_title() {
		return __( 'Why Chose Us 2', 'ruffer' );
	}
	public function get_icon() {
		return 'eicon-code';
    }
	public function get_categories() {
		return [ 'ruffer' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'heading_section',
			[
				'label'		 	=> __( 'Section Heading', 'ruffer' ),
				'tab' 			=> Controls_Manager::TAB_CONTENT,
			]
        );

		ruffer_select_field( $this, 'layout_style', 'Layout Style', [ 'Style One', 'Style Two', 'Style Three', 'Style Four', 'Style Five' ] );

		ruffer_media_fields( $this, 'bg', 'Choose Background', ['3', '4'] );
		ruffer_media_fields( $this, 'image', 'Choose Image', ['4'] );
		ruffer_url_fields( $this, 'video_url', 'Video URL', ['4'] );
		ruffer_general_fields( $this, 'section_subtitle', 'Subitle', 'TEXTAREA2', 'WHY CHOOSE US', ['1', '3', '4'] );
		ruffer_general_fields( $this, 'section_title', 'Title', 'TEXTAREA', 'Quality roofing for every Structure.', ['1', '3', '4'] );
		ruffer_general_fields( $this, 'section_desc', 'Description', 'TEXTAREA', '', ['4'] );

		ruffer_media_fields( $this, 'thumb', 'Choose Image', ['1', '3'] );
		ruffer_media_fields( $this, 'shape', 'Choose Shape', ['2'] );

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
                'rows' 		=> 3,
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
				'label' 		=> __( 'Features', 'ruffer' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'title' 		=> __( 'title', 'ruffer' ),
					],
				],
				'condition'		=> [ 
					'layout_style' => [ '1', '2' ] 
				],
			]
		);

		$repeater = new Repeater();

		ruffer_media_fields($repeater, 'icon', 'Choose Icon');
		ruffer_general_fields($repeater, 'title', 'Title', 'TEXTAREA2', 'Peak Inspect Roofing');
		ruffer_general_fields($repeater, 'description', 'Description', 'TEXTAREA', 'Its recommended to have your roof inspected at least once a year'); 

		$this->add_control(
			'features3',
			[
				'label' 		=> __( 'Feature Lists', 'ruffer' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'title' 	=> __( 'Peak Inspect Roofing', 'ruffer' ),
					],
				],
				'condition'	=> [
					'layout_style' => ['3', '4']
				]
			]
		);

		$repeater = new Repeater();

		ruffer_media_fields($repeater, 'icon', 'Choose Icon');
		ruffer_general_fields($repeater, 'title', 'Title', 'TEXTAREA2', 'Peak Inspect Roofing');
		ruffer_url_fields($repeater, 'button_url', 'Button URL');

		$this->add_control(
			'features4',
			[
				'label' 		=> __( 'Feature Lists', 'ruffer' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'title' 	=> __( 'Peak Inspect Roofing', 'ruffer' ),
					],
				],
				'condition'	=> [
					'layout_style' => ['5']
				]
			]
		);

        $this->end_controls_section();


        //---------------------------------------
			//Style Section Start
		//---------------------------------------
		ruffer_common_style_fields( $this, '01', 'Section Subtitle', '{{WRAPPER}} .sub-title', ['1', '3', '4'] );
		ruffer_common_style_fields( $this, '02', 'Section Title', '{{WRAPPER}} .sec-title', ['1', '3', '4'] );
		ruffer_common_style_fields( $this, '022', 'Section Description', '{{WRAPPER}} .sec-text', ['4'] );

		ruffer_common_style_fields( $this, '03', 'Title', '{{WRAPPER}} .wcu-card_title a', ['1', '2', '5'] );
		ruffer_common_style_fields( $this, '04', 'Content', '{{WRAPPER}} .wcu-card_text', ['1', '2'] );

		ruffer_common_style_fields( $this, '033', 'Title', '{{WRAPPER}} .about-feature_title', ['4'] );
		ruffer_common_style_fields( $this, '044', 'Content', '{{WRAPPER}} .about-feature_text', ['4'] );


	}

	protected function render() {

        $settings = $this->get_settings_for_display();
		if( $settings['layout_style'] == '1' ){
			echo '<div class="why-sec-v3 position-relative space-bottom">';
				if( ! empty( $settings['thumb']['url'] ) ){
					echo '<div class="img-half img-right wcu-thumb-3">';
						echo '<img src="'.$settings['thumb']['url'].'" alt="img">';
					echo '</div>';
				}
				echo '<div class="container">';
					echo '<div class="row">';
						echo '<div class="col-xxl-7 col-xl-8">';
							echo '<div class="title-area mb-35">';
								if( ! empty( $settings['section_title'] ) ){
									echo '<span class="sub-title">'.esc_html( $settings['section_title'] ).'</span>';
								}
								if( ! empty( $settings['section_subtitle'] ) ){
									echo '<h2 class="sec-title">'.esc_html( $settings['section_subtitle'] ).'</h2>';
								}
							echo '</div>';
							echo '<div class="wcu-card-slider th-carousel row g-0" data-slide-show="3" data-ml-slide-show="3" data-md-slide-show="3" data-sm-slide-show="2" data-dots="false">';
								foreach( $settings['features2'] as $data ) {  
									echo '<div class="col-sm-6">';
										echo '<div class="wcu-card-wrap mt-10 bg-white">';
											echo '<div class="wcu-card style3">';
												if( ! empty( $data['image']['url'] ) ){
													echo '<div class="wcu-card_icon">';
														echo '<img src="'.$data['image']['url'].'" alt="img">';
													echo '</div>';
												}
												echo '<div class="wcu-card_details">';
													if( ! empty( $data['title'] ) ){
														echo '<h3 class="h5 wcu-card_title"><a href="'.esc_url( $data['url'] ).'">'.esc_html( $data['title'] ).'</a></h3>';
													}
													if( ! empty( $data['content'] ) ){
														echo '<p class="wcu-card_text">'.esc_html( $data['content'] ).'</p>';
													}
												echo '</div>';
											echo '</div>';
										echo '</div>';
									echo '</div>';
								}
							echo '</div>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</div>';

		}elseif( $settings['layout_style'] == '2' ){
			echo '<div class="row gx-30 gy-4 gy-xl-0">';
				foreach( $settings['features2'] as $key => $data ) {  
					$card_class = $key % 2 === 0 ? 'bg-theme' : 'bg-title';

					echo '<div class="col-xl-3 col-lg-4 col-md-6">';
						echo '<div class="wcu-card style5 ' . $card_class . '">';
							if( ! empty( $settings['shape']['url'] ) ){
								echo '<div class="wcu-card_bg">';
									echo ruffer_img_tag( array(
										'url'   => esc_url( $settings['shape']['url'] ),
									));
								echo '</div>';
							}
							if( ! empty( $data['image']['url'] ) ){
								echo '<div class="wcu-card_icon">';
									echo ruffer_img_tag( array(
										'url'   => esc_url( $data['image']['url'] ),
									));
								echo '</div>';
							}
							echo '<div class="wcu-card_details">';
								if( ! empty( $data['title'] ) ){
									echo '<h3 class="wcu-card_title"><a href="'.esc_url( $data['url'] ).'">'.esc_html( $data['title'] ).'</a></h3>';
								}
								if( ! empty( $data['content'] ) ){
									echo '<p class="wcu-card_text">'.esc_html( $data['content'] ).'</p>';
								}
							echo '</div>';
						echo '</div>';
					echo '</div>';
				}
			echo '</div>';
       
		}elseif( $settings['layout_style'] == '3' ){
			echo '<div class="inner-wrapper layout-11">';
				if( ! empty( $settings['bg']['url'] ) ){
					echo '<div class="mask">';
						echo ruffer_img_tag( array(
							'url'   => esc_url( $settings['bg']['url'] ),
						));
					echo '</div>';
				}
				echo '<div class="row justify-content-center">';
					echo '<div class="col-lg-6">';
						echo '<div class="title-area text-center">';
							if( ! empty( $settings['section_subtitle'] ) ){
								echo '<span class="sub-title">'.esc_html( $settings['section_subtitle'] ).'</span>';
							}
							if( ! empty( $settings['section_title'] ) ){
								echo '<h2 class="sec-title">'.esc_html( $settings['section_title'] ).'</h2>';
							}
						echo '</div>';
					echo '</div>';
					echo '<div class="col-12">';
						echo '<div class="row gy-4 gy-md-5 gy-xl-3 align-items-center">';
							echo '<div class="col-md-6 col-xl-4 order-2 order-xl-0">';
								echo '<div class="row justify-content-xl-end gy-4 gy-md-5">';
									foreach( $settings['features3'] as $key => $data ) {  
										if ($key % 2 == 0) {
											echo '<div class="col-xxl-10">';
												echo '<div class="choose-card text-center text-sm-start flex-xl-row-reverse">';
													if(!empty($data['icon']['url'])){
														echo '<div class="icon">';
															echo ruffer_img_tag( array(
																'url'   => esc_url( $data['icon']['url'] ),
															));
														echo '</div>';
													}
													echo '<div class="info text-xl-end">';
														if(!empty($data['title'])){
															echo '<h3>'.esc_html($data['title']).'</h3>';
														}
														if(!empty($data['description'])){
															echo '<p>'.esc_html($data['description']).'</p>';
														}
													echo '</div>';
												echo '</div>';
											echo '</div>';
										}
									}
								echo '</div>';
							echo '</div>';

							echo '<div class="col-xl-4 order-1 order-xl-0">';
								if( ! empty( $settings['thumb']['url'] ) ){
									echo '<div class="text-center mb-5 mb-md-0">';
										echo ruffer_img_tag( array(
											'url'   => esc_url( $settings['thumb']['url'] ),
										));
									echo '</div>';
								}
							echo '</div>';

							echo '<div class="col-md-6 col-xl-4 order-3 order-xl-0">';
								echo '<div class="row gy-4 gy-md-5">';
									foreach( $settings['features3'] as $key => $data ) {  
										if ($key % 2 != 0) {
											echo '<div class="col-xxl-10">';
												echo '<div class="choose-card text-center text-sm-start">';
													if(!empty($data['icon']['url'])){
														echo '<div class="icon">';
															echo ruffer_img_tag( array(
																'url'   => esc_url( $data['icon']['url'] ),
															));
														echo '</div>';
													}
													echo '<div class="info">';
														if(!empty($data['title'])){
															echo '<h3>'.esc_html($data['title']).'</h3>';
														}
														if(!empty($data['description'])){
															echo '<p>'.esc_html($data['description']).'</p>';
														}
													echo '</div>';
												echo '</div>';
											echo '</div>';
										}
									}
								echo '</div>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</div>';

		}elseif( $settings['layout_style'] == '4' ){
			echo '<div class="why-sec-v8 ">';
				echo '<div class="container">';
					echo '<div class="row gy-5 gy-xl-0">';
						echo '<div class="col-auto">';
							if( ! empty( $settings['image']['url'] ) ){
								echo '<div class="img-box13">';
									echo ruffer_img_tag( array(
										'url'   => esc_url( $settings['image']['url'] ),
									));
									if(!empty($settings['video_url']['url'])){
										echo '<a href="'.esc_url( $settings['video_url']['url'] ).'" class="play-btn popup-video style5">';
											echo '<i class="fas fa-play"></i>';
										echo '</a>';
									}
								echo '</div>';
							}
						echo '</div>';
						echo '<div class="col-xl-8 offset-xl-4">';
							echo '<div class="card" data-bg-src="'.esc_url( $settings['bg']['url'] ).'">';
								echo '<div class="card-body">';
									echo '<div class="title-area">';
										if( ! empty( $settings['section_subtitle'] ) ){
											echo '<span class="sub-title">'.esc_html( $settings['section_subtitle'] ).'</span>';
										}
										if( ! empty( $settings['section_title'] ) ){
											echo '<h2 class="sec-title">'.esc_html( $settings['section_title'] ).'</h2>';
										}
										if( ! empty( $settings['section_desc'] ) ){
											echo '<p class="sec-text">'.esc_html( $settings['section_desc'] ).'</p>';
										}
									echo '</div>';
									echo '<div class="about-feature-wrap">';
										foreach( $settings['features3'] as $data ) {  
											echo '<div class="about-feature">';
												if(!empty($data['icon']['url'])){
													echo '<div class="about-feature_icon">';
														echo ruffer_img_tag( array(
															'url'   => esc_url( $data['icon']['url'] ),
														));
													echo '</div>';
												}
												echo '<div class="media-body">';
													if(!empty($data['title'])){
														echo '<h3 class="about-feature_title">'.esc_html($data['title']).'</h3>';
													}
													if(!empty($data['description'])){
														echo '<p class="about-feature_text">'.esc_html($data['description']).'</p>';
													}
												echo '</div>';
											echo '</div>';
										}
									echo '</div>';
								echo '</div>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</div>';

		}elseif( $settings['layout_style'] == '5' ){
			echo '<div class="wcu-card-slider layout2 th-carousel overflow-hidden row" data-slide-show="3" data-ml-slide-show="2" data-md-slide-show="3" data-sm-slide-show="2" data-dots="false" data-center-mode="true">';
				foreach( $settings['features4'] as $data ) {  
					echo '<div class="col-sm-6">';
						echo '<div class="wcu-card style4">';
							if(!empty($data['icon']['url'])){
								echo '<div class="wcu-card_icon">';
									echo ruffer_img_tag( array(
										'url'   => esc_url( $data['icon']['url'] ),
									));
								echo '</div>';
							}
							if(!empty($data['title'])){
								echo '<div class="wcu-card_details">';
									echo '<h3 class="h5 wcu-card_title"><a href="'.esc_url( $data['button_url']['url'] ).'">'.esc_html($data['title']).'</a></h3>';
								echo '</div>';
							}
						echo '</div>';
					echo '</div>';
				}
			echo '</div>';

		}


	}
}