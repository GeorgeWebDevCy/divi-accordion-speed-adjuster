<?php
/**
 * GN Accordion Animation Disabler
 *
 * @package       DIVIACCORD
 * @author        George Nicolaou & Atif Riaz
 * @license       gplv2
 * @version       1.0.2
 *
 * Plugin Name:   GN Accordion Animation Disabler
 * Plugin URI:    https://www.georgenicolaou.me/plugins/gn-accordion-animation-disabler
 * Description:   A plugin that allows you to remove the speed of the Divi Theme Accordion Module
 * Version:       1.0.2
 * Author:        George Nicolaou & Atif Riaz
 * Author URI:    https://www.georgenicolaou.me/
 * Text Domain:   gn-accordion-animation-disabler
 * Domain Path:   /languages
 * License:       GPLv2
 * License URI:   https://www.gnu.org/licenses/gpl-2.0.html
 *
 * You should have received a copy of the GNU General Public License
 * along with GN Accordion Animation Disabler. If not, see <https://www.gnu.org/licenses/gpl-2.0.html/>.
 */

// Exit if accessed directly.
if (!defined('ABSPATH'))
    exit;

// Plugin name
define('DIVIACCORD_NAME', 'GN Accordion Animation Disabler');

// Plugin version
define('DIVIACCORD_VERSION', '1.0.2');

// Plugin Root File
define('DIVIACCORD_PLUGIN_FILE', __FILE__);

// Plugin base
define('DIVIACCORD_PLUGIN_BASE', plugin_basename(DIVIACCORD_PLUGIN_FILE));

// Plugin Folder Path
define('DIVIACCORD_PLUGIN_DIR', plugin_dir_path(DIVIACCORD_PLUGIN_FILE));

// Plugin Folder URL
define('DIVIACCORD_PLUGIN_URL', plugin_dir_url(DIVIACCORD_PLUGIN_FILE));

/**
 * Load the main class for the core functionality
 */
require_once DIVIACCORD_PLUGIN_DIR . 'core/class-gn-accordion-animation-disabler.php';

/**
 * The main function to load the only instance
 * of our master class.
 *
 * @author  George Nicolaou
 * @since   1.0.0
 * @return  object|Divi_Accordion_Speed_Adjuster
 */
function DIVIACCORD()
{
    return Divi_Accordion_Speed_Adjuster::instance();
}

function divi_accordion_check()
{
    // Check if Divi or a child theme of Divi is active
    $theme = wp_get_theme();
    $parent_theme = $theme->parent();
    $divi_active = ('Divi' == $theme->name || ($parent_theme && 'Divi' == $parent_theme->name));

    // If Divi is not active, display an admin notice and deactivate the plugin
    if (!$divi_active) {
        deactivate_plugins(plugin_basename(__FILE__));
        add_action('admin_notices', 'divi_accordion_admin_notice');
    }
}

function divi_accordion_admin_notice()
{
    echo '<div class="notice notice-error is-dismissible"><p>';
    echo sprintf(__('%s requires Divi or a child theme of Divi to be active. Please activate Divi or a Divi child theme and try again.', 'gn-accordion-animation-disabler'), DIVIACCORD_NAME);
    echo '</p></div>';
}

add_action('admin_init', 'divi_accordion_check');

DIVIACCORD();
DIVIACCORD()->disable_toggle_animation();