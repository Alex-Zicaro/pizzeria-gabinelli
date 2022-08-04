<?php


require "../vendor/autoload.php";
// require_once "Controller/Controller.php";

use App\Controller\{Controller};

$utilisateur = new Controller();
$url = "";
// session_destroy();

if(isset($_GET['deco'])){
    
    unset($_SESSION['profil']);
    header("location: accueil");
}
if (isset($_GET["url"])) {
    $url = explode("/", $_GET["url"]);
}

if(isset($_GET["deconnexion"])){
    // $utilisateur->logOut();
}


    // === MISE EN PLACE DU ROUTEUR ===
// var_dump($url);
    // Il faut faire attention à ce que l'url et le filename correspondent
// var_dump(file_exists("View/{$url[1]}View.php"));
    if (isset($url[1]) && file_exists("View/{$url[1]}View.php")) {
        include_once "View/{$url[1]}View.php";
    }
    // Si le fichier n'existe pas
    else if(isset($url[1]) && file_exists("View/{$url[1]}View.php") == false) {
        include_once "View/404View.php";
        
    } else if($url == "") {
        
        include_once "View/accueilView.php";
    }
    $_SESSION["url"] = $url;
   if(isset($_GET['deco'])){
    unset($_SESSION['profil']);
    header("location: accueil");
   }

    ?>
