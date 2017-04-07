<!DOCTYPE html>
<html lang="fr">
<?php require_once("include/head.php"); ?>
<body>
	<?php require_once("include/nav.php"); ?>
	<div id="main">
		<h1><?= $page_title ?></h1>
		<?= $joinLink ?>
		<?php fancy_table($recoltes, $recoltes_col_names, $recoltes_primary_key, $recoltes_foreign_keys, $recoltes_prefix); ?>
	</div>
</body>
</html>
