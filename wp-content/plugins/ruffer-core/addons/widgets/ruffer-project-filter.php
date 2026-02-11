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
 * Project Filter Widget .
 *
 */
class Ruffer_Project_Filter extends Widget_Base {

	public function get_name() {
		return 'rufferprojectfilter';
	}
	public function get_title() {
		return __( 'Project Filter', 'ruffer' );
	}
	public function get_icon() {
		return 'th-icon';
    }
	public function get_categories() {
		return [ 'ruffer' ];
	}

	protected function register_controls() {

		 $this->start_controls_section(
			'Project Filter_section',
			[
				'label'		 	=> __( 'Project Filter', 'ruffer' ),
				'tab' 			=> Controls_Manager::TAB_CONTENT,
			]
        );

		ruffer_select_field( $this, 'layout_style', 'Layout Style', [ 'Style One' ] );

        ruffer_switcher_fields($this, 'show_all', 'Show All Tab?');
		ruffer_general_fields($this, 'all_title', 'All Tab Text', 'TEXT', 'All');

		$repeater = new Repeater();

		ruffer_general_fields($repeater, 'tab_title', 'Tab Title', 'TEXT', 'Residential');
		ruffer_general_fields($repeater, 'tab_id', 'Filter Tab ID', 'TEXT', 'cat1');

		$this->add_control(
			'project_tab',
			[
				'label' 		=> __( 'project Tab', 'ruffer' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'tab_title' 		=> __( 'Residential', 'ruffer' ),
					],
				],
			]
		);

		$repeater = new Repeater();

		ruffer_general_fields($repeater, 'tab_id2', 'Filter Content ID', 'TEXT', 'cat1');
		ruffer_media_fields($repeater, 'image', 'Choose Image');
		ruffer_general_fields($repeater, 'title', 'Title', 'TEXTAREA2', 'Roof Planning');
		ruffer_general_fields($repeater, 'desc', 'Descrption', 'TEXTAREA2', 'Flash Guard Leak Detection');
        ruffer_general_fields($repeater, 'column', 'Column Class', 'TEXT', 'col-md-6 col-xxl-3');
		ruffer_url_fields($repeater, 'button_url', 'Button URL');

		$this->add_control(
			'project_list',
			[
				'label' 		=> __( 'Project Lists', 'ruffer' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'title' 		=> __( 'Roof Planning', 'ruffer' ), 
					],
				],
				'condition'		=> [ 
					'layout_style' => [ '1', '2'],
				],
			]
		);

        $this->end_controls_section();

        //---------------------------------------
			//Style Section Start
		//---------------------------------------
		
		ruffer_common2_style_fields( $this, '01', 'Title', '{{WRAPPER}} .project-title a' );
		ruffer_common_style_fields( $this, '02', 'Description', '{{WRAPPER}} p' );


	}

	protected function render() {

	$settings = $this->get_settings_for_display();

		if( $settings['layout_style'] == '1' ){
            echo '<div class="project-filter-btn filter-menu filter-menu-active">';
                if(!empty($settings['show_all'])){
                    $active = '';
                    if(!empty($settings['all_title'])){
                        $title = $settings['all_title'];
                    }else{
                        $title = 'All';
                    }
                    echo '<button data-filter="*" class="tab-btn active" type="button">'.esc_html($title).'</button>';
                }else{
                    $active = 'active';
                }
                foreach( $settings['project_tab'] as $key => $data ){
                    $id = strtolower($data['tab_id']);
                    $active_class = ($key == 0) ? $active : '';
                    echo '<button data-filter=".'.esc_attr($id).'" class="tab-btn '.esc_attr($active_class).'" type="button">'.esc_html($data['tab_title']).'</button>';
                }
            echo '</div>';
            
            echo '<div class="row gy-4 gallery-row justify-content-center overflow-hidden filter-active">';
                foreach( $settings['project_list'] as $data ){
                    if(!empty($data['column'])){
						$column = $data['column'];
					}else{
						$column = 'col-md-6 col-xxl-3';
					}

                    $id = strtolower($data['tab_id2']);
                    echo '<div class="'.esc_attr($column).' mx-auto filter-item '.esc_attr($id).'">';
                        echo '<div class="project-card overflow-hidden style6 bg-overlay-2">';
                            if(!empty($data['image']['url'])){
                                echo '<div class="project-img">';
                                    echo ruffer_img_tag( array(
                                        'url'   => esc_url( $data['image']['url'] ),
                                    ));
                                echo '</div>';
                            }
                            echo '<div class="project-content">';
                                echo '<div>';
                                    echo '<a class="link" href="'.esc_url( $data['button_url']['url'] ).'"><i class="fa-solid fa-arrow-down-long"></i></a>';
                                    if( ! empty( $data['title'] ) ){
                                        echo '<h4 class="project-title"><a href="'.esc_url( $data['button_url']['url'] ).'" tabindex="-1">'.esc_html( $data['title'] ).'</a></h4>';
                                    }
                                    if( ! empty( $data['desc'] ) ){
                                        echo '<p class="m-0">'.esc_html( $data['desc'] ).'</p>';
                                    }
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                }
            echo '</div>';

		}elseif( $settings['layout_style'] == '2' ){


		}elseif( $settings['layout_style'] == '3' ){


		}
	

	}

}