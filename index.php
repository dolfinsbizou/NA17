<?php
require_once("model/auth.php");
require_once("model/stats.php");
require_once("model/utils.php");

$stats = count_prod_rows();

$stats_col_names = Array(
	'cepage_count' => 'Cépages',
	'parcelle_count' => 'Parcelles',
	'recolte_count' => 'Récoltes',
	'vin_count' => 'Vins'
);

$page_title = "Accueil";
require_once("view/index.php");
