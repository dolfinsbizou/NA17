<!DOCTYPE html>
<html lang="fr">
<?php require_once("include/head.php"); ?>
<body>
	<?php require_once("include/nav.php"); ?>
	<div id="main">
		<h1><?= $page_title ?></h1>
		<?php fancy_table($traitements, $traitements_col_names, $traitements_primary_key, null, $traitements_prefix, true, $traitements_col_ommitted); ?>
	</div>
</body>
</html>
