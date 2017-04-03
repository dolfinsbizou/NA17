<?php

/*! \brief Display an array of DB results in a fancy table.
 *  \param $fetch Data to display. Must be escaped.
 *  \param $col_names If you want to change the names of some or all the columns, give an array associating a key as the original value to the new name of the column. Must be escaped.
 *  \param $primary_key Must be set if $actions == true (otherwise will force $actions to false), an array containing the original column names which are the primary key.
 *  \param $actions_prefix Must be set if $actions == true (otherwise will force $actions to false), determines the prefix of the pages for actions links. (prefix-editer.php, prefix-supprimer.php) 
 *  \param $actions If true, will display Update and Delete actions.
 *  \param $col_ommitted If you want to ommit some columns, give their original name in an array.
 *  \param $null_message Fallback to display if a cell has no value. Must be escaped.
 *  \param $extra_class Extra class(es) to give to the table element.
 */
function fancy_table($fetch, $col_names=null, $primary_key=null, $actions_prefix=null, $actions=true, $col_ommitted=null, $null_message="NA", $extra_class=null)
{
	if(!$col_ommitted) $col_ommitted = Array();
	if(!$primary_key) $primary_key = Array();
	if(!$actions_prefix || $primary_key == null) $actions = false;
	if(!is_array($fetch[key($fetch)])) $fetch = Array($fetch);

	foreach($fetch[0] as $key => &$value)
	{
		if(!isset($col_names[$key]))
			$col_names[$key] = $key;
	}
	
	echo '<table class="generated-table' . ($extra_class?(' ' . $extra_class):'') . '">';

	echo "<tr>";
	foreach($fetch[0] as $key => &$value)
	{
		if(!in_array($key, $col_ommitted))
		{
			echo "<th>";
			if(in_array($key, $primary_key)) echo '<span class="table-primary-key-symbol">&#xE98D;</span>';
			echo $col_names[$key];
			echo "</th>";
		}		
	}
	if($actions)
	{
		echo "<th>Actions</th>";
	}
	echo "</tr>";

	foreach($fetch as &$data)
	{
		echo "<tr>";
		foreach($data as $key => &$value)
		{
			if(!in_array($key, $col_ommitted))
			{
				echo '<td class="' . (empty($value)?' table-empty-cell':'') . (in_array($key, $primary_key)?'table-primary-key-cell':'') . '">';
				echo empty($value)?$null_message:$value;
				echo "</td>";
			}
		}
		if($actions)
		{
			$get_string = "?";
			foreach($primary_key as $cell)
			{
				if(strlen($get_string) !== 1) $get_string.= '&';
				$get_string.= $cell . '=' . rawurlencode($data[$cell]);
			}

			echo "<td class=\"table-actions-cell\">";
			echo '<a href="' . $actions_prefix . '-editer.php' . $get_string . '" title="Éditer" class="table-edit-action">&#xE904;</a> <a href="' . $actions_prefix . '-supprimer.php' . $get_string . '" title="Supprimer" class="table-delete-action">&#xEA0B;</a>';
			echo "</td>";
		}
		echo "</tr>";
	}

	echo "</table>";
	if($actions)
	{
		echo '<a href="' . $actions_prefix . '-editer.php" title="Ajouter" class="add-link">&#xEA0A;</a><br />';
	}
}
