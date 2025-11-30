<?php

$global_available_settings = get_option('faw_widget_settings');

if ( array_key_exists( 'faw_global_available', $global_available_settings ) ) {
	$globalavailabledate = esc_attr( $global_available_settings['faw_global_available'] );
}

if ( array_key_exists( 'faw_global_available_soon', $global_available_settings ) ) {
	$globalavailabledatesoon = esc_attr( $global_available_settings['faw_global_available_soon'] );
}

if (array_key_exists('widgetAvailableGlobalDateOverride', $attributes)) {
	$availabledate = $attributes['widgetAvailableGlobalDateOverride'] ? $attributes['widgetAvailableDate'] : $globalavailabledate;
} else {
	$availabledate = $globalavailabledate;
}

if (array_key_exists('widgetSoonGlobalDateOverride', $attributes)) {
	$soondate = $attributes['widgetSoonGlobalDateOverride']      ? $attributes['widgetSoonDate'] : $globalavailabledatesoon;
} else {
	$soondate = $globalavailabledatesoon;
}

$avialability = faw_get_data_to_return($availabledate, $soondate);

if ('available' == $avialability) {
	$title      = $attributes['widgetAvailableTitle'];
	$text       = $attributes['widgetAvailableText'];
	$buttontext = array_key_exists( 'widgetAvailableButtonText', $attributes ) ? $attributes['widgetAvailableButtonText'] : false;
	$buttonurl  = $attributes['widgetAvailableURL'];
} elseif ('soon' == $avialability) {
	$title = $attributes['widgetSoonTitle'];
	$text  = $attributes['widgetSoonText'];
	$buttontext = array_key_exists( 'widgetSoonButtonText', $attributes ) ? $attributes['widgetSoonButtonText'] : false;
	$buttonurl  = $attributes['widgetSoonURL'];
} else {
	$title = $attributes['widgetUnavailableTitle'];
	$text  = $attributes['widgetUnavailableText'];
	$buttontext = false;
	$buttonurl  = false;
}
?>
<div class="freelance-availability-widget freelance-availability-widget-<?php echo $avialability; ?> widget_faw_freelance_availability_widget_<?php echo $avialability; ?>" <?php echo get_block_wrapper_attributes(); ?>>
	<h3><?php echo esc_attr($title); ?></h3>
	<p>
		<?php echo esc_attr($text); ?>
	</p>
	<?php

	if ('unavailable' != $avialability) {

		if ($buttontext && $buttonurl) {
	?>
			<div class="wp-block-buttons is-layout-flex">
				<div class="wp-block-button"><a href="<?php echo esc_attr( $buttonurl ); ?>" class="wp-block-button__link wp-element-button faw-availablity-button faw-availablity-button-<?php echo $avialability; ?>"><?php echo esc_attr( $buttontext ); ?></a></div>
			</div>
	<?php
		}
	}
	?>
</div>