<?php

/**
 * Shortcode to the Availablity Date
 *
 * @param  array  $atts   The Shortcode attributes
 * @return string         The available string
 */
function faw_show_availability_date($atts)
{

    $attributes = shortcode_atts(array(
        'format' => false,
        'available-text' => ''
    ), $atts, 'faw_available_date');

    return faw_get_availability_string('available', $attributes['format'], $attributes['available-text']);
}
add_shortcode('faw_available_date', 'faw_show_availability_date');


/**
 * Shortcode to the Availablity soon Date
 *
 * @param  array  $atts   The Shortcode attributes
 * @return string         The available string
 */
function faw_show_soon_date($atts)
{

    $attributes = shortcode_atts(array(
        'format' => false,
        'available-text' => ''
    ), $atts, 'faw_available_date');

    return faw_get_availability_string('soon', $attributes['format'], $attributes['available-text'] );
}
add_shortcode('faw_soon_date', 'faw_show_soon_date');


/**
 * Get the Availablity date
 *
 * @param   string $date_type      Whether will looking at the 'available' or 'soon'
 * @param   string $format         The PHP date format for the availability date
 * @param   string $available_text The text to show if the available text/soon date has passed
 * 
 * @return  string             The availity date string
 */
function faw_get_availability_string($date_type, $format, $available_text = '' )
{
    $availability_string = '';

    if (!$format) {
        $format = get_option('date_format');
    }

    $global_available_settings = get_option('faw_widget_settings');

    if ('available' == $date_type) {
        if (array_key_exists('faw_global_available', $global_available_settings)) {
            $date_to_use = $global_available_settings['faw_global_available'];
        }
    }

    if ('soon' == $date_type) {
        if (array_key_exists('faw_global_available_soon', $global_available_settings)) {
            $date_to_use = $global_available_settings['faw_global_available_soon'];
        }
    }

    $timestamp_to_use = strtotime( $date_to_use );

    if ( $timestamp_to_use > 0 ) {
        $availability_string = date( $format, $timestamp_to_use );
    }

    $now_time = time();

    if ( $now_time > $timestamp_to_use ) {
        if ( $available_text != '' ) {
            $availability_string = $available_text;
        }
    }

    return $availability_string;
}
