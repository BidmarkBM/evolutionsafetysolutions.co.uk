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
 * Footer Widgets .
 *
 */
class Ruffer_Footer_Widgets extends Widget_Base {

	public function get_name() {
		return 'rufferfooterwidgets';
	}
	public function get_title() {
		return __( 'Footer Widgets', 'ruffer' );  
	}
	public function get_icon() {
		return 'eicon-code';
    }
	public function get_categories() {
		return [ 'ruffer' ];
	}
	
	protected function register_controls() {

		$this->start_controls_section(
			'layout_section',
			[
				'label'     => __( 'Footer Widget Style', 'ruffer' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
			]
        );

		ruffer_select_field( $this, 'layout_style', 'Layout Style', [ 'Style One', 'Style Two', 'Style Three', 'Style Four', 'Style Five' ] );

        ruffer_media_fields( $this, 'logo', 'Choose Logo', ['1', '2', '3', '5'] );
        ruffer_media_fields( $this, 'shape', 'Choose Shape', ['5'] );
		ruffer_general_fields( $this, 'title', 'Title', 'TEXT', 'Contact Now', ['4'] );
		ruffer_general_fields( $this, 'desc', 'Description', 'TEXTAREA', 'Mauris blandit aliquet elit, eget tincidunt Nibh', ['2', '3'] );
		ruffer_general_fields( $this, 'content', 'Content', 'TEXTAREA', '', ['2'] );

        ruffer_social_fields( $this, 'social_icon_list', 'Social Media', ['3'] );

        // ruffer_general_fields( $this, 'n_placeholder', 'Placeholder', 'TEXT', 'Enter your Email', ['2'] );
		// ruffer_general_fields( $this, 'n_button', 'Subscribe Button', 'TEXT', 'Subscribe', ['2'] );
        
        ruffer_common_repeater_field($this, 'contact', 'Contact', [ 'text'  ], ['1']);

        $repeater = new Repeater();

		ruffer_general_fields($repeater, 'label', 'Label', 'TEXTAREA2', 'Office Location');
		ruffer_general_fields($repeater, 'icon', 'Icon', 'TEXTAREA2', '<i class="far fa-location-dot"></i>');
		ruffer_general_fields($repeater, 'content', 'Content', 'TEXTAREA', '2118 Thornridge Cir. Syracuse, Connecticut 35624');
		
		$this->add_control(
			'contact2',
			[
				'label' 		=> __( 'Contact Info', 'ruffer' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'label' 	=> __( 'Office Location', 'ruffer' ),
					],
				],
				'condition'	=> [
					'layout_style' => ['4', '5']
				]
			]
		);
        

        $this->end_controls_section();

        //---------------------------------------
			//Style Section Start
		//---------------------------------------

		ruffer_common_style_fields( $this, '01', 'Title', '{{WRAPPER}} .widget_title', ['4'] );
		ruffer_common_style_fields( $this, '02', 'Description', '{{WRAPPER}} .about-text', ['2', '3'] );

	}

	protected function render() {

        $settings = $this->get_settings_for_display();

		if( $settings['layout_style'] == '1' ){
            echo '<div class="footer-top">';
                echo '<div class="row gy-4 align-items-center justify-content-center justify-content-lg-between">';
                    echo '<div class="col-lg-3 col-xxl-4">';
                        if(!empty($settings['logo']['url'])){
                            echo '<div class="about-logo text-md-center text-lg-start">';
                                echo '<a href="'.esc_url( home_url('/') ).'">';
                                    echo ruffer_img_tag( array(
                                        'url'   => esc_url( $settings['logo']['url'] ),
                                    ));
                                echo '</a>';
                            echo '</div>';
                        }
                    echo '</div>';
                    echo '<div class="col-lg-9 col-xxl-8">';
                        echo '<ul class="contact-link">';
                            foreach( $settings['contact'] as $data ){
                                if(!empty($data['contact_text'])){
                                    echo '<li>'.wp_kses_post($data['contact_text']).'</li>';
                                }
                            }
                        echo '</ul>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';

		}elseif( $settings['layout_style'] == '2' ){
            echo '<div class="widget footer-widget">';
                echo '<div class="th-widget-about">';
                    if(!empty($settings['logo']['url'])){
                        echo '<div class="about-logo">';
                            echo '<a href="'.esc_url( home_url('/') ).'">';
                                echo ruffer_img_tag( array(
                                    'url'   => esc_url( $settings['logo']['url'] ),
                                ));
                            echo '</a>';
                        echo '</div>';
                    }
                    if($settings['desc']){
                        echo '<p class="about-text">'.esc_html($settings['desc']).'</p>';
                    }
                    if($settings['content']){
                        echo '<div class="phone-card">'.wp_kses_post($settings['content']).'</div>';
                    }
                echo '</div>';
            echo '</div>';
            
		}elseif( $settings['layout_style'] == '3' ){
            echo '<div class="widget footer-widget">';
                echo '<div class="th-widget-about">';
                    if(!empty($settings['logo']['url'])){
                        echo '<div class="about-logo">';
                            echo '<a href="'.esc_url( home_url('/') ).'">';
                                echo ruffer_img_tag( array(
                                    'url'   => esc_url( $settings['logo']['url'] ),
                                ));
                            echo '</a>';
                        echo '</div>';
                    }
                    if($settings['desc']){
                        echo '<p class="about-text">'.esc_html($settings['desc']).'</p>';
                    }
                    echo '<div class="th-social">';
                        foreach( $settings['social_icon_list'] as $social_icon ){
                            $social_target    = $social_icon['icon_link']['is_external'] ? ' target="_blank"' : '';
                            $social_nofollow  = $social_icon['icon_link']['nofollow'] ? ' rel="nofollow"' : '';

                            echo '<a '.wp_kses_post( $social_target.$social_nofollow ).' href="'.esc_url( $social_icon['icon_link']['url'] ).'">';

                            \Elementor\Icons_Manager::render_icon( $social_icon['social_icon'], [ 'aria-hidden' => 'true' ] );

                            echo '</a> ';
                        }
                    echo '</div>';
                echo '</div>';
            echo '</div>';

        }elseif( $settings['layout_style'] == '4' ){
            echo '<div class="widget footer-widget">';
                if($settings['title']){
                    echo '<h3 class="widget_title">'.esc_html($settings['title']).'</h3>';
                }
                echo '<div class="th-widget-contact">';
                    foreach( $settings['contact2'] as $data ){
                        if(!empty($data['label'])){
                            echo '<h6 class="info-box_title">'.wp_kses_post($data['label']).'</h6>';
                        }
                        echo '<div class="info-box">';
                            if(!empty($data['icon'])){
                                echo '<div class="info-box_icon">'.wp_kses_post($data['icon']).'</div>';
                            }
                            if(!empty($data['content'])){
                                echo '<p class="info-box_text">'.wp_kses_post($data['content']).'</p>';
                            }
                        echo '</div>';
                    }
                echo '</div>';
            echo '</div>';

        }elseif( $settings['layout_style'] == '5' ){
            echo '<div class="footer-top" data-bg-src="'.esc_url( $settings['shape']['url'] ).'">';
                echo '<div class="row gy-4 align-items-center justify-content-center justify-content-xxl-between">';
                    echo '<div class="col-xxl-3">';
                        if(!empty($settings['logo']['url'])){
                            echo '<div class="about-logo text-center text-xxl-start">';
                                echo '<a href="'.esc_url( home_url('/') ).'">';
                                    echo ruffer_img_tag( array(
                                        'url'   => esc_url( $settings['logo']['url'] ),
                                    ));
                                echo '</a>';
                            echo '</div>';
                        }
                    echo '</div>';
                    echo '<div class="col-xxl-9">'; 
                        echo '<ul class="row justify-content-md-center justify-content-xl-between contact-link">';
                            foreach( $settings['contact2'] as $data ){
                                echo '<li class="col-auto">';
                                    if(!empty($data['icon'])){
                                      echo wp_kses_post($data['icon']);
                                    }
                                    echo '<div>';
                                        if(!empty($data['label'])){
                                            echo '<h6>'.wp_kses_post($data['label']).'</h6>';
                                        }
                                        if(!empty($data['content'])){
                                            echo '<div>'.wp_kses_post($data['content']).'</p>';
                                        }
                                    echo '</div>';
                                echo '</li>';
                            }
                        echo '</ul>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';

        }
	

	}
}
						