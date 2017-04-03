<?php

require_once('db.php');

/*! \brief Counts the number of rows for each table concerning the production.
 *  \return Query result.
 */
function count_prod_rows()
{
	global $db;

	$tables = Array("Cepage", "Parcelle", "Recolte", "Vin");
	$result = Array();
	foreach($tables as $table)
	{
		$req = $db->query('SELECT count(*) AS ' . strtolower($table) . '_count FROM ' . $table);
		$result = array_merge($result, $req->fetch(PDO::FETCH_ASSOC));
	}

	return $result;
}
