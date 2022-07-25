
<?php

use App\Controller\{Utilisateurs, Controller , Images , Commentaires , Produits};

$utilisateur = new Utilisateurs;

$controller = new Controller;

$commentaire = new Commentaires;

$produit = new Produits;

$image = new Images;

$lastUtilisateur = $image->requete->quatreDernierUserEtImage();

$lastCom = $commentaire->commentaire->fourLastCom();

$lastProduit = $produit->produit->FourLastProduit();



// var_dump($lastImage);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="View/CSS/accueil.css">
	<link rel="stylesheet" href="View/CSS/accueil2.css">
	<link rel="stylesheet" href="View/CSS/include.css">
    <link rel="stylesheet" href="View/CSS/style.css">
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <title>Pizzeria gabinelli</title>
</head>
<body>
    <header>
    <?php $utilisateur->headerFront(); ?>
    </header>

    <main>

<section id="admin-section">
    <h1 class="d-flex justify-content-center mb-5">Espace Admin</h1>
    
        <h2><strong>Modération utilisateurs</strong></h2>

        <div class="row">

<h4>Derniers utilisateurs inscrits</h4>
    <?php

foreach ($lastUtilisateur as  $utilisateur) {
    // faire une carte avec les infos de l'utilisateur
    // var_dump($utilisateur['img_dir']);
    ?>

    <div class="col-md-3">
        <div class="card">
                <img src="<?= $utilisateur['img_dir'] ?>" class="card-img-top" alt="...">
            
            <div class="card-body">

            <h5 class="card-title"><?= $utilisateur['email'] ?></h5>
                <p class="card-text"><?= $utilisateur['prenom'] ?></p>
                <p class="card-text"><?= $utilisateur['nom'] ?></p>
                <p class="card-text"><?= $utilisateur['civilite'] ?> </p>

                <a href="admin?delete=<?= $utilisateur['id'] ?>" class="">
                    <button class="btn btn-danger">Bannir</button>
                </a>
            </div>
        </div>
    </div>
    
    
    <?php } ?>
    <a href="gestionUtilisateurs">Voir plus...</a>
</a>
</div>


<h4>Commentaires des utilisateurs</h4>
<article class="row">
        <?php foreach ($lastCom as $com) {
            // var_dump($com);
        ?>

<div class="col-md-3">
        <div class="card">
                <img src="<?= $com['img_dir'] ?>" class="card-img-top" alt="...">
            
            <div class="card-body">

            <h5 class="card-title"><?= $com['titre'] ?></h5>
                <p class="card-text"><?= $com['email'] ?></p>
                <p class="card-text"><?= $com['contenu'] ?> </p>
                <p class="card-text"><?= $com['note'] ?>/10</p>

                <a href="admin?deleteCom=<?= $com['id'] //fonction delete à mettre ?>" class=""> 
                    <button class="btn btn-danger">Supprimer</button>
                </a>
            </div>
        </div>
    </div>


        <?php } ?>
        <a href="gestionComment">Voir plus...</a>

        </article>
    <article>

        
        <h2><strong>Modération produits</strong></h2>
        
        <a href="gestionCategories">

            <button class="btn btn-primary">Ajouter des catégories</button>
        </a>
        <h4>Dernier produits publiés</h4>
        <?php
        // var_dump($lastProduit);
        foreach ($lastProduit as $produit) {
            // var_dump($produit);
        ?>
                <div class="col-md-3">
        <div class="card">
                <img src="<?= $produit['img_dir'] ?>" class="card-img-top" alt="...">
            
            <div class="card-body">

            <h5 class="card-title"><?= $produit['nom'] ?></h5>
                <p class="card-text"><?= $produit['nom_categ'] ?></p>
                <p class="card-text"><?= $produit['prix'] ?> €</p>


                <a href="produit?produit=<?= $produit['id'] ?>" class="">
                    <button class="btn btn-danger">Voir</button>
                </a>
            </div>
        </div>
    </div>
        <?php

        }
        ?>
        <a href="gestionProduits">Voir plus...</a>
        <br><br>
        <a href="addproduits">
        <button class="btn btn-primary">Ajouter un produit</button>
        </a>

    </article>


    <br>
    <a href="profil">
        <button class="btn btn-danger">Retour</button>
        </a>
</section>



</main>

    <footer>
    <?php include_once('include/footer.php') ?>
    </footer>
    
</body>
 