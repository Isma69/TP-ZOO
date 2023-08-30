<?php 

class Veterinary extends Employee {
    public function healAnimal(Animal $animal) {
        // Implementez la logique pour soigner l'animal
        $animal->setSick(false);
        // Mettez à jour l'animal dans la base de données
        $this->updateAnimal($animal);
    }
}