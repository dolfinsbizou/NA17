var add_field = function(i, target, content) {
	if(targetsCount[i] < targetsMax[i])
	{
		var field_string = '<li><select id="';
		field_string+= target;
		field_string+= '_';
		field_string+= targetsCount[i];
		field_string+= '" name="';
		field_string+= target;
		field_string+= '_';
		field_string+= targetsCount[i];
		field_string+= '">';
	
		for(var j = 0 ; j < dyn_fields_params[target].length ; j++) {
			field_string+= '<option value="';
			field_string+= dyn_fields_params_keys[target][j];
			field_string+='"';
			if(content === dyn_fields_params[target][j]) field_string+=' selected';
			field_string+='>';
			field_string+= dyn_fields_params[target][j];
			field_string+= '</option>';
		}
		field_string+= '</li></select>';
		targets[i].innerHTML+= field_string;
		targetsCount[i]++;
	}
}

var delete_field = function(i, target) {
	if(targetsCount[i] > 0)
	{
		var selected = document.getElementById(target.concat('_'.concat(targetsCount[i]-1))).parentElement.remove();
		targetsCount[i]--;
	}
}
