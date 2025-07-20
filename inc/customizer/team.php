<?php

// Add team section
$wp_customize->add_section( 'eduverse_team_section', array(
	'title'             => esc_html__( 'Team','eduverse' ),
	'description'       => esc_html__( 'Team Section options.', 'eduverse' ),
	'panel'             => 'blogification_front_page_panel',
) );

// team content enable control and setting
$wp_customize->add_setting( 'team_section_enable', array(
	'sanitize_callback' => 'blogification_sanitize_switch_control',
	'default' => false,
) );

$wp_customize->add_control( new Eduverse_Switch_Control( $wp_customize, 'team_section_enable', array(
	'label'             => esc_html__( 'Team Section Enable', 'eduverse' ),
	'section'           => 'eduverse_team_section',
	'on_off_label' 		=> blogification_switch_options(),
) ) );

// team title setting and control
$wp_customize->add_setting( 'team_title', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'			=> __('Our Team', 'eduverse'),
) );

$wp_customize->add_control( 'team_title', array(
	'label'           	=> esc_html__( 'Title', 'eduverse' ),
	'section'        	=> 'eduverse_team_section',
	'active_callback' 	=> 'eduverse_is_team_section_enable',
	'type'				=> 'text',
) );


// team title setting and control
$wp_customize->add_setting( 'team_subtitle', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'			=> __('professional Team Members', 'eduverse'),
) );

$wp_customize->add_control( 'team_subtitle', array(
	'label'           	=> esc_html__( 'Subtitle', 'eduverse' ),
	'section'        	=> 'eduverse_team_section',
	'active_callback' 	=> 'eduverse_is_team_section_enable',
	'type'				=> 'text',
) );

for( $i = 1 ; $i <= 3; $i++ ){

	// team posts drop down chooser control and setting
	$wp_customize->add_setting( 'team_content_post_' . $i, array(
		'sanitize_callback' => 'blogification_sanitize_page',
	) );

	$wp_customize->add_control( new Eduverse_Dropdown_Chooser( $wp_customize, 'team_content_post_' . $i, array(
		'label'             => sprintf( esc_html__( 'Select Post %d', 'eduverse' ), $i ),
		'section'           => 'eduverse_team_section',
		'choices'			=> blogification_post_choices(),
		'active_callback'	=> 'eduverse_is_team_section_enable',
	) ) );

	// team custom content
	$wp_customize->add_setting( 'team_position_' . $i, array(
		'sanitize_callback' => 'wp_kses_post',
	) );

	$wp_customize->add_control( 'team_position_' . $i, array(
		'label'             => sprintf( esc_html__( 'Position %d', 'eduverse' ), $i ),
		'section'           => 'eduverse_team_section',
		'active_callback'	=> 'eduverse_is_team_section_enable',
	) );

	// team social
	$wp_customize->add_setting( 'team_social_' . $i, array(
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( new Eduverse_Multi_Input_Custom_Control( $wp_customize, 'team_social_' . $i, array(
		'label'             => esc_html__( 'Social ', 'eduverse' ).$i,
		'button_text'       => esc_html__( 'Add social.', 'eduverse' ),
		'section'           => 'eduverse_team_section',
		'active_callback' 	=> 'eduverse_is_team_section_enable',
	) ) );
	
}