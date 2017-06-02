# SCK (Stripe Checkout for Kirby)

A plug-in for Kirby CMS to process payments with [Stripe](https://stripe.com) using [Checkout](https://stripe.com/checkout). You can also accept [AliPay](https://stripe.com/docs/alipay) and [Bitcoin](https://stripe.com/docs/bitcoin) payments, if your Stripe account supports it.

## What I've changed from the original repo

* Moved most of the logic from the snippet and the charge file into a single class.
* Moved the included snippet & template to within the plugin.
* Various small code tweaks
* Added Composer for the Stripe-php library
* Moved the config file to the plugin directory
* Changed the plugin structure so it can be used as a Git submodule
* Improved on the plug-and-play feeling of this plugin. All you need to do to sell a product is include ```<?php snippet('sck'); ?>``` in a template, and ```amount``` and ```description``` fields in your content files. That's it.
## Requirements

- Kirby 2.3+
- PHP 5.5+

SSL/TLS is [required by Stripe](https://stripe.com/docs/checkout#https) when processing live credit card payments. Stripe has a [useful guide for setting this up](https://stripe.com/docs/security) in their documentation.

## Installation

1. Either copy the content of this repo to your plugin folder or add it as a submodule.
2. Edit `sck.config.php`, insert your Stripe API keys and change any options as needed.

## Usage

To use SCK in any page, two fields need to be present.

### Amount

`Amount: 10.00` will set the amount to charge your customer and display in the Checkout form. If you use a decimal comma, you can enter 10,00. For larger amounts, you can include a number divider (e.g. 2,999.99) if you wish.  

The currency is set within SCK's options in the `config.php` file. 

### Description

This is used both as the description in the Checkout form and also the description of the charge when you view it in the Stripe dashboard. 

## Example product content file

````
Title: My awesome product
----
Amount: 9.99
----
Description: An example product in your store
----
Text: Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. 
````

## Example product template

````
<?php snippet('header') ?>

<main class="main cf" role="main">

	<h1><?php echo $page->title()->html() ?></h1>

	<ul class="meta">
		<li><?php echo $page->amount() ?></li>
		<li><?php snippet('sck') ?></li>
	</ul>

	<div class="text">
		<?php echo $page->text()->kirbytext() ?>
	</div>

</main>

<?php snippet('footer') ?>
````

## Options

SCK has a lot of options that allow you to customise Checkout to suit your needs. 

All options are set in the included `sck.config.php` file.
