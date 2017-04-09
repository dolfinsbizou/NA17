<?php

require_once('db.php');
require_once('db_utils.php');

function Vente_get_all()
{
	global $db;

	$req = $db->query('SELECT numero_vente, appellation_vin, annee_vin, ' . formatted_price('prix_unit', 'prix_unit') . ', quantite, ' . formatted_price('prix_total', 'prix_total') . ', nom_distributeur FROM Vente ORDER BY numero_vente');

	return $req->fetchAll(PDO::FETCH_ASSOC);
}

