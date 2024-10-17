<?php
/*
Plugin Name: Simple Country Switcher for WooCommerce
Description: Adds a custom WooCommerce country selector using a shortcode, and updates the country information in the user session.
Version: 1.1
Author: Thomas Bastide / o3digital
Author URI: https://o3digital.fr
License: GPL2
*/

// Add Shortcode country selector
function country_selector_function()
{

    if (!class_exists('WooCommerce')) {
        return 'WooCommerce is required for this plugin to work.';
    }

    $countries = WC()->countries->get_allowed_countries();
    $selected_country = WC()->customer->get_billing_country();
    ob_start();

?>
    <label for="my_custom_countries_field"><?php esc_html_e('Select your country:', 'simple-country-switcher-for-woocommerce'); ?></label>
    <select name="billing_country" id="my_custom_countries_field">
        <?php foreach ($countries as $country_code => $country_name) : ?>
            <option value="<?php echo esc_attr($country_code); ?>" <?php selected($selected_country, $country_code); ?>>
                <?php echo esc_html($country_name); ?>
            </option>
        <?php endforeach; ?>
    </select>
<?php

    $view = ob_get_clean();

    return $view;
}
add_shortcode('country_selector', 'country_selector_function');

// Enqueue script for country selector functionality
function enqueue_global_country_selector_script()
{
    if (!class_exists('WooCommerce')) {
        return;
    }
    global $post;

    wp_enqueue_script('jquery');
    wp_enqueue_script('country-selector-script', plugins_url('/js/country-selector.js', __FILE__), array('jquery'), '1.1', true);
    // Localize script with AJAX parameters
    wp_localize_script('country-selector-script', 'wc_checkout_params', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'update_country_nonce' => wp_create_nonce('update_country_nonce')
    ));
}
add_action('wp_enqueue_scripts', 'enqueue_global_country_selector_script');

// Update billing and shipping country in WooCommerce session
function update_billing_country_globally()
{
    check_ajax_referer('update_country_nonce', 'security');

    if (isset($_POST['country'])) {
        if (!class_exists('WooCommerce') || !WC()->customer) {
            wp_send_json_error('WooCommerce not loaded or customer not found.');
        }

        $selected_country = sanitize_text_field(wp_unslash($_POST['country']));
        WC()->customer->set_billing_country($selected_country);
        WC()->customer->set_shipping_country($selected_country);
        WC()->customer->save();

        wp_send_json_success();
    } else {
        wp_send_json_error('Country not set.');
    }

    wp_die();
}
add_action('wp_ajax_update_country', 'update_billing_country_globally');
add_action('wp_ajax_nopriv_update_country', 'update_billing_country_globally');

// Enqueue wc_checkout_params with nonce for security
function enqueue_wc_checkout_params()
{
    if (is_checkout() || is_cart() || has_shortcode(get_post()->post_content, 'country_selector')) {
        wp_localize_script('country-selector-script', 'wc_checkout_params', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'update_country_nonce' => wp_create_nonce('update_country_nonce')
        ));
    }
}
add_action('wp_enqueue_scripts', 'enqueue_wc_checkout_params');
