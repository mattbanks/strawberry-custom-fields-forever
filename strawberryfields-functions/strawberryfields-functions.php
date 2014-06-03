<?php
/**
 * Plugin Name: Strawberry Custom Fields Forever Functionality
 * Plugin URI: http://mattbanks.me
 * Description: Custom post types for Strawberry Custom Fields Forever talk.
 * Version: 1.0
 * Author: Matt Banks
 * Author URI: http://mattbanks.me
 * License: GPL-2.0+
 */


/**
 * Register Portfolio Post Type
 */
function strawberryfields_register_portfolio() {
	$labels = array(
		'name'               => _x( 'Portfolio', 'post type general name', 'strawberryfields' ),
		'singular_name'      => _x( 'Portfolio', 'post type singular name', 'strawberryfields' ),
		'menu_name'          => _x( 'Portfolio', 'admin menu', 'strawberryfields' ),
		'name_admin_bar'     => _x( 'Portfolio', 'add new on admin bar', 'strawberryfields' ),
		'add_new'            => _x( 'Add New', 'Portfolio', 'strawberryfields' ),
		'add_new_item'       => __( 'Add New Portfolio', 'strawberryfields' ),
		'new_item'           => __( 'New Portfolio', 'strawberryfields' ),
		'edit_item'          => __( 'Edit Portfolio', 'strawberryfields' ),
		'view_item'          => __( 'View Portfolio', 'strawberryfields' ),
		'all_items'          => __( 'All Portfolio', 'strawberryfields' ),
		'search_items'       => __( 'Search Portfolio', 'strawberryfields' ),
		'parent_item_colon'  => __( 'Parent Portfolio:', 'strawberryfields' ),
		'not_found'          => __( 'No portfolio found.', 'strawberryfields' ),
		'not_found_in_trash' => __( 'No portfolio found in Trash.', 'strawberryfields' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'portfolio' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'menu_icon'          => 'dashicons-art',
		'supports'           => array( 'title', 'editor', 'revisions' ),
		'description'        => __( 'Portfolio Items', 'strawberryfields' ),
	);

	register_post_type( 'portfolio', $args );
}
add_action( 'init', 'strawberryfields_register_portfolio' );
