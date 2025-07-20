<?php

// Add slider section
$wp_customize->add_section( 'eduverse_slider_section', array(
	'title'             => esc_html__( 'Slider','eduverse' ),
	'description'       => esc_html__( 'Slider Section options.', 'eduverse' ),
	'panel'             => 'blogification_front_page_panel',
) );

// slider content enable control and setting
$wp_customize->add_setting( 'slider_section_enable', array(
	'sanitize_callback' => 'blogification_sanitize_switch_control',
	'default' => false,
) );

$wp_customize->add_control( new Eduverse_Switch_Control( $wp_customize, 'slider_section_enable', array(
	'label'             => esc_html__( 'slider Section Enable', 'eduverse' ),
	'section'           => 'eduverse_slider_section',
	'on_off_label' 		=> blogification_switch_options(),
) ) );

for ( $i = 1; $i <= 3; $i++ ) :
		
	// gallery posts drop down chooser control and setting
	$wp_customize->add_setting( 'slider_content_post_'.$i, array(
		'sanitize_callback' => 'blogification_sanitize_page',
	) );

	$wp_customize->add_control( new Eduverse_Dropdown_Chooser( $wp_customize, 'slider_content_post_'.$i, array(
		'label'             => sprintf( esc_html__( 'Select Post %d', 'eduverse' ), $i ),
		'section'           => 'eduverse_slider_section',
		'choices'			=> blogification_post_choices(),
		'active_callback'	=> 'eduverse_is_slider_section_enable',
	) ) ); 

endfor;

$wp_customize->add_setting( 'slider_btn_label', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'			=> __('Explore More', 'eduverse'),
) );

$wp_customize->add_control( 'slider_btn_label', array(
	'label'           	=>  esc_html__( 'Button Label', 'eduverse' ),
	'section'        	=> 'eduverse_slider_section',
	'active_callback' 	=> 'eduverse_is_slider_section_enable',
	'type'				=> 'text',
) );

$wp_customize->add_setting( 'slider_alt_btn_label', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'			=> __('Apply Now', 'eduverse'),
) );

$wp_customize->add_control( 'slider_alt_btn_label', array(
	'label'           	=>  esc_html__( 'Alt Button Label', 'eduverse' ),
	'section'        	=> 'eduverse_slider_section',
	'active_callback' 	=> 'eduverse_is_slider_section_enable',
	'type'				=> 'text',
) );

$wp_customize->add_setting( 'slider_alt_btn_url', array(
	'sanitize_callback' => 'sanitize_url',
) );

$wp_customize->add_control( 'slider_alt_btn_url', array(
	'label'           	=>  esc_html__( 'Alt Button Url', 'eduverse' ),
	'section'        	=> 'eduverse_slider_section',
	'active_callback' 	=> 'eduverse_is_slider_section_enable',
	'type'				=> 'url',
) );

