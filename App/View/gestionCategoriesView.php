<?php

use App\Controller\{Utilisateurs,Produits};

$categories = new Produits;

$utilisateur = new Utilisateurs;


    $utilisateur->userAdmin($_SESSION['profil']['id']);


$data = $categories->produit->selectCategories();

// $test = $categories->produit->queLesCateg();



if(isset($_POST["modifier"])){
    $categories->modifierCategorie($_POST['nom_categorie'],$_POST['id_categorie']);
}	

if(isset($_POST['ajouter'])){
    
    $categories->addLaCateg($_POST['nom']);
}

if(isset($_GET['id']) && isset($_GET['delete']) && $_GET['delete'] == 'true'){
    $categories->deleteCateg($_GET['id']);
}





//ajouter categ / modifier categ / supprimer categ

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="View/CSS/style.css">

    <link rel="stylesheet" href="View/CSS/include.css">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">    <title>Pizzeria gabinelli</title> -->

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
    <header>
        <?php $utilisateur->headerFront(); ?>
    </header>
    
    
    <main>
    <form action="" method="POST" class="mb-8">
        <h2 class="colorWhite">Ajouter une catégorie</h2>
        <label for="nom">Nom de la catégorie : </label>
        <input type="text" name="nom" id="nom">
        
        <input type="submit" name="ajouter" value="Ajouter">
    </form>
    
    
    
    <section>
        <article>
            <h2 class="">Modifier les catégories</h2>
            <table>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    // echo"<pre>";
                    // var_dump($data);
                    // echo"</pre>";
                    foreach($data as $categ): 
                    // var_dump($categ);
                    // $sous_data = $categories->produit->queLesSousCateg($categ['id']);
                    // var_dump($sous_data);
                    ?>
                    <tr>
                        
                        <?php 
                         if(isset($_GET['id']) && $_GET['id'] == $categ['id']){ ?>
                            
                            <form action="" method="POST">
            <label for="nom" class="">Nom :</label>
            <input type="text" name="nom_categorie" value="<?= $categ['nom_categ'] ?>">
            <input type="hidden" name="id_categorie" value="<?= $categ['id'] ?>">
            <input type="submit" name="modifier" value="modifier">
        </form>
        
        <?php
                        } 
                        else {
                            echo"<td>".$categ['nom_categ']."</td>";
                            echo"<td><a href='?id=".$categ['id']."'>Modifier</a>";
                            echo"<a href='?id=".$categ['id']."&delete=true'>Supprimer</a></td>";
                        } ?>
                    </tr>
                    <?php 
                // var_dump($categ);
            endforeach; ?>
                </tbody>
            </table>
            
        </article>
        
            <a href="admin">
                <button class="btn btn-danger">Retour</button>
            </a>
            </section>
        </main>
        <footer>
            <?php include_once('View/include/footer.php'); ?>
        </footer>

        
    </body>
    </html>