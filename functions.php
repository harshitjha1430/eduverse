<?php

if ( ! function_exists( 'eduverse_setup' ) ) :
	function eduverse_setup() {
		load_theme_textdomain( 'eduverse' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'register_block_pattern' );
		add_theme_support( 'register_block_style' );
		add_theme_support( "responsive-embeds" );
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 600, 450, true );
		$GLOBALS['content_width'] = 525;

		register_nav_menus( array(
			'primary' => esc_html__( 'Primary', 'eduverse' ),
			'social' => esc_html__( 'Social', 'eduverse' ),
		) );

		add_theme_support( 'html5', array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		add_theme_support( 'customize-selective-refresh-widgets' );
		add_theme_support( 'align-wide' );
		add_theme_support( 'editor-font-sizes', array(
			array('name' => esc_html__( 'small', 'eduverse' ), 'shortName' => esc_html__( 'S', 'eduverse' ), 'size' => 12, 'slug' => 'small'),
			array('name' => esc_html__( 'regular', 'eduverse' ), 'shortName' => esc_html__( 'M', 'eduverse' ), 'size' => 16, 'slug' => 'regular'),
			array('name' => esc_html__( 'larger', 'eduverse' ), 'shortName' => esc_html__( 'L', 'eduverse' ), 'size' => 36, 'slug' => 'larger'),
			array('name' => esc_html__( 'huge', 'eduverse' ), 'shortName' => esc_html__( 'XL', 'eduverse' ), 'size' => 48, 'slug' => 'huge')
		));

		add_theme_support('editor-styles');
		add_theme_support( 'wp-block-styles' );
	}
endif;
add_action( 'after_setup_theme', 'eduverse_setup' );

if ( ! function_exists( 'eduverse_enqueue_styles' ) ) :
	function eduverse_enqueue_styles() {
		wp_enqueue_style( 'slick', get_template_directory_uri() . '/assets/css/slick.css' );
		wp_enqueue_style( 'slick-theme', get_template_directory_uri() . '/assets/css/slick-theme.css' );
		wp_enqueue_style( 'eduverse-style-parent', get_template_directory_uri() . '/style.css' );
		wp_enqueue_style( 'eduverse-style', get_stylesheet_directory_uri() . '/style.css', array( 'eduverse-style-parent' ), '1.0.0' );
		wp_enqueue_script( 'slick', get_template_directory_uri() . '/assets/js/slick.min.js','', '1.6.0', true );
		wp_enqueue_script( 'eduverse-custom', get_theme_file_uri() . '/custom.js', array(), '1.0', true );
	}
endif;
add_action( 'wp_enqueue_scripts', 'eduverse_enqueue_styles', 99 );

function eduverse_customize_control_style() {
	wp_enqueue_style( 'eduverse-customize-controls', get_theme_file_uri() . '/customizer-control.css' );
}
add_action( 'customize_controls_enqueue_scripts', 'eduverse_customize_control_style' );

function eduverse_body_classes( $classes ) {
	$classes[] = 'second-design';
	return $classes;
}
add_filter( 'body_class', 'eduverse_body_classes' );

remove_action( 'blogification_content_start_action', 'blogification_content_start', 10 );

require get_theme_file_path() . '/inc/customizer.php';
require get_theme_file_path() . '/inc/front-sections/slider.php';
require get_theme_file_path() . '/inc/front-sections/about.php';
require get_theme_file_path() . '/inc/front-sections/service.php';
require get_theme_file_path() . '/inc/front-sections/counter.php';
require get_theme_file_path() . '/inc/front-sections/team.php';
require get_theme_file_path() . '/inc/front-sections/cta.php';
require get_theme_file_path() . '/inc/front-sections/gallery.php';
require get_theme_file_path() . '/inc/front-sections/testimonial.php';
require get_theme_file_path() . '/inc/front-sections/latest-blog.php';
