<?php
require_once("model/auth.php");
require_once("model/Parcelle.php");

if(!isset($_POST))
{
	header('Location: ./parcelles.php');
	exit(0);
}
if(empty($_POST['id'])) 
{
	header('Location: ./parcelles.php');
	exit(0);
}

if(!isset($_GET['add']))
{
	$errorInfo = Parcelle_update_entry($_POST['id'], $_POST['sol'], $_POST['exposition'], $_POST['superficie']);
}
else
{
	$errorInfo = Parcelle_add_entry($_POST['id'], $_POST['sol'], $_POST['exposition'], $_POST['superficie']);
}

if(!empty($errorInfo[2]))
{
	$driver = $db->getAttribute(PDO::ATTR_DRIVER_NAME);
	$parcelle_key = htmlspecialchars($_POST['id']);
	$page_title = 'La parcelle n°' . $parcelle_key . ' n\'a pas été ' . (isset($_GET['add'])?'ajoutée':'éditée');
	require_once("view/edition-erreur.php");
}
else
{
	header('Location: parcelles.php');
}
