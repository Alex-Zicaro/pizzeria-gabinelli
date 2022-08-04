<?php

namespace App\Controller;

use Slim\Http\{Request, Response};
use Stripe\{Stripe, Charge};

// require_once 'vendor/autoload.php';

class Paniers
{

    public $Paniers;

    public function __construct()
    {
        $this->paniers = new \App\Modele\Paniers;
        $this->produit = new \App\Modele\Produits;
        $this->produitC = new Produits;
        // $this->obj = new Paniers;
    }

    function isVerrouille()
    {
        if (isset($_SESSION['panier']) && $_SESSION['panier']['verrou'])
            return true;
        else
            return false;
    }

    function compterArticles()
    {
        if (isset($_SESSION['panier']))
            return count($_SESSION['panier']['idProduit']);
        else
            return 0;
    }

    function supprimePanier()
    {
        unset($_SESSION['panier']);
    }


    function creationPanier()
    {
        if (!isset($_SESSION['panier'])) {
            $_SESSION['panier'] = array();
            $_SESSION['panier']['idProduit'] = array();
            $_SESSION['panier']['qteProduit'] = array();
            $_SESSION['panier']['verrou'] = false;
        }
        return true;
    }

    function ajouterArticle($qteProduit, $idProduit)
    {
        // session_destroy();
        //Si le panier existe
        if ($this->creationPanier() && !$this->isVerrouille()) {
            //Si le produit existe déjà on ajoute seulement la quantité
            $produit = $this->produit->selectProduit($idProduit);
            // var_dump($_SESSION['panier']);
            $positionProduit = array_search($produit['id'], $_SESSION['panier']['idProduit']);
            if ($positionProduit !== false) {
                $_SESSION['panier']['qteProduit'][$positionProduit] += $qteProduit;
            } else {

                if (!isset($_SESSION['panier']['idProduit']))
                    $_SESSION['panier']['idProduit'] = [];


                //Sinon on ajoute le produit
                // array_push($_SESSION['panier']['libelleProduit'], $produit['nom']);

                array_push($_SESSION['panier']['qteProduit'], $qteProduit);
                // array_push($_SESSION['panier']['prixProduit'] , $produit["prix"]);
                array_push($_SESSION['panier']['idProduit'], $produit['id']);

                // session_destroy();

            }
        } else
            echo "Un problème est survenu veuillez contacter l'administrateur du site.";
    }

    public function afficherAuPanier($array)
    {

        $data = $this->produit->parcourirLePanier($array);
        return ($data);
    }
    public function Prepare($action)
    {

        if (!in_array($action, array('suppression', 'refresh')))
            $erreur = true;

        //récupération des variables en POST ou GET
        $id = (isset($_POST['id']) ? $_POST['id'] : (isset($_GET['id']) ? $_GET['id'] : null));
        $prix = (isset($_POST['prix']) ? $_POST['prix'] : (isset($_GET['prix']) ? $_GET['prix'] : null));
        $quantite = (isset($_POST['quantite']) ? $_POST['quantite'] : null);

        //Suppression des espaces verticaux
        $id = preg_replace('#\v#', '', $id);
        //On vérifie que $p est un float
        $prix = floatval($prix);

        //On traite $q qui peut être un entier simple ou un tableau d'entiers

        if (is_array($quantite)) {
            $QteArticle = array();
            $i = 0;
            foreach ($quantite as $contenu) {
                $QteArticle[$i++] = intval($contenu);
            }
        } else
            $quantite = intval($quantite);

        return array('id' => $id, 'prix' => $prix, 'quantite' => $quantite);
    }

    function supprimerArticle($idProduit)
    {
        //Si le panier existe
        var_dump($this->creationPanier(),$this->isVerrouille());
        // session_destroy();
        if ($this->creationPanier() && $this->isVerrouille() === false || $this->isVerrouille() === null) {
            //Nous allons passer par un panier temporaire
            $tmp = array();

            $tmp['qteProduit'] = array();
            $tmp['idProduit'] = array();
            $tmp['verrou'] = $_SESSION['panier']['verrou'];


            for ($i = 0; $i < count($_SESSION['panier']['idProduit']); $i++) {
                if ($_SESSION['panier']['idProduit'][$i] !== $idProduit) {
                    array_push($tmp['idProduit'], $_SESSION['panier']['idProduit'][$i]);
                    array_push($tmp['qteProduit'], $_SESSION['panier']['qteProduit'][$i]);
                }
            }
            //On remplace le panier en session par notre panier temporaire à jour
            $_SESSION['panier'] =  $tmp;

            //On efface notre panier temporaire
            unset($tmp);
        } else
            echo "Un problème est survenu veuillez contacter l'administrateur du site.";
    }
    function modifierQTeArticle($idProduit, $qteProduit)
    {
        
            //Si le panier existe 
            // var_dump($_SESSION['panier']); 
            if (isset($_SESSION['panier']) ) {
                //Si la quantité est positive on modifie sinon on supprime l'article
                if ($qteProduit > 0) {
                    //Recherche du produit dans le panier
                    $positionProduit = array_search($idProduit,  $_SESSION['panier']['idProduit']);

                    if ($positionProduit !== false) {
                        $_SESSION['panier']['qteProduit'][$positionProduit] = $qteProduit;
                    
                } else
                    $this->supprimerArticle($idProduit);
            } else
                echo "Un problème est survenu veuillez contacter l'administrateur du site.";
        } else {
            echo "La quantité est insuffisante";
        }
    }

    function MontantGlobal($prix)
    {

        if (isset($_SESSION['panier'])) {
            $total = 0;
            for ($i = 0; $i < count($_SESSION['panier']['idProduit']); $i++) {
                // calculer tout les prix dans un tableau 

                $tempPrix = intval($prix[$i][0]['prix']);

                // var_dump($tempPrix);
                $tempQtt = intval($_SESSION['panier']['qteProduit'][$i]);
                // var_dump($tempQtt);
                // $total += intval(($_SESSION['panier']['qteProduit'][$i] * $prix[$i][0]['prix']));
                $total += ($tempQtt * $tempPrix);
            }
            // var_dump($total);
            return $total;
        }
    }

    public function afficheLesProduitDuPanier()
    {

        $this->panier->afficheLesProduitDuPanier($_SESSION["panier"]["id"]);
    }
    public function LockPanier()
    {

        $_SESSION['panier']['verrou'] = true;
    }
    public function UnlockPanier()
    {
        $_SESSION['panier']['verrou'] = false;
    }

    public function calculeMontant($prix, $quantite)
    {

        $montant = $prix * $quantite;
        return $montant;
    }

    public function switchaction($action, $id, $QteArticle)
    {
        switch ($action) {
            case "suppression":
                $this->supprimerArticle($id);
                break;
            case "refresh":
                for ($i = 0; $i < count($QteArticle); $i++) {
                    $this->modifierQTeArticle($_SESSION['panier']['idProduit'][$i], round($QteArticle[$i]));
                }
                break;
            default:
                break;
        }
    }

    public function PanierIntoBdd($idProduit, $qteproduit)
    {
        
        //Insert du panier dans la bdd dans la table panier
        $this->Insertiondupanierdanslabdd();
        // Select du dernier panier créer de l'utilisateur
        $idPanier = $this->paniers->selectLastPanierOfUser();
        //Insert des produits du panier de l'id de l'user
        $this->paniers->addPanierProduit($idPanier);
    }


    public function Insertiondupanierdanslabdd()
    {
        $this->paniers->InsertPanierIntoBdd();
    }
    public function stripeUnArticle($prix, $nom)

    {

        \Stripe\Stripe::setApiKey('sk_test_51KgrypCjcUSLVoiTemxsLRsQyRbomYCY6YPLjjj6bvrSTPl92ejOuw1CV3EZzUrJnn9ROrPnXccQD57DgVtMxDzA009eldOofQ');

        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'EUR',
                    'product_data' => [
                        'name' => $nom,
                    ],
                    'unit_amount' => $prix * 100,
                ],
                'quantity' => 1,
            ]],


            'mode' => 'payment',
            'success_url' => 'http://localhost/pizzeria-gabinelli/App/succes?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => 'http://localhost/pizzeria-gabinelli/App/fail',

        ]);

        // return "Vous devez être connecté pour effectuer un achat";
        return $session;
    }

    public function stripe($prix, $nom)
    {

        if (isset($prix) && $prix !== 0) {
            // echo"mais est ce que on passe par ici aussi lzelaz";
            \Stripe\Stripe::setApiKey('sk_test_51KgrypCjcUSLVoiTemxsLRsQyRbomYCY6YPLjjj6bvrSTPl92ejOuw1CV3EZzUrJnn9ROrPnXccQD57DgVtMxDzA009eldOofQ');

            // header('Content-Type: application/json');

            $session = \Stripe\Checkout\Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'EUR',
                        'product_data' => [
                            'name' => $nom,
                        ],
                        'unit_amount' => $prix * 100,
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => 'http://localhost/boutique-en-ligne/app/succes?session_id={CHECKOUT_SESSION_ID}',  // pas bon
                'cancel_url' => 'http://localhost/boutique-en-ligne/app/fail',
            ]);

            // header("Location: " . $session->url);
            // return "Vous devez être connecté pour effectuer un achat";
            return $session;
        }
    }

    public function confirmPayement()
    {

        // $app = new \Slim\App;

        // $app->add(function ($request, $response, $next) {

        //    \Stripe\Stripe::setApiKey('sk_test_VePHdqKTYQjKNInc7u56JBrQ');

        //    return $next($request, $response);
        // });

        // $app->get('/order/success', function (Request $request, Response $response) {
        //    $session = \Stripe\Checkout\Session::retrieve($request->get('session_id'));
        //    $customer = \Stripe\Customer::retrieve($session->customer);

        //    return $response->write("<html><body><h1>Merci pour votre acaht, $customer->name!</h1></body></html>");
        // });

        // $app->run();
    }
}
// var_dump($_SESSION['panier']['verrou']);