<?php
/**
 * Introduction section
 *
 * This is the template for the content of about_us section
 *
 * @package Theme Palace
 * @subpackage Social Business
 * @since Social Business 1.0.0
 */
if ( ! function_exists( 'eduverse_add_about_section' ) ) :
    /**
    * Add about_us section
    *
    *@since Social Business 1.0.0
    */
    function eduverse_add_about_section() {
        
        // Check if client is enabled on frontpage
        if ( get_theme_mod( 'about_section_enable' ) == false ) {
            return false;
        }

        // Get about_us section details
        $section_details = array();
        $section_details = apply_filters( 'eduverse_filter_about_section_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }

        // Render about_us section now.
        eduverse_render_about_section( $section_details );
    }

endif;

if ( ! function_exists( 'eduverse_get_about_section_details' ) ) :
    /**
    * about_us section details.
    *
    * @since Social Business 1.0.0
    * @param array $input about_us section details.
    */
    function eduverse_get_about_section_details( $input ) {
        
        $content = array();
        $page_id = ! empty( get_theme_mod( 'about_content_post' ) ) ? get_theme_mod( 'about_content_post' ) : '';
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
                    $page_post['excerpt']   = blogification_trim_content( 75 );
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
// about_us section content details.
add_filter( 'eduverse_filter_about_section_details', 'eduverse_get_about_section_details' );


if ( ! function_exists( 'eduverse_render_about_section' ) ) :
  /**
   * Start about_us section
   *
   * @return string about_us content
   * @since Social Business 1.0.0
   *
   */
   function eduverse_render_about_section( $content_details = array() ) {

        if ( empty( $content_details ) ) {
            return;
        } ?>
        <div id="about-us" class="relative page-section same-background">
            <div class="wrapper">
                <?php foreach ( $content_details as $content ): ?>
                    <article class="has-post-thumbnail">
                        <div class="featured-image" style="background-image: url('<?php echo esc_url( $content['image'] ); ?>');">
                            <a href="<?php echo esc_url( $content['url'] ); ?>" class="post-thumbnail-link"></a>
                        </div><!-- .featured-image -->

                        <div class="entry-container">
                            <header class="entry-header">
                                <h2 class="entry-title"><?php echo esc_html( $content['title'] ) ?></h2>
                            </header>

                            <div class="entry-content">
                                <p><?php echo esc_html( $content['excerpt'] ); ?></p>
                            </div><!-- .entry-content -->

                            <div class="business-read-more">
                                <a href="<?php echo esc_url( $content['url'] ); ?>" class="btn"><?php echo esc_html( get_theme_mod( 'about_btn_label' ) ); ?></a>
                            </div><!-- .business-read-more -->
                        </div><!-- .entry-container -->
                    </article>
                <?php endforeach ?>      
            </div><!-- .wrapper -->
        </div><!-- #about-us -->
        
<?php    }
endif;