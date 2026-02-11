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
class Ruffer_Image2 extends Widget_Base {

	public function get_name() {
		return 'rufferimage2';
	}
	public function get_title() {
		return __( 'Ruffer Image', 'ruffer' );
	}
	public function get_icon() {
		return 'eicon-code';
    }
	public function get_categories() {
		return [ 'ruffer' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'image_section',
			[
				'label' 	=> __( 'Group Image', 'ruffer' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );

        ruffer_select_field( $this, 'layout_style', 'Layout Style', [ 'Style One', 'Style Two', 'Style Three', 'Style Four', 'Style Five', 'Style Six', 'Style Seven', 'Style Eight', 'Style Nine', 'Style Ten' ] );

        
		ruffer_media_fields( $this, 'image', 'Choose Image' );
		ruffer_media_fields( $this, 'image2', 'Choose Image', ['1', '2', '10'] );

		ruffer_general_fields( $this, 'title', 'Title', 'TEXTAREA2', '25', ['1', '3', '8', '10'] );
		ruffer_general_fields( $this, 'desc', 'Description', 'TEXTAREA2', 'Years Of Experience', ['1', '3', '8', '10'] );
		ruffer_general_fields( $this, 'content', 'Content', 'TEXTAREA2', 'Globally Clients', ['1'] );
		ruffer_general_fields( $this, 'circle_text', 'Circle Text', 'TEXTAREA2', 'WE PROVIDE THE SERVICES SINCE 1992', ['2', '4', '7', '9'] );

        ruffer_media_fields( $this, 'icon', 'Choose Icon', ['2', '3', '4', '7', '8', '9'] );
        ruffer_media_fields( $this, 'shape', 'Choose Shape', ['1', '3', '6', '8', '10'] );
        ruffer_media_fields( $this, 'shape2', 'Choose Shape', ['8'] );
		ruffer_media_fields( $this, 'author_iamge', 'Choose Author Image', ['1', '10'] );

		
        $this->end_controls_section();

	}

	protected function render() {

        $settings = $this->get_settings_for_display();

        if( $settings['layout_style'] == '1' ){
            echo '<div class="about-frame img-box9">';
                if(!empty($settings['image']['url'])){
                        echo ruffer_img_tag( array(
                            'url'   => esc_url( $settings['image']['url'] ),
                        ));
                }
                echo '<div class="content d-none d-lg-block">';
                    echo '<div class="about-grid" data-bg-src="'.esc_url( $settings['shape']['url'] ).'">';
                        if(!empty($settings['title'])){
							echo '<h3 class="about-grid_year">'.wp_kses_post($settings['title']).'</h3>';
						}
						if(!empty($settings['desc'])){
							echo '<p class="about-grid_text">'.wp_kses_post($settings['desc']).'</p>';
						}
                        if(!empty($settings['author_iamge']['url'])){
                            echo ruffer_img_tag( array(
                                'url'   => esc_url( $settings['author_iamge']['url'] ),
                                'class' => 'about-grid_thumb',
                            ));
                        }
                        if(!empty($settings['content'])){
							echo '<p class="about-grid_text">'.esc_html($settings['content']).'</p>';
						}
                    echo '</div>';
                    if(!empty($settings['image2']['url'])){
                        echo ruffer_img_tag( array(
                            'url'   => esc_url( $settings['image2']['url'] ),
                            'class' => 'tilt-active',
                        ));
                    }
                echo '</div>';
            echo '</div>';

	    }elseif( $settings['layout_style'] == '2' ){
			echo '<div class="img-box11">'; 
				if(!empty($settings['image']['url'])){
					echo '<div class="mask mask-a" data-mask-src="'.RUFFER_PLUGDIRURI . 'assets/img/about-10-mask-a.png">';
						echo ruffer_img_tag( array(
							'url'   => esc_url( $settings['image']['url'] ),
						));
					echo '</div>';
				}
				if(!empty($settings['image2']['url'])){
					echo '<div class="mask mask-b d-none d-md-block">';
						echo ruffer_img_tag( array(
							'url'   => esc_url( $settings['image2']['url'] ),
						));
					echo '</div>';
				}
				echo '<div class="about-experience-wrap">';
					if(!empty($settings['icon']['url'])){
						echo '<div class="about-experience-icon">';
							echo ruffer_img_tag( array(
								'url'   => esc_url( $settings['icon']['url'] ),
							));
						echo '</div>';
					}
					echo '<div class="about-experience-tag">';
						if(!empty($settings['circle_text'])){
							echo '<span class="about-title-anime">'.wp_kses_post($settings['circle_text']).'</span>';
						}
					echo '</div>';
				echo '</div>';
			echo '</div>';

		}elseif( $settings['layout_style'] == '3' ){
			echo '<div class="img-box10 text-center d-none d-lg-block">';
				echo '<div class="img-content">';
					echo ruffer_img_tag( array(
						'url'   => esc_url( $settings['shape']['url'] ),
						'class' => 'mask bg'
					));
					echo ruffer_img_tag( array(
						'url'   => esc_url( $settings['image']['url'] ),
						'class' => 'mask upper'
					));
				echo '</div>';
				echo '<div class="info-content">';
					if(!empty($settings['icon']['url'])){
						echo '<div class="icon">';
							echo ruffer_img_tag( array(
								'url'   => esc_url( $settings['icon']['url'] ),
							));
						echo '</div>';
					}
					echo '<div class="info d-flex gap-3 align-items-center">';
						if(!empty($settings['title'])){
							echo '<h3>'.wp_kses_post($settings['title']).'</h3>';
						}
						if(!empty($settings['desc'])){
							echo '<p>'.wp_kses_post($settings['desc']).'</p>';
						}
					echo '</div>';
				echo '</div>';
			echo '</div>';

		}elseif( $settings['layout_style'] == '4' ){
			echo '<div class="img-box12 position-relative text-center">';
				echo ruffer_img_tag( array(
					'url'   => esc_url( $settings['image']['url'] ),
				));
				echo '<div class="about-experience-wrap d-none d-md-block">';
					if(!empty($settings['icon']['url'])){
						echo '<div class="about-experience-icon">';
							echo ruffer_img_tag( array(
								'url'   => esc_url( $settings['icon']['url'] ),
							));
						echo '</div>';
					}
					echo '<div class="about-experience-tag">';
						if(!empty($settings['circle_text'])){
							echo '<span class="about-title-anime">'.wp_kses_post($settings['circle_text']).'</span>';
						}
					echo '</div>';
				echo '</div>';
			echo '</div>';

		}elseif( $settings['layout_style'] == '5' ){
			if(!empty($settings['image']['url'])){
				echo '<div class="img-box14">';
					echo ruffer_img_tag( array(
						'url'   => esc_url( $settings['image']['url'] ),
						'class' => 'tilt-active'
					));
				echo '</div>';
			}

		}elseif( $settings['layout_style'] == '6' ){
			echo '<div class="img-box15 text-center">';
				echo '<img src="'.esc_url( $settings['shape']['url'] ).'" alt="about-frame" class="d-none d-sm-block">';
				if(!empty($settings['image']['url'])){
					echo '<div class="mask-cover" data-mask-src="'.RUFFER_PLUGDIRURI . 'assets/img/about-mask-13.png">';
						echo ruffer_img_tag( array(
							'url'   => esc_url( $settings['image']['url'] ),
							'class' => 'tilt-active'
						));
					echo '</div>';
				}
			echo '</div>';

		}elseif( $settings['layout_style'] == '7' ){
			echo '<div class="img-box box-1 text-center text-xl-start">';
				echo '<div class="mask-cover" data-mask-src="'.RUFFER_PLUGDIRURI . 'assets/img/about-14-mask.png">';
					echo ruffer_img_tag( array(
						'url'   => esc_url( $settings['image']['url'] ),
						'class' => 'tilt-active'
					));
				echo '</div>';
				echo '<div class="about-experience-wrap">';
					if(!empty($settings['icon']['url'])){
						echo '<div class="about-experience-icon">';
							echo ruffer_img_tag( array(
								'url'   => esc_url( $settings['icon']['url'] ),
							));
						echo '</div>';
					}
					echo '<div class="about-experience-tag">';
						if(!empty($settings['circle_text'])){
							echo '<span class="about-title-anime">'.wp_kses_post($settings['circle_text']).'</span>';
						}
					echo '</div>';
				echo '</div>';
			echo '</div>';

		}elseif( $settings['layout_style'] == '8' ){
			echo '<div class="experience-thumb one">';
				if(!empty($settings['image']['url'])){
					echo '<div class="mask-cover" data-mask-src="'.RUFFER_PLUGDIRURI . 'assets/img/exp-cover-1-mask.png">';
						echo ruffer_img_tag( array(
							'url'   => esc_url( $settings['image']['url'] ),
							'class' => 'cover tilt-active',
						));
					echo '</div>';
				}
				echo ruffer_img_tag( array(
					'url'   => esc_url( $settings['shape']['url'] ),
					'class' => 'mask one d-none d-xl-block',
				));
				echo ruffer_img_tag( array(
					'url'   => esc_url( $settings['shape2']['url'] ),
					'class' => 'mask two d-none d-xl-block',
				));
				echo '<div class="customer-wrap">';
					if(!empty($settings['title'])){
						echo '<h2 class="customer-wrap-title">'.wp_kses_post($settings['title']).'</h2>';
					}
					if(!empty($settings['desc'])){
						echo '<p class="customer-wrap-text">'.wp_kses_post($settings['desc']).'</p>';
					}
					if(!empty($settings['icon']['url'])){
						echo '<div class="customer-wrap-icon">';
							echo ruffer_img_tag( array(
								'url'   => esc_url( $settings['icon']['url'] ),
							));
						echo '</div>';
					}
				echo '</div>';
			echo '</div>';

		}elseif( $settings['layout_style'] == '9' ){
			echo '<div class="position-relative faq-frame text-center">';
				echo ruffer_img_tag( array(
					'url'   => esc_url( $settings['image']['url'] ),
				));
				echo '<div class="about-experience-wrap d-none d-md-block">';
					if(!empty($settings['icon']['url'])){
						echo '<div class="about-experience-icon">';
							echo ruffer_img_tag( array(
								'url'   => esc_url( $settings['icon']['url'] ),
							));
						echo '</div>';
					}
					echo '<div class="about-experience-tag">';
						if(!empty($settings['circle_text'])){
							echo '<span class="about-title-anime">'.wp_kses_post($settings['circle_text']).'</span>';
						}
					echo '</div>';
				echo '</div>';
			echo '</div>';
 
		}elseif( $settings['layout_style'] == '10' ){
			echo '<div class="about-frame img-box16">';
				echo ruffer_img_tag( array(
					'url'   => esc_url( $settings['image']['url'] ),
					'class' => 'tilt-active'
				));
				echo '<div class="content d-none d-xl-block">';
					echo '<div class="about-grid bg-title">';
						if(!empty($settings['title'])){
							echo '<p class="about-grid_text">'.wp_kses_post($settings['title']).'</p>';
						}
						if(!empty($settings['author_iamge']['url'])){
                            echo ruffer_img_tag( array(
                                'url'   => esc_url( $settings['author_iamge']['url'] ),
                                'class' => 'about-grid_thumb',
                            ));
                        }
						if(!empty($settings['desc'])){
							echo '<p class="about-grid_text">'.wp_kses_post($settings['desc']).'</p>';
						}
					echo '</div>';
					echo ruffer_img_tag( array(
						'url'   => esc_url( $settings['image2']['url'] ),
						'class' => 'tilt-active'
					));
				echo '</div>';
				if(!empty($settings['shape']['url'])){
					echo '<div class="mask">';
						echo ruffer_img_tag( array(
							'url'   => esc_url( $settings['shape']['url'] ),
						));
					echo '</div>';
				}
			echo '</div>';

		}

		


	}

}