<?php

/**
 * Register the Freelance Availablity Widget Options Menu
 * @return void
 */
function faw_options()
{
    $options_suffix = add_options_page('Freelance Availability Widget', 'Freelance Availability Widget', 'manage_options', 'freelanceavailabilitywidget', 'faw_options_page');
    add_action('load-' . $options_suffix, 'faw_enqueue_on_option_page');
}
add_action('admin_menu', 'faw_options');


function faw_settings_init()
{
    register_setting('faw_widget_settings', 'faw_widget_settings');
    add_settings_section(
        'faw_admin_section',
        __('', 'freelanceavailabilitywidget'),
        'faw_display_settings_callback',
        'faw_widget_settings'
    );

    add_settings_field(
        'faw_global_available',
        __('Date you are available for freelance work', 'freelanceavailablitywidget'),
        'faw_global_available_settings_render',
        'faw_widget_settings',
        'faw_admin_section'
    );

    add_settings_field(
        'faw_global_available_soon',
        __('Date to show the soon to be available for freelance work', 'freelanceavailablitywidget'),
        'faw_global_available_soon_settings_render',
        'faw_widget_settings',
        'faw_admin_section'
    );
}
add_action('admin_init', 'faw_settings_init');


/**
 * The display settings section callback
 * 
 * Blank because I haven't figured out another way to do this
 * @return void
 */
function faw_display_settings_callback()
{
}

/**
 * Render the post type settings option
 * 
 * @return void
 */
function faw_global_available_settings_render()
{

    $widget_settings = get_option('faw_widget_settings');

    $available       = '';

    if ($widget_settings) {
        if (array_key_exists('faw_global_available', $widget_settings)) {
            $available = esc_attr($widget_settings['faw_global_available']);
        }
    }

?>

    <input type="text" class="faw_custom_date" name="faw_widget_settings[faw_global_available]" value="<?php echo esc_attr($available); ?>">

    <p class="description"><?php _e('The global value for showing the "Date available for freelance work" content. Can be overridden in individual blocks and also used for the shortcode', 'freelanceavailablitywidget'); ?></p>
<?php
}


/**
 * Render the post type settings option
 * 
 * @return void
 */
function faw_global_available_soon_settings_render()
{

    $widget_settings = get_option('faw_widget_settings');
    $available_soon  = '';

    if ($widget_settings) {
        if (array_key_exists('faw_global_available_soon', $widget_settings)) {
            $available_soon = esc_attr($widget_settings['faw_global_available_soon']);
        }
    }
?>

    <input type="text" class="faw_custom_date" name="faw_widget_settings[faw_global_available_soon]" value="<?php echo esc_attr($available_soon); ?>">

    <p class="description"><?php _e('The global value for showing the "I am available for freelance work soon". Can be overridden in individual blocks and also used for the shortcode', 'freelanceavailablitywidget'); ?></p>
<?php
}

/**
 * Create and add the Preload LCP Options Page
 * 
 * @return void
 */
function faw_options_page()
{

    $current_user = wp_get_current_user();

?>
    <div class="dr_admin_wrap">
        <h1><?php _e('Freelance Availablity Widget', 'freelanceavailablitywidget'); ?></h1>

        <div class="dr_admin_main_wrap">
            <div class="dr_admin_wrap_left">

                <form method="post" action="options.php" id="options">

                    <?php

                    settings_fields('faw_widget_settings');
                    do_settings_sections('faw_widget_settings');
                    submit_button();

                    ?>

                </form>
            </div>
            <div class="dr_admin_wrap_right">
                <div class="dr_box dr_box_highlighted">
                    <h2><?php _e('Need Freelance Support?', 'preload_lcp'); ?></h2>
                    <p><img src="https://gravatar.com/avatar/13b432f781f24140731c6fe815e6d831?s=70&d=mm" alt="<?php _e('Rhys Wynne', 'preload_cp'); ?>" class="dr_avatar" />
                        <?php _e("Hello! Dwi'n Rhys (I am Rhys in Welsh), and I am an experienced WordPress developer from the United Kingdom. Overwhelmed with your WordPress site? Let's talk and see what I can do for you!", "freelanceavailabilitywidget"); ?>
                    </p>
                    <p><a href="https://dwinrhys.com/custom-wordpress-development/?utm_source=plugin-options&utm_medium=wordpress&utm_campaign=preload-lcp-image" target="_blank" class="dr_button dr_button_primary"><?php _e("Get WordPress Support", "freelanceavailabilitywidget"); ?></a>
                </div>
            </div>
        </div>

    </div>

<?php

}
