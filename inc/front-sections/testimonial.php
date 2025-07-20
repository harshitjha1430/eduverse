<?php

if ( ! function_exists( 'eduverse_add_testimonial_section' ) ) :

    function eduverse_add_testimonial_section() {

        if ( get_theme_mod( 'testimonial_section_enable' ) == false ) {
            return false;
        }

        $section_details = array();
        $section_details = apply_filters( 'eduverse_filter_testimonial_section_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }

        eduverse_render_testimonial_section( $section_details );
    }
endif;

if ( ! function_exists( 'eduverse_get_testimonial_section_details' ) ) :

    function eduverse_get_testimonial_section_details( $input ) {
               
        $content = array();
        $page_ids = array();

        for ( $i = 1; $i <= 4; $i++ ) {
            if ( ! empty( get_theme_mod( 'testimonial_content_post_' . $i ) ) )
                $page_ids[] = get_theme_mod( 'testimonial_content_post_' . $i );
        }

         $args = array(
            'post_type'         => 'post',
            'post__in'          => ( array ) $page_ids,
            'posts_per_page'    => 4,
            'orderby'           => 'post__in',
            'ignore_sticky_posts'   => true,
            );  

        // Run The Loop.
        $query = new WP_Query( $args );
        if ( $query->have_posts() ) : 
            while ( $query->have_posts() ) : $query->the_post();
                $page_post['id']        = get_the_id();
                $page_post['title']     = get_the_title();
                $page_post['url']       = get_the_permalink();
                $page_post['excerpt']   = blogification_trim_content( 20 );
                $page_post['image']     = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_id(), 'full' ) : get_template_directory_uri() . '/assets/uploads/no-featured-image-590x650.jpg';


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

add_filter( 'eduverse_filter_testimonial_section_details', 'eduverse_get_testimonial_section_details' );

if ( ! function_exists( 'eduverse_render_testimonial_section' ) ) :

   function eduverse_render_testimonial_section( $content_details = array() ) {

        if ( empty( $content_details ) ) {
            return;
        } ?>

        <div id="testimonial-section" class="relative page-section" style="padding-top: 0;">
            <div class="wrapper">
                <div class="section-header">
                    <?php if ( ! empty( get_theme_mod( 'testimonial_subtitle', __( 'Professional Team Members', 'eduverse' ) ) ) ) : ?>
                        <p class="section-subtitle"><?php echo wp_kses_post( get_theme_mod( 'testimonial_subtitle', __( 'Professional Team Members', 'eduverse' ) ) ); ?></p>
                    <?php endif; ?>
                    <?php if ( ! empty( get_theme_mod( 'testimonial_title', __( 'Our Team', 'eduverse' ) ) ) ) : ?>
                        <h2 class="section-title"><?php echo esc_html( get_theme_mod( 'testimonial_title', __( 'Our Team', 'eduverse' ) ) ); ?></h2>
                    <?php endif; ?>
                </div><!-- .section-header -->

                <div class="testimonial-slider" data-slick='{"slidesToShow": 3, "slidesToScroll": 1, "infinite": true, "speed": 1000, "dots": true, "arrows":false, "autoplay": false, "draggable": true, "fade": false }'>
                    <?php 
                    $i = 1;
                    foreach ( $content_details as $content ) : ?>
                        <article>
                            <div class="testimonial-item">
                                <div class="featured-image">
                                    <a href="#"><img src="<?php echo esc_url( $content['image'] ); ?>" alt="testimonial"></a>
                                </div><!-- .featured-image -->

                                <div class="entry-container">
                                    <header class="entry-header">
                                        <?php if ( ! empty( $content['title'] ) ) : ?>
                                            <h2 class="entry-title"><a href="<?php echo esc_url( $content['url'] ); ?>"><?php echo esc_html( $content['title'] ); ?></a></h2>
                                        <?php endif; ?>
                                    </header>

                                    <div class="entry-content">
                                        <p><?php echo esc_html( $content['excerpt'] ); ?></p>
                                    </div><!-- .entry-content -->
                                </div><!-- .entry-container -->
                            </div><!-- .testimonial-item -->
                        </article>
                    <?php 
                    $i++;
                    endforeach; ?>
                </div><!-- .section-content -->
            </div><!-- .wrapper -->
        </div><!-- #testimonial-section -->
    <?php }
endif;