<?php
require_once("model/auth.php");
require_once("model/Vin.php");

if(!isset($_POST))
{
	header('Location: ./vins.php');
	exit(0);
}

if(empty($_POST['appellation']) || empty($_POST['annee']))
{
	header('Location: ./vins.php');
	exit(0);
}

$i = 0;
$sumProp = 0;
$constitue = Array();
while(isset($_POST['constitue_' . $i]))
{
	$constitue[$i] = Array();
	$constitue_key = explode('|', $_POST['constitue_' . $i]);
	$constitue[$i]['annee'] = $constitue_key[0];
	$constitue[$i]['id_parcelle'] = $constitue_key[1];
	$constitue[$i]['proportion'] = $_POST['constitue_proportion_' . $i];
	$sumProp+=$constitue[$i]['proportion'];
	$i++;
}

foreach($constitue as &$c)
	$c['proportion'] = ($sumProp == 0)?(1/$i):($c['proportion']/$sumProp);

$petillant = isset($_POST['petillant']);

if(!isset($_GET['add']))
{
	$errorInfo = Vin_update_entry($_POST['appellation'], $_POST['annee'], $_POST['acidite'], $_POST['robe'], $petillant, $_POST['prix_base'], $_POST['qualite'], $_POST['quantite_dispo'], $constitue);
}
else
{
	$errorInfo = Vin_add_entry($_POST['appellation'], $_POST['annee'], $_POST['acidite'], $_POST['robe'], $petillant, $_POST['prix_base'], $_POST['qualite'], $_POST['quantite_dispo'], $constitue);
}

if(!empty($errorInfo[2]))
{
	$driver = $db->getAttribute(PDO::ATTR_DRIVER_NAME);
	$page_title = 'Le vin ' . htmlspecialchars($_POST['appellation']) . ' ' . htmlspecialchars($_POST['annee']) . ' n\'a pas été ' . (isset($_GET['add'])?'ajouté':'édité');
	require_once("view/edition-erreur.php");
}
else
{
	header('Location: vins.php');
}
