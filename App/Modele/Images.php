<?php

namespace App\Modele;
class Images extends Modele {


    public function __construct()
    {
        parent::__construct();
        $this->table = "images";
        $this->utilisateur = new Utilisateurs;
        
    }


    /*
*  
*/
    public function addImage($nom, $img_dir)
    {

        $sql = "INSERT INTO images(nom,img_dir) VALUES (:nom , :img_dir)";
        $query = parent::getBdd()->prepare($sql);
        $query->execute(['nom' => $nom, 'img_dir' => $img_dir]);
    }

    public function trouverLeDernierId()
    {
        $sql = "SELECT id FROM images ORDER BY id DESC LIMIT 1";
        $query = parent::getBdd()->prepare($sql);
        $query->execute();
        $data = $query->fetch();
        return $data;
    }

    public function delete($id){
        $sql = "DELETE FROM images WHERE images.id = :id";
        $query = parent::getBdd()->prepare($sql);
        $query->execute(["id" => $id]);
    }


/*
*Si il y a une image on return l'image si il y en a pas 
on return true si c'est une femme else homme false
*/

    public function selectImage(?int $id = 0){
        $sql = "SELECT img_dir FROM images WHERE id = :id";
        $query = parent::getBdd()->prepare($sql);
        $query->execute(['id' => $id]);
        $data = $query->fetch();

        
        return $data;
}
    

    public function afficheTouteLesImage($id_image){

        $nombreImage = sizeof($id_image);
        
        $i = 0;

    while($i < $nombreImage ){
            

            $sql = "SELECT images.id, images.img_dir , utilisateurs.nom FROM images 
            INNER JOIN utilisateurs ON images.id = utilisateurs.id_image
            WHERE images.id = :id_image ";
            $query = parent::getBdd()->prepare($sql);
            $query->execute(['id_image' => $id_image[$i]["id_image"]]);
            $data[] = $query->fetch();
    
            $i++;
        }
        return($data);
    
    }

    public function derniereImageUser(){

        $sql = "SELECT img_dir , images.id FROM images 
        INNER JOIN utilisateurs ON images.id = utilisateurs.id_image
        WHERE images.id = utilisateurs.id_image  LIMIT 4
        ";
        $query = parent::getBdd()->prepare($sql);
        $query->execute();
        $data = $query->fetchAll();
        return $data;
    }

}
