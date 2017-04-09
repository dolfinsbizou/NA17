<!DOCTYPE html>
<html lang="fr">
<?php require_once("include/head.php"); ?>
<body>
	<?php require_once("include/nav.php"); ?>
	<div id="main">
		<h1><?= $page_title ?></h1>
		<?= $joinLink ?>
		<?php fancy_table($vins, $vins_col_names, $vins_primary_key, $vins_foreign_keys, $vins_prefix, true, $vins_col_ommitted); ?>
	</div>
</body>
</html>
