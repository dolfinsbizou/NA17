<?php
require_once("model/auth.php");
require_once("model/Distributeur.php");

if(!isset($_GET['nom']))
{
	header('Location: ./');
	exit(0);
}

$distributeur_key = rawurldecode($_GET['nom']);

$errorInfo = Distributeur_delete_entry($distributeur_key);

if(!empty($errorInfo[2]))
{
	$driver = $db->getAttribute(PDO::ATTR_DRIVER_NAME);
	$distributeur_key = htmlspecialchars($distributeur_key);
	$page_title = 'Le distributeur ' . $distributeur_key . ' n\'a pas été supprimé';
	require_once("view/suppression-erreur.php");
}
else
{
	header('Location: distributeurs.php');
}
