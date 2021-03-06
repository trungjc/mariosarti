<?php

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Exception handling for third-party plugins dealing with the WordPress options view.
 */
if ( ! class_exists( 'Tribe__Events__Options_Exception' ) ) {
	class Tribe__Events__Options_Exception extends Exception {
		/**
		 * Display the exception message in the div #tribe-events-options-error
		 */
		public static function displayMessage() {
			$eventsOptions = get_option( Tribe__Events__Main::OPTIONNAME, array() );
			if ( isset( $eventsOptions['error'] ) && $eventsOptions['error'] ) : ?>
				<script type="text/javascript">jQuery('#tribe-events-options-error').append('<h3><?php esc_html_e( 'Error', 'tribe-events-calendar' ); ?></h3><p>' + '<?php echo $eventsOptions['error']; ?>' + '</p>').show();</script>
			<?php endif;
		}
	} // end Tribe__Events__Options_Exception
} // end if !class_exists Tribe__Events__Options_Exception
