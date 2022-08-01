<?php

namespace App\Modele;

class Utilisateurs extends Modele{

    
    public function __construct()


    {
        parent::__construct();
        $this->table = "utilisateurs";
    }



    public function sqlRegister($email, $password, $prenom, $nom, $droit, $civilite,$id_image ,  ) :void
    {
        // var_dump($email , $password, $prenom, $nom, $droit, $civilite,$id_image);
        $insertmbr = parent::getBdd()->prepare(
        "INSERT INTO utilisateurs(email, password, prenom, nom, droit ,civilite, id_image) 
        VALUES(:email,:password ,:prenom ,:nom ,:droit,:civilite,:id_image);"); // Prépare une requête à l'exécution et retourne un objet (PDO)
        $insertmbr->execute(array(
            'email' => $email, 
            'password' => $password,
            'prenom' => $prenom, 
            'nom' => $nom, 
            'droit' => $droit , 
            'civilite' => $civilite, 
            'id_image' => $id_image
        )); // Exécute une requête préparée PDO
        // $erreur = "Votre compte à été crée !";

        header('Refresh:5;url=connexion');
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
        $SqlVerifUtilisateur = "SELECT * FROM utilisateurs WHERE email = :login";
        $prepVerif = parent::getBdd()->prepare($SqlVerifUtilisateur);
        $prepVerif->execute(array('login' => $login));
        $infoLogin = $prepVerif->fetch();
        return $infoLogin;
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
    public function RecupEmailfromtoken($token)
    {

        $stmt = parent::getBdd()->prepare('SELECT email from utilisateurs where token = :token');
        $stmt->execute([
            'token' => $token
        ]);
        $email = $stmt->fetchColumn();
        return $email;
    }

    public function UpdateTokenfromMail($token, $email)
    {
        $sql = "UPDATE utilisateurs SET token = ? where email = ?";
        $stmt = parent::getBdd()->prepare($sql);
        $stmt->execute(array($token, $email));
        return $stmt;
    }

    public function UpdatePasswordFromToken($hashedpassword, $email)
    {
        $sql = "UPDATE utilisateurs SET password = ?, token = NULL WHERE email = ?";
        $stmt = parent::getBdd()->prepare($sql);
        $stmt->execute(array($hashedpassword, $email));
    }
    public function getAllUser(){

        $sql = "SELECT utilisateurs.droit, utilisateurs.id , utilisateurs.email , utilisateurs.prenom , utilisateurs.nom , utilisateurs.civilite , images.img_dir , images.nom_img FROM utilisateurs
        LEFT JOIN images ON utilisateurs.id_image = images.id";
        $query = parent::getBdd()->prepare($sql);
        $query->execute();
        $data = $query->fetchAll();
        return $data;
    }

    public function genderOfCurrentUser(){

        $sql = "SELECT civilite FROM utilisateurs WHERE id = :id";
        $query = parent::getBdd()->prepare($sql);
        $query->execute(["id" => $_SESSION["profil"]["id"]]);
        $data = $query->fetch();
        return $data;
    }
    
    public function isAdmin($id){
        $sql = "SELECT droit FROM utilisateurs WHERE id = :id";
        $query = parent::getBdd()->prepare($sql);
        $query->execute(["id" => $id]);
        $data = $query->fetch();
        return $data;
    }
}