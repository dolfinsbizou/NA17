<?php

require_once('db.php');
require_once('db_utils.php');

function Vente_get_all()
{
	global $db;

	$req = $db->query('SELECT numero_vente, appellation_vin, annee_vin, ' . formatted_price('prix_unit', 'prix_unit') . ', quantite, ' . formatted_price('prix_total', 'prix_total') . ', nom_distributeur FROM Vente ORDER BY numero_vente');

	return $req->fetchAll(PDO::FETCH_ASSOC);
}

function Vente_add_entry($num, $app, $ann, $qte, $dis)
{
	global $db;

	$req = $db->prepare('INSERT INTO Vente(numero_vente, quantite, prix_unit, prix_total, appellation_vin, annee_vin, nom_distributeur) VALUES(:num, :qte::integer, (SELECT prix_base FROM Vin WHERE appellation = :app AND annee = :ann)*(1+(SELECT marge FROM distributeur WHERE nom = :dis)), ((SELECT prix_base FROM Vin WHERE appellation = :app AND annee = :ann)*((1+(SELECT marge FROM distributeur WHERE nom = :dis)))*(:qte)), :app, :ann, :dis)');

	$req->execute(Array(
		"num" => $num,
		"app" => $app,
		"ann" => $ann,
		"dis" => $dis,
		"qte" => $qte));

	return $req->errorInfo();
}

function Vente_delete_entry($key)
{
	global $db;

	$req = $db->prepare('DELETE FROM Vente WHERE numero_vente = ?');

	$req->execute(Array($key));
}

