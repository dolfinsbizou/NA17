<?php

/*! \brief Display an array of DB results in a fancy table.
 *  \param $fetch Data to display. Must be escaped.
 *  \param $col_names If you want to change the names of some or all the columns, give an array associating a key as the original value to the new name of the column. Must be escaped.
 *  \param $col_ommitted If you want to ommit some columns, give their original name in an array.
 *  \param $null_message Fallback to display if a cell has no value. Must be escaped.
 *  \param $extra_class Extra class(es) to give to the table element.
 */
function display_results($fetch, $col_names=null, $col_ommitted=null, $null_message="NA", $extra_class=null)
{
	foreach($fetch[0] as $key => &$value)
	{
		if(!isset($col_names[$key]))
			$col_names[$key] = $key;
	}
	
	echo '<table class="generated-table' . ($extra_class?(' ' . $extra_class):'') . '">';
	
	echo "<tr>";
	foreach($col_names as $key => &$col_name)
	{
		if(!in_array($key, $col_ommitted))
		{
			echo "<th>";
			echo $col_name;
			echo "</th>";
		}		
	}
	echo "</tr>";

	foreach($fetch as &$data)
	{
		echo "<tr>";
		foreach($data as $key => &$value)
		{
			if(!in_array($key, $col_ommitted))
			{
				echo '<td' . (empty($value)?' class="table-empty-cell"':'') . '>';
				echo empty($value)?$null_message:$value;
				echo "</td>";
			}
		}
		echo "</tr>";
	}

	echo "</table>";
}
