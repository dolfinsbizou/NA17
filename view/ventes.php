<!DOCTYPE html>
<html lang="fr">
<?php require_once("include/head.php"); ?>
<body>
	<?php require_once("include/nav.php"); ?>
	<div id="main">
		<h1><?= $page_title ?></h1>
		<?php fancy_table($ventes, $ventes_col_names, $ventes_primary_key, $ventes_foreign_keys, $ventes_prefix, 2, $ventes_col_ommitted); ?>
	</div>
</body>
</html>
