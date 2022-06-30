<?php

namespace App\Modele;

Abstract class Utilisateurs extends Modele{

    
    public function __construct()


    {
        parent::__construct();
        $this->table = "utilisateurs";
    }



    public function sqlRegister($login, $password, $email, $prenom, $nom, $civilite,$id_image, $id_droits = 1)
    {
        $hachage = password_hash($password, PASSWORD_BCRYPT);
        $insertmbr = parent::getBdd()->prepare("INSERT INTO utilisateurs(login, password, email,prenom,nom,civilite,id_droits , id_image) VALUES(?,?,?,?,?,?,?,?)"); // Prépare une requête à l'exécution et retourne un objet (PDO)
        $insertmbr->execute(array($login, $hachage, $email, $prenom, $nom, $civilite, $id_droits , $id_image)); // Exécute une requête préparée PDO
        // $erreur = "Votre compte à été crée !";

        // header('Location: connexion.php');
    }

    public function loginVerify($login)
    {

        $sql = parent::getBdd()->prepare("SELECT utilisateurs.login FROM utilisateurs WHERE login = ?");
        $sql->execute(array($login));
        $loginExist = $sql->rowCount();
        return $loginExist;
    }

    public function emailVerify($email)
    {
        $sql = parent::getBdd()->prepare("SELECT utilisateurs.email FROM utilisateurs WHERE email = ? ");
        $sql->execute(array($email));
        $emailExist = $sql->rowCount();
        // echo"ce chiffre";
        // var_dump($emailExist);
        // echo"FIN";
        return $emailExist;
    }

    public function connexion($login)
    {
        $SqlVerifUtilisateur = "SELECT * FROM UTILISATEURS WHERE login = :login or email = :login";
        $prepVerif = parent::getBdd()->prepare($SqlVerifUtilisateur);
        $prepVerif->execute(array('login' => $login));
        $infoLogin = $prepVerif->fetch();
        return $infoLogin;
    }
    public function updateLogin($login, $id)
    {
        // var_dump($login);
        $sql = "UPDATE utilisateurs SET login = :login WHERE id = :id";;
        $prepupdatetilisateur = parent::getBdd()->prepare($sql);
        $prepupdatetilisateur->execute(array(
            ':login' => $login,
            ':id' => $id
        ));
        return $prepupdatetilisateur;
    }
    public function updateMail($email, $id)
    {
        $sql = "UPDATE utilisateurs SET email = :email WHERE id = :id";;
        $prepupdatetilisateur = parent::getBdd()->prepare($sql);
        $prepupdatetilisateur->execute(array(':email' => $email, ':id' => $id));
        return $prepupdatetilisateur;
    }
    public function updateNom($nom, $id)
    {
        $sql = "UPDATE utilisateurs SET nom = :nom WHERE id = :id";;
        $prepupdatetilisateur = parent::getBdd()->prepare($sql);
        $prepupdatetilisateur->execute(array(':nom' => $nom, ':id' => $id));
        return $prepupdatetilisateur;
    }
    public function updatePrenom($prenom, $id)
    {
        $sql = "UPDATE utilisateurs SET prenom = :prenom WHERE id = :id";;
        $prepupdatetilisateur = parent::getBdd()->prepare($sql);
        $prepupdatetilisateur->execute(array(':prenom' => $prenom, ':id' => $id));
        return $prepupdatetilisateur;
    }
    public function updatePassword($password, $id)
    {
        $sql = "UPDATE utilisateurs SET password = :password WHERE id = :id";;
        $prepupdatetilisateur = parent::getBdd()->prepare($sql);
        $prepupdatetilisateur->execute(array(':password' => $password, ':id' => $id));
        return $prepupdatetilisateur;
    }

    public function updateImageUser(int $idImage){
        $sql = "UPDATE utilisateurs SET id_image = :id_image WHERE id = :id ";
        $query = parent::getBdd()->prepare($sql);
        $query->execute(['id_image' => $idImage , 'id' => $_SESSION['profil']['id']]);
        $_SESSION['profil']['id_image'] = $idImage;
    }

    public function isConnected()
    {

        $Suisjeconnecter = "";
        if (isset($_SESSION['profil'])) {
            $Suisjeconnecter = true;
        } else {
            $Suisjeconnecter = false;
        }
        return $Suisjeconnecter;
        
    }
    
    public function GetEmail()
    {
        $requetegetlogin = parent::getBdd()->prepare('SELECT email from utilisateurs WHERE id = ?');
        $requetegetlogin->execute(array($_SESSION['profil']['id']));
        $infologin = $requetegetlogin->fetch();
        return $infologin;
    }

    public function genderOfCurrentUser(){

        $sql = "SELECT civilite FROM utilisateurs WHERE id = :id";
        $query = parent::getBdd()->prepare($sql);
        $query->execute(["id" => $_SESSION["profil"]["id"]]);
        $data = $query->fetch();
        return $data;
    }
}