<?php

if ( ! function_exists( 'eduverse_add_team_section' ) ) :

    function eduverse_add_team_section() {

        if ( get_theme_mod( 'team_section_enable' ) == false ) {
            return false;
        }

        $section_details = array();
        $section_details = apply_filters( 'eduverse_filter_team_section_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }

        eduverse_render_team_section( $section_details );
    }
endif;

if ( ! function_exists( 'eduverse_get_team_section_details' ) ) :

    function eduverse_get_team_section_details( $input ) {
               
        $content = array();
        $page_ids = array();

        for ( $i = 1; $i <= 3; $i++ ) {
            if ( ! empty( get_theme_mod( 'team_content_post_' . $i ) ) )
                $page_ids[] = get_theme_mod( 'team_content_post_' . $i );
        }

         $args = array(
            'post_type'         => 'post',
            'post__in'          => ( array ) $page_ids,
            'posts_per_page'    => 3,
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

add_filter( 'eduverse_filter_team_section_details', 'eduverse_get_team_section_details' );

if ( ! function_exists( 'eduverse_render_team_section' ) ) :

   function eduverse_render_team_section( $content_details = array() ) {

        if ( empty( $content_details ) ) {
            return;
        } ?>
        <div id="team-section" class="relative page-section">
            <div class="wrapper">
                <div class="section-header">
                    <?php if ( ! empty( get_theme_mod( 'team_subtitle', __( 'Professional Team Members', 'eduverse' ) ) ) ) : ?>
                        <p class="section-subtitle"><?php echo wp_kses_post( get_theme_mod( 'team_subtitle', __( 'Professional Team Members', 'eduverse' ) ) ); ?></p>
                    <?php endif; ?>
                    <?php if ( ! empty( get_theme_mod( 'team_title', __( 'Our Team', 'eduverse' ) ) ) ) : ?>
                        <h2 class="section-title"><?php echo esc_html( get_theme_mod( 'team_title', __( 'Our Team', 'eduverse' ) ) ); ?></h2>
                    <?php endif; ?>
                </div>

                <div class="section-content col-3 clear">
                    <?php 
                    $i = 1;
                    foreach ( $content_details as $content ) : ?>
                        <article>
                            <div class="team-item-wrapper">
                                <div class="featured-image">
                                    <a href="<?php echo esc_url( $content['url'] ); ?>"><img src="<?php echo esc_url( $content['image'] ); ?>"></a>
                                </div>

                                <div class="entry-container">
                                    <header class="entry-header">
                                        <?php if ( ! empty( $content['title'] ) ) : ?>
                                            <h2 class="entry-title"><a href="<?php echo esc_url( $content['url'] ); ?>"><?php echo esc_html( $content['title'] ); ?></a></h2>
                                        <?php endif; ?>
                                        <span class="team-position"><?php echo esc_html( get_theme_mod( 'team_position_'.$i, __( 'Position', 'eduverse' ) ) ); ?></span>
                                    </header>

                                    <div class="social-icons">
                                        <ul>
                                            <?php 
                                            $team_socials = ! empty( get_theme_mod( 'team_social_'.$i ) ) ? explode( '|', get_theme_mod( 'team_social_'.$i ) ) : array(); 

                                            foreach ( $team_socials as $team_social ) : ?>
                                                <li>
                                                    <a href="<?php echo esc_url( $team_social ); ?>"><?php echo blogification_return_social_icon( $team_social ); ?></a>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </article>
                    <?php 
                    $i++;
                    endforeach; ?>
                </div>
            </div>
        </div>
    <?php }
endif;