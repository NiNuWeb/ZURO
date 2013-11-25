/**
 * AJAX form plugin for jQuery
 *
 * @copyright  Copyright (c) 2009 Jan Marek
 * @license    MIT
 * @link       http://nettephp.com/cs/extras/ajax-form
 * @version    0.1
 */

jQuery.fn.extend({
	ajaxSubmit: function (callback, ajaxOptions) {
		var form;
		var sendValues = {};

		if (ajaxOptions === undefined) {
			ajaxOptions = {};
		}

		// submit button
		if (this.is(":submit")) {
			form = this.parents("form");
			sendValues[this.attr("name")] = this.val() || "";

		// form
		} else if (this.is("form")) {
			form = this;

		// invalid element, do nothing
		} else {
			return null;
		}

		// validation
		if (form.get(0).onsubmit && !form.get(0).onsubmit()) return null;

		// get values
		var values = form.serializeArray();

		for (var i = 0; i < values.length; i++) {
			var name = values[i].name;

			// multi
			if (name in sendValues) {
				var val = sendValues[name];

				if (!(val instanceof Array)) {
					val = [val];
				}

				val.push(values[i].value);
				sendValues[name] = val;
			} else {
				sendValues[name] = values[i].value;
			}
		}

		// send ajax request
		ajaxOptions.url = form.attr("action");
		ajaxOptions.data = sendValues;
		ajaxOptions.type = form.attr("method") || "get";

		if (callback) {
			ajaxOptions.success = callback;
		}

		return jQuery.ajax(ajaxOptions);
	}
});