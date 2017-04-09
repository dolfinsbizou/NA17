<?php
require_once("model/auth.php");
require_once("model/Vente.php");

if(!isset($_POST))
{
	header('Location: ./ventes.php');
	exit(0);
}
if(empty($_POST['numero_vente'])) 
{
	header('Location: ./ventes.php');
	exit(0);
}

if(!isset($_GET['add']))
{
	header('Location: ./ventes.php');
	exit(0);
}
else
{
	$vin = explode('|', $_POST['vin']);

	$errorInfo = Vente_add_entry($_POST['numero_vente'], $vin[0], $vin[1], $_POST['quantite'], $_POST['nom_distributeur']);
}

if(!empty($errorInfo[2]))
{
	$driver = $db->getAttribute(PDO::ATTR_DRIVER_NAME);
	$vente_key = htmlspecialchars($_POST['numero_vente']);
	$page_title = 'La vente n°' . $vente_key . ' n\'a pas été ' . (isset($_GET['add'])?'ajoutée':'éditée');
	require_once("view/edition-erreur.php");
}
else
{
	header('Location: ventes.php');
}
