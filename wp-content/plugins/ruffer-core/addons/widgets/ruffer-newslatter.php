<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;
use \Elementor\Repeater;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Background;
/**
 * 
 * Newsletter Widget .
 *
 */
class Ruffer_Newsletter_Widgets extends Widget_Base {

	public function get_name() {
		return 'ruffernewsletter2';
	}
	public function get_title() {
		return __( 'Ruffer Newsletter', 'ruffer' );
	}
	public function get_icon() {
		return 'eicon-code';
    }
	public function get_categories() {
		return [ 'ruffer' ];
	}
	protected function register_controls() {

		$this->start_controls_section(
			'newsletter_content',
			[
				'label' 	=> __( 'Newsletter', 'ruffer' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );

		ruffer_select_field( $this, 'layout_style', 'Layout Style', [ 'Style One', 'Style Two', 'Style Three' ] );

		$this->add_control(
			'newsletter_title',
			[
				'label' 		=> __( 'Newsletter Title', 'ruffer' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'default' 		=> __( 'Subscribe to our newsletter', 'ruffer' ),
				'rows'			=> 2,
			]
		);
		$this->add_control(
			'newsletter_placeholder',
			[
				'label' 		=> __( 'Newsletter Placeholder Text', 'ruffer' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'default' 		=> __( 'Enter Your Email', 'ruffer' ),
				'rows'			=> 2,
			]
		);
		$this->add_control(
			'newsletter_button',
			[
				'label' 		=> __( 'Newsletter Button Text', 'ruffer' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'default' 		=> __( 'Sign UP', 'ruffer' ),
				'rows'			=> 2,
				'condition'		=> [ 
					'layout_style' => [ '2' ] 
				],
			]
		);

        $this->end_controls_section();

        //---------------------------------------
			//Style Section Start
		//---------------------------------------
		ruffer_common_style_fields( $this, '01', 'Title', '{{WRAPPER}} .title' );

		//------Button Style-------
		ruffer_button_style_fields( $this, '10', 'Button Styling', '{{WRAPPER}} .th-btn', ['2'] );


	}

	protected function render() {

        $settings = $this->get_settings_for_display();

		if( $settings['layout_style'] == '2' ){
			echo '<div class="text-center">';
				if(!empty($settings['newsletter_title'])){
					echo '<h2 class="newsletter-title title">'.esc_html($settings['newsletter_title']).'</h2>';
				}
				echo '<form action="mail.php" method="POST" class="wcu-form ajax-contact">';
					echo '<div class="row gy-3 gy-sm-0 newsletter">';
						echo '<div class="col-sm-9">';
							echo '<input type="email" id="email" class="form-control" placeholder="'.esc_attr( $settings['newsletter_placeholder'] ).'">';
						echo '</div>';
						echo '<div class="col-sm-3">';
							echo '<button class="th-btn">'.wp_kses_post( $settings['newsletter_button'] ).'</button>';
						echo '</div>';
					echo '</div>';
				echo '</form>';
			echo '</div>';
			
		}elseif( $settings['layout_style'] == '3' ){
			echo '<div class="newsletter-widget mx-auto mx-lg-0">';
				if(!empty($settings['newsletter_title'])){
					echo '<h3 class="widget_title d-none d-lg-block text-white mb-3">'.esc_html($settings['newsletter_title']).'</h3>';
				}
				echo '<form class="newsletter-form">';
					echo '<input class="form-control" type="email" placeholder="'.esc_attr( $settings['newsletter_placeholder'] ).'" required="">';
					echo '<button type="submit" class="th-btn"><i class="far fa-paper-plane"></i></button>';
				echo '</form>';
			echo '</div>';

		}else{
			echo '<div class="row justify-content-end align-items-center">';
				echo '<div class="col-lg-5 col-md-8">';
					if(!empty($settings['newsletter_title'])){
						echo '<div class="title-area mb-0 me-xl-5 text-md-start text-center">';
							echo '<h2 class="sec-title h3 title">'.esc_html($settings['newsletter_title']).'</h2>';
						echo '</div>';
					}
				echo '</div>';
				echo '<div class="col-lg-4 col-md-4 mt-4 mt-md-0 text-md-end">';
					echo '<div class="widget newsletter-widget footer-widget mb-0">';
						echo '<form class="newsletter-form">';
							echo '<input class="form-control" type="email" placeholder="'.esc_attr( $settings['newsletter_placeholder'] ).'" required="">';
							echo '<button type="submit" class="th-btn"><i class="far fa-paper-plane"></i></button>';
						echo '</form>';
					echo '</div>';
				echo '</div>';
			echo '</div>'; 

		}
		
		
	}

}

						