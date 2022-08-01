<?php

use App\Controller\{
    Produits,
    Utilisateurs,
    Images,
    StripePaye,
    Paniers
};


require_once('Controller/Stripe.php');

$utilisateur = new Utilisateurs;
$produit = new Produits;
$panier = new Paniers;


$stripe = new StripePaye('sk_test_51KgrypCjcUSLVoiTemxsLRsQyRbomYCY6YPLjjj6bvrSTPl92ejOuw1CV3EZzUrJnn9ROrPnXccQD57DgVtMxDzA009eldOofQ');

    $produits = $panier->afficherAuPanier($_SESSION['panier']['idProduit']);
    // var_dump($produits);
$prix = $panier->MontantGlobal($produits);
$stripe->startPayement($produits[0],$prix);
var_dump($_SESSION);

?>