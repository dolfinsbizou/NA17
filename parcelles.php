<?php
require_once("model/auth.php");
require_once("model/Parcelle.php");
require_once("model/utils.php");

$parcelles = Parcelle_get_all(isset($_GET['join']));

foreach($parcelles as &$p) 
{
	if(isset($p['sol_desc']))
		$p['sol_desc'] = nl2br(htmlspecialchars($p['sol_desc']));
	$p['sol'] = htmlspecialchars($p['sol']);
}

$parcelles_col_names = Array(
	'id' => 'Numéro',
	'sol' => 'Type de sol',
	'sol_desc' => 'Description',
	'exposition' => 'Exposition',
	'superficie' => 'Superficie'
);

$parcelles_primary_key = Array('id');

$parcelles_foreign_keys = Array('sol' => 'types.php#TypeSol');

$parcelles_prefix = "parcelle";

$joinLink = '<a href="parcelles.php' . (isset($_GET['join'])?'':'?join') . '"> ' . (isset($_GET['join'])?'Sans':'Avec') . ' jointure' . (isset($_GET['join'])?'':'s') . '</a>';

$page_title = "Parcelles";
require_once("view/parcelles.php");
