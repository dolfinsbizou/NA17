<!DOCTYPE html>
<html lang="fr">
<?php require_once("include/head.php"); ?>
<body>
	<?php require_once("include/nav.php"); ?>
	<div id="main">
		<h1><?= $page_title ?></h1>
		<?= $joinLink ?>
		<?php fancy_table($parcelles, $parcelles_col_names, $parcelles_primary_key, $parcelles_foreign_keys, $parcelles_prefix); ?>
	</div>
</body>
</html>
