<?php
/**
 * Plugin Name: Strawberry Custom Fields Forever - Custom Metaboxes and Fields Functions
 * Plugin URI: http://mattbanks.me
 * Description: Use Custom Metaboxes and Fields functions for creating metaboxes on posts
 * Version: 1.0
 * Author: Matt Banks
 * Author URI: http://mattbanks.me
 * License: GPL-2.0+
 */


/**
 * Create our metabox on Pages
 */
function strawberryfields_sample_metaboxes( $meta_boxes ) {

	$prefix = '_cmb_'; // Prefix for all fields
	$meta_boxes['strawberryfields_metabox'] = array(
		'id' => 'strawberryfields_metabox',
		'title' => 'Contact Info',
		'pages' => array('page'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name' => 'Phone Number for Area',
				'desc' => __( 'Enter the phone number for contacting this area of the company', 'cmb' ),
				'id' => $prefix . 'phone_number',
				'type' => 'text'
			),
			array(
				'name' => __( 'Email for Area', 'cmb' ),
				'desc' => __( 'Enter the email address for contacting this area of the company', 'cmb' ),
				'id'   => $prefix . 'email',
				'type' => 'text_email',
			),
		),
	);

	return $meta_boxes;

}
add_filter( 'cmb_meta_boxes', 'strawberryfields_sample_metaboxes' );

/**
 * Initialize the metabox class
 */
function strawberryfields_initialize_cmb_meta_boxes() {

	if ( !class_exists( 'cmb_Meta_Box' ) ) {
		require_once( 'lib/metabox/init.php' );
	}

}
add_action( 'init', 'strawberryfields_initialize_cmb_meta_boxes', 9999 );
