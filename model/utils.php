<?php

/*! \brief Displays an array of DB results in a fancy table.
 *  \param $fetch Data to display. Must be escaped.
 *  \param $col_names If you want to change the names of some or all the columns, give an array associating a key as the original value to the new name of the column. Must be escaped.
 *  \param $primary_key Must be set if $actions == true (otherwise will force $actions to false), an array containing the original column names which are the primary key.
 *  \param $foreign_keys Foreign keys in the table. Must be an associative array with the key being the name of the column, and the value the php page).
 *  \param $actions_prefix Must be set if $actions == true (otherwise will force $actions to false), determines the prefix of the pages for actions links. (prefix-editer.php, prefix-supprimer.php) 
 *  \param $actions If true, will display Update and Delete actions. If 2, will only display Delete action.
 *  \param $col_ommitted If you want to ommit some columns, give their original name in an array.
 *  \param $null_message Fallback to display if a cell has no value. Must be escaped.
 *  \param $extra_class Extra class(es) to give to the table element.
 */
function fancy_table($fetch, $col_names=null, $primary_key=null, $foreign_keys=null, $actions_prefix=null, $actions=true, $col_ommitted=null, $null_message="NA", $extra_class=null)
{
	if(!empty($fetch))
	{
		if(!$col_ommitted) $col_ommitted = Array();
		if(!$primary_key) $primary_key = Array();
		if(!$foreign_keys) $foreign_keys = Array();
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
				if(array_key_exists($key, $foreign_keys)) echo '<span class="table-foreign-key-symbol">&#xE98D;</span><a href="'. $foreign_keys[$key] . '">';
				echo $col_names[$key];
				if(array_key_exists($key, $foreign_keys)) echo '</a>';
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
					$empty_cell = (empty($value)&&(!($value === 0))&&(!($value === '0')));
					echo '<td class="' . ($empty_cell?' table-empty-cell':'') . (in_array($key, $primary_key)?'table-primary-key-cell':'') . '">';
					echo $empty_cell?$null_message:$value;
					echo "</td>";
				}
			}
			if($actions)
			{
				$get_string = "?";
				foreach($primary_key as $meta => $cell)
				{
					if($meta === "dummy") continue;
					if(strlen($get_string) !== 1) $get_string.= '&';
					$get_string.= $cell . '=' . rawurlencode(htmlspecialchars_decode($data[$cell]));
				}

				echo "<td class=\"table-actions-cell\">";
				if($actions !== 2) echo '<a href="' . $actions_prefix . '-editer.php' . $get_string . '" title="Éditer" class="table-edit-action">&#xE904;</a> ';
				echo '<a href="' . $actions_prefix . '-supprimer.php' . $get_string . '" title="Supprimer" class="table-delete-action">&#xEA0B;</a>';
				echo "</td>";
			}
			echo "</tr>";
		}

		echo "</table>";
	}
	else
	{
		echo '<p>Table vide.</p>';
	}
	
	if($actions)
	{
		echo '<a href="' . $actions_prefix . '-editer.php" title="Ajouter" class="add-link">&#xEA0A;</a><br />';
	}

}

/*! \brief A structure (not a class, we can see that the fields are public and there is only a constructor. I mean, yes, it's technically a class. But there is no struct in PHP, despite it's based on C code. PHP is so dirty, fuck me.) containing the informations of a form field.
 */
class FormField
{
	public $f_type; //!< Field type.
	public $f_name; //!< Name and id.
	public $f_content; //!< Content of the field.
	public $f_placeholder; //!< Placeholder for the field.
	public $f_label; //!< Label.
	public $f_locked; //!< True if locked.
	public $f_required; //!< True if required.
	public $f_extras; //!< Extras : group for a radiobutton, an array for a list, etc.

	/*! \brief Constructor.
	 *  \param $l Label.
	 *  \param $p Placeholder.
	 *  \param $n Name.
	 *  \param $c Content.
	 *  \param $t Type.
	 *  \param $e Extras.
	 *  \param $lo Locked.
	 *  \param $r Required.
	 */
	function __construct($l, $p, $n, $c='', $t="text", $e=null, $lo=false, $r=false)
	{
		$this->f_type = $t;
		$this->f_name = $n;
		$this->f_content = $c;
		$this->f_placeholder = $p;
		$this->f_label = $l;
		$this->f_extras = $e;
		$this->f_locked = $lo;
		$this->f_required = $r;
	}
}

/*! \brief Displays a fancy form with a model.
 * 	\param $fields An array of FormFields.
 * 	\param $target Form target (the "action" attribute).
 * 	\param $tiny If true, displays only fields.
 */
function fancy_form($fields, $target, $tiny=false)
{
	$load_dyn_fields = false;
	$dyn_fields_iter = 0;
	
	if(!$tiny)
	{
		echo '<script src="assets/scripts/dynamic_fields_functions.js"></script>';
		echo '<form method="post" action="' . $target . '">';
	}

	foreach($fields as &$field)
	{
		switch($field->f_type)
		{
		case 'textarea':
			echo '<label for="' . $field->f_name . '">' . $field->f_label . '</label><textarea id="' . $field->f_name . '" name="' . $field->f_name . '" placeholder="' . $field->f_placeholder . '" ' . ($field->f_locked?'readonly':'') . ' ' . ($field->f_required?'required':'') . '>' . $field->f_content . '</textarea>';
			break;
		case 'select':
			if(!is_array($field->f_extras)) $field->f_extras = Array();

			echo '<label for="' . $field->f_name . '">' . $field->f_label . '</label>';
			echo '<select id="' . $field->f_name . '" name="' . $field->f_name . '"' . ($field->f_locked?' readonly':'') . '>';
			foreach($field->f_extras as &$option)
			{
				if(!$field->f_locked || $option==$field->f_content)
					echo '<option value="' . $option . '" ' . (($option==$field->f_content)?'selected':'') . '>' . $option . '</option>';
			}
			echo '</select>';
			break;
		case 'dynamic_fields':
			if(!is_array($field->f_extras)) $field->f_extras = Array();
			if(!is_array($field->f_content)) $field->f_content = Array();
			echo '<script>';
			if(!$load_dyn_fields) echo 'var dyn_fields = new Array(); var dyn_fields_params = new Object(); var dyn_fields_params_keys = new Object(); var dyn_fields_contents = new Object(); var dyn_fields_extra = new Object(); var dyn_fields_options = new Object();';

			$load_dyn_fields = true;
			
			echo 'dyn_fields.push(\'' . $field->f_name . '\'); dyn_fields_params[\'' . $field->f_name . '\'] = new Array(); dyn_fields_params_keys[\'' . $field->f_name . '\'] = new Array(); dyn_fields_contents[\'' . $field->f_name . '\'] = new Array(); dyn_fields_options[\'' . $field->f_name . '\'] = new Array();</script>';
			foreach($field->f_extras[0] as $key => &$option)
			{
				echo '<script>dyn_fields_params[\'' . $field->f_name . '\'].push(\'' . $option . '\'); dyn_fields_params_keys[\'' . $field->f_name . '\'].push(\'' . $key . '\');</script>';
			}

			foreach($field->f_extras[1] as &$option)
			{
				echo '<script>dyn_fields_options[\'' . $field->f_name . '\'].push(\'' . $option . '\');</script>';
			}
			echo '<script>dyn_fields_extra[\'' . $field->f_name . '\'] = \'';
			fancy_form(array_slice($field->f_extras, 2), null, true);
			echo '\';</script>';

			echo '<script>dyn_fields_contents[\'' . $field->f_name . '\'] = new Array();</script>';
			$indexC = 0;
			if(!empty($field->f_content)) echo '<script>dyn_fields_contents[\'' . $field->f_name . '\'][0] = new Object();</script>';
			foreach($field->f_content as $key => &$option)
			{
				if(is_array($option))
				{
					echo '<script>dyn_fields_contents[\'' . $field->f_name . '\'][' . $indexC . '] = new Object();</script>';
					foreach($option as $key2 => &$o)
						echo '<script>dyn_fields_contents[\'' . $field->f_name . '\'][' . $indexC . '][\'' . $key2 . '\'] = \'' . $o . '\';</script>';
					$indexC++;
				}
				else
					echo '<script>dyn_fields_contents[\'' . $field->f_name . '\'][' . $indexC . '][\'' . $key . '\'] = \'' . $option . '\';</script>';

			}
	
			echo '<label>' . $field->f_label . '</label><br />';
			echo '<ul class="dyn-fields ' . $field->f_name . '"></ul>';

			echo '<a href="#" class="add-link ' . $field->f_name . '">&#xEA0A;</a> <a href="#" class="delete-link ' . $field->f_name . '">&#xEA0B;</a>';
			$dyn_fields_iter++;
			break;
		default:
			echo '<label for="' . $field->f_name . '">' . $field->f_label . '</label><input type="' . $field->f_type . '" id="' . $field->f_name . '" name="' . $field->f_name . '" placeholder="' . $field->f_placeholder . '" ' . ($field->f_locked?'readonly':'') . ' ' . ($field->f_required?'required':'') . ' value="' . $field->f_content . '" />';
			break;
		}
		echo '<br />';
	}
	if(!$tiny)
	{
		echo '<input type="submit" value="Valider" />';
		echo '</form>';

		if($load_dyn_fields)
			echo '<script src="assets/scripts/dynamic_fields.js"></script>';
	}
}
