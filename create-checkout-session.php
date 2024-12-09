<?php
$data = json_decode($_POST["jsonData"]);

require 'vendor/autoload.php';

$stripe = new \Stripe\StripeClient('sk_test_51MeU1vEo4qDdC4HdQL60sYbdvLJL0MjhS2LospW2STUyu0ueAzACtWBTRXGgIZDVB9bL5sv7pYrwM5bwBmRyQXCQ008MmNTXUa');

$checkout_session = $stripe->checkout->sessions->create([
  'line_items' => [[
    'price_data' => [
      'currency' => 'usd',
      'product_data' => [
        'name' => $data->title,
      ],
      'unit_amount' => $data->total*100,
    ],
    'quantity' => 1,
  ]],
  'mode' => 'payment',
  'success_url' => 'http://localhost/sneekerclub/confirmation.php?cusdata='.$_POST["jsonData"],
  'cancel_url' => 'http://localhost/sneekerclub/home.php',
]);

header("HTTP/1.1 303 See Other");
header("Location: " . $checkout_session->url);

?>

