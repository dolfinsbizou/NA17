<?php
require_once("model/auth.php");
require_once("model/Cepage.php");
require_once("model/utils.php");

$cepages = Cepage_get_all();

foreach($cepages as &$c)
{
	$c['nom'] = htmlspecialchars($c['nom']);
	$c['description'] = nl2br(htmlspecialchars($c['description']));
}

$cepages_col_names = Array(
	'nom' => 'Variété',
	'description' => 'Description'
);

$cepages_primary_key = Array('nom');

$cepages_prefix = "cepages";

$page_title = "Cépages";
require_once("view/cepages.php");
