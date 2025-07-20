<?php

// Add team section
$wp_customize->add_section( 'eduverse_testimonial_section', array(
	'title'             => esc_html__( 'Testimoial','eduverse' ),
	'description'       => esc_html__( 'Testimoial Section options.', 'eduverse' ),
	'panel'             => 'blogification_front_page_panel',

) );

// team content enable control and setting
$wp_customize->add_setting( 'testimonial_section_enable', array(
	'sanitize_callback' => 'blogification_sanitize_switch_control',
	'default' => false,
) );

$wp_customize->add_control( new Eduverse_Switch_Control( $wp_customize, 'testimonial_section_enable', array(
	'label'             => esc_html__( 'Testimoial Section Enable', 'eduverse' ),
	'section'           => 'eduverse_testimonial_section',
	'on_off_label' 		=> blogification_switch_options(),
) ) );

// team title setting and control
$wp_customize->add_setting( 'testimonial_title', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'			=> __('Testimonial', 'eduverse'),
) );

$wp_customize->add_control( 'testimonial_title', array(
	'label'           	=> esc_html__( 'Title', 'eduverse' ),
	'section'        	=> 'eduverse_testimonial_section',
	'active_callback' 	=> 'eduverse_is_testimonial_section_enable',
	'type'				=> 'text',
) );

// team title setting and control
$wp_customize->add_setting( 'testimonial_subtitle', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'			=> __('What Client Says', 'eduverse'),
) );

$wp_customize->add_control( 'testimonial_subtitle', array(
	'label'           	=> esc_html__( 'Subtitle', 'eduverse' ),
	'section'        	=> 'eduverse_testimonial_section',
	'active_callback' 	=> 'eduverse_is_testimonial_section_enable',
	'type'				=> 'text',
) );

for( $i = 1 ; $i <= 4; $i++ ){

	// team posts drop down chooser control and setting
	$wp_customize->add_setting( 'testimonial_content_post_' . $i, array(
		'sanitize_callback' => 'blogification_sanitize_page',
	) );

	$wp_customize->add_control( new Eduverse_Dropdown_Chooser( $wp_customize, 'testimonial_content_post_' . $i, array(
		'label'             => sprintf( esc_html__( 'Select Post %d', 'eduverse' ), $i ),
		'section'           => 'eduverse_testimonial_section',
		'choices'			=> blogification_post_choices(),
		'active_callback'	=> 'eduverse_is_testimonial_section_enable',
	) ) );
}