<?php

require_once('db.php');

/*! \brief Fetches the full type table $type.
 *  \param $brief If false, gets only the primary key.
 *  \return Query result
 */
function Type_get_all($type, $brief=false)
{
	global $db;

	$whitelist = Array("TypeSol", "TypeModeTaille", "TypeModeCulture", "TypeEvenementClimatique", "TypeRobe", "TypeDistributeur");

	if(!in_array($type, $whitelist)) $type = $whitelist[0];

	$req = $db->query('SELECT nom' . ($brief?'':', description') . ' FROM ' . $type . ' ORDER BY nom');

	return $req->fetchAll($brief?(PDO::FETCH_COLUMN):(PDO::FETCH_ASSOC));
}
