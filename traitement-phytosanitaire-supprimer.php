<?php
require_once("model/auth.php");
require_once("model/TraitementPhytosanitaire.php");

if(!isset($_GET['nom']))
{
	header('Location: ./');
	exit(0);
}

$traitement_key = rawurldecode($_GET['nom']);

$errorInfo = TraitementPhytosanitaire_delete_entry($traitement_key);

if(!empty($errorInfo[2]))
{
	$driver = $db->getAttribute(PDO::ATTR_DRIVER_NAME);
	$traitement_key = htmlspecialchars($traitement_key);
	$page_title = 'Le traitement phytosanitaire ' . $traitement_key . ' n\'a pas été supprimé';
	require_once("view/suppression-erreur.php");
}
else
{
	header('Location: traitements-phytosanitaires.php');
}
