<?php
require_once("model/auth.php");
require_once("model/Vin.php");

if(!isset($_GET['appellation']) || !isset($_GET['annee']))
{
	header('Location: ./');
	exit(0);
}

$vin_appellation = rawurldecode($_GET['appellation']);
$vin_annee = rawurldecode($_GET['annee']);

$errorInfo = Vin_delete_entry($vin_appellation, $vin_annee);

if(!empty($errorInfo[2]))
{
	$driver = $db->getAttribute(PDO::ATTR_DRIVER_NAME);
	$vin_appellation = htmlspecialchars($vin_appellation);
	$vin_annee = htmlspecialchars($vin_annee);
	$page_title = 'Le vin ' . $vin_appellation . ' ' . $vin_annee . ' n\'a pas été supprimé';
	require_once("view/suppression-erreur.php");
}
else
{
	header('Location: vins.php');
}
