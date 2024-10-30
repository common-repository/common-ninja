<?php
/**
 * Plugin Name:       Common Ninja's Widgets
 * Plugin URI:        https://www.commoninja.com
 * Description:       Customizable widgets to embed in any website. Join 150,000 businesses who save time, money, and build websites faster. No coding skills required!
 * Version:           1.1.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Common Ninja
 * Author URI:        http://www.commoninja.com
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       
 * Domain Path:       
 */

/*
 * Shortcode to embed Common Ninja widget in a website.
 * 
 *	   The list of arguments is below:
 * 			'id' 	(string) 	- Common Ninja Widget ID
 */

function commonninja_get_html_placeholder($id) {
	$html = "<div class=\"commonninja_component pid-$id\"></div>";

	return $html;
}

function commonninja_shortcode( $atts ) {
	$a = shortcode_atts(array(
		'id' => '',
	), $atts);
	$id = $a['id'];

	return commonninja_get_html_placeholder($id);
}

add_shortcode( 'commonninja', 'commonninja_shortcode' );

function commonninja_load_global_script() {
	wp_enqueue_script('commonninja-sdk', 'https://cdn.commoninja.com/sdk/latest/commonninja.js');
}

add_action('wp_enqueue_scripts', 'commonninja_load_global_script');

function commonninja_enqueue_block_editor_assets() {
	wp_enqueue_script(
			'commonninja-block',
			plugins_url( 'embed-block.js', __FILE__ ),
			array( 'wp-blocks', 'wp-element', 'wp-editor' ),
			true
	);
}

add_action( 'enqueue_block_editor_assets', 'commonninja_enqueue_block_editor_assets' );

// // function commonninja_register_menu(){
// // 	$page_title = 'Common Ninja Plugins';
// // 	$menu_title = 'Common Ninja';
// // 	$capability = 'manage_options';
// // 	$menu_slug  = 'commonninja-plugins';
// // 	$function   = 'commonninja_redirect';
// // 	$icon_url   = plugin_dir_url( __FILE__ ) . 'icon.png';
// // 	// $position   = 1; // 65;

// // 	add_menu_page($page_title, $menu_title, $capability, $menu_slug, $function, $icon_url); 
// // } 

// // add_action('admin_menu', 'commonninja_register_menu');  

// // function commonninja_redirect() {
// // 	$menu_redirect = isset($_GET['page']) ? $_GET['page'] : false;

// // 	if ($menu_redirect == 'commonninja-plugins') {
// // 		$redirect_url = 'https://www.commoninja.com/user/dashboard';
// // 		wp_redirect($redirect_url);
// // 		exit();
// // 	}
// // }

// // add_action('admin_init', 'commonninja_redirect');

?>