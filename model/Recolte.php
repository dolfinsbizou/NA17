<?php

require_once('db.php');

function Recolte_get_all($join=false, $brief=false)
{
	global $db;

	$req = $db->query('SELECT annee, id_parcelle' . ($brief?'':', nom_cepage, mode_culture, ' . ($join?'TypeModeCulture.description AS desc_cult, ':'') . 'mode_taille, ' . ($join?'TypeModeTaille.description AS desc_taille, ':'') . 'qte_produite') . ' FROM Recolte' . ($join?' INNER JOIN TypeModeCulture ON Recolte.mode_culture = TypeModeCulture.nom INNER JOIN TypeModeTaille ON Recolte.mode_taille = TypeModeTaille.nom':'') . ' ORDER BY annee, id_parcelle');

	return $req->fetchAll(PDO::FETCH_ASSOC);
}

function Recolte_get_entry($annee, $id)
{
	global $db;

	$req = $db->prepare('SELECT * FROM Recolte WHERE annee = ? AND id_parcelle = ?');
	$req->execute(Array($annee, $id));

	return $req->fetch(PDO::FETCH_ASSOC);
}

function Recolte_add_entry($annee, $id, $cep, $cul, $taille, $qte)
{
	global $db;

	$req = $db->prepare('INSERT INTO Recolte(annee, id_parcelle, nom_cepage, mode_culture, mode_taille, qte_produite) VALUES(:a, :i, :c, :mc, :mt, :q)');

	$req->execute(Array(
		"a" => $annee,
		"i" => $id,
		"c" => $cep,
		"mc" => $cul,
		"mt" => $taille,
		"q" => $qte));

	return $req->errorInfo();
}

function Recolte_update_entry($annee, $id, $cep, $cul, $taille, $qte)
{
	global $db;

	$req = $db->prepare('UPDATE Recolte SET nom_cepage = :c, mode_culture = :mc, mode_taille = :mt, qte_produite = :q WHERE annee = :a AND id_parcelle = :i');

	$req->execute(Array(
		"a" => $annee,
		"i" => $id,
		"c" => $cep,
		"mc" => $cul,
		"mt" => $taille,
		"q" => $qte));

	return $req->errorInfo();
}

function Recolte_delete_entry($annee, $id)
{
	global $db;

	$req = $db->prepare('DELETE FROM Recolte WHERE annee = ? AND id_parcelle = ?');

	$req->execute(array($annee, $id));

	return $req->errorInfo();
}
