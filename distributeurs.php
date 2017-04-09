<?php
require_once("model/auth.php");
require_once("model/Distributeur.php");
require_once("model/utils.php");

$distributeurs = Distributeur_get_all(isset($_GET['join']));

foreach($distributeurs as &$d)
{
	if(isset($d['type_desc']))
		$d['type_desc'] = nl2br(htmlspecialchars($d['type_desc']));
	$d['nom'] = htmlspecialchars($d['nom']);
	$d['type'] = htmlspecialchars($d['type']);
	$d['marge']*=100;
	$d['marge'].='%';
}

$distributeurs_col_names = Array(
	'nom' => 'Nom',
	'marge' => 'Marge',
	'type' => 'Type',
	'type_desc' => 'Description'
);

$distributeurs_primary_key = Array('nom');

$distributeurs_foreign_keys = Array('type' => 'types.php#TypeDistributeur');

$distributeurs_prefix = "distributeur";


$joinLink = '<a href="distributeurs.php' . (isset($_GET['join'])?'':'?join') . '"> ' . (isset($_GET['join'])?'Sans':'Avec') . ' jointure' . (isset($_GET['join'])?'':'s') . '</a>';

$page_title = "Distributeurs";
require_once("view/distributeurs.php");
