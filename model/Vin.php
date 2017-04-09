<?php

require_once('db.php');
require_once('db_utils.php');

function Vin_get_all($join=false, $brief=false)
{
	global $db;
	
	$req = $db->query('SELECT appellation, annee' . ($brief?'':(', acidite, robe,' . ($join?' TypeRobe.description AS robe_desc,':'') . ' petillant, ' . formatted_price('prix_base', 'prix_base') . ', qualite, quantite_dispo')) . ', STRING_AGG(annee::text, \',\') AS annee_recoltes, STRING_AGG(id_parcelle_recolte::text, \',\') AS id_parcelle_recoltes, STRING_AGG(proportion::text, \',\') AS proportion_recoltes, STRING_AGG(id_parcelle_recolte::text, \',\') AS id_parcelle_recoltes FROM Vin' . ($join?' INNER JOIN TypeRobe ON Vin.robe = TypeRobe.nom':'') . ' INNER JOIN Constitue ON Constitue.annee_vin = Vin.annee AND Constitue.appellation_vin = Vin.appellation GROUP BY Vin.appellation, Vin.annee' . ($join?', TypeRobe.description':'') . ' ORDER BY appellation, annee');

	return $req->fetchAll(PDO::FETCH_ASSOC);
}
