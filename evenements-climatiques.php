<?php
require_once("model/auth.php");
require_once("model/EvenementClimatique.php");
require_once("model/utils.php");

$evenements = EvenementClimatique_get_all(isset($_GET['join']));

foreach($evenements as &$e)
{
	if(isset($e['even_desc']))
		$e['even_desc'] = nl2br(htmlspecialchars($e['even_desc']));
	$e['type'] = htmlspecialchars($e['type']);
}

$evenements_col_names = Array(
	'type' => 'Type',
	'even_desc' => 'Description',
	'date_evenement_f' => 'Date',
	'recoltes_touchees' => 'Récoltes touchées (dégats/10)'
);

foreach($evenements as $key => &$e)
{
	$parcelles = explode(',', $e['id_parcelle_recoltes']);
	$annees = explode(',', $e['annee_recoltes']);
	$degats = explode(',', $e['degat_recoltes']);
	$evenements[$key]['recoltes_touchees'] = '';

	foreach($parcelles as $k => $p)
		$evenements[$key]['recoltes_touchees'].= (empty($evenements[$key]['recoltes_touchees'])?'':', ') . 'N°' . $p . ' en ' . $annees[$k] . ' (' . $degats[$k] . ')';

	$evenements[$key]['recoltes_touchees'] = htmlspecialchars($evenements[$key]['recoltes_touchees']);
}

$evenements_primary_key = Array('type', 'date_evenement', 'dummy' => 'date_evenement_f');

$evenements_foreign_keys = Array('type' => 'types.php#TypeEvenementClimatique');

$evenements_prefix = "evenement-climatique";

$evenements_col_ommitted = Array('date_evenement', 'id_parcelle_recoltes', 'annee_recoltes', 'degat_recoltes');

$joinLink = '<a href="evenements-climatiques.php' . (isset($_GET['join'])?'':'?join') . '"> ' . (isset($_GET['join'])?'Sans':'Avec') . ' jointure' . (isset($_GET['join'])?'':'s') . '</a>';

$page_title = "Évènements climatiques";
require_once("view/evenements-climatiques.php");
