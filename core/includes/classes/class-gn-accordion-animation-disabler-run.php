<?php

// Exit if accessed directly.
if (!defined('ABSPATH'))
	exit;

/**
 * Class Divi_Accordion_Speed_Adjuster_Run
 *
 * Thats where we bring the plugin to life
 *
 * @package		DIVIACCORD
 * @subpackage	Classes/Divi_Accordion_Speed_Adjuster_Run
 * @author		George Nicolaou
 * @since		1.0.0
 */
class Divi_Accordion_Speed_Adjuster_Run
{

	/**
	 * Our Divi_Accordion_Speed_Adjuster_Run constructor 
	 * to run the plugin logic.
	 *
	 * @since 1.0.0
	 */
	function __construct()
	{
		$this->add_hooks();
	}

	/**
	 * ######################
	 * ###
	 * #### WORDPRESS HOOKS
	 * ###
	 * ######################
	 */

	/**
	 * Registers all WordPress and plugin related hooks
	 *
	 * @access	private
	 * @since	1.0.0
	 * @return	void
	 */
	private function add_hooks()
	{

		add_action('admin_enqueue_scripts', array($this, 'enqueue_backend_scripts_and_styles'), 20);
		add_action('wp_enqueue_scripts', array($this, 'enqueue_frontend_scripts_and_styles'), 20);

	}

	/**
	 * ######################
	 * ###
	 * #### WORDPRESS HOOK CALLBACKS
	 * ###
	 * ######################
	 */

	/**
	 * Enqueue the backend related scripts and styles for this plugin.
	 * All of the added scripts andstyles will be available on every page within the backend.
	 *
	 * @access	public
	 * @since	1.0.0
	 *
	 * @return	void
	 */
	public function enqueue_backend_scripts_and_styles()
	{
		wp_enqueue_style('diviaccord-backend-styles', DIVIACCORD_PLUGIN_URL . 'core/includes/assets/css/backend-styles.css', array(), DIVIACCORD_VERSION, 'all');
		wp_enqueue_script('diviaccord-backend-scripts', DIVIACCORD_PLUGIN_URL . 'core/includes/assets/js/backend-scripts.js', array(), DIVIACCORD_VERSION, false);
		wp_localize_script('diviaccord-backend-scripts', 'diviaccord', array(
			'plugin_name' => __(DIVIACCORD_NAME, 'gn-accordion-animation-disabler'),
		)
		);
	}

	/**
	 * Enqueue the frontend related scripts and styles for this plugin.
	 * All of the added scripts andstyles will be available on every page within the frontend.
	 *
	 * @access	public
	 * @since	1.0.0
	 *
	 * @return	void
	 */
	public function enqueue_frontend_scripts_and_styles()
	{
		wp_enqueue_style('diviaccord-frontend-styles', DIVIACCORD_PLUGIN_URL . 'core/includes/assets/css/frontend-styles.css', array(), DIVIACCORD_VERSION, 'all');
	}

}