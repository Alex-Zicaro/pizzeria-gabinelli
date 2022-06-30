<?php

Namespace App\Controller;
Class Controller {

    public function __construct()
    {
        
    }

    function security($var) {
        $var = htmlspecialchars( htmlentities( trim( strip_tags($var))));
        return $var;
    }

}