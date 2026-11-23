<?php $page = $page ?? ''; $titre = $titre ?? 'Gestion des étudiants'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e($titre) ?></title>
<link rel="stylesheet" href="assets/style.css">
</head>
<body>
<nav class="navbar">
    <div class="brand">🎓 Gestion des étudiants <small>TP PDO</small></div>
    <div class="menu">
        <a href="index.php" class="<?= $page === 'accueil' ? 'actif' : '' ?>">Accueil</a>
        <a href="ajouter.php" class="<?= $page === 'ajouter' ? 'actif' : '' ?>">Ajouter</a>
        <a href="liste.php" class="<?= $page === 'liste' ? 'actif' : '' ?>">Liste</a>
    </div>
</nav>
<main class="container">
 