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
 * Team Widget .
 *
 */
class Ruffer_Team2 extends Widget_Base {

	public function get_name() {
		return 'rufferteam2';
	}
	public function get_title() {
		return __( 'Team V2', 'ruffer' );
	}
	public function get_icon() {
		return 'eicon-code';
    }
	public function get_categories() {
		return [ 'ruffer' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'team_section',
			[
				'label'     => __( 'Team V2', 'ruffer' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
			]
        );

		ruffer_select_field( $this, 'layout_style', 'Layout Style', [ 'Style One', 'Style Two', 'Style Three', 'Style Four', 'Style Five' ] );

        ruffer_media_fields($this, 'shape', 'Choose Shape', ['1', '3', '5']);

		$repeater = new Repeater();

		ruffer_media_fields($repeater, 'team_image', 'Team Image');
		ruffer_general_fields($repeater, 'name', 'Name', 'TEXTAREA2', 'John Simon');
		ruffer_url_fields($repeater, 'profile_url', 'Profile URL');
		ruffer_general_fields($repeater, 'designation', 'Designation', 'TEXTAREA2', 'Founder & CEO');

		ruffer_url_fields($repeater, 'facebook_url', 'Facebook URL');
		ruffer_url_fields($repeater, 'twitter_url', 'Twitter URL');
		ruffer_url_fields($repeater, 'linkedin_url', 'Linkedin URL');
		ruffer_url_fields($repeater, 'instagram_url', 'Instagram URL');
		
		$this->add_control(
			'team_lists',
			[
				'label' 		=> __( 'Member Lists', 'ruffer' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'name' 	=> __( 'John Simon', 'ruffer' ),
					],
				],
				'condition'	=> [
					'layout_style' => ['1', '2', '3', '5']
				]
			]
		);

        $repeater = new Repeater();

		ruffer_media_fields($repeater, 'team_image', 'Team Image');
		ruffer_general_fields($repeater, 'name', 'Name', 'TEXTAREA2', 'John Simon');
		ruffer_url_fields($repeater, 'profile_url', 'Profile URL');
		ruffer_general_fields($repeater, 'designation', 'Designation', 'TEXTAREA2', 'Founder & CEO');
		ruffer_general_fields($repeater, 'phone', 'Phone', 'TEXTAREA2', '(208)555-0112');
		ruffer_general_fields($repeater, 'email', 'Email', 'TEXTAREA2', 'debra.holt@example.com');

		ruffer_url_fields($repeater, 'facebook_url', 'Facebook URL');
		ruffer_url_fields($repeater, 'twitter_url', 'Twitter URL');
		ruffer_url_fields($repeater, 'linkedin_url', 'Linkedin URL');
		ruffer_url_fields($repeater, 'instagram_url', 'Instagram URL');
		
		$this->add_control(
			'team_lists2',
			[
				'label' 		=> __( 'Member Lists', 'ruffer' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'name' 	=> __( 'John Simon', 'ruffer' ),
					],
				],
				'condition'	=> [
					'layout_style' => ['4']
				]
			]
		);

        $this->end_controls_section();

        //---------------------------------------
			//Style Section Start
		//---------------------------------------

		//-------Name Style-------
		ruffer_common2_style_fields( $this, '01', 'Name', '{{WRAPPER}} .name a' );
		//-------Designation Style-------
		ruffer_common_style_fields( $this, '02', 'Designation', '{{WRAPPER}} .card-team.variant-1 .card-body .info p', ['1'] );
		ruffer_common_style_fields( $this, '022', 'Designation', '{{WRAPPER}} .desig', ['2', '3', '4', '5'] );

	}

	protected function render() {

        $settings = $this->get_settings_for_display();

			if( $settings['layout_style'] == '1' ){
                echo '<div class="row th-carousel gx-30" data-autoplay="false" data-slide-show="3" data-lg-slide-show="2" data-md-slide-show="2" data-sm-slide-show="1">';
                    foreach( $settings['team_lists'] as $data ){
                        $target = $data['profile_url']['is_external'] ? ' target="_blank"' : '';
                        $nofollow = $data['profile_url']['nofollow'] ? ' rel="nofollow"' : '';

                        $f_target = $data['facebook_url']['is_external'] ? ' target="_blank"' : '';
                        $f_nofollow = $data['facebook_url']['nofollow'] ? ' rel="nofollow"' : '';
                        $t_target = $data['twitter_url']['is_external'] ? ' target="_blank"' : '';
                        $t_nofollow = $data['twitter_url']['nofollow'] ? ' rel="nofollow"' : '';
                        $l_target = $data['linkedin_url']['is_external'] ? ' target="_blank"' : '';
                        $l_nofollow = $data['linkedin_url']['nofollow'] ? ' rel="nofollow"' : '';
                        $i_target = $data['instagram_url']['is_external'] ? ' target="_blank"' : '';
                        $i_nofollow = $data['instagram_url']['nofollow'] ? ' rel="nofollow"' : '';
                        
                        echo '<div class="col-lg-4">';
                            echo '<div class="card card-team variant-1">';
                                if(!empty($data['team_image']['url'])){
                                    echo '<div class="card-img-top">';
                                        echo ruffer_img_tag( array(
                                            'url'   => esc_url( $data['team_image']['url']  ),
                                        ));
                                    echo '</div>';
                                }
                                echo '<div class="card-body" data-bg-src="'.esc_url( $settings['shape']['url'] ).'">';
                                    echo '<div class="info">';
                                        if($data['name']){
                                            echo '<h5 class="card-title name"><a href="'.esc_url( $data['profile_url']['url'] ).'">'.esc_html($data['name']).'</a></h5>';
                                        }
                                        if($data['designation']){
                                            echo '<p class="m-0 desig">'.esc_html($data['designation']).'</p>';
                                        }
                                    echo '</div>';
                                    echo '<div class="social-link">';
                                        echo '<button><i class="far fa-plus"></i></button>';
                                        if( ! empty( $data['facebook_url']['url'] || $data['twitter_url']['url'] || $data['linkedin_url']['url'] || $data['instagram_url']['url'] ) ){
                                            echo '<ul class="social-link-menu">';
                                                if( ! empty( $data['facebook_url']['url']) ){
                                                    echo '<li><a '.wp_kses_post( $f_nofollow.$f_target ).' href="'.esc_url( $data['facebook_url']['url'] ).'"><i class="fab fa-facebook-f"></i></a></li>';
                                                }
                                                if( ! empty( $data['twitter_url']['url']) ){
                                                    echo '<li><a '.wp_kses_post( $t_nofollow.$t_target ).' href="'.esc_url( $data['twitter_url']['url'] ).'"><i class="fab fa-twitter"></i></a></li>';
                                                }
                                                if( ! empty( $data['linkedin_url']['url']) ){
                                                    echo '<li><a '.wp_kses_post( $l_nofollow.$l_target ).' href="'.esc_url( $data['linkedin_url']['url'] ).'"><i class="fab fa-linkedin-in"></i></a></li>';
                                                }
                                                if( ! empty( $data['instagram_url']['url']) ){
                                                    echo '<li><a '.wp_kses_post( $i_nofollow.$i_target ).' href="'.esc_url( $data['instagram_url']['url'] ).'"><i class="fab fa-instagram"></i></a></li>';
                                                }
                                            echo '</ul>';
                                        }
                                    echo '</div>';
                            echo ' </div>';
                            echo '</div>';
                        echo '</div>';
                    }
                echo '</div>';

			}elseif( $settings['layout_style'] == '2' ){
                echo '<div class="row th-carousel" data-slide-show="4" data-lg-slide-show="3" data-md-slide-show="2" data-sm-slide-show="2" data-xs-slide-show="1">';
                    foreach( $settings['team_lists'] as $data ){
                        $target = $data['profile_url']['is_external'] ? ' target="_blank"' : '';
                        $nofollow = $data['profile_url']['nofollow'] ? ' rel="nofollow"' : '';

                        $f_target = $data['facebook_url']['is_external'] ? ' target="_blank"' : '';
                        $f_nofollow = $data['facebook_url']['nofollow'] ? ' rel="nofollow"' : '';
                        $t_target = $data['twitter_url']['is_external'] ? ' target="_blank"' : '';
                        $t_nofollow = $data['twitter_url']['nofollow'] ? ' rel="nofollow"' : '';
                        $l_target = $data['linkedin_url']['is_external'] ? ' target="_blank"' : '';
                        $l_nofollow = $data['linkedin_url']['nofollow'] ? ' rel="nofollow"' : '';
                        $i_target = $data['instagram_url']['is_external'] ? ' target="_blank"' : '';
                        $i_nofollow = $data['instagram_url']['nofollow'] ? ' rel="nofollow"' : '';
                        
                        echo '<div class="col-sm-6 col-lg-4 col-xl-3">';
                            echo '<div class="team-card style6 mb-3">';
                                if(!empty($data['team_image']['url'])){
                                    echo '<div class="team-img-wrap">';
                                        echo ruffer_img_tag( array(
                                            'url'   => esc_url( $data['team_image']['url']  ),
                                        ));
                                    echo '</div>';
                                }
                                echo '<div class="team-content">';
                                    if($data['name']){
                                        echo '<h3 class="team-title name"><a href="'.esc_url( $data['profile_url']['url'] ).'">'.esc_html($data['name']).'</a></h3>';
                                    }
                                    if($data['designation']){
                                        echo '<span class="team-desig desig">'.esc_html($data['designation']).'</span>';
                                    }
                                    if( ! empty( $data['facebook_url']['url'] || $data['twitter_url']['url'] || $data['linkedin_url']['url'] || $data['instagram_url']['url'] ) ){
                                        echo '<ul>';
                                            if( ! empty( $data['facebook_url']['url']) ){
                                                echo '<li><a '.wp_kses_post( $f_nofollow.$f_target ).' href="'.esc_url( $data['facebook_url']['url'] ).'"><i class="fab fa-facebook-f"></i></a></li>';
                                            }
                                            if( ! empty( $data['twitter_url']['url']) ){
                                                echo '<li><a '.wp_kses_post( $t_nofollow.$t_target ).' href="'.esc_url( $data['twitter_url']['url'] ).'"><i class="fab fa-twitter"></i></a></li>';
                                            }
                                            if( ! empty( $data['linkedin_url']['url']) ){
                                                echo '<li><a '.wp_kses_post( $l_nofollow.$l_target ).' href="'.esc_url( $data['linkedin_url']['url'] ).'"><i class="fab fa-linkedin-in"></i></a></li>';
                                            }
                                            if( ! empty( $data['instagram_url']['url']) ){
                                                echo '<li><a '.wp_kses_post( $i_nofollow.$i_target ).' href="'.esc_url( $data['instagram_url']['url'] ).'"><i class="fab fa-instagram"></i></a></li>';
                                            }
                                        echo '</ul>';
                                    }
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    }
                echo '</div>';
				
			}elseif( $settings['layout_style'] == '3' ){
                echo '<div class="row th-carousel gx-30" data-slide-show="3" data-lg-slide-show="2" data-md-slide-show="2" data-sm-slide-show="1">';
                    foreach( $settings['team_lists'] as $data ){
                        $target = $data['profile_url']['is_external'] ? ' target="_blank"' : '';
                        $nofollow = $data['profile_url']['nofollow'] ? ' rel="nofollow"' : '';

                        $f_target = $data['facebook_url']['is_external'] ? ' target="_blank"' : '';
                        $f_nofollow = $data['facebook_url']['nofollow'] ? ' rel="nofollow"' : '';
                        $t_target = $data['twitter_url']['is_external'] ? ' target="_blank"' : '';
                        $t_nofollow = $data['twitter_url']['nofollow'] ? ' rel="nofollow"' : '';
                        $l_target = $data['linkedin_url']['is_external'] ? ' target="_blank"' : '';
                        $l_nofollow = $data['linkedin_url']['nofollow'] ? ' rel="nofollow"' : '';
                        $i_target = $data['instagram_url']['is_external'] ? ' target="_blank"' : '';
                        $i_nofollow = $data['instagram_url']['nofollow'] ? ' rel="nofollow"' : '';
                        
                        echo '<div class="col-sm-6 col-lg-4 col-xl-3">';
                            echo '<div class="th-team team-card style5">';
                                if(!empty($settings['shape']['url'])){
                                    echo '<div class="mask">';
                                        echo ruffer_img_tag( array(
                                            'url'   => esc_url( $settings['shape']['url']  ),
                                        ));
                                    echo '</div>';
                                }
                                if(!empty($data['team_image']['url'])){
                                    echo '<div class="team-img-wrap">';
                                        echo '<div class="team-thumb">';
                                            echo '<div class="team-img">';
                                                echo ruffer_img_tag( array(
                                                    'url'   => esc_url( $data['team_image']['url']  ),
                                                ));
                                            echo '</div>';
                                        echo '</div>';
                                    echo '</div>';
                                }
                                echo '<div class="team-content">';
                                    if($data['name']){
                                        echo '<h3 class="team-title name"><a href="'.esc_url( $data['profile_url']['url'] ).'">'.esc_html($data['name']).'</a></h3>';
                                    }
                                    if($data['designation']){
                                        echo '<span class="team-desig desig">'.esc_html($data['designation']).'</span>';
                                    }
                                    if( ! empty( $data['facebook_url']['url'] || $data['twitter_url']['url'] || $data['linkedin_url']['url'] || $data['instagram_url']['url'] ) ){
                                        echo '<ul>';
                                            if( ! empty( $data['facebook_url']['url']) ){
                                                echo '<li><a '.wp_kses_post( $f_nofollow.$f_target ).' href="'.esc_url( $data['facebook_url']['url'] ).'"><i class="fab fa-facebook-f"></i></a></li>';
                                            }
                                            if( ! empty( $data['twitter_url']['url']) ){
                                                echo '<li><a '.wp_kses_post( $t_nofollow.$t_target ).' href="'.esc_url( $data['twitter_url']['url'] ).'"><i class="fab fa-twitter"></i></a></li>';
                                            }
                                            if( ! empty( $data['linkedin_url']['url']) ){
                                                echo '<li><a '.wp_kses_post( $l_nofollow.$l_target ).' href="'.esc_url( $data['linkedin_url']['url'] ).'"><i class="fab fa-linkedin-in"></i></a></li>';
                                            }
                                            if( ! empty( $data['instagram_url']['url']) ){
                                                echo '<li><a '.wp_kses_post( $i_nofollow.$i_target ).' href="'.esc_url( $data['instagram_url']['url'] ).'"><i class="fab fa-instagram"></i></a></li>';
                                            }
                                        echo '</ul>';
                                    }
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    }
                echo '</div>';

            }elseif( $settings['layout_style'] == '4' ){
                echo '<div class="row th-carousel" data-slide-show="3" data-xl-slide-show="2" data-lg-slide-show="2" data-md-slide-show="2" data-sm-slide-show="1" data-xs-slide-show="1">';
                    foreach( $settings['team_lists2'] as $data ){
                        $target = $data['profile_url']['is_external'] ? ' target="_blank"' : '';
                        $nofollow = $data['profile_url']['nofollow'] ? ' rel="nofollow"' : '';

                        $f_target = $data['facebook_url']['is_external'] ? ' target="_blank"' : '';
                        $f_nofollow = $data['facebook_url']['nofollow'] ? ' rel="nofollow"' : '';
                        $t_target = $data['twitter_url']['is_external'] ? ' target="_blank"' : '';
                        $t_nofollow = $data['twitter_url']['nofollow'] ? ' rel="nofollow"' : '';
                        $l_target = $data['linkedin_url']['is_external'] ? ' target="_blank"' : '';
                        $l_nofollow = $data['linkedin_url']['nofollow'] ? ' rel="nofollow"' : '';
                        $i_target = $data['instagram_url']['is_external'] ? ' target="_blank"' : '';
                        $i_nofollow = $data['instagram_url']['nofollow'] ? ' rel="nofollow"' : '';

                        echo '<div class="col-sm-6 col-lg-4 col-xl-3">';
                            echo '<div class="team-card style7">';
                                echo '<div class="team-content">';
                                    echo '<div class="top">';
                                        if(!empty($data['team_image']['url'])){
                                            echo '<div class="team-img-wrap">';
                                                echo ruffer_img_tag( array(
                                                    'url'   => esc_url( $data['team_image']['url']  ),
                                                ));
                                            echo '</div>';
                                        }
                                        echo '<div>';
                                            if( ! empty( $data['facebook_url']['url'] || $data['twitter_url']['url'] || $data['linkedin_url']['url'] || $data['instagram_url']['url'] ) ){
                                                echo '<ul class="social-link">';
                                                    if( ! empty( $data['facebook_url']['url']) ){
                                                        echo '<li><a '.wp_kses_post( $f_nofollow.$f_target ).' href="'.esc_url( $data['facebook_url']['url'] ).'"><i class="fab fa-facebook-f"></i></a></li>';
                                                    }
                                                    if( ! empty( $data['twitter_url']['url']) ){
                                                        echo '<li><a '.wp_kses_post( $t_nofollow.$t_target ).' href="'.esc_url( $data['twitter_url']['url'] ).'"><i class="fab fa-twitter"></i></a></li>';
                                                    }
                                                    if( ! empty( $data['linkedin_url']['url']) ){
                                                        echo '<li><a '.wp_kses_post( $l_nofollow.$l_target ).' href="'.esc_url( $data['linkedin_url']['url'] ).'"><i class="fab fa-linkedin-in"></i></a></li>';
                                                    }
                                                    if( ! empty( $data['instagram_url']['url']) ){
                                                        echo '<li><a '.wp_kses_post( $i_nofollow.$i_target ).' href="'.esc_url( $data['instagram_url']['url'] ).'"><i class="fab fa-instagram"></i></a></li>';
                                                    }
                                                echo '</ul>';
                                            }
                                            echo '<ul class="personal-info">';
                                                if($data['phone']){
                                                    echo '<li>'.wp_kses_post($data['phone']).'</li>';
                                                }
                                                if($data['email']){
                                                    echo '<li>'.wp_kses_post($data['email']).'</li>';
                                                }
                                            echo '</ul>';
                                        echo '</div>';
                                    echo '</div>';
                                    if($data['name']){
                                        echo '<h3 class="team-title name"><a href="'.esc_url( $data['profile_url']['url'] ).'">'.esc_html($data['name']).'</a></h3>';
                                    }
                                    if($data['designation']){
                                        echo '<p class="team-text desig">'.esc_html($data['designation']).'</p>';
                                    }
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    }
                echo '</div>';

            }elseif( $settings['layout_style'] == '5' ){
                echo '<div class="row th-carousel" data-slide-show="3" data-lg-slide-show="3" data-md-slide-show="2" data-sm-slide-show="1" data-xs-slide-show="1">';
                foreach( $settings['team_lists'] as $data ){
                    $target = $data['profile_url']['is_external'] ? ' target="_blank"' : '';
                    $nofollow = $data['profile_url']['nofollow'] ? ' rel="nofollow"' : '';

                    $f_target = $data['facebook_url']['is_external'] ? ' target="_blank"' : '';
                    $f_nofollow = $data['facebook_url']['nofollow'] ? ' rel="nofollow"' : '';
                    $t_target = $data['twitter_url']['is_external'] ? ' target="_blank"' : '';
                    $t_nofollow = $data['twitter_url']['nofollow'] ? ' rel="nofollow"' : '';
                    $l_target = $data['linkedin_url']['is_external'] ? ' target="_blank"' : '';
                    $l_nofollow = $data['linkedin_url']['nofollow'] ? ' rel="nofollow"' : '';
                    $i_target = $data['instagram_url']['is_external'] ? ' target="_blank"' : '';
                    $i_nofollow = $data['instagram_url']['nofollow'] ? ' rel="nofollow"' : '';
                    echo '<div class="col-sm-6 col-lg-4 col-xl-3">';
                        echo '<div class="team-card style8">';
                            echo '<div class="team-img-wrap">';
                                if(!empty($data['team_image']['url'])){
                                    echo '<div class="team-thumb">';
                                        echo '<div class="team-img">';
                                            echo ruffer_img_tag( array(
                                                'url'   => esc_url( $data['team_image']['url']  ),
                                            ));
                                        echo '</div>';
                                    echo '</div>';
                                }
                                echo '<div class="team-social-hover">';
                                    echo '<a href="#" class="team-social-hover_btn"><i class="far fa-plus"></i></a>';
                                    if( ! empty( $data['facebook_url']['url'] || $data['twitter_url']['url'] || $data['linkedin_url']['url'] || $data['instagram_url']['url'] ) ){
                                        echo '<div class="team-social">';
                                            if( ! empty( $data['facebook_url']['url']) ){
                                                echo '<a '.wp_kses_post( $f_nofollow.$f_target ).' href="'.esc_url( $data['facebook_url']['url'] ).'"><i class="fab fa-facebook-f"></i></a>';
                                            }
                                            if( ! empty( $data['twitter_url']['url']) ){
                                                echo '<a '.wp_kses_post( $t_nofollow.$t_target ).' href="'.esc_url( $data['twitter_url']['url'] ).'"><i class="fab fa-twitter"></i></a>';
                                            }
                                            if( ! empty( $data['linkedin_url']['url']) ){
                                                echo '<a '.wp_kses_post( $l_nofollow.$l_target ).' href="'.esc_url( $data['linkedin_url']['url'] ).'"><i class="fab fa-linkedin-in"></i></a>';
                                            }
                                            if( ! empty( $data['instagram_url']['url']) ){
                                                echo '<a '.wp_kses_post( $i_nofollow.$i_target ).' href="'.esc_url( $data['instagram_url']['url'] ).'"><i class="fab fa-instagram"></i></a>';
                                            }
                                        echo '</div>';
                                    }
                                echo '</div>';
                            echo '</div>';
                            echo '<div class="team-content">';
                                if($data['name']){
                                    echo '<h3 class="team-title name"><a href="'.esc_url( $data['profile_url']['url'] ).'">'.esc_html($data['name']).'</a></h3>';
                                }
                                if($data['designation']){
                                    echo '<span class="team-desig desig">'.esc_html($data['designation']).'</span>';
                                }
                                if(!empty($settings['shape']['url'])){
                                    echo '<div class="mask">';
                                        echo ruffer_img_tag( array(
                                            'url'   => esc_url( $settings['shape']['url']  ),
                                        ));
                                    echo '</div>';
                                }
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                }
                echo '</div>';

            }
	
			
	}
}