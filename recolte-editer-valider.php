<?php
require_once("model/auth.php");
require_once("model/Recolte.php");

if(!isset($_POST))
{
	header('Location: ./recoltes.php');
	exit(0);
}
if(empty($_POST['annee']) && empty($_POST['id_parcelle'])) 
{
	header('Location: ./recoltes.php');
	exit(0);
}

if(!isset($_GET['add']))
{
	$errorInfo = Recolte_update_entry($_POST['annee'], $_POST['id_parcelle'], $_POST['nom_cepage'], $_POST['mode_culture'], $_POST['mode_taille'], $_POST['qte_produite']);
}
else
{
	$errorInfo = Recolte_add_entry($_POST['annee'], $_POST['id_parcelle'], $_POST['nom_cepage'], $_POST['mode_culture'], $_POST['mode_taille'], $_POST['qte_produite']);
}

if(!empty($errorInfo[2]))
{
	$driver = $db->getAttribute(PDO::ATTR_DRIVER_NAME);
	$page_title = 'La récolte de la parcelle n°' . htmlspecialchars($_POST['id_parcelle']) . ' en ' . htmlspecialchars($_POST['annee']) . 'n\'a pas été ' . (isset($_GET['add'])?'ajoutée':'éditée');
	require_once("view/edition-erreur.php");
}
else
{
	header('Location: recoltes.php');
}
