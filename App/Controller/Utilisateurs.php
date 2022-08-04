<?php

Namespace App\Controller;

use PDO;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../vendor/phpmailer/phpmailer/src/Exception.php';
require '../vendor/phpmailer/phpmailer/src/SMTP.php';
require '../vendor/phpmailer/phpmailer/src/PHPMailer.php';


//revoir le code ici 

Class Utilisateurs extends Controller{

    public function __construct()
    {
    $this->utilisateur = new \App\Modele\Utilisateurs();
    $this->imageC = new Images();
    $this->controller = new Controller;
    

    }

    public function register($email, $password, $password2, $prenom, $nom, $civilite)
    {
    if (strlen($password) <= 8) {
            $msgErr = "Votre mot de passe est trop court 8 caractère  minimum !";
        }
        elseif (!preg_match("/^[a-zA-z0-9]*$/", $prenom)) {// test le && nom
            $msgErr = 'Vous ne pouvez pas utiliser des caractères spéciaux dans votre prénom et nom.';
        }
        else if (!isset($password) or empty($password)) {
            $msgErr = "Vous n'avez pas rentré(e) de password !";
        } else if (!isset($password2) or empty($password2)) {
            $msgErr = "Vous n'avez pas confirmer votre password !";
        } else if (!isset($email) or empty($email)) {
            $msgErr = "Vous n'avez pas rentré(e) d'email !";
        } else if (!isset($prenom) or empty($prenom)) {
            $msgErr = "Vous n'avez pas rentré(e) de prénom !";
        } else if (!isset($nom) or empty($nom)) {
            $msgErr = "Vous n'avez pas rentré(e) de nom !";
        } else if (!isset($civilite) or empty($civilite)) {
            $msgErr = "Choisir sa civilite !";
        } else if ($password !== $password2) {
            $msgErr = "Vos mot de passe de correspondent pas !";
        } 
        else if ($this->utilisateur->emailVerify($email) !== 0) {
            $msgErr = "Email déja pris";
        } else {
        
            // echo"je test le nouveau else iciaizeiz";
            if (!isset($msgErr) or empty($msgErr)) {
                // echo"je suis ici affiche toi zakelazkeazeazm";
                

                    $msgErr = $this->imageC->addImage();

                    if($msgErr !==  true){
                        // echo 'on rentre ici';
                        return $msgErr;
                        
                    }
                
                $email = $this->controller->security($_POST["email"]);
                $password = $this->controller->security($_POST["password"]);
                $password = password_hash($password, PASSWORD_BCRYPT); 
                $prenom = $this->controller->security($_POST["prenom"]);
                $nom = $this->controller->security($_POST["nom"]);
                $civilite = $this->controller->security($_POST["civilite"]);

                if (isset($_SESSION['err']) && $_SESSION['err'] == 1) {
                    $image = $this->imageC->requete->trouverLeDernierId();
                    $id_image = $image['id'];

                } else if(empty($_SESSION['err'])) {
                    if ($civilite == 'Madame') {
                        $id_image = 1;
                    
                    } else if ($civilite == 'Monsieur') {
                        $id_image = 2; 
                    }
                }
                $droit = 'client';
                
                $this->utilisateur->sqlRegister($email, $password,$prenom, $nom, $droit, $civilite, $id_image);
                unset($_SESSION['err']);
                // header("location: connexion");
                $msgErr = 'Votre compte a bien été créé !';
            }
            } 
            if (isset($msgErr)) {
                // echo "aeznezahbkzahbzaehbezhbzhabzejhaez";
                return($msgErr);
            }
        
    
    }


    public function login($infoLogin, $password)
    {
        $this->controller->security($infoLogin);
        $this->controller->security($password);
        $total = $this->utilisateur->connexion($infoLogin);
        if (isset($total)) {

            $SqlPassword = $total['password'] ?? null;
            if (password_verify($password, $SqlPassword)) {

                $_SESSION['profil']['id'] = $total['id'];
                header("location: profil");

            } else {
                $msgErr = "Mauvais email ou mot de passe !";
                return $msgErr;
            }
        }
    }

    public function userConnect()
    {
// var_dump($_SESSION['profil']);
        if (isset($_SESSION["profil"]["id"])) {
            $data = $this->utilisateur->getOneUser($_SESSION["profil"]["id"]);
            // var_dump($data);
            $image = $this->imageC->requete->selectImage($data['id_image']);
            array_push($data, $image);
            return $data;
        } else {
            header("location: connexion");
            die();
        }
    }

    public function userAdmin($id){
        if(!isset($_SESSION['profil'])){
            header('location: connexion');
            exit();
        }
        $heIsAdmin = $this->utilisateur->isAdmin($id);
        if(is_array($heIsAdmin))
        $heIsAdmin = $heIsAdmin['droit'];
        
        if($heIsAdmin == 'client'){
            return false;
        } else if ($heIsAdmin == 'admin'){
            echo"true";
            return true;
        }
    }





    public function CUpdatemail($email, $id)
    {   
        // echo"on est ici";
        $info = $_SESSION['profil'];
        // var_dump($info['email'],$email);
        $email = htmlspecialchars(strip_tags($email));
        $id = intval(strip_tags(htmlspecialchars($id)));
        if (isset($email) && isset($id)) {
            if (isset($email) && !empty($email) && $email != $info['email']) {
                if ($this->utilisateur->emailVerify($email) === 0) {
                    $this->utilisateur->updateMail($email, $id);
                    $_SESSION['profil']['email'] = $email;
                } else {
                    $msgErr = "Votre mail existe déjà !";
                    echo $msgErr;
                }
            }
        }
    }

    public function CUpdateNom($nom, $id)
    {
        // echo"on commence ici";
        $info = $_SESSION['profil'];
        $id = intval(htmlspecialchars(strip_tags($id)));
        $nom = htmlspecialchars(strip_tags($nom));
        // var_dump($info);

        if (isset($id) && isset($nom)) {
            // echo"deux c bon";
            if ($nom != $info['nom']) {
                // echo"trois aussi c bon";
                if (strlen($nom) > 16) {
                    
                    $msgErr = "Votre nom est trop long";
                }
                if (strlen($nom) < 2) {
                    
                    $msgErr = "Votre nom est trop petit";
                } else if (empty($msgErr)) {
                    // echo"six c bon";
                    $this->utilisateur->updateNom($nom, $id);
                    $_SESSION['profil']['nom'] = $nom;
                } else {
                    echo $msgErr;
                }
            }
        }
    }

    public function CUpdatePrenom($prenom, $id)
    {   
        $info = $_SESSION['profil'];
        // var_dump($info);
        $id = intval(htmlspecialchars(strip_tags($id)));
        $prenom = htmlspecialchars(strip_tags($prenom));
        if (isset($prenom) && isset($id)) {
            if ($prenom != $info['prenom']) {
                if (strlen($prenom) > 16) {
                    $msgErr = "Votre nom est trop long";
                }
                if (strlen($prenom) < 2) {
                    $msgErr = "Votre nom est trop petit";
                } else if (empty($msgErr)) {
                    $this->utilisateur->updatePrenom($prenom, $id);
                    $_SESSION['profil']['prenom'] = $prenom;
                } else {
                    echo $msgErr;
                }
            }
        }
    }

    public function CUpdatePassword($password1, $password2, $id)
    {
        $user = $this->utilisateur->getOneUser($id);

        if (strlen($password2) <= 8) {
            $msgErr = "Votre mot de passe est trop court 8 caractères minimum !";
        }
        if (password_verify($password1, $user['password']) && empty($msgErr)) {
            $password = password_hash($password2, PASSWORD_BCRYPT);
            $this->utilisateur->updatePassword($password, $id);
            $msgErr = "Votre mot de passe a bien été modifié !";
        } else {
            $msgErr = "Votre mot de passe actuel est incorrect !";
        }

        echo $msgErr;
    }

    public function updateImageUser()
    {

        $this->imageC->secondForm();
        $idImage = $this->image->trouverLeDernierId();
        $this->utilisateur->updateImageUser($idImage["id"], $_SESSION["profil"]["id"]);
        $_SESSION['profil']['id_image'] = $idImage['id'];

        // header("Refresh:0");
    }



    public function verifConnect()
    {

        if (isset($_SESSION["profil"])) {
            header("location: profil");
        }
    }
    public function MotDepasseOublié($token, $password)
    {
        if ($this->utilisateur->RecupEmailfromtoken($token) == true) {
            $email = $this->utilisateur->RecupEmailfromtoken($token);
            $this->utilisateur->UpdateTokenfromMail($token, $email);
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $this->utilisateur->UpdatePasswordfromToken($hashedPassword, $email);
            return true;
        }
    }

    public function EnvoieEmailmotdepasseoublié($email)
    {
        $mail = new PHPMailer(true);

        $token = uniqid();
        $url = "http://localhost/pizzeria-gabinelli/App/token?token=$token";
        try {
     //Server settings
     $mail->SMTPDebug = 0;                      //Enable verbose debug output
     $mail->isSMTP();                                            //Send using SMTP
     $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
     $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
     $mail->Username   = 'lebotdu13002@gmail.com';                     //SMTP username
     $mail->Password   = 'xjraxilbhtbvgkee' ;                               //SMTP password
     $mail->SMTPSecure = "tls";            //Enable implicit TLS encryption
     $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('lebotdu13002@gmail.com', 'Mot de passe oublie');
            $mail->addAddress($email, '');     //Add a recipient


            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Mot de passe oublié';
            $mail->Body    = "Bonjour, voici votre lien pour changer votre mot de passe : $url";
            // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients'; 
            $mail->send();
            $this->utilisateur->UpdateTokenfromMail($token, $email);
            $message = "Votre demande de reintialisation de mot de passe a été envoyé sur le mail : $email";
            return $message;
        } catch (Exception $e) {
            $message = "Votre demande de reintialisation de message n'as marchée ! Erreur: {$mail->ErrorInfo}";
            return $message;
        }
    }

    public function headerFront()
    {

        if (isset($_SESSION["profil"]) && !empty($_SESSION["profil"])) {
            include_once("View/include/headerOnline.php");
        } else {
            include_once("View/include/header.php");
        }
    }

    public function afficheTouteLesImg()
    {
        $id_image = $this->utilisateur->toutLesIdImages();

        $data = $this->image->afficheTouteLesImage($id_image);

        return $data;
    }

    //choisir une image si l'user a pas d'image
    public function select($id)
    {


        $asTuUneImg = $this->image->selectImage($id);


        if ($asTuUneImg == false) {

            $sexe = $this->utilisateur->hommeOuFemme();

            if ($sexe["civilite"] == 'femme') {
                $this->utilisateur->updateImageUser(1);
            } else if ($sexe["civilite"] == 'homme') {

                $this->utilisateur->updateImageUser(2);
            } else if ($sexe["civilite"] == 'nonBinaire') {
                $this->utilisateur->updateImageUser(3); // pas d'image
            }
        }
    }

    public function logOut()
    {

        unset($_SESSION['profil']);
    }

    public function delete(?int $page = 0)
    {
        if (isset($_GET['delete']) && $_GET['delete'] != 0) {
            $id = strip_tags(htmlspecialchars($_GET['delete']));

            $this->utilisateur->deleteOneById($id);
            if ($page == 0) {
                header("location: admin");
                

                die;
            } else {
                // echo"on est bien";
                header("location: gestionUtilisateurs");
            }
        }
    }

    public function selectUser($id){
        $data = $this->utilisateur->getOneUser($id);
        return $data;
    }


}