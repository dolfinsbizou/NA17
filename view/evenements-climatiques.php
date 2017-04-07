<!DOCTYPE html>
<html lang="fr">
<?php require_once("include/head.php"); ?>
<body>
	<?php require_once("include/nav.php"); ?>
	<div id="main">
		<h1><?= $page_title ?></h1>
		<?= $joinLink ?>
		<?php fancy_table($evenements, $evenements_col_names, $evenements_primary_key, $evenements_foreign_keys, $evenements_prefix, true, $evenements_col_ommitted); ?>
	</div>
</body>
</html>
