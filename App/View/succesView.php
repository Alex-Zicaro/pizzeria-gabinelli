<?php

use App\Controller\{Paniers, Produits , Utilisateurs , Commandes};

$utilisateur = new Utilisateurs;

$panier = new Paniers;

$produit = new Produits;

$commande = new Commandes;

$utilisateur->userConnect();



if(isset($_SESSION['panier']) && isset($_SESSION['profil'])){
    $panier->PanierIntoBdd($_SESSION['panier']['idProduit'], $_SESSION['panier']['qteProduit'][0]);
    $panier->supprimePanier();
    $id_panier = $panier->paniers->foundPanier();
    $id_adresse = $commande->commande->foundAdresse();
    // var_dump($id_panier , $id_adresse);
    $commande->addCommande($_SESSION['profil']['id'] , $id_adresse ,$id_panier);
    header("Refresh:0");
    die();
}
$userCommande = $commande->commande->foundCommande();
$produits = $commande->commande->foundProduit($userCommande['panierId']);
$nbCommande = $commande->commande->countCommande();
// echo"<pre>";
// var_dump($produits);
// echo"</pre>";

// echo"<pre>";
// var_dump($userCommande);
// echo"</pre>";




?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="View/CSS/include.css">
    <link rel="stylesheet" href="View/CSS/style.css">

    <title>Gabinelli - RIEUMES | Italienne cuisine proche de moi</title>
<link rel="canonical" href="https://gabinelli-pizzeria-rieumes.eatbu.com/?lang=fr"/>
<meta name="description" content="Vous pouvez commander à emporter | RIEUMES - Si vous voulez manger un repas italien et &ecirc;tes en qu&ecirc;te d&rsquo;un &eacute;tablissement o&ugrave; passer la soir&eacute;e, vous &ecirc;tes les bienvenus chez nous. Restaurant italien pris&eacute; au centre : Laissez-vous tenter et profitez de la cuisine italienne. Nous sommes r&eacute;put&eacute;s pour notre excellent fast-food. Go&ucirc;tez par exemple &agrave; notre pizza pris&eacute;e. Go&ucirc;tez aussi volontiers un bon verre de vin ou un verre de bi&egrave;re aromatique lorsque vous viendrez nous voir. Venez d&eacute;guster un d&icirc;ner d&eacute;licieux chez nous ! Places de parking particuli&egrave;rement pratiques : Profitez de notre parking gratuit. Contactez-nous et r&eacute;servez d&egrave;s aujourd&rsquo;hui. Il vous suffit de nous contacter par t&eacute;l. au +330562626261. Chez nous, vous pouvez payer soit en esp&egrave;ces soit par carte VISA, carte Maestro, MasterCard ou paiement d&eacute;mat&eacute;rialis&eacute;. Nos plats sont &eacute;galement disponibles &agrave; emporter. Nous sommes ouverts tous les jours de 18h00 &agrave; 22h00."/>
<meta property="og:description" content="Vous pouvez commander à emporter | RIEUMES - Si vous voulez manger un repas italien et &ecirc;tes en qu&ecirc;te d&rsquo;un &eacute;tablissement o&ugrave; passer la soir&eacute;e, vous &ecirc;tes les bienvenus chez nous. Restaurant italien pris&eacute; au centre : Laissez-vous tenter et profitez de la cuisine italienne. Nous sommes r&eacute;put&eacute;s pour notre excellent fast-food. Go&ucirc;tez par exemple &agrave; notre pizza pris&eacute;e. Go&ucirc;tez aussi volontiers un bon verre de vin ou un verre de bi&egrave;re aromatique lorsque vous viendrez nous voir. Venez d&eacute;guster un d&icirc;ner d&eacute;licieux chez nous ! Places de parking particuli&egrave;rement pratiques : Profitez de notre parking gratuit. Contactez-nous et r&eacute;servez d&egrave;s aujourd&rsquo;hui. Il vous suffit de nous contacter par t&eacute;l. au +330562626261. Chez nous, vous pouvez payer soit en esp&egrave;ces soit par carte VISA, carte Maestro, MasterCard ou paiement d&eacute;mat&eacute;rialis&eacute;. Nos plats sont &eacute;galement disponibles &agrave; emporter. Nous sommes ouverts tous les jours de 18h00 &agrave; 22h00."/>
<meta name="keywords" content="Restaurant, Gabinelli, RIEUMES, 31370, 41 Allée de la Libération, Italienne, Bière, Vin, Pizza, Restauration rapide, Dîner, Parking en libre-service, À emporter"/>
<meta name="phone" content="+330534480963"/>
<meta name="email" content="Gabinelli.pizzandbeer@gmail.com"/>
<meta name="address" content="41 Allée de la Libération, 31370 RIEUMES, France"/>
<meta name="geo.placename" content="RIEUMES"/>
<meta name="geo.region" content="FR"/>
<meta name="geo.position" content="43.4119704;1.1178673"/>
<meta name="ICBM" content="43.4119704, 1.1178673"/>
<meta property="og:type" content="restaurant.restaurant"/>
<meta property="og:url" content="https://gabinelli-pizzeria-rieumes.eatbu.com/"/>
<meta property="og:title" content="Gabinelli, RIEUMES"/>
<meta property="og:image" content="https://cdn.website.dish.co/media/4c/c7/2817154/PIZZANDBEER-RIEUMES-Sans-titre.jpg"/>
<meta property="og:locale" content="fr"/>
<meta property="restaurant:contact_info:street_address" content="41 Allée de la Libération"/>
<meta property="restaurant:contact_info:locality" content="RIEUMES"/>
<meta property="restaurant:contact_info:postal_code" content="31370"/>
<meta property="restaurant:contact_info:country_name" content="France"/>
<meta property="restaurant:contact_info:email" content="Gabinelli.pizzandbeer@gmail.com"/>
<meta property="restaurant:contact_info:phone_number" content="+330534480963"/>
<meta property="restaurant:contact_info:website" content="https://gabinelli-pizzeria-rieumes.eatbu.com/"/>
<meta property="place:location:latitude" content="43.4119704"/>
<meta property="place:location:longitude" content="1.1178673"/>
</head>

<body>
    <header><?php $utilisateur->headerFront(); ?></header>
    <main>
        
        <h1>Votre <?php if($nbCommande != 1) echo $nbCommande . "ème"; else echo $nbCommande . "er"; ?> commande est confirmée ! </h1>
        
        <p>Commandé par : <i><?= $userCommande['email'] ;
        var_dump($userCommande)?></i></p>
        
        <p>
            acheter le <?= $userCommande['vente_date'] ?>
        </p>
        
        
<h2>Adresse de livraison : </h2>

<p>Vous allez être livré(e) d'ici deux semaines au :
    </p>
    
    <p><?= $userCommande['rue'] . " " . $userCommande['ville'] . " " . $userCommande['code_postal'] ?></p>
    
    <p></p>
    
    <p></p>
    <?php
foreach($produits as $produit):
    // var_dump($produit);
    ?>
<!-- afficher un produit -->
<article class="produit-preview">
    <tr>
        <td>
            <p>Article : <b><?= $produit["nom"] ?></b></p>
        </td>
                            <td>
                                <a href="produit?produit=<?= $produit["id"] ?>">
                                    
                                    <img class="miniature" src="<?= $produit["img_dir"] ?>" alt="">
                                    
                                </a>
                            </td>
                            <td>
                                <p><i><?= $produit["nom_categ"] ?></i></p>
                            </td>
                            <td>
                                <p><?= $produit["description"] ?> </p>
                            </td>
                            <td>
                                <p><?= $produit["prix"] * $produit['quantite'] ?>€</p>
                            </td>
                            
                            
                            <?php endforeach; ?>
                            <h2>Merci pour votre achat !</h2>
                            
    <p>à bientôt</p>
</main>
<footer>
    <?php include_once('View/include/footer.php'); ?>
</footer>
</body>
</html>