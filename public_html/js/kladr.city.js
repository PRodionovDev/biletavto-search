$(function() {
    $('[name=departure]').kladr({
        token: '',
        type: $.kladr.type.city,
        parentType: $.kladr.type.city.region,
		withParents: true,
		limit: 50,
        labelFormat: function (obj, query) {
			var label = '';
            var name = obj.name.toLowerCase();
			query = query.name.toLowerCase();

			var start = name.indexOf(query);
			start = start > 0 ? start : 0;

			if (obj.typeShort) {
				label += obj.typeShort + '. ';
			}

			if (query.length < obj.name.length) {
				label += obj.name.substr(0, start);
				label += '<strong>' + obj.name.substr(start, query.length) + '</strong>';
				label += obj.name.substr(start + query.length, obj.name.length - query.length - start);
			} else {
				label += '<strong>' + obj.name + '</strong>';
			}

			if (obj.parents) {
				for (var k = obj.parents.length - 1; k > -1; k--) {
					var parent = obj.parents[k];
					if (parent.name) {
						if (label) label += '<small>, </small>';
						label += '<small>' + parent.name + ' ' + parent.typeShort + '.</small>';
					}
				}
			}
			return label;
	    }
    });
    $('[name=arrival]').kladr({
        token: '',
        type: $.kladr.type.city,
        parentType: $.kladr.type.city.region,
		withParents: true,
		limit: 50,
        labelFormat: function (obj, query) {
			var label = '';
            var name = obj.name.toLowerCase();
			query = query.name.toLowerCase();

			var start = name.indexOf(query);
			start = start > 0 ? start : 0;

			if (obj.typeShort) {
				label += obj.typeShort + '. ';
			}

			if (query.length < obj.name.length) {
				label += obj.name.substr(0, start);
				label += '<strong>' + obj.name.substr(start, query.length) + '</strong>';
				label += obj.name.substr(start + query.length, obj.name.length - query.length - start);
			} else {
				label += '<strong>' + obj.name + '</strong>';
			}

			if (obj.parents) {
				for (var k = obj.parents.length - 1; k > -1; k--) {
					var parent = obj.parents[k];
					if (parent.name) {
						if (label) label += '<small>, </small>';
						label += '<small>' + parent.name + ' ' + parent.typeShort + '.</small>';
					}
				}
			}
			return label;
	    }
    });
});