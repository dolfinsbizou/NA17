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

	return $db->errorInfo();
}
