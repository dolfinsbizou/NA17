<?php
require_once("model/auth.php");
require_once("model/Distributeur.php");

if(!isset($_POST))
{
	header('Location: ./distributeurs.php');
	exit(0);
}
if(empty($_POST['nom'])) 
{
	header('Location: ./distributeurs.php');
	exit(0);
}

if(!isset($_GET['add']))
{
	$errorInfo = Distributeur_update_entry($_POST['nom'], $_POST['marge']/100, $_POST['type']);
}
else
{
	$errorInfo = Distributeur_add_entry($_POST['nom'], $_POST['marge']/100, $_POST['type']);
}

if(!empty($errorInfo[2]))
{
	$driver = $db->getAttribute(PDO::ATTR_DRIVER_NAME);
	$distributeur_key = htmlspecialchars($_POST['nom']);
	$page_title = 'Le distributeur ' . $distributeur_key . ' n\'a pas été ' . (isset($_GET['add'])?'ajouté':'édité');
	require_once("view/edition-erreur.php");
}
else
{
	header('Location: distributeurs.php');
}
