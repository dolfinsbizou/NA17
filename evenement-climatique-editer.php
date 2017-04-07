<?php
require_once("model/auth.php");
require_once("model/EvenementClimatique.php");
require_once("model/Recolte.php");
require_once("model/Type.php");
require_once("model/utils.php");

if(isset($_GET['type']) && isset($_GET['date_evenement']))
{
	//You can't edit these table's rows
	header('location: evenements-climatiques.php');
	exit(0);
}
else
{
	$evenement = null;

	$recoltes = Recolte_get_all(false, true);
	$recoltes_js = Array();
	foreach($recoltes as &$r)
	{
		$recoltes_js[$r['annee'] . '|' . $r['id_parcelle']] = 'n°' . $r['id_parcelle'] . ' en ' . $r['annee'];
	}

	$page_title = "Nouvel évènement climatique";
}

$evenements = Type_get_all('TypeEvenementClimatique', true);

if(!is_array($evenements)) $evenements = Array();

foreach($evenements as &$e)
	$e = htmlspecialchars($e);

$fields = Array();
$fields[0] = new FormField("Type", "Nature de l'évènement", "type", $evenement['type'], "select", $evenements, isset($_GET['type']), true);
$fields[1] = new FormField("Date", "JJ/MM/YYYY", "date_evenement", $evenement['date_evenement_f'], "text", null, isset($_GET['date_evenement']), true);
$fields[2] = new FormField("Récolte(s) touchée(s)", "", "touche", null, "dynamic_fields", $recoltes_js, false, true);

$target = 'evenement-climatique-editer-valider.php' . ($evenement?'':'?add');

require_once("view/evenement-climatique-editer.php");
