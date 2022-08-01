<?php

use App\Controller\{Utilisateurs,Images,Produits};

$utilisateur = new Utilisateurs;
$produit = new Produits;
$image = new Images;
$categories = $produit->produit->selectCategories();

// $produits = $produit->afficherLesProduits(); // array des produits


$produits = $produit->Pagination();
// var_dump($produits);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gabinelli - RIEUMES | Italienne cuisine proche de moi</title>
    <link rel="stylesheet" href="View/CSS/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="View/CSS/accueil.css">
    <link rel="stylesheet" href="View/CSS/accueil2.css">
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" integrity="sha256-mmgLkCYLUQbXn0B1SRqzHar6dCnv9oZFPEC1g1cwlkk=" crossorigin="anonymous" />
</head>
<body>
    <header>
    <?php $utilisateur->headerFront(); ?>
    </header>
    
    <main>
    <main>

        <div class="col-md-10 ">

            <h1 class="section-produits">
                <?php if (empty($_GET['categorie'])) {
                    echo "Tout les produits";
                } else {
                    echo "Catégorie : " . ($produits[0][0]['nom_categ']);
                }
                ?>

            </h1>
            <section class="liste-produits">
                <!-- Top produits -->


                <?php
                $nombreDeProduit = sizeof($produits[0]);

                for ($i = 0; $i < $nombreDeProduit; $i++) {
                    // var_dump($produits[0][$i]);
                ?>
                    <a class="article-card" href="produit?produit=<?= $produits[0][$i]["id"] ?>">
                        <article class="produit-preview">
                            <img src="<?= $produits[0][$i]["img_dir"] ?>" alt="<?= $produits[0][$i]["nom_img"] ?>">
                            <div class="desc">
                                <h2><?= $produits[0][$i]["nom"] ?></h2>
                                <h3><?= $produits[0][$i]["nom_categ"] ?></h3>
                                <p><strong>Prix : <?= $produits[0][$i]["prix"] ?>€</strong></p>
                                <p><?= $produits[0][$i]["description"] ?> </p>
                            </div>
                            <!-- il manque le boutton pour envoyer dans le panier & l'image  -->

                            <!-- <p>présenté l'état des stock (stock faible) (disponible</p> -->

                        </article>
                    </a>
                <?php } ?>
            </section>
            <?php

            if ($produits[1] > 1) {
                if (empty($_GET['categorie'])) {

            ?>
                    <nav>
                        <ul class="pagination">
                            <li class="page-item <?= ($produits[2] == 1) ? "disabled" : "" ?>">
                                <a href="produits?page=<?= $produits[2] - 1 ?>" class="page-link">Précédente</a>
                            </li>
                            <?php
                            for ($page = 1; $page <= $produits[1]; $page++) {
                            ?>
                                <li class="page-item <?= ($produits[2] == $page) ? "active" : "" ?>">
                                    <a href="produits?page=<?= $page ?>" class="page-link"><?= $page ?></a>
                                </li>
                            <?php

                            }
                            // var_dump($produits[1]);
                            ?>
                            <li class="page-item <?= ($produits[2] == $produits[1]) ? "disabled" : "" ?>">
                                <a href="produits?page=<?= $produits[2] + 1 ?>" class="page-link">Suivante</a>
                            </li>

                        </ul>
                    </nav>
                <?php } else if (isset($_GET['categorie']) && $_GET['categorie'] != '0') {
                    ?>
                        <nav>
                            <ul class="pagination">
                                <li class="page-item <?= ($produits[2] == 1) ? "disabled" : "" ?>">
                                    <a href="produits?page=<?= $produits[2] - 1 ?>&categorie=<?= $_GET['categorie'] ?>" class="page-link">Précédente</a>
                                </li>
                                <?php
                                for ($page = 1; $page <= $produits[1]; $page++) {
                                ?>
                                    <li class="page-item <?= ($produits[2] == $page) ? "active" : "" ?>">
                                        <a href="produits?page=<?= $page ?>&categorie=<?= $_GET['categorie'] ?>" class="page-link"><?= $page ?></a>
                                    </li>
                                <?php

                                }
                                // var_dump($produits[1] , $produit[2]);
                                ?>
                                <li class="page-item <?= ($produits[2] == $produits[1]) ? "disabled" : "" ?>">
                                    <a href="produits?page=<?= $produits[2] + 1 ?>&categorie=<?= $_GET['categorie'] ?>" class="page-link">Suivante</a>
                                </li>

                            </ul>
                    <?php
                }
            }
                    ?>


    </main>
    </main>
    <footer>

    </footer>
</body>
</html>