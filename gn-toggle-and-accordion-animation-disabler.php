<?php
/**
 * GN Toggle and Accordion Animation Disabler
 *
 * @package       GNTOGGLEAN
 * @author        George Nicolaou & Atif Riaz
 * @license       gplv2
 * @version       1.0.1
 *
 * @wordpress-plugin
 * Plugin Name:   GN Toggle and Accordion Animation Disabler
 * Plugin URI:    https://www.georgenicolaou.me/plugins/gn-toggle-and-accordion-animation-disabler
 * Description:   A plugin that allows you to remove the Amination of the Divi Theme Toggle and Accordion Module
 * Version:       1.0.1
 * Author:        George Nicolaou & Atif Riaz
 * Author URI:    https://www.georgenicolaou.me/
 * Text Domain:   gn-toggle-and-accordion-animation-disabler
 * Domain Path:   /languages
 * License:       GPLv2
 * License URI:   https://www.gnu.org/licenses/gpl-2.0.html
 *
 * You should have received a copy of the GNU General Public License
 * along with GN Toggle and Accordion Animation Disabler. If not, see <https://www.gnu.org/licenses/gpl-2.0.html/>.
 */

// Exit if accessed directly.
if (!defined('ABSPATH'))
	exit;

/**
 * HELPER COMMENT START
 * 
 * This file contains the main information about the plugin.
 * It is used to register all components necessary to run the plugin.
 * 
 * The comment above contains all information about the plugin 
 * that are used by WordPress to differenciate the plugin and register it properly.
 * It also contains further PHPDocs parameter for a better documentation
 * 
 * The function GNTOGGLEAN() is the main function that you will be able to 
 * use throughout your plugin to extend the logic. Further information
 * about that is available within the sub classes.
 * 
 * HELPER COMMENT END
 */

// Plugin name
define('GNTOGGLEAN_NAME', 'GN Toggle and Accordion Animation Disabler');

// Plugin version
define('GNTOGGLEAN_VERSION', '1.0.0');

// Plugin Root File
define('GNTOGGLEAN_PLUGIN_FILE', __FILE__);

// Plugin base
define('GNTOGGLEAN_PLUGIN_BASE', plugin_basename(GNTOGGLEAN_PLUGIN_FILE));

// Plugin Folder Path
define('GNTOGGLEAN_PLUGIN_DIR', plugin_dir_path(GNTOGGLEAN_PLUGIN_FILE));

// Plugin Folder URL
define('GNTOGGLEAN_PLUGIN_URL', plugin_dir_url(GNTOGGLEAN_PLUGIN_FILE));

/**
 * Load the main class for the core functionality
 */
require_once GNTOGGLEAN_PLUGIN_DIR . 'core/class-gn-toggle-and-accordion-animation-disabler.php';

/**
 * The main function to load the only instance
 * of our master class.
 *
 * @author  George Nicolaou & Atif Riaz
 * @since   1.0.0
 * @return  object|Gn_Toggle_And_Accordion_Animation_Disabler
 */
function GNTOGGLEAN()
{
	return Gn_Toggle_And_Accordion_Animation_Disabler::instance();
}

function divi_accordion_check()
{
	// Check if Divi or a child theme of Divi is active
	$theme = wp_get_theme();
	$parent_theme = $theme->parent();
	$divi_active = ('Divi' == $theme->name || 'Divi' == $parent_theme->name);

	// If Divi is not active, display an admin notice and deactivate the plugin
	if (!$divi_active) {
		deactivate_plugins(plugin_basename(__FILE__));
		add_action('admin_notices', 'divi_accordion_admin_notice');
	}
}

function divi_accordion_admin_notice()
{
	echo '<div class="notice notice-error is-dismissible"><p>';
	echo sprintf(__('%s requires Divi or a child theme of Divi to be active. Please activate Divi or a Divi child theme and try again.', 'gn-toggle-and-accordion-animation-disabler'), DIVIACCORD_NAME);
	echo '</p></div>';
}

add_action('admin_init', 'divi_accordion_check');


GNTOGGLEAN();
GNTOGGLEAN()->disable_toggle_animation();