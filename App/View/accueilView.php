<?php

use App\Controller\{Utilisateurs,Controller,Produits};

$utilisateur = new Utilisateurs();
$produit = new Produits();

$lastProduit = $produit->produit->FourLastProduit();
// var_dump($lastProduit);
// session_destroy();

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <!-- <link rel="stylesheet" href="View/CSS/accueil.css"> -->
    <!-- <link rel="stylesheet" href="View/CSS/accueil2.css"> -->
    <link rel="stylesheet" href="View/CSS/include.css">
    <link rel="stylesheet" href="View/CSS/style.css">
    <!-- <link rel="stylesheet" href="View/CSS/inscription.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>

<body>
    <header>
    <?php $utilisateur->headerFront(); ?>
    </header>



<!-- top home page -->
    <div class=" container ">

        <div class="centrage">
            <div class="verybig-padding-y-l big-padding-y">
                <div class="">

                    <section class="grid-container">


                        <article >

                            <div class="">
                                <a href="produits?categorie=1">
                                    <img src="View/media/saucetomate.jpg" style="max-width: 338px" alt="Sauce Tomate" />

                                </a>
                                <a href="produits?categorie=2">
                                    <img src="View/media/télécharger.jpg" style="max-width: 300px" alt="Créme fraiche">

                                </a>
                                <div class="cache"></div>
                            </div>

                            

                        </article>




                    </section>
                </div>
            </div>
        </div>


        <div class="relative">
            <div class="image-pizza1">
                <img class="svg" src="templates/captain/img/interface/pizzamoment2.png" alt="" width="" />
            </div>
            <div class="image-olive2">
                <img class="svg" src="templates/captain/img/interface/pizzamoment.png" alt="" width="" />
            </div>
            <div class="centrage">
                <div class="verybig-padding-bottom-l big-padding-bottom">
                    <div class="bloc margin-auto">
                        <div class="">
                            <div class="font-size-strate font-family-alt text-align-center text-color-ton2 font-family-title normal-margin-bottom"><span>Gabinelli</span></div>
                            <h1 class="font-size-verybig text-color-ton text-align-center font-family-titre big-margin-bottom">Livraison rapide de pizza RIEUMES 31070</h1>
                            <div class="traitaccueil"></div>

                            <div class="display-flex-l flex-wrap-l">
                                <div class="flex-elem-l flex-grow-5-l">
                                    <div class="bloc anim-fadeInTop vsy">
                                        <h2 class="font-size-big small-margin-bottom text-color-blan">Livraison Pizza à domicile - Gabinelli - Rieumes</h2>

                                        <div class="txt_contenu  onepixel-margin-bottom-l big-margin-bottom">
                                            <p style="text-align: justify;"><span style="font-size: 10pt;">Envie d'apprécier une véritable<strong> pizza italienne</strong> à domicile ?</span></p>
                                            <p style="text-align: justify;"> </p>
                                            <p style="text-align: justify;"><span style="font-size: 10pt;"><strong>PIZZA Gabinelli, </strong>situé à <strong>Rieumes, </strong>vous propose un grand choix de <a title="pizzas savoureuses cuisinées dans le plus grand respect de la tradition italienne."><strong>pizzas</strong> savoureuses cuisinées dans le plus grand respect de la <strong>tradition italienne</strong>.</a></span></p>
                                            <p style="text-align: justify;"> </p>
                                            <p style="text-align: justify;"><span style="font-size: 10pt;"> Venez déguster nos <strong>pizzas</strong> sur place ou en <strong>livraison</strong> dans une ambiance chaleureuse et conviviale, ou savourez nos produits depuis le confort de votre <strong>domicile</strong> grâce à notre service de<strong> livraison gratuite</strong>.</span></p>
                                            <p style="text-align: justify;"> </p>
                                            <p style="text-align: justify;"><span style="font-size: 10pt;">De la <strong>pizza</strong> fromage classique à nos spécialités crèmes ou tomates.</span></p>
                                            <p style="text-align: justify;"> </p>
                                            <p style="text-align: justify;"><span style="font-size: 10pt;">N'oubliez pas de profiter de nos <strong>promotions !</strong></span></p>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="centrage">
            <div class="bloc verybig-padding-bottom-l big-padding-bottom">
                <div class="font-size-strate font-family-alt text-align-center text-color-ton2 normal-margin-bottom"><h2 class="centrer">À découvrir </h2></div>
                



                <section class="row1">

                <?php foreach($lastProduit as $produit){
                    // var_dump($produit['img_dir']);
                    ?>
                    <article>

                        <div>

                    <a href="produit?produit=<?= $produit['id'] ?>" title="<?= $produit['nom']?>">
                        <img class="card-img-top" src="<?= $produit['img_dir'] ?>" alt="<?= $produit['nom_img'] ?>" />
                </a>



                        </div>

                        <div class="ann-elem flex-elem display-flex deplaceeffet">
    

    
                            <div>
                                <div class="ann-titre">
                                    <h2 class="font-size-normal font-family-alt">
                                        <a class="aColorAndSize" href="produit?produit=<?= $produit['id'] ?>" title="<?= $produit['nom']?>"><?= $produit['nom']?></a>
                                    </h2>
                                </div>


                                <div class="display-flex flex-align-items-center flex-justify-space-between">

                                    <div class="">
                                        <span class="ann-detail-libelle font-size-small">Prix : </span>
                                        <span class="ann-detail-valeur font-size-big font-weight-bold"><?= $produit['prix'] ?>€</span>
                                    </div>

                                </div>


                                <div class="ann-desc txt_contenu flex-elem effetsurvol effetsurvolDeplace">
                                    <?= $produit['presentation']; ?>
                                </div>
                            </div>

                            

                        </div>

                    </article>
                    <hr class="margin-bottom-20">
                    <?php } ?>
                </section>
                </div>
                </div>
                </div>
                <footer><?php include_once('View/include/footer.php') ?></footer>

</main>

    test
</body>

</html>