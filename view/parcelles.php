<!DOCTYPE html>
<html lang="fr">
<?php require_once("include/head.php"); ?>
<body>
	<?php require_once("include/nav.php"); ?>
	<div id="main">
		<h1>Parcelles</h1>
		<?= $joinLink ?>
		<?php display_results($parcelles, $parcelles_col_names); ?>
	</div>
</body>
</html>
