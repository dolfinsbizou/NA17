<?php
require_once("model/auth.php");
require_once("model/Vente.php");
require_once("model/utils.php");

$ventes = Vente_get_all();

foreach($ventes as $key => &$v)
{
	$v['appellation_vin'] = htmlspecialchars($v['appellation_vin']);
	$v['nom_distributeur'] = htmlspecialchars($v['nom_distributeur']);
	$vin = $v['appellation_vin'] . ' ' . $v['annee_vin'];
	$v = array_merge(array_slice($v, 0, 1), array('vin' => $vin), array_slice($v, 1));
}

$ventes_col_names = Array(
	'numero_vente' => 'Numéro de vente',
	'quantite' => 'Quantité',
	'prix_unit' => 'Prix unitaire',
	'prix_total' => 'Prix total',
	'vin' => 'Vin',
	'nom_distributeur' => 'Distributeur'
);

$ventes_col_ommitted = Array('appellation_vin', 'annee_vin');

$ventes_primary_key = Array('numero_vente');

$ventes_foreign_keys = Array('vin' => 'vins.php');

$ventes_prefix = 'vente';

$page_title = "Ventes";
require_once("view/ventes.php");
