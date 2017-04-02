<?php

require_once('db.php');

function Parcelle_get_all()
{
	global $db;
	$req = $db->query('SELECT * FROM Parcelle');

	return $req->fetchAll(PDO::FETCH_ASSOC);
}
