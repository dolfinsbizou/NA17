<?php
require_once("model/auth.php");
require_once("model/TraitementPhytosanitaire.php");
require_once("model/utils.php");

$traitements = TraitementPhytosanitaire_get_all();

foreach($traitements as &$t)
{
	$t['description'] = nl2br(htmlspecialchars($t['description']));
	$t['nom'] = htmlspecialchars($t['nom']);
}

$traitements_col_names = Array(
	'nom' => 'Nom',
	'description' => 'Description',
	'applications' => 'Applications (nombre de fois)'
);

foreach($traitements as $key => &$t)
{
	$parcelles = explode(',', $t['id_parcelle_recoltes']);
	$annees = explode(',', $t['annee_recoltes']);
	$qte = explode(',', $t['nb_applications_recoltes']);
	$traitements[$key]['applications'] = '';

	if(!empty($parcelles[0])) foreach($parcelles as $k => $p)
		$traitements[$key]['applications'].= (empty($traitements[$key]['applications'])?'':', ') . 'N°' . $p . ' en ' . $annees[$k] . ' (' . $qte[$k] . ')';

	$traitements[$key]['applications'] = htmlspecialchars($traitements[$key]['applications']);
}

$traitements_primary_key = Array('nom');

$traitements_prefix = "traitement-phytosanitaire";

$traitements_col_ommitted = Array('id_parcelle_recoltes', 'annee_recoltes', 'nb_applications_recoltes');

$page_title = "Traitements Phytosanitaires";
require_once("view/traitements-phytosanitaires.php");
