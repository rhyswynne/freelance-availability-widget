<?php

/**
 * Preload the LCP Enqueue on the correct page
 *
 * @return void
 */
function faw_enqueue_on_option_page() {
    add_action( 'admin_enqueue_scripts', 'faw_custom_admin_style' );
}


/**
 * Register and enqueue a the Custom LCP Stylesheet in the WordPress admin.
 *
 * @return void
 */
function faw_custom_admin_style() {
    wp_register_style( 'faw_css', FAW_PLUGIN_URL . '/inc/css/admin-style.css', false, '1.0.0' );
    wp_enqueue_style( 'faw_css' );
}
