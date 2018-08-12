<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       #
 * @since      1.0.0
 *
 * @package    Wordflex_Carousel
 * @subpackage Wordflex_Carousel/admin/partials
 */


/**
 * WordFlex Carousel Metabox
 * @return Argument arrays
 */
function wordflex_carousel_metabox() {

    // Start with an underscore to hide fields from custom fields list.
    $prefix = 'cmb_';
    // Carousel Metaboxes
    $cmb_carousel = new_cmb2_box( array(
        'id'            => $prefix . 'carousel',
        'title'   		=> __( 'Carousel settings', 'wordflex-carousel' ),
        'object_types'      => array( 'wordflex-carousel' ),
        'priority'          => 'low',
        'context'           => 'normal',
    ) );


    $carousel_options = new_cmb2_box( array(
        'id'           => 'wordflex_carousel_options_page',
        'title'        => esc_html__( 'General Settings', 'wordflex-carousel' ),
        'object_types' => array( 'options-page' ),
        'option_key'   => 'wordflex_carousel_options',
        'parent_slug'  => 'edit.php?post_type=wordflex-carousel',
    ) );

    $carousel_options->add_field( array(
        'name'          => __('General Settings', 'wordflex-carousel'),
        'desc'          => __('Control how your Carousel is displayed', 'wordflex-carousel'),
        'type'          => 'title',
        'id'            => 'general_settings_title',
    ) );

    // Check Bootstrap
    $carousel_options->add_field( array(
        'name'          => __('Enable Bootstrap', 'wordflex-carousel'),
        'desc'          => __('Please check your Theme if it already have Bootstrap before you enable this option to avoid any conflict', 'wordflex-carousel'),
        'id'            => $prefix . 'carousel_load_bootstrap',
        'type'          => 'radio_inline',
        'options'       => array(
            'yes'   => __( 'Yes', 'wordflex-carousel' ),
            'no'    => __( 'No', 'wordflex-carousel' ),
        ),
        'default'       => 'no',
        'classes'       => 'switch-field',
    ) );

    // Check animate style
    $carousel_options->add_field( array(
        'name'          => __('Enable Animate.css style', 'wordflex-carousel'),
        'desc'          => __('Please check your Theme If it already have Animate.css before you enable this option to avoid any conflict', 'wordflex-carousel'),
        'id'            => $prefix . 'carousel_load_animate',
        'type'          => 'radio_inline',
        'options'       => array(
            'yes'   => __( 'Yes', 'wordflex-carousel' ),
            'no'    => __( 'No', 'wordflex-carousel' ),
        ),
        'default'       => 'no',
        'classes'       => 'switch-field',
    ) );
    // Height
    $carousel_options->add_field( array(
        'name'          => __( 'Carousel Height:', 'wordflex-carousel' ),
        'desc'          => __( 'Set slider height in pixels. (0 = Auto)', 'wordflex-carousel' ),
        'id'            => $prefix . 'carousel_height',
        'type'          => 'text_small',
        'attributes'    => array(
            'type'     => 'number',
            'pattern'  => '\d*',
        ),
        'sanitization_cb'  => 'absint',
        'escape_cb'        => 'absint',
    ) );
    // Carousel interval
    $carousel_options->add_field( array(
        'name'          => __( 'Carousel Interval:', 'wordflex-carousel' ),
        'desc'          => __( 'Specifies the delay (in milliseconds) between each slide. <br>Default value = 5000', 'wordflex-carousel' ),
        'id'            => $prefix . 'carousel_interval',
        'type'          => 'text_small',
        'attributes'    => array(
            'type'    => 'number',
            'pattern' => '\d*',
        ),
        'sanitization_cb'   => 'absint',
        'escape_cb'         => 'absint',
    ) );
    // Controls
    $carousel_options->add_field( array(
        'name'          => __('Show Controls', 'wordflex-carousel'),
        'id'            => $prefix . 'carousel_arrow',
        'type'          => 'radio_inline',
        'options'       => array(
            'yes' => __( 'Yes', 'wordflex-carousel' ),
            'no'  => __( 'No', 'wordflex-carousel' ),
        ),
        'default'       => 'yes',
        'classes'       => 'switch-field',
    ) );
    // indicators
    $carousel_options->add_field( array(
        'name'          => __('Show Indicators', 'wordflex-carousel' ),
        'id'            => $prefix . 'carousel_dots',
        'type'          => 'radio_inline',
        'options'       => array(
            'yes' => __( 'Yes', 'wordflex-carousel' ),
            'no'  => __( 'No', 'wordflex-carousel' ),
        ),
        'default'       => 'yes',
        'classes'       => 'switch-field',
    ) );

     // Carousel transition
    $carousel_options->add_field( array(
         'name'          => __( 'Carousel Transition', 'wordflex-carousel' ),
         'desc'          => __('Change the carousel transition effect. <br>This feature added in Bootstrap 4.1', 'wordflex-carousel'),
         'id'            => $prefix . 'carousel_transition',
         'type'          => 'select',
         'options'       => array(
             ''                 => __('Slide', 'wordflex-carousel'),
             'carousel-fade'    => __('Fade', 'wordflex-carousel'),
         ),
         'default'       => '',
     ) );



    $cmb_carousel->add_field( array(
        'name'          => __('Slider settings', 'wordflex-carousel'),
        'desc'          => __('Click on Slide Tap below to edit. Use <strong>&#8593; up / down &#8595;</strong> arrows to re-order the slides', 'wordflex-carousel' ),
        'type'          => 'title',
        'id'            => 'slider_settings_title',
    ) ); 
    // Repeatable group
    $group_cmb_carousel = $cmb_carousel->add_field( array(
        'id'            => $prefix . 'carousel_group',
        'type'          => 'group',
        'options'       => array(
            'group_title'   => __( 'Slider', 'wordflex-carousel' ) . ' {#}', // {#} gets replaced by row number
            'add_button'    => __( 'Add another Slide', 'wordflex-carousel' ),
            'remove_button' => __( 'Remove Slide', 'wordflex-carousel' ),
            'sortable'      => true, // beta
            'closed'        => true,
        ),
    ) );
    // Image
    $cmb_carousel->add_group_field( $group_cmb_carousel,array(
        'name'          => __( 'Slide Image', 'wordflex-carousel' ),
        'desc'          => __( 'Select an image for this slide', 'wordflex-carousel' ),
        'id'            => 'carousel_img',
        'type'          => 'file',
    ) );
    // Heading
    $cmb_carousel->add_group_field( $group_cmb_carousel, array(
        'name'          => __( 'Heading:', 'wordflex-carousel' ),
        'desc'          => __('The default HTML Tag is H1, You can leave it empty to hide it and add your own structure in the content box.' ,'wordflex-carousel'),
        'id'            => 'carousel_heading',
        'type'          => 'text',
        'default'       => 'Heading',
    ) );
    // Content
    $cmb_carousel->add_group_field( $group_cmb_carousel, array(
        'name'          => __( 'Content:', 'wordflex-carousel' ),
        'desc'          => __('Leave it empty to hide it. (HTML Allowed).', 'wordflex-carousel'),
        'id'            => 'carousel_content',
        'type'          => 'textarea',
        'default'       => 'Add your content',
    ) );
    // Button Text
    $cmb_carousel->add_group_field( $group_cmb_carousel, array(
        'name'          => __( 'Button text:', 'wordflex-carousel' ),
        'desc'          => __('Leave it empty to hide it.','wordflex-carousel'),
        'id'            => 'carousel_button_text',
        'type'          => 'text',
        'default'       => 'Button',
    ) );
    // Button URL
    $cmb_carousel->add_group_field( $group_cmb_carousel, array(
        'name'          => __( 'Button URL:', 'wordflex-carousel' ),
        'id'            => 'carousel_button_url',
        'type'          => 'text_url',
        'default'       => '#',
    ) );
    // Button style
    $cmb_carousel->add_group_field ( $group_cmb_carousel, array(
        'name'          => __( 'Button style:', 'wordflex-carousel' ),
        'desc'          => __('Button style is based on Bootstrap 4.', 'wordflex-carousel'),
        'id'            => 'carousel_button_style',
        'type'          => 'select',
        'show_option_none' => false,
        'options'       => array(
            'primary'   => __('Primary', 'wordflex-carousel'),
            'secondary' => __('Secondary', 'wordflex-carousel'),
            'success'   => __('Success', 'wordflex-carousel'),
            'danger'    => __('Danger', 'wordflex-carousel'),
            'warning'   => __('Warning', 'wordflex-carousel'),
            'info'      => __('Info', 'wordflex-carousel'),
            'light'     => __('Light', 'wordflex-carousel'),
            'dark'      => __('Dark', 'wordflex-carousel'),
            'link'      => __('Link', 'wordflex-carousel'),
        ),
        'default'       => 'light',
    ) );
    // Button style outline
    $cmb_carousel->add_group_field ( $group_cmb_carousel, array(
        'name'          => __('Button outline:', 'wordflex-carousel'),
        'id'            => 'carousel_button_outline',
        'type'          => 'radio_inline',
        'options'       => array(
            'outline'   => __( 'Yes', 'wordflex-carousel' ),
            ''          => __( 'No', 'wordflex-carousel' ),
        ),
        'default'       => 'outline',
        'classes'       => 'switch-field',
    ) );
    // Content color
    $cmb_carousel->add_group_field( $group_cmb_carousel, array(
        'name'          => __('Content color:', 'wordflex-carousel' ),
        'desc'          => __('Default color is #ffffff', 'wordflex-carousel' ),
        'id'            => 'carousel_content_color',
        'type'          => 'colorpicker',
        'default'       => '#ffffff',
    ) );
    // Content Align
    $cmb_carousel->add_group_field( $group_cmb_carousel, array(
        'name'          => __( 'Text alignment:', 'wordflex-carousel' ),
        'desc'          => __( 'Set the content text align.','wordflex-carousel'),
        'id'            => 'carousel_text_align',
        'type'          => 'select',
        'show_option_none' => true,
        'options'       => array(
            'left'    => __('Left', 'wordflex-carousel'),
            'text-center'  => __('Center', 'wordflex-carousel'),
            'text-right'   => __('Right', 'wordflex-carousel'),
        ),
        'default'       => 'text-center',
    ) );

    // Overlay
    $cmb_carousel->add_group_field( $group_cmb_carousel, array(
        'name'          => __('Background overlay', 'wordflex-carousel' ),
        'id'            => 'carousel_overlay',
        'type'          => 'radio_inline',
        'options'       => array(
            'yes'   => __( 'Yes', 'wordflex-carousel' ),
            'no'    => __( 'No', 'wordflex-carousel' ),
        ),
        'default'       => 'no',
        'classes'       => 'switch-field',
    ) );
    // Overlay color
    $cmb_carousel->add_group_field( $group_cmb_carousel, array(
        'name'          => __( 'Overlay color:', 'wordflex-carousel' ),
        'desc'          => __( 'Default color is rgba(0,0,0,0.35)', 'wordflex-carousel' ),
        'id'            => 'carousel_overlay_color',
        'type'          => 'colorpicker',
        'default'       => 'rgba(0,0,0,0.35)',
        'options'       => array(
            'alpha' => true,
        ),
        'attributes'    => array(
            'data-conditional-id'    => 'carousel_overlay',
            'data-conditional-value' => 'yes',
        ),
    ) );
    // Title animation
    $cmb_carousel->add_group_field( $group_cmb_carousel, array(
        'name'          => __( 'Heading animation:', 'wordflex-carousel' ),
        'desc'          => __( 'Choose the Heading animation effect', 'wordflex-carousel' ),
        'id'            => 'heading_animation',
        'type'          => 'animation',
        'groups'        => array( 'entrances' ), // By default all groups are enabled
        'preview'       => true,
        'default'       => 'fadeInDown',
    ) );
    // Text animation
    $cmb_carousel->add_group_field( $group_cmb_carousel, array(
        'name'          => __( 'Content animation:', 'wordflex-carousel' ),
        'desc'          => __( 'Choose the Content animation effect', 'wordflex-carousel' ),
        'id'            => 'content_animation',
        'type'          => 'animation',
        'groups'        => array( 'entrances' ),
        'preview'       => true,
        'default'       => 'fadeInDown',
    ) );
   
    // Button animation
    $cmb_carousel->add_group_field( $group_cmb_carousel, array(
        'name'          => __( 'Button animation:', 'wordflex-carousel' ),
        'desc'          => __( 'Choose the Button animation effect', 'wordflex-carousel' ),
        'id'            => 'btn_animation',
        'type'          => 'animation',
        'groups'        => array( 'entrances' ),
        'preview'       => true,
        'default'       => 'fadeInDown',
    ) );
}
add_action( 'cmb2_init', 'wordflex_carousel_metabox' );