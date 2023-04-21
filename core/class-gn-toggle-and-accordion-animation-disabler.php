<?php

// Exit if accessed directly.
if (!defined('ABSPATH'))
	exit;

/**
 * HELPER COMMENT START
 * 
 * This is the main class that is responsible for registering
 * the core functions, including the files and setting up all features. 
 * 
 * To add a new class, here's what you need to do: 
 * 1. Add your new class within the following folder: core/includes/classes
 * 2. Create a new variable you want to assign the class to (as e.g. public $helpers)
 * 3. Assign the class within the instance() function ( as e.g. self::$instance->helpers = new Gn_Toggle_And_Accordion_Animation_Disabler_Helpers();)
 * 4. Register the class you added to core/includes/classes within the includes() function
 * 
 * HELPER COMMENT END
 */

if (!class_exists('Gn_Toggle_And_Accordion_Animation_Disabler')):

	/**
	 * Main Gn_Toggle_And_Accordion_Animation_Disabler Class.
	 *
	 * @package		GNTOGGLEAN
	 * @subpackage	Classes/Gn_Toggle_And_Accordion_Animation_Disabler
	 * @since		1.0.0
	 * @author		George Nicolaou & Atif Riaz
	 */
	final class Gn_Toggle_And_Accordion_Animation_Disabler
	{

		/**
		 * The real instance
		 *
		 * @access	private
		 * @since	1.0.0
		 * @var		object|Gn_Toggle_And_Accordion_Animation_Disabler
		 */
		private static $instance;

		/**
		 * GNTOGGLEAN helpers object.
		 *
		 * @access	public
		 * @since	1.0.0
		 * @var		object|Gn_Toggle_And_Accordion_Animation_Disabler_Helpers
		 */
		public $helpers;

		/**
		 * GNTOGGLEAN settings object.
		 *
		 * @access	public
		 * @since	1.0.0
		 * @var		object|Gn_Toggle_And_Accordion_Animation_Disabler_Settings
		 */
		public $settings;

		/**
		 * Throw error on object clone.
		 *
		 * Cloning instances of the class is forbidden.
		 *
		 * @access	public
		 * @since	1.0.0
		 * @return	void
		 */
		public function __clone()
		{
			_doing_it_wrong(__FUNCTION__, __('You are not allowed to clone this class.', 'gn-toggle-and-accordion-animation-disabler'), '1.0.0');
		}

		/**
		 * Disable unserializing of the class.
		 *
		 * @access	public
		 * @since	1.0.0
		 * @return	void
		 */
		public function __wakeup()
		{
			_doing_it_wrong(__FUNCTION__, __('You are not allowed to unserialize this class.', 'gn-toggle-and-accordion-animation-disabler'), '1.0.0');
		}

		/**
		 * Main Gn_Toggle_And_Accordion_Animation_Disabler Instance.
		 *
		 * Insures that only one instance of Gn_Toggle_And_Accordion_Animation_Disabler exists in memory at any one
		 * time. Also prevents needing to define globals all over the place.
		 *
		 * @access		public
		 * @since		1.0.0
		 * @static
		 * @return		object|Gn_Toggle_And_Accordion_Animation_Disabler	The one true Gn_Toggle_And_Accordion_Animation_Disabler
		 */
		public static function instance()
		{
			if (!isset(self::$instance) && !(self::$instance instanceof Gn_Toggle_And_Accordion_Animation_Disabler)) {
				self::$instance = new Gn_Toggle_And_Accordion_Animation_Disabler;
				self::$instance->base_hooks();
				self::$instance->includes();
				self::$instance->helpers = new Gn_Toggle_And_Accordion_Animation_Disabler_Helpers();
				self::$instance->settings = new Gn_Toggle_And_Accordion_Animation_Disabler_Settings();

				//Fire the plugin logic
				new Gn_Toggle_And_Accordion_Animation_Disabler_Run();

				/**
				 * Fire a custom action to allow dependencies
				 * after the successful plugin setup
				 */
				do_action('GNTOGGLEAN/plugin_loaded');
			}

			return self::$instance;
		}

		/**
		 * Include required files.
		 *
		 * @access  private
		 * @since   1.0.0
		 * @return  void
		 */
		private function includes()
		{
			require_once GNTOGGLEAN_PLUGIN_DIR . 'core/includes/classes/class-gn-toggle-and-accordion-animation-disabler-helpers.php';
			require_once GNTOGGLEAN_PLUGIN_DIR . 'core/includes/classes/class-gn-toggle-and-accordion-animation-disabler-settings.php';

			require_once GNTOGGLEAN_PLUGIN_DIR . 'core/includes/classes/class-gn-toggle-and-accordion-animation-disabler-run.php';
		}

		/**
		 * Add base hooks for the core functionality
		 *
		 * @access  private
		 * @since   1.0.0
		 * @return  void
		 */
		private function base_hooks()
		{
			add_action('plugins_loaded', array(self::$instance, 'load_textdomain'));
		}

		/**
		 * Loads the plugin language files.
		 *
		 * @access  public
		 * @since   1.0.0
		 * @return  void
		 */
		public function load_textdomain()
		{
			load_plugin_textdomain('gn-toggle-and-accordion-animation-disabler', FALSE, dirname(plugin_basename(GNTOGGLEAN_PLUGIN_FILE)) . '/languages/');
		}

		/**
		 * Disable accordion toggle animation
		 */
		public function disable_toggle_animation()
		{
			add_action('wp_footer', function () {
				?>
				<script>
					(function ($) {
						$(document).ready(function () {
							//Loop through all the toggles and set up initial states 
							$('.et_pb_toggle_title').each(function () {
								//Remove default toggle content class
								$(this).next().removeClass('et_pb_toggle_content');
								$(this).next().addClass('gn_toggle_content');
							});

							//Add event listener to toggle titles
							$('.et_pb_toggle_title').click(function () {
								//Check if the toggle needs to be opened or closed by parent class
								if ($(this).parent().hasClass('et_pb_toggle_open')) {
									//Close the toggle
									$(this).parent().removeClass('et_pb_toggle_open');
									$(this).parent().addClass('et_pb_toggle_close');
									//console.log('Toggle closed');
								} else {
									//Open the toggle
									$(this).parent().removeClass('et_pb_toggle_close');
									$(this).parent().addClass('et_pb_toggle_open');
									//console.log('Toggle opened');
								}

							});

						});
						//console.log('Accordion toggle animation disabled.');
					})(jQuery);
				</script>
				<?php
			});
		}
	}

endif; // End if class_exists check.