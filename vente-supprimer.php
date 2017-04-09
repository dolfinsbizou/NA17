<?php
require_once("model/auth.php");
require_once("model/Vente.php");

if(!isset($_GET['numero_vente']))
{
	header('Location: ./');
	exit(0);
}

$vente_key = rawurldecode($_GET['numero_vente']);

$errorInfo = Vente_delete_entry($vente_key);

if(!empty($errorInfo[2]))
{
	$driver = $db->getAttribute(PDO::ATTR_DRIVER_NAME);
	$vente_key = htmlspecialchars($vente_key);
	$page_title = 'La vente n°' . $vente_key . ' n\'a pas été supprimée';
	require_once("view/suppression-erreur.php");
}
else
{
	header('Location: ventes.php');
}
