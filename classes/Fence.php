<?php

class Fence
{
    protected int $id;
    protected string $fenceType;
    protected bool $filthy;
    protected int $numberOfAnimal;
    public int $maxCapacity;
    private $db;

    public function setDb(PDO $db){
        $this->db = $db;
    }


    public function __construct(array $data = [], PDO $db = null) {
        $this->maxCapacity = 6; // Set the default max capacity
        $this->db = $db; // Set the $db property
        
        if (!empty($data)) {
            $this->id = $data['id'];
            $this->fenceType = $data['fenceType'];
            $this->filthy = (bool) $data['filthy'];
            $this->calculateNumberOfAnimal($data['id']);
        } else {
            // Default values when no data is provided
            $this->id = 0;
            $this->fenceType = "Meadow";
            $this->filthy = false;
        }
    }

    public function getPicture(): string
    {
        // Replace this with actual logic to get the picture path based on the fence type
        // For example:
        if ($this->fenceType === "Meadow") {
            return "images/meadowbg.png";
        } elseif ($this->fenceType === "FlyCage") {
            return "images/flycagebg.jpg";
        } elseif ($this->fenceType === "PondFence") {
            return "images/pondfencebg.png";
        } else {
            return "images/meadowbg.png";
        }
    }
    /**
     * Calculate the numberOfAnimal based on the given fence ID
     */
    protected function calculateNumberOfAnimal($fenceId) {
        $query = $this->db->prepare('SELECT COUNT(*) FROM animals WHERE fences_id = :fenceId');
        $query->bindValue(':fenceId', $fenceId, PDO::PARAM_INT);
        $query->execute();
        $this->numberOfAnimal = (int) $query->fetchColumn();
    }

    public function incrementNumberOfAnimal() {
        $this->numberOfAnimal++;
    }
    

    /**
     * Get the value of id
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of filthy
     */
    public function isFilthy(): bool
    {
        return $this->filthy;
    }

    /**
     * Set the value of filthy
     */
    public function setFilthy(bool $filthy): self
    {
        $this->filthy = $filthy;

        return $this;
    }

    /**
     * Get the value of numberOfAnimal
     */
    public function getNumberOfAnimal(): int
    {
        return $this->numberOfAnimal;
    }

    /**
     * Set the value of numberOfAnimal
     */
    public function setNumberOfAnimal(int $numberOfAnimal): self
    {
        $this->numberOfAnimal = $numberOfAnimal;

        return $this;
    }

    /**
     * Get the value of maxCapcity
     */
    public function getMaxCapacity(): int
    {
        return $this->maxCapacity;
    }

    /**
     * Set the value of maxCapcity
     */
    public function setMaxCapacity(int $maxCapcity): self
    {
        $this->maxCapacity = $maxCapcity;

        return $this;
    }

    /**
     * Get the value of fenceType
     */
    public function getFenceType(): string
    {
        return $this->fenceType;
    }

    /**
     * Set the value of fenceType
     */
    public function setFenceType(string $fenceType): self
    {
        $this->fenceType = $fenceType;

        return $this;
    }
}