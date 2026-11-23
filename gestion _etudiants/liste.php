<?php
require_once __DIR__ . '/config/connexion.php';

$pdo = getConnexion();

$filieres = ['Informatique', 'Mathématiques', 'Physique', 'Chimie', 'Biologie'];
$filtre = $_GET['filiere'] ?? '';
if (!in_array($filtre, $filieres, true)) {
    $filtre = '';
}

if ($filtre === '') {
    $stmt = $pdo->query('SELECT id, cne, nom, prenom, email, filiere, date_naissance, date_inscription
                         FROM etudiants ORDER BY nom, prenom');
} else {
    $stmt = $pdo->prepare('SELECT id, cne, nom, prenom, email, filiere, date_naissance, date_inscription
                           FROM etudiants WHERE filiere = :filiere ORDER BY nom, prenom');
    $stmt->bindParam(':filiere', $filtre, PDO::PARAM_STR);
    $stmt->execute();
}

$etudiants = $stmt->fetchAll();
$nbEtudiants = count($etudiants);
$nbColonnes = $stmt->columnCount();

$page = 'liste';
$titre = 'Liste des étudiants';
require __DIR__ . '/includes/header.php';
?>
<h1>Liste des étudiants</h1>

<?php if (isset($_GET['ajout'])): ?>
    <div class="alerte succes">Étudiant ajouté avec succès (id n° <?= e($_GET['ajout']) ?>).</div>
<?php endif; ?>
<?php if (($_GET['supprime'] ?? '') === '1'): ?>
    <div class="alerte succes">Étudiant supprimé avec succès.</div>
<?php elseif (($_GET['supprime'] ?? '') === '0'): ?>
    <div class="alerte erreur">Aucun étudiant n'a été supprimé.</div>
<?php endif; ?>

<div class="card">
    <div class="barre">
        <form method="get" action="liste.php">
            Filière :
            <select name="filiere" onchange="this.form.submit()">
                <option value="">Toutes</option>
                <?php foreach ($filieres as $f): ?>
                    <option value="<?= e($f) ?>" <?= $filtre === $f ? 'selected' : '' ?>><?= e($f) ?></option>
                <?php endforeach; ?>
            </select>
        </form>
        <a href="ajouter.php" class="btn btn-primaire">+ Ajouter</a>
    </div>

    <div class="info"><?= $nbEtudiants ?> étudiant(s) — <?= $nbColonnes ?> colonnes retournées par la requête</div>

    <table>
        <thead>
            <tr>
                <th>#</th><th>CNE</th><th>Nom</th><th>Prénom</th><th>E-mail</th>
                <th>Filière</th><th>Naissance</th><th>Inscrit le</th><th></th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($etudiants as $i => $etu): ?>
            <tr>
                <td><?= $i + 1 ?></td>
                <td><?= e($etu['cne']) ?></td>
                <td><?= e(mb_strtoupper($etu['nom'])) ?></td>
                <td><?= e($etu['prenom']) ?></td>
                <td><?= e($etu['email']) ?></td>
                <td><span class="badge"><?= e($etu['filiere']) ?></span></td>
                <td><?= $etu['date_naissance'] ? e(date('d/m/Y', strtotime($etu['date_naissance']))) : '—' ?></td>
                <td><?= e(date('d/m/Y H:i', strtotime($etu['date_inscription']))) ?></td>
                <td>
                    <form method="post" action="supprimer.php" onsubmit="return confirm('Supprimer cet étudiant ?');">
                        <input type="hidden" name="id" value="<?= (int) $etu['id'] ?>">
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php if ($nbEtudiants === 0): ?>
            <tr><td colspan="9">Aucun étudiant.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
<?php require __DIR__ . '/includes/footer.php'; ?>
