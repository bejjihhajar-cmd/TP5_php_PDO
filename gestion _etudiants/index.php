<?php
require_once __DIR__ . '/config/connexion.php';

$pdo = getConnexion();
$nombre = $pdo->query('SELECT COUNT(*) FROM etudiants')->fetchColumn();

$page = 'accueil';
$titre = 'Accueil';
require __DIR__ . '/includes/header.php';
?>
<h1>Bienvenue</h1>
<div class="card">
    <p class="compteur">Nombre d'étudiants inscrits : <strong><?= e($nombre) ?></strong></p>
    <p><a class="btn btn-primaire" href="ajouter.php">Ajouter un étudiant</a>
       <a class="btn btn-secondaire" href="liste.php">Voir la liste</a></p>
</div>
<?php require __DIR__ . '/includes/footer.php'; ?>
