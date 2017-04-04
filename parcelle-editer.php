<?php
require_once("model/auth.php");
require_once("model/Parcelle.php");
require_once("model/Type.php");
require_once("model/utils.php");

if(isset($_GET['id']))
{
	$parcelle_key = rawurldecode($_GET['id']);

	$parcelle = Parcelle_get_entry($parcelle_key);
	
	if(empty($parcelle))
	{
		header('Location: parcelles.php');
		exit(0);
	}
	else
	{
		foreach($parcelle as &$field)
			$field = htmlspecialchars($field);

		$page_title = "Édition de la parcelle n°" . $parcelle['id'];
	}
}
else
{
	$parcelle = null;
	$page_title = "Nouvelle parcelle";
}

$sols = Type_get_all('TypeSol', true);

if(!is_array($sols)) $sols = Array();


foreach($sols as &$sol)
	$sol = htmlspecialchars($sol);

$fields = Array();
$fields[0] = new FormField("Id", "Numéro de cadastre", "id", $parcelle['id'], "text", null, isset($_GET['id']), true);
$fields[1] = new FormField("Sol", "Type de sol", "sol", $parcelle['sol'], "select", $sols);
$fields[2] = new FormField("Exposition", "faible (0), moyen (1), forte (2)", "exposition", $parcelle['exposition']);
$fields[3] = new FormField("Superficie", "en m²", "superficie", $parcelle['superficie']);

$target = 'parcelle-editer-valider.php' . ($parcelle?'':'?add');

require_once("view/parcelle-editer.php");
