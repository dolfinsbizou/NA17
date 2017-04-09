<?php
require_once("model/auth.php");
require_once("model/Vin.php");
require_once("model/utils.php");

$vins = Vin_get_all(isset($_GET['join']));

foreach($vins as $key => &$v) 
{
	if(isset($v['robe_desc']))
		$v['robe_desc'] = nl2br(htmlspecialchars($v['robe_desc']));
	$v['appellation'] = htmlspecialchars($v['appellation']);
	$v['robe'] = htmlspecialchars($v['robe']);
	$v['petillant'] = ($v['petillant']?'Oui':'Non');

	$parcelles = explode(',', $v['id_parcelle_recoltes']);
	$annees = explode(',', $v['annee_recoltes']);
	$proportions = explode(',', $v['proportion_recoltes']);
	$vins[$key]['constitution'] = '';
	
	foreach($parcelles as $k => $p)
		$vins[$key]['constitution'].= (empty($vins[$key]['constitution'])?'':', ') . 'N°' . $p . ' en ' . $annees[$k] . ' (' . $proportions[$k]*100 . '%)';
}

$vins_col_names = Array(
	'appellation' => 'Appellation',
	'annee' => 'Année',
	'acidite' => 'Acidité',
	'robe' => 'Robe',
	'robe_desc' => 'Description',
	'petillant' => 'Pétillant',
	'prix_base' => 'Prix',
	'qualite' => 'Note globale (/20)',
	'quantite_dispo' => 'Quantité (litres)',
	'constitution' => 'Constitution'
);

$vins_primary_key = Array('appellation', 'annee');

$vins_foreign_keys = Array('robe' => 'types.php#TypeRobe');

$vins_col_ommitted = Array('annee_recoltes', 'id_parcelle_recoltes', 'proportion_recoltes');

$vins_prefix = "vin";

$joinLink = '<a href="vins.php' . (isset($_GET['join'])?'':'?join') . '"> ' . (isset($_GET['join'])?'Sans':'Avec') . ' jointure' . (isset($_GET['join'])?'':'s') . '</a>';

$page_title = "Vins";
require_once("view/vins.php");
