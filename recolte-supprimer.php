<?php
require_once("model/auth.php");
require_once("model/Recolte.php");

if(!isset($_GET['id_parcelle']) && !isset($_GET['annee']))
{
	header('Location: ./');
	exit(0);
}

$recolte_annee = rawurldecode($_GET['annee']);
$recolte_id_parcelle = rawurldecode($_GET['id_parcelle']);

$errorInfo = Recolte_delete_entry($recolte_annee, $recolte_id_parcelle);

if(!empty($errorInfo[2]))
{
	$driver = $db->getAttribute(PDO::ATTR_DRIVER_NAME);
	$recolte_annee = htmlspecialchars($recolte_annee);
	$recolte_id_parcelle = htmlspecialchars($recolte_id_parcelle);
	$page_title = 'La récolte de la parcelle n°' . $recolte_id_parcelle . ' en ' . $recolte_annee . ' n\'a pas été supprimée';
	require_once("view/suppression-erreur.php");
}
else
{
	header('Location: recoltes.php');
}
