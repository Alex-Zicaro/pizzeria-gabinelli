<?php

use App\Controller\{Utilisateurs, Images};


$utilisateur = new Utilisateurs;
$image = new Images;

$utilisateurActuelle = $utilisateur->userConnect();
var_dump($utilisateurActuelle);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="View/CSS/profil.css">
    <title>Pizzeria gabinelli</title>
</head>

<body>
    <header>
        <?php $utilisateur->headerFront(); ?>
    </header>
    <main>
        <div class="page-content page-container" id="page-content">
            <div class="padding">
                <div class="row container d-flex justify-content-center">
                    <div class="col-xl-6 col-md-12">
                        <div class="card user-card-full">
                            <div class="row m-l-0 m-r-0">
                                <div class="col-sm-4 bg-c-lite-green user-profile">
                                    <div class="card-block text-center text-white">
                                        <div class="m-b-25">
                                            <img src="https://img.icons8.com/bubbles/100/000000/user.png" class="img-radius" alt="User-Profile-Image">
                                        </div>
    <button>
        Modifier
    </button>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="card-block">
                                        <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Information</h6>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <p class="m-b-10 f-w-600">Email</p>
                                                <h6 class="text-muted f-w-400"><?= $utilisateurActuelle['email'] ?></h6>
                                            </div>
                                            <div class="col-sm-6">
                                                <p class="m-b-10 f-w-600">Prenom</p>
                                                <h6 class="text-muted f-w-400"><?= $utilisateurActuelle['prenom'] ?></h6>
                                            </div>
                                            <div class="col-sm-6">
                                                <p class="m-b-10 f-w-600">Nom</p>
                                                <h6 class="text-muted f-w-400"><?= $utilisateurActuelle['nom'] ?></h6>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <?php include_once 'View/include/footer.php'; ?>
    </footer>
</body>

</html>