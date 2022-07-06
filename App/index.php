<?php


require "../vendor/autoload.php";
// require_once "Controller/Controller.php";

use App\Controller\{Controller};

$utilisateur = new Controller();

$url = "";
// session_destroy();
if (isset($_GET["url"])) {
    $url = explode("/", $_GET["url"]);
}

if(isset($_GET["deconnexion"])){
    // $utilisateur->logOut();
}
?>


    <?php


// $utilisateur->tuVeuxQuelleHeader();
    // === MISE EN PLACE DU ROUTEUR ===

    // Il faut faire attention à ce que l'url et le filename correspondent

    if (isset($url[1])) {
        include_once "View/{$url[1]}View.php";
        // Si le fichier n'existe pas
        if(!file_exists("View/{$url[1]}View.php")) {
            include_once "View/404View.php";
        }
    } else {
        // echo "double";
        include_once "View/accueilView.php";
    }

    $_SESSION["url"] = $url;
    include_once("./View/include/footer.php");
    ?>
