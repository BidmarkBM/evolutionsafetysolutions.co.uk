<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Group_Control_Border;
/**
 *
 * Banner Widget.
 *
 */
class Ruffer_Banner3 extends Widget_Base {

	public function get_name() {
		return 'rufferbanner3';
	}

	public function get_title() {
		return __( 'Banner Hero', 'ruffer' );
	}

	public function get_icon() {
		return 'eicon-code';
    }

	public function get_categories() {
		return [ 'ruffer_header_elements' ];
	}

    public function get_as_contact_form(){
        if ( ! class_exists( 'WPCF7' ) ) {
            return;
        }
        $as_cfa         = array();
        $as_cf_args     = array( 'posts_per_page' => -1, 'post_type'=> 'wpcf7_contact_form' );
        $as_forms       = get_posts( $as_cf_args );
        $as_cfa         = ['0' => esc_html__( 'Select Form', 'ruffer' ) ];
        if( $as_forms ){
            foreach ( $as_forms as $as_form ){
                $as_cfa[$as_form->ID] = $as_form->post_title;
            }
        }else{
            $as_cfa[ esc_html__( 'No contact form found', 'ruffer' ) ] = 0;
        }
        return $as_cfa;
    }


	protected function register_controls() {

		$this->start_controls_section(
			'Banner_section',
			[
				'label' 	=> __( 'Banner', 'ruffer' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );

        ruffer_select_field( $this, 'layout_style', 'Layout Style', [ 'Style One', 'Style Two', 'Style Three' ] );

        ruffer_media_fields( $this, 'bg', 'Choose Background', ['1', '2', '3'] );
        ruffer_media_fields( $this, 'image', 'Choose Image', ['1', '2', '3'] );
        
		ruffer_general_fields( $this, 'subtitle', 'Subitle', 'TEXTAREA2', 'Peak Guard Inspection', ['1', '2'] );
		ruffer_general_fields( $this, 'title', 'Title', 'TEXTAREA', 'Eave Elite Gutter Solutions' );
		ruffer_general_fields( $this, 'desc', 'Description', 'TEXTAREA', 'We work with a variety of materials' );
        
		ruffer_general_fields( $this, 'button_text', 'Button Text', 'TEXT', 'All Services' );
		ruffer_url_fields( $this, 'button_url', 'Button URL' );
		ruffer_general_fields( $this, 'button_text2', 'Button Text', 'TEXT', 'About Us', ['1'] );
		ruffer_url_fields( $this, 'button_url2', 'Button URL', ['1'] );

		ruffer_url_fields( $this, 'video_url', 'Video URL', ['3'] );

        ruffer_social_fields( $this, 'social_icon_list', 'Social Media', ['3'] );

        ruffer_media_fields( $this, 'line', 'Choose Line Shape', ['1'] );
        ruffer_media_fields( $this, 'shape', 'Choose Shape', ['2'] );
        ruffer_media_fields( $this, 'shape2', 'Choose Shape', ['2'] );

        $repeater = new Repeater();

		ruffer_media_fields($repeater, 'icon', 'Choose Icon');
		ruffer_url_fields($repeater, 'button_url', 'Button URL');
		
		$this->add_control(
			'banner_marquee',
			[
				'label' 		=> __( 'Marquee', 'ruffer' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'condition'	=> [
					'layout_style' => ['3']
				]
			]
		);
        
        ruffer_switcher_fields( $this, 'show_form', 'Show Form?', ['1'] );
        $this->add_control(
            'ruffer_select_contact_form',
            [
                'label'   => esc_html__( 'Select Form', 'ruffer' ),
                'type'    => Controls_Manager::SELECT,
                'default' => '0',
                'options' => $this->get_as_contact_form(),
                'condition'	=> [
					'layout_style' => ['1']
				]
            ]
        );

        ruffer_general_fields( $this, 'form_title', 'Form Title', 'TEXTAREA2', 'GET A FREE ESTIMATE', ['1']  );
        ruffer_media_fields( $this, 'form_shape', 'Choose Form Shape', ['1'] );


		$this->end_controls_section();
 
        //---------------------------------------
			//Style Section Start
		//---------------------------------------
		ruffer_common_style_fields( $this, '01', 'Subtitle', '{{WRAPPER}} .hero-subtitle' );
		ruffer_common_style_fields( $this, '02', 'Title', '{{WRAPPER}} .hero-title' );
		ruffer_common_style_fields( $this, '03', 'Description', '{{WRAPPER}} .hero-text' );
		//------Button Style-------
		ruffer_button_style_fields( $this, '10', 'Button Styling', '{{WRAPPER}} .th_btn' );
		ruffer_button_style_fields( $this, '11', 'Button 2 Styling', '{{WRAPPER}} .th_btn2', ['1'] );

        ruffer_common_style_fields( $this, '15', 'Form Title', '{{WRAPPER}} .form_title', ['1'] );


    }

	protected function render() {

        $settings = $this->get_settings_for_display();

        if( $settings['layout_style'] == '1' ){
            echo '<div class="th-hero-wrapper hero-9" id="hero-sec" data-bg-src="'.esc_url( $settings['bg']['url'] ).'" data-overlay="black" data-opacity="8">';
                if($settings['line']['url'] ){
                    echo '<div class="shape-mockup d-none d-lg-block">';
                        echo ruffer_img_tag( array(
                            'url'   => esc_url( $settings['line']['url'] ),
                        ));
                    echo '</div>';
                }
                echo '<div class="container">';
                    echo '<div class="row gy-5 gy-lg-0 align-items-center">';
                        echo '<div class="col-lg-7">';
                            echo '<div class="info text-center text-lg-start">';
                                if(!empty($settings['subtitle'])){
                                    echo '<span class="hero-subtitle">'.wp_kses_post($settings['subtitle']).'</span>';
                                }
                                if(!empty($settings['title'])){
                                    echo '<h1 class="hero-title">'.wp_kses_post($settings['title']).'</h1>';
                                }
                                if(!empty($settings['desc'])){
                                    echo '<p class="hero-text">'.wp_kses_post($settings['desc']).'</p>';
                                }
                                echo '<div class="btn-group justify-content-center justify-content-lg-start">';
                                    if(!empty($settings['button_text'])){
                                        echo '<a href="'.esc_url( $settings['button_url']['url'] ).'" class="th-btn style3 th_btn">'.wp_kses_post($settings['button_text']).'<i class="fa-regular fa-arrow-right ms-2"></i></a>';
                                    }
                                    if(!empty($settings['button_text2'])){
                                        echo '<a href="'.esc_url( $settings['button_url2']['url'] ).'" class="th-btn style6 th_btn2">'.wp_kses_post($settings['button_text2']).'<i class="fa-regular fa-arrow-right ms-2"></i></a>';
                                    }
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                        echo '<div class="col-lg-5 col-xl-4 position-relative">';
                            if($settings['image']['url'] ){
                                echo '<div class="hero-thumb d-none d-xl-block">';
                                    echo ruffer_img_tag( array(
                                        'url'   => esc_url( $settings['image']['url'] ),
                                    ));
                                echo '</div>';
                            }
                            if( $settings['show_form'] == 'yes' ){
                                echo '<div class="card bg-theme" data-bg-src="'.esc_url( $settings['form_shape']['url'] ).'">';
                                    echo '<div class="card-body">';
                                        if(!empty($settings['form_title'])){
                                            echo '<h3 class="mb-20 mb-md-35 form_title">'.wp_kses_post($settings['form_title']).'</h3>';
                                        }
                                        if( !empty($settings['ruffer_select_contact_form']) ){
                                            echo do_shortcode( '[contact-form-7  id="'.$settings['ruffer_select_contact_form'].'"]' ); 
                                        }else{
                                            echo '<div class="alert alert-warning"><p class="m-0">' . __('Please Select contact form.', 'ruffer' ). '</p></div>';
                                        }

                                    echo '</div>';
                                echo '</div>';
                            }
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';

		}elseif( $settings['layout_style'] == '2' ){
            echo '<div class="th-hero-wrapper hero-14" id="hero-sec" data-bg-src="'.esc_url( $settings['bg']['url'] ).'" data-overlay="black" data-opacity="8">';
                if($settings['shape2']['url'] ){
                    echo '<div class="mask">';
                        echo ruffer_img_tag( array(
                            'url'   => esc_url( $settings['shape2']['url'] ),
                        ));
                    echo '</div>';
                }
                echo '<div class="container">';
                    echo '<div class="hero-content">';
                        echo '<div class="row gy-5 gy-lg-0 align-items-center flex-lg-row-reverse">';
                            echo '<div class="col-lg-5">';
                                echo '<div class="hero-frame text-center">';
                                    echo ruffer_img_tag( array(
                                        'url'   => esc_url( $settings['shape']['url'] ),
                                        'class' => 'bg d-none d-sm-block',
                                    ));
                                    if($settings['image']['url'] ){
                                    echo '<div class="mask-cover" data-mask-src="'.RUFFER_PLUGDIRURI . 'assets/img/hero-14-mask.png">';
                                        echo ruffer_img_tag( array(
                                            'url'   => esc_url( $settings['image']['url'] ),
                                            'class' => 'tilt-active',
                                        ));
                                    echo '</div>';
                                    }
                                echo '</div>';
                            echo '</div>';
                            echo '<div class="col-lg-7">';
                                echo '<div class="info text-center text-lg-start">';
                                    if(!empty($settings['subtitle'])){
                                        echo '<span class="hero-subtitle">'.wp_kses_post($settings['subtitle']).'</span>';
                                    }
                                    if(!empty($settings['title'])){
                                        echo '<h1 class="hero-title">'.wp_kses_post($settings['title']).'</h1>';
                                    }
                                    if(!empty($settings['desc'])){
                                        echo '<p class="hero-text">'.wp_kses_post($settings['desc']).'</p>';
                                    }
                                    if(!empty($settings['button_text'])){
                                        echo '<div class="btn-group justify-content-center justify-content-lg-start">';
                                            echo '<a href="'.esc_url( $settings['button_url']['url'] ).'" class="th-btn style3 th_btn">'.wp_kses_post($settings['button_text']).'<i class="fa-regular fa-arrow-right ms-2"></i></a>';
                                        echo '</div>';
                                    }
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';

		}elseif( $settings['layout_style'] == '3' ){
            echo '<section class="th-hero-wrapper hero-15" id="hero-sec">';
                echo '<ul class="social-link">';
                    foreach( $settings['social_icon_list'] as $social_icon ){
                        $social_target    = $social_icon['icon_link']['is_external'] ? ' target="_blank"' : '';
                        $social_nofollow  = $social_icon['icon_link']['nofollow'] ? ' rel="nofollow"' : '';

                        echo '<li><a '.wp_kses_post( $social_target.$social_nofollow ).' href="'.esc_url( $social_icon['icon_link']['url'] ).'">';

                        \Elementor\Icons_Manager::render_icon( $social_icon['social_icon'], [ 'aria-hidden' => 'true' ] );

                        echo '</a></li> ';
                    }
                echo '</ul>';
                echo '<div class="hero-content" data-bg-src="'.esc_url( $settings['bg']['url'] ).'">';
                    echo '<div class="hero-style15">';
                        echo '<div class="container">';
                            echo '<div class="row align-items-center text-center text-xl-start">';
                                echo '<div class="col-xl-7">';
                                    if(!empty($settings['title'])){
                                        echo '<h1 class="hero-title mb-md-3 mb-lg-0">'.wp_kses_post($settings['title']).'</h1>';
                                    }
                                echo '</div>';
                                echo '<div class="col-xl-5">';
                                    if(!empty($settings['desc'])){
                                        echo '<p class="hero-text mb-30">'.wp_kses_post($settings['desc']).'</p>';
                                    }
                                    if(!empty($settings['button_text'])){
                                        echo '<a href="'.esc_url( $settings['button_url']['url'] ).'" class="th-btn th_btn">'.wp_kses_post($settings['button_text']).'<i class="fa-regular fa-arrow-right ms-2"></i></a>';
                                    }
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                    echo '<div class="hero-cover-bg" data-bg-src="'.esc_url( $settings['image']['url'] ).'">';
                        if(!empty($settings['video_url']['url'] )){
                            echo '<a href="'.esc_url( $settings['video_url']['url'] ).'" class="play-btn popup-video style5"><i class="fas fa-play"></i></a>';
                        }
                    echo '</div>';
                    echo '<div class="marquee-area ">';
                        echo '<div class="container-fluid">';
                            echo '<div class="row">';
                                echo '<div class="col-12 px-lg-0">';
                                    echo '<div class="slider__marquee clearfix marquee-wrap overflow-hidden">';
                                        echo '<div class="marquee_mode marquee__group">';
                                            foreach( $settings['banner_marquee'] as $data ){
                                                echo '<div class="item m-item">';
                                                    echo '<a href="'.esc_url( $data['button_url']['url'] ).'">';
                                                        echo ruffer_img_tag( array(
                                                            'url'   => esc_url( $data['icon']['url'] ),
                                                        )); 
                                                    echo '</a>';
                                                echo '</div>';
                                            }
                                        echo '</div>';
                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                echo '</echo>';
            echo '</section>';

        }


	}
}