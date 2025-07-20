<?php

// Add counter section
$wp_customize->add_section( 'eduverse_counter_section', array(
	'title'             => esc_html__( 'Counter','eduverse' ),
	'description'       => esc_html__( 'Counter Section options.', 'eduverse' ),
	'panel'             => 'blogification_front_page_panel',
) );

// counter content enable control and setting
$wp_customize->add_setting( 'counter_section_enable', array(
	'sanitize_callback' => 'blogification_sanitize_switch_control',
	'default' => false,
) );

$wp_customize->add_control( new Eduverse_Switch_Control( $wp_customize, 'counter_section_enable', array(
	'label'             => esc_html__( 'Counter Section Enable', 'eduverse' ),
	'section'           => 'eduverse_counter_section',
	'on_off_label' 		=> blogification_switch_options(),
) ) );

$wp_customize->add_setting( 'counter_image', array(
	'sanitize_callback' => 'blogification_sanitize_image',
) );

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'counter_image',
		array(
		'label'       		=> esc_html__( 'Image', 'eduverse' ),
		'description' 		=> sprintf( esc_html__( 'Recommended size: %1$dpx x %2$dpx ', 'eduverse' ), 1350, 385 ),
		'section'     		=> 'eduverse_counter_section',
		'active_callback'	=> 'eduverse_is_counter_section_enable',
) ) );

	
for ( $i = 1; $i <= 4; $i++ ) :

	// counter note control and setting
	$wp_customize->add_setting( 'counter_content_icon_' . $i, array(
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( new Eduverse_Icon_Picker( $wp_customize, 'counter_content_icon_' . $i, array(
		'label'             => sprintf( esc_html__( 'Select Icon %d', 'eduverse' ), $i ),
		'section'           => 'eduverse_counter_section',
		'active_callback'	=> 'eduverse_is_counter_section_enable',
	) ) );

	// counter title setting and control
	$wp_customize->add_setting( 'counter_title_' . $i, array(
		'sanitize_callback' => 'sanitize_text_field',
		'default'			=> __( 'Counter Title', 'eduverse' )
	) );

	$wp_customize->add_control( 'counter_title_' . $i, array(
		'label'           	=> sprintf( esc_html__( 'Counter Title %d', 'eduverse' ), $i ),
		'section'        	=> 'eduverse_counter_section',
		'type'				=> 'text',
		'active_callback'	=> 'eduverse_is_counter_section_enable',
	) );

	// counter title setting and control
	$wp_customize->add_setting( 'counter_number_' . $i, array(
		'sanitize_callback' => 'sanitize_text_field',
		'default'			=> 100
	) );

	$wp_customize->add_control( 'counter_number_' . $i, array(
		'label'           	=> sprintf( esc_html__( 'Counter Count %d', 'eduverse' ), $i ),
		'section'        	=> 'eduverse_counter_section',
		'type'				=> 'text',
		'active_callback'	=> 'eduverse_is_counter_section_enable',
	) );

endfor;