<?php

class Hero
{
    private int $id;
    private string $name;
    private int $lifePoint = 100;

    public function __construct(array $data) {
        $this->name = $data['name']; // je récupère le nom du héros dans le tableau que je passe dans le constructeur
    }

    public function hit() {

    }

    public function setName(string $name) : void
    {
        $this->name = $name;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function setLifePoint(int $lifePoint) : void
    {
        $this->lifePoint = $lifePoint;
    }

    public function getLifePoint() : int
    {
        return $this->lifePoint;
    }

    public function setId(int $id) : void
    {
        $this->id = $id;
    }

    public function getId() : int
    {
        return $this->id;
    }

}
