<?php

function eduverse_customize_register( $wp_customize ) {

class Eduverse_Switch_Control extends WP_Customize_Control{

		public $type = 'switch';

		public $on_off_label = array();

		public function __construct( $manager, $id, $args = array() ){
	        $this->on_off_label = $args['on_off_label'];
	        parent::__construct( $manager, $id, $args );
	    }

		public function render_content(){
	    ?>
		    <span class="customize-control-title">
				<?php echo esc_html( $this->label ); ?>
			</span>

			<?php if( $this->description ){ ?>
				<span class="description customize-control-description">
				<?php echo wp_kses_post( $this->description ); ?>
				</span>
			<?php } ?>

			<?php
				$switch_class = ( $this->value() == 'true' ) ? 'switch-on' : '';
				$on_off_label = $this->on_off_label;
			?>
			<div class="onoffswitch <?php echo esc_attr( $switch_class ); ?>">
				<div class="onoffswitch-inner">
					<div class="onoffswitch-active">
						<div class="onoffswitch-switch"><?php echo esc_html( $on_off_label['on'] ) ?></div>
					</div>

					<div class="onoffswitch-inactive">
						<div class="onoffswitch-switch"><?php echo esc_html( $on_off_label['off'] ) ?></div>
					</div>
				</div>	
			</div>
			<input <?php $this->link(); ?> type="hidden" value="<?php echo esc_attr( $this->value() ); ?>"/>
			<?php
	    }
	}

	class Eduverse_Dropdown_Chooser extends WP_Customize_Control{

		public $type = 'dropdown_chooser';

		public function render_content(){
			if ( empty( $this->choices ) )
	                return;
			?>
	            <label>
	                <span class="customize-control-title">
	                	<?php echo esc_html( $this->label ); ?>
	                </span>

	                <?php if($this->description){ ?>
		            <span class="description customize-control-description">
		            	<?php echo wp_kses_post($this->description); ?>
		            </span>
		            <?php } ?>

	                <select class="social-business-chosen-select" <?php $this->link(); ?>>
	                    <?php
	                    foreach ( $this->choices as $value => $label )
	                        echo '<option value="' . esc_attr( $value ) . '"' . selected( $this->value(), $value, false ) . '>' . esc_html( $label ) . '</option>';
	                    ?>
	                </select>
	            </label>
			<?php
		}
	}

	class Eduverse_Icon_Picker extends WP_Customize_Control{
		public $type = 'icon-picker';


		public function render_content(){
			$id = uniqid();
			?>
	            <label>
	                <span class="customize-control-title">
	                	<?php echo esc_html( $this->label ); ?>
	                </span>

	                <?php if($this->description){ ?>
		            <span class="description customize-control-description">
		            	<?php echo wp_kses_post($this->description); ?>
		            </span>
		            <?php } ?>

	                <input id="blogification-<?php echo esc_attr( $id ); ?>" placeholder="<?php esc_attr_e( 'Click here to select icon', 'eduverse' ); ?>" class="blogification-icon-picker input" <?php $this->link(); ?> value="<?php echo esc_attr( $this->value() ); ?>" />
	            </label>
			<?php
		}
	}

	class Eduverse_Multi_Input_Custom_Control extends WP_Customize_Control {

		public $type = 'multi-input';

		public $button_text;


		public function render_content() {
			?>
			<label class="customize_multi_input">
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<p><?php echo esc_html( $this->description ); ?></p>
				<input type="hidden" id="<?php echo esc_attr( $this->id ); ?>" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $this->value() ); ?>" class="customize_multi_value_field" <?php $this->link(); ?> />
				<div class="customize_multi_fields">
					<div class="set">
						<input type="text" value="" class="customize_multi_single_field"/>
						<span class="customize_multi_remove_field"><span class="dashicons dashicons-no-alt"></span></span>
					</div>
				</div>
				<a href="#" class="button button-primary customize_multi_add_field"><?php echo esc_html( $this->button_text ); ?></a>
			</label>
			<?php
		}
	}

	$wp_customize->remove_section( 'colors' );

	// //customizer section
	require get_theme_file_path() . '/inc/customizer/slider.php';

	require get_theme_file_path() . '/inc/customizer/about.php';

	require get_theme_file_path() . '/inc/customizer/service.php';

	require get_theme_file_path() . '/inc/customizer/counter.php';

	require get_theme_file_path() . '/inc/customizer/team.php';

	require get_theme_file_path() . '/inc/customizer/cta.php';

	require get_theme_file_path() . '/inc/customizer/gallery.php';

	require get_theme_file_path() . '/inc/customizer/testimonial.php';

}
add_action( 'customize_register', 'eduverse_customize_register' );


/*=============Active Callback=====================*/

function eduverse_is_slider_section_enable( $control ) {
	return ( $control->manager->get_setting( 'slider_section_enable' )->value() );
}

function eduverse_is_service_section_enable( $control ) {
	return ( $control->manager->get_setting( 'service_section_enable' )->value() );
}

function eduverse_is_about_section_enable( $control ) {
	return ( $control->manager->get_setting( 'about_section_enable' )->value() );
}


function eduverse_is_counter_section_enable( $control ) {
	return ( $control->manager->get_setting( 'counter_section_enable' )->value() );
}

function eduverse_is_team_section_enable( $control ) {
	return ( $control->manager->get_setting( 'team_section_enable' )->value() );
}

function eduverse_is_cta_section_enable( $control ) {
	return ( $control->manager->get_setting( 'cta_section_enable' )->value() );
}

function eduverse_is_gallery_section_enable( $control ) {
	return ( $control->manager->get_setting( 'gallery_section_enable' )->value() );
}

function eduverse_is_testimonial_section_enable( $control ) {
	return ( $control->manager->get_setting( 'testimonial_section_enable' )->value() );
}

/*=============partial refresh=====================*/

if ( ! function_exists( 'eduverse_slider_btn_label_partial' ) ) :

    function eduverse_slider_btn_label_partial() {
        return esc_html( get_theme_mod( 'slider_btn_label' ) );
    }
endif;

if ( ! function_exists( 'eduverse_service_title_partial' ) ) :

    function eduverse_service_title_partial() {
        return esc_html( get_theme_mod( 'service_title' ) );
    }
endif;

if ( ! function_exists( 'eduverse_service_subtitle_partial' ) ) :

    function eduverse_service_subtitle_partial() {
        return esc_html( get_theme_mod( 'service_subtitle' ) );
    }
endif;

if ( ! function_exists( 'sociable_about_btn_label_partial' ) ) :

    function sociable_about_btn_label_partial() {
        return esc_html( get_theme_mod( 'about_btn_label' ) );
    }
endif;

if ( ! function_exists( 'sociable_team_title_partial' ) ) :

    function sociable_team_title_partial() {
        return esc_html( get_theme_mod( 'team_title' ) );
    }
endif;

if ( ! function_exists( 'sociable_team_subtitle_partial' ) ) :

    function sociable_team_subtitle_partial() {
        return esc_html( get_theme_mod( 'team_subtitle' ) );
    }
endif;