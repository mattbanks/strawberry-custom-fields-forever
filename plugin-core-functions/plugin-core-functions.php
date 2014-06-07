<?php
/**
 * Plugin Name: Strawberry Custom Fields Forever - Core Functions
 * Plugin URI: http://mattbanks.me
 * Description: Use Core functions for creating metaboxes on posts
 * Version: 1.0
 * Author: Matt Banks
 * Author URI: http://mattbanks.me
 * License: GPL-2.0+
 */


/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function strawberryfields_add_meta_box() {

	add_meta_box(
		'strawberryfields_sectionid',
		__( 'Beatles Song for Post', 'strawberryfields_textdomain' ),
		'strawberryfields_meta_box_callback',
		'post'
	);

}
add_action( 'add_meta_boxes', 'strawberryfields_add_meta_box' );

/**
 * Prints the box content.
 *
 * @param WP_Post $post The object for the current post/page.
 */
function strawberryfields_meta_box_callback( $post ) {

	// Add an nonce field so we can check for it later.
	wp_nonce_field( 'strawberryfields_meta_box', 'strawberryfields_meta_box_nonce' );

	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	$value = get_post_meta( $post->ID, '_strawberry_fields_favorite_song', true );

	echo '<label for="strawberryfields_song_for_post">';
	_e( 'What Beatles song goes with this post?', 'strawberryfields_textdomain' );
	echo '</label> ';
	echo '<input type="text" id="strawberryfields_song_for_post" name="strawberryfields_song_for_post" value="' . esc_attr( $value ) . '" size="25" />';

}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function strawberryfields_save_meta_box_data( $post_id ) {

	/*
	 * We need to verify this came from our screen and with proper authorization,
	 * because the save_post action can be triggered at other times.
	 */

	// Check if our nonce is set.
	if ( ! isset( $_POST['strawberryfields_meta_box_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['strawberryfields_meta_box_nonce'], 'strawberryfields_meta_box' ) ) {
		return;
	}

	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Check the user's permissions.
	if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		}

	} else {

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}

	/* OK, its safe for us to save the data now. */

	// Make sure that it is set.
	if ( ! isset( $_POST['strawberryfields_song_for_post'] ) ) {
		return;
	}

	// Sanitize user input.
	$my_data = sanitize_text_field( $_POST['strawberryfields_song_for_post'] );

	// Update the meta field in the database.
	update_post_meta( $post_id, '_strawberry_fields_favorite_song', $my_data );
}
add_action( 'save_post', 'strawberryfields_save_meta_box_data' );

/*
 * Register our meta field so the REST API can access the data
 */
function strawberryfields_register_meta() {
	register_meta( 'post', _strawberry_fields_favorite_song, null, '__return_true' );
}
add_action( 'init', 'strawberryfields_register_meta' );
