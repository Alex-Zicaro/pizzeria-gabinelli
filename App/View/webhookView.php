<?php

require_once('Controller/Stripe.php');

$psr17Factory = new \Nyholm\Psr7\Factory\Psr17Factory();

$creator = new \Nyholm\Psr7Server\ServerRequestCreator(
    $psr17Factory, // ServerRequestFactory
    $psr17Factory, // UriFactory
    $psr17Factory, // UploadedFileFactory
    $psr17Factory  // StreamFactory
);

$request = $creator->fromGlobals();

$payment = new \App\Controller\StripePaye('sk_test_51KgrypCjcUSLVoiTemxsLRsQyRbomYCY6YPLjjj6bvrSTPl92ejOuw1CV3EZzUrJnn9ROrPnXccQD57DgVtMxDzA009eldOofQ');
$payment->pont($request);