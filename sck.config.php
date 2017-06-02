<?php

/*

---------------------------------------
SCK (Stripe Checkout for Kirby) Configuration
---------------------------------------

Provide BOTH sets of API keys for your Stripe account. These can be found in your Stripe Dashboard at: 

- https://dashboard.stripe.com/account/apikeys. 

By default, test mode is enabled. When you're ready to begin processing live charges, change this to `false`. No payments using real credit cards can be made when test mode is enabled. Instead, use the test card numbers provided by Stripe:

- https://stripe.com/docs/testing

*/

c::set('stripe_test_mode', true);
c::set('stripe_test_secret_key', '');
c::set('stripe_test_publishable_key', '');
c::set('stripe_live_secret_key', '');
c::set('stripe_live_publishable_key', '');

/* 

You can find a list of all supported currencies (and their abbreviation) at:

- https://support.stripe.com/questions/which-currencies-does-stripe-support

The currency symbol is whatever you want visitors to see and can be anything you want, either a symbol ($) or "USD".

Certain currencies have the symbol on the right-side of the amount (such as "kr"). Set 'stripe_currency_symbol_location' to either 'left' or 'right' (default is 'left').

*/ 

c::set('stripe_currency', 'eur');
c::set('stripe_currency_symbol', '€');
c::set('stripe_currency_symbol_location', 'left');

/*

"Remember Me" allows customers to save their card details wth Stripe to use again with any merchant that uses Checkout.

- https://stripe.com/checkout#onetap

*/ 

c::set('stripe_remember_me', true);

// You can also have Checkout collect shipping address details. SCK will pass this information along as metadata when creating the charge, so you can view it within the Stripe dashboard. 

c::set('stripe_shipping_address', true);

// Custom icon for Checkout. Default is false, though it's recommended that you specify one. Icon should be at least 128x128px and .gif, .jpeg, .png or .svg. 

c::set('stripe_icon', true);
c::set('stripe_icon_location', 'assets/images/logo.svg');

/* 

Stripe supports Alipay and Bitcoin payments through Checkout, but there are some restrictions. 

More information can be found at:

- https://stripe.com/bitcoin
- https://stripe.com/alipay

*/

c::set('stripe_alipay', false);
c::set('stripe_bitcoin', false);

// When the charge process completes, the page will reload and the "Pay with Card" button will be replaced with a confirmation message consisting of a header and paragraph. You can specify what these say in the below parameters. 

c::set('stripe_confirmation_heading', '<h3>Purchase Complete</h3>');
c::set('stripe_confirmation_message', '<p>Thank you for your purchase! You\'ll receive an email receipt shortly.</p>');