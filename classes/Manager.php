<?php 

class Manager extends Employee {
    public function moveAnimal(Animal $animal, Fence $destinationFence) {
        // Implementez la logique pour déplacer l'animal vers l'enclos de destination
        $animal->setFencesId($destinationFence->getId());
        // Mettez à jour l'animal dans la base de données
        $this->updateAnimal($animal);
        
        // Mettez à jour le nombre d'animaux dans l'enclos source et de destination
        $sourceFence = $this->findFenceById($animal->getFencesId());
        $sourceFence->setNumberOfAnimal($sourceFence->getNumberOfAnimal() - 1);
        $this->updateFence($sourceFence);
        
        $destinationFence->setNumberOfAnimal($destinationFence->getNumberOfAnimal() + 1);
        $this->updateFence($destinationFence);
    }

    public function giveFood(Animal $animal) {
        // Implémentez la logique pour donner de la nourriture à l'animal
        $animal->setHungry(false);
        // Mettez à jour l'animal dans la base de données
        $this->updateAnimal($animal);
    }
}