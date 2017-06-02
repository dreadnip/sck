<?php

namespace Sck;


use Stripe\Stripe;
use C;


class Sck
{
	private $sk;
	private $amount;
	private $description;
	public $pk;
	public $currency;
	public $alipay;
	public $bitcoin;
	public $logo;
	public $remember_me;
	public $shipping_address;


	public function __construct()
	{
		if (c::get('stripe_test_mode')) {
			$this->pk = c::get('stripe_test_publishable_key');
			$this->sk = c::get('stripe_test_secret_key');
		} else {
			$this->pk = c::get('stripe_live_publishable_key');
			$this->sk = c::get('stripe_live_secret_key');
		}

		// Check if the Alipay payment method has been enabled

		if (c::get('stripe_alipay')) {
			$this->alipay = 'true';
		}else{
			$this->alipay = 'false';
		}

		// Check if the Bitcoin payment method has been enabled

		if (c::get('stripe_bitcoin')) {
			$this->bitcoin = 'true';
		}else{
			$this->bitcoin = 'false';
		}

		// Check if an icon has been set. 

		if (c::get('stripe_icon')) {
			$this->logo = url(c::get('stripe_icon_location'));
		}

		// Check if "Remember Me" has been enabled

		if (c::get('stripe_remember_me')) {
			$this->remember_me = 'true';
		}else{
			$this->remember_me = 'false';
		}

		// Check if the option to collect a shipping address has been enabled

		if (c::get('stripe_shipping_address')) {
			$this->shipping_address = 'true';
		}else{
			$this->shipping_address = 'false';
		}

		\Stripe\Stripe::setApiKey($this->sk);
	}

	public function format_stripe_amount($amount)
	{
		$f = str_replace(['.', ','], '', $amount);
		return $f;
	}

	public function pass_vars($page)
	{
		$this->amount = $this->format_stripe_amount($page->amount());
		$this->description = $page->description();
	}

	public function charge()
	{
		$token                            = $_POST['stripeToken'];
		$email                            = $_POST['stripeEmail'];
		$billingName                      = $_POST['stripeBillingName'];
		$billingZip                       = $_POST['stripeBillingAddressZip'];
		$email                            = $_POST['stripeEmail'];
		$amount                           = $this->amount;
		$description                      = $this->description;
		$currency                         = c::get('stripe_currency');

		if(isset($_POST['stripeShippingName'])){
			$stripeShippingName               = $_POST['stripeShippingName'];
			$stripeShippingAddressLine1       = $_POST['stripeShippingAddressLine1'];
			$stripeShippingAddressZip         = $_POST['stripeShippingAddressZip'];
			$stripeShippingAddressState       = $_POST['stripeShippingAddressState'];
			$stripeShippingAddressCity        = $_POST['stripeShippingAddressCity'];
			$stripeShippingAddressCountry     = $_POST['stripeShippingAddressCountry'];
		}

		$charge = \Stripe\Charge::create(array(
			'amount'                      => $amount,
			'source'                      => $token,
			'currency'                    => $currency,
			'receipt_email'               => $email,
			'description'                 => $description,
			'metadata'                    => array(
				'customer_name'      => $billingName,
				'customer_email'     => $email,
				'shipping_name'      => isset($stripeShippingName) ? $stripeShippingName : '',
				'shipping_street'    => isset($stripeShippingAddressLine1) ? $stripeShippingAddressLine1 : '',
				'shipping_city'      => isset($stripeShippingAddressCity) ? $stripeShippingAddressCity : '',
				'shipping_state'     => isset($stripeShippingAddressState) ? $stripeShippingAddressState : '',
				'shipping_zip'       => isset($stripeShippingAddressZip) ? $stripeShippingAddressZip : '',
				'shipping_country'   => isset($stripeShippingAddressCountry) ? $stripeShippingAddressCountry : ''
			)
		));

		echo c::get('stripe_confirmation_heading');
		echo c::get('stripe_confirmation_message');
	}
}