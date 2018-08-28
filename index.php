<?php
/**
 * Plugin Name: Freelance Availability Widget
 * Description: This plugin is a widget to show on sites run by freelancers their availability for work.
 * Plugin URI: https://www.winwar.co.uk/
 * Author: Dwi'n Rhys
 * Author URI: https://dwinrhys.com/
 * Version: 1.0
 * License: GPL2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: Text Domain
 * Domain Path: Domain Path
 * Network: false
 */

defined( 'ABSPATH' ) or exit;

define('FAW_PLUGIN_VERSION', '1.0');
define('FAW_PLUGIN_PATH',dirname(__FILE__));
define('FAW_PLUGIN_URL',plugins_url('', __FILE__));

require_once FAW_PLUGIN_PATH . '/inc/core.php';