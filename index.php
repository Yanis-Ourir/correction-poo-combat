<?php


require_once 'config/autoload.php'; // je charge toutes les classes dont j'ai besoin automatiquement
require_once 'config/db.php';

/**
 * @var PDO $db;
 */
$heroesManager = new HeroesManager($db);

if(isset($_POST['name']) && !empty($_POST['name'])) {
    // si le formulaire est soumis et que le champ name n'est pas vide
    // alors je crée un nouveau héros
    $hero = new Hero([
           'name' => $_POST['name']
    ]);
    $heroesManager->add($hero); // j'ajoute le héros en BDD
}

$allHeroes = $heroesManager->findAllAlive(); // je récupère tous les héros en vie


include_once 'partials/header.php';
?>

<form method="post">
    <div class="mb-3">
        <label for="name" class="form-label">Nom du héros</label>
        <input type="text" class="form-control" name="name" id="name" aria-describedby="emailHelp">
    </div>

    <button type="submit" class="btn btn-primary">Créer</button>
</form>

<?php foreach ($allHeroes as $hero) {
    // je fais une boucle pour afficher tous les héros qui sont en vie
    // $hero sont des objets de la classe Hero donc je peux utiliser les méthodes de cette classe
    ?>

    <div class="card" style="width: 18rem;">
        <img src="..." class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title"> <?= $hero->getName() ?></h5>
            <p class="card-text"><?= $hero->getLifePoint() ?></p>


            <form action="fight.php" method="post">
                <input type="hidden" value="<?= $hero->getId() ?>">
                <button type="submit" class="btn btn-info">Combattre</button>
            </form>
        </div>
    </div>

<?php } ?>

<?php include_once 'partials/footer.php'; ?>


