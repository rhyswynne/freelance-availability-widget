<?php
/**
 * Plugin Name: Freelance Availability Widget
 * Description: This plugin is a widget to show on sites run by freelancers their availability for work.
 * Plugin URI: https://dwinrhys.com/freelance-availability-widget/?utm_source=plugin-link&utm_medium=plugin&utm_campaign=freelance-availability-widget
 * Author: Dwi'n Rhys
 * Author URI: https://dwinrhys.com/?utm_source=author-link&utm_medium=plugin&utm_campaign=freelance-availability-widget
 * Version: 2.1
 * License: GPL2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: freelanceavailabilitywidget
 * Domain Path: Domain Path
 * Network: false
 */

defined( 'ABSPATH' ) or exit;

define('FAW_PLUGIN_VERSION', '2.1');
define('FAW_PLUGIN_PATH',dirname(__FILE__));
define('FAW_PLUGIN_URL',plugins_url('', __FILE__));

require_once FAW_PLUGIN_PATH . '/inc/core.php';


/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function faw_block_init() {
	register_block_type( __DIR__ . '/build' );
}
add_action( 'init', 'faw_block_init' );
