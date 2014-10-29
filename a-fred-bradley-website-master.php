<?php
/*
Plugin Name: Website By Fred Bradley
Plugin URI: https://github.com/fredbradley/a-fred-bradley-website
Description: Comes with every Fred Bradley Wordpress Installation.  
Version: 1.1
Author: Fred Bradley
Author URI: http://www.fredbradley.co.uk/
License: MIT
Copyright: Fred Bradley
*/

require_once dirname( __FILE__ ) . '/required_plugins/required_plugins.php';
require_once dirname(__FILE__) . '/classes/class.fred.options.php';
require_once dirname(__FILE__) . '/update.php';

add_action( 'wp_head', 'socialcount_scripts_and_styles' );
function socialcount_scripts_and_styles() {

	$folder = plugins_url( 'socialcount/', __FILE__ );
	echo '<link rel="stylesheet" href="'.$folder.'socialcount-with-icons.css" />';
	echo '<link rel="stylesheet" href="'.$folder.'socialcount-icons.css" />';
	echo '<script src="'.$folder.'socialcount.js"></script>';
	echo "<style>.socialcount > li { background-color:#73c547;}</style>";
}


function fb_helper_setup() {

	
	require_once('inc/clean_up_ui.php');
	
	/**
	 * Create Admin Menu Item
	 */
	 add_action( 'admin_menu', 'my_plugin_menu' );

	 /** Step 1. */
	function my_plugin_menu() {
	//	add_options_page( 'My Plugin Options', 'More Settings', 'manage_options', 'fb_settings', 'fred_plugin_options' );
	//	add_options_page('Blahdiblah', 'Test Settings', 'manage_options', 'fb_settings_test', 'index_fred');
	}

	function fred_plugin_options() {
		if ( !current_user_can( 'manage_options' ) )  {
			wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
		}
		echo '<div class="wrap">';
		echo '<p>Here is where the form would go if I actually had options.</p>';
		echo '</div>';
	}

	function index_fred() {
		if ( !current_user_can( 'manage_options' ) )  {
			wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
		}
		echo '<div class="wrap">';
		require_once('inc/twitteroauth/index.php');
		echo '</div>';
	}

}

add_action( 'after_setup_theme', 'fb_helper_setup' );


function fredbradley_admin_page() {
	require_once(plugin_dir_path(__FILE__).'page.php');
}

function fredbradley_admin_scripts() {
}

function fredbradley_modify_menu() {

		
		$page = add_menu_page(
			"Fred's Settings", 
			"From Fred", 
			"edit_posts", 
			"fb-developer-settings", 
			"fredbradley_admin_page",
			plugins_url('/images/websiteby.png', __FILE__)
		);
		add_action('admin_print_scripts-' . $page, 'fredbradley_admin_scripts'); 
		
	}
add_action( 'admin_menu', 'fredbradley_modify_menu' );




function log_me($message) {
    if (WP_DEBUG === true) {
        if (is_array($message) || is_object($message)) {
            error_log(print_r($message, true));
        } else {
            error_log($message);
        }
    }
}
