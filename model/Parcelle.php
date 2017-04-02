<?php

require_once('db.php');

/*! \brief Fetches the full table Parcelle.
 *  \return Query result.
 */
function Parcelle_get_all()
{
	global $db;
	$req = $db->query('SELECT * FROM Parcelle');

	return $req->fetchAll(PDO::FETCH_ASSOC);
}
