<?php
require_once("model/auth.php");
require_once("model/EvenementClimatique.php");

if(!isset($_POST))
{
	header('Location: ./cepages.php');
	exit(0);
}

if(empty($_POST['type']) || empty($_POST['date_evenement']))
{
	header('Location: evenements-climatiques.php');
	exit(0);
}

if(!isset($_GET['add']))
{
	header('Location: evenements-climatiques.php');
	exit(0);
}
else
{
	$i = 0;
	$touche = Array();
	while(isset($_POST['touche_' . $i]))
	{
		$touche[$i] = Array();
		$touche_key = explode('|', $_POST['touche_' . $i]);
		$touche[$i]['annee'] = $touche_key[0];
		$touche[$i]['id_parcelle'] = $touche_key[1];
		$touche[$i]['degats'] = $_POST['touche_degats_' . $i];
		$i++;
	}

	$errorInfo = EvenementClimatique_add_entry($_POST['type'], $_POST['date_evenement'], $touche);
}

if(!empty($errorInfo[2]))
{
	$driver = $db->getAttribute(PDO::ATTR_DRIVER_NAME);
	$page_title = 'L\'évènement climatique ' . htmlspecialchars($_POST['type']) . ' du ' . htmlspecialchars($_POST['date_evenement']) . ' n\'a pas été ' . (isset($_GET['add'])?'ajouté':'édité');
	require_once("view/edition-erreur.php");
}
else
{
	header('Location: evenements-climatiques.php');
}
