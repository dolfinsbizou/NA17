<?php
require_once("model/auth.php");
require_once("model/Parcelle.php");
require_once("model/Vin.php");
require_once("model/Distributeur.php");
require_once("model/utils.php");

if(isset($_GET['numero_vente']))
{
	//You can't edit these table's rows
	header('location: evenements-climatiques.php');
	exit(0);
}
else
{
	$vente = null;
	$page_title = "Nouvelle vente";
}

$vins = Vin_get_all(false, true);

$vins_f = array();
foreach($vins as &$vin)
{
	$vin['appellation'] = htmlspecialchars($vin['appellation']);
	$vins_f[$vin['appellation'] . '|' . $vin['annee']] = $vin['appellation'] . ' ' . $vin['annee'];
}

$distributeurs = Distributeur_get_all(false, true);

foreach($distributeurs as &$d)
	$d = htmlspecialchars($d);

$fields = Array();
$fields[0] = new FormField("Numéro de vente", "Numéro unique", "numero_vente", $vente['numéro_vente'], "text", null, isset($_GET['numéro_vente']), true);
$fields[1] = new FormField("Vin", "", "vin", $vente['vin'], "select", $vins_f);
$fields[2] = new FormField("Quantité", "En litres", "quantite", $vente['quantite']);
$fields[3] = new FormField("Distributeur", "", "nom_distributeur", $vente['nom_distributeur'], "select", $distributeurs);

$target = 'vente-editer-valider.php' . ($vente?'':'?add');

require_once("view/vente-editer.php");
