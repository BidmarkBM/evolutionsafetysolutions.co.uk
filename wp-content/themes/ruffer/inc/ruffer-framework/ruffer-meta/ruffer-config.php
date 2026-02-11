<?php

/**
 * Include and setup custom metaboxes and fields. (make sure you copy this file to outside the CMB2 directory)
 *
 * Be sure to replace all instances of 'yourprefix_' with your project's prefix.
 * http://nacin.com/2010/05/11/in-wordpress-prefix-everything/
 *
 * @category YourThemeOrPlugin
 * @package  Demo_CMB2
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/WebDevStudios/CMB2
 */

 /**
 * Only return default value if we don't have a post ID (in the 'post' query variable)
 *
 * @param  bool  $default On/Off (true/false)
 * @return mixed          Returns true or '', the blank default
 */
function ruffer_set_checkbox_default_for_new_post( $default ) {
	return isset( $_GET['post'] ) ? '' : ( $default ? (string) $default : '' );
}

add_action( 'cmb2_admin_init', 'ruffer_register_metabox' );

/**
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_admin_init' or 'cmb2_init' hook.
 */

function ruffer_register_metabox() {

	$prefix = '_ruffer_';

	$prefixpage = '_rufferpage_';
	
	
	$ruffer_post_meta = new_cmb2_box( array(
		'id'            => $prefixpage . 'blog_post_control',
		'title'         => esc_html__( 'Post Thumb Controller', 'ruffer' ),
		'object_types'  => array( 'post' ), // Post type
		'closed'        => true
	) );
	$ruffer_post_meta->add_field( array(
		'name' => esc_html__( 'Post Format Video', 'ruffer' ),
		'desc' => esc_html__( 'Use This Field When Post Format Video', 'ruffer' ),
		'id'   => $prefix . 'post_format_video',
        'type' => 'text_url',
    ) );
	$ruffer_post_meta->add_field( array(
		'name' => esc_html__( 'Post Format Audio', 'ruffer' ),
		'desc' => esc_html__( 'Use This Field When Post Format Audio', 'ruffer' ),
		'id'   => $prefix . 'post_format_audio',
        'type' => 'oembed',
    ) );
	$ruffer_post_meta->add_field( array(
		'name' => esc_html__( 'Post Thumbnail For Slider', 'ruffer' ),
		'desc' => esc_html__( 'Use This Field When You Want A Slider In Post Thumbnail', 'ruffer' ),
		'id'   => $prefix . 'post_format_slider',
        'type' => 'file_list',
    ) );
	
	$ruffer_page_meta = new_cmb2_box( array(
		'id'            => $prefixpage . 'page_meta_section',
		'title'         => esc_html__( 'Page Meta', 'ruffer' ),
		'object_types'  => array( 'page', 'ruffer_event' ), // Post type
        'closed'        => true
    ) );

    $ruffer_page_meta->add_field( array(
		'name' => esc_html__( 'Page Breadcrumb Area', 'ruffer' ),
		'desc' => esc_html__( 'check to display page breadcrumb area.', 'ruffer' ),
		'id'   => $prefix . 'page_breadcrumb_area',
        'type' => 'select',
        'default' => '1',
        'options'   => array(
            '1'   => esc_html__('Show','ruffer'),
            '2'     => esc_html__('Hide','ruffer'),
        )
    ) );


    $ruffer_page_meta->add_field( array(
		'name' => esc_html__( 'Page Breadcrumb Settings', 'ruffer' ),
		'id'   => $prefix . 'page_breadcrumb_settings',
        'type' => 'select',
        'default'   => 'global',
        'options'   => array(
            'global'   => esc_html__('Global Settings','ruffer'),
            'page'     => esc_html__('Page Settings','ruffer'),
        )
	) );

    $ruffer_page_meta->add_field( array(
        'name'    => esc_html__( 'Breadcumb Image', 'ruffer' ),
        'desc'    => esc_html__( 'Upload an image or enter an URL.', 'ruffer' ),
        'id'      => $prefix . 'breadcumb_image',
        'type'    => 'file',
        // Optional:
        'options' => array(
            'url' => false, // Hide the text input for the url
        ),
        'text'    => array(
            'add_upload_file_text' => __( 'Add File', 'ruffer' ) // Change upload button text. Default: "Add or Upload File"
        ),
        'preview_size' => 'large', // Image size to use when previewing in the admin.
    ) );

    $ruffer_page_meta->add_field( array(
		'name' => esc_html__( 'Page Title', 'ruffer' ),
		'desc' => esc_html__( 'check to display Page Title.', 'ruffer' ),
		'id'   => $prefix . 'page_title',
        'type' => 'select',
        'default' => '1',
        'options'   => array(
            '1'   => esc_html__('Show','ruffer'),
            '2'     => esc_html__('Hide','ruffer'),
        )
	) );

    $ruffer_page_meta->add_field( array(
		'name' => esc_html__( 'Page Title Settings', 'ruffer' ),
		'id'   => $prefix . 'page_title_settings',
        'type' => 'select',
        'options'   => array(
            'default'  => esc_html__('Default Title','ruffer'),
            'custom'  => esc_html__('Custom Title','ruffer'),
        ),
        'default'   => 'default'
    ) );

    $ruffer_page_meta->add_field( array(
		'name' => esc_html__( 'Custom Page Title', 'ruffer' ),
		'id'   => $prefix . 'custom_page_title',
        'type' => 'text'
    ) );

    $ruffer_page_meta->add_field( array(
		'name' => esc_html__( 'Breadcrumb', 'ruffer' ),
		'desc' => esc_html__( 'Select Show to display breadcrumb area', 'ruffer' ),
		'id'   => $prefix . 'page_breadcrumb_trigger',
        'type' => 'switch_btn',
        'default' => ruffer_set_checkbox_default_for_new_post( true ),
    ) );

    $ruffer_layout_meta = new_cmb2_box( array(
		'id'            => $prefixpage . 'page_layout_section',
		'title'         => esc_html__( 'Page Layout', 'ruffer' ),
        'context' 		=> 'side',
        'priority' 		=> 'high',
        'object_types'  => array( 'page' ), // Post type
        'closed'        => true
	) );

	$ruffer_layout_meta->add_field( array(
		'desc'       => esc_html__( 'Set page layout container,container fluid,fullwidth or both. It\'s work only in template builder page.', 'ruffer' ),
		'id'         => $prefix . 'custom_page_layout',
		'type'       => 'radio',
        'options' => array(
            '1' => esc_html__( 'Container', 'ruffer' ),
            '2' => esc_html__( 'Container Fluid', 'ruffer' ),
            '3' => esc_html__( 'Fullwidth', 'ruffer' ),
        ),
	) );

    // code for body class//
    $ruffer_layout_meta->add_field( array(
        'name' => esc_html__( 'Insert Your Body Class', 'ruffer' ),
        'id'   => $prefix . 'custom_body_class',
        'type' => 'text'
    ) );

}

add_action( 'cmb2_admin_init', 'ruffer_register_taxonomy_metabox' );
/**
 * Hook in and add a metabox to add fields to taxonomy terms
 */
function ruffer_register_taxonomy_metabox() {

    $prefix = '_ruffer_';
	/**
	 * Metabox to add fields to categories and tags
	 */
	$ruffer_term_meta = new_cmb2_box( array(
		'id'               => $prefix.'term_edit',
		'title'            => esc_html__( 'Category Metabox', 'ruffer' ),
		'object_types'     => array( 'term' ),
		'taxonomies'       => array( 'category'),
	) );
	$ruffer_term_meta->add_field( array(
		'name'     => esc_html__( 'Extra Info', 'ruffer' ),
		'id'       => $prefix.'term_extra_info',
		'type'     => 'title',
		'on_front' => false,
	) );
	$ruffer_term_meta->add_field( array(
		'name' => esc_html__( 'Category Image', 'ruffer' ),
		'desc' => esc_html__( 'Set Category Image', 'ruffer' ),
		'id'   => $prefix.'term_avatar',
        'type' => 'file',
        'text'    => array(
			'add_upload_file_text' => esc_html__('Add Image','ruffer') // Change upload button text. Default: "Add or Upload File"
		),
	) );


	/**
	 * Metabox for the user profile screen
	 */
	$ruffer_user = new_cmb2_box( array(
		'id'               => $prefix.'user_edit',
		'title'            => esc_html__( 'User Profile Metabox', 'ruffer' ), // Doesn't output for user boxes
		'object_types'     => array( 'user' ), // Tells CMB2 to use user_meta as post_meta
		'show_names'       => true,
		'new_user_section' => 'add-new-user', // where form will show on new user page. 'add-existing-user' is only other valid option.
	) );

	$ruffer_user->add_field( array(
        'name'     => esc_html__( 'User Designation', 'ruffer' ),
        'id'       => $prefix.'user_designation',
        'type'     => 'text',
        'on_front' => false,
    ) );

    $ruffer_user->add_field( array(
		'name'     => esc_html__( 'Social Profile', 'ruffer' ),
		'id'       => $prefix.'user_extra_info',
		'type'     => 'title',
		'on_front' => false,
	) );

	$group_field_id = $ruffer_user->add_field( array(
        'id'          => $prefix .'social_profile_group',
        'type'        => 'group',
        'description' => __( 'Social Profile', 'ruffer' ),
        'options'     => array(
            'group_title'       => __( 'Social Profile {#}', 'ruffer' ), // since version 1.1.4, {#} gets replaced by row number
            'add_button'        => __( 'Add Another Social Profile', 'ruffer' ),
            'remove_button'     => __( 'Remove Social Profile', 'ruffer' ),
            'closed'         => true
        ),
    ) );

    $ruffer_user->add_group_field( $group_field_id, array(
        'name'        => __( 'Icon Class', 'ruffer' ),
        'id'          => $prefix .'social_profile_icon',
        'type'        => 'text', // This field type
    ) );

    $ruffer_user->add_group_field( $group_field_id, array(
        'desc'       => esc_html__( 'Set social profile link.', 'ruffer' ),
        'id'         => $prefix . 'lawyer_social_profile_link',
        'name'       => esc_html__( 'Social Profile link', 'ruffer' ),
        'type'       => 'text'
    ) );
}
