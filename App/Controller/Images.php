<?php

namespace App\Controller;

use App\Modele;

require_once("Modele/Images.php");
require_once("Modele/Produits.php");
require_once('Utilisateurs.php');

class Images extends Controller
{


    public function __construct()
    {
        $this->requete = new \App\Modele\Images;

        
    }
    /*
    *add image
    */
    public function secondForm()
    {
        // echo"test";
        // var_dump($_FILES);

        if (!empty($_FILES) && $_FILES['fichier']['name'] !== "") {
            $file_nom  = $_FILES["fichier"]["name"];
            $file_type  = strrchr($file_nom, '.');
            $type_autorise = [".png", ".jpg", ".jpeg", ".jfif", ".jpeg"];
            $file_tmp_name = $_FILES["fichier"]["tmp_name"];
            $file_destination = 'files/' . $file_nom;

            if (in_array($file_type, $type_autorise)) {

                if (move_uploaded_file($file_tmp_name, $file_destination)) {
                    $this->requete->addImage($file_nom, $file_destination);
                } else {

                    echo "Une erreur est survenue lors de l'envoie du fichier";
                }
                echo "image conforme";
                header("Refresh:0");
                $_SESSION["err"] = 1;
            } else {

                echo "Vous pouvez seulement utiliser ces formats ";
                foreach ($type_autorise as $type)
                    echo $type . " ";
            }
        } else if(isset($_SESSION['profil'])) {
            echo "Aucun fichier reçut";
        } 
    }

    public function deleteImgUser(){
        if(isset($_GET["deleteImage"])){
            $id_image = strip_tags(htmlspecialchars($_GET["deleteImage"]));
            $this->requete->delete($id_image);
            header("location: gestionImage");
        }

    }



}
