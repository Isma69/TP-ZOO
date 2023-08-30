<?php
class Employee
{
    // ... (existing methods and properties)

    private $db;

    public function setDb(PDO $db)
    {
        $this->db = $db;
    }

    public function __construct(PDO $db)
    {
        $this->setDb($db);
    }

    public function addFence(Fence $fence)
    {
        $query = $this->db->prepare('INSERT INTO fences(fenceType, filthy, numberOfAnimal, maxCapacity, picture) VALUES (:fenceType, :filthy, :numberOfAnimal, :maxCapacity, :picture)');
        $query->bindValue(':fenceType', $fence->getFenceType());
        $query->bindValue(':filthy', $fence->isFilthy() ? 1 : 0);
        $query->bindValue(':numberOfAnimal', $fence->getNumberOfAnimal());
        $query->bindValue(':maxCapacity', $fence->getMaxCapacity());
        $query->bindValue(':picture', $fence->getPicture());

        $query->execute();
        $id = $this->db->lastInsertId();
        $fence->setId($id);
    }

    public function findAllFences()
    {
        $query = $this->db->query('SELECT * FROM fences');
        $fencesData = $query->fetchAll(PDO::FETCH_ASSOC);

        $fences = array();
        foreach ($fencesData as $fenceData) {
            $fence = new Fence($fenceData, $this->db);
            $fences[] = $fence;
        }
        return $fences;
    }

    public function findFenceById($fenceId)
    {
        $stmt = $this->db->prepare('SELECT * FROM fences WHERE id = :id');
        $stmt->bindValue(':id', $fenceId, PDO::PARAM_INT);
        $stmt->execute();
        $fenceData = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$fenceData) {
            return null;
        }

        return new Fence($fenceData, $this->db); // Pass the $db connection to the Fence constructor
    }

    public function findAnimalsByFenceId($fenceId)
    {
        $query = $this->db->prepare('
            SELECT animals.*, species.speciesName, species.speciesType, species.avatar
            FROM animals
            JOIN species ON animals.species_id = species.id
            WHERE animals.fences_id = :fenceId
        ');
        $query->bindValue(':fenceId', $fenceId, PDO::PARAM_INT);
        $query->execute();
        $animalsData = $query->fetchAll(PDO::FETCH_ASSOC);

        $animals = array();
        foreach ($animalsData as $animalData) {
            $animal = new Animal($animalData);
            $animals[] = $animal;
        }
        return $animals;
    }
    public function updateFence(Fence $fence)
    {
        $query = $this->db->prepare('UPDATE fences SET filthy = :filthy, numberOfAnimal = :numberOfAnimal WHERE id = :id');
        $query->bindValue(':filthy', (int) $fence->isFilthy());
        $query->bindValue(':numberOfAnimal', $fence->getNumberOfAnimal());
        $query->bindValue(':id', $fence->getId());
        $query->execute();
    }

    public function updateAnimal(Animal $animal)
    {
        $query = $this->db->prepare('UPDATE animals SET sick = :sick, hungry = :hungry WHERE id = :id');
        $query->bindValue(':sick', (int) $animal->isSick());
        $query->bindValue(':hungry', (int) $animal->isHungry());
        $query->bindValue(':id', $animal->getId());
        $query->execute();
    }
}
// Other methods and functionalities can be added as needed