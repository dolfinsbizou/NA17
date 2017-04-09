<?php
require_once("model/auth.php");
require_once("model/TraitementPhytosanitaire.php");
require_once("model/Recolte.php");
require_once("model/utils.php");

if(isset($_GET['nom']))
{
	$traitement_key = rawurldecode($_GET['nom']);

	$traitement = TraitementPhytosanitaire_get_entry($traitement_key);

	if(empty($traitement))
	{
		header('Location: traitements.php');
		exit(0);
	}
	else
	{
		foreach($traitement as &$field)
			$field = htmlspecialchars($field);

		$applications = TraitementPhytosanitaire_get_applications($traitement['nom']);
		$applications_js = Array();
		if(!is_array($applications)) $applications = Array();
		foreach($applications as $key => &$e)
		{
			$applications_js[$key] = Array();
			foreach($e as &$f)
			{
				$f = htmlspecialchars($f);
			}
			$applications_js[$key]['dyn_field'] = $e['annee_recolte'] . '|' . $e['id_parcelle_recolte'];
		   	$applications_js[$key]['applique_a_nb_applications_#'] = $e['nb_applications'];
		}

		$page_title = "Édition du traitement phytosanitaire " . $traitement['nom'];
	}
}
else
{
	$traitement = null;
	
	$applications_js = null;
	$applications = Array();
	$page_title = "Nouveau traitement phytosanitaire";
}

$recoltes = Recolte_get_all(false, true);
$recoltes_js = Array();
foreach($recoltes as &$r)
{
	$recoltes_js[$r['annee'] . '|' . $r['id_parcelle']] = 'n°' . $r['id_parcelle'] . ' en ' . $r['annee'];
}

$fields = Array();
$fields[0] = new FormField("Nom", "Nom du produit", "nom", $traitement['nom'], "text", null, isset($_GET['nom']), true);
$fields[1] = new FormField("Description", "Caractéristiques du produit", "description", $traitement['description'], "textarea", null, false, true);
$fields[2] = new FormField("Application(s)", "", "applique_a", $applications_js, "dynamic_fields", Array($recoltes_js, Array(false, count($applications)), new FormField("Applications", "Nombre d\'applications", "applique_a_nb_applications_#", null, "text", null, false, true)), false, true);

$target = 'traitement-phytosanitaire-editer-valider.php' . ($traitement?'':'?add');

require_once("view/traitement-phytosanitaire-editer.php");
