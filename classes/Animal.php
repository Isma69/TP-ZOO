<?php

class Animal
{
    protected int $id;
    protected int $species_id;
    protected int $age;
    protected bool $sleep;
    protected bool $hungry;
    protected bool $sick;
    protected int $fences_id;
    protected string $speciesName;
    protected string $avatar;
    protected string $speciesType;


    public function __construct(array $data = [])
    {
        if (!empty($data)) {
            $this->species_id = $data['species_id'];
            $this->age = $data['age'];
            $this->sleep = (bool) $data['sleep'];
            $this->hungry = (bool) $data['hungry'];
            $this->sick = (bool) $data['sick'];
            $this->fences_id = $data['fences_id'];
            $this->avatar = $data['avatar'];
            $this->speciesName = isset($data['speciesName']) ? $data['speciesName'] : 'Unknown';
            $this->speciesType = isset($data['speciesType']) ? $data['speciesType'] : 'Unknown';
        } else {
            // Set default values when no data is provided
            $this->speciesName = 'Unknown';
            $this->speciesType = 'Unknown';
        }
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
     * Get the value of species_id
     */
    public function getSpeciesId(): int
    {
        return $this->species_id;
    }

    /**
     * Set the value of species_id
     */
    public function setSpeciesId(int $species_id): self
    {
        $this->species_id = $species_id;

        return $this;
    }

    /**
     * Get the value of age
     */
    public function getAge(): int
    {
        return $this->age;
    }

    /**
     * Set the value of age
     */
    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get the value of sleep
     */
    public function isSleep(): bool
    {
        return $this->sleep;
    }

    /**
     * Set the value of sleep
     */
    public function setSleep(bool $sleep): self
    {
        $this->sleep = $sleep;

        return $this;
    }

    /**
     * Get the value of hungry
     */
    public function isHungry(): bool
    {
        return $this->hungry;
    }

    /**
     * Set the value of hungry
     */
    public function setHungry(bool $hungry): self
    {
        $this->hungry = $hungry;

        return $this;
    }

    /**
     * Get the value of sick
     */
    public function isSick(): bool
    {
        return $this->sick;
    }

    /**
     * Set the value of sick
     */
    public function setSick(bool $sick): self
    {
        $this->sick = $sick;

        return $this;
    }

    /**
     * Get the value of fences_id
     */
    public function getFencesId(): int
    {
        return $this->fences_id;
    }

    /**
     * Set the value of fences_id
     */
    public function setFencesId(int $fences_id): self
    {
        $this->fences_id = $fences_id;

        return $this;
    }

    /**
     * Get the value of name
     */
    public function getSpeciesName(): string
    {
        return $this->speciesName;
    }

    /**
     * Set the value of name
     */
    public function setSpeciesName(string $name): self
    {
        $this->speciesName = $name;

        return $this;
    }

    /**
     * Get the value of avatar
     */
    public function getAvatar(): string
    {
        return $this->avatar;
    }

    /**
     * Set the value of avatar
     */
    public function setAvatar(string $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * Get the value of speciesType
     */
    public function getSpeciesType(): string
    {
        return $this->speciesType;
    }

    /**
     * Set the value of speciesType
     */
    public function setSpeciesType(string $speciesType): self
    {
        $this->speciesType = $speciesType;

        return $this;
    }
}