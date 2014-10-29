<?php

function fontawesome_dashboard() {
   wp_enqueue_style('fontawesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css', '', '4.1.0', 'all'); 
}
 
add_action('admin_init', 'fontawesome_dashboard');


/* Make the Admin UI Cleaner */
// THIS TAKES AWAY DEFAULT ADMIN FOOTER TEXT AND USES MY OWN
function replace_footer_version() {
	echo "You're currently using:<strong> Wordpress ".get_bloginfo('version')."</strong>";
}
add_filter( 'update_footer', 'replace_footer_version', '1234');

function hide_help() {
    echo '<style type="text/css">
            #contextual-help-link-wrap { display: none !important; }
            i.fa {text-align:center;width:45px;vertical-align:middle;}
          </style>';
}
add_action('admin_head', 'hide_help');

function fb_admin_footer () {
	echo '<a href="http://www.fredbradley.co.uk/"><span class="websiteby">a Fred Bradley website</span></a>';
} 
add_filter('admin_footer_text', 'fb_admin_footer');

function remove_editor_menu() {
	remove_action('admin_menu', '_add_themes_utility_last', 101);
}
add_action('_admin_menu', 'remove_editor_menu', 1);

function replace_howdy( $wp_admin_bar ) {
    $my_account=$wp_admin_bar->get_node('my-account');
    $newtitle = str_replace( 'Howdy,', 'Logged in:', $my_account->title );            
    $wp_admin_bar->add_node( array(
        'id' => 'my-account',
        'title' => $newtitle,
    ) );
}
add_filter( 'admin_bar_menu', 'replace_howdy',25 );

function wps_admin_bar() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('wp-logo');
    $wp_admin_bar->remove_menu('about');
    $wp_admin_bar->remove_menu('wporg');
    $wp_admin_bar->remove_menu('documentation');
    $wp_admin_bar->remove_menu('support-forums');
    $wp_admin_bar->remove_menu('feedback');
    
}
add_action( 'wp_before_admin_bar_render', 'wps_admin_bar' );

function my_custom_login_logo() {
	if (@file_get_contents(get_bloginfo('template_url').'/images/login_page_logo.png')) {
		$login_logo = get_bloginfo('template_url').'/images/login_page_logo.png';
	} else {
		$login_logo = plugins_url('logo-wordpress-login.png', __DIR__);
	}

    echo '<style type="text/css">
        h1 a {background-size:auto !important; width:320px !important;height:85px !important;background-image:url('.$login_logo.') !important; }
    </style>';
}
add_action('login_head', 'my_custom_login_logo');




// First, create a function that includes the path to your favicon
function add_favicon() {
	if (@file_get_contents(get_bloginfo('template_url').'/images/icons/favicon.png')) {
		$favicon_url = get_bloginfo('template_url').'/images/icons/favicon.png';
	} else {
		$favicon_url = plugins_url('websiteby.png', __DIR__);
	}
	echo '<link rel="shortcut icon" href="' . $favicon_url . '" />';
}
  
// Now, just make sure that function runs when you're on the login page and admin pages  
add_action('login_head', 'add_favicon');
add_action('admin_head', 'add_favicon');



function custom_post_css() {
   echo "<style type='text/css' media='screen'>
   	
       #adminmenu .menu-icon-post div.wp-menu-image:before {
            font-family:  FontAwesome !important;
            content: '\\f044'; // this is where you enter the fontawesome font code
        }
     </style>";
}
add_action('admin_head', 'custom_post_css');



function load_fb_admin_style(){
	echo '<style>span.websiteby{background: url("'.plugins_url("websiteby.png", __DIR__).'") no-repeat left center transparent;padding-left: 20px;height:20px;display:block;}</style>';
}
add_action('admin_head', 'load_fb_admin_style');

// This just echoes the chosen line, we'll position it later
function fb_admin_notice() {
//	echo "<p class='fb_admin_notice' id='bug_report'><a href='http://support.fredbradley.co.uk/open.php' target='_blank'><span class='websiteby'>Bug Report</span></a></p>";
	echo "<p class='fb_admin_notice' id='issue_tracker'><a href='https://bitbucket.org/fredbradley/student-radio-v3/issues' target='_blank'><i class='fa fa-2x fa-bitbucket'></i>Issue Tracker</a></p>";
}

// Now we set that function up to execute when the admin_notices action is called
add_action( 'admin_notices', 'fb_admin_notice' );

// We need some CSS to position the paragraph
function fb_admin_notice_css() {
	// This makes sure that the positioning is also good for right-to-left languages
	$x = is_rtl() ? 'left' : 'right';

	echo "
	<style type='text/css'>
	.fb_admin_notice {
		float: $x;
		padding-$x: 15px;
		padding-top: 5px;		
		margin: 0;
	}
	.fb_admin_notice i.fa {
		color: #205081;
	}
	</style>
	";
}

add_action( 'admin_head', 'fb_admin_notice_css' );


