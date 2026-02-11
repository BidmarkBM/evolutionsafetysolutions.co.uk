<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Group_Control_Border;
/**
 *
 * Counter Up Widget .
 *
 */
class Ruffer_Counterup extends Widget_Base {

	public function get_name() {
		return 'ruffercounterup';
	}
	public function get_title() {
		return __( 'Counter Up', 'ruffer' );
	}
	public function get_icon() {
		return 'eicon-code';
    }
	public function get_categories() {
		return [ 'ruffer' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'counter_section',
			[
				'label' 	=> __( 'Counterup', 'ruffer' ),
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
				],
			]
		);   

		$this->add_control(
            'bg',
            [
                'label'     => __( 'Banner Background', 'ruffer' ),
                'type'      => Controls_Manager::MEDIA,
                'dynamic' 		=> [
					'active' 		=> true,
				],
				'condition'		=> [ 
					'layout' => [ '7'] 
				],
            ]
        );

		$repeater = new Repeater();

		$repeater->add_control(
			'counter_number',
			[
				'label'     => __( 'Counter Number', 'ruffer' ),
				'type'      => Controls_Manager::TEXTAREA,
				'rows' 		=> 2,
				'default' 	=> __( '25', 'ruffer' ),
			]
		);
		$repeater->add_control(
			'counter_suffix',
			[
				'label'     => __( 'Counter Suffix', 'ruffer' ),
				'type'      => Controls_Manager::TEXTAREA,
				'rows' 		=> 2,
				'default' 	=> __( 'k+', 'ruffer' ),
			]
		);
		$repeater->add_control(
			'counter_text',
			[
				'label'     => __( 'Counter Text', 'ruffer' ),
				'type'      => Controls_Manager::TEXTAREA,
				'rows' 		=> 2,
				'default' 	=> __( 'Years Of Experience', 'ruffer' ),
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
			'counter',
			[
				'label' 		=> __( 'Counter', 'ruffer' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'counter_text' 		=> __( 'Counter One', 'ruffer' ),
					],
				],
				'title_field' 	=> '{{{ counter_text }}}',
			]
		);
		
		$this->end_controls_section();

        //---------------------------------------
			//Style Section Start
		//---------------------------------------
		ruffer_common_style_fields( $this, '01', 'Number', '{{WRAPPER}} .th-num' );
		ruffer_common_style_fields( $this, '02', 'Text', '{{WRAPPER}} .th-text' );

	}

	protected function render() {

        $settings = $this->get_settings_for_display();

        if( $settings['layout'] == '1' ){
        	echo '<div class="row gy-40 justify-content-between">';
               	foreach( $settings['counter'] as $data ) {  
	                echo '<div class="col-6 col-lg-auto counter-card-wrap">';
	                    echo '<div class="counter-card">';
	                    	if( ! empty( $data['image']['url'] ) ){
		                        echo '<div class="counter-card_icon">';
		                            echo '<img src="'.$data['image']['url'].'" alt="Icon">';
		                        echo '</div>';
		                    }

	                        echo '<div class="media-body">';
	                            if( ! empty( $data['counter_number'] ) ){
			                		$suffix = ( $data['counter_suffix'] ) ? $data['counter_suffix'] : '';

				                    echo '<h2 class="counter-card_number th-num"><span class="counter-number">'.esc_html( $data['counter_number'] ).'</span>'.esc_html($suffix).'</h2>';
				                }
	                            if( !empty( $data['counter_text'] ) ){
				                    echo '<span class="counter-card_text th-text">'.esc_html( $data['counter_text'] ).'</span>';
				                }
	                        echo '</div>';
	                    echo '</div>';
	                echo '</div>';
	            }
            echo '</div>';

	    }elseif( $settings['layout'] == '2' ){
	    	echo '<div class="row gy-40 justify-content-between">';
                foreach( $settings['counter'] as $data ) {  
	                echo '<div class="col-6 col-lg-auto counter-card-wrap style2">';
	                    echo '<div class="counter-card style2">';
	                    	if( ! empty( $data['image']['url'] ) ){
		                        echo '<div class="counter-card_icon">';
		                            echo '<img src="'.$data['image']['url'].'" alt="Icon">';
		                        echo '</div>';
		                    }
	                        echo '<div class="media-body">';
	                            if( ! empty( $data['counter_number'] ) ){
			                		$suffix = ( $data['counter_suffix'] ) ? $data['counter_suffix'] : '';

				                    echo '<h2 class="counter-card_number th-num"><span class="counter-number">'.esc_html( $data['counter_number'] ).'</span>'.esc_html($suffix).'</h2>';
				                }
				                if( !empty( $data['counter_text'] ) ){
		                            echo '<p class="counter-card_text th-text">'.esc_html( $data['counter_text'] ).'</p>';
		                        }
	                        echo '</div>';
	                    echo '</div>';
	                echo '</div>';
	            } 
            echo '</div>';

	    }elseif( $settings['layout'] == '3' ){
	    	echo '<div class="row gy-4 justify-content-center">';
                foreach( $settings['counter'] as $data ) {          
	                echo '<div class="col-sm-6 col-lg-4">';
	                    echo '<div class="counter-card style4">';
	                        if( ! empty( $data['image']['url'] ) ){
		                        echo '<div class="counter-card_icon">';
		                            echo '<img src="'.$data['image']['url'].'" alt="Icon">';
		                        echo '</div>';
		                    }
	                        if( ! empty( $data['counter_number'] ) ){
		                		$suffix = ( $data['counter_suffix'] ) ? $data['counter_suffix'] : '';

			                    echo '<h2 class="counter-card_number th-num"><span class="counter-number">'.esc_html( $data['counter_number'] ).'</span>'.esc_html($suffix).'</h2>';
			                }
	                        if( !empty( $data['counter_text'] ) ){
	                            echo '<p class="counter-card_text th-text">'.esc_html( $data['counter_text'] ).'</p>';
	                        }
	                    echo '</div>';
	                echo '</div>';
	            }
                
            echo '</div>';

	    }elseif( $settings['layout'] == '4' ){
			echo '<div class="about-counter-wrap">';
				foreach( $settings['counter'] as $data ) {     
					echo '<div class="about-counter">';
						if( ! empty( $data['counter_number'] ) ){
							$suffix = ( $data['counter_suffix'] ) ? $data['counter_suffix'] : '';
							echo '<h3 class="about-counter_title th-num"><span class="counter-number">'.esc_html( $data['counter_number'] ).'</span>'.esc_html($suffix).'</h3>';
						}
						if( !empty( $data['counter_text'] ) ){
							echo '<p class="about-counter_text th-text">'.wp_kses_post( $data['counter_text'] ).'</p>';
						}
					echo '</div>';
				}
			echo '</div>';

		}elseif( $settings['layout'] == '5' ){
			echo '<div class="row gy-40 justify-content-between">';
				foreach( $settings['counter'] as $data ) {  
					echo '<div class="col-sm-6 col-lg-auto counter-card-wrap style6">';
						echo '<div class="counter-card style3">';
							if( ! empty( $data['image']['url'] ) ){
								echo '<div class="counter-card_icon">';
									echo '<img src="'.$data['image']['url'].'" alt="Icon">';
								echo '</div>';
							} 
							echo '<div class="media-body">';
								if( ! empty( $data['counter_number'] ) ){
									$suffix = ( $data['counter_suffix'] ) ? $data['counter_suffix'] : '';
									echo '<h2 class="counter-card_number th-num"><span class="counter-number">'.esc_html( $data['counter_number'] ).'</span>'.esc_html($suffix).'</h2>';
								}
							echo '</div>';
						echo '</div>';
						if( !empty( $data['counter_text'] ) ){
							echo '<p class="counter-card_text th-text">'.wp_kses_post( $data['counter_text'] ).'</p>';
						}
					echo '</div>';
				}
			echo '</div>';

		}elseif( $settings['layout'] == '6' ){
			echo '<div class="row gy-5 gx-lg-0 justify-content-between">';
				foreach( $settings['counter'] as $data ) {  
					echo '<div class="col-6 col-lg-auto counter-card-wrap style5">';
						echo '<div class="counter-card style5 flex-column align-items-center align-items-lg-start">';
							echo '<div class="d-flex align-items-center justify-content-center gap-3">';
								if( ! empty( $data['image']['url'] ) ){
									echo '<div class="counter-card_icon">';
										echo '<img src="'.$data['image']['url'].'" alt="Icon">';
									echo '</div>';
								}
								if( ! empty( $data['counter_number'] ) ){
									$suffix = ( $data['counter_suffix'] ) ? $data['counter_suffix'] : '';
									echo '<h4 class="counter-card_number mb-0 th-num"><span class="counter-number">'.esc_html( $data['counter_number'] ).'</span>'.esc_html($suffix).'</h4>';
								}
							echo '</div>';
							echo '<div class="media-body">';
								if( !empty( $data['counter_text'] ) ){
									echo '<p class="counter-card_text th-text">'.wp_kses_post( $data['counter_text'] ).'</p>';
								}
							echo '</div>';
						echo '</div>';
					echo '</div>';
				}
			echo '</div>';

		}elseif( $settings['layout'] == '7' ){
			echo ' <div class="counter-area-7 bg-theme" data-bg-src="'.esc_url( $settings['bg']['url'] ).'">';
				echo '<div class="row gy-40 justify-content-between">';
					foreach( $settings['counter'] as $data ) {  
						echo '<div class="col-sm-6 col-lg-auto counter-card-wrap style2 text-center text-lg-start">';
							echo '<div class="counter-card style3 justify-content-center">';
								if( ! empty( $data['image']['url'] ) ){
									echo '<div class="counter-card_icon">';
										echo '<img src="'.$data['image']['url'].'" alt="Icon">';
									echo '</div>';
								}
								echo '<div class="media-body">';
									if( ! empty( $data['counter_number'] ) ){
										$suffix = ( $data['counter_suffix'] ) ? $data['counter_suffix'] : '';
										echo '<h2 class="counter-card_number th-num"><span class="counter-number">'.esc_html( $data['counter_number'] ).'</span>'.esc_html($suffix).'</h2>';
									}
								echo '</div>';
							echo '</div>';
							if( !empty( $data['counter_text'] ) ){
								echo '<p class="counter-card_text th-text">'.wp_kses_post( $data['counter_text'] ).'</p>';
							}
						echo '</div>';
					}
				echo '</div>';
			echo '</div>';

		}elseif( $settings['layout'] == '8' ){

		}


	}
}