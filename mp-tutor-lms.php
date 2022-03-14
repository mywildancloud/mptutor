<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://brandmarketers.id
 * @since             1.0.0
 * @package           Mp_Tutor_Lms
 *
 * @wordpress-plugin
 * Plugin Name:       MP Tutor LMS
 * Plugin URI:        https://brandmarketers.id
 * Description:       Best plugin template for tutor LMS integrate with Easy Digital Downloads.
 * Version:           1.0.8
 * Author:            brandmarketers.id
 * Author URI:        https://brandmarketers.id
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       mp-tutor-lms
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'MP_TUTOR_LMS_VERSION', '1.0.8' );
define( 'MP_TUTOR_LMS_MEMBER', 'https://user.brandmarketers.id' );
define( 'MP_TUTOR_LMS_ID', '1661' );
define( 'MP_TUTOR_LMS_NAME', 'MP TUTOR LMS' );
define( 'MP_TUTOR_LMS_PLUGIN', true );
define( 'MP_TUTOR_LMS_PLUGIN_FILE', plugin_basename( __FILE__ ) );
define( 'MP_TUTOR_LMS_DIR_PATH', plugin_dir_path(__FILE__) );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-mp-tutor-lms-activator.php
 */
function activate_mp_tutor_lms() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-mp-tutor-lms-activator.php';
	Mp_Tutor_Lms_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-mp-tutor-lms-deactivator.php
 */
function deactivate_mp_tutor_lms() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-mp-tutor-lms-deactivator.php';
	Mp_Tutor_Lms_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_mp_tutor_lms' );
register_deactivation_hook( __FILE__, 'deactivate_mp_tutor_lms' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-mp-tutor-lms.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_mp_tutor_lms() {

	$plugin = new Mp_Tutor_Lms();
	$plugin->run();

}
run_mp_tutor_lms();
