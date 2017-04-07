<?php
require_once("model/auth.php");
require_once("model/EvenementClimatique.php");

if(!isset($_GET['type']) || !isset($_GET['date_evenement']))
{
	header('Location: ./');
	exit(0);
}

$evenement_key_type = rawurldecode($_GET['type']);
$evenement_key_date = rawurldecode($_GET['date_evenement']);

$errorInfo = EvenementClimatique_delete_entry($evenement_key_type, $evenement_key_date);

if(!empty($errorInfo[2]))
{
	$driver = $db->getAttribute(PDO::ATTR_DRIVER_NAME);
	$evenement_key_type = htmlspecialchars($evenement_key_type);
	$page_title = 'L\'évènement climatique ' . $evenement_key_type . ' du ' . $evenement_key_date . ' n\'a pas été supprimé';
	require_once("view/suppression-erreur.php");
}
else
{
	header('Location: evenements-climatiques.php');
}
