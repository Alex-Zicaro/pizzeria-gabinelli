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
	<title>Pizzeria Gabinelli</title>

	<link rel="stylesheet" href="View/CSS/inscription.css">

	<!-- CSS only -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
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
		<?php include_once ('footer.php'); ?>
	</footer>

</body>

</html>