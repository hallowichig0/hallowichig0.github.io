<?php
/*
 * Plugin Name: Remove Customizer Menu
 * Plugin URI: https://wordpress.org/plugins/remove-customizer-menu/
 * Description: Remove Customizer Menu allow you to hide the navigation menu from the Customizer.
 * Version: 1.0.0
 * Author: Jayson Garcia (Github - hallowichig0)
 * Author URI: https://hallowichig0.github.io
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
*

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class RCM_Load {

	function __construct() {

		/* Set the constants needed by the plugin. */
		add_action( 'plugins_loaded', array( $this, 'constants' ), 1 );

		add_filter( 'customize_loaded_components', array( $this, 'rcm_remove_nav_menus_panel' ) );
	}
	
	function constants() {

		/* Set the version number of the plugin. */
		define( 'RCM_VERSION', '1.0.0' );

		/* Set constant path to the plugin URL. */
		define( 'RCM_URI', trailingslashit( plugin_dir_url( __FILE__ ) ) );

	}

	/**
	 * Removes the core 'Menus' panel from the Customizer.
	 */
	function rcm_remove_nav_menus_panel( $components ) {
		$i = array_search( 'nav_menus', $components );
		if ( false !== $i ) {
			unset( $components[ $i ] );
		}
		return $components;
	}
}

$rcm_load = new RCM_Load();
