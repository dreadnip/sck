# SCK (Stripe Checkout for Kirby)

A plug-in for Kirby CMS to process payments with [Stripe](https://stripe.com) using [Checkout](https://stripe.com/checkout). You can also accept [AliPay](https://stripe.com/docs/alipay) and [Bitcoin](https://stripe.com/docs/bitcoin) payments, if your Stripe account supports it.

## What I've changed from the original repo

* Moved most of the logic from the snippet and the charge file into a single class.
* Moved the included snippet & template to within the plugin.
* Various small code tweaks
* Added Composer for the Stripe-php library

## What I still want to do

* Create a different solution for the config file
* Improve on the plug-and-play feeling of this plugin. I want it to be as simple as copy the plugin to your plugins folder, put an ```amount``` in your content, include the snippet and it should work.

## Requirements

- Kirby 2.3+
- PHP 5.5+
- Stripe PHP library

SCK has been developed and tested using Kirby 2.3.1 running on PHP 5.5.27. With that, as long as you can run Kirby 2.3+ then you should be able to use this plugin. 

SSL/TLS is [required by Stripe](https://stripe.com/docs/checkout#https) when processing live credit card payments. Stripe has a [useful guide for setting this up](https://stripe.com/docs/security) in their documentation.

## Installation

1. Copy the plugin to your plugin folder and the config file to your config folder.
2. Run ```composer install``` inside the plugin folder.
3. Edit `/site/config/config.php` and insert `include 'sck.config.php';` after any listed options so Kirby will load the configuration file.
4. Edit `/site/config/sck.config.php`, insert your Stripe API keys and change any options as needed.

## Usage

To use SCK in any page, three additional fields need to be added.

### Stripe

`Stripe: true` will make sure that Checkout is inserted into the page. 

### Amount

`Amount: 10.00` will set the amount to charge your customer and display in the Checkout form. If you use a decimal comma, you can enter 10,00. For larger amounts, you can include a number divider (e.g. 2,999.99) if you wish.  

The currency is set within SCK's options in the `config.php` file. 

### Description

This is used both as the description in the Checkout form and also the description of the charge when you view it in the Stripe dashboard. 

## Example page

````
Title: Stripe Checkout Example
----
stripe: true
----
Amount: 9.99
----
Description: An example purchase with SCK
----

Text: Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. 
````

## Test vs live

Stripe provides two sets of API keys: test and live. Whether you process charges in test or live mode is dictated by the set of API keys used when inserting the Checkout form and creating a charge. 

SCK requires both sets and makes it easy to switch between test and live mode. By default, test mode is enabled. It's recommended that you fully test SCK before you begin processing live charges. 

The Stripe dashboard will display both live and test charges in separate views, which you can toggle using the Live / Test switch in the dashboard. Alternatively, you can jump straight to your Stripe "test" dashboard at:

https://dashboard.stripe.com/test/dashboard

Once you're happy that everything is set up how you want it, you should change the option `stripe_test_mode` to `false`. At this point, SCK will process charges using your live API keys. 

### Testing SCK

Stripe has some useful information about [testing](https://stripe.com/docs/testing), and provides a number of [test credit card numbers](https://stripe.com/docs/testing#cards) you can use.

For example, use the card number `4242 4242 4242 4242` with any future expiration date and random number for the CVC to create a successful charge.  

## Options

SCK has a lot of options that allow you to customise Checkout to suit your needs. 

All options are set in the included `sck.config.php`, which should be placed in `/site/config` folder. Make sure to add `include 'sck.config.php'` in `/site/config/config.php` so that Kirby will be able to use them. The configuration file is fully commented so you can easily identify what each option does. 

Make sure to add `include 'sck.config.php` somewhere within Kirby's main configuration file at `/site/config.config.php` so it will load them.  

For additional help, here's a list of all required options.

### API keys

By default, test mode is enabled. When you're ready to begin processing live charges, change this to `false`. No payments can be made when test mode is enabled. 

````
c::set('stripe_test_mode', true);
c::set('stripe_test_secret_key', 'sk_test');
c::set('stripe_test_publishable_key', 'pk_test');
c::set('stripe_live_secret_key', 'sk_live');
c::set('stripe_live_publishable_key', 'pk_live');
````

### Currency support

Stripe has a [list of all supported currencies](https://support.stripe.com/questions/which-currencies-does-stripe-support), including their abbreviation. Refer to this when you're specifying a currency. 

The currency symbol is whatever you want visitors to see and can be anything you want, either a symbol ($) or "USD". Certain currencies have the symbol located on the right-side of the amount(such as DKK).

````
c::set('stripe_currency', 'usd');
c::set('stripe_currency_symbol', '$');
c::set('stripe_currency_symbol_location', 'left');
````

### Remember Me

[Remember Me](https://stripe.com/checkout#onetap) allows customers to save their card details wth Stripe to use again with any merchant that  uses Checkout.

````
c::set('stripe_remember_me', true);
````

### Shipping address

You can also have Checkout collect shipping address details. SCK will pass this information along as metadata when creating the charge, so you can view it within the Stripe dashboard. 

````
c::set('stripe_shipping_address', false);
````

### Default amount and description

By default, SCK uses the amount and description specified on each page. If no amount or description has been set on a page that Checkout is being displayed on, the following default information is used instead. This is useful if you want to display Checkout on all pages with only one amount (e.g., a fixed donation). 

````
c::set('stripe_default_amount', '100');
c::set('stripe_default_description', 'New Payment');
````

### Checkout image

Custom icon for Checkout. Default is false, though it's recommended that you specify one. Icon should be at least 128x128px and .gif, .jpeg, .png or .svg. 

````
c::set('stripe_icon', true);
c::set('stripe_icon_location', 'assets/images/logo.svg');
````

### AliPay & Bitcoin 

Stripe supports [AliPay](https://stripe.com/alipay) and [Bitcoin](https://stripe.com/bitcoin) payments through Checkout, but there are some restrictions. To use AliPay, you must have a USD-denominated bank account associated with your Stripe account. 

To use Bitcoin, you must have a US-based bank account associated 
with your Stripe account. 

If you do not meet this criteria, do not enable either of these options. 

````
c::set('stripe_alipay', false);
c::set('stripe_bitcoin', false);
````

### Charge confirmation

When the charge process completes, the page will reload and the "Pay with Card" button will be replaced with a confirmation message consisting of a header and paragraph. You can specify what these say in the below parameters. 

````
c::set('stripe_confirmation_heading', '<h3>Purchase Complete</h3>');
c::set('stripe_confirmation_message', '<p>Thank you for your purchase! You\'ll receive an email receipt shortly.</p>');
````

### Redirect on successful charge

If you'd prefer that the charge process redirects to a specific page once completed, enable the `stripe_redirect_on_success` parameter and specify the page to redirect to. A custom route is used (which uses whatever you specify `stripe_redirect_to_url` to be) if you'd also like to perform some additional actions.

See the template `checkout-success.php` for example usage. An example page that you can add to your `content` folder is included, which uses this template and is the default location for the route. 

````
c::set('stripe_redirect_on_success', false);
c::set('stripe_redirect_to_page', 'thanks');

c::set('routes', array(
  array(
    'pattern' => c::get('stripe_redirect_to_page'),
    'action'  => function() {
		$data = array(
		'stripeAmount' => s::get('stripeAmount'),
		'displayAmount' => s::get('displayAmount')
	  	);
	  	return array('stripe-checkout-complete', $data);
    }
  )
));
````

## Charge information and metadata

Since Checkout requires customers to enter their email address, name and full billing address, this is automatically passed to Stripe when a charge is created. In addition, SCK will pass as much information as possible to Stripe.

## Author

SCK created by [Jordan Merrick](https://www.jordanmerrick.com). Contact me at [info@jordanmerrick.com](mailto:info@jordanmerrick.com).
