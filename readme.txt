
# Simple Country Switcher for WooCommerce

**Tags:** WooCommerce, country switcher, checkout, user session, country selector  
**Requires at least:** 6.0  
**Tested up to:** 6.6.2  
**Requires PHP:** 7.2  
**Stable tag:** 1.1
**License:** GPLv2 or later  
**License URI:** https://www.gnu.org/licenses/gpl-2.0.html

WooCommerce Simple Country Switcher adds a custom WooCommerce country selector using a shortcode

## Description

WooCommerce Simple Country Switcher adds a custom WooCommerce country selector using a shortcode, allowing users to easily update their billing and shipping country information in their session. This plugin is especially useful for stores that serve customers from multiple countries, providing them with a simple dropdown to change their location.

The plugin automatically updates the WooCommerce session, ensuring that the selected country is applied globally for both billing and shipping purposes.

## Features

- Custom country selector using a shortcode `[country_selector]`.
- Updates WooCommerce billing and shipping country based on user selection.
- JavaScript functionality to apply changes instantly and reload the page.
- Works seamlessly with the WooCommerce checkout and cart pages.

## Installation

1. Upload the plugin files to the `/wp-content/plugins/woocommerce-simple-country-switcher` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress.
3. Use the shortcode `[country_selector]` in any page or post to display the country selector dropdown.

## Frequently Asked Questions

### Does this plugin require WooCommerce?
Yes, WooCommerce must be installed and activated for this plugin to work.

### How do I use the country selector?
Simply use the shortcode `[country_selector]` on any page or post where you want the country selector dropdown to appear.

### Can non-logged-in users use the country selector?
Yes, both logged-in and guest users can use the country selector. The selected country is saved in their session.

## Changelog

### 1.1
- Added nonce verification for security.
- Improved script enqueue logic to load JavaScript only on relevant pages.
- Added an external JavaScript file for better maintainability.
- Improved accessibility with label for the country selector.

### 1.0
- Initial release with country selector shortcode and AJAX functionality.

## Upgrade Notice

### 1.1
- Security improvements and better performance for script loading.

## License

This plugin is licensed under the GPLv2 or later. See [GNU General Public License](https://www.gnu.org/licenses/gpl-2.0.html) for more details.
