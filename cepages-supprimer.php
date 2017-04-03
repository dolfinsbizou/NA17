<?php
require_once("model/auth.php");
require_once("model/Cepage.php");

if(!isset($_GET['nom']))
{
	header('Location: ./');
	exit(0);
}

$cepage_key = rawurldecode($_GET['nom']);

$errorInfo = Cepage_delete_entry($cepage_key);

if(!empty($errorInfo[2]))
{
	$driver = $db->getAttribute(PDO::ATTR_DRIVER_NAME);
	$page_title = 'Le cépage' . $cepage_key . ' n\'a pas été supprimé';
	require_once("view/suppression-erreur.php");
}
else
{
	header('Location: cepages.php');
}
