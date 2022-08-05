<?php

use App\Controller\{Utilisateurs, Controller, Images, Produits};

$utilisateur = new Utilisateurs;
$controller = new Controller;
$image = new Images;
$produit = new Produits;
$categ = $produit->produit->selectCategories();
// var_dump($_FILES);
// var_dump($_SESSION['err']);



$produit->addProduit();

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gabinelli - RIEUMES | Italienne cuisine proche de moi</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
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

    <!-- <link rel="stylesheet" href="View/CSS/inscription.css"> -->
    <link rel="stylesheet" href="View/CSS/include.css">
    <!-- <link rel="stylesheet" href="View/CSS/accueil.css"> -->
    <link rel="stylesheet" href="View/CSS/style.css">


    <!-- CSS only -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous"> -->
    <meta name="robots" content="">

<body>
    <header>
        <?php $utilisateur->headerFront();

        ?>
    </header>
    <main>

        <div class="main">
            <div class="container">
                <div class="booking-content">
                    <!-- <div class="booking-image booking-img">
					<img src="View/media/pizzaInscription.jpg" alt="">
					</div> -->
                    <div class="booking-form">
                        <form id="booking-form" enctype="multipart/form-data" method="POST">
                            <h2 class="colorWhite">Ajoutez une pizza</h2>
                            <?php
                            // echo $msgErr;
                            if (isset($msgErr) && $msgErr !== 'Votre compte a bien été créé !') {
                            ?><p style="color: #fff"><?= $msgErr;
                                        } ?></p>

                                <?php if (isset($msgErr) && $msgErr == 'Votre compte a bien été créé !') {
                                ?><p class="alert alert-success"><?= $msgErr;
                                                } ?></p>





                                    <div class="form-group form-input">
                                        <input type="text" name="nom" id="nom" value="<?php
                                                                                        if (isset($_POST['nom']))

                                                                                            echo $controller->security($_POST['nom']);
                                                                                        ?>
								" required />
                                        <label for="nom" class="form-label">*Votre nom</label>
                                    </div>

                                    <select class="form-group form-input" value="" name="categorie">

                                        <?php foreach ($categ as $categs) { //Il faut parcourir les categv
                                        ?>


                                                <option name="categorie" style="color: black" value="<?= $categs["id"] ?>" id=""><?= $categs["nom_categ"] ?></option>
                                            </optgroup>
                                        <?php } ?>
                                    </select>

                                    <div class="form-group form-input">
                                        <input type="text" name="description" id="description" value="<?php
                                                                                            if (isset($_POST['email']))
                                                                                                echo $controller->security($_POST['email']);
                                                                                            ?>" required />
                                        <label for="description" class="form-label">*La description</label>
                                    </div>



                                    <div class="form-group form-input">
                                        <input type="text" name="presentation" id="presentation" autocomplete="off" required />
                                        <label for="presentation" class="form-label">*La présentation</label>
                                    </div>

                                    <div class="form-group form-input">
                                        <input type="number" name="prix" id="prix" autocomplete="off" required />
                                        <label for="prix" class="form-label">*Le prix</label>
                                    </div>

                                    <div class="form-group form-input">
                                        <input class="form-control" type="file" name="fichier" id="fichier">
                                        <label class="form-label" for="fichier"> <b>*Photo de la pizza</b> </label>
                                    </div>





                                    <!-- <input type="submit" name="envoyer" id="envoyer" value="" required /> -->
                                    <!-- <label for="envoyer" class="envoyer">S'inscrire</label> -->


                                    <input type="submit" name="Envoyer" class="padding-top">

                                    <p class="padding-top"><i>* = obligatoire</i></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <?php include_once('include/footer.php'); ?>
    </footer>

</body>

</html>