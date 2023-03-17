<?php
/**
 * Divi Accordion Speed Adjuster
 *
 * @package       DIVIACCORD
 * @author        George Nicolaou
 * @license       gplv2
 * @version       1.0.0
 *
 * @wordpress-plugin
 * Plugin Name:   Divi Accordion Speed Adjuster
 * Plugin URI:    https://www.georgenicolaou.me/plugins/divi-accordion-speed-adjuster
 * Description:   A plugin that allows you to adjust the speed of the Divi Theme Accordion Module
 * Version:       1.0.0
 * Author:        George Nicolaou
 * Author URI:    https://www.georgenicolaou.me/
 * Text Domain:   divi-accordion-speed-adjuster
 * Domain Path:   /languages
 * License:       GPLv2
 * License URI:   https://www.gnu.org/licenses/gpl-2.0.html
 *
 * You should have received a copy of the GNU General Public License
 * along with Divi Accordion Speed Adjuster. If not, see <https://www.gnu.org/licenses/gpl-2.0.html/>.
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;
// Plugin name
define( 'DIVIACCORD_NAME',			'Divi Accordion Speed Adjuster' );

// Plugin version
define( 'DIVIACCORD_VERSION',		'1.0.0' );

// Plugin Root File
define( 'DIVIACCORD_PLUGIN_FILE',	__FILE__ );

// Plugin base
define( 'DIVIACCORD_PLUGIN_BASE',	plugin_basename( DIVIACCORD_PLUGIN_FILE ) );

// Plugin Folder Path
define( 'DIVIACCORD_PLUGIN_DIR',	plugin_dir_path( DIVIACCORD_PLUGIN_FILE ) );

// Plugin Folder URL
define( 'DIVIACCORD_PLUGIN_URL',	plugin_dir_url( DIVIACCORD_PLUGIN_FILE ) );

/**
 * Load the main class for the core functionality
 */
require_once DIVIACCORD_PLUGIN_DIR . 'core/class-divi-accordion-speed-adjuster.php';

/**
 * The main function to load the only instance
 * of our master class.
 *
 * @author  George Nicolaou
 * @since   1.0.0
 * @return  object|Divi_Accordion_Speed_Adjuster
 */
function DIVIACCORD() {
	return Divi_Accordion_Speed_Adjuster::instance();
}

DIVIACCORD();
