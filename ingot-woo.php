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
		/**
		 * Freemius setup
		 *
		 * @since 1.0.0
		 *
		 * @return \Freemius
		 */
		function ingot_woo_fs() {
			global $ingot_woo_fs;

			if ( ! isset( $ingot_woo_fs ) ) {

				$ingot_woo_fs = fs_dynamic_init( array(
					'id'                => '224',
					'slug'              => 'woo',
					'public_key'        => 'pk_a5eba8754415c15021d9e5758cf4a',
					'is_premium'        => true,
					'has_paid_plans'    => true,
					'is_org_compliant'  => false,
					'parent'      => array(
						'id'         => '210',
						'slug'       => 'ingot',
						'public_key' => 'pk_e6a19a3508bdb9bdc91a7182c8e0c',
						'name'       => 'Ingot',
					),
				) );
			}

			return $ingot_woo_fs;
		}

		/**
		 * Boot Freemius integration
		 */
		add_action( 'ingot_loaded', 'ingot_woo_fs', 25 );

		/**
		 * Boot add on
		 */
		add_action( 'ingot_loaded', function(){
			if( ingot_is_woo_active() ) {
				new add_destinations();
				new tracking();
			}

		}, 26 );
	}

});
