<?php 
class AnimalsManager {
    private $db;

    public function setDb(PDO $db){
        $this->db = $db;
    }

    public function __construct(PDO $db){
        $this->setDb($db);
    }

    public function add(Animal $animal) {
        $query = $this->db->prepare('INSERT INTO animals(species_id, age, sleep, hungry, sick, fences_id) VALUES (:species_id, :age, :sleep, :hungry, :sick, :fences_id)');
        $query->bindValue(':species_id', $animal->getSpeciesId());
        $query->bindValue(':age', $animal->getAge());
        $query->bindValue(':sleep', $animal->isSleep() ? 1 : 0);
        $query->bindValue(':hungry', $animal->isHungry() ? 1 : 0);
        $query->bindValue(':sick', $animal->isSick() ? 1 : 0);
        $query->bindValue(':fences_id', $animal->getFencesId());
        $query->execute();
        $id = $this->db->lastInsertId();
        $animal->setId($id);
    }

    public function findAllAnimal() {
        $query = $this->db->query('SELECT * FROM animals INNER JOIN species  ON animals.species_id = species.id');
        $animalsData = $query->fetchAll(PDO::FETCH_ASSOC);
    
        $animals = array();
        foreach ($animalsData as $animalData) {
            if (isset($animalData['speciesName'])) { // Utiliser species_name au lieu de name
                $animal = new Animal($animalData);
                $animals[] = $animal;
            }
        }
        return $animals;
    }


    public function find($animalId) {
        $stmt = $this->db->prepare("SELECT a.*, s.name AS speciesName, s.speciesType, s.avatar AS species_avatar, f.fenceType, f.filthy, f.numberOfAnimal 
                                   FROM animals AS a
                                   JOIN species AS s ON a.species_id = s.id
                                   JOIN fences AS f ON a.fences_id = f.id
                                   WHERE a.id = :id");
        $stmt->bindParam(':id', $animalId, PDO::PARAM_INT);
        $stmt->execute();

        $animalData = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$animalData) {
            return null;
        }

        return new Animal($animalData);
    }

    public function update(Animal $animal) {
        $query = $this->db->prepare('UPDATE animals SET age = :age, sleep = :sleep, hungry = :hungry, sick = :sick WHERE id = :id');
        $query->bindValue(':age', $animal->getAge());
        $query->bindValue(':sleep', (int) $animal->isSleep());
        $query->bindValue(':hungry', (int) $animal->isHungry());
        $query->bindValue(':sick', (int) $animal->isSick());
        $query->bindValue(':id', $animal->getId());
        $query->execute();
    }
}