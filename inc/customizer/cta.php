<?php

// Add About Us section
$wp_customize->add_section( 'eduverse_cta_section', array(
	'title'             => esc_html__( 'Cta','eduverse' ),
	'description'       => esc_html__( 'Cta Section options.', 'eduverse' ),
	'panel'             => 'blogification_front_page_panel',
) );

// Cta content enable control and setting
$wp_customize->add_setting( 'cta_section_enable', array(
	'sanitize_callback' => 'blogification_sanitize_switch_control',
	'default' => false,
) );

$wp_customize->add_control( new Eduverse_Switch_Control( $wp_customize, 'cta_section_enable', array(
	'label'             => esc_html__( 'Cta Section Enable', 'eduverse' ),
	'section'           => 'eduverse_cta_section',
	'on_off_label' 		=> blogification_switch_options(),
) ) );

// about pages drop down chooser control and setting
$wp_customize->add_setting( 'cta_content_post', array(
	'sanitize_callback' => 'blogification_sanitize_page',
) );

$wp_customize->add_control( new Eduverse_Dropdown_Chooser( $wp_customize, 'cta_content_post', array(
	'label'             => esc_html__( 'Select Post', 'eduverse' ), 
	'section'           => 'eduverse_cta_section',
	'choices'			=> blogification_post_choices(),
	'active_callback'	=> 'eduverse_is_cta_section_enable',
) ) );

$wp_customize->add_setting( 'cta_btn_label', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'			=> __('Explore More', 'eduverse'),
) );

$wp_customize->add_control( 'cta_btn_label', array(
	'label'           	=>  esc_html__( 'Button Label', 'eduverse' ),
	'section'        	=> 'eduverse_cta_section',
	'active_callback' 	=> 'eduverse_is_cta_section_enable',
	'type'				=> 'text',
) );
