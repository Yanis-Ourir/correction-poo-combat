<?php

try {
    $db = new PDO('mysql:host=localhost;dbname=correction_combat', 'root', '');
} catch (PDOException $e) {
    echo 'Erreur de connexion : ' . $e->getMessage();
}
