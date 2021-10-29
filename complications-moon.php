<?php
/**
 * Plugin Name:       The Moon
 * Plugin URI:        https://www.complication.watch/wp/
 * Description:       Shows the current phase of The Moon, it's Zodiak sign and the date of the next lunar eclipse.
 * Tags:              moon, phases, zodiac, lunar, eclipse, constellation, full moon
 * Version:           1.0.1
 * Stable tag:        1.0.1
 * Requires at least: 5.8
 * Tested up to:      5.8.1
 * Requires PHP:      7.0
 * Author:            Jake Olefsky
 * Author URI:        https://www.jakeo.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 */

//Prevent this file from being called directly instead of through WP framework
defined('WPINC') or die;

//For debugging
// define('WP_DEBUG', true);
// define('SAVEQUERIES', true);

//create the classes
define('COMPLICATIONS_MOON_VERSION','1.0.1');
require plugin_dir_path(__FILE__).'includes/Complications_Moon_Base.php';
require plugin_dir_path(__FILE__).'includes/Complications_Moon_Shortcode.php';
require plugin_dir_path(__FILE__).'includes/Complications_Moon_Widget.php';
require plugin_dir_path(__FILE__).'includes/Complications_Moon_Block.php';
$Complications_Moon_Base = new Complications_Moon_Base();
$Complications_Moon_Shortcode = new Complications_Moon_Shortcode();
$Complications_Moon_Widget = new Complications_Moon_Widget();
$Complications_Moon_Block = new Complications_Moon_Block();

//register lifecycle hooks
register_activation_hook(__FILE__, array($Complications_Moon_Base,'activate'));
register_deactivation_hook(__FILE__, array($Complications_Moon_Base,'deactivate'));
register_uninstall_hook(__FILE__, array($Complications_Moon_Base,'uninstall'));