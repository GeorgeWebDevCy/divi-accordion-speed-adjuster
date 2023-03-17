<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;
if ( ! class_exists( 'Divi_Accordion_Speed_Adjuster' ) ) :

	/**
	 * Main Divi_Accordion_Speed_Adjuster Class.
	 *
	 * @package		DIVIACCORD
	 * @subpackage	Classes/Divi_Accordion_Speed_Adjuster
	 * @since		1.0.0
	 * @author		George Nicolaou
	 */
	final class Divi_Accordion_Speed_Adjuster {

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
		public function __clone() {
			_doing_it_wrong( __FUNCTION__, __( 'You are not allowed to clone this class.', 'divi-accordion-speed-adjuster' ), '1.0.0' );
		}

		/**
		 * Disable unserializing of the class.
		 *
		 * @access	public
		 * @since	1.0.0
		 * @return	void
		 */
		public function __wakeup() {
			_doing_it_wrong( __FUNCTION__, __( 'You are not allowed to unserialize this class.', 'divi-accordion-speed-adjuster' ), '1.0.0' );
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
		public static function instance() {
			if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Divi_Accordion_Speed_Adjuster ) ) {
				self::$instance					= new Divi_Accordion_Speed_Adjuster;
				self::$instance->base_hooks();
				self::$instance->includes();
				self::$instance->helpers		= new Divi_Accordion_Speed_Adjuster_Helpers();
				self::$instance->settings		= new Divi_Accordion_Speed_Adjuster_Settings();

				//Fire the plugin logic
				new Divi_Accordion_Speed_Adjuster_Run();

				/**
				 * Fire a custom action to allow dependencies
				 * after the successful plugin setup
				 */
				do_action( 'DIVIACCORD/plugin_loaded' );
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
		private function includes() {
			require_once DIVIACCORD_PLUGIN_DIR . 'core/includes/classes/class-divi-accordion-speed-adjuster-helpers.php';
			require_once DIVIACCORD_PLUGIN_DIR . 'core/includes/classes/class-divi-accordion-speed-adjuster-settings.php';

			require_once DIVIACCORD_PLUGIN_DIR . 'core/includes/classes/class-divi-accordion-speed-adjuster-run.php';
		}

		/**
		 * Add base hooks for the core functionality
		 *
		 * @access  private
		 * @since   1.0.0
		 * @return  void
		 */
		private function base_hooks() {
			add_action( 'plugins_loaded', array( self::$instance, 'load_textdomain' ) );
		}

		/**
		 * Loads the plugin language files.
		 *
		 * @access  public
		 * @since   1.0.0
		 * @return  void
		 */
		public function load_textdomain() {
			load_plugin_textdomain( 'divi-accordion-speed-adjuster', FALSE, dirname( plugin_basename( DIVIACCORD_PLUGIN_FILE ) ) . '/languages/' );
		}

	}

endif; // End if class_exists check.