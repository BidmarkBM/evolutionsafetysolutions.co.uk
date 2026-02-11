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
class Ruffer_Gallery extends Widget_Base {

	public function get_name() {
		return 'ruffergallery';
	}
	public function get_title() {
		return __( 'Ruffer Gallery', 'ruffer' );
	}
	public function get_icon() {
		return 'eicon-code';
    }
	public function get_categories() {
		return [ 'ruffer' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'gallery_section',
			[
				'label' 	=> __( 'Gallery', 'ruffer' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );
        $this->add_control(
			'layout_style',
			[
				'label' 	=> __( 'Layout Style', 'ruffer' ),
				'type' 		=> Controls_Manager::SELECT,
				'default' 	=> '1',
				'options' 	=> [
					'1'  		=> __( 'Style One', 'ruffer' ),
					'2'  		=> __( 'Style Two', 'ruffer' ),
				],
			]
		);

		$this->add_control(
			'title',
            [
				'label'         => __( 'Gallery Title', 'ruffer' ),
				'type'          => Controls_Manager::TEXTAREA,
				'default'       => __( 'Gallery Post' , 'ruffer' ),
				'rows' => '2',
				'condition'		=> [ 
					'layout_style' => [ '2' ] 
				],
			]
		);

        $this->add_control(
			'gallery',
			[
				'label' => esc_html__( 'Add Gallery Slider', 'ruffer' ),
				'type' => \Elementor\Controls_Manager::GALLERY,
				'default' => [],
			]
		);

        $this->add_control(
			'gallery_icon',
            [
				'label'         => __( 'Gallery Icon', 'ruffer' ),
				'type'          => Controls_Manager::TEXTAREA,
				'default'       => __( '<i class="fab fa-instagram"></i>' , 'ruffer' ),
				'label_block'   => true,
				'rows' => '2',
			]
		);

        $this->end_controls_section();

		//---------------------------------------
			//Style Section Start
		//---------------------------------------

		ruffer_common_style_fields( $this, '01', 'Title', '{{WRAPPER}} .widget_title', ['2'] );

	}

	protected function render() {

        $settings = $this->get_settings_for_display();

        if( $settings['layout_style'] == '1' ){
            echo '<div class="sidebar-gallery">';
                foreach ( $settings['gallery'] as $single_data ){
                    echo '<div class="gallery-thumb">';
                        echo ruffer_img_tag( array(
                            'url'   => esc_url( $single_data['url'] ),
                        ) );
                        echo '<a href="'.esc_url( $single_data['url'] ).'" class="gallery-btn popup-image">'.wp_kses_post($settings['gallery_icon']).'</a>';
                    echo '</div>';
                }
            echo '</div>';

	    }elseif( $settings['layout_style'] == '2' ){
			echo '<div class="widget footer-widget">';
				if($settings['title']){
                    echo '<h3 class="widget_title">'.esc_html($settings['title']).'</h3>';
                }
				echo '<div class="sidebar-gallery">';
					foreach ( $settings['gallery'] as $single_data ){
						echo '<div class="gallery-thumb">';
							echo ruffer_img_tag( array(
								'url'   => esc_url( $single_data['url'] ),
							) );
							echo '<a href="'.esc_url( $single_data['url'] ).'" class="gallery-btn popup-image">'.wp_kses_post($settings['gallery_icon']).'</a>';
						echo '</div>';
					}
				echo '</div>';
			echo '</div>';

		}


	}

}