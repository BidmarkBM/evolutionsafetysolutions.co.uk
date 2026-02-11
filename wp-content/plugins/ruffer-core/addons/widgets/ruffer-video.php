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
 * Video Widget .
 *
 */
class Ruffer_Video extends Widget_Base {

	public function get_name() {
		return 'ruffervideo';
	}
	public function get_title() {
		return __( 'Video Box', 'ruffer' );
	}
	public function get_icon() {
		return 'eicon-code';
    }
	public function get_categories() {
		return [ 'ruffer' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'video_section',
			[
				'label' 	=> __( 'video Box', 'ruffer' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );

		ruffer_select_field( $this, 'layout_style', 'Layout Style', [ 'Style One', '2' ] ); 

		ruffer_general_fields( $this, 'icon', 'Icon', 'TEXTAREA2', '<i class="fa-sharp fa-solid fa-play"></i>' );
		ruffer_url_fields( $this, 'video_url', 'Video URL' );
		ruffer_media_fields( $this, 'image', 'Choose Image', [ '1' ] );
		ruffer_general_fields( $this, 'title', 'Title', 'TEXTAREA2', 'Watch Tranding Video', [ '1', '2' ] );

		$this->end_controls_section();

        //---------------------------------------
			//Style Section Start
		//---------------------------------------

		ruffer_common_style_fields($this, '01', 'Title', '{{WRAPPER}} .title', ['1', '2'] );

	
	}

	protected function render() {

        $settings = $this->get_settings_for_display();

		if( $settings['layout_style'] == '1' ){
            echo '<div class="d-flex flex-column flex-lg-row align-items-center justify-content-center justify-content-lg-end gap-3 gap-lg-5">';
                if(!empty($settings['video_url']['url'])){
                    echo '<a href="'.esc_url( $settings['video_url']['url'] ).'" class="play-btn popup-video style5">'.wp_kses_post($settings['icon']).'</a>';
                }
                echo '<div>';
                    echo ruffer_img_tag( array(
                        'url'   => esc_url( $settings['image']['url'] ),
						'class' => 'd-none d-lg-block',
                    ));
                    if(!empty($settings['title'])){
                        echo '<p class="m-0 mt-1 title">'.esc_html($settings['title']).'</p>';
                    }
                echo '</div>';
            echo '</div>';

		}elseif( $settings['layout_style'] == '2' ){
			echo '<div class="text-center cta-content">';
				if(!empty($settings['video_url']['url'])){
                    echo '<a href="'.esc_url( $settings['video_url']['url'] ).'" class="play-btn popup-video style3">'.wp_kses_post($settings['icon']).'</a>';
                }
				if(!empty($settings['title'])){
					echo '<h2 class="title-area m-0 title">'.esc_html($settings['title']).'</h2>';
				}
			echo '</div>';

		}


	}

}