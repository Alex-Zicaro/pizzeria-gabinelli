<?php

namespace App\Controller;

class Adresses extends Controller {

    public function __construct()
    {
        $this->requete = new \App\Modele\Adresses;
    }

    public function

    getAdresse($id) {

        $rowCountAdresse = $this->requete->rowCountAdresses();
        if($rowCountAdresse > 0) {
            $this->requete->getAdresses($id);
        } else {
            return false;
        }
    }
}