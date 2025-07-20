<?php

if ( ! function_exists( 'eduverse_add_services_section' ) ) :

    function eduverse_add_services_section() {
    	
        if ( get_theme_mod( 'service_section_enable' ) == false ) {
            return false;
        }

        $section_details = array();
        $section_details = apply_filters( 'eduverse_filter_services_section_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }

        eduverse_render_services_section( $section_details );
    }
endif;

if ( ! function_exists( 'eduverse_get_services_section_details' ) ) :

    function eduverse_get_services_section_details( $input ) {
        	$content = array();
        	 $post_ids = array();

                for ( $i = 1; $i <= 3; $i++ ) {
                    if ( ! empty( get_theme_mod( 'service_content_post_'.$i ) ) )
                        $post_ids[] = get_theme_mod( 'service_content_post_'.$i );
                }
                $args = array(
                    'post_type'         => 'post',
                    'post__in'          => ( array ) $post_ids,
                    'posts_per_page'    => 3,
                    'orderby'           => 'post__in',
                    'ignore_sticky_posts'   => true,
                    ); 

            $query = new WP_Query( $args );
            if ( $query->have_posts() ) : 
                while ( $query->have_posts() ) : $query->the_post();
                    $page_post['id']        = get_the_id();
                    $page_post['title']     = get_the_title();
                    $page_post['url']       = get_the_permalink();
                    $page_post['excerpt']   = blogification_trim_content( 20 );

                    array_push( $content, $page_post );
                endwhile;
            endif;
            wp_reset_postdata();
            
        if ( ! empty( $content ) ) {
            $input = $content;
        }
        return $input;
    }
endif;

add_filter( 'eduverse_filter_services_section_details', 'eduverse_get_services_section_details' );


if ( ! function_exists( 'eduverse_render_services_section' ) ) :

   function eduverse_render_services_section( $content_details = array() ) {
        if ( empty( $content_details ) ) {
            return;
        } ?>
        <div id="our-services" class="relative page-section">
            <div class="wrapper">
                <div class="section-header">
                     <?php if( !empty( get_theme_mod( 'service_subtitle' ) ) ): ?>
                        <p class="business-section-subtitle"><?php echo esc_html( get_theme_mod( 'service_subtitle', __( 'This is our service', 'eduverse' ) ) ); ?></p>
                    <?php endif; ?>
                     <?php if( !empty( get_theme_mod( 'service_title' ) ) ): ?>
                        <h2 class="business-section-title"><?php echo esc_html( get_theme_mod( 'service_title', __( 'Our service', 'eduverse' ) ) ); ?></h2>
                    <?php endif; ?>
                </div><!-- .section-header -->

                <div class="section-content col-3 clear">
                    <?php $i =1; foreach ($content_details as $content ):
                        $icon    = !empty( get_theme_mod( 'service_content_icon_'.$i, '' ) ) ? get_theme_mod( 'service_content_icon_'.$i, '' ) : '';
                    ?>
                        <article>
                            <div class="service-item-wrapper">
                                <div class="icon-container">
                                    <a href="<?php echo esc_url( $content['url'] ); ?>">
                                        <i class="fa <?php echo esc_attr( $icon ) ; ?>"></i>
                                    </a>
                                </div><!-- .business-service-icon -->

                                <div class="entry-container">
                                    <header class="entry-header">
                                        <h2 class="entry-title"><a href="<?php echo esc_url( $content['url'] ); ?>"><?php echo esc_html( $content['title'] ); ?></a></h2>
                                    </header>

                                    <div class="entry-content">
                                        <p><?php echo esc_html( $content['excerpt'] ); ?></p>
                                    </div><!-- .entry-content -->
                                </div><!-- .entry-container -->
                            </div><!-- .business-service-item -->
                        </article>
                    <?php $i++; endforeach; ?>
                </div><!-- .section-content -->
            </div><!-- .wrapper -->
        </div><!-- #our-services -->
    <?php }
endif;