<?php
require_once("model/auth.php");
require_once("model/Cepage.php");
require_once("model/utils.php");

if(isset($_GET['nom']))
{
	$cepage_key = rawurldecode($_GET['nom']);

	$cepage = Cepage_get_entry($cepage_key);
	
	if(empty($cepage))
	{
		header('Location: cepages.php');
		exit(0);
	}
	else
	{
		foreach($cepage as &$field)
		{
			$field = htmlspecialchars($field);
		}

		$page_title = "Édition du cépage " . $cepage['nom'];
	}
}
else
{
	$cepage = null; // If we're in adding mode, as $cepage is null, $cepage['whatever'] is null too, not undefined (php is so odd)

$page_title = "Nouveau cépage";
}

$fields = Array();
$fields[0] = new FormField("Nom", "Variété de cépage", "nom", $cepage['nom'], "text", null, isset($_GET['nom']), true); 
$fields[1] = new FormField("Description", "Couleur, saveur, origine...", "description", $cepage['description'], "textarea");

$target = 'cepage-editer-valider.php' . ($cepage?'':'?add');

require_once("view/cepages-editer.php");
