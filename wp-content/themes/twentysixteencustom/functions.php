<?php
/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Twenty Sixteen 1.0

 * Enqueues scripts and styles.
 *
 * @since Twenty Sixteen 1.0
 */

function twentysixteen_scripts_rra() {
	if ( is_page( $page = array('jQuery-Add')))
	{
		wp_enqueue_style( 'jquery_add_css', get_template_directory_uri() . '/css/jquery_add.css',true,'1.0','all');
		wp_enqueue_script( 'jquery_add_js', get_template_directory_uri() . '/js/jquery_add.js', array( 'jquery', 'jquery-effects-core' ), '1.0', true );
	}
}
add_action( 'wp_enqueue_scripts', 'twentysixteen_scripts_rra' );
