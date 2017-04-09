<?php
require_once("model/auth.php");
require_once("model/Distributeur.php");
require_once("model/Type.php");
require_once("model/utils.php");

if(isset($_GET['nom']))
{
	$distributeur_key = rawurldecode($_GET['nom']);

	$distributeur = Distributeur_get_entry($distributeur_key);
	
	if(empty($distributeur))
	{
		header('Location: distributeurs.php');
		exit(0);
	}
	else
	{
		foreach($distributeur as &$field)
			$field = htmlspecialchars($field);
		$distributeur['marge']*=100;

		$page_title = "Édition du distributeur " . $distributeur['nom'];
	}
}
else
{
	$distributeur = null;
	$page_title = "Nouveau distributeur";
}

$types = Type_get_all('TypeDistributeur', true);

if(!is_array($types)) $types = Array();


foreach($types as &$type)
	$type = htmlspecialchars($type);

$fields = Array();
$fields[0] = new FormField("Nom", "Nom du distributeur", "nom", $distributeur['nom'], "text", null, isset($_GET['nom']), true);
$fields[1] = new FormField("Marge", "Pourcentage", "marge", $distributeur['marge'], "text", null, false, true);
$fields[2] = new FormField("Type", "Nature du distributeur", "type", $distributeur['type'], "select", $types);

$target = 'distributeur-editer-valider.php' . ($distributeur?'':'?add');

require_once("view/distributeur-editer.php");
