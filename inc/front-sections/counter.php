<?php

if ( ! function_exists( 'eduverse_add_counter_section' ) ) :

    function eduverse_add_counter_section() {
        
        if ( get_theme_mod( 'counter_section_enable' ) == false ) {
            return false;
        }

        eduverse_render_counter_section();
    }
endif;


if ( ! function_exists( 'eduverse_render_counter_section' ) ) :

   function eduverse_render_counter_section( ) {
     ?>

    <div id="counter-section" class="relative page-section" style="background-image: url('<?php echo esc_url( get_theme_mod( 'counter_image', '' ) ) ?>');">
        <div class="overlay"></div>
        <div class="wrapper">
            <div class="section-content col-4 clear">
                <?php for ($i=1; $i <=4 ; $i++) { ?>
                    <article>
                        <div class="counter-item">
                             <?php if ( !empty( get_theme_mod( 'counter_content_icon_'.$i, '' ) ) ): ?>
                                <div class="counter-icon">
                                    <i class="fa <?php echo esc_attr( get_theme_mod( 'counter_content_icon_'.$i ) ) ?>"></i>
                                </div><!-- .counter-icon -->
                            <?php endif ?>                            
                            <?php if ( !empty( get_theme_mod( 'counter_number_'.$i, '' ) ) ): ?>
                                <h3 class="counter-value"><?php echo esc_html( get_theme_mod( 'counter_number_'.$i ) ) ?></h3>
                            <?php endif ?> 
                            <?php if ( !empty( get_theme_mod( 'counter_title_'.$i, '' ) ) ): ?>
                                <h2 class="entry-title"><?php echo esc_html( get_theme_mod( 'counter_title_'.$i ) ) ?></h2>
                            <?php endif ?> 
                        </div><!-- .counter-item -->
                    </article>
                <?php } ?>           
            </div><!-- .section-content -->
        </div><!-- .wrapper -->
    </div>             
    <?php }
endif;