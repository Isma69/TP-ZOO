<?php 
    class Employee {
    // ... (existing methods and properties)

    private $db;

    public function setDb(PDO $db){
        $this->db = $db;
    }

    public function __construct(PDO $db){
        $this->setDb($db);
    }

    public function addFence(Fence $fence) {
        $query = $this->db->prepare('INSERT INTO fences(fenceType, filthy, numberOfAnimal, maxCapacity) VALUES (:fenceType, :filthy, :numberOfAnimal, :maxCapacity)');
        $query->bindValue(':fenceType', $fence->getFenceType());
        $query->bindValue(':filthy', $fence->isFilthy() ? 1 : 0);
        $query->bindValue(':numberOfAnimal', $fence->getNumberOfAnimal());
        $query->bindValue(':maxCapacity', $fence->getMaxCapacity());
        $query->execute();
        $id = $this->db->lastInsertId();
        $fence->setId($id);
    }

    public function findAllFences() {
        $query = $this->db->query('SELECT * FROM fences');
        $fencesData = $query->fetchAll(PDO::FETCH_ASSOC);

        $fences = array();
        foreach ($fencesData as $fenceData) {
            $fence = new Fence($fenceData);
            $fences[] = $fence;
        }
        return $fences;
    }


    public function findFenceById($fenceId) {
        $stmt = $this->db->prepare('SELECT * FROM fences WHERE id = :id');
        $stmt->bindValue(':id', $fenceId, PDO::PARAM_INT);
        $stmt->execute();
        $fenceData = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if (!$fenceData) {
            return null;
        }
    
        return new Fence($fenceData);
    }

    public function updateFence(Fence $fence) {
        $query = $this->db->prepare('UPDATE fences SET filthy = :filthy, numberOfAnimal = :numberOfAnimal WHERE id = :id');
        $query->bindValue(':filthy', (int) $fence->isFilthy());
        $query->bindValue(':numberOfAnimal', $fence->getNumberOfAnimal());
        $query->bindValue(':id', $fence->getId());
        $query->execute();
    }
    }
    // Other methods and functionalities can be added as needed