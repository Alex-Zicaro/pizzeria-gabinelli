<?php

namespace App\Controller;

use App\Modele;

require_once("../vendor/autoload.php");


class Images extends Controller
{


    public function __construct()
    {
        $this->requete = new \App\Modele\Images;
    }
    /*
    *add image
    */
    public function addImage()
    {
        // echo"test";
        // var_dump($_FILES);

        if (!empty($_FILES) && $_FILES['fichier']['name'] !== "") {
            $file_nom  = $_FILES["fichier"]["name"];
            $file_type  = strrchr($file_nom, '.');
            $type_autorise = [".png", ".jpg", ".jpeg", ".jfif", ".jpeg"];
            $file_tmp_name = $_FILES["fichier"]["tmp_name"];
            $file_destination = 'files/' . $file_nom;
            $file_size = $_FILES["fichier"]["size"];


            if (in_array($file_type, $type_autorise)) {
                if ($file_size <= 3048576) {
                    if (move_uploaded_file($file_tmp_name, $file_destination)) {
                        $this->requete->addImage($file_nom, $file_destination);
                        // echo "image conforme";
                        // header("Refresh:0");

                    } else {
                        $msgErr = "Une erreur est survenue lors de l'envoie du fichier";
                    }
                } else {
                    $msgErr = "Le fichier est trop volumineux";
                }
            } else {

                $msgErr = "Vous pouvez utiliser ce format de fichier";
            }
        } else if (isset($_SESSION['profil'])) {
            $msgErr = "Aucun fichier reçut";
        }

        if (isset($msgErr)) {
            return  $msgErr;
        } else {
            return true;
        }
    }

    public function deleteImgUser()
    {
        if (isset($_GET["deleteImage"])) {
            $id_image = strip_tags(htmlspecialchars($_GET["deleteImage"]));
            $this->requete->delete($id_image);
            header("location: gestionImage");
        }
    }
}
