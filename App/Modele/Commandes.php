<?php

namespace App\Modele;
class Commandes extends Modele
{

    protected $table;

    public function __construct()
    {

        $this->table = 'commandes';
    }

    public function addAdresse($id_utilisateur, $rue, $code_postal, $ville, $telephone) :void
    {

        $sql = "INSERT INTO adresses (ville, rue , code_postal, telephone , id_utilisateur) VALUES ( :ville, :rue, :code_postal,  :telephone , :id_utilisateur)";
        $query = parent::getBdd()->prepare($sql);

        $query->execute([
            'id_utilisateur' => $id_utilisateur,
            'rue' => $rue,
            'code_postal' => $code_postal,
            'ville' => $ville,
            'telephone' => $telephone

        ]);
    }

    public function selectAdresse($id_utilisateur) :array
    {

        $sql = "SELECT adresses.ville , adresses.rue , adresses.code_postal , adresses.telephone FROM adresses 
        INNER JOIN utilisateurs ON utilisateurs.id = adresses.id_utilisateur
        WHERE id_utilisateur = :id_utilisateur";
        $query = parent::getBdd()->prepare($sql);
        $query->execute([
            'id_utilisateur' => $id_utilisateur
        ]);
        $data = $query->fetch();
        return $data;
    }

    public function addCommande($id_utilisateur, $id_adresse, $id_panier) :void
    {

        $sql = "INSERT INTO commandes (vente_date , id_utilisateur , id_adresse , id_panier) VALUES ( NOW()  , :id_utilisateur , :id_adresse , :id_panier)";
        $query = parent::getBdd()->prepare($sql);

        $query->execute([

            'id_utilisateur' => $id_utilisateur,
            'id_adresse' => $id_adresse,
            'id_panier' => $id_panier

        ]);
    }

    public function foundAdresse() : string
    {
        $sql = "SELECT id FROM adresses WHERE id_utilisateur = :id_utilisateur";
        $query = parent::getBdd()->prepare($sql);
        $query->execute([
            'id_utilisateur' => $_SESSION['profil']['id']
        ]);
        $data = $query->fetch();
        return $data['id'];
    }

    public function countCommande() :int
    {
        $sql = "SELECT COUNT(id) FROM paniers WHERE id_utilisateur = :id_utilisateur";
        $query = parent::getBdd()->prepare($sql);
        $query->execute([
            'id_utilisateur' => $_SESSION['profil']['id']
        ]);
        $data = $query->fetch();
        return $data['COUNT(id)'];
    }



    public function foundCommande()
    {
        $sql = "SELECT commandes.vente_date , adresses.ville , adresses.rue , adresses.code_postal , adresses.telephone , paniers_produits.id_produit , paniers.id AS panierId , utilisateurs.email
         FROM commandes 
        INNER JOIN utilisateurs ON utilisateurs.id = commandes.id_utilisateur
        INNER JOIN adresses ON adresses.id = commandes.id_adresse
        INNER JOIN paniers ON paniers.id = commandes.id_panier
        INNER JOIN paniers_produits ON paniers_produits.id_panier = paniers.id
        LEFT JOIN produits ON produits.id = paniers_produits.id_produit 
        LEFT JOIN images ON images.id = produits.id_image AND utilisateurs.id_image = images.id
        -- INNER JOIN produits ON produits.id = paniers_produits.id_produit
        WHERE commandes.id_utilisateur = :id_utilisateur 
        ORDER BY vente_date DESC LIMIT 1 ";
        $query = parent::getBdd()->prepare($sql);
        $query->execute([
            'id_utilisateur' => $_SESSION['profil']['id']
        ]);
        $data = $query->fetch();
        // var_dump($data);
        return $data;
    }


    public function checkAdresse()
    {
        if(isset($_SESSION['profil'])){

            $sql = "SELECT ville , rue , code_postal , telephone FROM adresses WHERE id_utilisateur = :id_utilisateur";
            $query = parent::getBdd()->prepare($sql);
            $query->execute([
                'id_utilisateur' => $_SESSION['profil']['id']
            ]);
            $data = $query->fetch();
            if ($data !== false) {
                return $data;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function verifTelephone(){
        $sql = "SELECT telephone FROM adresses ";
        $query = parent::getBdd()->prepare($sql);
        $query->execute([
            
        ]);

        $data = $query->fetch();

        if ($data !== false) {
            return $data;
        } else {
            return false;
        }
    }

    public function modifierAdresse($adresse,$id_utilisateur) :void{
        // echo"<pre>";
        // var_dump($adresse);
        // echo"</pre>";
        $sql = "UPDATE adresses SET ville = :ville , rue = :rue , code_postal = :code_postal , telephone = :telephone WHERE id_utilisateur = :id_utilisateur";
        $query = parent::getBdd()->prepare($sql);
        $query->execute([
            'ville' => $adresse['ville'],
            'rue' => $adresse['rue'],
            'code_postal' => $adresse['postal'],
            'telephone' => $adresse['tel'],
            'id_utilisateur' => $id_utilisateur
        ]);
    }

    public function afficherHistorique(){
        $sql = "SELECT DISTINCT paniers.id as panierId , commandes.vente_date , utilisateurs.email  FROM commandes 
        INNER JOIN utilisateurs ON utilisateurs.id = commandes.id_utilisateur
        INNER JOIN paniers ON paniers.id = commandes.id_panier
        INNER JOIN paniers_produits ON paniers_produits.id_panier = paniers.id
        LEFT JOIN adresses ON adresses.id = commandes.id_adresse
        -- INNER JOIN produits ON produits.id = paniers_produits.id_produit
        INNER JOIN images ON images.id = utilisateurs.id_image
        WHERE commandes.id_utilisateur = :id_utilisateur";
        $query = parent::getBdd()->prepare($sql);
        $query->execute([
            'id_utilisateur' => $_SESSION['profil']['id']
        ]);
        $data = $query->fetchAll();
        return $data;
    }

    public function foundProduit($id_panier) : array{
        $sql = "SELECT produits.id , produits.nom , produits.description , produits.prix , images.img_dir , images.nom_img,
        categories.nom_categ , paniers_produits.quantite 
        FROM paniers_produits
        INNER JOIN produits ON produits.id = paniers_produits.id_produit
        INNER JOIN images ON images.id = produits.id_image
        INNER JOIN categories ON categories.id = produits.id_categorie
        WHERE paniers_produits.id_panier = :id_panier ";
        
        $query = parent::getBdd()->prepare($sql);

        $query->execute([
            'id_panier' => $id_panier
        ]);

        $data = $query->fetchALl();
        return $data ;
    }

    public function countProduit($id_panier){

        

            $sql = "SELECT COUNT(id_produit) FROM paniers_produits WHERE id_panier = :id_panier";
            $query = parent::getBdd()->prepare($sql);
            $query->execute([
                'id_panier' => $id_panier
            ]);

            $data = $query->fetchAll();
        
        return $data['COUNT(id_produit)'];

    }

    public function produitDeLaCommande($id){
        // echo"eazeazeazezaezaeaz";
        $sql = "SELECT produits.id AS produitId , produits.nom , produits.description , produits.prix , paniers_produits.quantite as quantiteProduit , 
        images.img_dir , categories.nom_categ
        FROM paniers_produits
        LEFT JOIN produits ON produits.id = paniers_produits.id_produit
        INNER JOIN images ON images.id = produits.id_image
        INNER JOIN categories ON categories.id = produits.id_categorie
        WHERE paniers_produits.id_panier = :id_panier ";
        
        $query = parent::getBdd()->prepare($sql);

        $query->execute([
            'id_panier' => $id
        ]);
        

        $data = $query->fetchALl();
        // var_dump($data);
        return $data ;
    }
    }

    

