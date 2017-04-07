<?php
require_once("model/auth.php");
require_once("model/Recolte.php");
require_once("model/Parcelle.php");
require_once("model/Cepage.php");
require_once("model/Type.php");
require_once("model/utils.php");

if(isset($_GET['annee']) && isset($_GET['id_parcelle']))
{
	$recolte_annee = rawurldecode($_GET['annee']);
	$recolte_id_parcelle = rawurldecode($_GET['id_parcelle']);

	$recolte = Recolte_get_entry($recolte_annee, $recolte_id_parcelle);
	
	if(empty($recolte))
	{
		header('Location: recoltes.php');
		exit(0);
	}
	else
	{
		foreach($recolte as &$field)
			$field = htmlspecialchars($field);

		$page_title = "Édition de la récolte de la parcelle n°" . $recolte['id_parcelle'] . " de " . $recolte['annee'];
	}
}
else
{
	$recolte = null;
	$page_title = "Nouvelle récolte";
}

$parcelles = Parcelle_get_all(false, true);
$cepages = Cepage_get_all(true);
$modes_culture = Type_get_all('TypeModeCulture', true);
$modes_taille = Type_get_all('TypeModeTaille', true);

if(!is_array($parcelles)) $parcelles = Array();
if(!is_array($cepages)) $cepages = Array();
if(!is_array($modes_culture)) $modes_culture = Array();
if(!is_array($modes_taille)) $modes_taille = Array();

foreach($parcelles as &$e) $e = htmlspecialchars($e);
foreach($cepages as &$e) $e = htmlspecialchars($e);
foreach($modes_culture as &$e) $e = htmlspecialchars($e);
foreach($modes_taille as &$e) $e = htmlspecialchars($e);

$fields = Array();
$fields[0] = new FormField("Annee", "Année de récolte", "annee", $recolte['annee'], "text", null, isset($_GET['annee']), true);
$fields[1] = new FormField("Numéro de parcelle", "", "id_parcelle", $recolte['id_parcelle'], "select", $parcelles, isset($_GET['id_parcelle']), true);
$fields[2] = new FormField("Cépage", "", "nom_cepage", $recolte['nom_cepage'], "select", $cepages);
$fields[3] = new FormField("Mode de culture", "", "mode_culture", $recolte['mode_culture'], "select", $modes_culture);
$fields[4] = new FormField("Mode de taille", "", "mode_taille", $recolte['mode_taille'], "select", $modes_taille);
$fields[5] = new FormField("Quantité produite", "En litres", "qte_produite", $recolte['qte_produite'], "text", null, false, true);

$target = 'recolte-editer-valider.php' . ($recolte?'':'?add');

require_once("view/recolte-editer.php");
