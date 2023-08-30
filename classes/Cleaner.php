<?php 

class Cleaner extends Employee {
    public function cleanFence(Fence $fence) {
        // Vérifiez si l'enclos est vide
        if ($fence->getNumberOfAnimal() === 0) {
            // Implémentez la logique pour nettoyer l'enclos
            $fence->setFilthy(false);
            // Mettez à jour l'enclos dans la base de données
            $this->updateFence($fence);
        } else {
            echo "Impossible de nettoyer un enclos occupé.";
        }
    }
}