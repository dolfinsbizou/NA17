<?php

require_once('db.php');

function Distributeur_get_all($join=false, $brief=false)
{
	global $db;
	$req = $db->query('SELECT Distributeur.nom' . ($brief?'':(', marge, type' . ($join?', TypeDistributeur.description AS type_desc':''))) . ' FROM Distributeur' . ($join?' INNER JOIN TypeDistributeur ON type = TypeDistributeur.nom':'') . ' ORDER BY Distributeur.nom');

	return $req->fetchAll($brief?(PDO::FETCH_COLUMN):(PDO::FETCH_ASSOC));
}

function Distributeur_get_entry($nom)
{
	global $db;
	
	$req = $db->prepare('SELECT * FROM Distributeur WHERE nom = :nom');

	$req->execute(Array($nom));

	return $req->fetch(PDO::FETCH_ASSOC);
}

function Distributeur_add_entry($nom, $marge, $type)
{
	global $db;

	$req = $db->prepare('INSERT INTO Distributeur(nom, marge, type) VALUES(:nom, :marge, :type)');

	$req->execute(Array(
		"nom" => $nom,
		"marge" => $marge,
		"type" => $type));

	return $req->errorInfo();
}

function Distributeur_update_entry($nom, $marge, $type)
{
	global $db;

	$req = $db->prepare('UPDATE Distributeur SET marge = :marge, type = :type WHERE nom = :nom');

	$req->execute(Array(
		"nom" => $nom,
		"marge" => $marge,
		"type" => $type));

	return $req->errorInfo();
}

function Distributeur_delete_entry($key)
{
	global $db;

	$req = $db->prepare('DELETE FROM Distributeur WHERE nom = ?');

	$req->execute(array($key));

	return $req->errorInfo();
}

