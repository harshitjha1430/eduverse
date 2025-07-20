<?php

	do_action( 'blogification_doctype' );

?>
<head>
<?php

	do_action( 'blogification_before_wp_head' );

	wp_head(); 
?>
</head>

<body <?php body_class(); ?>>

<?php 

    do_action( 'wp_body_open' ); 

	do_action( 'blogification_page_start_action' ); 

	do_action( 'blogification_header_action' );

	// do_action( 'blogification_content_start_action' );

	do_action( 'blogification_header_image_action' );

	if ( blogification_is_frontpage() ) {

    	$options = blogification_get_theme_options();

    	$sorted = array( 'slider', 'about', 'services', 'counter', 'team', 'cta', 'gallery', 'testimonial', 'latest_blog' );
	
		foreach ( $sorted as $section ) {			
			add_action( 'eduverse_primary_content', 'eduverse_add_'. $section .'_section' );
		}

		do_action( 'eduverse_primary_content' );
	}