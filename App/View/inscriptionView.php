<?php

use App\Controller\Utilisateurs;

$utilisateur = new Utilisateurs;
$image = new App\Controller\Images;
$utilisateur->verifConnect();
if (isset($_POST['Envoyer'])) {
	$msgErr = $utilisateur->register($_POST['email'], $_POST['password'], $_POST['confirmation'], $_POST['prenom'], $_POST['nom'], $_POST['civilite']);
}
// var_dump($_SESSION['err']);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title></title>

	<link rel="stylesheet" href="CSS/inscription.css">

	<!-- CSS only -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
	<meta name="robots" content="">

<body>
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
							<?php if (isset($msgErr)) {
				?><p class="alert alert-dange"><?= $msgErr;}?></p> 
							<div class="form-group form-input">
								<input type="text" name="prenom" id="prenom" value="" required />
								<label for="prenom" class="form-label" id="prenom">*Votre prenom</label>
							</div>

							<div class="form-group form-input">
								<input type="text" name="nom" id="nom" value="" required />
								<label for="nom" class="form-label">*Votre nom</label>
							</div>

							<div class="form-group form-input">
								<input type="text" name="email" id="email" value="" required />
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
								<input class="form-control" type="file">
								<label class="form-label" for="fichier" name="fichier"> <b>Votre image</b> </label>
							</div>
							<fieldset>

								<legend>*Choisir sa civilité </legend>

								<div class="form-group form-input">
									<input type="radio" name="civilite" value="Madame" value="" required />
									<label for="Madame" class="">Mme.</label>
								</div>

								<div class="form-group form-input">
									<input type="radio" name="civilite" value="Monsieur" value="" required />
									<label for="Monsieur" class="">Mr.</label>
								</div>

							</fieldset>




							<!-- <input type="submit" name="envoyer" id="envoyer" value="" required /> -->
							<!-- <label for="envoyer" class="envoyer">S'inscrire</label> -->


							<input type="submit" name="Envoyer" class="padding-top">

							<p><i>* = obligatoire</i></p>
						</form>
					</div>
				</div>
			</div>
		</div>
	</main>


	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
	<script>
		window.dataLayer = window.dataLayer || [];

		function gtag() {
			dataLayer.push(arguments);
		}
		gtag('js', new Date());

		gtag('config', 'UA-23581568-13');
	</script>
	<script defer src="https://static.cloudflareinsights.com/beacon.min.js/v652eace1692a40cfa3763df669d7439c1639079717194" integrity="sha512-Gi7xpJR8tSkrpF7aordPZQlW2DLtzUlZcumS8dMQjwDHEnw9I7ZLyiOj/6tZStRBGtGgN6ceN6cMH8z7etPGlw==" data-cf-beacon='{"rayId":"7255c9046908100a","token":"cd0b4b3a733644fc843ef0b185f98241","version":"2022.6.0","si":100}' crossorigin="anonymous"></script>
</body>

</html>