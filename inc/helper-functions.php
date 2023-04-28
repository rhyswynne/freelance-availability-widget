<?php

/**
 * Sets the information to display
 *
 * @param  string $availabledate The date where the freelancer is available
 * @param  string $soondate      The date where the freelancer will soon be available
 * @return string                'soon', 'available' or 'unavailable'
 */
function faw_get_data_to_return( $availabledate, $soondate ) {
    //echo '<!-- Available Date: ' . $availabledate  . '-->';
    $availabletimestamp = strtotime( $availabledate );
    $soontimestamp      = strtotime( $soondate );
    $currenttime        = time();

    if ( $currenttime > $availabletimestamp ) {
        return 'available';
    } elseif ( $currenttime > $soontimestamp && $currenttime <= $availabletimestamp ) {
        return 'soon';
    } else {
        return 'unavailable';
    }
}