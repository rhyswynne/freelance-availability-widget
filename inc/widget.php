<?php

// Check to see required Widget API functions are defined...

if ( !function_exists( 'register_sidebar_widget' ) || !function_exists( 'register_widget_control' ) )

  return; // ...and if not, exit gracefully from the script.



// This function prints the sidebar widget--the cool stuff!
class Freelance_Availability_Widget_Class extends WP_Widget {

	public function __construct() {
		parent::__construct( 'faw_freelance_availability_widget', 'Freelance Availability', array( 'description' => 'Widget to Show on your Site if you are available for freelance work' ) );
	}


	function widget( $args, $instance ) {

		extract( $args, EXTR_SKIP );

		$currenttime = time();

		$available_time_value    = isset( $instance['widget_available_time'] ) ? $instance['widget_available_time'] : '';
		$soon_time_value         = isset( $instance['widget_soon_time'] ) ? $instance['widget_soon_time']: '';

		// If the current time is after the time you said you were available
		if ( $currenttime > $available_time_value ) {

			$title         = isset( $instance['widget_available_title'] ) ? $instance['widget_available_title'] : '';
			$text          = isset( $instance['widget_available_text'] ) ? $instance['widget_available_text'] : '';
			$url           = isset( $instance['widget_available_url'] ) ? $instance['widget_available_url'] : '';
			$before_widget = str_replace( 'class="', 'class="widget_faw_freelance_availability_widget_available ', $before_widget );

		} elseif ( $currenttime < $available_time_value && $currenttime > $soon_time_value ) {
	
			$title = isset( $instance['widget_soon_title'] ) ? $instance['widget_soon_title'] : '';
			$text  = isset( $instance['widget_soon_text'] ) ? $instance['widget_soon_text'] : '';
			$url   = isset( $instance['widget_soon_url'] ) ? $instance['widget_soon_url'] : '';
			$before_widget = str_replace( 'class="', 'class="widget_faw_freelance_availability_widget_soon ', $before_widget );

		} else {

			$title = isset( $instance['widget_unavailable_title'] ) ? $instance['widget_unavailable_title'] : '';
			$text  = isset( $instance['widget_unavailable_text'] ) ? $instance['widget_unavailable_text'] : '';
			$url   = isset( $instance['widget_unavailable_url'] ) ? $instance['widget_unavailable_url'] : '';
			$before_widget = str_replace( 'class="', 'class="widget_faw_freelance_availability_widget_unavailable ', $before_widget );

		}

		echo $before_widget;

		echo $before_title . $title . $after_title;

		echo '<p>' . $text . '</p>';

		if ( do_shortcode( $url ) != $url ) {
			echo do_shortcode( $url );
		} elseif ( wp_http_validate_url( $url ) ) {
			echo '<p><a href="' . $url . '">' . __( 'Contact Us', 'freelance-availability-widget' ) . '</a></p>';
		}

		echo $after_widget;

	}

	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
		$instance['widget_available_title'] = strip_tags( $new_instance['widget_available_title'] );
		$instance['widget_available_text']  = strip_tags( $new_instance['widget_available_text'] );
		$instance['widget_available_time']  = strtotime( $new_instance['widget_available_time'] );
		$instance['widget_available_url']   = strip_tags( $new_instance['widget_available_url'] );

		$instance['widget_soon_title'] = strip_tags( $new_instance['widget_soon_title'] );
		$instance['widget_soon_text']  = strip_tags( $new_instance['widget_soon_text'] );
		$instance['widget_soon_time']  = strtotime( $new_instance['widget_soon_time'] );
		$instance['widget_soon_url']   = strip_tags( $new_instance['widget_soon_url'] );

		$instance['widget_unavailable_title'] = strip_tags( $new_instance['widget_unavailable_title'] );
		$instance['widget_unavailable_text']  = strip_tags( $new_instance['widget_unavailable_text'] );
		$instance['widget_unavailable_time']  = strtotime( $new_instance['widget_unavailable_time'] );
		$instance['widget_unavailable_url']   = strip_tags( $new_instance['widget_unavailable_url'] );
	
		return $instance;
	}

 	/**
  	* admin control form
   	*/
  	function form( $instance ) {
  		$instance = wp_parse_args( (array) $instance, $default );

		$available_title_id     = $this->get_field_id( 'widget_available_title' );
		$available_title_name   = $this->get_field_name( 'widget_available_title' );
		$available_text_id      = $this->get_field_id( 'widget_available_text' );
		$available_text_name    = $this->get_field_name( 'widget_available_text' );
		$available_time_id      = $this->get_field_id( 'widget_available_time' );
		$available_time_name    = $this->get_field_name( 'widget_available_time' );
		$available_url_id       = $this->get_field_id( 'widget_available_url' );
		$available_url_name     = $this->get_field_name( 'widget_available_url' );
		$soon_title_id          = $this->get_field_id( 'widget_soon_title' );
		$soon_title_name        = $this->get_field_name( 'widget_soon_title' );
		$soon_text_id           = $this->get_field_id( 'widget_soon_text' );
		$soon_text_name         = $this->get_field_name( 'widget_soon_text' );
		$soon_time_id           = $this->get_field_id( 'widget_soon_time' );
		$soon_time_name         = $this->get_field_name( 'widget_soon_time' );
		$soon_url_id            = $this->get_field_id( 'widget_soon_url' );
		$soon_url_name          = $this->get_field_name( 'widget_soon_url' );
		$unavailable_title_id   = $this->get_field_id( 'widget_unavailable_title' );
		$unavailable_title_name = $this->get_field_name( 'widget_unavailable_title' );
		$unavailable_text_id    = $this->get_field_id( 'widget_unavailable_text' );
		$unavailable_text_name  = $this->get_field_name( 'widget_unavailable_text' );
		$unavailable_time_id    = $this->get_field_id( 'widget_unavailable_time' );
		$unavailable_time_name  = $this->get_field_name( 'widget_unavailable_time' );
		$unavailable_url_id     = $this->get_field_id( 'widget_unavailable_url' );
		$unavailable_url_name   = $this->get_field_name( 'widget_unavailable_url' );

		$available_title_value   = isset( $instance['widget_available_title'] ) ? $instance['widget_available_title'] : '';
		$available_text_value    = isset( $instance['widget_available_text'] ) ? $instance['widget_available_text'] : '';
		$available_time_value    = isset( $instance['widget_available_time'] ) ? date( 'Y-m-d', $instance['widget_available_time'] ) : '';
		$available_url_value     = isset( $instance['widget_available_url'] ) ? $instance['widget_available_url'] : '';
		$soon_title_value        = isset( $instance['widget_soon_title'] ) ? $instance['widget_soon_title'] : '';
		$soon_text_value         = isset( $instance['widget_soon_text'] ) ? $instance['widget_soon_text'] : '';
		$soon_time_value         = isset( $instance['widget_soon_time'] ) ? date( 'Y-m-d', $instance['widget_soon_time'] ): '';
		$soon_url_value          = isset( $instance['widget_soon_url'] ) ? $instance['widget_soon_url'] : '';
		$unavailable_title_value = isset( $instance['widget_unavailable_title'] ) ? $instance['widget_unavailable_title'] : '';
		$unavailable_text_value  = isset( $instance['widget_unavailable_text'] ) ? $instance['widget_unavailable_text'] : '';
		$unavailable_time_value  = isset( $instance['widget_unavailable_time'] ) ?  date( 'Y-m-d', $instance['widget_unavailable_time'] ): '';
		$unavailable_url_value   = isset( $instance['widget_unavailable_url'] ) ? $instance['widget_unavailable_url'] : '';

		$settingsavailabile = array(
			'media_buttons' => false,
			'textarea_rows' => 3,
			'textarea_name' => $available_text_name,
			'teeny'         => true,
		);

		$settingssoon = array(
			'media_buttons' => false,
			'textarea_rows' => 3,
			'textarea_name' => $soon_text_name,
			'teeny'         => true,
		);

		$settingsunavailable = array(
			'media_buttons' => false,
			'textarea_rows' => 3,
			'textarea_name' => $unavaiable_text_name,
			'teeny'         => true,
		);

		?>

		<h2><?php _e( 'Available Settings', 'freelance-availability-widget' ); ?></h2>
		<p><label for="<?php echo $available_title_id ?>"><?php _e( 'Title', 'freelance-availability-widget'  ); ?>: <input type="text" class="widefat" id="<?php echo $available_title_id; ?>" name="<?php echo $available_title_name; ?>" value="<?php echo esc_attr( $available_title_value ); ?>" /></label></p>
		<p><label for="<?php echo $available_text_id; ?>"><?php _e( 'Text', 'freelance-availability-widget' ); ?>: <br/><textarea rows="4" cols="20" id="<?php echo $available_text_id; ?>" name="<?php echo $available_text_name; ?>"><?php echo $available_text_value; ?></textarea></label></p>
		<p><label for="<?php echo $available_url_id; ?>"><?php _e( 'URL/Shortcode', 'freelance-availability-widget' ); ?>: <input type="text" class="widefat" id="<?php echo $available_url_id; ?>" name="<?php echo $available_url_name; ?>" value="<?php echo esc_attr( $available_url_value ); ?>" /></label><br/>
		<span class="description"><?php _e( 'Use a shortcode, if you wish, to replace the button with a shortcode.', 'freelance-availability-widget' ); ?></p>
		<p><label for="<?php echo $available_time_id; ?>"><?php _e( 'Available Date From','freelance-availability-widget' ); ?>: <input type="text" class="faw_custom_date widefat" id="<?php echo $available_time_id; ?>" name="<?php echo $available_time_name; ?>" value="<?php echo esc_attr( $available_time_value ); ?>" /></label></p>

		<h2><?php _e( 'Soon Available Settings', 'freelance-availability-widget' ); ?></h2>
		<p><label for="<?php echo $soon_title_id ?>"><?php _e( 'Title', 'freelance-availability-widget'  ); ?>: <input type="text" class="widefat" id="<?php echo $soon_title_id; ?>" name="<?php echo $soon_title_name; ?>" value="<?php echo esc_attr( $soon_title_value ); ?>" /></label></p>
		<p><label for="<?php echo $soon_text_id; ?>"><?php _e( 'Text', 'freelance-availability-widget' ); ?>: <br/><textarea rows="4" cols="20" id="<?php echo $soon_text_id; ?>" name="<?php echo $soon_text_name; ?>"><?php echo $soon_text_value; ?></textarea></label></p>
		<p><label for="<?php echo $soon_url_id; ?>"><?php _e( 'URL/Shortcode', 'freelance-availability-widget' ); ?>: <input type="text" class="widefat" id="<?php echo $soon_url_id; ?>" name="<?php echo $soon_url_name; ?>" value="<?php echo esc_attr( $soon_url_value ); ?>" /></label><br/>
		<span class="description"><?php _e( 'Use a shortcode, if you wish, to replace the button with a shortcode.', 'freelance-availability-widget' ); ?></p>
		<p><label for="<?php echo $soon_time_id; ?>"><?php _e( 'Soon Date From','freelance-availability-widget' ); ?>: <input type="text" class="faw_custom_date widefat" id="<?php echo $soon_time_id; ?>" name="<?php echo $soon_time_name; ?>" value="<?php echo esc_attr( $soon_time_value ); ?>" /></label></p>

		<h2><?php _e( 'Unavailable Settings', 'freelance-availability-widget' ); ?></h2>
		<p><label for="<?php echo $unavailable_title_id ?>"><?php _e( 'Title', 'freelance-availability-widget'  ); ?>: <input type="text" class="widefat" id="<?php echo $unavailable_title_id; ?>" name="<?php echo $unavailable_title_name; ?>" value="<?php echo esc_attr( $unavailable_title_value ); ?>" /></label></p>
		<p><label for="<?php echo $unavailable_text_id; ?>"><?php _e( 'Text', 'freelance-availability-widget' ); ?>: <br/><textarea rows="4" cols="20" id="<?php echo $unavailable_text_id; ?>" name="<?php echo $unavailable_text_name; ?>"><?php echo $unavailable_text_value; ?></textarea></label></p>
		<p><label for="<?php echo $unavailable_url_id; ?>"><?php _e( 'URL/Shortcode', 'freelance-availability-widget' ); ?>: <input type="text" class="widefat" id="<?php echo $unavailable_url_id; ?>" name="<?php echo $unavailable_url_name; ?>" value="<?php echo esc_attr( $unavailable_url_value ); ?>" /></label><br/>
		<span class="description"><?php _e( 'Use a shortcode, if you wish, to replace the button with a shortcode.', 'freelance-availability-widget' ); ?></p>
		<p><?php _e( 'The "Unavailable" settings will be shown if the current date is before the "Soon" date.', 'freelance-availability-widget' ); ?></p>
		<?php
  }

}

/**
 * Register the eBay Feeds for WordPress widget
 * @return void
 */
function faw_freelance_availability_widget() {
  // curl need to be installed
	register_widget( 'Freelance_Availability_Widget_Class' );
} add_action( 'widgets_init', 'faw_freelance_availability_widget', 10 );
