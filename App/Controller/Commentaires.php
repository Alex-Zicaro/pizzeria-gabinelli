<?php

namespace App\Controller;


// use \Models\Commentaires;

require_once "Modele/Commentaires.php";

class Commentaires extends Controller {



    public function __construct()
    {
    $this->commentaire = new \App\Modele\Commentaires;
    }

    public function add($titre , $contenu , $note , $id_produit){
        $titre = htmlspecialchars(strip_tags($titre));
        $note = htmlspecialchars(strip_tags($note));
        $contenu = htmlspecialchars(strip_tags($contenu));
        $id_produit = htmlspecialchars(strip_tags($id_produit));
        $id_utilisateur = $_SESSION['profil']['id'];

        if(empty($titre) && $titre == ""){
            $msgErr = "Vous n'avez pas mis de titre";
        }
        else if (empty($contenu) && $contenu == ""){
            $msgErr = "Vous n'avez pas écris de commentaire";
        }

        else if (empty($note)){

            $msgErr = "Vous n'avez pas mit de note !";
        }

        if(empty($msgErr)){
            echo"good";
            $this->commentaire->postComment($titre , $contenu , $note , $id_utilisateur , $id_produit);
            header('Refresh:0');
            die();
        }
        else{
            echo $msgErr;
        }

    }


    public function delete($id_commentaire){
        $id_commentaire = htmlspecialchars(strip_tags($id_commentaire));
        $this->commentaire->deleteComment($id_commentaire);
        // header('Refresh:0');
    }

    //pas bon
    public function modifier($id_commentaire , ?string $titre , ?string $contenu , ?int $note){

        if(isset($titre) && $titre !== ""){
            $titre = htmlspecialchars(strip_tags($titre));
            $this->commentaire->updateTitre($id_commentaire , $titre);
        }

        if(isset($contenu) && $contenu !== ""){
            $contenu = htmlspecialchars(strip_tags($contenu));
            $this->commentaire->updateContenu($id_commentaire , $contenu);
        }

        if(isset($note) && $note !== 0){
            $note = htmlspecialchars(strip_tags(intval($note)));
            $this->commentaire->updateNote($id_commentaire , $note);
        }

        // if(isset($note) || isset($titre) || isset($contenu)){
        //     $id_commentaire = htmlspecialchars(strip_tags(intval($id_commentaire)));
        //     $this->commentaire->modifierComment($id_commentaire);
        //     // header('Refresh:0');
        // }
        return true;
    }
    
    public function paginationCom($id_produit){

        $id_produit = htmlspecialchars(strip_tags($id_produit));
        // On détermine sur quel page on est
        if(isset($_GET['page']) && !empty($_GET['page'])){
            $currentpage = (int) strip_tags($_GET['page']);
            // var_dump($_GET['page']);
        }
        else{
            $currentpage = 1;
        }
        // On compte combien il y as d'articles dans la base de données
        
        $total = $this->commentaire->countComment($id_produit); 
        var_dump($total);
        // On détermine le nombre d'articles par page
        $ParPage = 8;

        // On calcule le nombre de page nécessaire
        $pages = ceil($total / $ParPage);

        // Calcul du premier article de la page
        $premier = ($currentpage * $ParPage) - $ParPage;

        $premier = intval($premier);
        $ParPage = intval($ParPage);
        $pages = intval($pages);
            $produits = $this->commentaire->paginationCom(intval($premier), intval($ParPage), $id_produit);
            // var_dump($produits);
        
        $array = [$produits,$pages,$currentpage];

        
        return $array;
}
    public function Afficherlescoms(){
        $commentaires = $this->commentaire->Selectallcoms();
        return $commentaires;
    }
}