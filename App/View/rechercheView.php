<?php

use App\Controller\{Produits, Utilisateurs, Paniers, StripePaye};

$produits = new Produits;



$utilisateurs = new Utilisateurs;

$panier = new Paniers;

$recherche = $produits->affichageSearch();
// var_dump($_SESSION['recherche']);
// var_dump($recherche);

if (isset($_POST['quantite']) && isset($_POST['submit'])) {


    $panier->ajouterArticle($_POST['quantite'], $_POST['l']);
    $produit = $produits->produit->selectProduit($_POST['l']);

    $session = $panier->stripeUnArticle($panier->calculeMontant($produit['prix'], $_POST['quantite']), $produit['nom']);
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="View/CSS/inscription.css"> -->
    <!-- <link rel="stylesheet" href="View/CSS/accueil.css"> -->
    <link rel="stylesheet" href="View/CSS/style.css">
    <link rel="stylesheet" href="View/CSS/include.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous"> -->

    <title>Gabinelli - RIEUMES | Italienne cuisine proche de moi</title>
    <link rel="canonical" href="https://gabinelli-pizzeria-rieumes.eatbu.com/?lang=fr" />
    <meta name="description" content="Vous pouvez commander à emporter | RIEUMES - Si vous voulez manger un repas italien et &ecirc;tes en qu&ecirc;te d&rsquo;un &eacute;tablissement o&ugrave; passer la soir&eacute;e, vous &ecirc;tes les bienvenus chez nous. Restaurant italien pris&eacute; au centre : Laissez-vous tenter et profitez de la cuisine italienne. Nous sommes r&eacute;put&eacute;s pour notre excellent fast-food. Go&ucirc;tez par exemple &agrave; notre pizza pris&eacute;e. Go&ucirc;tez aussi volontiers un bon verre de vin ou un verre de bi&egrave;re aromatique lorsque vous viendrez nous voir. Venez d&eacute;guster un d&icirc;ner d&eacute;licieux chez nous ! Places de parking particuli&egrave;rement pratiques : Profitez de notre parking gratuit. Contactez-nous et r&eacute;servez d&egrave;s aujourd&rsquo;hui. Il vous suffit de nous contacter par t&eacute;l. au +330562626261. Chez nous, vous pouvez payer soit en esp&egrave;ces soit par carte VISA, carte Maestro, MasterCard ou paiement d&eacute;mat&eacute;rialis&eacute;. Nos plats sont &eacute;galement disponibles &agrave; emporter. Nous sommes ouverts tous les jours de 18h00 &agrave; 22h00." />
    <meta property="og:description" content="Vous pouvez commander à emporter | RIEUMES - Si vous voulez manger un repas italien et &ecirc;tes en qu&ecirc;te d&rsquo;un &eacute;tablissement o&ugrave; passer la soir&eacute;e, vous &ecirc;tes les bienvenus chez nous. Restaurant italien pris&eacute; au centre : Laissez-vous tenter et profitez de la cuisine italienne. Nous sommes r&eacute;put&eacute;s pour notre excellent fast-food. Go&ucirc;tez par exemple &agrave; notre pizza pris&eacute;e. Go&ucirc;tez aussi volontiers un bon verre de vin ou un verre de bi&egrave;re aromatique lorsque vous viendrez nous voir. Venez d&eacute;guster un d&icirc;ner d&eacute;licieux chez nous ! Places de parking particuli&egrave;rement pratiques : Profitez de notre parking gratuit. Contactez-nous et r&eacute;servez d&egrave;s aujourd&rsquo;hui. Il vous suffit de nous contacter par t&eacute;l. au +330562626261. Chez nous, vous pouvez payer soit en esp&egrave;ces soit par carte VISA, carte Maestro, MasterCard ou paiement d&eacute;mat&eacute;rialis&eacute;. Nos plats sont &eacute;galement disponibles &agrave; emporter. Nous sommes ouverts tous les jours de 18h00 &agrave; 22h00." />
    <meta name="keywords" content="Restaurant, Gabinelli, RIEUMES, 31370, 41 Allée de la Libération, Italienne, Bière, Vin, Pizza, Restauration rapide, Dîner, Parking en libre-service, À emporter" />
    <meta name="phone" content="+330534480963" />
    <meta name="email" content="Gabinelli.pizzandbeer@gmail.com" />
    <meta name="address" content="41 Allée de la Libération, 31370 RIEUMES, France" />
    <meta name="geo.placename" content="RIEUMES" />
    <meta name="geo.region" content="FR" />
    <meta name="geo.position" content="43.4119704;1.1178673" />
    <meta name="ICBM" content="43.4119704, 1.1178673" />
    <meta property="og:type" content="restaurant.restaurant" />
    <meta property="og:url" content="https://gabinelli-pizzeria-rieumes.eatbu.com/" />
    <meta property="og:title" content="Gabinelli, RIEUMES" />
    <meta property="og:image" content="https://cdn.website.dish.co/media/4c/c7/2817154/PIZZANDBEER-RIEUMES-Sans-titre.jpg" />
    <meta property="og:locale" content="fr" />
    <meta property="restaurant:contact_info:street_address" content="41 Allée de la Libération" />
    <meta property="restaurant:contact_info:locality" content="RIEUMES" />
    <meta property="restaurant:contact_info:postal_code" content="31370" />
    <meta property="restaurant:contact_info:country_name" content="France" />
    <meta property="restaurant:contact_info:email" content="Gabinelli.pizzandbeer@gmail.com" />
    <meta property="restaurant:contact_info:phone_number" content="+330534480963" />
    <meta property="restaurant:contact_info:website" content="https://gabinelli-pizzeria-rieumes.eatbu.com/" />
    <meta property="place:location:latitude" content="43.4119704" />
    <meta property="place:location:longitude" content="1.1178673" />
</head>

<body>
    <header>
        <?php $utilisateurs->headerFront(); ?>
    </header>
    <main>
        <?php

        if (is_array($recherche)) {
        ?>

            <div class="container">
                <div class="row">
                    <?php
                    foreach ($recherche as $produit) {
                    ?>
                        <div class="col-md-3">
                            <div class="card">
                                <a class="centrer" href="produit?produit=<?= $produit['id'] ?>">

                                    <img src="<?= $produit['img_dir'] ?>" class="card-img-top" alt="...">
                                </a>
                                <div class="card-body">
                                    <h5 class="centrer"><?= $produit['nom'] ?></h5>
                                    <p class="centrer"><?= $produit['presentation'] ?></p>
                                    <p class="centrer"><?= $produit['nom_categ'] ?></p>
                                    <p class="centrer"><?= $produit['prix'] ?> €</p>
                                    <form method="post" id="cart-form" enctype="multipart/form-data">
                                        <label for="q">Quantité : </label>
                                        <div id="inputs">

                                            <input type="hidden" name="l" value="<?= $produit["id"] ?>">
                                            <input type="number" name="quantite" min="0" value="1">



                                            <input type="submit" id="submit-to-cart" value="Ajouter au panier" name="submit">
                                    </form>

                                    <a href="paye?item=<?= $produit['id'] ?>">
                                        <button id='checkout-button' value="acheter">Payer</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        <?php
        } else {

            echo $recherche;
        }
        ?>

        <?php



        ?>
    </main>
    <footer>
        <?php include_once('View/include/footer.php'); ?>
    </footer>
</body>

</html>