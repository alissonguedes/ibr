window.onload = () => {

	if (typeof redirect === 'function') {

		window.addEventListener('popstate', function () {

			var href = window.location.href;
			var javascript = /^[J|j]ava[s|S]cript|^\#/;

			if (javascript.test(href)) {
				this.alert('teste')
				return;
			}

			redirect(href);

		}, true);

	}


	new Mmenu("#mmenu", {
		"offCanvas": {
			"position": "left-front"
		},
		"setSelected": {
			'current': 'detect',
			// "hover": true,
			// "parent": true
		},
		sidebar: {
			collapsed: {
				use: '(max-width: 992px)'
			},
			expanded: {
				use: '(min-width: 1000px)'
			}
		},
		// "navbars": [{
		// 	"position": "top",
		// 	"content": [
		// 		"breadcrumbs",
		// 		"close"
		// 	]
		// }],
		// "theme": "black",
		// "navbars": [{
		// 	"position": "bottom",
		// 	"content": [
		// 		"<a class='fa fa-envelope' href='#/'></a>",
		// 		"<a class='fa fa-twitter' href='#/'></a>",
		// 		"<a class='fa fa-facebook' href='#/'></a>"
		// 	]
		// }]
	});


}

function redirect(url, method = 'get') {

	var xhr = new XMLHttpRequest();

	xhr.open(method, url);

	xhr.onreadystatechange = function () { }

	xhr.onloadstart = function () { };

	xhr.onprogress = function (event) { }

	xhr.onloadend = function (e) {

		if (xhr.readyState === 4) {

			var parser = new DOMParser();
			var content = parser.parseFromString(xhr.response, 'text/html');
			var response = content;
			var title = response.querySelector('title');
			var url = xhr.responseURL;


			if (title)
				document.title = title.innerHTML;

			$('#page').html($(response).find('#page').html());

		}

		$('main .card .animated').removeClass('fadeOut').addClass('fadeIn');

	}

	xhr.send();

}

function delay(func, wait, immediate) {

	var timeout;

	return function (args) {
		const context = this;
		const later = function () {
			timeout = null;
			if (!immediate) func.apply(context, args);
		};

		const callnow = immediate && !timeout;
		clearTimeout(timeout);
		timeout = setTimeout(later, wait);
		if (callnow) func.apply(context, args);
	}

}

var Url = {

	update: (url) => {
		window.history.pushState('', '', url);
	}

}

$('#open-search').bind('click', function () {
	$('#input-search-header').show().focus()
		.bind('blur', function () {
			if ($(this).val().length === 0) {
				$('#input-search-header').hide();
				$(this).parents('li.search').find('#open-search').show();
				$(this).parents().find('li:not(.search)').removeClass('disabled');
				$(this).parents('.card-header').removeClass('open');
			}
		});
	$(this).parents().find('li:not(.search)').addClass('disabled');
	$(this).parents('.card-header').addClass('open');
});

$('#input-search-header').bind('keyup', function () {

	$('.progress').show();

}).bind('keyup', delay(function () {

	var url = window.location.href;
	var search = $(this).val();

	$.ajax({
		url: url + '/' + search,
		method: 'get',
		success: (response) => {

			var parser = new DOMParser();
			var content = parser.parseFromString(response, 'text/html');

			$('main > .card > .card-content').html($(content).find('main > .card > .card-content').html());
			$('.progress').hide();

			$.getScript(BASE_PATH + 'assets/js/app.js');

		}
	})

}, 500));
