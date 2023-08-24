<?php

class Fence
{
    protected int $id;
    protected string $fenceType;
    protected bool $filthy;
    protected int $numberOfAnimal;
    public int $maxCapacity;


    public function __construct(array $data = []) {
        $this->maxCapacity = 6; // Set the default max capacity
        
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
            $this->numberOfAnimal = 0;
        }
    }

    /**
     * Calculate the numberOfAnimal based on the given fence ID
     */
    protected function calculateNumberOfAnimal($fenceId) {
        // You will need to implement logic to count the number of animals
        // with the corresponding fences_id and update numberOfAnimal accordingly.
        // This could involve a database query to count animals with the given fences_id.
        // For now, we'll simply set it to a default value.
        $this->numberOfAnimal = 0; // Replace with actual logic to calculate the count
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