<?php
/**
 * Introduction section
 *
 * This is the template for the content of cta_us section
 *
 * @package Theme Palace
 * @subpackage Social Business
 * @since Social Business 1.0.0
 */
if ( ! function_exists( 'eduverse_add_cta_section' ) ) :
    /**
    * Add cta_us section
    *
    *@since Social Business 1.0.0
    */
    function eduverse_add_cta_section() {
        
        // Check if client is enabled on frontpage
        if ( get_theme_mod( 'cta_section_enable' ) == false ) {
            return false;
        }

        // Get cta_us section details
        $section_details = array();
        $section_details = apply_filters( 'eduverse_filter_cta_section_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }

        // Render cta_us section now.
        eduverse_render_cta_section( $section_details );
    }

endif;

if ( ! function_exists( 'eduverse_get_cta_section_details' ) ) :
    /**
    * cta_us section details.
    *
    * @since Social Business 1.0.0
    * @param array $input cta_us section details.
    */
    function eduverse_get_cta_section_details( $input ) {
        
        $content = array();
        $page_id = ! empty( get_theme_mod( 'cta_content_post' ) ) ? get_theme_mod( 'cta_content_post' ) : '';
                $args = array(
                    'post_type'         => 'post',
                    'page_id'           => $page_id,
                    'posts_per_page'    => 1,
                    );

            // Run The Loop.
            $query = new WP_Query( $args );
            if ( $query->have_posts() ) : 
                while ( $query->have_posts() ) : $query->the_post();
                    $page_post['id']        = get_the_id();
                    $page_post['title']     = get_the_title();
                    $page_post['url']       = get_the_permalink();
                    $page_post['excerpt']   = blogification_trim_content( 25 );
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
// cta_us section content details.
add_filter( 'eduverse_filter_cta_section_details', 'eduverse_get_cta_section_details' );


if ( ! function_exists( 'eduverse_render_cta_section' ) ) :
  /**
   * Start cta_us section
   *
   * @return string cta_us content
   * @since Social Business 1.0.0
   *
   */
   function eduverse_render_cta_section( $content_details = array() ) {

        if ( empty( $content_details ) ) {
            return;
        } ?>
        <?php foreach ( $content_details as $content ): ?>
            <div id="call-to-action" class="relative page-section" style="background-image: url('<?php echo esc_url( $content['image'] ); ?>');">
                <div class="overlay"></div>
                <div class="wrapper">
                    <header class="entry-header">
                        <h2 class="entry-title"><?php echo esc_html( $content['title'] ) ?></h2>
                    </header>

                    <div class="entry-content">
                        <p><?php echo esc_html( $content['excerpt'] ); ?></p>
                    </div><!-- .entry-content -->

                    <div class="read-more">
                        <a href="<?php echo esc_url( $content['url'] ); ?>" class="btn"><?php echo esc_html( get_theme_mod( 'cta_btn_label' ) ); ?></a>
                    </div>
                </div><!-- .wrapper -->
            </div>
        <?php endforeach ?>
        
<?php    }
endif;