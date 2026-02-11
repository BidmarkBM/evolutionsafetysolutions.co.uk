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
 * Contact Tab Widget .
 *
 */
class Ruffer_Contact_Info extends Widget_Base {

	public function get_name() {
		return 'ruffercontactinfo';
	}

	public function get_title() {
		return __( 'Ruffer Contact Info', 'ruffer' );
	}


	public function get_icon() {
		return 'eicon-code';
    }


	public function get_categories() {
		return [ 'ruffer' ];
	}

	protected function register_controls() {


		$this->start_controls_section(
			'contact_information',
			[
				'label' 	=> __( 'Contact Information', 'ruffer' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );

        $this->end_controls_section();



        $this->start_controls_section(
			'email_section',
			[
				'label' 	=> __( 'Email Info', 'ruffer' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );
		$this->add_control(
			'email_contact_label',
			[
				'label'     => __( 'Email Label', 'ruffer' ),
                'type'      => Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
			]
        );
        $this->add_control(
			'email_contact_info_1',
			[
				'label'     => __( 'Email 1', 'ruffer' ),
                'type'      => Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
			]
        );
        $this->add_control(
			'email_contact_info_2',
			[
				'label'     => __( 'Email 2', 'ruffer' ),
                'type'      => Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
			]
        );
        $this->end_controls_section();
        

        $this->start_controls_section(
			'location_section',
			[
				'label' 	=> __( 'Location Info', 'ruffer' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );
		$this->add_control(
			'location_label',
			[
				'label'     => __( 'Location Label', 'ruffer' ),
                'type'      => Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
			]
        );
        $this->add_control(
			'location_info',
			[
				'label'     => __( 'Location', 'ruffer' ),
                'type'      => Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
			]
        );
        $this->add_control(
			'location_url',
			[
				'label'     => __( 'Map url', 'ruffer' ),
                'type'      => Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
			]
        );
        $this->end_controls_section();

        /*----------------------------------------- Content styling------------------------------------*/

		$this->start_controls_section(
			'content_section',
			[
				'label' 	=> __( 'Content Style', 'ruffer' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
        );
		$this->add_control(
			'content_color',
			[
				'label' 		=> __( 'Color', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .contact-media'	=> '--white-color: {{VALUE}}!important;',
				],
			]
        );
      
	}

	protected function render() {

        $settings = $this->get_settings_for_display();



        echo '<!--==============================Contact Info Area==============================-->';

        echo '<div class="row justify-content-center gy-30">';
        	if(!empty($settings['email_contact_label'])){
        		$email    		= $settings['email_contact_info_1'];
                $email          = is_email( $email );

                $email2    		= $settings['email_contact_info_2'];
                $email2          = is_email( $email2 );

                $replace        = array(' ','-',' - ');
                $with           = array('','','');

                $emaillurl_1       = str_replace( $replace, $with, $email );
                $emaillurl_2       = str_replace( $replace, $with, $email2 );
                echo '<div class="col-xl-6 col-lg-4 col-md-6">';
                    echo '<div class="contact-feature">';
                        echo '<div class="icon-btn"><i class="far fa-envelope"></i></div>';
                        echo '<div class="media-body">';
                            echo '<p class="contact-feature_label">'.esc_html($settings['email_contact_label']).'</p>';

                            echo '<a href="'.esc_attr( 'mailto:'.$emaillurl_1 ).'" class="contact-feature_link">'.esc_html($settings['email_contact_info_1']).'</a>';
                            echo '<a href="'.esc_attr( 'mailto:'.$emaillurl_2 ).'" class="contact-feature_link">'.esc_html($settings['email_contact_info_2']).'</a>';

                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            }
            if(!empty($settings['location_label'])){
                echo '<div class="col-xl-6 col-lg-4 col-md-6">';
                    echo '<div class="contact-feature">';
                        echo '<div class="icon-btn"><i class="far fa-location-dot"></i></div>';
                        echo '<div class="media-body">';
                            echo '<p class="contact-feature_label">'.esc_html($settings['location_label']).'</p>';
                            echo '<a href="'.esc_url( $settings['location_url'] ).'" class="contact-feature_link">'.esc_html($settings['location_info']).'</a>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            }

        echo '</div>';	
	}
}