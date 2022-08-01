<?php

use App\Controller\{Utilisateurs};

$utilisateurs = new Utilisateurs;
// var_dump($_SESSION);
if($utilisateurs->userAdmin($_SESSION['profil']['id']) === false ){
    header("location: error404.php");
}

$utilisateurss = $utilisateurs->utilisateur->getAllUser();

// var_dump($utilisateurs);
if (isset($_GET['id'])) {

    $infoUser = $utilisateur->selectUser($_GET['id']);
    if ($infoUser['id_droits'] != 42) {

        $utilisateur->delete(1);
    }
}


// var_dump($infoUser);
?>



            <!DOCTYPE html>
            <html lang="fr">

            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="View/CSS/inscription.css">
                <link rel="stylesheet" href="View/CSS/accueil.css">
                <link rel="stylesheet" href="View/CSS/accueil2.css">
                <link rel="stylesheet" href="View/CSS/include.css">
                <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->

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
    <section class="row">

        <?php foreach ($utilisateurss as $utilisateur) {
            // var_dump($utilisateur);
            // var_dump($utilisateur);
            if ($utilisateur['droit'] == 'admin') {
                continue;
            }
        ?>
                <article class="col-md-3">

                    <div class="card">
                        <img class="miniature" src="<?= $utilisateur['img_dir'] ?>" class="card-img-top" alt="non-available">

                        <div class="card-body">

                            <h5 class="card-title">Login : <?= $utilisateur['email'] ?></h5>
                            <p class="card-text">Prenom : <?= $utilisateur['prenom'] ?></p>
                            <p class="card-text">Nom : <?= $utilisateur['nom'] ?></p>
                            <p class="card-text">Civilite : <?= $utilisateur['civilite'] ?> </p>

                            <a href="admin?delete=<?= $utilisateur['id'] ?>">
                                <button class="btn btn-danger">Bannir</button>
                            </a>
                        </div>
                    </div>

                </article>
            <?php
        }
            ?>
    </section>
</main>

<?php include_once('View/include/header.php'); ?>
</body>

</html>