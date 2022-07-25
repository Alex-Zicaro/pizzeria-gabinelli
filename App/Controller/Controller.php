<?php

Namespace App\Controller;
Class Controller {

    public function __construct()
    {
        
    }

    public function security($var) {
        $var = htmlspecialchars(trim( strip_tags($var)));
        return $var;
    }

}