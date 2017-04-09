var add_field = function(i, target, content) {
	console.debug(content);
	if(targetsCount[i]-offsets[i] < targetsMax[i]) {
		var field_string = '<li><select id="';
		field_string+= target;
		field_string+= '_';
		field_string+= targetsCount[i];
		field_string+= '" name="';
		field_string+= target;
		field_string+= '_';
		field_string+= targetsCount[i];
		field_string+= '"';
		if(content.hasOwnProperty('dyn_field'))
			field_string+= ' readonly';
		field_string+= '>';
	
		for(var j = 0 ; j < dyn_fields_params[target].length ; j++) {
			if(!content.hasOwnProperty('dyn_field') || content['dyn_field'] === dyn_fields_params_keys[target][j]) {
				field_string+= '<option value="';
				field_string+= dyn_fields_params_keys[target][j];
				field_string+='"';
				if(content['dyn_field'] === dyn_fields_params_keys[target][j])
					field_string+=' selected';
				field_string+='>';
				field_string+= dyn_fields_params[target][j];
				field_string+= '</option>';
			}
		}
		field_string+= '</select>';
		field_string+= dyn_fields_extra[target].replace(/#/g, targetsCount[i]);
				field_string+= '</li>';
		targets[i].innerHTML+= field_string;
		for(strName in content) {
			if(strName=='dyn_field') continue;
			strValue = strName.replace(/#/g, targetsCount[i]);
			node = document.getElementById(strValue);
			switch(node.type) {
			case "textarea":
				node.innerHTML == content[strName];
				break;
			default:
				node.setAttribute('value', content[strName]);
				break;
			}
		}

		targetsCount[i]++;
	}
}

var delete_field = function(i, target) {
	if(targetsCount[i]-offsets[i] > (dyn_fields_options[target][0]?1:0)) {
		var selected = document.getElementById(target.concat('_'.concat(targetsCount[i]-1))).parentElement.remove();
		targetsCount[i]--;
	}
}
