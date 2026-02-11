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
 * WorkProcess Box Widget .
 *
 */
class Ruffer_WorkProcess_Box extends Widget_Base {

	public function get_name() {
		return 'rufferworkprocess';
	}
	public function get_title() {
		return __( 'Work Process / Step', 'ruffer' );
	}
	public function get_icon() {
		return 'eicon-code';
    }
	public function get_categories() {
		return [ 'ruffer' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'feature_section',
			[
				'label' 	=> __( 'WorkProcess', 'ruffer' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );

		$this->add_control(
			'layout_style',
			[
				'label' 		=> __( 'Style', 'ruffer' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> '1',
				'options'		=> [
					'1'  		=> __( 'Style One', 'ruffer' ),
					'2' 		=> __( 'Style Two', 'ruffer' ),
					'3' 		=> __( 'Style Three', 'ruffer' ),
					'4' 		=> __( 'Style Four', 'ruffer' ),
					'5' 		=> __( 'Style Five', 'ruffer' ),
					'6' 		=> __( 'Style Six', 'ruffer' ),
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
                'rows' 		=> 3,
			]
        );
        $repeater->add_control(
			'image',
			[
				'label' 	=> __( 'Image', 'ruffer' ),
				'type' 		=> Controls_Manager::MEDIA,
				'default' => [
					'url' 	=> Utils::get_placeholder_image_src(),
				],
			]
		);
        $this->add_control(
			'steps',
			[
				'label' 		=> __( 'Work Process', 'ruffer' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'title' 		=> __( 'title', 'ruffer' ),
					],
				],
				'condition'		=> [ 
					'layout_style' => [ '1', '2', '6' ] 
				],
			]
		);

		$repeater = new Repeater();

		ruffer_media_fields( $repeater, 'icon', 'Choose Icon' );
		ruffer_general_fields( $repeater, 'title', 'Title', 'TEXTAREA', 'Market Pulse Analytic' );
		ruffer_general_fields( $repeater, 'content', 'Content', 'TEXTAREA', 'WBusiness consulting firms offer a range of services including mans strategic planning, financial' );
        
		ruffer_general_fields( $repeater, 'button_text', 'Button Text', 'TEXT', 'Read More' );
		ruffer_url_fields( $repeater, 'button_url', 'Button URL' );

		$this->add_control(
			'steps2',
			[
				'label' 		=> __( 'Work Process', 'ruffer' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'title' 		=> __( 'Market Pulse Analytic', 'ruffer' ),
					],
				],
				'condition'		=> [ 
					'layout_style' => [ '3' ] 
				],
			]
		);

		
		$repeater = new Repeater();

		ruffer_media_fields( $repeater, 'image', 'Choose Image' );
		ruffer_media_fields( $repeater, 'icon', 'Choose Icon' );
		ruffer_general_fields( $repeater, 'title', 'Title', 'TEXTAREA', 'Market Pulse Analytic' );
		ruffer_general_fields( $repeater, 'content', 'Content', 'TEXTAREA', 'WBusiness consulting firms offer a range of services including mans strategic planning, financial' );

		$this->add_control(
			'steps3',
			[
				'label' 		=> __( 'Work Process', 'ruffer' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'title' 		=> __( 'Market Pulse Analytic', 'ruffer' ),
					],
				],
				'condition'		=> [ 
					'layout_style' => [ '4' ] 
				],
			]
		);

		$repeater = new Repeater();

		ruffer_general_fields( $repeater, 'subtitle', 'Subitle', 'TEXTAREA', 'Step' );
		ruffer_general_fields( $repeater, 'title', 'Title', 'TEXTAREA', 'Peak Performance in Roofing' );
		ruffer_general_fields( $repeater, 'content', 'Content', 'TEXTAREA', 'We recommend an annual roof is inspection to catch potential.' );

		$this->add_control(
			'steps4',
			[
				'label' 		=> __( 'Work Process', 'ruffer' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'title' 		=> __( 'Peak Performance in Roofing', 'ruffer' ),
					],
				],
				'condition'		=> [ 
					'layout_style' => [ '5' ] 
				],
			]
		);

		$this->add_control(
			'line_image',
			[
				'label' 	=> __( 'Line Image', 'ruffer' ),
				'type' 		=> Controls_Manager::MEDIA,
				'default' => [
					'url' 	=> Utils::get_placeholder_image_src(),
				],
				'condition'		=> [ 'layout_style' => [ '1', '6'] ],
			]
		);
        
        $this->end_controls_section();

        //---------------------------------------
			//Style Section Start
		//---------------------------------------
		ruffer_common_style_fields( $this, '01', 'Title', '{{WRAPPER}} .title' );
		ruffer_common_style_fields( $this, '02', 'Content', '{{WRAPPER}} .content' );

	}

	protected function render() {

        $settings = $this->get_settings_for_display();


		if( $settings['layout_style'] == '1' ){
			echo '<div class="process-card-area">';
				if(!empty($settings['line_image']['url'])){
					echo '<div class="process-line">';
						echo '<img src="'.esc_url( $settings['line_image']['url'] ).'" alt="line">';
					echo '</div>';
				}
				echo '<div class="row gy-40 justify-content-center">';
					$i = 0;
					foreach( $settings['steps'] as $data ) { 
						$i++;
						$k = str_pad($i, 2, '0', STR_PAD_LEFT);
						echo '<div class="col-md-6 col-lg-4 process-card-wrap">';
							echo '<div class="process-card">';
								echo '<div class="process-card_number">'.esc_html($k).'</div>';
								if(!empty($data['image']['url'])){
									echo '<div class="process-card_icon">';
										echo '<img src="'.esc_url( $data['image']['url'] ).'" alt="Image">';
									echo '</div>';
								}
								if( ! empty( $data['title'] ) ){
									echo '<h2 class="box-title title">'.esc_html( $data['title'] ).'</h2>';
								}
								if( ! empty( $data['content'] ) ){
									echo '<p class="process-card_text content">'.esc_html( $data['content'] ).'</p>';
								}
							echo '</div>';
						echo '</div>';
					}               
				echo ' </div>';
			echo '</div>'; 
			
		}elseif( $settings['layout_style'] == '2' ){
			echo '<div class="process-card-area">';
				echo '<div class="row gy-40 justify-content-xl-between justify-content-center">';
					$i = 0;
					foreach( $settings['steps'] as $data ) { 
						$i++;
						$k = str_pad($i, 2, '0', STR_PAD_LEFT);
					echo '<div class="col-md-6 col-xl-4">';
						echo '<div class="process-card style2">';
							if(!empty($data['image']['url'])){
								echo '<div class="process-card_icon">';
									echo '<div class="process-card_num-wrap">';
										echo '<div class="process-card_num">'.esc_html($k).'</div>';
									echo '</div>';
									echo '<img src="'.esc_url( $data['image']['url'] ).'" alt="Image">';
								echo '</div>';
							}
							if( ! empty( $data['title'] ) ){
								echo '<h2 class="box-title title">'.esc_html( $data['title'] ).'</h2>';
							}
							if( ! empty( $data['content'] ) ){
								echo '<p class="process-card_text content">'.esc_html( $data['content'] ).'</p>';
							}
						echo '</div>';
					echo '</div>';
					}
				echo '</div>';
			echo '</div>';

		}elseif( $settings['layout_style'] == '3' ){
			echo '<div class="row justify-content-center gy-5">';
				$i = 0;
				foreach( $settings['steps2'] as $data ) { 
					$i++;
					$k = str_pad($i, 2, '0', STR_PAD_LEFT);
					echo '<div class="col-xl-3 col-lg-4 col-md-6">';
						echo '<div class="card variant-2">';
							echo '<span class="card-count">'.esc_html($k).'</span>';
							echo '<div class="card-body">';
								if($data['icon']['url'] ){
									echo '<div class="card-icon">';
										echo ruffer_img_tag( array(
											'url'   => esc_url( $data['icon']['url'] ),
										));
									echo '</div>';
								}
								if( ! empty( $data['title'] ) ){
									echo '<h3 class="card-title title">'.esc_html( $data['title'] ).'</h3>';
								}
								if( ! empty( $data['content'] ) ){
									echo '<p class="card-text content">'.esc_html( $data['content'] ).'</p>';
								}
								if(!empty($data['button_text'])){
                                    echo '<a href="'.esc_url( $data['button_url']['url'] ).'" class="link-btn">'.wp_kses_post($data['button_text']).'<i class="fa-solid fa-arrow-up-right ms-2"></i></a>';
                                }
							echo '</div>';
						echo '</div>';
					echo '</div>';
				}
			echo '</div>';

		}elseif( $settings['layout_style'] == '4' ){
			echo '<div class="row justify-content-center gy-3 gy-xl-0 ">';
				$i = 0; 
				foreach( $settings['steps3'] as $data ) { 
					$i++;
					$k = str_pad($i, 2, '0', STR_PAD_LEFT);
					echo '<div class="col-md-6 col-xl-4">';
						echo '<div class="card h-100 variant-4 tilt-active">';
							echo '<div class="card-body">';
								echo '<div class="card-img-top">';
									echo ruffer_img_tag( array(
										'url'   => esc_url( $data['image']['url'] ),
									));
									if($data['icon']['url'] ){
										echo '<div class="card-icon">';
											echo ruffer_img_tag( array(
												'url'   => esc_url( $data['icon']['url'] ),
											));
										echo '</div>';
									}
									echo '<span class="card-count">'.esc_html($k).'</span>';
								echo '</div>';
								if( ! empty( $data['title'] ) ){
									echo '<h5 class="card-title title">'.esc_html( $data['title'] ).'</h5>';
								}
								if( ! empty( $data['content'] ) ){
									echo '<p class="content">'.esc_html( $data['content'] ).'</p>';
								}
							echo '</div>';
						echo '</div>';
					echo '</div>';
				}
			echo '</div>';

		}elseif( $settings['layout_style'] == '5' ){
			echo '<div class="process-card-area layout-4">'; 
				echo '<div class="row gap-5 gap-xl-0 gx-0 justify-content-around justify-content-xl-between">';
					foreach( $settings['steps4'] as $data ) { 
						echo '<div class="col-md-6 col-xl-3 process-card-wrap">';
							echo '<div class="process-card style4">';
								if( ! empty( $data['subtitle'] ) ){
									echo '<div class="process-card_number">'.wp_kses_post( $data['subtitle'] ).'</div>';
								}
								if( ! empty( $data['title'] ) ){
									echo '<h2 class="box-title title">'.esc_html( $data['title'] ).'</h2>';
								}
								if( ! empty( $data['content'] ) ){
									echo '<p class="process-card_text content">'.esc_html( $data['content'] ).'</p>';
								}
							echo '</div>';
						echo '</div>';
					}
				echo '</div>';
			echo '</div>';

		}elseif( $settings['layout_style'] == '6' ){
			echo '<div class="process-card-area layout2">';
				echo '<div class="row gy-40 justify-content-xl-around justify-content-center">';
					if(!empty($settings['line_image']['url'])){
						echo '<div class="process-line">';
							echo ruffer_img_tag( array(
								'url'   => esc_url( $settings['line_image']['url'] ),
							));
						echo '</div>';
					}
					$i = 0;
					foreach( $settings['steps'] as $data ) { 
						$i++;
						$k = str_pad($i, 2, '0', STR_PAD_LEFT);
						echo '<div class="col-md-6 col-xl-3">';
							echo '<div class="process-card style3">';
								echo '<div class="process-card-cover-wrap">';
									echo '<div class="process-card_num-wrap">';
										echo '<div class="process-card_num">'.esc_html($k).'</div>';
									echo '</div>';
									if(!empty($data['image']['url'])){
										echo '<div class="process-card-cover" data-mask-src="'.RUFFER_PLUGDIRURI . 'assets/img/process-mask-1.png">';
											echo ruffer_img_tag( array(
												'url'   => esc_url( $data['image']['url'] ),
												'class' => 'tilt-active',
											));
										echo '</div>';
									}
								echo '</div>';
								if( ! empty( $data['title'] ) ){
									echo '<h2 class="box-title title">'.esc_html( $data['title'] ).'</h2>';
								}
								if( ! empty( $data['content'] ) ){
									echo '<p class="process-card_text content">'.esc_html( $data['content'] ).'</p>';
								}
							echo '</div>';
						echo '</div>';
					}
				echo '</div>';
			echo '</div>';

		}



	}
}