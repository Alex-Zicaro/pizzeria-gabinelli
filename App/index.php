<?php

require "../vendor/autoload.php";
// require_once "Controller/Controller.php";

use App\Controller\{Controller};

$utilisateur = new Controller();

$url = "";

if (isset($_GET["url"])) {
    $url = explode("/", $_GET["url"]);
}

if(isset($_GET["deconnexion"])){
    // $utilisateur->logOut();
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./view/css/style.css">
    <link rel="stylesheet" href="./view/css/responsive.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>    
    <title>eBoutique - <?php  if(isset($_GET["url"])) echo(ucfirst($url[1]));?></title>
</head>

<body>

    <?php


// $utilisateur->tuVeuxQuelleHeader();



    // === MISE EN PLACE DU ROUTEUR ===

    // Il faut faire attention à ce que l'url et le filename correspondent

    if (isset($url[1])) {
        include_once "view/{$url[1]}View.php";
        // Si le fichier n'existe pas
        if(!file_exists("view/{$url[1]}View.php")) {
            include_once "view/404View.php";
        }
    } else {
        include_once "view/accueilView.php";
    }

    // Si l'url ressemble à ça : "app/inscription/", la page se casse
    // Il faut trouver un moyen de retirer ou d'omettre le dernier "/"
    $_SESSION["url"] = $url;
    include_once("./view/include/footer.php");
    ?>

</body>

</html>