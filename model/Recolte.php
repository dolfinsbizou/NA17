<?php

require_once('db.php');

function Recolte_get_all($join=false, $brief=false)
{
	global $db;

	$req = $db->query('SELECT annee, id_parcelle' . ($brief?'':', nom_cepage, mode_culture, ' . ($join?'TypeModeCulture.description AS desc_cult, ':'') . 'mode_taille, ' . ($join?'TypeModeTaille.description AS desc_taille, ':'') . 'qte_produite') . ' FROM Recolte' . ($join?' INNER JOIN TypeModeCulture ON Recolte.mode_culture = TypeModeCulture.nom INNER JOIN TypeModeTaille ON Recolte.mode_taille = TypeModeTaille.nom':'') . ' ORDER BY annee, id_parcelle');

	return $req->fetchAll(PDO::FETCH_ASSOC);
}
