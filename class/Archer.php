<?php

class Archer extends Hero
{
    private int $manaCost = 40;
    public function specialHit(Monster $monster) : int // Mon attaque spéciale si j'ai le mana
    {
        $damage = 30;
        $this->setMana($this->getMana() - $this->manaCost);
        $monster->setLifePoint($monster->getLifePoint() - $damage);
        return $damage;
    }

    public function setManaCost(int $manaCost) : void
    {
        $this->manaCost = $manaCost;
    }

    public function getManaCost() : int
    {
        return $this->manaCost;
    }
}