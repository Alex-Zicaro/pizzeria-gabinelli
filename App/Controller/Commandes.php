<?php 


namespace App\Controller;



class Commandes
{

    public function __construct()
    {

        $this->commande = new \App\Modele\Commandes;
        $this->panier = new Paniers;
    }

    public function addAdresse()
    {

        $id_utilisateur = $_SESSION['profil']['id'];
        $adresse = htmlspecialchars(strip_tags($_POST['rue']));
        $code_postal = htmlspecialchars(strip_tags($_POST['postal']));
        $ville = htmlspecialchars(strip_tags($_POST['ville']));
        $telephone = htmlspecialchars(strip_tags($_POST['tel']));


        if (empty($adresse) && $adresse == "") {
            echo "Vous n'avez pas mis d'adresse";
        } else if (empty($code_postal) && $code_postal == "") {
            echo "Vous n'avez pas mis de code postal";
        } else if (empty($ville) && $ville == "") {
            echo "Vous n'avez pas mis de ville";
        } else if (empty($telephone) && $telephone == "") {
            echo "Vous n'avez pas mis de telephone";
        } else {
            $this->commande->addAdresse($id_utilisateur, $adresse, $code_postal, $ville, $telephone);
            // var_dump($id_utilisateur , $adresse , $code_postal , $ville , $telephone);
            header('Refresh:0');
            die();
        }
    }

    public function addCommande(int $id_utilisateur,int $id_adresse,int $id_panier)
    {

        
        $id_utilisateur = htmlspecialchars(strip_tags(intval($id_utilisateur)));
        $id_adresse = htmlspecialchars(strip_tags(intval($id_adresse)));
        $id_panier = htmlspecialchars(strip_tags(intval($id_panier)));

        if ($this->panier->isVerrouille() !== true) {
            $this->commande->addCommande($id_utilisateur, $id_adresse, $id_panier);
            // $this->panier->unlockPanier();
            header('Refresh:0');
            die();
        } else {
            echo "Votre panier n'est pas verrouillé";
        }
    }

    public function modifierAdresse(array $adresse ,int $id_utilisateur){
            
            
            foreach($adresse as $key => $value){
                $adresse[$key] = htmlspecialchars(strip_tags($value));
            }
            
            $id_utilisateur = htmlspecialchars(strip_tags(intval($id_utilisateur)));
    
            if (empty($adresse) && $adresse == []) {
                echo "Vous n'avez pas mis d'adresse";
            } else {
                $this->commande->modifierAdresse($adresse,$id_utilisateur);
                header('Refresh:0');
                die();
            }
    }
 // pas finis ici
    public function afficherHistorique($id_utilisateur){
        $id_utilisateur = htmlspecialchars(strip_tags(intval($id_utilisateur)));
        $historique = $this->commande->afficherHistorique($id_utilisateur);

        // $nb_commande = count($historique);
        // var_dump($nb_commande);
        // $i = 0;
        // $j = 1;
        // while( $i < $nb_commande ){
        //     while( $j < $nb_commande ){
        //         var_dump($historique[$i++]['panierId']);
                
        //         var_dump($historique[$j++]['panierId']);

        //         if($historique[$i++]['panierId'] == $historique[$j++]['panierId']){
        //             $historique[$i++] = array_merge($historique[$i++] ,$historique[$j++]);
        //             echo"test";
        //             // break;
        //         }
                
        //     }
            
        // }

        // for($i = 0 ; $i < count($historique) ; $i++){
            // var_dump($historique[$i]['vente_date']);
            // $divisionHistorique = explode(' ',$historique[$i]['vente_date']);
            
            // $historique[$i]['vente_date'] = date('d/m/Y',strtotime($historique[$i]['date']));
            // var_dump($historique[$i]['vente_date']);
        // }

        return $historique;
    }

    public function countProduit($id_panier){

        $id_panier = htmlspecialchars(strip_tags(intval($id_panier)));
        $count = $this->commande->countProduit($id_panier);
        return $count;
    }

    public function produitDeLaCommande($id){
        $id = htmlspecialchars(strip_tags(intval($id)));
        $produit = $this->commande->produitDeLaCommande($id);
        return $produit;
    }
}
