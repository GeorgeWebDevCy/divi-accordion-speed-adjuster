<?php

// Exit if accessed directly.
if (!defined('ABSPATH'))
	exit;

/**
 * Class Divi_Accordion_Speed_Adjuster_Settings
 *
 * This class contains all of the plugin settings.
 * Here you can configure the whole plugin data.
 *
 * @package		DIVIACCORD
 * @subpackage	Classes/Divi_Accordion_Speed_Adjuster_Settings
 * @author		George Nicolaou
 * @since		1.0.0
 */
class Divi_Accordion_Speed_Adjuster_Settings
{

	/**
	 * The plugin name
	 *
	 * @var		string
	 * @since   1.0.0
	 */
	private $plugin_name;

	/**
	 * Our Divi_Accordion_Speed_Adjuster_Settings constructor 
	 * to run the plugin logic.
	 *
	 * @since 1.0.0
	 */
	function __construct()
	{

		$this->plugin_name = DIVIACCORD_NAME;
	}

	/**
	 * ######################
	 * ###
	 * #### CALLABLE FUNCTIONS
	 * ###
	 * ######################
	 */

	/**
	 * Return the plugin name
	 *
	 * @access	public
	 * @since	1.0.0
	 * @return	string The plugin name
	 */
	public function get_plugin_name()
	{
		return apply_filters('DIVIACCORD/settings/get_plugin_name', $this->plugin_name);
	}
}