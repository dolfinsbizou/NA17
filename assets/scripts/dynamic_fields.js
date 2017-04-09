targets = new Array();
targetsCount = new Array();
targetsMax = new Array();
offsets = new Array();

for(var i = 0 ; i < dyn_fields.length ; i++) {
	var elements = document.getElementsByClassName(dyn_fields[i]);

	for(var j = 0 ; j < elements.length ; j++) {
		var elem = elements[j];
		if(elem.className === "add-link ".concat(dyn_fields[i])) {
			elem.addEventListener('click', function(evt) {
				add_field(evt.target.field_target, evt.target.class_target, '');
			}, false);
			elem.field_target = i;
			elem.class_target = dyn_fields[i];
		}
		else if(elem.className === "delete-link ".concat(dyn_fields[i])) {
			elem.addEventListener('click', function(evt) {
				delete_field(evt.target.field_target, evt.target.class_target);
			}, false);
			elem.field_target = i;
			elem.class_target = dyn_fields[i];
		}
		else if(elem.className === "dyn-fields ".concat(dyn_fields[i])) {
			targets.push(elem);
			targetsCount.push(0);
			targetsMax.push(dyn_fields_params[dyn_fields[i]].length);
			offsets.push(dyn_fields_options[dyn_fields[i]][1]);
			if((dyn_fields_contents[dyn_fields[i]].length == 0) && dyn_fields_options[dyn_fields[i]][0]) add_field(i, dyn_fields[i], '');
		}
	}
	
	for(var j = 0 ; j < dyn_fields_contents[dyn_fields[i]].length ; j++)
	{
		add_field(i, dyn_fields[i], dyn_fields_contents[dyn_fields[i]][j]);
	}
}
