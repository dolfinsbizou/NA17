<!DOCTYPE html>
<html lang="fr">
<?php require_once("include/head.php"); ?>
<body>
	<?php require_once("include/nav.php"); ?>
	<div id="main">
		<h1><?= $page_title ?></h1>
		<?php 
foreach($list_types as $type)
{
	echo '<h2 id="' . $type . '">' . $types_fancy_names[$type] . '</h2>';
	fancy_table($types[$type], $types_col_names, $types_primary_key, null, null, false);
}	
		?>
	</div>
</body>
</html>
