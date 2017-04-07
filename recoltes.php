<?php
require_once("model/auth.php");
require_once("model/Recolte.php");
require_once("model/utils.php");

$recoltes = Recolte_get_all(isset($_GET['join']));

foreach($recoltes as &$r) 
{
	foreach($r as &$e)
		$e = htmlspecialchars($e);
	foreach(Array('desc_cult', 'desc_taille') as $e)
		if(isset($r[$e])) nl2br($r[$e]);
}

$recoltes_col_names = Array(
	'annee' => 'Année',
	'id_parcelle' => 'Numéro de parcelle',
	'nom_cepage' => 'Cépage utilisé',
	'mode_culture' => 'Mode de culture',
	'desc_cult' => 'Description du mode de culture',
	'mode_taille' => 'Mode de taille',
	'desc_taille' => 'Description du mode de taille',
	'qte_produite' => 'Quantité produite (litres)'
);

$recoltes_primary_key = Array('annee', 'id_parcelle');

$recoltes_foreign_keys = Array(
	'id_parcelle' => 'parcelles.php',
	'nom_cepage' => 'cepages.php',
	'mode_culture' => 'types.php#TypeModeCulture',
	'mode_taille' => 'types.php#TypeModeTaille'
);

$recoltes_prefix = "recolte";

$joinLink = '<a href="recoltes.php' . (isset($_GET['join'])?'':'?join') . '"> ' . (isset($_GET['join'])?'Sans':'Avec') . ' jointure' . (isset($_GET['join'])?'':'s') . '</a>';

$page_title = "Récoltes";
require_once("view/recoltes.php");
