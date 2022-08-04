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


$stripe = new StripePaye('sk_test_51KgrypCjcUSLVoiTemxsLRsQyRbomYCY6YPLjjj6bvrSTPl92ejOuw1CV3EZzUrJnn9ROrPnXccQD57DgVtMxDzA009eldOofQ','whsec_b5d25112d7b1eb40613374ecb05f0ec79ac4b276b7b730876bf2435f0462c16b');
if(empty($_GET['item'])){

    $produits = $panier->afficherAuPanier($_SESSION['panier']['idProduit']);
    // var_dump($produits);
$prix = $panier->MontantGlobal($produits);
$stripe->startPayement($produits[0],$prix);
// var_dump($_SESSION);
} else if ($_GET['item'] != 0){
    $produits = $produit->produit->selectProduit($_GET['item']);
    // var_dump($produits['prix'] , $produits['nom']);
    $stripe->startPayementOneItem($produits['nom'],$produits['prix'], $produits['description']);
}

?>