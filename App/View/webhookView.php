<?php

require_once('Controller/Stripe.php');


$psr17Factory = new Nyholm\Psr7\Factory\Psr17Factory();

$creator = new Nyholm\Psr7Server\ServerRequestCreator(
    $psr17Factory, // ServerRequestFactory
    $psr17Factory, // UriFactory
    $psr17Factory, // UploadedFileFactory
    $psr17Factory  // StreamFactory
);


$request = $creator->fromGlobals();
// var_dump($request);

$payment = new \App\Controller\StripePaye(trim('sk_test_51KgrypCjcUSLVoiTemxsLRsQyRbomYCY6YPLjjj6bvrSTPl92ejOuw1CV3EZzUrJnn9ROrPnXccQD57DgVtMxDzA009eldOofQ') ,  trim('whsec_b5d25112d7b1eb40613374ecb05f0ec79ac4b276b7b730876bf2435f0462c16b'));
// var_dump($payment);
$retour = $payment->handlerStripe($request);
// var_dump($retour);
