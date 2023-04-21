<?php

// Exit if accessed directly.
if (!defined('ABSPATH'))
	exit;
if (!class_exists('Divi_Accordion_Speed_Adjuster')):

	/**
	 * Main Divi_Accordion_Speed_Adjuster Class.
	 *
	 * @package		DIVIACCORD
	 * @subpackage	Classes/Divi_Accordion_Speed_Adjuster
	 * @since		1.0.0
	 * @author		George Nicolaou
	 */
	final class Divi_Accordion_Speed_Adjuster
	{

		/**
		 * The real instance
		 *
		 * @access	private
		 * @since	1.0.0
		 * @var		object|Divi_Accordion_Speed_Adjuster
		 */
		private static $instance;

		/**
		 * DIVIACCORD helpers object.
		 *
		 * @access	public
		 * @since	1.0.0
		 * @var		object|Divi_Accordion_Speed_Adjuster_Helpers
		 */
		public $helpers;

		/**
		 * DIVIACCORD settings object.
		 *
		 * @access	public
		 * @since	1.0.0
		 * @var		object|Divi_Accordion_Speed_Adjuster_Settings
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
			_doing_it_wrong(__FUNCTION__, __('You are not allowed to clone this class.', 'gn-accordion-animation-disabler'), '1.0.0');
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
			_doing_it_wrong(__FUNCTION__, __('You are not allowed to unserialize this class.', 'gn-accordion-animation-disabler'), '1.0.0');
		}

		/**
		 * Main Divi_Accordion_Speed_Adjuster Instance.
		 *
		 * Insures that only one instance of Divi_Accordion_Speed_Adjuster exists in memory at any one
		 * time. Also prevents needing to define globals all over the place.
		 *
		 * @access		public
		 * @since		1.0.0
		 * @static
		 * @return		object|Divi_Accordion_Speed_Adjuster	The one true Divi_Accordion_Speed_Adjuster
		 */
		public static function instance()
		{
			if (!isset(self::$instance) && !(self::$instance instanceof Divi_Accordion_Speed_Adjuster)) {
				self::$instance = new Divi_Accordion_Speed_Adjuster;
				self::$instance->base_hooks();
				self::$instance->includes();
				self::$instance->helpers = new Divi_Accordion_Speed_Adjuster_Helpers();
				self::$instance->settings = new Divi_Accordion_Speed_Adjuster_Settings();

				//Fire the plugin logic
				new Divi_Accordion_Speed_Adjuster_Run();

				/**
				 * Fire a custom action to allow dependencies
				 * after the successful plugin setup
				 */
				do_action('DIVIACCORD/plugin_loaded');
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
			require_once DIVIACCORD_PLUGIN_DIR . 'core/includes/classes/class-gn-accordion-animation-disabler-helpers.php';
			require_once DIVIACCORD_PLUGIN_DIR . 'core/includes/classes/class-gn-accordion-animation-disabler-settings.php';
			require_once DIVIACCORD_PLUGIN_DIR . 'core/includes/classes/class-gn-accordion-animation-disabler-run.php';
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
			load_plugin_textdomain('gn-accordion-animation-disabler', FALSE, dirname(plugin_basename(DIVIACCORD_PLUGIN_FILE)) . '/languages/');
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
									console.log('Toggle closed');
								} else {
									//Open the toggle
									$(this).parent().removeClass('et_pb_toggle_close');
									$(this).parent().addClass('et_pb_toggle_open');
									console.log('Toggle opened');
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