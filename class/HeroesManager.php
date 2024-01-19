<?php

class HeroesManager
{
    private $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }
 // CRUD : C = Create R = Read U = Update D = Delete
    public function add(Hero $hero) : void // Je met en paramètre un objet de la classe Hero, donc je peux utiliser les méthodes de cette classe
    {
        // je crée une requête SQL pour ajouter un héros en BDD
        $request = $this->db->prepare("INSERT INTO hero (name) VALUES (:name)");
        $request->execute([
           'name' => $hero->getName()
        ]); // j'exécute ma requête SQL avec les données de mon objet Hero

        $id = $this->db->lastInsertId();
        $hero->setId($id); // je donne un id à mon objet Hero
    }

    public function findAllAlive() : array
    {
        $request = $this->db->query("SELECT * FROM hero WHERE hero.health_point > 0");
        // ma requête me retourne un tableau de héros qui ont des points de vie supérieur à 0
        $heroesAlives = $request->fetchAll();

        $heroes = []; // je crée un tableau vide

        foreach ($heroesAlives as $heroAlive) { // je fais une boucle sur mes héros en vie grâce à la requête SQL
            $hero = new Hero($heroAlive); // je crée un objet Hero avec les données de chaque héros en vie, $heroAlive est un tableau
            $hero->setId($heroAlive['id']); // je donne un id à mon objet Hero
            $heroes[] = $hero; // j'ajoute mon objet Hero dans mon tableau $heroes
        }

        return $heroes; // je retourne mon tableau $heroes qui est un tableau d'OBJETS Hero
    }

}