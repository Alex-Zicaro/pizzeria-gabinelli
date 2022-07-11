<?php

Namespace App\Modele;

use PDO;
use PDOException;

session_start();

Class Modele {

    protected $table;
    private static $dbName = 'pizzeria';
    private static $dbHost = 'localhost';
    private static $dbUsername = 'root';
    private static $dbPassword = '';
    protected static $bdd = null;

    public function __construct()
    {
        
    }

    static function getBdd(): PDO
    {
        if (static::$bdd == NULL) {
            try {
                static::$bdd = new PDO("mysql:host=" . self::$dbHost . ";" . "dbname=" . self::$dbName, self::$dbUsername, self::$dbPassword, [
                    PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]);
            } catch (PDOException $e) {
?>
                <h1 class='bg-danger text-center'>La connexion à échouée<h1>
                        <h3 class='bg-warning'>Le message d'erreur : <?php $e->getMessage()  ?> "</h3>"
        <?php
            }
        } // fin du if
        return static::$bdd;
    }

    public function getAllbyChamp($id){
        $sql = "SELECT * FROM $this->table WHERE id = :id";
        $query = static::getBdd()->prepare($sql);
        $query->execute(array('id' => $id));
        $data = $query->fetch();
        return $data;
    }


    public function deleteOneById($id) : void{

        $sql = "DELETE FROM $this->table WHERE id = :id";
        $query = static::getBdd()->prepare($sql);
        $query->execute([
            'id' => $id
        ]);
    }

    public function getLast()
    {
        $sql = "SELECT * FROM " . $this->table .  "ORDER BY id DESC LIMIT 1";
        $query = static::getBdd()->prepare($sql);
        $query->execute();
        $produit = $query->fetch();
        return $produit;
    }

    public function updateByIdAndChamp($id, $champ, $valeur)
    {
        $sql = "UPDATE $this->table SET $champ = :valeur WHERE id = :id";
        $query = static::getBdd()->prepare($sql);
        $query->execute([
            'id' => $id,
            'valeur' => $valeur
        ]);
    }

    

    

    
}


$obj = new Modele;
