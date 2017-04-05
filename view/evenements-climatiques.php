<!DOCTYPE html>
<html lang="fr">
<?php require_once("include/head.php"); ?>
<body>
	<?php require_once("include/nav.php"); ?>
	<div id="main">
		<h1><?= $page_title ?></h1>
		<?= $joinLink ?>
		<?php fancy_table($evenements, $evenements_col_names, $evenements_primary_key, $evenements_foreign_keys, $evenements_prefix); ?>
		IL MANQUE ENCORE LA LISTE DES PARCELLES TOUCHEES. Faire fonction SQL pour avoir un champ calculé de la liste des parcelles touchées pour chaque évènement, séparés par un retour chariot (ensuite pour l'affichage on fait un traitement en splittant la chaine en tableau, etc.) + Dummy primary key, récupérer la date non formatée pour la clé primaire
	</div>
</body>
</html>
