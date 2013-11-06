"use strict";

(function(window, document, $) {
	$(document).ready(function() {
		var attributesList = $('#attributes-list');
		var addAttribute = $('#add-attribute');
		var templateAddAttribute = $('#template-add-attribute');
		if (attributesList.length && addAttribute.length && templateAddAttribute.length) {
			addAttribute.on('click', function(ev) {
				ev.preventDefault();
				
				var count = attributesList.find('select').length;
				
				var tpl = templateAddAttribute.clone().html();
				tpl = tpl.replace(/:INDEX:/g, count);
				
				attributesList.append(tpl);
 			});
		}
	});
})(window, document, jQuery);
