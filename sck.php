<?php

/**
 * SCK (Stripe Checkout for Kirby)
 *
 * @version   0.4.0
 * @author    Sander De la Marche <inbox@sanderdlm.be>
 * @copyright Sander De la Marche <inbox@sanderdlm.be>
 * @link      https://github.com/dreadnip/kirby-seo-checklist
 * @license   MIT
 */

require_once(__DIR__.DS.'vendor/autoload.php');
require_once(__DIR__.DS.'sck.config.php');
require_once(__DIR__.DS.'lib/sck.php');

$kirby->set('snippet', 'sck', __DIR__ . '/snippets/sck.php');