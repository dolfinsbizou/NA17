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
