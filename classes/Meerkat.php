<?php

class Meerkat extends Animal {
    public function __construct(array $data = []) {
        parent::__construct($data); // Appel au constructeur de la classe parente
        
        // Initialisation des propriétés spécifiques aux iguanes si nécessaire
    }

}