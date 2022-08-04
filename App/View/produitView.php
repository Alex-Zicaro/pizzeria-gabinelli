<?php
use App\Controller\{Paniers, Produits, Images, Commentaires, Utilisateurs,Commandes,Controller};

$obj = new Produits;
$image = new Images;
$commande = new Commandes;
$commentaire = new Commentaires;
$utilisateur = new Utilisateurs;
$panier = new Paniers;
$controller = new Controller;

var_dump($_SESSION['url'])

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
    <main>

<?php


// var_dump($_GET);
// if(isset($_GET['deconnexion']))
// header('location: connexion');

if (isset($_GET["produit"])) {
    $verifAdresse = $commande->commande->checkAdresse();
    $id_produit = strip_tags(htmlspecialchars($_GET["produit"]));
    $produit = $obj->afficheLeProduit($_GET["produit"]);
    $nb_comment = $commentaire->commentaire->countComment($_GET["produit"]);
    // var_dump($nb_comment);
    //je get le produit dans la methode count comment

    $lesCommentaires = $commentaire->commentaire->selectComment($_GET['produit']);
    // $lesCommentaires = $commentaire->paginationCom($_GET['produit']);


    if (isset($_POST['quantite']) && isset($_POST['submit'])) {

        
            $panier->ajouterArticle($_POST['quantite'], $id_produit);
        
        $session = $panier->stripeUnArticle($panier->calculeMontant($produit['prix'], $_POST['quantite']), $produit['nom']);
    }
}

var_dump($obj->modifProduit());
if ($obj->modifProduit() != true) {

    if (isset($_POST["postCom"])) {
        // var_dump($_POST["contenu"]);
        $msgErr = $commentaire->add($_POST["titre"], $_POST["contenu"], $_POST["note"], $_GET['produit']);
    }

?>

    <section>
        <?php
        if(isset($msgErr) && $msgErr != "Commentaire posté !"){
            ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $msgErr; ?>
                </div>
            <?php
        } else if (isset($msgErr) && $msgErr == "Commentaire posté !") {
            ?>
            <div class="alert alert-success" role="alert">
                <?php echo $msgErr; 
                // header('location: produit?produit='.$_GET['produit']); ?>
                
                </div>
            <?php
        }
        ?>
        <article class="produit">
            <img id="produit-img" src="<?= $produit["img_dir"] ?>" alt="">
            <div class="infos">
                <h2><b><?= $produit["nom"] ?></b></h2>

                <p><b>Catégorie : </b><?= $produit["nom_categ"] ?></p>


                <p><b>Description : </b><?= $produit["presentation"] ?></p>
                <div class="bottom">

                    <h2 id="prix"><b>Prix à l'unité : <?= $produit["prix"] ?>€</b></h2>

                    <form method="post" id="cart-form" enctype="multipart/form-data">
                        <label for="q">Quantité : </label>
                        <div id="inputs">

                            <input type="hidden" name="l" value="<?= $produit["id"] ?>">
                            <input type="number" name="quantite" min="0" value="1">


                            
                            <input type="submit" id="submit-to-cart" value="Ajouter au panier" name="submit">
                        </form>
                        
                            
                            <button id='checkout-button' value="acheter">Payer</button>

                </div>
            </div>
            </div>
        </article>

        <hr>
        <h1>Avis des utilisateurs</h1>

        <?php if (isset($_SESSION['profil'])) { ?>
            <article class="pt-4">
                <form action="" method="POST" enctype="multipart/form-data">

                    <label for="titre">Titre : </label>
                    <input type="text" name="titre" required>

                    <label for="note">Note / 10 : </label>
                    <input type="number" name="note" min="1" max="10" required>

                    <label for="contenu">Votre commentaire : </label>
                    <input type="text" name="contenu" required>

                    <input type="submit" name="postCom" value="envoyer">

                </form>
            </article>
        <?php } else {
        ?>

            <a href="connexion">

                <h2 class="pt-4">Se connecter pour poster un commentaire</h2>
            </a>

        <?php } ?>
        <article class="pt-4">
            <?php
            // var_dump($_GET);

            // echo"<pre>";
            // var_dump($lesCommentaires);
            // echo"</pre>";

            foreach ($lesCommentaires as $com) {
                // echo"kmjl   ekljkjklfkljqskdkjlfqjklfsqdkjlfqjlks";
                // var_dump($com);
                if (isset($_SESSION['profil'])) {
                    if ($com['droit'] == 'admin' || $com['id_utilisateur'] == $_SESSION['profil']['id']) {

                        if (isset($_GET['supression']) && $_GET['supression'] !== 0) {

                            $commentaire->delete($_GET['supression']);
                            // il faut que je remetre bien l'url après la supression
                            // il faut imposé qu'un seul commentaire par utilisateur sûre un produit
                            if(!headers_sent()){
                                header('Location: produit?produit=' . $id_produit);
    
                                die();
                            }
                            else if(headers_sent()) {
                                echo"<script>window.location.href='produit?produit=$id_produit'</script>";
                            }
                        }

            ?>

                        <a href="produit?produit=<?= $produit['id'] ?>&supression=<?= $com['id']; ?>" >

                            <button class="btn btn-danger">Supprimer</button>

                        </a>
                        
                        <?php

                        if ($com['id_utilisateur'] == $_SESSION['profil']['id'] && empty($modifier)) {

                            if (isset($_GET['modifier']) && $_GET['modifier'] !== 0) {

                                $modifier = true;

                                if (isset($_POST['modifier'])) {
                                    // var_dump($id_produit);

                                    $commentaire->modifier($_GET['modifier'], $_POST['titre'], $_POST['contenu'], $_POST['note']);
                                    header('Location: produit?produit=' . $_GET['produit']);
                                    die();
                                }
                            }

                        ?>

                            <a href="produit?produit=<?= $produit['id'] ?>&modifier=<?= $com['id']; ?>">
                                <button class="btn btn-warning">
                                    Modifier
                                </button>
                            </a>

                    <?php

                        }
                    }
                }
                if (empty($modifier) || $modifier === false) {
                    // var_dump($com['id_utilisateur']);
                    ?>
                    <img src="<?= $com["img_dir"] ?>" alt="" class="small-pfp">
                    <h3 style="color: black">Titre : <?= $com["titre"]; ?></h3>

                    <p><?= $com["note"]; ?>/10</p>

                    <p>Commentaire : <?= $com["contenu"] ?></p>

                    <p>écrit par : <?= $com["prenom"] ?></p>
                    <hr>
                <?php
                } else if ($modifier === true) {

                    // echo "test";
                ?>

                    <img src="<?= $com["img_dir"] ?>" alt="" class="small-pfp">

                    <form action="" method="POST" enctype="multipart/form-data">

                        <label for="titre">Titre : </label>
                        <input type="text" name="titre" value="<?= $com["titre"]; ?>">

                        <label for="note">Note / 10 : </label>
                        <input type="number" name="note" value="<?= $com["note"]; ?>" min="1" max="10" required="required">

                        <label for="contenu">Votre commentaire : </label>
                        <input type="text" name="contenu" value="<?= $com["contenu"]; ?>">

                        <p>écrit par : <?= $com["login"] ?> (c'est vous)</p>

                        <input type="submit" class="btn btn-info" name="modifier" value="envoyer">
                    </form>


            <?php

                    $modifier = false;
                }
            }
            // echo"<pre>";
            // var_dump($comPagination);
            // echo"</pre>";
            ?>
        </article>
    </section>


    <?php

    if (isset($_POST["submit"])) {
        $panier = new Paniers;
        $panier->creationPanier();
        // $panier->ajouterArticle($_POST["quantite"], $produit["id"]);
    }
} else {
    // var_dump($produit);
    if (isset($_POST["envoyeAdmin"])) {
        // je lui dis que si la valeur ne reste pas la même je fais une modification au niveau de la base de donné

        $test = $obj->updateProduit($produit);
        header('Location: admin');

    }
    ?>


    <section>
        <article class="produit">

            <img id="produit-img" src="<?= $produit["img_dir"] ?>" alt="">

            <form method="POST" class="infos" action="" enctype='multipart/form-data'>

                <div class="infos">

                    <label for="nom">Nom du produit : </label>
                    <input type="text" value="<?= $produit["nom"] ?>" id="nom" name="nom"></input>

                    <label for="categ">Catégorie : </label>
                    <input type="text" value="<?= $produit["categ"] ?>" id="categ" name="categ"></input>

                    <label for="sous">Sous catégorie : </label>
                    <input type="text" value="<?= $produit["sous_nom"] ?>" id="sous" name="sous">

                    <label for="description">Description : </label>
                    <input type="text" value="<?= $produit["description"] ?>" id="description" name="description">

                    <label for="presentation">Presentation : </label>
                    <input type="text" value="<?= $produit["presentation"] ?>" id="presentation" name="presentation">

                    <div class="bottom">

                        <label for="prix">Prix à l'unité (€) : </label>
                        <input type="number" value="<?= $produit["prix"] ?>" id="prix" name="prix">

                        <input type="file" name="fichier" id="fichier">

                        <input type="submit" name="envoyeAdmin">


                    </div>
                    <a href="profil">
            <button class="btn btn-danger">Retour</button>
            </a>
                </div>

            </form>
        </article>
    </section>
<?php
}
?>
</main>

<script src="https://js.stripe.com/v3/"></script>

<script>
var stripe = Stripe('pk_test_51KgrypCjcUSLVoiTB1nMuHVSP3VOp697YcRw7TTcZoQ3fOUuu1b1X7YQ82eS8rhODsIpz3SrssbGpX6MvWlvbO9F00TuepbAvt');
const btn = document.querySelector("#checkout-button")
btn.addEventListener('click', function(e) {
    e.preventDefault();
    stripe.redirectToCheckout({
        sessionId: "<?= $session->id; ?>"
    });
});
</script>
    </main>

    <footer>
    <?php include_once('View/include/footer.php') ?>
    </footer>
</body>
</html>