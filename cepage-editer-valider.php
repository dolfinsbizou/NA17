<?php
require_once("model/auth.php");
require_once("model/Cepage.php");

if(!isset($_POST))
{
	header('Location: ./cepages.php');
	exit(0);
}
if(empty($_POST['nom'])) 
{
	// The user shouldn't be able to send a form without this field (required or locked attribute). But they can make a custom GET request and send it, bypassing the HTML verification. Never trust user input.
	header('Location: ./cepages.php');
}

if(!isset($_GET['add']))
{
	$errorInfo = Cepage_update_entry($_POST['nom'], $_POST['description']);
}
else
{
	$errorInfo = Cepage_add_entry($_POST['nom'], $_POST['description']);
}

if(!empty($errorInfo[2]))
{
	$driver = $db->getAttribute(PDO::ATTR_DRIVER_NAME);
	$cepage_key = htmlspecialchars($_POST['nom']);
	$page_title = 'Le cépage ' . $cepage_key . ' n\'a pas été ' . (isset($_GET['add'])?'ajouté':'édité');
	require_once("view/edition-erreur.php");
}
else
{
	header('Location: cepages.php');
}
