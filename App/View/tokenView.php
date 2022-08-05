<?php

use App\Controller\Utilisateurs;

$obj = new Utilisateurs;


if (isset($_GET['token']) && $_GET['token'] != '') {
    if (isset($_POST['newpassword'])) {
        $newpsw = $obj->MotDepasseOublié($_GET['token'], $_POST['newpassword']);
    }

?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Gabinelli - RIEUMES | Italienne cuisine proche de moi</title>
        <link rel="stylesheet" href="View/CSS/style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="View/CSS/accueil.css">
        <link rel="stylesheet" href="View/CSS/accueil2.css">
        <link rel="stylesheet" href="View/CSS/include.css">
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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" integrity="sha256-mmgLkCYLUQbXn0B1SRqzHar6dCnv9oZFPEC1g1cwlkk=" crossorigin="anonymous" />
    </head>

    <body>
        <header>

            <?php $obj->headerFront(); ?>
        </header>
        <h2>Récupération de mot de passe</h2>
        <form method="post">
            <div class="container">
                <label for="password"><b>Votre nouveau mot de passe</b></label>
                <input type="password" placeholder="Votre nouveau password" name="newpassword" required>
                <button type="submit">confirmer !</button>
            </div>
            <?php if (isset($newpsw) == true) {
                echo '<p>Votre mot de passe a été changé avec succès !</p>';
            } ?>
        </form>
        </main>
        <footer>
            <?php include_once('View/include/footer.php'); ?>
        </footer>
    </body>

    </html>
<?php } ?>