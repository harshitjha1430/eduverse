<?php

$wp_customize->add_section( 'eduverse_service_section', array(
	'title'             => esc_html__( 'Service','eduverse' ),
	'description'       => esc_html__( 'Service Section options.', 'eduverse' ),
	'panel'             => 'blogification_front_page_panel',
) );

// slider content enable control and setting
$wp_customize->add_setting( 'service_section_enable', array(
	'sanitize_callback' => 'blogification_sanitize_switch_control',
	'default' => false,
) );

$wp_customize->add_control( new Eduverse_Switch_Control( $wp_customize, 'service_section_enable', array(
	'label'             => esc_html__( 'Service Section Enable', 'eduverse' ),
	'section'           => 'eduverse_service_section',
	'on_off_label' 		=> blogification_switch_options(),
) ) );

// // recent_product title setting and control
$wp_customize->add_setting( 'service_title', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'			=> __( 'Our Service', 'eduverse' ),
) );

$wp_customize->add_control( 'service_title', array(
	'label'           	=> esc_html__( 'Title', 'eduverse' ),
	'section'        	=> 'eduverse_service_section',
	'active_callback' 	=> 'eduverse_is_service_section_enable',
	'type'				=> 'text',
) );


// // recent_product title setting and control
$wp_customize->add_setting( 'service_subtitle', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'           	=> esc_html__( 'This is our service', 'eduverse' ),
) );

$wp_customize->add_control( 'service_subtitle', array(
	'label'           	=> esc_html__( 'Subtitle', 'eduverse' ),
	'section'        	=> 'eduverse_service_section',
	'active_callback' 	=> 'eduverse_is_service_section_enable',
	'type'				=> 'text',
) );

for ( $i = 1; $i <= 3; $i++ ) :

	$wp_customize->add_setting( 'service_content_icon_' . $i, array(
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( new Eduverse_Icon_Picker( $wp_customize, 'service_content_icon_' . $i, array(
		'label'             => sprintf( esc_html__( 'Select Icon %d', 'eduverse' ), $i ),
		'section'           => 'eduverse_service_section',
		'active_callback'	=> 'eduverse_is_service_section_enable',
	) ) );

	// gallery posts drop down chooser control and setting
	$wp_customize->add_setting( 'service_content_post_'.$i, array(
		'sanitize_callback' => 'blogification_sanitize_page',
	) );

	$wp_customize->add_control( new Eduverse_Dropdown_Chooser( $wp_customize, 'service_content_post_'.$i, array(
		'label'             => sprintf( esc_html__( 'Select Post %d', 'eduverse' ), $i ),
		'section'           => 'eduverse_service_section',
		'choices'			=> blogification_post_choices(),
		'active_callback'	=> 'eduverse_is_service_section_enable',
	) ) ); 

endfor;