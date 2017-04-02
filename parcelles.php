<?php
require_once("model/auth.php");
require_once("model/Parcelle.php");
require_once("model/utils.php");

$parcelles = Parcelle_get_all(isset($_GET['join']));

foreach($parcelles as &$p) // Même si pour nos données de test c'est inutile, penser quand même à le faire
{
	$p['sol'] = htmlspecialchars($p['sol']);
}

$parcelles_col_names = Array('id' => 'Numéro',
							 'sol' => 'Type de sol',
							 'sol_desc' => 'Description',
							 'exposition' => 'Exposition',
							 'superficie' => 'Superficie');

$joinLink = '<a href="parcelles.php' . (isset($_GET['join'])?'':'?join') . '"> ' . (isset($_GET['join'])?'Sans':'Avec') . ' jointure' . (isset($_GET['join'])?'':'s') . '</a>';

$page_title = "Parcelles";
require_once("view/parcelles.php");
