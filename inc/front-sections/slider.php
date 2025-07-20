<?php
/**
 * slider section
 *
 * This is the template for the content of slider section
 *
 * @package Theme Palace
 * @subpackage Social Business
 * @since Social Business 1.0.0
 */
if ( ! function_exists( 'eduverse_add_slider_section' ) ) :
    /**
    * Add slider section
    *
    *@since Social Business 1.0.0
    */
    function eduverse_add_slider_section() {
       
       // Check if client is enabled on frontpage
         if ( get_theme_mod( 'slider_section_enable' ) == false ) {
            return false;
        }

        // Get slider section details
        $section_details = array();
        $section_details = apply_filters( 'eduverse_filter_slider_section_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }

        // Render slider section now.
        eduverse_render_slider_section( $section_details );
    }
endif;

if ( ! function_exists( 'eduverse_get_slider_section_details' ) ) :
    /**
    * slider section details.
    *
    * @since Social Business 1.0.0
    * @param array $input slider section details.
    */
    function eduverse_get_slider_section_details( $input ) {
              
        $content = array();
        $post_ids = array();

                for ( $i = 1; $i <= 3; $i++ ) {
                    if ( ! empty( get_theme_mod( 'slider_content_post_'.$i ) ) )
                        $post_ids[] = get_theme_mod( 'slider_content_post_'.$i );
                }
                $args = array(
                    'post_type'         => 'post',
                    'post__in'          => ( array ) $post_ids,
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
                    $page_post['excerpt']   = blogification_trim_content( 40 );
                    $page_post['image']     = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_id(), 'full' ) : get_template_directory_uri() . '/assets/uploads/no-featured-image-590x650.jpg';

                    // Push to the main array.
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
// slider section content details.
add_filter( 'eduverse_filter_slider_section_details', 'eduverse_get_slider_section_details' );


if ( ! function_exists( 'eduverse_render_slider_section' ) ) :
  /**
   * Start slider section
   *
   * @return string slider content
   * @since Social Business 1.0.0
   *
   */
   function eduverse_render_slider_section( $content_details = array() ) {

        if ( empty( $content_details ) ) {
            return;
        } ?>
        <div id="featured-slider-section" class="slider-section">
            <div class="featured-slider" data-slick='{"slidesToShow": 1, "slidesToScroll": 1, "infinite": true, "speed": 1000, "dots": true, "arrows":false, "autoplay": false, "draggable": true, "fade": true, "adaptiveHeight": true }'>
                 <?php foreach ( $content_details as $content ): ?>
                    <article style="background-image:url('<?php echo esc_url( $content['image'] ); ?>');">
                        <div class="overlay"></div>
                        <div class="wrapper">
                        <div class="featured-content-wrapper">
                            <div class="entry-container">
                                <header class="entry-header">                                    
                                    <h2 class="entry-title"><a href="<?php echo esc_url( $content['url'] ); ?>"><?php echo esc_html( $content['title'] ); ?></a></h2>
                                </header>

                                <div class="entry-content">
                                    <p><?php echo esc_html( $content['excerpt'] ); ?></p>
                                </div><!-- .entry-content -->

                                <div class="entry-button">
                                    <div class="read-more">
                                        <a href="<?php echo esc_url( $content['url'] ); ?>" class="btn"><?php echo esc_html( get_theme_mod( 'slider_btn_label', __( 'Explore More', 'eduverse' ) ) ) ?></a>
                                    </div><!-- .read-more -->
                                    <?php if (!empty( get_theme_mod( 'slider_alt_btn_url', '' ) ) ): ?>
                                        <div class="read-more discover-now">
                                            <a href="<?php echo esc_url( get_theme_mod( 'slider_alt_btn_url' ) ) ?>" class="btn" tabindex="0"><?php echo esc_html( get_theme_mod( 'slider_alt_btn_label', __( 'Apply Now', 'eduverse' ) ) ) ?></a>
                                        </div><!-- .read-more -->
                                    <?php endif ?>
                                    
                                </div>
                            </div><!-- .entry-container -->
                        </div><!-- .featured-content-wrapper -->
                    </article>
                <?php endforeach ?>         
            </div><!-- .featured-slider -->
        </div><!-- #featured-slider-section -->
<?php    }
endif;