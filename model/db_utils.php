<?php

function formatted_date($field, $alias=null)
{
	if($alias == null)
	{
		$f = explode('.', $field);
		$alias = $f[count($f)-1] . '_f';
	}

	return 'to_char(' . $field . ', \'DD/MM/YYYY\') AS ' . $alias;
}
