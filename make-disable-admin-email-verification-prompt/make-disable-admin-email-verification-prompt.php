<?php
/**
 * Plugin Name: Make Disable Admin Email Verification Prompt
 * Plugin URI:  https://developer.wordpress.org/plugins/make-disable-admin-email-verification-prompt/
 * Description: Disable admin email verification prompt introduced in WordPress 5.3, with checkbox option in General in Settings. If you want to disable prompt then tick the checkbox.
 * Author: Aims Infosoft
 * Version: 1.0.8
 * Requires at least: 5.3
 * Text Domain: make-disable-admin-email-verification-prompt
 * Author URI: https://aimsinfosoft.com/
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

if ( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

if ( !defined( 'DAEV_PLUGIN_URL' ))
    define( 'DAEV_PLUGIN_URL', admin_url("plugins.php") );

if( !class_exists('DisAdminPrompt') ) {
	class DisAdminPrompt {

		public function __construct() {
			
			register_activation_hook(__FILE__, array($this,'daev_activate'));     //activate hook
			register_deactivation_hook(__FILE__, array($this,'daev_deactivate'));  //deactivate hook
			register_uninstall_hook(__FILE__, array( __CLASS__, 'daev_uninstall' ) ); // plugin uninstallation

			add_action( 'admin_init', array($this, 'daev_initialize_theme_options') );
			add_action( 'init', array($this, 'daev_email_verification_screen') );		
		}

		public function daev_activate() {  
			//flush permalinks
			global $wp_version;
			
			if ( version_compare($wp_version,'5.3') >= 0 ) {
			    /*echo 'Wordpress Version same or above 5.3';*/
			} else {
			    /*echo 'Wordpress Version below 5.3';*/
			    // Deactivate the plugin.
				deactivate_plugins( plugin_basename( __FILE__ ) );
				// Throw an error in the WordPress admin console.
				$error_message = '<div class="error"><p style="color:#444;"><strong>'. esc_html__( 'This plugin requires Wordpress 5.3 Version.You can Download', 'make-disable-admin-email-verification-prompt' ).'<a href="' . esc_url( 'https://wordpress.org/download/releases/' ) . '" target="_blank"> '. esc_html__('Wordpress', 'make-disable-admin-email-verification-prompt').'</a> '.esc_html__('here.', 'make-disable-admin-email-verification-prompt').' </strong></p><p style="color:#444;">'. esc_html__('Back to','make-disable-admin-email-verification-prompt') .' <a href="'. esc_url( DAEV_PLUGIN_URL ) .'">'.esc_html__('Plugins','make-disable-admin-email-verification-prompt').' </a></p></div>';
	    		wp_die( wp_kses_post( $error_message ) );
			} 
			flush_rewrite_rules();
		}
		
		public function daev_deactivate() {
			//flush permalinks
			flush_rewrite_rules();
		}
		
		public static function daev_uninstall() {
			//flush permalinks
			flush_rewrite_rules();
		}

		public function daev_initialize_theme_options() {
			// First, we register a section. This is necessary since all future options must belong to one.
			register_setting('general','daev_email_veri_screen', array( 'sanitize_callback' => 'absint' ));

		    add_settings_section(
		        'general_daev_section',         // ID used to identify this section and with which to register options
		        'Disable Admin Email Verification Prompt',  // Title to be displayed on the administration page
		        array( $this, 'daev_general_options_callback' ), // Callback
		        /*'daev_general_options_callback',*/ // Callback used to render the description of the section
		        'general'                           // Page on which to add this section of options
		    );

		    // Next, we will introduce the fields for toggling the visibility of content elements.
			add_settings_field( 
			    'daev_email_veri_screen',           // ID used to identify the field throughout the theme
			    'Disable Admin Email Verification Screen',   // The label to the left of the option interface element
			    array( $this, 'daev_toggle_email_verification' ),   // The name of the function responsible for rendering the option interface
			    'general',                          // The page on which this option will be displayed
			    'general_daev_section',         // The name of the section to which this field belongs
			    array(                              // The array of arguments to pass to the callback. In this case, just a description.
			        'Activate this setting to disable the Admin Email Verification.'
			    )
			);
		}
		// end daev_initialize_theme_options

		public function daev_general_options_callback() {
		    echo '<p>If you want to disable admin email verification prompt screen then please tick the below checkbox.</p>';
		} // end daev_general_options_callback

		public function daev_toggle_email_verification($args) {
			// Note the ID and the name attribute of the element should match that of the ID in the call to add_settings_field
			printf(
				'<input type="checkbox" id="daev_email_veri_screen" name="daev_email_veri_screen" value="1" %s/>',
				checked( '1', get_option( 'daev_email_veri_screen' ), false )
			);

			// Here, we will take the first argument of the array and add it to a label next to the checkbox
			printf(
				'<label for="daev_email_veri_screen"> %s</label>',
				esc_html( $args[0] )
			);
		}

		public function daev_email_verification_screen() {

			$email_veri_screen = (int)get_option('daev_email_veri_screen');
			if('1' == $email_veri_screen) {
				add_filter( 'admin_email_check_interval', '__return_false' );
			}
		}

	}	
}

	$daev_disadminprompt = new DisAdminPrompt();

