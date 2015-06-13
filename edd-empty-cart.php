<?php
/*
 * Plugin Name: Easy Digital Downloads - Empty Cart
 * Plugin URI: https://wordpress.org/plugins/easy-digital-downloads-empty-cart/
 * Description: Built for use with the Easy Digital Downloads plugin, this extension provides settings for the display of the [download_checkout] shortcode when no items are in the cart.
 * Version: 1.0.0
 * Author: Sean Davis
 * Author URI: http://sdavismedia.com
 * Text Domain: edd-empty-cart
 * Domain Path: /languages/
 *
 * @package         EDD\Empty Cart
 * @author          Sean Davis
 */

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) exit;

if( !class_exists( 'EDD_Empty_Cart' ) ) {


	/**
	 * Main plugin class
	 *
	 * @since 1.0.0
	 */
	class EDD_Empty_Cart {


		/**
		 * @var         EDD_Empty_Cart $instance The one true EDD_Empty_Cart
		 * @since       1.0.0
		 */
		private static $instance;


		/**
		 * Get active instance
		 *
		 * @access      public
		 * @since       1.0.0
		 * @return      object self::$instance The one true EDD_Empty_Cart
		 */
		public static function instance() {
			if( !self::$instance ) {
				self::$instance = new EDD_Empty_Cart();
				self::$instance->setup_constants();
				self::$instance->includes();
				self::$instance->load_textdomain();
				self::$instance->hooks();
			}
			return self::$instance;
		}


		/**
		 * Setup plugin constants
		 *
		 * @access      private
		 * @since       1.0.0
		 * @return      void
		 */
		private function setup_constants() {

			// Plugin version
			define( 'EDD_EMPTY_CART_VER', '1.0.0' );

			// Plugin path
			define( 'EDD_EMPTY_CART_DIR', plugin_dir_path( __FILE__ ) );

			// Plugin URL
			define( 'EDD_EMPTY_CART_URL', plugin_dir_url( __FILE__ ) );
		}


		/**
		 * Include necessary files
		 *
		 * @access      private
		 * @since       1.0.0
		 * @return      void
		 */ 
		private function includes() {

			// Include functions
			require_once EDD_EMPTY_CART_DIR . 'includes/functions.php';
			if( is_admin() ) {
				require_once EDD_EMPTY_CART_DIR . 'includes/settings.php';
			}
		}


		/**
		 * Run action and filter hooks
		 *
		 * @access      private
		 * @since       1.0.0
		 * @return      void
		 */
		private function hooks() {

			// Handle licensing
			if( class_exists( 'EDD_License' ) ) {
			    $license = new EDD_License( __FILE__, 'Easy Digital Downloads - Empty Cart', EDD_EMPTY_CART_VER, 'Sean Davis' );
			}
		}


		/**
		 * Internationalization
		 *
		 * @access      public
		 * @since       1.0.0
		 * @return      void
		 */
		public function load_textdomain() {

			// Set filter for language directory
			$lang_dir = EDD_EMPTY_CART_DIR . '/languages/';
			$lang_dir = apply_filters( 'edd_empty_cart_languages_directory', $lang_dir );

			// Traditional WordPress plugin locale filter
			$locale = apply_filters( 'plugin_locale', get_locale(), 'edd-empty-cart' );
			$mofile = sprintf( '%1$s-%2$s.mo', 'edd-empty-cart', $locale );

			// Setup paths to current locale file
			$mofile_local   = $lang_dir . $mofile;
			$mofile_global  = WP_LANG_DIR . '/edd-empty-cart/' . $mofile;

			if( file_exists( $mofile_global ) ) {
				// Look in global /wp-content/languages/edd-empty-cart/ folder
				load_textdomain( 'edd-empty-cart', $mofile_global );
			} elseif( file_exists( $mofile_local ) ) {
				// Look in local /wp-content/plugins/edd-empty-cart/languages/ folder
				load_textdomain( 'edd-empty-cart', $mofile_local );
			} else {
				// Load the default language files
				load_plugin_textdomain( 'edd-empty-cart', false, $lang_dir );
			}
		}
	}
}


/**
 * The main function responsible for returning the one true EDD_Empty_Cart
 * instance to functions everywhere
 *
 * @since       1.0.0
 * @return      \EDD_Empty_Cart The one true EDD_Empty_Cart
 */
function EDD_Empty_Cart_load() {

	if( !class_exists( 'Easy_Digital_Downloads' ) ) {
		if( !class_exists( 'EDD_Empty_Cart_Activation' ) ) {
			require_once 'includes/class.edd-empty-cart-activation.php';
		}

		$activation = new EDD_Empty_Cart_Activation( plugin_dir_path( __FILE__ ), basename( __FILE__ ) );
		$activation = $activation->run();
		return EDD_Empty_Cart::instance();
	} else {
		return EDD_Empty_Cart::instance();
	}
}
add_action( 'plugins_loaded', 'EDD_Empty_Cart_load' );