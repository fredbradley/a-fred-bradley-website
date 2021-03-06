<?php
/*
Plugin Name: A Fred Bradley Website
Plugin URI: https://github.com/fredbradley/a-fred-bradley-website
Description: Comes with every Fred Bradley Wordpress Installation.  
Version: 1.1.3
Author: Fred Bradley
Author URI: http://www.fredbradley.co.uk/
License: MIT
GitHub Plugin URI: https://github.com/fredbradley/a-fred-bradley-website
GitHub Branch: master
Copyright: Fred Bradley
*/

require_once dirname( __FILE__ ) . '/required_plugins/required_plugins.php';
require_once dirname(__FILE__) . '/classes/class.fred.options.php';
//require_once dirname(__FILE__) . '/update.php';

add_action( 'wp_head', 'socialcount_scripts_and_styles' );
function socialcount_scripts_and_styles() {

	$folder = plugins_url( 'socialcount/', __FILE__ );
	echo '<link rel="stylesheet" href="'.$folder.'socialcount-with-icons.css" />';
	echo '<link rel="stylesheet" href="'.$folder.'socialcount-icons.css" />';
	echo '<script src="'.$folder.'socialcount.js"></script>';
	echo "<style>.socialcount > li { background-color:#73c547;}</style>";
}

add_action('wp_head', 'add_this_script');
function add_this_script() {
	echo '<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-544abb3f5b9d9ed7"></script>';
}


function add_this_insert() {
	echo '<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-544abb3f5b9d9ed7" async="async"></script>
';
echo '<!-- Go to www.addthis.com/dashboard to customize your tools -->
<div class="addthis_sharing_toolbox"></div>';

echo '<div class="sharrre">&nbsp;</div>';
}


// [bartag foo="foo-value"]
function shortcode_example( $atts ) {
    $a = shortcode_atts( array(
        'foo' => 'something',
        'bar' => 'something else',
    ), $atts );

    return "foo = {$a['foo']}";
}
add_shortcode( 'shortcode_name', 'shortcode_example' );


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
			"from-fred", 
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
