<?php

function formatted_date($field, $alias=null)
{
	if($alias == null) $alias = $field . '_f';

	return 'to_char(' . $field . ', \'DD/MM/YYYY\') AS ' . $alias;
}
