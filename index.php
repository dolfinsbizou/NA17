<?php
require_once("model/auth.php");
require_once("model/Parcelle.php");

$parcelles = Parcelle_get_all();

foreach($parcelles as &$p) // Même si pour nos données de test c'est inutile, penser quand même à le faire
{
	$p['sol'] = htmlspecialchars($p['sol']);
}

$page_title = "Accueil";
require_once("view/index.php");
