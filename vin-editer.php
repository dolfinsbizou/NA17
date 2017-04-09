<?php
require_once("model/auth.php");
require_once("model/Vin.php");
require_once("model/Recolte.php");
require_once("model/Type.php");
require_once("model/utils.php");

if(isset($_GET['appellation']) && isset($_GET['annee']))
{
	$vin_appellation = rawurldecode($_GET['appellation']);
	$vin_annee = rawurldecode($_GET['annee']);

	$vin = Vin_get_entry($vin_appellation, $vin_annee);

	if(empty($vin))
	{
		header('Location: vins.php');
		exit(0);
	}
	else
	{
		foreach($vin as &$field)
			$field = htmlspecialchars($field);

		$constitution = Vin_get_constitution($vin['appellation'], $vin_annee);
		$constitution_js = Array();
		if(!is_array($constitution)) $constitution = Array();
		foreach($constitution as $key => &$e)
		{
			$constitution_js[$key] = Array();
			foreach($e as &$f)
			{
				$f = htmlspecialchars($f);
			}
			$constitution_js[$key]['dyn_field'] = $e['annee_recolte'] . '|' . $e['id_parcelle_recolte'];
		   	$constitution_js[$key]['constitue_proportion_#'] = $e['proportion']*10000;
		}

		$page_title = "Édition du vin " . $vin['appellation'] . ' ' . $vin['annee'];
	}
}
else
{
	$vin = null;
	
	$constitution_js = null;
	$constitution = Array();
	$page_title = "Nouveau vin";
}

$recoltes = Recolte_get_all(false, true);
$recoltes_js = Array();
foreach($recoltes as &$r)
{
	$recoltes_js[$r['annee'] . '|' . $r['id_parcelle']] = 'n°' . $r['id_parcelle'] . ' en ' . $r['annee'];
}

$robes = Type_get_all('TypeRobe', true);
foreach($robes as &$r)
	$r = htmlspecialchars($r);

$fields = Array();
$fields[0] = new FormField("Appellation", "Nom du vin", "appellation", $vin['appellation'], "text", null, isset($_GET['appellation']), true);
$fields[1] = new FormField("Année", "Année du vin", "annee", $vin['annee'], "text", null, isset($_GET['annee']), true);
$fields[2] = new FormField("Acidité", "Acidité du vin", "acidite", $vin['acidite'], "text", null, false, true);
$fields[3] = new FormField("Robe", "Couleur du vin", "robe", $vin['robe'], "select", $robes, false, true);
$fields[4] = new FormField("Pétillant", "", "petillant", ($vin['petillant']?1:0), "checkbox", null, false, false);
$fields[5] = new FormField("Prix", "Prix au litre", "prix_base", $vin['prix_base'], "text", null, false, true);
$fields[6] = new FormField("Note globale", "sur 20", "qualite", $vin['qualite'], "text", null, false, true);
$fields[7] = new FormField("Quantité", "Quantité disponible", "quantite_dispo", $vin['quantite_dispo'], "text", null, false, true);
$fields[8] = new FormField("Constitution", "", "constitue", $constitution_js, "dynamic_fields", Array($recoltes_js, Array(true, count($constitution)), new FormField("Proportion", "", "constitue_proportion_#", null, "range", null, false, true)), false, true);

$target = 'vin-editer-valider.php' . ($vin?'':'?add');

require_once("view/vin-editer.php");
