<?php

use App\Controller\{Utilisateurs,Controller,Images};

$utilisateur = new Utilisateurs;
$controller = new Controller;
$image = new Images;
$utilisateur->verifConnect();
if (isset($_POST['Envoyer'])) {
	$msgErr = $utilisateur->register($_POST['email'], $_POST['password'], $_POST['confirmation'], $_POST['prenom'], $_POST['nom'], $_POST['civilite']);
}
// var_dump($_FILES);
// var_dump($_SESSION['err']);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
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

	<link rel="stylesheet" href="View/CSS/inscription.css">
	<link rel="stylesheet" href="View/CSS/include.css">
	<link rel="stylesheet" href="View/CSS/accueil.css">
<link rel="stylesheet" href="View/CSS/accueil2.css">


	<!-- CSS only -->
	<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous"> -->
	<meta name="robots" content="">

<body>
<header>
	<?php $utilisateur->headerFront(); ?>
</header>
	<main>

		<div class="main">
			<div class="container">
				<div class="booking-content">
					<div class="booking-image">
						<img class="booking-img" src="View/media/pizzaInscription.jpg" alt="image d'une pizza">
					</div>
					<div class="booking-form">
						<form id="booking-form" enctype="multipart/form-data" method="POST">
							<h2>Inscription</h2>
							<?php if (isset($msgErr) && $msgErr !== 'Votre compte a bien été créé !') {
				?><p class="alert alert-danger"><?= $msgErr;}?></p> 

<?php if (isset($msgErr) && $msgErr == 'Votre compte a bien été créé !') {
				?><p class="alert alert-success"><?= $msgErr;}?></p> 
				
				

							<div class="form-group form-input">
								<input type="text" name="prenom" id="prenom" value="<?php
								if(isset($_POST['prenom']))

									echo $controller->security($_POST['prenom']) ;
								?>" required />
								<label for="prenom" class="form-label" id="prenom">*Votre prenom</label>
							</div>

							<div class="form-group form-input">
								<input type="text" name="nom" id="nom" value="<?php
								if(isset($_POST['nom']))

									echo $controller->security($_POST['nom']) ;
								?>
								" required />
								<label for="nom" class="form-label">*Votre nom</label>
							</div>

							<div class="form-group form-input">
								<input type="email" name="email" id="email" value="<?php
								if(isset($_POST['email']))

									echo $controller->security($_POST['email']) ;
								?>" required />
								<label for="email" class="form-label">*Votre Email</label>
							</div>



							<div class="form-group form-input">
								<input type="password" name="password" id="password" autocomplete = "off" required />
								<label for="password" class="form-label">*Votre mot de passe</label>
							</div>

							<div class="form-group form-input">
								<input type="password" name="confirmation" id="confirmation" autocomplete = "off" required />
								<label for="confirmation" class="form-label">*Confirmation</label>
							</div>

							<div class="form-group form-input">
								<input class="form-control" type="file" name="fichier" id="fichier">
								<label class="form-label" for="fichier"> <b>Votre image</b> </label>
							</div>
							<fieldset>

								<legend>*Choisir sa civilité </legend>

								<div class="form-group form-input">
									<input type="radio" name="civilite" id="Madame" value="Madame" value="" required />
									<label for="Madame" class="">Mme.</label>
								</div>

								<div class="form-group form-input">
									<input type="radio" name="civilite" id="Monsieur" value="Monsieur" value="" required />
									<label for="Monsieur" class="">Mr.</label>
								</div>

							</fieldset>




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
		<?php include_once ('include/footer.php'); ?>
	</footer>

</body>

</html>