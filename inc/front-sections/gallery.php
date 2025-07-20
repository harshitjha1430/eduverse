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
if ( ! function_exists( 'eduverse_add_gallery_section' ) ) :
    /**
    * Add slider section
    *
    *@since Social Business 1.0.0
    */
    function eduverse_add_gallery_section() {
       
       // Check if client is enabled on frontpage
         if ( get_theme_mod( 'gallery_section_enable' ) == false ) {
            return false;
        }

        // Get slider section details
        $section_details = array();
        $section_details = apply_filters( 'eduverse_filter_gallery_section_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }

        // Render slider section now.
        eduverse_render_gallery_section( $section_details );
    }
endif;

if ( ! function_exists( 'eduverse_get_gallery_section_details' ) ) :
    /**
    * slider section details.
    *
    * @since Social Business 1.0.0
    * @param array $input slider section details.
    */
    function eduverse_get_gallery_section_details( $input ) {
              
        $content = array();
        $post_ids = array();

                for ( $i = 1; $i <= 6; $i++ ) {
                    if ( ! empty( get_theme_mod( 'gallery_content_post_'.$i ) ) )
                        $post_ids[] = get_theme_mod( 'gallery_content_post_'.$i );
                }
                $args = array(
                    'post_type'         => 'post',
                    'post__in'          => ( array ) $post_ids,
                    'posts_per_page'    => 6,
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
add_filter( 'eduverse_filter_gallery_section_details', 'eduverse_get_gallery_section_details' );


if ( ! function_exists( 'eduverse_render_gallery_section' ) ) :
  /**
   * Start slider section
   *
   * @return string slider content
   * @since Social Business 1.0.0
   *
   */
   function eduverse_render_gallery_section( $content_details = array() ) {

        if ( empty( $content_details ) ) {
            return;
        } ?>

        <div id="gallery-section" class="relative page-section">
            <div class="wrapper">
                <div class="section-header">
                    <?php if ( ! empty( get_theme_mod( 'gallery_section_subtitle', __( 'Our Gallery', 'eduverse' ) ) ) ) : ?>
                        <p class="section-subtitle"><?php echo wp_kses_post( get_theme_mod( 'gallery_section_subtitle', __( 'Our Gallery', 'eduverse' ) ) ); ?></p>
                    <?php endif; ?>
                    <?php if ( ! empty( get_theme_mod( 'gallery_section_title', __( 'Our Gallery Section', 'eduverse' ) ) ) ) : ?>
                        <h2 class="section-title"><?php echo esc_html( get_theme_mod( 'gallery_section_title', __( 'Our Gallery Section', 'eduverse' ) ) ); ?></h2>
                    <?php endif; ?>
                </div><!-- .section-header -->

                <div class="section-content col-3 clear">
                    <?php foreach ( $content_details as $content ): ?>
                        <article>                        
                            <div class="featured-image" style="background-image: url('<?php echo esc_url( $content['image'] ); ?>');">
                                <header class="entry-header">
                                    <h2 class="entry-title"><a href="<?php echo esc_url( $content['url'] ); ?>"><?php echo esc_html( $content['title'] ); ?></a></h2>
                                </header>
                            </div><!-- .featured-image -->
                        </article>
                    <?php endforeach ?>     
                </div><!-- .col-3 -->
            </div><!-- .wrapper -->
        </div>
<?php    }
endif;