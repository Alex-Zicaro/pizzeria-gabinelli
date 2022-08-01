<?php

namespace App\Modele;

class Produits extends Modele{

    public function selectProduits(?int $id_categorie, int $order = 0)
    {

        if ($id_categorie !== null) {
            $sql = "SELECT categories.nom AS categ, produits.id , produits.nom , produits.description , produits.prix , produits.quantite
            FROM produits
            INNER JOIN categories ON produits.id_categorie = categories.id 
            INNER JOIN images ON produits.id_image = images.id
            WHERE categories.id = :id_categorie ";
            $prepare = parent::getBdd()->prepare($sql);
            $prepare->execute([':id_categorie' => $id_categorie]);
        } else if ($order == 1 && $id_categorie == null) {

            $sql = "SELECT img_nom , images.img_dir ,  categories.nom AS categ, produits.id , produits.nom, produits.presentation , produits.description , produits.prix , produits.quantite FROM produits
            INNER JOIN categories ON produits.id_categorie = categories.id
            INNER JOIN images ON produits.id_image = images.id ORDER BY id DESC";

            $prepare = parent::getBdd()->prepare($sql);
            $prepare->execute();
        } else {
            $sql = "SELECT images.nom AS image_nom , images.img_dir ,  categories.nom AS categ,  produits.id , produits.nom, produits.presentation , produits.description , produits.prix , produits.quantite FROM produits
            INNER JOIN categories ON produits.id_categorie = categories.id
            INNER JOIN images ON produits.id_image = images.id";

            $prepare = parent::getBdd()->prepare($sql);
            $prepare->execute();
        }

        $data = $prepare->fetchAll();

        return $data;
    }

    public function selectProduit(int $id_produit)
    {


        $sql = "SELECT images.img_dir, images.nom_img , categories.nom_categ  , produits.id , produits.nom , produits.presentation , produits.description , produits.prix  FROM produits
            INNER JOIN categories ON produits.id_categorie = categories.id             
            INNER JOIN images ON produits.id_image = images.id
            WHERE produits.id = :id_produit ";
        $query = parent::getBdd()->prepare($sql);
        $query->execute(['id_produit' => $id_produit]);
        $data = $query->fetch();

        return $data;
    }

    public function parcourirLePanier($array)
    {

        foreach ($array as $value) {

            $sql = "SELECT nom_img , images.img_dir ,  nom_categ, produits.id , produits.nom, produits.presentation , produits.description , produits.prix FROM produits
        INNER JOIN categories ON produits.id_categorie = categories.id
        INNER JOIN images ON produits.id_image = images.id 
        WHERE produits.id = :value ";

            $prepare = parent::getBdd()->prepare($sql);

            // var_dump($array);

            $prepare->execute(['value' => $value]);
            $data[] = $prepare->fetchAll();
        }
        return ($data);
    }




    public function selectCategories()
    {

        $sql = "SELECT * FROM categories";
        $prep = parent::getBdd()->prepare($sql);
        $prep->execute();
        $data = $prep->fetchAll();
        return $data;
    }


    /**
     * Compte tout les produits sinon s'il y a un param vous compter les produits de la catégorie
     * pagination
     * à revoir pas besoin des sous categ
     */
    public function countProduits(?int $id_categorie = 0, ?int $sous_categ_path = 0): int
    {

        if ($id_categorie !== 0 && $sous_categ_path === 0) {
            $sql = "SELECT COUNT(*) AS nb_produits FROM produits WHERE id_categorie = :id_categorie";
            $query = parent::getBdd()->prepare($sql);
            $query->execute(['id_categorie' => $id_categorie]);
        } else if ($id_categorie !== 0 && $sous_categ_path !== 0) {
            // echo'klazlkzeklzklazeklaezklaezklklazeklazeklazklzaekle';
            $sql = "SELECT COUNT(*) AS nb_produits FROM produits WHERE id_sous_categorie = :id_sous_categorie";
            $query = parent::getBdd()->prepare($sql);
            $query->execute(['id_sous_categorie' => $id_categorie]);
        } else {

            $sql = "SELECT COUNT(*) AS nb_produits FROM produits";

            $query = parent::getBdd()->prepare($sql);
            $query->execute();
        }

        $result = $query->fetch();

        // var_dump($result);

        return $result["nb_produits"];
    }


    public function addProduit($nom, $description, $presentation, $prix, $id_categorie, $id_sous_categ, $id_image)
    {

        $sql = "INSERT INTO produits(nom, description , presentation , prix  , id_categorie, id_image) 
    VALUES (:nom, :description, :presentation, :prix , :id_categorie , :id_image)";

        $query = parent::getBdd()->prepare($sql);
        $query->execute([
            'nom' => $nom, 'description' => $description, 
            'presentation' => $presentation,
            'id_categorie' => $id_categorie,
            'id_image' => $id_image

        ]);
    }



    public function update(string $nom, int $id): void
    {

        $sql = "UPDATE produits SET nom = :nom WHERE id = :id";
        $query = parent::getbdd()->prepare($sql);
        $query->execute([
            'nom' => $nom,
            'id' => $id
        ]);
    }
    public function updateDesc($description, $id): void
    {
        echo "test";
        $sql = "UPDATE produits SET description = :description WHERE id = :id";
        $query = parent::getBdd()->prepare($sql);
        $query->execute([
            'description' => $description,
            'id' => $id
        ]);
    }

    public function updatePres($presentation, $id)
    {

        $sql = "UPDATE produits SET presentation = :presentation WHERE id = :id";
        $query = parent::getBdd()->prepare($sql);
        $query->execute([
            'presentation' => $presentation,
            'id' => $id
        ]);
    }

    public function updatePrix($prix, $id)
    {
        $sql = "UPDATE produits SET prix = :prix WHERE id = :id";
        $query = parent::getBdd()->prepare($sql);
        $query->execute([
            'prix' => $prix,
            'id' => $id
        ]);
    }

    public function updateImage($id, $produit_id)
    {
        // var_dump($id);
        $sql = "UPDATE produits SET id_image = :id_image WHERE id = :id";
        $query = parent::getBdd()->prepare($sql);
        $query->execute([
            "id_image" => $id,
            "id" => $produit_id
        ]);
    }

    public function FourLastProduit()
    {
        $sql = "SELECT produits.id , produits.nom ,id_image , images.img_dir , images.nom_img , presentation , prix ,
        nom_categ 
        FROM produits
        INNER JOIN categories ON categories.id = produits.id_categorie
        INNER JOIN images ON id_image = images.id
        ORDER BY id DESC LIMIT 4 ";
        $query = parent::getBdd()->prepare($sql);
        $query->execute();
        $data = $query->fetchAll();
        return $data;
    }
    // à refaire
    public function PagePagination($premier, $parPage, ?int $id_categorie = 0)
    {


        if ($id_categorie == 0) {

            $sql = 'SELECT DISTINCT images.img_dir, nom_img, nom_categ ,  produits.id , produits.nom , produits.presentation , produits.description , produits.prix  FROM produits
        INNER JOIN categories ON produits.id_categorie = categories.id 
        INNER JOIN images ON produits.id_image = images.id
        ORDER BY produits.id DESC LIMIT :premier, :parpage';
            $query = parent::getBdd()->prepare($sql);
            // echo"ezeazazaez";
        }  else if (isset($_GET['categorie'])) {
            $sql = 'SELECT DISTINCT images.img_dir, nom_img , nom_categ, produits.id , produits.nom , produits.presentation , produits.description , produits.prix  FROM produits
            INNER JOIN categories ON produits.id_categorie = categories.id 
            INNER JOIN images ON produits.id_image = images.id
            WHERE produits.id_categorie = :id_categorie
            ORDER BY produits.id DESC LIMIT :premier, :parpage';
            $query = parent::getBdd()->prepare($sql);
            $query->bindValue('id_categorie', strip_tags(htmlspecialchars($id_categorie)));
            $query->bindValue(':parpage', $parPage, \PDO::PARAM_INT);
        }
        // $query = parent::getBdd()->prepare($sql);
        $query->bindValue(':premier', $premier, \PDO::PARAM_INT);
        $query->bindValue(':parpage', $parPage, \PDO::PARAM_INT);

        // $query->bindValue(':parpage', $parPage , \PDO::PARAM_INT);
        $query->execute();
        $data = $query->fetchAll();
        // var_dump($data);
        return $data;
    }

    public function searchBar($recherche)
    {
        $sql = "SELECT produits.id , produits.nom , presentation , description , prix , quantite , img_dir FROM produits 
        INNER JOIN images ON produits.id_image = images.id
        WHERE produits.nom LIKE '%$recherche%' OR description LIKE '%$recherche%' OR presentation LIKE '%$recherche%' OR prix LIKE '%$recherche%'";

        $query = parent::getBdd()->prepare($sql);
        $query->execute();
        $data = $query->fetchAll();
        return $data;
    }


    public function addCateg($nom)
    {
        $sql = "INSERT INTO categories (nom) VALUES (:nom)";
        $query = parent::getBdd()->prepare($sql);
        $query->execute([
            'nom' => $nom
        ]);
    }


    public function modifierCateg($nom, $id)
    {
        $sql = "UPDATE categories SET nom = :nom WHERE id = :id";
        $query = parent::getBdd()->prepare($sql);
        $query->execute([
            'nom' => $nom,
            'id' => $id
        ]);
    }

    public function deleteCateg($id)
    {
        $sql = "DELETE FROM categories WHERE id = :id";
        $query = parent::getBdd()->prepare($sql);
        $query->execute([
            'id' => $id
        ]);
    }
}
