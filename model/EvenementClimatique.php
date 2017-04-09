<?php

require_once('db.php');
require_once('db_utils.php');

/*! \brief Fetches the full table EvenementClimatique.
 *  \param $join If true, will do the jointures. Jointures concerning the table touche are always done.
 *  \return Query result.
 */
function EvenementClimatique_get_all($join=false)
{
	global $db;

	$req = $db->query('SELECT EvenementClimatique.type,' . ($join?' TypeEvenementClimatique.description AS even_desc,':'') . ' ' . formatted_date("EvenementClimatique.date_evenement") .', EvenementClimatique.date_evenement, STRING_AGG(id_parcelle_recolte::text, \',\') AS id_parcelle_recoltes, STRING_AGG(annee_recolte::text, \',\') AS annee_recoltes, STRING_AGG(degats::text, \',\') AS degat_recoltes FROM EvenementClimatique INNER JOIN touche ON evenementclimatique.type = touche.type_evenement AND evenementclimatique.date_evenement = touche.date_evenement' . ($join?' INNER JOIN TypeEvenementClimatique ON EvenementClimatique.type = TypeEvenementClimatique.nom':'') . ' GROUP BY EvenementClimatique.type, EvenementClimatique.date_evenement' . ($join?', TypeEvenementClimatique.description':'') . ' ORDER BY date_evenement');

	return $req->fetchAll(PDO::FETCH_ASSOC);
}


function EvenementClimatique_delete_entry($type, $date)
{
	global $db;

	$req1 = $db->prepare('DELETE FROM Touche WHERE type_evenement = ? AND date_evenement = ?');

	$req1->execute(array($type, $date));

	$req2 = $db->prepare('DELETE FROM EvenementClimatique WHERE type = ? AND date_evenement = ?');

	$req2->execute(array($type, $date));

	$err1 = $req1->errorInfo();
	$err2 = $req2->errorInfo();
	if(!empty($err1[2]) && !empty($err2[2]))
		$err = Array(
			$err1[0] . ', ' . $err2[0],
			$err1[1] . ', ' . $err2[1],
			$err1[2] . "\nAND\n" . $err2[2]);
	else
		$err = $err1;

	return $err;
}

function EvenementClimatique_get_entry($type, $date)
{
	global $db;

	$req = $db->prepare('SELECT type, ' . formatted_date("EvenementClimatique.date_evenement") . ' FROM EvenementClimatique WHERE type = ? AND date_evenement = ?');

	$req->execute(array($type, $date));

	return $req->fetch(PDO::FETCH_ASSOC);
}

function EvenementClimatique_add_entry($type, $date, $touche)
{
	global $db;

	$req1 = $db->prepare('INSERT INTO EvenementClimatique(type, date_evenement) VALUES(?, ' . normalized_date('?') . ')');

	$req1->execute(Array($type, $date));

	if(!empty($req1->errorInfo()[2])) return $req1->errorInfo();

	$reqString = 'INSERT INTO Touche(annee_recolte, id_parcelle_recolte, type_evenement, date_evenement, degats) VALUES';
	
	$first = true;
	$i = 0;
	foreach($touche as &$entry)
	{
		if(!$first) $reqString.= ',';
		$first = false;
		$reqString.= ' (:a' . $i . ', :i' . $i . ', :t, ' . normalized_date(':d') . ', :deg' . $i . ')';
		$i++;
	}

	$req2 = $db->prepare($reqString);

	$req2->bindParam('t', $type);
	$req2->bindParam('d', $date);

	$i = 0;
	foreach($touche as &$entry)
	{
		$req2->bindParam('a' . $i, $entry['annee']);
		$req2->bindParam('i' . $i, $entry['id_parcelle']);
		$req2->bindParam('deg' . $i, $entry['degats']);
		$i++;
	}

	$req2->execute();

	return $req2->errorInfo();
}
