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
class Ruffer_Contact_Form extends Widget_Base{

	public function get_name() {
		return 'ruffercontactform';
	}
	public function get_title() {
		return __( 'Contact Form', 'ruffer' );
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
		$this->add_control(
			'layout',
			[
				'label' 		=> __( 'Contact Style', 'ruffer' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'one',
				'options'		=> [
					'one'  		=> __( 'Style One', 'ruffer' ),
					'two' 		=> __( 'Style Two', 'ruffer' ),
					'three' 	=> __( 'Style Three', 'ruffer' ),
					'four' 		=> __( 'Style Four', 'ruffer' ),
					'five' 		=> __( 'Style Five', 'ruffer' ),
					'six' 		=> __( 'Style Six', 'ruffer' ),
					'seven' 		=> __( 'Style Seven', 'ruffer' ),
				],
			]
		);
		$this->add_control(
			'exclude_post_name',
			[
				'label'         => __( 'Chose a style from here', 'ruffer' ),
                'type'          => Controls_Manager::SELECT,
				'options'       => $this->ruffer_cf7_id(), 
			]
        );
        $this->add_control(
			'title',
			[
				'label' 	=> __( 'Title', 'ruffer' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
                'default'  	=> __( 'Get in Touch', 'ruffer' ),
                
			]
        );
        $this->add_control(
			'subtitle',
			[
				'label' 	=> __( 'Subtitle', 'ruffer' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
                'default'  	=> __( 'Get in Touch', 'ruffer' ),
                'condition'		=> [ 'layout' => [ 'two'] ],
                
			]
        );
        $this->add_control(
			'desc',
			[
				'label' 	=> __( 'Description', 'ruffer' ),
                'type' 		=> Controls_Manager::WYSIWYG,
                'default'  	=> __( 'Get in Touch', 'ruffer' ),
                'condition'		=> [ 'layout' => [ 'two'] ],
                
			]
        );
        $this->add_control(
			'image',
			[
				'label' 		=> __( 'Choose Image', 'ruffer' ),
				'type' 			=> Controls_Manager::MEDIA,
				'dynamic' 		=> [
					'active' 		=> true,
				],
				'default' 		=> [
					'url' 			=> Utils::get_placeholder_image_src(),
				],
				'condition'		=> [ 'layout' => [ 'one', 'five', 'seven'] ],
			]
		);
        
		$this->end_controls_section();

		//---------------------------------------
			//Style Section Start
		//---------------------------------------
		ruffer_common_style2_fields( $this, '01', 'Form Title', '{{WRAPPER}} .text-white', ['one'], '--white-color' );
		ruffer_common_style2_fields( $this, '011', 'Form Title', '{{WRAPPER}} .title', ['four', 'five', 'six', 'seven'] );

		ruffer_common_style2_fields( $this, '02', 'Section Subtitle', '{{WRAPPER}} .sub-title', ['two'] );
		ruffer_common_style2_fields( $this, '03', 'Section Title', '{{WRAPPER}} .sec-title', ['two']);


	}

	// Get Specific Post
    public function ruffer_cf7_id(){
        $args = array(
            'post_type'         => 'wpcf7_contact_form',
            'posts_per_page'    => -1,
        );

        $ruffer_cf7 = new WP_Query( $args );

        $postarray = [];

        while( $ruffer_cf7->have_posts() ){
            $ruffer_cf7->the_post();
            $postarray[get_the_title()] = get_the_title();
        }
        wp_reset_postdata();
        return $postarray;
    }

	protected function render() {

		$settings = $this->get_settings_for_display();

		global $wpdb;
        $postTitle = $settings['exclude_post_name']; 
        $postID = $wpdb->get_var($wpdb->prepare("SELECT ID FROM {$wpdb->posts} WHERE   post_type='wpcf7_contact_form' AND post_title = %s",$postTitle));


		if( $settings['layout'] == 'one' ){
			echo '<div class="appointment-form-wrap bg-theme" data-bg-src="'.esc_url($settings['image']['url']).'">';
				if( ! empty( $settings['title'] ) ){
					echo '<h3 class="h5 text-white mb-35">'.wp_kses_post( $settings['title'] ).'</h3>';
				}
				echo do_shortcode( '[contact-form-7 id="'.esc_attr($postID).'" title="'.esc_attr($settings['exclude_post_name']).'"]' );
			echo '</div>';

		}elseif( $settings['layout'] == 'two' ){
			echo '<div class="appointment-content">';
				echo '<div class="row justify-content-between">';
					echo '<div class="col-lg-5">';
						echo '<div class="title-area mb-25">';
							if( ! empty( $settings['title'] ) ){
								echo '<span class="sub-title">'.wp_kses_post( $settings['title'] ).'</span>';
							}
							if( ! empty( $settings['subtitle'] ) ){
								echo '<h2 class="sec-title">'.wp_kses_post( $settings['subtitle'] ).'</h2>';
							}
						echo '</div>';
						if( ! empty( $settings['desc'] ) ){
							echo '<div class="appointment-wrap mb-lg-0 mb-40">';
								echo '<div class="about-info-wrap style4">';
									echo wp_kses_post( $settings['desc'] );
								echo '</div>';

							echo '</div>';
						}
					echo '</div>';
					echo '<div class="col-lg-7">';
						echo do_shortcode( '[contact-form-7 id="'.esc_attr($postID).'" title="'.esc_attr($settings['exclude_post_name']).'"]' );
					echo '</div>';
				echo '</div>';
			echo '</div>';

		}elseif( $settings['layout'] == 'three' ){
			echo do_shortcode( '[contact-form-7 id="'.esc_attr($postID).'" title="'.esc_attr($settings['exclude_post_name']).'"]' );

		}elseif( $settings['layout'] == 'four' ){
			echo '<div class="th-contact-form style2 ajax-contact ms-xxl-4">';
				if( ! empty( $settings['title'] ) ){
					echo '<div class="form-title">';
						echo '<h3 class="blog-inner-title h5 title">'.wp_kses_post( $settings['title'] ).'</h3>';
					echo '</div>';
				}
				echo do_shortcode( '[contact-form-7 id="'.esc_attr($postID).'" title="'.esc_attr($settings['exclude_post_name']).'"]' );
			echo '</div>';

		}elseif( $settings['layout'] == 'five' ){
			echo '<div class="appointment-content layout2 position-relative bg-white overflow-hidden">';
				if(!empty($settings['image']['url'])){
					echo '<div class="mask d-none d-lg-block">';
						echo ruffer_img_tag( array(
							'url'   => esc_url( $settings['image']['url'] ),
						));
					echo '</div>';
				}
				echo '<div class="row align-items-center justify-content-between">';
					echo '<div class="col-lg-4">';
						if( ! empty( $settings['title'] ) ){
							echo '<div class="title-area text-center text-lg-start mb-25">';
								echo '<h2 class="sec-title mb-0 title">'.wp_kses_post( $settings['title'] ).'</h2>';
							echo '</div>';
						}
					echo '</div>';
					echo '<div class="col-lg-8">';
						echo '<div class="appointment-form ajax-contact">';
							echo do_shortcode( '[contact-form-7 id="'.esc_attr($postID).'" title="'.esc_attr($settings['exclude_post_name']).'"]' );
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</div>';

		}elseif( $settings['layout'] == 'six' ){
			echo '<div class="th-contact-form style3 ajax-contact">';
				if( ! empty( $settings['title'] ) ){
					echo '<div class="form-title">';
						echo '<h3 class="blog-inner-title h5 title">'.wp_kses_post( $settings['title'] ).'</h3>';
					echo '</div>';
				}
				echo do_shortcode( '[contact-form-7 id="'.esc_attr($postID).'" title="'.esc_attr($settings['exclude_post_name']).'"]' );
			echo '</div>';

		}elseif( $settings['layout'] == 'seven' ){
			echo '<section class="cta-area-8" data-bg-src="'.esc_url( $settings['image']['url'] ).'" data-overlay="black" data-opacity="7">';
				echo '<div class="container">';
					echo '<div class="row justify-content-center justify-content-xl-between align-items-center gy-4">';
						if( ! empty( $settings['title'] ) ){
							echo '<div class="col-lg-6 col-xl-5 text-center text-xl-start">';
								echo '<h2 class="sec-title mb-0 title">'.wp_kses_post( $settings['title'] ).'</h2>';
							echo '</div>';
						}
						echo '<div class="col-xl-7">';
							echo '<div class="wcu-form ajax-contact">';
								echo do_shortcode( '[contact-form-7 id="'.esc_attr($postID).'" title="'.esc_attr($settings['exclude_post_name']).'"]' );
							echo '</div>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</section>';

		}


	}
}