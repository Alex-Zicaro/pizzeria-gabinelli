<?php

// use App\Controller;

use App\Controller\{Controller, Utilisateurs};

$utilisateur = new Utilisateurs;
$controller = new Controller;

$utilisateur->verifConnect();
if (isset($_POST['Envoyer']))
	$msgErr = $utilisateur->login($_POST['email'], $_POST['password']);

// var_dump($_SESSION);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="View/CSS/inscription.css">
	<title>Document</title>
</head>

<header>
	<?php $utilisateur->headerFront(); ?>
</header>

<body>
	
	<main>
		<div class="main">
			<div class="container">
				<div class="booking-content">
					<div class="booking-image">
						<img class="booking-img" src="View/media/pizzaInscription.jpg" alt="image d'une pizza">
					</div>
					<div class="booking-form">
						<form id="booking-form" method="POST">
							<h2>Connexion</h2>
							<?php if (isset($msgErr)) {
							?><p class="alert alert-danger"> <?= $msgErr; ?> </p> <?php
																					}
																						?>
							<div class="form-group form-input">
								<input type="email" name="email" id="email" value="<?php
																					if (isset($_POST['email']))
																						echo $controller->security($_POST['email']);
																					?>
								" required />
								<label for="email" class="form-label">Votre email</label>
							</div>

							<div class="form-group form-input">
								<input type="password" name="password" id="password" value="" required />
								<label for="password" class="form-label">Votre mot de passe</label>
							</div>

							<input type="submit" name="Envoyer" class="padding-top">

							<p class="padding-top"><i>* = obligatoire</i></p>
						</form>
					</div>
				</div>
			</div>
		</div>
	</main>

	<footer>
		<?php include_once('footer.php') ?>
	</footer>

</body>


</html>