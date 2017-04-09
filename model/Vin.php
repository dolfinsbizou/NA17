<?php

require_once('db.php');
require_once('db_utils.php');

function Vin_get_all($join=false, $brief=false)
{
	global $db;
	
	$req = $db->query('SELECT appellation, annee' . ($brief?'':(', acidite, robe,' . ($join?' TypeRobe.description AS robe_desc,':'') . ' petillant, ' . formatted_price('prix_base', 'prix_base') . ', qualite, quantite_dispo')) . ', STRING_AGG(annee::text, \',\') AS annee_recoltes, STRING_AGG(id_parcelle_recolte::text, \',\') AS id_parcelle_recoltes, STRING_AGG(round(proportion, 4)::text, \',\') AS proportion_recoltes, STRING_AGG(id_parcelle_recolte::text, \',\') AS id_parcelle_recoltes FROM Vin' . ($join?' INNER JOIN TypeRobe ON Vin.robe = TypeRobe.nom':'') . ' INNER JOIN Constitue ON Constitue.annee_vin = Vin.annee AND Constitue.appellation_vin = Vin.appellation GROUP BY Vin.appellation, Vin.annee' . ($join?', TypeRobe.description':'') . ' ORDER BY appellation, annee');

	return $req->fetchAll(PDO::FETCH_ASSOC);
}

function Vin_get_entry($appellation, $annee)
{
	global $db;

	$req = $db->prepare('SELECT appellation, annee, acidite, robe, petillant, prix_base::numeric, qualite, quantite_dispo FROM Vin WHERE appellation = ? AND annee = ?');

	$req->execute(array($appellation, $annee));

	return $req->fetch(PDO::FETCH_ASSOC);
}

function Vin_get_constitution($appellation, $annee)
{
	global $db;

	$req = $db->prepare('SELECT * FROM Constitue WHERE appellation_vin = ? AND annee_vin = ?');

	$req->execute(array($appellation, $annee));

	return $req->fetchAll(PDO::FETCH_ASSOC);
}

function Vin_add_entry($appellation, $annee, $acidite, $robe, $petillant, $prix_base, $qualite, $quantite_dispo, $constitue)
{
	global $db;

	$req1 = $db->prepare('INSERT INTO Vin(appellation, annee, acidite, robe, petillant, prix_base, qualite, quantite_dispo) VALUES(?, ?, ?, ?, ?, ?, ?, ?)');

	$req1->execute(Array($appellation, $annee, $acidite, $robe, $petillant?'true':'false', $prix_base, $qualite, $quantite_dispo));

	if(!empty($req1->errorInfo()[2])) return $req1->errorInfo();

	$reqString = 'INSERT INTO Constitue(annee_recolte, id_parcelle_recolte, appellation_vin, annee_vin, proportion) VALUES';
	
	$first = true;
	$i = 0;
	foreach($constitue as &$entry)
	{
		if(!$first) $reqString.= ',';
		$first = false;
		$reqString.= ' (:a' . $i . ', :i' . $i . ', :ap, :an, :p' . $i . ')';
		$i++;
	}

	$req2 = $db->prepare($reqString);

	$req2->bindParam('an', $annee);
	$req2->bindParam('ap', $appellation);

	$i = 0;
	foreach($constitue as &$entry)
	{
		$req2->bindParam('a' . $i, $entry['annee']);
		$req2->bindParam('i' . $i, $entry['id_parcelle']);
		$req2->bindParam('p' . $i, $entry['proportion']);
		$i++;
	}

	$req2->execute();

	return $req2->errorInfo();
}

function Vin_update_entry($appellation, $annee, $acidite, $robe, $petillant, $prix_base, $qualite, $quantite_dispo, $constitue)
{
	global $db;

	$req1 = $db->prepare('UPDATE Vin SET acidite = ?, robe = ?, petillant = ?, prix_base = ?, qualite = ?, quantite_dispo = ? WHERE appellation = ? AND annee = ?');
	$req1->execute(Array($acidite, $robe, $petillant?'true':'false', $prix_base, $qualite, $quantite_dispo, $appellation, $annee));
	
	if(!empty($req1->errorInfo()[2])) return $req1->errorInfo();

	foreach($constitue as &$entry)
	{
		$req = $db->prepare('UPDATE Constitue SET proportion = :p WHERE annee_recolte = :a AND id_parcelle_recolte = :i AND appellation_vin = :ap AND annee_vin = :an');
		$req->execute(Array(
			'p' => $entry['proportion'],
			'a' => $entry['annee'], 
			'i' => $entry['id_parcelle'], 
			'ap' => $appellation,
			'an' => $annee
		));
		if(!empty($req->errorInfo()[2])) return $req->errorInfo();
		$req = $db->prepare('INSERT INTO Constitue(annee_recolte, id_parcelle_recolte, appellation_vin, annee_vin, proportion) SELECT :a, :i, :ap::text, :an, :p WHERE NOT EXISTS (SELECT 1 FROM Constitue WHERE annee_recolte = :a AND id_parcelle_recolte = :i AND appellation_vin = :ap AND annee_vin = :an)');
		$req->execute(Array(
			'p' => $entry['proportion'],
			'a' => $entry['annee'], 
			'i' => $entry['id_parcelle'], 
			'ap' => $appellation,
			'an' => $annee
		));
		if(!empty($req->errorInfo()[2])) return $req->errorInfo();
	}
}

