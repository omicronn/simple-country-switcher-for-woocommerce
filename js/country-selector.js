
jQuery(document).ready(function($) {
    // Check if the custom country field exists
    if ($('#my_custom_countries_field').length) {
        // Listen for changes on the custom country selector
        $('#my_custom_countries_field').change(function() {
            var selectedCountry = $(this).val();
            // Vérifier et mettre à jour le sélecteur de pays par défaut de WooCommerce si présent
                if ($('select#billing_country').length) {
                    $('select#billing_country').val(selectedCountry).trigger('change');
                }

                if ($('select#shipping_country').length) {
                    $('select#shipping_country').val(selectedCountry).trigger('change');
                }
            // Send an AJAX request to update the country
            $.ajax({
                type: 'POST',
                url: wc_checkout_params.ajax_url, // URL for the AJAX request
                data: {
                    action: 'update_country',
                    country: selectedCountry,
                    security: wc_checkout_params.update_country_nonce
                },
                success: function(response) {
                    if (response.success) {
                        location.reload(); // Reload the page to apply changes
                    } else {
                        console.error(response.data);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX error:', error);
                }
            });
        });
    }
});
