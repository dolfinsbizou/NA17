<?php

require_once('db.php');
require_once('db_utils.php');

/*! \brief Fetches the full table EvenementClimatique.
 *  \param $join If true, will do the jointures.
 *  \return Query result.
 */
function EvenementClimatique_get_all($join=false)
{
	global $db;
	
	$req = $db->query('SELECT type,' . ($join?' TypeEvenementClimatique.description AS even_desc,':'') . ' ' . formatted_date("date_evenement") .' FROM EvenementClimatique' . ($join?' INNER JOIN TypeEvenementClimatique ON EvenementClimatique.type = TypeEvenementClimatique.nom':'') . ' ORDER BY date_evenement');

	return $req->fetchAll(PDO::FETCH_ASSOC);
}

