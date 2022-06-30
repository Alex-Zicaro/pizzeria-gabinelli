<?php

namespace App\Modele;

abstract class Produits extends Modele{

    public function selectProduits(?int $id_categorie, int $order = 0)
    {

        if ($id_categorie !== null) {
            $sql = "SELECT categories.nom AS categ, sous_categorie.nom AS sous_categ, produits.id , produits.nom , produits.description , produits.prix , produits.quantite
            FROM produits
            INNER JOIN categories ON produits.id_categorie = categories.id 
            INNER JOIN sous_categorie ON categories.id = sous_categorie.id_categorie
            INNER JOIN images ON produits.id_image = images.id
            WHERE categories.id = :id_categorie ";
            $prepare = parent::getBdd()->prepare($sql);
            $prepare->execute([':id_categorie' => $id_categorie]);
        } else if ($order == 1 && $id_categorie == null) {

            $sql = "SELECT images.nom AS image_nom , images.img_dir ,  categories.nom AS categ, sous_categorie.nom AS sous_categ , produits.id , produits.nom, produits.presentation , produits.description , produits.prix , produits.quantite FROM produits
            INNER JOIN categories ON produits.id_categorie = categories.id
            INNER JOIN sous_categorie ON categories.id = sous_categorie.id_categorie
            INNER JOIN images ON produits.id_image = images.id ORDER BY id DESC";

            $prepare = parent::getBdd()->prepare($sql);
            $prepare->execute();
        } else {
            $sql = "SELECT images.nom AS image_nom , images.img_dir ,  categories.nom AS categ, sous_categorie.nom AS sous_categ , produits.id , produits.nom, produits.presentation , produits.description , produits.prix , produits.quantite FROM produits
            INNER JOIN categories ON produits.id_categorie = categories.id
            INNER JOIN sous_categorie ON categories.id = sous_categorie.id_categorie
            INNER JOIN images ON produits.id_image = images.id";

            $prepare = parent::getBdd()->prepare($sql);
            $prepare->execute();
        }

        $data = $prepare->fetchAll();

        return $data;
    }

    public function selectProduit(int $id_produit)
    {


        $sql = "SELECT images.img_dir, images.nom , categories.nom AS categ , sous_categorie.nom AS sous_nom, produits.id , produits.nom , produits.presentation , produits.description , produits.prix , produits.quantite FROM produits
            INNER JOIN categories ON produits.id_categorie = categories.id 
            INNER JOIN sous_categorie ON categories.id = sous_categorie.id_categorie
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

            $sql = "SELECT images.nom AS image_nom , images.img_dir ,  categories.nom AS categ, sous_categorie.nom AS sous_categ , produits.id , produits.nom, produits.presentation , produits.description , produits.prix , produits.quantite FROM produits
        INNER JOIN categories ON produits.id_categorie = categories.id
        INNER JOIN sous_categorie ON categories.id = sous_categorie.id_categorie
        INNER JOIN images ON produits.id_image = images.id 
        WHERE produits.id = :value ";

            $prepare = parent::getBdd()->prepare($sql);

            // var_dump($array);

            $prepare->execute(['value' => $value]);
            $data[] = $prepare->fetchAll();
        }
        return ($data);
    }


    public function selectCateg()
    {

        $sql = "SELECT DISTINCT  categ.nom AS nomCateg , sous_categ.nom , categ.id AS idCateg 
        FROM categories AS categ 
        WHERE categ.id = sous_categ.id_categorie";
        $prep = parent::getBdd()->prepare($sql);
        $prep->execute();
        $data = $prep->fetchAll();
        return $data;
    }

    public function selectsCateg()
    {

        $sql = "SELECT * FROM categories";
        $prep = parent::getBdd()->prepare($sql);
        $prep->execute();
        $data = $prep->fetchAll();
        return $data;
    }
    public function SelectsSousCateg()
    {

        $sql = "SELECT * FROM sous_categorie";
        $prep = parent::getBdd()->prepare($sql);
        $prep->execute();
        $data = $prep->fetchAll();
        return $data;
    }

    /**
     * Compte tout les produits sinon s'il y a un param vous compter les produits de la catégorie
     * pagination
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


    public function addProduit($nom, $description, $presentation, $prix, $quantite, $id_categorie, $id_sous_categ, $id_image)
    {

        $sql = "INSERT INTO produits(nom, description , presentation , prix , quantite , id_categorie, id_sous_categorie , id_image) 
    VALUES (:nom, :description, :presentation, :prix ,:quantite , :id_categorie , :id_sous_categorie , :id_image)";

        $query = parent::getBdd()->prepare($sql);
        $query->execute([
            'nom' => $nom, 'description' => $description, 'presentation' => $presentation,
            'prix' => $prix, 'quantite' => $quantite, 'id_categorie' => $id_categorie,
            'id_sous_categorie' => $id_sous_categ, 'id_image' => $id_image

        ]);
    }

    public function trouverLacateg($id_sous_categ)
    {

        $sql = "SELECT categories.nom, categories.id , sous_categorie.nom AS sous_nom FROM sous_categorie 
        INNER JOIN categories ON categories.id = sous_categorie.id_categorie
        WHERE sous_categorie.id = :id_sous_categ";
        $query = parent::getBdd()->prepare($sql);
        $query->execute(['id_sous_categ' => $id_sous_categ]);
        $data = $query->fetch();
        return $data;
    }

    public function lastProduit()
    {
        $sql = "SELECT * FROM produits ORDER BY id DESC LIMIT 1";
        $query = parent::getBdd()->prepare($sql);
        $query->execute();
        $produit = $query->fetch();
        return $produit;
    }
    public function deleteRequete($id_produit)
    {

        $sql = "DELETE FROM produits WHERE id = :id_produit";
        $query = parent::getBdd()->prepare($sql);
        $query->execute(['id_produit' => $id_produit]);
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
        $sql = "SELECT produits.id , produits.nom ,id_image , images.img_dir , presentation , prix ,
        categories.nom AS nom_categorie , sous_categorie.nom AS nom_sous_categorie
        FROM produits
        INNER JOIN categories ON categories.id = produits.id_categorie
        INNER JOIN sous_categorie ON sous_categorie.id = produits.id_sous_categorie

        INNER JOIN images ON id_image = images.id
        ORDER BY id DESC LIMIT 4 ";
        $query = parent::getBdd()->prepare($sql);
        $query->execute();
        $data = $query->fetchAll();
        return $data;
    }
    public function PagePagination($premier, $parPage, ?int $id_categorie = 0, ?bool $sous_categ_path = false)
    {
// var_dump($id_categorie);

        if ($id_categorie == 0) {

            $sql = 'SELECT DISTINCT images.img_dir, images.nom , categories.nom AS categ , sous_categorie.nom AS sous_nom, produits.id , produits.nom , produits.presentation , produits.description , produits.prix , produits.quantite FROM produits
        INNER JOIN categories ON produits.id_categorie = categories.id 
        INNER JOIN sous_categorie ON produits.id_sous_categorie = sous_categorie.id
        INNER JOIN images ON produits.id_image = images.id
        ORDER BY id DESC LIMIT :premier, :parpage';
            $query = parent::getBdd()->prepare($sql);
        } else if (isset($_GET['sous_categ']) && $sous_categ_path == true) {
            // echo"ON EST LALALALLALALALAZLZEJAZLENAKZJN";
            $sql = 'SELECT DISTINCT images.img_dir, images.nom , categories.nom AS categ , sous_categorie.nom AS sous_nom, produits.id , produits.nom , produits.presentation , produits.description , produits.prix , produits.quantite FROM produits
            INNER JOIN categories ON produits.id_categorie = categories.id 
            RIGHT JOIN sous_categorie ON produits.id_sous_categorie = sous_categorie.id
            INNER JOIN images ON produits.id_image = images.id
            WHERE produits.id_sous_categorie = :id_sous_categorie
            ORDER BY id DESC LIMIT :premier, :parpage';
            $query = parent::getBdd()->prepare($sql);
            $query->bindValue('id_sous_categorie', strip_tags(htmlspecialchars($id_categorie)));

        } else if (isset($_GET['categorie'])) {
            $sql = 'SELECT DISTINCT images.img_dir, images.nom , categories.nom AS categ , sous_categorie.nom AS sous_nom, produits.id , produits.nom , produits.presentation , produits.description , produits.prix , produits.quantite FROM produits
            INNER JOIN categories ON produits.id_categorie = categories.id 
            RIGHT JOIN sous_categorie ON produits.id_sous_categorie = sous_categorie.id
            INNER JOIN images ON produits.id_image = images.id
            WHERE produits.id_categorie = :id_categorie
            ORDER BY id DESC LIMIT :premier, :parpage';
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
    public function verifQuantite($quantite, $id_produit)
    {

        $sql = "SELECT quantite FROM produits WHERE id = :id_produit";
        $query = parent::getBdd()->prepare($sql);
        $query->execute(['id_produit' => $id_produit]);
        $data = $query->fetch();
        if ($quantite > $data['quantite']) {
            return false;
        } else {
            return true;
        }
    }

    public function addCateg($nom)
    {
        $sql = "INSERT INTO categories (nom) VALUES (:nom)";
        $query = parent::getBdd()->prepare($sql);
        $query->execute([
            'nom' => $nom
        ]);
    }

    public function addSousCateg($nom, $id_categorie)
    {
        $sql = "INSERT INTO sous_categorie (nom,id_categorie) VALUES (:nom,:id_categorie)";
        $query = parent::getBdd()->prepare($sql);
        $query->execute([
            'nom' => $nom,
            'id_categorie' => $id_categorie
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
    public function modifierSousCateg($nom, $id)
    {
        $sql = "UPDATE sous_categorie SET nom = :nom WHERE id = :id";
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

    public function queLesSousCateg($id_categorie)
    {
        $sql = "SELECT DISTINCT sous_categorie.nom , sous_categorie.id  
        FROM sous_categorie 
        INNER JOIN categories On sous_categorie.id_categorie = categories.id
        WHERE id_categorie = :id_categorie";
        $query = parent::getBdd()->prepare($sql);
        $query->execute([
            'id_categorie' => $id_categorie
        ]);
        $data = $query->fetchAll();
        return $data;
    }

    public function deleteSousCateg($id)
    {
        $sql = "DELETE FROM sous_categorie WHERE id = :id";
        $query = parent::getBdd()->prepare($sql);
        $query->execute([
            'id' => $id
        ]);
    }

    public function sousCategByIdCateg($id_categorie)
    {

        $sql = "SELECT * FROM sous_categorie WHERE id_categorie = :id_categorie";
        $query = parent::getBdd()->prepare($sql);
        $query->execute([
            'id_categorie' => $id_categorie
        ]);
        $data = $query->fetchAll();
        return $data;
    }

    public function countSousCateg($id_sous_categ){
        $sql ="SELECT COUNT(*) AS nb FROM produits WHERE id_sous_categorie = :id_sous_categ";
        $query = parent::getBdd()->prepare($sql);
        $query->execute([
            'id_sous_categ' => $id_sous_categ
        ]);
        $data = $query->fetch();
        return $data;
    }
}
