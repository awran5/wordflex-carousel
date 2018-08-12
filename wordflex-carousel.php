<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              #
 * @since             1.0.0
 * @package           Wordflex_Carousel
 *
 * @wordpress-plugin
 * Plugin Name:       WordFlex Carousel
 * Plugin URI:        #
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Awran5
 * Author URI:        #
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wordflex-carousel
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
define( 'WFC_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wordflex-carousel-activator.php
 */
function activate_wordflex_carousel() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wordflex-carousel-activator.php';
	Wordflex_Carousel_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wordflex-carousel-deactivator.php
 */
function deactivate_wordflex_carousel() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wordflex-carousel-deactivator.php';
	Wordflex_Carousel_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wordflex_carousel' );
register_deactivation_hook( __FILE__, 'deactivate_wordflex_carousel' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wordflex-carousel.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wordflex_carousel() {

	$plugin = new Wordflex_Carousel();
	$plugin->run();

}
run_wordflex_carousel();
