<?php

require_once('db.php');

/*! \brief Fetches the full table TypeSol.
 *  \param $brief If false, gets only the primary key.
 *  \return Query result
 */
function TypeSol_get_all($brief=false)
{
	global $db;

	$req = $db->query('SELECT nom' . ($brief?'':', description') . ' FROM TypeSol ORDER BY nom');

	return $req->fetchAll($brief?(PDO::FETCH_COLUMN):(PDO::FETCH_ASSOC));
}
