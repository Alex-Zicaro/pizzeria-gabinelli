<?php

use App\Controller\{Utilisateurs, Controller , Images , Commentaires , Produits};

$produit = new Produits;

$categories = $produit->produit->selectCategories();

?>
<div class="header ">

    <div class="header-bandeau ">
        <div class="centrage display-flex-l flex-align-items-center-l flex-justify-space-between-l">

            <div class="no-margin-l margin-auto" id="logo">
                <a href="accueil" title="Pizzeria Gabinelli">
                    <img class="logo" src="../media/logo_pizzeria_gabinelli.png" alt="Pizzeria Gabinelli" width="200" />
                </a>
            </div>
            <label id="btMenu" for="ouvre-menu" class=" no-margin-top">
                <span>
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
            </label>
            <div class="display-flex flex-direction-column flex-align-items-end-l flex-grow-9">
                <!-- ici -->
                <nav class="nav no-margin-top display-flex">

                    <ul class="santa hidden">


                        <li class="normal-padding-right-l">
                            <div class="bloc display-flex-l flex-align-items-center display-none" id="tel">
                                <a class="font-size-big font-weight-bold" href="tel:+33488927544" onclick="gtag('event', 'Appel Téléphonique');">
                                    <span class="hotliner">Commande :</span>
                                    <span class="tx">05 34 48 09 63</span>
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <nav class="nav no-margin-top">
                    <ul class="lutin">
                        <li class="active">
                            <a href="profil" title="Accueil">
                                Profil
                            </a>
                        </li>
                        <li>
                            <a href="panier" title="La carte">
                                panier
                            </a>
                        <li>

                            <a href="produits" title="Nos pizzas">
                                Nos pizzas
                            </a>
                            <ul>
                                <?php foreach ($categories as $categorie) {
                                    // var_dump($categorie);
                                ?>
                                    <li>
                                        <a href="produits?categorie=<?= $categorie['id'] ?>" title="Pizza <?= $categorie['nom_categ'] ?>">
                                            <?= $categorie['nom_categ'] ?>
                                        </a>
                                    </li>
                                <?php } ?>

                            </ul>
                        </li>


                        <li>
                            <a href="contact" title="Les salades">
                                Contact
                            </a>
                        </li>
                        <li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

</div>