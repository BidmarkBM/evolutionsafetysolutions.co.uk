<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;
use \Elementor\Repeater;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Border;
/**
 *
 * Contact Widget .
 *
 */
class Ruffer_CTA_Widget extends Widget_Base{

	public function get_name() {
		return 'rufferctawidget';
	}
	public function get_title() {
		return __( 'Ruffer CTA', 'ruffer' );
	}
	public function get_icon() {
		return 'eicon-code';
    }
	public function get_categories() {
		return [ 'ruffer' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'contact_section',
			[
				'label' 	=> __( 'Contact Form', 'ruffer' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
		);

		ruffer_select_field( $this, 'layout_style', 'Layout Style',['Style One', 'Style Two', 'Style Three' ] );

		ruffer_media_fields( $this, 'bg', 'Choose Background', ['2', '3'] );
        ruffer_media_fields( $this, 'image', 'Choose Image', ['2', '3'] );
		ruffer_general_fields( $this, 'title', 'Title', 'TEXTAREA', 'Get in Touch' );
		ruffer_general_fields( $this, 'subtitle', 'Subitle', 'TEXTAREA2', 'Peak Guard Inspection', ['1', '2'] );
        
		ruffer_general_fields( $this, 'button_text', 'Button Text', 'TEXT', 'Contact Us', ['1', '3'] );
		ruffer_url_fields( $this, 'button_link', 'Button URL', ['1', '3'] );

		ruffer_general_fields( $this, 'newsletter_placeholder', 'Placeholder', 'TEXT', 'Enter your Email', ['2'] );
		ruffer_general_fields( $this, 'newsletter_button', 'Subscribe Button', 'TEXT', 'Subscribe', ['2'] );
        
		$this->end_controls_section();


        //---------------------------------------
			//Style Section Start
		//---------------------------------------
		ruffer_common_style_fields( $this, '01', 'Subtitle', '{{WRAPPER}} .sub', ['1', '2'] );
		ruffer_common_style_fields( $this, '02', 'Title', '{{WRAPPER}} .title' );

		ruffer_button_style_fields( $this, '11', 'Button 2 Styling', '{{WRAPPER}} .th-btn', ['1', '3'] );


	}

	
	protected function render() {

		$settings = $this->get_settings_for_display();

		if( $settings['layout_style'] == '1' ){
			echo '<div class="footer-top">';
				echo '<div class="row align-items-center justify-content-between">';
					echo '<div class="col-xl-auto col-lg-7">';
						echo '<div class="title-area mb-lg-0 text-lg-start text-center">';
							if( ! empty( $settings['title'] ) ){
								echo '<span class="sub-title style2 title">'.wp_kses_post( $settings['title'] ).'</span>';
							}
							if( ! empty( $settings['subtitle'] ) ){
								echo '<h2 class="sec-title mb-0 sub">'.wp_kses_post( $settings['subtitle'] ).'</h2>';
							}
						echo '</div>';
					echo '</div>';
					if(!empty($settings['button_text'])){
						echo '<div class="col-xl-auto col-lg-4 text-center">';
							echo '<a href="'.esc_url( $settings['button_link']['url'] ).'" class="th-btn style2">'.esc_html($settings['button_text']).'<i class="fa-regular fa-arrow-right ms-2"></i></a>';
						echo '</div>';
					}
				echo '</div>';
			echo '</div>';

		}elseif( $settings['layout_style'] == '2' ){
			echo '<div class="cta-area-5" data-bg-src="'.esc_url( $settings['bg']['url'] ).'">';
				if($settings['image']['url'] ){
					echo '<div class="cta-thumb5 d-none d-xxl-block">';
						echo ruffer_img_tag( array(
							'url'   => esc_url( $settings['image']['url'] ),
						));
					echo '</div>';
				}
				echo '<div class="container">';
					echo '<div class="row justify-content-center justify-content-lg-between align-items-center gy-4">';
						echo '<div class="col-lg-6 text-center text-lg-start">';
							if( ! empty( $settings['title'] ) ){
								echo '<h2 class="title-area mb-sm-1 title">'.wp_kses_post( $settings['title'] ).'</h2>';
							}
							if( ! empty( $settings['subtitle'] ) ){
								echo '<p class="m-0 sub">'.wp_kses_post( $settings['subtitle'] ).'</p>';
							}
						echo '</div>';
						echo '<div class="col-md-9 col-lg-6 col-xl-5">';
							echo '<form action="mail.php" method="POST" class="wcu-form ajax-contact">';
								echo '<div class="row gy-3 gy-sm-0 justify-content-center">';
									echo '<div class="col-sm-8">';
										echo '<input type="text" placeholder="'.esc_attr( $settings['newsletter_placeholder'] ).'" class="form-control style-border text-center text-sm-start">';
									echo '</div>';
									echo '<div class="col-sm-4 text-center text-sm-start">';
										echo '<button type="submit" class="th-btn style4 w-100">'.wp_kses_post( $settings['newsletter_button'] ).'</button>';
									echo '</div>';
								echo '</div>';
							echo '</form>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</div>';

		}elseif( $settings['layout_style'] == '3' ){
			echo '<div class="cta-area-3 bg-theme" data-bg-src="'.esc_url( $settings['bg']['url'] ).'">';
				if($settings['image']['url'] ){
					echo '<div class="cta-thumb4 shape-mockup d-lg-block d-none" data-top="0" data-left="0" data-mask-src="'.RUFFER_PLUGDIRURI . 'assets/img/cta-bg-mask-3.png">';
						echo ruffer_img_tag( array(
							'url'   => esc_url( $settings['image']['url'] ),
						));
					echo '</div>';
				}
				echo '<div class="container">';
					echo '<div class="row justify-content-between justify-content-xl-end align-items-center">';
						echo '<div class="col-xl-5 col-md-7">';
							if( ! empty( $settings['title'] ) ){
								echo '<div class="title-area mb-0 me-xl-5 text-md-start text-center">';
									echo '<h2 class="sec-title h3 title">'.wp_kses_post( $settings['title'] ).'</h2>';
								echo '</div>';
							}
						echo '</div>';
						if(!empty($settings['button_text'])){
							echo '<div class="col-lg-3 col-md-5 mt-40 mt-md-0 text-md-end text-center">';
								echo '<a href="'.esc_url( $settings['button_link']['url'] ).'" class="th-btn style2">'.esc_html($settings['button_text']).'<i class="fa-regular fa-arrow-right ms-2"></i></a>';
							echo '</div>';
						}
					echo '</div>';
				echo '</div>';
			echo '</div>';

		}

		
	}
}