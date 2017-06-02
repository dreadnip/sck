<?php

/**
 * Kirby SEO checklist plugin
 *
 * @version   0.1.0
 * @author    Sander De la Marche <inbox@sanderdlm.be>
 * @copyright Sander De la Marche <inbox@sanderdlm.be>
 * @link      https://github.com/dreadnip/kirby-seo-checklist
 * @license   MIT
 */

require_once(__DIR__.DS.'vendor/autoload.php');
require_once(__DIR__.DS.'lib/sck.php');

$kirby->set('snippet', 'sck', __DIR__ . '/snippets/sck.php');

$kirby->set('template', 'checkout', __DIR__ . '/templates/checkout.php');

$kirby->set('template', 'checkout-success', __DIR__ . '/templates/checkout-success.php');