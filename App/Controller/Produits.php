<?php

namespace App\Controller;

use App\Modele\Images;
use App\Controller\{Utilisateurs};

require_once('../vendor/autoload.php');


class Produits extends Controller
{

    public $produit;

    private $nom;

    public $presentation;
    public $description;
    public $quantite;
    public $utilisateur;



    public function __construct()
    {
        $this->produit = new \App\Modele\Produits;
        $this->image = new Images;
        $this->controller = new Controller;
        $this->imageController = new \App\Controller\Images;
        $this->utilisateur = new Utilisateurs;
    }

    /*
    *
    */
    public function afficherLesProduits(?int $id_categorie = null, ?int $order = 0)
    {
        if ($order == 1) {

            $produits = $this->produit->selectProduits($id_categorie, $order);
        }

        $produits = $this->produit->selectProduits($id_categorie);
        // var_dump($produits);
        return $produits;

        // gérer l'érreur si le produit n'éxiste pas et gérer l'ordre maybe

    }

    public function afficheLeProduit(int $id_produit)
    {

        if (isset($id_produit) && !empty($id_produit)) {
            $produit = $this->produit->selectProduit($id_produit);
            return $produit;
        } else {
            header("location: error404.php");
        }
    }

    public function premierForm(int $id_categorie, string $nom, string $presentation, string $description, int $quantite, int $prix)
    {

        if (empty($nom))
            $msgErr = "Votre produit n'a pas de nom !";

        else if (strlen($nom) >= 40) {
            $msgErr = "Le nom de votre produit doit contenir moins de 40 caractères";
        } else if (empty($description) or strlen($description) == 0)
            $msgErr = "Donner une déscription à votre produit !";

        else if (strlen($description) >= 150)
            $msgErr = "Votre description doit contenir moins de 150 caractères";

        else if (strlen($description) <= 10)
            $msgErr = "Votre description doit contenir plus de 10 caractères";

        else if (empty($presentation) or strlen($presentation) == 0)
            $msgErr = "Donner une courte présentation de votre produit";

        else if (strlen($presentation) >= 40)
            $msgErr = "Votre présentation du produit doit contenir moins de 40 caractères";

        else if (empty($quantite))
            $msgErr = "Vous n'avez aucun stock du produit ?";


        if (empty($msgErr) or !isset($msgErr)) {

            $_SESSION["form"]["categorie"] = $id_categorie;
            $_SESSION["form"]["nom"] = $nom;
            $_SESSION["form"]["presentation"] = $presentation;
            $_SESSION["form"]["description"] = $description;
            $_SESSION["form"]["quantite"] = $quantite;
            $_SESSION["form"]["prix"] = $prix;
            return true;
        } else {
            echo $msgErr;
        }
    }


    public function unsetSessionProduit()
    {
        unset($_SESSION["form"]);
        unset($_SESSION["err"]);
        header("Refresh:0");
    }



    public function postProduit($nom, $description, $presentation, $prix, $quantite, $id_categorie)
    {
        $id_image = $this->image->trouverLeDernierId();
        $nom = $this->controller->security($nom);
        $description = $this->controller->security($description);
        $presentation = $this->controller->security($presentation);
        $prix = $this->controller->security($prix);
        $quantite = $this->controller->security($quantite);

        $id_categ = $this->controller->security($id_categorie);
        $this->produit->addProduit($nom, $description, $presentation, $prix, $quantite, $id_categ, $id_image["id"]);
    }

    public function deleteProduit()
    {
        // var_dump($_GET['deleteProduit']);
        if (isset($_GET["deleteProduit"])) {
            $id_produit = (int) $_GET["deleteProduit"];
            // var_dump($id_produit);
            $this->produit->deleteRequete($id_produit);
            header("location: gestionProduits");
        }
    }

    public function modifProduit()
    {
        // echo "on rentre pas ";
        if (isset($_GET["modif"]) && $_GET["modif"] == 1) {
            // echo "par contre ici ouiiii";
// var_dump($this->utilisateur->userAdmin($_SESSION['profil']['id']));
            if ($this->utilisateur->userAdmin($_SESSION['profil']['id']) == true) {
                // echo"true";
                return true;
            }
        } else {
            // echo"false";
            return false;
        }
    }


    public function updateProduit($produit)
    {


        if ($produit["nom"] != $_POST["nom"]) {
            $this->produit->update(htmlspecialchars(strip_tags($_POST["nom"])), $produit["id"]);
        }

        if ($produit["description"] != $_POST["description"]) {
            $this->produit->updateDesc(htmlspecialchars(strip_tags($_POST["description"])), $produit["id"]);
        }

        if ($produit["presentation"] != $_POST["presentation"]) {
            $this->produit->updatePres(htmlspecialchars(strip_tags($_POST["presentation"])), $produit["id"]);
        }

        // il faut vérifier si c'est un int ?
        if ($produit["prix"] != $_POST["prix"]) {
            $this->produit->updatePrix(htmlspecialchars(strip_tags($_POST["prix"])), $produit["id"]);
        }

        // echo"test";

        $this->imageController->secondForm();
        if (isset($_SESSION["err"]) && $_SESSION["err"] == 1) {
            $imageId = $this->image->trouverLeDernierId();

            $this->produit->updateImage($imageId["id"], $produit["id"]);

            $this->image->delete($produit["id"]);
        }
        header("Refresh:0");
    }


    public function Pagination()
    {

        // On détermine sur quel page on est
        if (isset($_GET['page']) && !empty($_GET['page'])) {
            $currentpage = (int) strip_tags($_GET['page']);
        } else {

            $currentpage = 1;
        }
        // On compte combien il y as d'articles dans la base de données
        if (empty($_GET['categorie'])) {
            // echo"on est icic akzekaejazjkazekja";
            $total = $this->produit->countProduits();
        } else if (isset($_GET['categorie'])) {
            $total = $this->produit->countProduits($_GET['categorie']);
        }
        // On détermine le nombre d'articles par page
        $ParPage = 8;

        // On calcule le nombre de page nécessaire
        $pages = ceil($total / $ParPage);

        // Calcul du premier article de la page
        $premier = ($currentpage * $ParPage) - $ParPage;

        if (empty($_GET['categorie']) && empty($_GET['sous_categ'])) {

            $produits = $this->produit->PagePagination(intval($premier), intval($ParPage));

            // echo"on est lo";
        } else if (isset($_GET['categorie']) && empty($_GET['sous_categ'])) {
            $produits = $this->produit->PagePagination($premier, $ParPage, $_GET['categorie']);
        }

        $array = [$produits, $pages, $currentpage];


        return $array;
    }

    public function search()
    {
        // var_dump($_POST['search']);
        if (isset($_POST["search"])) {
            unset($_SESSION["recherche"]);
            // echo"ezaaaaaaaaa";
            $recherche = htmlspecialchars(strip_tags($_POST["search"]));
            $produits = $this->produit->searchBar($recherche);
            if (empty($produits) && !headers_sent()) {
                header('location: recherche');
                die();
            } else if (headers_sent()) {
                echo "<script>window.location.href='recherche'</script>";
            } else {
                header('location: recherche');
            }
            $_SESSION['recherche'] = $recherche;
        }
    }




    public function affichageSearch()
    {

        if (isset($_SESSION['recherche'])) {
            $recherche = $_SESSION['recherche'];
            $produits = $this->produit->searchBar($recherche);
            return $produits;
        } else {

            return "Aucun résultat";
        }
    }

    public function addProduit()
    {
        if (isset($_POST['Envoyer'])) {

            $nom = $this->security($_POST['nom']);
            $presentation = $this->security($_POST['presentation']);
            $description = $this->security($_POST['description']);
            $prix = $this->security($_POST['prix']);
            $categorie = $this->security($_POST['categorie']);

            if (empty($nom))
                $msgErr = "Votre produit n'a pas de nom !";

            else if (strlen($nom) >= 40) {
                $msgErr = "Le nom de votre produit doit contenir moins de 40 caractères";
            } else if (empty($description) or strlen($description) == 0)
                $msgErr = "Donner une déscription à votre produit !";

            else if (strlen($description) >= 150)
                $msgErr = "Votre description doit contenir moins de 150 caractères";

            else if (strlen($description) <= 10)
                $msgErr = "Votre description doit contenir plus de 10 caractères";

            else if (empty($presentation) or strlen($presentation) == 0)
                $msgErr = "Donner une courte présentation de votre produit";

            else if (strlen($presentation) >= 40)
                $msgErr = "Votre présentation du produit doit contenir moins de 40 caractères";

            if (empty($msgErr)) {
                $this->imageController->addImage();
                $id_image = $this->image->trouverLeDernierId();
                $this->produit->addProduit($nom, $presentation, $description,  $prix, $categorie, $id_image);
            }
        }
    }


    public function addLaCateg($nom)
    {
        $nom = htmlspecialchars(strip_tags($nom));

        if (strlen($nom) > 32) {
            $msgErr = "Le nom de la catégorie est trop long";
            echo $msgErr;
            die();
        }
        $this->produit->addCateg($nom);
        echo "Catégorie ajoutée";
        header('Refresh:3');
    }


    public function modifierCategorie($nom, $id)
    {
        $nom = htmlspecialchars(strip_tags($nom));
        $id = htmlspecialchars(strip_tags($id));

        // var_dump($nom);
        // var_dump($id);
        if (strlen($nom) > 32) {
            $msgErr = "Le nom de la catégorie est trop long (moins de 32 caractères)";
            echo $msgErr;
            die();
        }
        $this->produit->modifierCateg($nom, intval($id));
        echo "Catégorie modifiée";
        header('location: gestionCategories');
        die;
    }

    public function deleteCateg()
    {

        $id = htmlspecialchars(strip_tags($_GET['id']));
        $this->produit->deleteCateg($id);
        echo "Catégorie supprimée";
        header('location: gestionCategories');
        die;
    }
}
