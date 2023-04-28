<?php

/**
 * Enqueue The Datepicker Script
 *
 * @return void
 */
function faw_enqueue_datepicker() {

	wp_enqueue_script( 'faw-datepicker', FAW_PLUGIN_URL . '/inc/legacy/js/datepicker-script.js', array( 'jquery-ui-datepicker', 'jquery' ), FAW_PLUGIN_VERSION );
	wp_enqueue_style( 'jquery-ui', FAW_PLUGIN_URL . '/inc/legacy/css/jquery-ui.min.css' );
	wp_enqueue_style( 'jquery-ui-structure', FAW_PLUGIN_URL . '/inc/legacy/css/jquery-ui.structure.min.css' );
	wp_enqueue_style( 'jquery-ui-theme', FAW_PLUGIN_URL . '/inc/legacy/css/jquery-ui.min.css' );

} add_action( 'admin_enqueue_scripts', 'faw_enqueue_datepicker' );