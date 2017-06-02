<?php

  $sck = new \Sck\Sck();
  
  $sck->pass_vars($page); //Pass the amount & description to the class so the user can't mess with them in the POST

  if (isset($_POST['stripeToken']))
  {
    $sck->charge();
    return;
  }
?>

<form action="" method="POST">
  <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
  data-key="<?= $sck->pk; ?>"
  data-amount="<?= $sck->format_stripe_amount($page->amount()) ?>"
  data-name="<?= $site->title() ?>"
  data-description="<?= $page->description() ?>"
  data-image="<?= $sck->logo ?>"
  data-locale="auto"
  data-billing-address="true"
  data-shipping-address="<?= $sck->shipping_address; ?>"
  data-allow-remember-me="<?= $sck->remember_me; ?>"
  data-alipay="<?= $sck->alipay; ?>"
  data-bitcoin="<?= $sck->bitcoin; ?>"
  data-currency="<?= c::get('stripe_currency') ?>">
  </script>
</form>