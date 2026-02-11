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
 * Project Box Widget .
 *
 */
class Ruffer_Project extends Widget_Base {

	public function get_name() {
		return 'rufferprojects';
	}
	public function get_title() {
		return __( 'Ruffer Project', 'ruffer' );
	}
	public function get_icon() {
		return 'eicon-code';
    }
	public function get_categories() {
		return [ 'ruffer' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'checklist_section',
			[
				'label' 	=> __( 'Project', 'ruffer' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );
        $this->add_control(
			'layout',
			[
				'label' 		=> __( 'Style', 'ruffer' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> '1',
				'options'		=> [
					'1'  			=> __( 'Style One', 'ruffer' ),
					'2' 			=> __( 'Style Two', 'ruffer' ),
					'3' 			=> __( 'Style Three', 'ruffer' ),
					'4' 			=> __( 'Style Four', 'ruffer' ),
					'5' 			=> __( 'Style Five', 'ruffer' ),
					'6' 			=> __( 'Style Six', 'ruffer' ),
					'7' 			=> __( 'Style Seven', 'ruffer' ),
					'8' 			=> __( 'Style Eight', 'ruffer' ),
				],
			]
		);

		// ------------------------------------------------style 1 & 2 ------------------------------------------------//

        $repeater = new Repeater();

		$repeater->add_control(
			'title',
			[
				'label'     => __( 'Title', 'ruffer' ),
                'type'      => Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
			]
        );
        $repeater->add_control(
			'tag',
			[
				'label'     => __( 'Tag', 'ruffer' ),
                'type'      => Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
			]
        );
        $repeater->add_control(
			'url',
			[
				'label'     => __( 'URL', 'ruffer' ),
                'type'      => Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
			]
        );
        $repeater->add_control(
			'image',
			[
				'label' 		=> __( 'Image', 'ruffer' ),
				'type' 			=> Controls_Manager::MEDIA,
				'dynamic' 		=> [
					'active' 		=> true,
				],
				'default' 		=> [
					'url' 			=> Utils::get_placeholder_image_src(),
				],
			]
		);
        $this->add_control(
			'steps',
			[
				'label' 		=> __( 'Steps', 'ruffer' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'title' 		=> __( 'title', 'ruffer' ),
					],
				],
				'condition'		=> [ 'layout' =>  ['1','2', '4', '5', '6', '7'] ],
			]
		);

		$this->add_control(
			'title',
			[
				'label'     => __( 'Title', 'ruffer' ),
                'type'      => Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
                'default' 		=> __( 'Project Title' , 'ruffer' ),
                'condition'		=> [ 'layout' =>  ['4'] ],
			]
        );
        $this->add_control(
			'subtitle',
			[
				'label'     => __( 'Subtitle', 'ruffer' ),
                'type'      => Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
                'default' 		=> __( 'Project Title' , 'ruffer' ),
                'condition'		=> [ 'layout' =>  ['4'] ],
			]
        );

		// ------------------------------------------------style 3 ------------------------------------------------//

        $repeater = new Repeater();
		$repeater->add_control(
			'title',
			[
				'label'     => __( 'Title', 'ruffer' ),
                'type'      => Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
                'default' 		=> __( 'Project Title' , 'ruffer' ),
			]
        );
        $repeater->add_control(
			'cats',
			[
				'label'     => __( 'Category', 'ruffer' ),
                'type'      => Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
                'default' 		=> __( 'CONSTRUCTION' , 'ruffer' ),
			]
        );
        $repeater->add_control(
			'tag',
			[
				'label'     => __( 'Tag', 'ruffer' ),
                'type'      => Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
                'default' 		=> __( 'Tag One' , 'ruffer' ),
			]
        );
        $repeater->add_control(
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
			]
		);
		$repeater->add_control(
			'details_page',
			[
				'label'     => __( 'Single Page URL', 'ruffer' ),
                'type'      => Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
			]
        );
        $this->add_control(
			'projects2',
			[
				'label' 		=> __( 'Projects', 'ruffer' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'title' 		=> __( 'title', 'ruffer' ),
					],
				],
				'condition'		=> [ 
					'layout' =>  ['3'] 
				],
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'title',
			[
				'label'     => __( 'Title', 'ruffer' ),
                'type'      => Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
                'default' 		=> __( 'Project Title' , 'ruffer' ),
			]
        );

        $repeater->add_control(
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
			]
		);

		$repeater->add_control(
			'project_url',
			[
				'label' 		=> esc_html__( 'Button URL', 'ruffer' ),
				'type' 			=> Controls_Manager::URL,
				'placeholder' 	=> esc_html__( 'https://your-link.com', 'ruffer' ),
				'show_external' => true,
				'default' 		=> [
					'url' 			=> '#',
					'is_external' 	=> false,
					'nofollow' 		=> false,
				],
			]
		);

        $this->add_control(
			'projects3',
			[
				'label' 		=> __( 'Projects', 'ruffer' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'title' 		=> __( 'title', 'ruffer' ),
					],
				],
				'condition'		=> [ 'layout' =>  '8' ],
			]
		);

		$this->add_control(
			'all_text', [
				'label' 		=> __( 'All filter label', 'ruffer' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'default' 		=> __( 'All' , 'ruffer' ),
				'rows' 			=> 2,
				'label_block' 	=> true,
				'condition'		=> [ 
					'layout' =>  ['3'] 
				],
			]
		);


        $this->end_controls_section();

        /*-----------------------------------------Feedback styling------------------------------------*/


	}

	protected function render() {

        $settings = $this->get_settings_for_display();
        if( $settings['layout'] == '1' ){
        	echo '<div class="container-fluid p-0">';
	            echo '<div class="row th-carousel project-slider-1" data-slide-show="1" data-xl-slide-show="1" data-ml-slide-show="1" data-lg-slide-show="1" data-md-slide-show="1" data-sm-slide-show="1" data-xs-slide-show="1" data-center-mode="true" data-xl-center-mode="true" data-ml-center-mode="true" data-dots="false">';
	                foreach( $settings['steps'] as $data ) { 
		                echo '<div class="col-lg-4 col-xl-3">';
		                    echo '<div class="project-card">';
		                    	if( ! empty( $data['image']['url'] ) ){
			                        echo '<div class="project-img">';
			                            echo ruffer_img_tag( array(
											'url'   => esc_url( $data['image']['url'] ),
										) );
			                        echo '</div>';
			                    }
		                        echo '<div class="project-content">';
		                        	if( ! empty( $data['tag'] ) ){
			                            echo '<h6 class="project-subtitle">'.esc_html( $data['tag'] ).'</h6>';
			                        }
			                        if( ! empty( $data['title'] ) ){
			                            echo '<h4 class="project-title h5"><a href="'.esc_url( $data['url'] ).'">'.esc_html( $data['title'] ).'</a></h4>';
			                        }
			                        if( ! empty( $data['image']['url'] ) ){
			                            echo '<a href="'. esc_url( $data['image']['url'] ) .'" class="icon-btn popup-image" tabindex="-1"><i class="far fa-plus"></i></a>';
			                        }
		                        echo '</div>';
		                    echo '</div>';
		                echo '</div>';
		            }
	           echo ' </div>';
	        echo '</div>';

	    }elseif( $settings['layout'] == '2' ){
	    	echo '<div class="container-fluid px-30">';
	            echo '<div class="row th-carousel" data-slide-show="4" data-ml-slide-show="3" data-lg-slide-show="3" data-md-slide-show="2" data-sm-slide-show="1" data-arrows="false">';
	                foreach( $settings['steps'] as $data ) { 
		                echo '<div class="col-md-6 col-xl-4">';
		                    echo '<div class="project-card style2">';
		                    	if( ! empty( $data['image']['url'] ) ){
			                        echo '<div class="project-img">';
			                            echo ruffer_img_tag( array(
											'url'   => esc_url( $data['image']['url'] ),
										) );
			                        echo '</div>';
			                    }

		                        echo '<div class="project-content">';
		                            if( ! empty( $data['tag'] ) ){
			                            echo '<h6 class="project-subtitle">'.esc_html( $data['tag'] ).'</h6>';
			                        }
			                        if( ! empty( $data['title'] ) ){
			                            echo '<h4 class="project-title"><a href="'.esc_url( $data['url'] ).'">'.esc_html( $data['title'] ).'</a></h4>';
			                        }
		                        echo '</div>';
		                    echo '</div>';
		                echo '</div>';
		            }
	            echo '</div>';
	        echo '</div>';

	    }elseif( $settings['layout'] == '3' ){
	    	echo '<div class="project-filter-btn filter-menu filter-menu-active">';
	    		$text = !empty( $settings['all_text'] ) ? $settings['all_text'] : esc_html__( 'All', 'ruffer' );
            	$filters = array();
            	foreach( $settings['projects2'] as $project ) {
            		$temp_filters = explode (",", $project['cats']);
            		foreach( $temp_filters as $temp_filter ) {
            			$filters[strtolower(trim($temp_filter))] = $temp_filter;
            		}
            	}
            	echo '<button data-filter="*" class="tab-btn active" type="button">' .esc_html( $text ). '</button>';
            	foreach( $filters as $filter ) {
                    echo '<button data-filter=".'.esc_attr( strtolower($filter) ).'" class="tab-btn" type="button">'.esc_html( $filter ).'</button>';
                }          
            echo '</div>';
            echo '<div class="row gallery-row gy-4 filter-active">';
            	foreach( $settings['projects2'] as $project ) {
            		$filter_slug = strtolower(str_replace(',', ' ', $project['cats']));
	                echo '<div class="col-md-6 col-xl-4 filter-item '.esc_attr( $filter_slug ).'">';
	                    echo '<div class="project-card style2 bg-overlay-2">';
	                    	if( ! empty( $project['image']['url'] ) ){
		                        echo '<div class="project-img">';
		                            echo '<img src="'.esc_url( $project['image']['url'] ).'" alt="project image">';
		                        echo '</div>';
		                    }
	                        echo '<div class="project-content">';
	                        	if( ! empty( $project['tag'] ) ){
		                            echo '<h6 class="project-subtitle">'.esc_html( $project['tag'] ).'</h6>';
		                        }
		                        if( ! empty( $project['title'] ) ){
		                            echo '<h4 class="project-title"><a href="'.esc_url($project['details_page']).'" tabindex="-1">'.esc_html( $project['title'] ).'</a></h4>';
		                        }
	                        echo '</div>';
	                    echo '</div>';
	               	echo '</div>';
               }
            echo '</div>';

	    }elseif( $settings['layout'] == '4' ){
	    	echo '<div class="row">';
                echo '<div class="col-lg-8">';
                    echo '<div class="title-area">';
                    	if( ! empty( $settings['title'] ) ){
	                        echo '<span class="sub-title">'.esc_html( $settings['title'] ).'</span>';
	                    }
	                    if( ! empty( $settings['subtitle'] ) ){
	                        echo '<h2 class="sec-title">'.esc_html( $settings['subtitle'] ).'</h2>';
	                    }

                    echo '</div>';
                echo '</div>';
                echo '<div class="col-lg-4 text-lg-end align-self-center">';
                    echo '<div class="arrow-wrap style2 mb-lg-0 mb-30">';
                        echo '<button data-slick-prev="#portfolio-slider4" class="slick-arrow slick-prev"><i class="fa-regular fa-arrow-left-long"></i></button>';
                        echo '<button data-slick-next="#portfolio-slider4" class="slick-arrow slick-next"><i class="fa-regular fa-arrow-right-long"></i></button>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';
            echo '<div class="row th-carousel portfolio-slider4 gx-30" data-slide-show="4" data-ml-slide-show="4" data-lg-slide-show="3" data-md-slide-show="2" data-sm-slide-show="1" data-arrows="false" id="portfolio-slider4">';
                foreach( $settings['steps'] as $project ) {
	                echo '<div class="col-lg-3">';
	                    echo '<div class="project-card style2">';
	                    	if( ! empty( $project['image']['url'] ) ){
		                        echo '<div class="project-img">';
		                            echo ruffer_img_tag( array(
										'url'   => esc_url( $project['image']['url'] ),
									) );
		                        echo '</div>';
		                    }
	                        echo '<div class="project-content">';
	                        	if( ! empty( $project['tag'] ) ){
		                            echo '<h6 class="project-subtitle">'.esc_html( $project['tag'] ).'</h6>';
		                        }
		                        if( ! empty( $project['title'] ) ){
		                            echo '<h4 class="project-title"><a href="'.esc_url( $project['url'] ).'" tabindex="-1">'.esc_html( $project['tag'] ).'</a></h4>';
		                        }
	                        echo '</div>';
	                    echo '</div>';
	                echo '</div>';
	            }
            echo '</div>';

	    }elseif( $settings['layout'] == '5' ){
	    	echo '<div class="project-area-5">';
		    	echo '<div class="row th-carousel portfolio-slider5 gx-30" data-slide-show="3" data-ml-slide-show="3" data-lg-slide-show="2" data-md-slide-show="1" data-sm-slide-show="1" data-dots="true" data-xl-dots="true" data-ml-dots="true" data-lg-dots="true" data-md-dots="true" data-arrows="false" id="portfolio-slider4">';
	                foreach( $settings['steps'] as $project ) {
		                echo '<div class="col-lg-3">';
		                    echo '<div class="project-card style2">';
		                    	if( ! empty( $project['image']['url'] ) ){
			                        echo '<div class="project-img">';
			                            echo ruffer_img_tag( array(
											'url'   => esc_url( $project['image']['url'] ),
										) );
			                        echo '</div>';
			                    }
		                        echo '<div class="project-content">';
		                            if( ! empty( $project['tag'] ) ){
			                            echo '<h6 class="project-subtitle">'.esc_html( $project['tag'] ).'</h6>';
			                        }
		                            if( ! empty( $project['title'] ) ){
			                            echo '<h4 class="project-title"><a href="'.esc_url( $project['url'] ).'" tabindex="-1">'.esc_html( $project['title'] ).'</a></h4>';
			                        }
		                        echo '</div>';
		                    echo '</div>';
		                echo '</div>';
		            }
	            echo '</div>';
            echo '</div>';

	    }elseif( $settings['layout'] == '6' ){
	    	echo '<div class="row th-carousel project-slider6 gx-30" data-slide-show="4" data-ml-slide-show="4" data-lg-slide-show="3" data-md-slide-show="2" data-sm-slide-show="1" data-arrows="true" id="portfolio-slider4">';
	    		foreach( $settings['steps'] as $project ) {
	                echo '<div class="col-lg-3">';
	                    echo '<div class="project-card style2">';
	                        if( ! empty( $project['image']['url'] ) ){
		                        echo '<div class="project-img">';
		                            echo ruffer_img_tag( array(
										'url'   => esc_url( $project['image']['url'] ),
									) );
		                        echo '</div>';
		                    }
	                        echo '<div class="project-content">';
	                            if( ! empty( $project['tag'] ) ){
		                            echo '<h6 class="project-subtitle">'.esc_html( $project['tag'] ).'</h6>';
		                        }
	                            if( ! empty( $project['title'] ) ){
		                            echo '<h4 class="project-title"><a href="'.esc_url( $project['url'] ).'" tabindex="-1">'.esc_html( $project['title'] ).'</a></h4>';
		                        }
	                        echo '</div>';
	                    echo '</div>';
	                echo '</div>';
	            }
            echo '</div>';

	    }elseif( $settings['layout'] == '7' ){
			echo '<div class="row th-carousel project-slider7 gx-30" data-slide-show="3" data-ml-slide-show="3" data-lg-slide-show="1" data-md-slide-show="1" data-sm-slide-show="1" data-arrows="false" data-center-mode="true" data-ml-center-mode="true" data-center-padding="200px" data-lg-center-padding="200px">';
				foreach( $settings['steps'] as $project ) {
					echo '<div class="col-lg-3">';
						echo '<div class="project-card style3">';
							if( ! empty( $project['image']['url'] ) ){
		                        echo '<div class="project-img">';
		                            echo ruffer_img_tag( array(
										'url'   => esc_url( $project['image']['url'] ),
									) );
		                        echo '</div>';
		                    }
							echo '<div class="project-content">';
								if( ! empty( $project['tag'] ) ){
									echo '<h6 class="project-subtitle">'.esc_html( $project['tag'] ).'</h6>';
								}
								if( ! empty( $project['title'] ) ){
									echo '<h4 class="project-title"><a href="'.esc_url( $project['url'] ).'" tabindex="-1">'.esc_html( $project['title'] ).'</a></h4>';
								}
								echo '<a href="'.esc_url( $project['image']['url'] ).'" class="icon-btn popup-image" tabindex="-1"><i class="far fa-plus"></i></a>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
			   }
			echo '</div>';

		}elseif( $settings['layout'] == '8' ){
			echo '<div class="row gx-30 gy-30 filter-active">';
				foreach( $settings['projects3'] as $project ) {
					echo '<div class="col-xxl-auto col-lg-6 filter-item">';
						echo '<div class="project-card style4">';
							if( ! empty( $project['image']['url'] ) ){
		                        echo '<div class="project-img">';
		                            echo ruffer_img_tag( array(
										'url'   => esc_url( $project['image']['url'] ),
									) );
		                        echo '</div>';
		                    }
							echo '<div class="project-content">';
								if( ! empty( $project['title'] ) ){
									echo '<h4 class="project-title"><a href="'.esc_url( $project['project_url']['url'] ).'" tabindex="-1">'.esc_html( $project['title'] ).'</a></h4>';
								}
								echo '<a href="'.esc_url( $project['image']['url'] ).'" class="icon-btn popup-image" tabindex="-1"><i class="far fa-plus"></i></a>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				}
            echo '</div>';

		}elseif( $settings['layout'] == '9' ){

		}


	}
}