<?php

namespace App\Modele;



Class Paniers extends Modele {

    protected $table;

    public function __construct() {

    parent::__construct();
    $this->table = "paniers";


    }

public function SelectQuantiteFromIdProduit($idProduit) {

    $sql = "SELECT quantite from produits where id = :idproduit";
    $stmt = parent::getBdd()->prepare($sql);
    $stmt->bindValue(':idproduit', $idProduit);
    $stmt->execute();
    $fetch = $stmt->fetch();
    return $fetch['quantite'];
}
public function UpdateQuantiteFromQteProduit($idProduit, $newquantite) {
    $sql2 = "UPDATE produits SET quantite = :quantite WHERE id = :idproduit";
    $stmt = parent::getBdd()->prepare($sql2);
    $stmt->bindValue(':quantite', $newquantite);
    $stmt->bindValue(':idproduit', $idProduit);
    $stmt->execute();
}
public function InsertPanierIntoBdd() {
    $sql = "INSERT INTO paniers (id_utilisateur) VALUES (:id_utilisateur)";
    $stmt = parent::getBdd()->prepare($sql);
    $stmt->bindValue(':id_utilisateur', $_SESSION['profil']['id']);
    $stmt->execute();
}

public function selectLastPanierOfUser(){
    $sql = "SELECT id from paniers where id_utilisateur = :id_utilisateur ORDER BY id DESC LIMIT 1";
    $stmt = parent::getBdd()->prepare($sql);
    $stmt->bindValue(':id_utilisateur', $_SESSION['profil']['id']);
    $stmt->execute();
    $fetch = $stmt->fetch();
    return $fetch['id'];
}

public function addPanierProduit($id_panier) {
    $nombreArticle = count($_SESSION['panier']['idProduit']);

    for($i = 0 ; $i < $nombreArticle ; $i++){

        $sql = "INSERT INTO paniers_produits (id_panier, id_produit, quantite) VALUES (:id_panier, :id_produit, :quantite)";
        $stmt = parent::getBdd()->prepare($sql);

        $stmt->bindValue(':id_panier', $id_panier);
        $stmt->bindValue(':id_produit', $_SESSION['panier']['idProduit'][$i]);
        $stmt->bindValue(':quantite', $_SESSION['panier']['qteProduit'][$i]);

        $stmt->execute();
    }
}

    public function foundPanier(){
        $sql = "SELECT id from paniers where id_utilisateur = :id_utilisateur ORDER BY id DESC LIMIT 1";
        $query = parent::getBdd()->prepare($sql);
        $query->bindValue(':id_utilisateur', $_SESSION['profil']['id']);
        $query->execute();
        $fetch = $query->fetch();
        return $fetch['id'];
    }
}