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
 * features Widget .
 *
 */
class Ruffer_Client_Logos extends Widget_Base {

	public function get_name() {
		return 'rufferclientlogos';
	}
	public function get_title() {
		return __( 'Client Logos', 'ruffer' );
	}
	public function get_icon() {
		return 'th-icon';
    }
	public function get_categories() {
		return [ 'ruffer' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'arrow_section',
			[
				'label'     => __( 'Client Logos', 'ruffer' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
			]
        );

		ruffer_select_field( $this, 'layout_style', 'Layout Style', [ 'Style One' ] );

		$repeater = new Repeater();

		ruffer_media_fields($repeater, 'image', 'Choose Image');
		ruffer_url_fields($repeater, 'button_url', 'Button URL');
		
		$this->add_control(
			'client_logo',
			[
				'label' 		=> __( 'Client Logo', 'ruffer' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'condition'	=> [
					'layout_style' => ['1']
				]
			]
		);

        $this->end_controls_section();

        //---------------------------------------
			//Style Section Start
		//---------------------------------------


	}

	protected function render() {

    $settings = $this->get_settings_for_display(); 

		if( $settings['layout_style'] == '1' ){
			echo '<div class="row th-carousel" data-slide-show="7" data-lg-slide-show="5" data-md-slide-show="4" data-sm-slide-show="3" data-xs-slide-show="2" data-speed="500">';
				foreach( $settings['client_logo'] as $data ){
					echo '<div class="col-auto"">';
						echo '<a href="'.esc_url( $data['button_url']['url'] ).'">';
							echo ruffer_img_tag( array(
								'url'   => esc_url( $data['image']['url'] ),
							) );
						echo '</a>';
					echo '</div>';
				}
			echo '</div>';

		}elseif( $settings['layout_style'] == '2' ){
   
		}
		
			
	}
}