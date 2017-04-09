<!DOCTYPE html>
<html lang="fr">
<?php require_once("include/head.php"); ?>
<body>
	<?php require_once("include/nav.php"); ?>
	<div id="main">
		<h1><?= $page_title ?></h1>
		<?= $joinLink ?>
		<?php fancy_table($distributeurs, $distributeurs_col_names, $distributeurs_primary_key, $distributeurs_foreign_keys, $distributeurs_prefix); ?>
	</div>
</body>
</html>
