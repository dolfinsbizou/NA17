<?php

require_once('db.php');

function TraitementPhytosanitaire_get_all()
{
	global $db;

	$req = $db->query('SELECT nom, description, STRING_AGG(id_parcelle_recolte::text, \',\') AS id_parcelle_recoltes, STRING_AGG(annee_recolte::text, \',\') AS annee_recoltes, STRING_AGG(nb_applications::text, \',\') AS nb_applications_recoltes FROM TraitementPhytosanitaire LEFT JOIN AppliqueA ON TraitementPhytosanitaire.nom = AppliqueA.nom_traitement_phytosanitaire GROUP BY TraitementPhytosanitaire.nom ORDER BY nom');

	return $req->fetchAll(PDO::FETCH_ASSOC);
}

function TraitementPhytosanitaire_get_entry($nom)
{
	global $db;

	$req = $db->prepare('SELECT * FROM TraitementPhytosanitaire WHERE nom = ?');

	$req->execute(array($nom));

	return $req->fetch(PDO::FETCH_ASSOC);
}

function TraitementPhytosanitaire_get_applications($nom)
{
	global $db;

	$req = $db->prepare('SELECT * FROM AppliqueA WHERE nom_traitement_phytosanitaire = ?');

	$req->execute(array($nom));

	return $req->fetchAll(PDO::FETCH_ASSOC);
}

function TraitementPhytosanitaire_add_entry($nom, $desc, $applique_a)
{
	global $db;

	$req1 = $db->prepare('INSERT INTO TraitementPhytosanitaire(nom, description) VALUES(?, ?)');

	$req1->execute(Array($nom, $desc));

	if(!empty($req1->errorInfo()[2])) return $req1->errorInfo();

	$reqString = 'INSERT INTO AppliqueA(annee_recolte, id_parcelle_recolte, nom_traitement_phytosanitaire, nb_applications) VALUES';
	
	$first = true;
	$i = 0;
	foreach($applique_a as &$entry)
	{
		if(!$first) $reqString.= ',';
		$first = false;
		$reqString.= ' (:a' . $i . ', :i' . $i . ', :n, :nb' . $i . ')';
		$i++;
	}

	$req2 = $db->prepare($reqString);

	$req2->bindParam('n', $nom);

	$i = 0;
	foreach($applique_a as &$entry)
	{
		$req2->bindParam('a' . $i, $entry['annee']);
		$req2->bindParam('i' . $i, $entry['id_parcelle']);
		$req2->bindParam('nb' . $i, $entry['nb_applications']);
		$i++;
	}

	$req2->execute();

	return $req2->errorInfo();
}

function TraitementPhytosanitaire_update_entry($nom, $desc, $applique_a)
{
	global $db;

	$req1 = $db->prepare('UPDATE TraitementPhytosanitaire SET description = ? WHERE nom = ?');
	$req1->execute(Array($desc, $nom));
	
	if(!empty($req1->errorInfo()[2])) return $req1->errorInfo();

	foreach($applique_a as &$entry)
	{
		// For Pgsql 9.5, you can do this
		//$req = $db->prepare('INSERT INTO AppliqueA(annee_recolte, id_parcelle_recolte, nom_traitement_phytosanitaire, nb_applications) VALUES(:a, :i, :n, :nb) ON CONFLICT(annee_recolte, id_parcelle_recolte, nom_traitement_phytosanitaire) DO UPDATE SET nb_applications = :nb');
		$req = $db->prepare('UPDATE AppliqueA SET nb_applications = :nb WHERE annee_recolte = :a AND id_parcelle_recolte = :i AND nom_traitement_phytosanitaire = :n');
		$req->execute(Array(
			'nb' => $entry['nb_applications'],
			'a' => $entry['annee'], 
			'i' => $entry['id_parcelle'], 
			'n' => $nom
		));
		if(!empty($req->errorInfo()[2])) return $req->errorInfo();
		$req = $db->prepare('INSERT INTO AppliqueA(annee_recolte, id_parcelle_recolte, nom_traitement_phytosanitaire, nb_applications) SELECT :a, :i, :n::text, :nb WHERE NOT EXISTS (SELECT 1 FROM AppliqueA WHERE id_parcelle_recolte = :i AND nom_traitement_phytosanitaire = :n)');
		$req->execute(Array(
			'nb' => $entry['nb_applications'],
			'a' => $entry['annee'], 
			'i' => $entry['id_parcelle'], 
			'n' => $nom
		));
		if(!empty($req->errorInfo()[2])) return $req->errorInfo();
	}
}

function TraitementPhytosanitaire_delete_entry($nom)
{
	global $db;

	$req1 = $db->prepare('DELETE FROM AppliqueA WHERE nom_traitement_phytosanitaire  = ?');

	$req1->execute(array($nom));

	$req2 = $db->prepare('DELETE FROM TraitementPhytosanitaire WHERE nom = ?');

	$req2->execute(array($nom));

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


