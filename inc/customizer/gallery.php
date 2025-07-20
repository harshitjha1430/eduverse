<?php

// Add gallery section
$wp_customize->add_section( 'blogification_gallery_section', array(
	'title'             => esc_html__( 'Gallery','eduverse' ),
	'description'       => esc_html__( 'Gallery Section options.', 'eduverse' ),
	'panel'             => 'blogification_front_page_panel',
) );

// gallery content enable control and setting
$wp_customize->add_setting( 'gallery_section_enable', array(
	'sanitize_callback' => 'blogification_sanitize_switch_control',
	'default' => false,
) );

$wp_customize->add_control( new Eduverse_Switch_Control( $wp_customize, 'gallery_section_enable', array(
	'label'             => esc_html__( 'Gallery Section Enable', 'eduverse' ),
	'section'           => 'blogification_gallery_section',
	'on_off_label' 		=> blogification_switch_options(),
) ) );

$wp_customize->add_setting( 'gallery_section_title', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'			=> __('Our Gallery Section', 'eduverse'),
) );

$wp_customize->add_control( 'gallery_section_title', array(
	'label'           	=>  esc_html__( 'Section Title', 'eduverse' ),
	'section'        	=> 'blogification_gallery_section',
	'active_callback' 	=> 'eduverse_is_gallery_section_enable',
	'type'				=> 'text',
) );


$wp_customize->add_setting( 'gallery_section_subtitle', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'			=> __('Our Gallery', 'eduverse'),
) );

$wp_customize->add_control( 'gallery_section_subtitle', array(
	'label'           	=>  esc_html__( 'Section Subtitle', 'eduverse' ),
	'section'        	=> 'blogification_gallery_section',
	'active_callback' 	=> 'eduverse_is_gallery_section_enable',
	'type'				=> 'text',
) );

for ( $i = 1; $i <= 6; $i++ ) :
		
	// gallery posts drop down chooser control and setting
	$wp_customize->add_setting( 'gallery_content_post_'.$i, array(
		'sanitize_callback' => 'blogification_sanitize_page',
	) );

	$wp_customize->add_control( new Eduverse_Dropdown_Chooser( $wp_customize, 'gallery_content_post_'.$i, array(
		'label'             => sprintf( esc_html__( 'Select Post %d', 'eduverse' ), $i ),
		'section'           => 'blogification_gallery_section',
		'choices'			=> blogification_post_choices(),
		'active_callback'	=> 'eduverse_is_gallery_section_enable',
	) ) ); 

endfor;

