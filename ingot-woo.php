<?php
/**
 Plugin Name: Ingot - WooCommerce
 Version: 1.0.0
Plugin URI:  http://IngotHQ.com
Description: WooCommerce for Ingot
Author:      Ingot LLC
Author URI:  http://IngotHQ.com
 */
use ingot\addon\woo\add_destinations;
use ingot\addon\woo\tracking;

/**
 * Copyright 2016 Ingot LLC
 *
 * Licensed under the terms of the GNU General Public License version 2 or later
 */

/**
 * Make add-on go if not already loaded
 */
add_action( 'ingot_before', function(){
	if( ! defined( 'INGOT_WOO_VER' ) ) {
		define( 'INGOT_WOO_VER', '1.0.0' );
		require_once dirname( __FILE__ ) . '/vendor/autoload.php';
		new add_destinations();
		new tracking();
	}

});
