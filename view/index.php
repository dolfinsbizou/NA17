<!DOCTYPE html>
<html lang="fr">
<?php require_once("include/head.php"); ?>
<body>
	<?php require_once("include/nav.php"); ?>
	<div id="main">
		<h1>Démo</h1>
		<p>Ceci est un exercice. </p>
		<?php display_results($parcelles, $parcelles_col_names, Array("exposition")); ?>
	</div>
</body>
</html>
