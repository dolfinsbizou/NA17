<!DOCTYPE html>
<html lang="fr">
<?php require_once("include/head.php"); ?>
<body>
	<?php require_once("include/nav.php"); ?>
	<div id="main">
		<h1><?= $page_title ?></h1>
		<p>La suppression n'a pas pu être effectuée !<br />
		Code SQLSTATE : <?= $errorInfo[0] ?><br />
		Code d'erreur <?= $driver ?> : <?= $errorInfo[1] ?><br />
		Détail de l'erreur :</p>
		<pre><?= $errorInfo[2] ?></pre>
	</div>
</body>
</html>
