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
	'date_evenement_f' => 'Date'
);

$evenements_primary_key = Array('type', 'date_evenement_f');

$evenements_foreign_keys = Array('type' => 'types.php#TypeEvenementClimatique');

$evenements_prefix = "evenement-climatique";

$joinLink = '<a href="evenements-climatiques.php' . (isset($_GET['join'])?'':'?join') . '"> ' . (isset($_GET['join'])?'Sans':'Avec') . ' jointure' . (isset($_GET['join'])?'':'s') . '</a>';

$page_title = "Évènements climatiques";
require_once("view/evenements-climatiques.php");
