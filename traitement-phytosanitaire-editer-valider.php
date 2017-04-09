<?php
require_once("model/auth.php");
require_once("model/TraitementPhytosanitaire.php");

if(!isset($_POST))
{
	header('Location: ./traitements-phytosanitaires.php');
	exit(0);
}

if(empty($_POST['nom']))
{
	header('Location: ./traitements-phytosanitaires.php');
	exit(0);
}

$i = 0;
$applique_a = Array();
while(isset($_POST['applique_a_' . $i]))
{
	$applique_a[$i] = Array();
	$applique_a_key = explode('|', $_POST['applique_a_' . $i]);
	$applique_a[$i]['annee'] = $applique_a_key[0];
	$applique_a[$i]['id_parcelle'] = $applique_a_key[1];
	$applique_a[$i]['nb_applications'] = $_POST['applique_a_nb_applications_' . $i];
	$i++;
}

if(!isset($_GET['add']))
{
	$errorInfo = TraitementPhytosanitaire_update_entry($_POST['nom'], $_POST['description'], $applique_a);
}
else
{
	$errorInfo = TraitementPhytosanitaire_add_entry($_POST['nom'], $_POST['description'], $applique_a);
}

if(!empty($errorInfo[2]))
{
	$driver = $db->getAttribute(PDO::ATTR_DRIVER_NAME);
	$page_title = 'Le traitement phytosanitaire ' . htmlspecialchars($_POST['nom']) . ' n\'a pas été ' . (isset($_GET['add'])?'ajouté':'édité');
	require_once("view/edition-erreur.php");
}
else
{
	header('Location: traitements-phytosanitaires.php');
}
