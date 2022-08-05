<?php

namespace App\Controller;

use Stripe\Checkout\Session;
use Stripe\Stripe;
use Stripe\StripeClient;
use Stripe\Webhook;

require_once('Controller.php');

class StripePaye extends Controller
{

    public function __construct($clientSecret, $webhookSecret)
    {
        parent::__construct();
        $this->clientSecret = $clientSecret;
        Stripe::setApiKey($this->clientSecret);
        Stripe::setApiVersion('2020-08-27');
        $this->webhookSecret = $webhookSecret;
    }
    public function startPayement($produits, $prix)
    {
        // var_dump($produits[0]);
        $session = Session::create([
            'mode' => 'payment',
            'success_url' => 'http://localhost/pizzeria-gabinelli/App/succes',
            'cancel_url' => 'http://localhost/pizzeria-gabinelli/App/fail',
            'payment_method_types' => ['card'],
            'billing_address_collection' => 'required',
            'shipping_address_collection' => [
                'allowed_countries' => ['FR'],

            ],
            'line_items' => [

                [

                    'name' => $produits[0]['nom'],
                    'description' => $produits[0]['description'],

                    'amount' => $prix * 100,
                    'currency' => 'eur',
                    'quantity' => 1,

                ]

            ],
        ]);
        header('HTTP/1.1 303 See Other');
        header('Location: ' . $session->url);
    }

    public function startPayementOneItem($produits, $prix , $description)
    {
        // var_dump($produits , $prix);
        $session = Session::create([
            'mode' => 'payment',
            'success_url' => 'http://localhost/pizzeria-gabinelli/App/succes',
            'cancel_url' => 'http://localhost/pizzeria-gabinelli/App/fail',
            'payment_method_types' => ['card'],
            'billing_address_collection' => 'required',
            'shipping_address_collection' => [
                'allowed_countries' => ['FR'],

            ],
            'line_items' => [

                [

                    'name' => $produits,
                    'description' => $description,

                    'amount' => $prix * 100,
                    'currency' => 'eur',
                    'quantity' => 1,

                ]

            ],
        ]);
        header('HTTP/1.1 303 See Other');
        header('Location: ' . $session->url);
    }

    public function handlerStripe(\PSR\Http\Message\ServerRequestInterface $request){

        // var_dump($request);
        $endpoint_secret = 'whsec_b5d25112d7b1eb40613374ecb05f0ec79ac4b276b7b730876bf2435f0462c16b';
        $signature = $request->getHeaderLine('Content-Signature');
        // var_dump($signature);
        $body = (string) $request->getBody();
        $event = Webhook::constructEvent(
            $body,
            $signature,
            $endpoint_secret
        );
        // var_dump($event);
        file_put_contents('checkout.completed', serialize($event));
    }
}

