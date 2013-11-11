(function ($, window) {

$(function () {

	// navazani validate Nette formularu
	$('form').livequery(function () {
		var $this = $(this);
		Nette.initForm($this[0]);

	});
});



/**
 * AJAX Nette Framework plugin for jQuery
 *
 * @copyright   Copyright (c) 2009 Jan Marek
 * @license     MIT
 * @link        http://nettephp.com/cs/extras/jquery-ajax
 * @version     0.2
 */

$.extend({
	nette: {
		updateSnippet: function (id, html) {
			id = $.nette.escapeSelector(id);
			html === null ? $('#' + id).remove() : $('#' + id).html(html);
		},

		success: function (payload) {
			if (typeof payload !== 'undefined') {
				// redirect
				if (payload.redirect) {
					window.location.href = payload.redirect;
					return ;
				}

				// snippets
				if (payload.snippets) {
					$.each(payload.snippets, function (id, html) {
						$.nette.updateSnippet(id, html);
					});
				}
			}
		},

		escapeSelector: function (s) {
			return s.replace(/[\!"#\$%&'\(\)\*\+,\.\/:;<=>\?@\[\\\]\^`\{\|\}~]/g, '\\$&');
		}
	}
});

$.ajaxSetup({
	success: $.nette.success
});



/**
 * @see http://pastebin.com/i3srtkcd
 */
$.fn.extend({
	serializeValues: function () {
		if (!this.is("form")) {
			return null;
		}

		var sendValues = {};

		// get values
		var values = this.serializeArray();

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

		return sendValues;
	},

	ajaxSubmit: function (callback, ajaxOptions) {
		if (ajaxOptions === undefined) {
			ajaxOptions = {};
		}

		var $form = this.is('form') ? this : this.closest('form');

		// validation
		if ($form.get(0).onsubmit && !$form.get(0).onsubmit()) return null;

		// get values
		var sendValues = $form.serializeValues();
		if (this.is(":submit, :image")) {
			sendValues[this.attr("name")] = this.val() || "";
		}

		// send ajax request
		ajaxOptions.url = $form.attr("action");
		ajaxOptions.data = sendValues;
		ajaxOptions.type = $form.attr("method") || "get";

		if (callback) {
			ajaxOptions.success = callback;
		}

		return $.ajax(ajaxOptions);
	}
});

})(jQuery, window);