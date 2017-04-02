<?php
require_once("model/auth.php");
require_once("model/Parcelle.php");
require_once("model/utils.php");

$parcelles = Parcelle_get_all();

foreach($parcelles as &$p) // Même si pour nos données de test c'est inutile, penser quand même à le faire
{
	$p['sol'] = htmlspecialchars($p['sol']);
}

$parcelles_col_names = Array('id' => 'Numéro',
							 'sol' => 'Type de sol',
							 'exposition' => 'Exposition',
							 'superficie' => 'Superficie');

$page_title = "Accueil";
require_once("view/index.php");
