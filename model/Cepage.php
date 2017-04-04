<?php

require_once('db.php');

/*! \brief Fetches the full table Cepage.
 *  \return Query result.
 */
function Cepage_get_all()
{
	global $db;

	$req = $db->query('SELECT * FROM Cepage');

	return $req->fetchAll(PDO::FETCH_ASSOC);
}

/*! \brief Deletes an entry.
 *  \param $key Primary key of the entry to delete.
 *  \return Error informations.
 */
function Cepage_delete_entry($key)
{
	global $db;

	$req = $db->prepare('DELETE FROM Cepage WHERE nom = ?');

	$req->execute(array($key));

	return $req->errorInfo();
}

/*! \brief Retrieves an entry.
 *  \param $key Primary key of the entry to retrieve.
 *  \return Query result.
 */
function Cepage_get_entry($key)
{
	global $db;

	$req = $db->prepare('SELECT * FROM Cepage WHERE nom = ? ORDER BY nom');

	$req->execute(array($key));

	return $req->fetch(PDO::FETCH_ASSOC);
}

/*! \brief Adds an entry.
 *  \param $nom Name (primary key).
 *  \param $desc Description.
 *  \return Error informations.
 */
function Cepage_add_entry($nom, $desc)
{
	global $db;

	$req = $db->prepare('INSERT INTO Cepage(nom, description) VALUES(:nom, :desc)');

	$req->execute(Array(
		"nom" => $nom,
		"desc" => $desc));

	return $req->errorInfo();
}

/*! \brief Updates an entry.
 *  \param $nom Name (primary key).
 *  \param $desc Description.
 *  \return Error informations.
 */
function Cepage_update_entry($nom, $desc)
{
	global $db;

	$req = $db->prepare('UPDATE Cepage SET description = :desc WHERE nom = :nom');

	$req->execute(Array(
		"nom" => $nom,
		"desc" => $desc));

	return $req->errorInfo();
}
