# SCK (Stripe Checkout for Kirby)

A plugin for Kirby 2 to process basic payments with [Stripe](https://stripe.com) using [Checkout](https://stripe.com/checkout). 

This is **not** a fully featured e-commerce solution. There is no cart, no product management, no shipping, etc. If you want those, take a look at [Shopkit](http://getkirby-plugins.com/shopkit) by Sam Nabi. 

This plugin delivers a lightweight and easy-to-setup snippet that allows you to quickly get working a Stripe button on your website.

## Requirements

- Kirby 2.3+
- PHP 5.5+

SSL/TLS is [required by Stripe](https://stripe.com/docs/checkout#https) when processing live credit card payments. Stripe has a [useful guide for setting this up](https://stripe.com/docs/security) in their documentation.

## Installation

1. Either copy the content of this repo to your plugin folder, add it as a Git submodule or use the Kirby CLI to install it.
2. Edit `sck.config.php`, insert your Stripe API keys and change any options as needed.

## Usage

To place a 'Pay Now' Stripe button on your page, include the Sck snippet in it's template.

```
<?php snippet('sck'); ?>
```

Next up, you need to add 2 fields to your content so Stripe knows 
a) what you're selling
and 
b) what the price is.

### Amount

`Amount: 10.00` will set the amount to charge your customer and display in the Checkout form. If you use a decimal comma, you can enter 10,00. For larger amounts, you can include a number divider (e.g. 2,999.99) if you wish.  

The currency is set within SCK's options in the `config.php` file. 

### Description

This is used both as the description in the Checkout form and also the description of the charge when you view it in the Stripe dashboard. 

## Example

### product.txt

````
Title: My awesome product
----
Amount: 9.99
----
Description: An example product in your store
----
Text: Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
````

## product.php

````
<?php snippet('header') ?>

<main class="main cf" role="main">

	<h1><?php echo $page->title()->html() ?></h1>

	<div class="meta">
		<li><?php echo $page->amount() ?></li>
		<li><?php snippet('sck') ?></li>
	</div>

	<div class="text">
		<?php echo $page->text()->kirbytext() ?>
	</div>

</main>

<?php snippet('footer') ?>
````

## Options

SCK has a lot of options that allow you to customise Checkout to suit your needs. 

All options are set in the included `sck.config.php` file.

## What I've changed from the original repo

* Bundled all of the plugin logic in a single class
* Changed the plugin structure so it can be used as a Git submodule
* Removed a few features (like redirect after buy) to simplify the plugin
* Added the Stripe-php library with Composer
* Moved the config file inside the plugin
* Various small code tweaks

## Credit

All credit for the original code, idea and implementation goes to [Jordan Merrick](https://github.com/jordanmerrick)
