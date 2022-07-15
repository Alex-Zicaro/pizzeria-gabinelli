<?php

Namespace App\Modele;

class Adresses extends Modele {

    public function __construct() {

        parent::__construct();
    }

    public function getAdresse($id) {

        $sql = "SELECT * FROM adresses WHERE id = :id";
        $query = static::getBdd()->prepare($sql);
        $query->execute(array('id' => $id));
        $data = $query->fetch();
        return $data;
    }

    public function rowCountAdresses() {

        $sql = "SELECT * FROM adresses";
        $query = static::getBdd()->prepare($sql);
        $query->execute();
        $data = $query->rowCount();
        return $data;
    }
}
