<?php
/*
	Plugin Name: Tech Liminal Community
	Plugin URI: https://github.com/techliminal/Liminal-Community
	Description: A plugin for managing the Tech Liminal Community
	Author: Anca Mosoiu
	Author URI: http://www.techliminal.com/

	Version: 0.1

	License: GNU General Public License v2.0 (or later)
	License URI: http://www.opensource.org/licenses/gpl-license.php
*/

/**
 *  The Plugin class handles activation, deactivation, and 
 * loading the different components.
 */
 
class TLCommunityPlugin{

	public $settings_field = 'techliminal_community';
	public $admin_page = 'techliminal_community';
	
	/** Constructor */
	function __construct() {
		
		register_activation_hook( __FILE__, array( $this, 'activation_hook' ) );
		register_deactivation_hook( __FILE__, array( $this, 'deactivation_hook' ) );
				
		add_action( 'admin_init', array( $this, 'javascript' ) );
		add_action( 'admin_init', array( $this, 'register_settings' ) );
		add_action( 'admin_menu', array( $this, 'add_menu' ), 15 );
		add_action( 'admin_notices', array( $this, 'notices' ) );
		
	}
	
	function activation_hook() {
		//nothing to see here
	}

	function deactivation_hook() {
	
		// nothing to see here.

	}

	
	function javascript() {
		
		//wp_enqueue_script( 'tl-community-js', plugin_dir_url(__FILE__) . 'js/admin.js', array( 'jquery' ), '', true );
		
	}
	
	function register_settings() {
		register_setting( $this->settings_field, $this->settings_field );
		add_option( $this->settings_field, $this->settings_defaults() );
	}
	
	
	function notices() {
		
		if ( ! isset( $_REQUEST['page'] ) || $this->admin_page != $_REQUEST['page'] )
			return;

		if ( isset( $_REQUEST['updated'] ) && 'true' == $_REQUEST['updated'] ) {  
			echo '<div id="message" class="updated"><p><strong>' . __( 'Settings Saved', 'techliminal' ) . '</strong></p></div>';
		}
		
	}
	
	function settings_defaults() {
		
		return array(
			'setting' => 'value'
		);
		
	}
	
	function add_menu() {
		
		add_menu_page('techliminal', __('Tech Liminal Community','techliminal'), 'manage_options', 'techliminal_community', array( &$this, 'admin_page' ) );
	
	}
	
	function admin_page() { 
	
	echo "Hello World";
	
	}

}

$liminal_community = new TLCommunityPlugin;