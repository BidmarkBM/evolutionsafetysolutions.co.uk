<?php
    /**
     * Class For Builder
     */
    class RufferBuilder{

        function __construct(){
            // register admin menus
        	add_action( 'admin_menu', [$this, 'register_settings_menus'] );

            // Custom Footer Builder With Post Type
			add_action( 'init',[ $this,'post_type' ],0 );

 		    add_action( 'elementor/frontend/after_enqueue_scripts', [ $this,'widget_scripts'] );

			add_filter( 'single_template', [ $this, 'load_canvas_template' ] );

            add_action( 'elementor/element/wp-page/document_settings/after_section_end', [ $this,'ruffer_add_elementor_page_settings_controls' ],10,2 );

		}

		public function widget_scripts( ) {
			wp_enqueue_script( 'ruffer-core',RUFFER_PLUGDIRURI.'assets/js/ruffer-core.js',array( 'jquery' ),'1.0',true );
		}


        public function ruffer_add_elementor_page_settings_controls( \Elementor\Core\DocumentTypes\Page $page ){

			$page->start_controls_section(
                'ruffer_header_option',
                [
                    'label'     => __( 'Header Option', 'ruffer' ),
                    'tab'       => \Elementor\Controls_Manager::TAB_SETTINGS,
                ]
            );


            $page->add_control(
                'ruffer_header_style',
                [
                    'label'     => __( 'Header Option', 'ruffer' ),
                    'type'      => \Elementor\Controls_Manager::SELECT,
                    'options'   => [
    					'prebuilt'             => __( 'Pre Built', 'ruffer' ),
    					'header_builder'       => __( 'Header Builder', 'ruffer' ),
    				],
                    'default'   => 'prebuilt',
                ]
			);

            $page->add_control(
                'ruffer_header_builder_option',
                [
                    'label'     => __( 'Header Name', 'ruffer' ),
                    'type'      => \Elementor\Controls_Manager::SELECT,
                    'options'   => $this->ruffer_header_choose_option(),
                    'condition' => [ 'ruffer_header_style' => 'header_builder'],
                    'default'	=> ''
                ]
            );

            $page->end_controls_section();

            $page->start_controls_section(
                'ruffer_footer_option',
                [
                    'label'     => __( 'Footer Option', 'ruffer' ),
                    'tab'       => \Elementor\Controls_Manager::TAB_SETTINGS,
                ]
            );
            $page->add_control(
    			'ruffer_footer_choice',
    			[
    				'label'         => __( 'Enable Footer?', 'ruffer' ),
    				'type'          => \Elementor\Controls_Manager::SWITCHER,
    				'label_on'      => __( 'Yes', 'ruffer' ),
    				'label_off'     => __( 'No', 'ruffer' ),
    				'return_value'  => 'yes',
    				'default'       => 'yes',
    			]
    		);
            $page->add_control(
                'ruffer_footer_style',
                [
                    'label'     => __( 'Footer Style', 'ruffer' ),
                    'type'      => \Elementor\Controls_Manager::SELECT,
                    'options'   => [
    					'prebuilt'             => __( 'Pre Built', 'ruffer' ),
    					'footer_builder'       => __( 'Footer Builder', 'ruffer' ),
    				],
                    'default'   => 'prebuilt',
                    'condition' => [ 'ruffer_footer_choice' => 'yes' ],
                ]
            );
            $page->add_control(
                'ruffer_footer_builder_option',
                [
                    'label'     => __( 'Footer Name', 'ruffer' ),
                    'type'      => \Elementor\Controls_Manager::SELECT,
                    'options'   => $this->ruffer_footer_build_choose_option(),
                    'condition' => [ 'ruffer_footer_style' => 'footer_builder','ruffer_footer_choice' => 'yes' ],
                    'default'	=> ''
                ]
            );

			$page->end_controls_section();

        }

		public function register_settings_menus(){
			add_menu_page(
				esc_html__( 'Ruffer Builder', 'ruffer' ),
            	esc_html__( 'Ruffer Builder', 'ruffer' ),
				'manage_options',
				'ruffer',
				[$this,'register_settings_contents__settings'],
				'dashicons-admin-site',
				2
			);

			add_submenu_page('ruffer', esc_html__('Footer Builder', 'ruffer'), esc_html__('Footer Builder', 'ruffer'), 'manage_options', 'edit.php?post_type=ruffer_footer_build');
			add_submenu_page('ruffer', esc_html__('Header Builder', 'ruffer'), esc_html__('Header Builder', 'ruffer'), 'manage_options', 'edit.php?post_type=ruffer_header');
			add_submenu_page('ruffer', esc_html__('Tab Builder', 'ruffer'), esc_html__('Tab Builder', 'ruffer'), 'manage_options', 'edit.php?post_type=ruffer_tab_builder');
		}

		// Callback Function
		public function register_settings_contents__settings(){
            echo '<h2>';
			    echo esc_html__( 'Welcome To Header And Footer Builder Of This Theme','ruffer' );
            echo '</h2>';
		}

		public function post_type() {

			$labels = array(
				'name'               => __( 'Footer', 'ruffer' ),
				'singular_name'      => __( 'Footer', 'ruffer' ),
				'menu_name'          => __( 'Ruffer Footer Builder', 'ruffer' ),
				'name_admin_bar'     => __( 'Footer', 'ruffer' ),
				'add_new'            => __( 'Add New', 'ruffer' ),
				'add_new_item'       => __( 'Add New Footer', 'ruffer' ),
				'new_item'           => __( 'New Footer', 'ruffer' ),
				'edit_item'          => __( 'Edit Footer', 'ruffer' ),
				'view_item'          => __( 'View Footer', 'ruffer' ),
				'all_items'          => __( 'All Footer', 'ruffer' ),
				'search_items'       => __( 'Search Footer', 'ruffer' ),
				'parent_item_colon'  => __( 'Parent Footer:', 'ruffer' ),
				'not_found'          => __( 'No Footer found.', 'ruffer' ),
				'not_found_in_trash' => __( 'No Footer found in Trash.', 'ruffer' ),
			);

			$args = array(
				'labels'              => $labels,
				'public'              => true,
				'rewrite'             => false,
				'show_ui'             => true,
				'show_in_menu'        => false,
				'show_in_nav_menus'   => false,
				'exclude_from_search' => true,
				'capability_type'     => 'post',
				'hierarchical'        => false,
				'supports'            => array( 'title', 'elementor' ),
			);

			register_post_type( 'ruffer_footer_build', $args );

			$labels = array(
				'name'               => __( 'Header', 'ruffer' ),
				'singular_name'      => __( 'Header', 'ruffer' ),
				'menu_name'          => __( 'Ruffer Header Builder', 'ruffer' ),
				'name_admin_bar'     => __( 'Header', 'ruffer' ),
				'add_new'            => __( 'Add New', 'ruffer' ),
				'add_new_item'       => __( 'Add New Header', 'ruffer' ),
				'new_item'           => __( 'New Header', 'ruffer' ),
				'edit_item'          => __( 'Edit Header', 'ruffer' ),
				'view_item'          => __( 'View Header', 'ruffer' ),
				'all_items'          => __( 'All Header', 'ruffer' ),
				'search_items'       => __( 'Search Header', 'ruffer' ),
				'parent_item_colon'  => __( 'Parent Header:', 'ruffer' ),
				'not_found'          => __( 'No Header found.', 'ruffer' ),
				'not_found_in_trash' => __( 'No Header found in Trash.', 'ruffer' ),
			);

			$args = array(
				'labels'              => $labels,
				'public'              => true,
				'rewrite'             => false,
				'show_ui'             => true,
				'show_in_menu'        => false,
				'show_in_nav_menus'   => false,
				'exclude_from_search' => true,
				'capability_type'     => 'post',
				'hierarchical'        => false,
				'supports'            => array( 'title', 'elementor' ),
			);

			register_post_type( 'ruffer_header', $args );

			$labels = array(
				'name'               => __( 'Tab Builder', 'ruffer' ),
				'singular_name'      => __( 'Tab Builder', 'ruffer' ),
				'menu_name'          => __( 'Gesund Tab Builder', 'ruffer' ),
				'name_admin_bar'     => __( 'Tab Builder', 'ruffer' ),
				'add_new'            => __( 'Add New', 'ruffer' ),
				'add_new_item'       => __( 'Add New Tab Builder', 'ruffer' ),
				'new_item'           => __( 'New Tab Builder', 'ruffer' ),
				'edit_item'          => __( 'Edit Tab Builder', 'ruffer' ),
				'view_item'          => __( 'View Tab Builder', 'ruffer' ),
				'all_items'          => __( 'All Tab Builder', 'ruffer' ),
				'search_items'       => __( 'Search Tab Builder', 'ruffer' ),
				'parent_item_colon'  => __( 'Parent Tab Builder:', 'ruffer' ),
				'not_found'          => __( 'No Tab Builder found.', 'ruffer' ),
				'not_found_in_trash' => __( 'No Tab Builder found in Trash.', 'ruffer' ),
			);

			$args = array(
				'labels'              => $labels,
				'public'              => true,
				'rewrite'             => false,
				'show_ui'             => true,
				'show_in_menu'        => false,
				'show_in_nav_menus'   => false,
				'exclude_from_search' => true,
				'capability_type'     => 'post',
				'hierarchical'        => false,
				'supports'            => array( 'title', 'elementor' ),
			);

			register_post_type( 'ruffer_tab_builder', $args );
		}

		function load_canvas_template( $single_template ) {

			global $post;

			if ( 'ruffer_footer_build' == $post->post_type || 'ruffer_header' == $post->post_type || 'ruffer_tab_build' == $post->post_type ) {

				$elementor_2_0_canvas = ELEMENTOR_PATH . '/modules/page-templates/templates/canvas.php';

				if ( file_exists( $elementor_2_0_canvas ) ) {
					return $elementor_2_0_canvas;
				} else {
					return ELEMENTOR_PATH . '/includes/page-templates/canvas.php';
				}
			}

			return $single_template;
		}

        public function ruffer_footer_build_choose_option(){

			$ruffer_post_query = new WP_Query( array(
				'post_type'			=> 'ruffer_footer_build',
				'posts_per_page'	    => -1,
			) );

			$ruffer_builder_post_title = array();
			$ruffer_builder_post_title[''] = __('Select a Footer','Ruffer');

			while( $ruffer_post_query->have_posts() ) {
				$ruffer_post_query->the_post();
				$ruffer_builder_post_title[ get_the_ID() ] =  get_the_title();
			}
			wp_reset_postdata();

			return $ruffer_builder_post_title;

		}

		public function ruffer_header_choose_option(){

			$ruffer_post_query = new WP_Query( array(
				'post_type'			=> 'ruffer_header',
				'posts_per_page'	    => -1,
			) );

			$ruffer_builder_post_title = array();
			$ruffer_builder_post_title[''] = __('Select a Header','Ruffer');

			while( $ruffer_post_query->have_posts() ) {
				$ruffer_post_query->the_post();
				$ruffer_builder_post_title[ get_the_ID() ] =  get_the_title();
			}
			wp_reset_postdata();

			return $ruffer_builder_post_title;

        }

    }

    $builder_execute = new RufferBuilder();