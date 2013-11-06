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

    $(document).ready(function() {
        var valuesList = $('#values-list');
        var addValue = $('#add-value');
        var templateAddValue = $('#template-add-value');
        if (valuesList.length && addValue.length && templateAddValue.length) {
            addValue.on('click', function(ev) {
                ev.preventDefault();

                var count = valuesList.find('input').length;

                var tpl = templateAddValue.clone().html();
                tpl = tpl.replace(/:INDEX:/g, count);

                valuesList.append(tpl);
            });
        }
    });

    $(document).ready(function() {
        $('form').on('click', '.delete-item', function() {
            return confirm('Are you sure you want to delete?');
        });
    });

    $(document).ready(function() {
        var searchAttributes = $('#search-attributes');
        if (searchAttributes.length) {
            searchAttributes.on('click', 'input', function(ev) {
                console.log($(this).val());
            });
        }
    });
})(window, document, jQuery);
