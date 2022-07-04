<?php

use App\Controller\Utilisateurs;

$utilisateur = new Utilisateurs;
$image = new App\Controller\Images;
$utilisateur->verifConnect();

?>

<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title></title>



	<link rel="stylesheet" href="CSS/inscription.css">
	<meta name="robots" content="noindex, follow">
	<!-- <script nonce="4044afe9-c014-42ec-953b-c0ca2fe43ed1">(function(w,d){!function(a,e,t,r){a.zarazData=a.zarazData||{},a.zarazData.executed=[],a.zaraz={deferred:[]},a.zaraz.q=[],a.zaraz._f=function(e){return function(){var t=Array.prototype.slice.call(arguments);a.zaraz.q.push({m:e,a:t})}};for(const e of["track","set","ecommerce","debug"])a.zaraz[e]=a.zaraz._f(e);a.zaraz.init=()=>{var t=e.getElementsByTagName(r)[0],z=e.createElement(r),n=e.getElementsByTagName("title")[0];for(n&&(a.zarazData.t=e.getElementsByTagName("title")[0].text),a.zarazData.x=Math.random(),a.zarazData.w=a.screen.width,a.zarazData.h=a.screen.height,a.zarazData.j=a.innerHeight,a.zarazData.e=a.innerWidth,a.zarazData.l=a.location.href,a.zarazData.r=e.referrer,a.zarazData.k=a.screen.colorDepth,a.zarazData.n=e.characterSet,a.zarazData.o=(new Date).getTimezoneOffset(),a.zarazData.q=[];a.zaraz.q.length;){const e=a.zaraz.q.shift();a.zarazData.q.push(e)}z.defer=!0;for(const e of[localStorage,sessionStorage])Object.keys(e||{}).filter((a=>a.startsWith("_zaraz_"))).forEach((t=>{try{a.zarazData["z_"+t.slice(7)]=JSON.parse(e.getItem(t))}catch{a.zarazData["z_"+t.slice(7)]=e.getItem(t)}}));z.referrerPolicy="origin",z.src="/cdn-cgi/zaraz/s.js?z="+btoa(encodeURIComponent(JSON.stringify(a.zarazData))),t.parentNode.insertBefore(z,t)},["complete","interactive"].includes(e.readyState)?zaraz.init():a.addEventListener("DOMContentLoaded",zaraz.init)}(w,d,0,"script");})(window,document);</script></head> -->

<body>
	<main>

		<div class="main">
			<div class="container">
				<div class="booking-content">
					<div class="booking-image">
						<img class="booking-img" src="View/media/pizzaInscription.jpg" alt="image d'une pizza">
					</div>
					<div class="booking-form">
						<form id="booking-form">
							<h2>Inscription</h2>
							<div class="form-group form-input">
								<input type="text" name="prenom" id="prenom" value="" required />
								<label for="prenom" class="form-label" id="prenom">Votre prenom</label>
							</div>

							<div class="form-group form-input">
								<input type="text" name="nom" id="nom" value="" required />
								<label for="nom" class="form-label">Votre nom</label>
							</div>

							<div class="form-group form-input">
								<input type="email" name="email" id="email" value="" required />
								<label for="email" class="form-label">Votre email</label>
							</div>

							<div class="form-group form-input">
								<input type="password" name="password" id="password" value="" required />
								<label for="password" class="form-label">Votre mot de passe</label>
							</div>

							<div class="form-group form-input">
								<input type="password" name="confirmation" id="confirmation" value="" required />
								<label for="confirmation" class="form-label">Confirmation</label>
							</div>
							<fieldset>

								<legend>Choisir sa civilité </legend>

								<div class="form-group form-input">
									<input type="radio" name="Madame" id="Madame" value="" required />
									<label for="Madame" class="">Mme.</label>
								</div>

								<div class="form-group form-input">
									<input type="radio" name="Monsieur" id="Monsieur" value="" required />
									<label for="Monsieur" class="">Mr.</label>
								</div>

							</fieldset>

							
								<!-- <input type="submit" name="envoyer" id="envoyer" value="" required /> -->
								<!-- <label for="envoyer" class="envoyer">S'inscrire</label> -->
							

							<input type="submit" name="Envoyer" class="padding-top">
							
	<p>* = obligatoire</p>
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