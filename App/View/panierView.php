<?php




// require_once('vendor/autoload.php');
use App\Controller\{Paniers,Utilisateurs};
// session_destroy();
$obj = new Paniers;
$utilisateur = new Utilisateurs;

$erreur = false;
// ici il faut gérer dynamiquement le panier
// var_dump($_SESSION['panier']);
// var_dump($_SESSION['panier']);

$action = (isset($_POST['action']) ? $_POST['action'] : (isset($_GET['action']) ? $_GET['action'] : null));

if ($action !== null) {
   $array = $obj->Prepare($action);
   // echo('Vous devez être connecté pour effectuer un achat');
}
if (!$erreur && isset($_GET['action'])) {
   
   $obj->switchaction($action, $array['id'], $array['quantite']);
}
if (!$erreur && isset($_POST['action'])) {
   $obj->switchaction($action, $array['id'],$array['quantite']);
}
if(isset($_POST['vider'])){
   unset($_SESSION['panier']);
   header("Refresh:0");
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="View/CSS/style.css">
	<link rel="stylesheet" href="View/CSS/accueil.css">
	<link rel="stylesheet" href="View/CSS/accueil2.css">
	<link rel="stylesheet" href="View/CSS/include.css">
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
	<?php $utilisateur->headerFront(); ?>
</header>

<body>
<form method="POST" action="">
   <table>
      <tr>
         <td colspan="4">Votre panier</td>
      </tr>
      <tr> 
         <td>Libellé</td>
         <td>Quantité</td> 
         <td>Prix Unitaire</td>
         <td>Action</td>
      </tr>
      
      
      <?php
      if ($obj->creationPanier() && isset($_SESSION['panier'])) {
         $nbArticles = count($_SESSION['panier']['idProduit']);
         if ($nbArticles <= 0) { ?>
            <tr>
               <td>Votre panier est vide
                  <td>
                     </tr>
                     <?php
         } else {
            
            if (isset($_SESSION['panier']['idProduit'])){
               $lesProduitsDupanier = $obj->afficherAupanier($_SESSION['panier']['idProduit']);
            }
// var_dump($lesProduitsDupanier);

            for ($i = 0; $i < $nbArticles; $i++) {

               

               
               ?>
               <tr class="article-row">


               
                  
                  <td>
                     <a href="produit?produit=<?= $lesProduitsDupanier[$i][0]['id'] ?>">
                  <img class="miniature" src="<?= $lesProduitsDupanier[$i][0]["img_dir"] ?>" alt="<?= $lesProduitsDupanier[$i][0]['nom'] ?>">
                     <?= $lesProduitsDupanier[$i][0]["nom"]; ?> 
                     </a>
                  </td>

                  <td><input type="number" min="0" max="" size="4" name="quantite[]" value="<?= htmlspecialchars($_SESSION['panier']['qteProduit'][$i]) ?>"></td>
                  <td><?= $lesProduitsDupanier[$i][0]["prix"]; ?>€</td>
                  <td><a href="<?= htmlspecialchars("panier?action=suppression&id=" . rawurlencode($lesProduitsDupanier[$i][0]["id"])) ?>">Supprimé l'article</a></td>
                  
               </tr>
               
               <?php
               $montant = $obj->MontantGlobal($lesProduitsDupanier);
               

               echo"onarrivea rentrer ici quand lememe";
                     $session = $obj->stripe($montant, 'article'); 
            
            }

            // il faut envoyé l'array des nom le prix globale

            if(isset($_POST['Modifier'])){
               header('Refresh:0');

            }
            if(isset($_POST['Acheter'])){
               $obj->LockPanier();
            }
            ?>

            <tr>

               <td colspan="2"></td>
               <td colspan="2">Total : <?= $montant ?>€</td>

            </tr>
            <tr>

               <td colspan="4">
                  <input type="submit" value="Modifier" class="btn btn-outline-warning " />
                  <input type="hidden" name="action" value="refresh"/>
                  <?php if(isset($pasCo)) echo $pasCo; else  ?>
                  <a href="paye" class="btn btn-primary">Payer</a>
                  <input id="checkout-button" name="Acheter" value="Acheter" type="submit">

                  <input type="submit" class="btn btn-primary" name="vider" value="vider">


               </td>
            </tr>
      <?php
         }
      }
      ?>
   </table>

</form>


<script src="https://js.stripe.com/v3/"></script>

<?php if(isset($_SESSION['profil'])){ ?>

<script>
   var stripe = Stripe('pk_test_51KgrypCjcUSLVoiTB1nMuHVSP3VOp697YcRw7TTcZoQ3fOUuu1b1X7YQ82eS8rhODsIpz3SrssbGpX6MvWlvbO9F00TuepbAvt');
   const btn = document.querySelector("#checkout-button")
   btn.addEventListener('click', function(e) {
      stripe.redirectToCheckout({

         sessionId: "<?= $session->id; ?>"

      });
   });

</script>

<?php } else {

   $pasCo = "Vous devez être connecté pour passer la commande";
} ?>

