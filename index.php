<?php


require_once 'config/autoload.php'; // je charge toutes les classes dont j'ai besoin automatiquement
require_once 'config/db.php';

/**
 * @var PDO $db;
 */
$heroesManager = new HeroesManager($db);

if(isset($_POST['name']) && !empty($_POST['name']) && isset($_POST['class']) && !empty($_POST['class'])) {
    // si le formulaire est soumis et que le champ name n'est pas vide
    // alors je crée un nouveau héros


    $class = ucfirst($_POST['class']);

    $hero = new $class([
            'name' => $_POST['name'],
            'class' => $_POST['class']
    ]);

    $heroesManager->add($hero); // j'ajoute le héros en BDD
}

$allHeroes = $heroesManager->findAllAlive(); // je récupère tous les héros en vie


include_once 'partials/header.php';
?>

<form method="post" class="mt-4 p-4">
    <div class="mb-3">
        <label for="name" class="form-label">Nom du héros</label>
        <input type="text" class="form-control" name="name" id="name" aria-describedby="emailHelp">
    </div>

    <div class="mb-3">
        <label for="name" class="form-label">Classe du héros</label>
        <select class="form-select" name="class" id="name" aria-describedby="emailHelp">
            <option value="Archer">Archer</option>
            <option value="Mage">Mage</option>
            <option value="Guerrier">Guerrier</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Créer</button>
</form>


<div class="container">
    <div class="row">

<?php foreach ($allHeroes as $hero) { ?>
    <div class="col-4">
        <div class="card mt-4" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title"> <?= $hero->getName() ?></h5>
                <p class="card-text"><?= $hero->getLifePoint() ?></p>


                <form action="fight.php" method="post">
                    <input type="hidden" value="<?= $hero->getId() ?>" name="hero_id">
                    <button type="submit" class="btn btn-info">Combattre</button>
                </form>
            </div>
        </div>
    </div>
<?php } ?>
    </div>
</div>

<?php include_once 'partials/footer.php'; ?>


