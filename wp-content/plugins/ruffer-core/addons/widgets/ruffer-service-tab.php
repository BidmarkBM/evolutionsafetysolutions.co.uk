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
class Ruffer_Service_Tab extends Widget_Base {

	public function get_name() {
		return 'rufferservicetab';
	}
	public function get_title() {
		return __( 'Service Tab', 'ruffer' );
	}
	public function get_icon() {
		return 'eicon-code';
    }
	public function get_categories() {
		return [ 'ruffer' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'service_tab_section',
			[
				'label'     => __( 'Service Tab', 'ruffer' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
			]
        );

        ruffer_select_field( $this, 'layout_style', 'Layout Style', [ 'Style One' ] );

        $repeater = new Repeater();

		ruffer_media_fields( $repeater, 'tab_icon', 'Choose Tab Icon' );
		ruffer_general_fields( $repeater, 'tab_title', 'Tab Title', 'TEXTAREA2', 'Raising Roofs Elevating' );
        
		ruffer_general_fields( $repeater, 'title', 'Title', 'TEXTAREA2', 'Raising Roofs Elevating' );
		ruffer_general_fields( $repeater, 'desc', 'Description', 'TEXTAREA', 'Look out for signs like missing shingles, water leaks, stains on ceilings visible damage. If you notice any of these, it is advisable' );
		ruffer_media_fields( $repeater, 'image', 'Choose Image' );

        ruffer_general_fields($repeater, 'skill_title', 'Skill Title 1', 'TEXT', 'Commercial Roofing');
        ruffer_general_fields($repeater, 'skill_num', 'Skill Number 1', 'TEXT', '75');
        ruffer_general_fields($repeater, 'skill_title2', 'Skill Title 2', 'TEXT', 'Residential Roofing');
        ruffer_general_fields($repeater, 'skill_num2', 'Skill Number 2', 'TEXT', '85');
        
		ruffer_general_fields( $repeater, 'button_text', 'Button Text', 'TEXT', 'Read More' );
		ruffer_url_fields( $repeater, 'button_url', 'Button URL' );

        ruffer_general_fields( $repeater, 'content', 'Content', 'TEXTAREA', '' );

		$this->add_control(
			'service_tab',
			[
				'label' 		=> __( 'Service Tab', 'ruffer' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'title' 		=> __( 'Tab 1', 'ruffer' ),
					],
				],
				'condition'		=> [ 
					'layout_style' => [ '1' ] 
				],
			]
		);


	}

	protected function render() {

        $settings = $this->get_settings_for_display();

    
		
		if( $settings['layout_style'] == '1' ){
            echo '<div class="service-tab mt-5 mt-lg-60">';
                echo '<ul class="nav nav-pills px-lg-3 mb-3 mb-lg-5" id="pills-service-tab" role="tablist">';
                    $x = 0;
					foreach( $settings['service_tab'] as $data ){
                        $x++;
                        if( $x == '1' ){
                            $aria 	= 'true';
                            $active = 'active ';
                        }else{
                            $aria 	= 'false';
                            $active = ' ';
                        }
						echo '<li class="nav-item" role="presentation">';
                            echo '<button class="nav-link '.esc_attr($active).'" id="pills-tab-'.esc_attr($x).'" data-bs-toggle="pill" data-bs-target="#pills-'.esc_attr($x).'" type="button" role="tab" aria-controls="pills-'.esc_attr($x).'" aria-selected="'.esc_attr($aria).'">';
                                echo ruffer_img_tag( array(
                                    'url'   => esc_url( $data['tab_icon']['url'] ),
                                    'class' => 'icon',
                                ));
                                if( ! empty( $data['tab_title'] ) ){
									echo esc_html( $data['tab_title'] );
								}
                            echo '</button>';
                        echo '</li>';
                    }
                echo '</ul>';
                echo '<div class="tab-content" id="pills-tabContent">';
                    $x = 0;
                    foreach( $settings['service_tab'] as $data ){
                        $x++;
                        $active = $x == '1' ? 'active show':'';
                        echo '<div class="tab-pane fade '.esc_attr($active).'" id="pills-'.esc_attr($x).'" role="tabpanel" aria-labelledby="pills-tab-'.esc_attr($x).'">';
                            echo '<div class="card position-relative overflow-hidden">';
                                echo '<div class="card-clip">';
                                    echo '<img src="'.RUFFER_PLUGDIRURI . 'assets/img/service-box-9-clip.png" alt="'.esc_attr__('Image', 'ruffer').'">';
                                echo '</div>';
                                if($data['image']['url'] ){
                                    echo '<div class="card-img-top" data-mask-src="'.RUFFER_PLUGDIRURI . 'assets/img/service-box-9-mask.png">';
                                        echo ruffer_img_tag( array(
                                            'url'   => esc_url( $data['image']['url'] ),
                                        ));
                                    echo '</div>';
                                }
                                echo '<div class="row">';
                                    echo '<div class="col-xl-6">';
                                        echo '<div class="card-info">';
                                            if( ! empty( $data['title'] ) ){
                                                echo '<h3 class="card-title title">'.esc_html( $data['title'] ).'</h3>';
                                            }
                                            if( ! empty( $data['desc'] ) ){
                                                echo '<p>'.esc_html( $data['desc'] ).'</p>';
                                            }
                                            echo '<ul class="d-flex flex-column gap-4">';
                                                echo '<li>';
                                                    echo '<div class="skill-feature">';
                                                        if(!empty($data['skill_title'])){
                                                            echo '<h5 class="skill-feature_title">'.esc_html($data['skill_title']).'</h5>';
                                                        }
                                                        echo '<div class="progress">';
                                                            echo '<div class="progress-bar" style="width: '.esc_attr($data['skill_num']).'%;">';
                                                                echo '<div class="progress-value">'.esc_attr($data['skill_num']).'%</div>';
                                                            echo '</div>';
                                                        echo '</div>';
                                                    echo '</div>';
                                                echo '</li>';
                                                echo '<li>';
                                                    echo '<div class="skill-feature">';
                                                        if(!empty($data['skill_title2'])){
                                                            echo '<h5 class="skill-feature_title">'.esc_html($data['skill_title2']).'</h5>';
                                                        }
                                                        echo '<div class="progress">';
                                                            echo '<div class="progress-bar" style="width: '.esc_attr($data['skill_num2']).'%;">';
                                                                echo '<div class="progress-value">'.esc_attr($data['skill_num2']).'%</div>';
                                                            echo '</div>';
                                                        echo '</div>';
                                                    echo '</div>';
                                                echo '</li>';
                                            echo '</ul>';
                                            echo '<div class="btn-wrap mt-50">';
                                                if(!empty($data['button_text'])){
                                                    echo '<a href="'.esc_url( $data['button_url']['url'] ).'" class="th-btn">'.wp_kses_post($data['button_text']).'<i class="fa-regular fa-arrow-right ms-2"></i></a>';
                                                }
                                                if( ! empty( $data['content'] ) ){
                                                    echo '<div class="about-info-wrap style2">'.wp_kses_post( $data['content'] ).'</div>';
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

			
		}elseif( $settings['layout_style'] == '2' ){
			
		}elseif( $settings['layout_style'] == '3' ){
			
		}


	}
}

