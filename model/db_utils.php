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

function normalized_date($field)
{
	return 'to_date(' . $field . ', \'DD/MM/YYYY\')';
}

function formatted_price($field, $alias=null)
{
	if($alias == null)
	{
		$f = explode('.', $field);
		$alias = $f[count($f)-1] . '_f';
	}

	return 'to_char(' . $field . '::numeric, \'99999999999999999D99€\') AS ' . $alias;
}
