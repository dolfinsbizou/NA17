<?php
require_once("model/auth.php");
require_once("model/Type.php");
require_once("model/utils.php");

$list_types = Array("TypeSol", "TypeModeTaille", "TypeModeCulture", "TypeEvenementClimatique", "TypeRobe", "TypeDistributeur");
$types = Array();

foreach($list_types as $type)
{
	$types[$type] = Type_get_all($type);
	foreach($types[$type] as &$res)
	{
		$res['nom'] = htmlspecialchars($res['nom']);
		$res['description'] = htmlspecialchars($res['description']);
	}
}

$types_col_names = Array(
	'nom' => 'Nom',
	'description' => 'Description'
);

$types_fancy_names = Array(
	"TypeSol" => "Type de sol",
	"TypeModeTaille" => "Type de mode de taille",
	"TypeModeCulture" => "Type de mode de culture",
	"TypeEvenementClimatique" => "Type d'évènement climatique",
	"TypeRobe" => "Type de robe",
	"TypeDistributeur" => "Type de distributeur"
);

$types_primary_key = Array('nom');

$page_title = "Types";
require_once("view/types.php");
