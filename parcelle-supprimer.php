<?php
require_once("model/auth.php");
require_once("model/Parcelle.php");

if(!isset($_GET['id']))
{
	header('Location: ./');
	exit(0);
}

$parcelle_key = rawurldecode($_GET['id']);

$errorInfo = Parcelle_delete_entry($parcelle_key);

if(!empty($errorInfo[2]))
{
	$driver = $db->getAttribute(PDO::ATTR_DRIVER_NAME);
	$parcelle_key = htmlspecialchars($parcelle_key);
	$page_title = 'La parcelle n°' . $parcelle_key . ' n\'a pas été supprimé';
	require_once("view/suppression-erreur.php");
}
else
{
	header('Location: parcelles.php');
}
