<!DOCTYPE html>
<html lang="fr">
<?php require_once("include/head.php"); ?>
<body>
	<?php require_once("include/nav.php"); ?>
	<div id="main">
		<h1><?= $page_title ?></h1>
		<?php fancy_table($cepages, $cepages_col_names, $cepages_primary_key, $cepages_prefix); ?>
	</div>
</body>
</html>
