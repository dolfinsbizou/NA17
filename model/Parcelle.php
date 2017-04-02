<?php

require_once('db.php');

/*! \brief Fetches the full table Parcelle.
 *  \param $join If true, will do the jointures.
 *  \return Query result.
 */
function Parcelle_get_all($join=false)
{
	global $db;
	
	$req = $db->query('SELECT id, sol,' . ($join?' TypeSol.description AS sol_desc,':'') . ' exposition, superficie FROM Parcelle' . ($join?' INNER JOIN TypeSol ON Parcelle.sol = TypeSol.nom':''));

	return $req->fetchAll(PDO::FETCH_ASSOC);
}
