<?php 
/**
* Plugin Name: News Room
* Plugin URI: https://github.com/andela-tpeters
* Description: This is a plugin that handles news reporting from users and individuals that love to report anything that the have seen around them
* Version: 1.0.0
* Author: Tijesunim Peters
* Author URI: https://github.com/andela-tpeters
* License: GPL2
* License URI: https://www.gnu.org/licenses/gpl-2.0.html
* 
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}


require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

function activate_news_room() {}

function deactivate_news_room() {}

register_activation_hook(__FILE__, 'activate_news_room');
register_deactivation_hook(__FILE__, 'deactivate_news_room');

require_once plugin_dir_path(__FILE__)."includes/class-news-room.php";

function run_news_room() {
	$news_room = new NewsRoom();
	$news_room->run();
}


run_news_room();