<?php

namespace App\Modele;

require_once("Modele.php");

class Commentaires extends Modele
{

    protected $table;

    public function __construct()
    {

        $this->table = 'commentaires';
    }
    public function selectComment($id_produit)
    {

        $sql = "SELECT images.img_dir,  commentaires.id , commentaires.titre , commentaires.contenu , commentaires.note , utilisateurs.prenom ,utilisateurs.droit, utilisateurs.id AS id_utilisateur  FROM commentaires
        INNER JOIN  produits ON commentaires.id_produit = produits.id
        INNER JOIN utilisateurs ON id_utilisateur = utilisateurs.id
        INNER JOIN images ON utilisateurs.id_image = images.id
        WHERE produits.id = :id ORDER BY id DESC";

        $query = parent::getBdd()->prepare($sql);
        $query->execute(['id' => $id_produit]);
        $commentaire = $query->fetchAll();
        // var_dump($commentaire);
        if(isset($commentaire)){
        // echo"azùkeazezakeazklzkea";
        return $commentaire;

    } else {

        $sql = "SELECT  commentaires.id , commentaires.titre , commentaires.contenu , commentaires.note , utilisateurs.login  FROM commentaires
        INNER JOIN  produits ON commentaires.id_produit = produits.id
        INNER JOIN utilisateurs ON id_utilisateur = utilisateurs.id
        WHERE produits.id = :id ORDER BY id DESC";
        $query = parent::getBdd()->prepare($sql);
        $query->execute(['id' => $id_produit]);
        $commentaire = $query->fetchAll();

        return $commentaire;
    }
}

    public function postComment($titre, $contenu, $note, $id_utilisateur, $id_produit) : void
    {

        $sql = "INSERT INTO commentaires (commentaires.titre, commentaires.contenu ,commentaires.note , commentaires.id_utilisateur , commentaires.id_produit) VALUE (:titre , :contenu , :note , :id_utilisateur , :id_produit)";
        $query = parent::getBdd()->prepare($sql);
        $query->execute(["titre" => $titre , "contenu" => $contenu , "note" => $note , "id_utilisateur" => $id_utilisateur , "id_produit" => $id_produit]);
        // var_dump($query);
    }

    public function fourLastCom() : array{

        $sql ="SELECT utilisateurs.email , utilisateurs.prenom , utilisateurs.nom , utilisateurs.civilite ,images.img_dir , images.nom_img ,commentaires.id , commentaires.titre , commentaires.contenu , commentaires.note FROM commentaires 
        INNER JOIN utilisateurs ON commentaires.id_utilisateur = utilisateurs.id
        INNER JOIN images ON utilisateurs.id_image = images.id
        ORDER BY commentaires.id DESC LIMIT 4";
        $query = parent::getBdd()->prepare($sql);
        $query->execute();
        $data = $query->fetchAll();

        return $data;
    }

    public function deleteComment($id_commentaire) : void{

        $sql = "DELETE FROM commentaires WHERE id = :id";
        $query = parent::getBdd()->prepare($sql);
        $query->execute(["id" => $id_commentaire]);
    }


    

    public function updateTitre($id_commentaire ,?string $titre) : void{

        if(isset($titre) && $titre !== ""){
            $sql = "UPDATE commentaires SET titre = :titre WHERE id = :id";
            $query = parent::getBdd()->prepare($sql);
            $query->execute(["titre" => $titre , "id" => $id_commentaire]);
        }

        
        if(isset($note)){
            $sql = "UPDATE commentaires SET note = :note WHERE id = :id";
            $query = parent::getBdd()->prepare($sql);
            $query->execute(["note" => $note , "id" => $id_commentaire]);
        }

    }

    public function updateContenu($id_commentaire , ?string $contenu) : void{

        // echo"test";
            $sql = "UPDATE commentaires SET contenu = :contenu WHERE id = :id";
            $query = parent::getBdd()->prepare($sql);
            $query->execute(["contenu" => $contenu , "id" => $id_commentaire]);
        
    }

    public function updateNote($id_commentaire , $note) : void{

        $sql = "UPDATE commentaires SET note = :note WHERE id = :id";
        $query = parent::getBdd()->prepare($sql);
        $query->execute(["note" => $note , "id" => $id_commentaire]);
    
}

public function countComment(int $id_produit): int
{

        $sql = "SELECT COUNT(*) AS nb_comment FROM commentaires WHERE id_produit = :id_produit";
        $query = parent::getBdd()->prepare($sql);
        $query->execute(['id_produit' => $id_produit]);
        $data = $query->fetch();

        return $data['nb_comment'];


}

public function paginationCom(int $premier,int $parPage ,int $id_produit): array
{
    // var_dump($premier,$parPage);
    // var_dump($id_produit);
        $sql = "SELECT commentaires.id , commentaires.titre , commentaires.contenu , commentaires.note , utilisateurs.login , utilisateurs.id AS id_utilisateur FROM commentaires
        INNER JOIN  produits ON commentaires.id_produit = produits.id
        INNER JOIN utilisateurs ON id_utilisateur = utilisateurs.id
        INNER JOIN images ON utilisateurs.id_image = images.id
        WHERE produits.id = :id ORDER BY produits.id DESC LIMIT :premier, :parPage"; 
        $query = parent::getBdd()->prepare($sql);
        $query->bindvalue(":premier", $premier , \PDO::PARAM_INT);
        $query->bindvalue(":parPage", $parPage , \PDO::PARAM_INT);
        $query->bindvalue(":id", $id_produit );
        
        $query->execute();
        $data = $query->fetchAll();

        return $data;
}
public function Selectallcoms() {
    $sql = "SELECT commentaires.id , commentaires.titre , commentaires.contenu , commentaires.note , utilisateurs.email , utilisateurs.id AS id_utilisateur  FROM commentaires
    INNER JOIN  produits ON commentaires.id_produit = produits.id
    INNER JOIN utilisateurs ON id_utilisateur = utilisateurs.id
    INNER JOIN images ON utilisateurs.id_image = images.id
    ORDER BY id DESC";
    $query = parent::getBdd()->prepare($sql);
    $query->execute();
    $data = $query->fetchAll();
    return $data;
}

}