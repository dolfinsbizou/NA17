<?php

require_once('db.php');

function Recolte_get_all($join=false, $brief=false)
{
	global $db;

	$req = $db->query('SELECT annee, id_parcelle' . ($brief?'':', nom_cepage, mode_culture, mode_taille, qte_produite') . ' FROM Recolte ORDER BY annee, id_parcelle');

	return $req->fetchAll(PDO::FETCH_ASSOC);
}
