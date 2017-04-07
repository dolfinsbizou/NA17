<?php

require_once('db.php');

/*! \brief Fetches the full table Parcelle.
 *  \param $join If true, will do the jointures.
 *  \return Query result.
 */
function Parcelle_get_all($join=false, $brief=false)
{
	global $db;
	
	$req = $db->query('SELECT id' . ($brief?'':(', sol,' . ($join?' TypeSol.description AS sol_desc,':'') . ' exposition, superficie')) . ' FROM Parcelle' . ($join?' INNER JOIN TypeSol ON Parcelle.sol = TypeSol.nom':'') . ' ORDER BY id');

	return $req->fetchAll($brief?(PDO::FETCH_COLUMN):(PDO::FETCH_ASSOC));
}

/*! \brief Deletes an entry.
 *  \param $key Primary key of the entry to delete.
 *  \return Error informations.
 */
function Parcelle_delete_entry($key)
{
	global $db;

	$req = $db->prepare('DELETE FROM Parcelle WHERE id = ?');

	$req->execute(array($key));

	return $req->errorInfo();
}

/*! \brief Retrieves an entry.
 *  \param $key Primary key of the entry to retrieve.
 *  \return Query result.
 */
function Parcelle_get_entry($key)
{
	global $db;

	$req = $db->prepare('SELECT * FROM Parcelle WHERE id = :id');
	
	$req->bindParam('id', $key, PDO::PARAM_INT);
	$req->execute();

	return $req->fetch(PDO::FETCH_ASSOC);
}

function Parcelle_add_entry($id, $sol, $expo, $sup)
{
	global $db;

	$req = $db->prepare('INSERT INTO Parcelle(id, sol, exposition, superficie) VALUES(:id, :sol, :expo, :sup)');

	$req->execute(Array(
		"id" => $id,
		"sol" => $sol,
		"expo" => $expo,
		"sup" => $sup));

	return $req->errorInfo();
}

function Parcelle_update_entry($id, $sol, $expo, $sup)
{
	global $db;

	$req = $db->prepare('UPDATE Parcelle SET sol = :sol, exposition = :expo, superficie = :sup WHERE id = :id');

	$req->execute(Array(
		"id" => $id,
		"sol" => $sol,
		"expo" => $expo,
		"sup" => $sup));

	return $req->errorInfo();
}

