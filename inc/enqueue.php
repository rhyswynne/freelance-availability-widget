<?php

/**
 * Enqueue The Datepicker Script
 *
 * @return void
 */
function faw_enqueue_datepicker() {

	wp_enqueue_script( 'faw-datepicker', FAW_PLUGIN_URL . '/js/datepicker-script.js', array( 'jquery-ui-datepicker', 'jquery' ), FAW_PLUGIN_VERSION );
	//wp_enqueue_style( 'jquery-ui', FAW_PLUGIN_URL . '/css/jquery-ui.min.css' );
	//wp_enqueue_style( 'jquery-ui-theme', FAW_PLUGIN_URL . '/css/jquery-ui.theme.min.css' );

	wp_register_style('jquery-ui', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css');
	wp_enqueue_style( 'jquery-ui' ); 

} add_action( 'admin_enqueue_scripts', 'faw_enqueue_datepicker' );