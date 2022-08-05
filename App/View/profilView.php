<?php
namespace App\View;

use App\Controller\{Utilisateurs, Images, Adresses};


$utilisateur = new Utilisateurs;
$image = new Images;
$adresse = new Adresses;
// var_dump($_SESSION);
$utilisateurActuelle = $utilisateur->userConnect();

// var_dump($_SESSION);
$userAdresse = $adresse->getAdresse($_SESSION['profil']['id']);
// var_dump($utilisateurActuelle);
// session_destroy();
if (isset($_POST["Envoyer"]) && isset($_SESSION["profil"])) {

    $utilisateur->CupdateMail($_POST["email"], $_SESSION["profil"]["id"]);
    // $_SESSION["profil"]["email"] = htmlspecialchars(strip_tags($_POST["email"]));
    // Login
    // $_SESSION["profil"]["login"] = htmlspecialchars(strip_tags($_POST["login"])) ;
    // Nom
    $utilisateur->CupdateNom($_POST["nom"], $_SESSION["profil"]["id"]);
    $_SESSION["profil"]["nom"] = htmlspecialchars(strip_tags($_POST["nom"]));
    // Prenom
    $utilisateur->CupdatePrenom($_POST["prenom"], $_SESSION["profil"]["id"]);
    // $_SESSION["profil"]["prenom"] = htmlspecialchars(strip_tags($_POST["prenom"]));
    // // Email
    if(isset($_POST['password']) && isset($_POST['passwordConfirm'])){

        $utilisateur->CupdatePassword($_POST["password"], $_POST['passwordConfirm'] , $_SESSION["profil"]["id"]);
    }
    
        $utilisateur->updateImageUser();

        
    

    header('Refresh:0');

}
// var_dump($_FILES['fichier']);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="View/CSS/profil.css">
    <link rel="stylesheet" href="View/CSS/include.css">
    <!-- <link rel="stylesheet" href="View/CSS/inscription.css"> -->
    <link rel="stylesheet" href="View/CSS/style.css">
    <!-- <link rel="stylesheet" href="View/CSS/accueil2.css"> -->
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


<header>
    <?php 
    // session_destroy();
    $utilisateur->headerFront(); 
        ?>
</header>
<main>
<?php if(empty($_GET['modif']) ){
        // echo "ezaezaeazaez";
        ?>

    <div class="page-content page-container" id="page-content">
        <div class="padding">
            <div class="row container d-flex justify-content-center">
                <div class="col-xl-6 col-md-12">
                    <div class="card user-card-full">
                        <div class="row m-l-0 m-r-0">
                            <div class="col-sm-4 bg-c-lite-green user-profile">
                                <div class="card-block text-center text-white flexer ">

                                    <div class="m-b-25">
                                        <img src="<?=$utilisateurActuelle[0]['img_dir'];?>" class="img-radius" alt="<?= $utilisateurActuelle[0]['nom_img'] ?>" style="">
                                        
                                    </div>
                                    <?php if($userAdresse == false): ?>
                                    <div class="end">
                                        <a href="adresse">
                                            <button class="button">
                                                Ajouter une adresse
                                            </button>
                                        </a>
                                        <?php endif; ?>
                                        <a href="profil?modif=true">

                                            <button class="button button-color-black margin-bot-4">
                                                Modifier
                                            </button>
                                        </a>
                                        <?php if($utilisateurActuelle['droit'] == 'admin'){ ?>

                                        
                                        <a href="admin">

                                            <button class="button button-color-red">
                                                Espace admin
                                            </button>
                                        </a>
                                        <?php } ?>
                                    </div>

                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="card-block">
                                    <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Information</h6>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Email</p>
                                            <h6 class="text-muted f-w-400"><?= $utilisateurActuelle['email'] ?></h6>
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Prenom</p>
                                            <h6 class="text-muted f-w-400"><?= $utilisateurActuelle['prenom'] ?></h6>
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Nom</p>
                                            <h6 class="text-muted f-w-400"><?= $utilisateurActuelle['nom'] ?></h6>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php }
    
    else if(isset($_GET['modif']) && $_GET['modif'] == 'true'){
    // echo 'testsqdfdqsdfqfs';
    ?>
        <div class="page-content page-container" id="page-content">
        <div class="padding">
            <div class="row container d-flex justify-content-center">
                <div class="col-xl-6 col-md-12">
                    <div class="card user-card-full">
                        <div class="row m-l-0 m-r-0">
                            <div class="col-sm-4 bg-c-lite-green user-profile">
                                
                            <div class="main">
			<div class="container">
				<div class="booking-content">
					<div class="booking-form">
						<form id="booking-form" enctype="multipart/form-data" method="POST">
							<h2>Profil</h2>
							<?php if (isset($msgErr) && $msgErr !== 'Votre compte a bien été créé !') {
				?><p class="alert alert-danger"><?= $msgErr;}?></p> 

<?php if (isset($msgErr) && $msgErr == 'Votre compte a bien été créé !') { 
				?><p class="alert alert-success"><?= $msgErr;
            }
                // var_dump($utilisateurActuelle);
                ?></p> 
				
				

                <form method="post" enctype="multipart/form-data">


<div class="infos">
    <h3>Votre login :</h3>
    <input type="text" class="inputText" value="<?= $utilisateurActuelle["email"] ?>" maxlength="32" name="login">
</div>
<div class="infos">
    <h3>Votre prénom :</h3>
    <input type="text" class="inputText" value="<?= $utilisateurActuelle["prenom"] ?>" name="prenom">
</div>
<div class="infos">
    <h3>Votre nom :</h3>
    <input type="text" class="inputText" value="<?= $utilisateurActuelle["nom"] ?>" name="nom">
</div>
<div class="infos">
    <h3>Votre email :</h3>
    <input type="text" class="inputText" value="<?= $utilisateurActuelle["email"] ?>" name="email">
</div>





							<div class="form-group form-input">
								<input type="password" name="password" id="password" autocomplete = "off"  />
								<label for="password" class="form-label">*Votre mot de passe</label>
							</div>

							<div class="form-group form-input">
								<input type="password" name="confirmation" id="confirmation" autocomplete = "off" />
								<label for="confirmation" class="form-label">*Confirmation</label>
							</div>

							<div class="form-group form-input">
								<input class="form-control" type="file" name="fichier" id="fichier">
								<label class="form-label" for="fichier"> <b>Votre image</b> </label>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <?php } ?>
</main>

<footer>
    <?php include_once 'View/include/footer.php'; ?>
</footer>


</html>