'use strict';

$(document).ready(function() {

	var scroller = $('.scroller');

	$('[data-href],[href]').unbind().bind('click', function(e) {

		e.preventDefault();

		var href = $(this).data('href') || $(this).attr('href');
		var javascript = /^[J|j]ava[s|S]cript|^\#/;

		if (javascript.test(href)) {
			return;
		}

		// var target = $(this).attr('target');
		var target = $(this).attr('target') || '_self';

		if (target) {

			if (target === '_self')
				return window.location.href = href;
			else if (target === '_top')
				return null;
			else
				return window.open(href, target);

		}

		$('main .animated').removeClass('fadeIn').addClass('fadeOut');

		Url.update(href);

		redirect(href);

	});

	$(scroller).each(function() {

		var scroll = new PerfectScrollbar(this, {
			theme: "dark",
		});

		$(window).bind('resize', function() {
			scroll.update();
		});

	});

	var tabs = $('.tabs');
	var t = tabs.tabs({
		// swipeable: true
	});

	$('.materialboxed').materialbox();

	if (typeof daterangepicker == 'function' && $('body').find('.daterange').length > 0) {
		$('.daterange').daterangepicker({
			// singleDatePicker: true,
			// showDropdowns: true,
			linkedCalendars: true,
			timePicker: false,
			timePickerIncrement: 15,
			// buttonClasses: 'btn waves-effect',
			autoApply: true,
			drops: 'down',
			locale: {
				cancelLabel: 'Clear',
				applyLabel: 'Aplicar',
				daysOfWeek: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S'],
				monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
				format: 'DD/MM/YYYY',
				separator: ' - ',
				fromLabel: 'De',
				toLabel: 'Até',
				customRangeLabel: 'Custom',
				weekLabel: 'W',
				firstDay: 0,
			}
		});
	}

	if ($('.datepicker').length) {
		$('.datepicker').datepicker({
			format: 'dd/mm/yyyy',
			autoClose: true,
		});
	}

	setTimeout(function() {
		$('.calendar-time').find('select').each(function() {
			$(this).addClass('browser-default');
		})
	}, 1000);

	tabs.find('a').unbind().bind('click', function() {
		setTimeout(function() {
			t.tabs('updateTabIndicator');
		}, 100)
	});

	$('.tabs .tab a').each(function(index, element) {

		var id = $(this).attr('href');

		if ($(id).find('.input-field').hasClass('error')) {
			$(this).parents('.tabs, .tab').addClass('error');
			var tab = $($(this).parents('.tabs').find('.tab.error')[0]); // Exibir sempre a primeira "tab" da lista de erros
			if (tab.index() > -1) {
				var atual = $(tab.find(`a[href="${id}"]`)[0]).attr('href');
				if (typeof atual !== 'undefined')
					t.tabs('select', atual.replace('#', ''));
			}
		}

	});

	// $('.collapsible').Menu();
	// $('#main-menu').Menu();

	$('select:not(.browser-default)').formSelect();

	$('.input-field').each(function() {

		var field = $(this).find('input,textarea,select');

		if (field.val() != '') {
			$(this).find('label').addClass('active');
		}

	});

	$('[data-tooltip]').tooltip({
		transitionMovement: 10,
		margin: -5
	});

	var sidenav = $('.sidenav').sidenav({
		onCloseStart: () => {
			// var self = $('aside');
			// self.find('ul.submenu').removeClass('in out');
			// self.find('ul:not(.submenu)').removeClass('out').addClass('in');
		}
		// }).find('li').unbind().bind('click', function (e) {
		//     e.preventDefault();
	});

	sidenav.sidenav('close');

	$('.btn-menu').unbind().bind('click', function() {
		$('body').toggleClass('nav-collapsed');
	});

	$('button[type="reset"]').unbind().bind('click', function() {

		var action = $(this).parents('form').attr('action');

		$(this).parents('form.card-reveal').css({
			'transform': 'translateY(0%)',
		});

		Url.update(action);

	});

	$('#card-button,.icon-background').unbind().bind('click', function() {
		var url = $(this).data('href');
		$('form.card-reveal').show();
		if (typeof url !== 'undefined') {
			$.ajax({
				url: url,
				method: 'get',
				success: (response) => {
					var form = $(response).find('form.card-reveal');
					Url.update(url);
					$('form.card-reveal').html(form.html());
					$('form.card-reveal').css({
						'transform': 'translateY(-100%)',
					});
					$.getScript(BASE_PATH + 'assets/js/app.js');
				},
				error: (response) => {
					alert(response.status + ': ' + response.responseJSON.message);
				}
			});
		}
	});

	// activator

	// $('#card-button').unbind().bind('click', function () {

	//     var url = $(this).data('url');
	//     $('.card-reveal').show();

	//     if (typeof url !== 'undefined') {
	//         Url.update(url);

	//         $.ajax({
	//             url: url,
	//             method: 'get',
	//             success: (response) => {
	//                 var form = $(response).find('form.card-reveal');
	//                 $('form.card-reveal').html(form.html());
	//                 $.getScript(BASE_PATH + 'assets/scripts/app/clinica/app.js');
	//                 $('.card-reveal').css({
	//                     'transform': 'translateY(-100%)',
	//                 });
	//             }

	//         });

	//     }

	// });

	// $('aside').find('ul').each(function() {
	// 	var a = $(this).find('li').find('a[href="javascript:void(0);"]');
	// 	a.unbind().bind('click', function(e) {
	// 		var self = $(this).parents('ul');
	// 		var idMenu = $(this).data('id');
	// 		e.preventDefault();
	// 		if ($(this).hasClass('menu-close')) {
	// 			self.parents('aside').find('ul.in').removeClass('in');
	// 			self.parents('aside').find(idMenu).removeClass('in out').addClass('in');
	// 		} else {
	// 			self.removeClass('in').addClass('out');
	// 			self.parents('aside').find(idMenu).addClass('in');
	// 		}
	// 	});
	// });

	// $('aside').unbind().bind('mouseleave', function() {
	// 	var self = $(this);

	// 	// var timeout = setTimeout(function () {

	// 	// self.find('ul.submenu').removeClass('in out');
	// 	// self.find('ul:not(.submenu)').removeClass('out').addClass('in');

	// 	// self.find('a').parents('ul:not(.out):not(#main-menu)').removeClass('in out')
	// 	// self.find('a.active').parents('ul').removeClass('out').addClass('in');

	// 	var ul = self.find('.main-menu ul');
	// 	// for (var i in ul) {

	// 	// $(ul).each(function () {

	// 	//     var isIn = $(this).after().hasClass('in');
	// 	//     var isOut = $(this).before().hasClass('out');

	// 	//     console.log(isIn);

	// 	//     if (isOut) {
	// 	//         $(this).removeClass('out').addClass('in');
	// 	//     } else {
	// 	//         $(this).removeClass('in');
	// 	//     }

	// 	// })

	// 	// }

	// 	// }, 2000);

	// 	// $(this).bind('mouseenter', function () {
	// 	//     clearTimeout(timeout);
	// 	// });

	// });

	$('.card:not(.agenda)>.card-reveal').unbind().bind('mouseleave', function() {
		$(this).find('.card-title').click();
	});

	$('.input-field.error').find('input,textarea,select').each(function() {
		$(this).bind('keyup', function() {
			if ($(this).val().length > 0)
				$(this).parents('.input-field.error').removeClass('error').find('.error').hide();
			else
				$(this).parents('.input-field').addClass('error').find('.error').show();
		});
	});

	if (typeof FroalaEditor !== 'undefined') {
		$('.editor').each(function() {
			// var height = $(this).attr('rows') || $(this).parent().parent().height();
			var height = 300;
			var placeholder = ($(this).attr('placeholder') || 'Escreva aqui') + '...';

			var buttons = typeof $(this).data('buttons') !== 'undefined' ? typeof $(this).data('buttons') == 'string' ? $(this).data('buttons').replace(/\s/g, '').split(',') : null : {
				// Key represents the more button from the toolbar.
				moreText: {
					// List of buttons used in the  group.
					buttons: ['bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript', 'fontFamily', 'fontSize', 'textColor', 'backgroundColor', 'inlineClass', 'inlineStyle', 'clearFormatting'],
					// Alignment of the group in the toolbar.
					align: 'left',
					// By default, 3 buttons are shown in the main toolbar. The rest of them are available when using the more button.
					buttonsVisible: 3
				},

				moreParagraph: {
					buttons: ['alignLeft', 'alignCenter', 'formatOLSimple', 'alignRight', 'alignJustify', 'formatOL', 'formatUL', 'paragraphFormat', 'paragraphStyle', 'lineHeight', 'outdent', 'indent', 'quote'],
					align: 'left',
					buttonsVisible: 3
				},

				moreRich: {
					buttons: ['insertLink', 'insertImage', 'insertVideo', 'insertTable', 'emoticons', 'fontAwesome', 'specialCharacters', 'embedly', 'insertFile', 'insertHR'],
					align: 'left',
					buttonsVisible: 3
				},

				moreMisc: {
					buttons: ['undo', 'redo', 'fullscreen', 'print', 'getPDF', 'spellChecker', 'selectAll', 'html', 'help'],
					align: 'right',
					buttonsVisible: 2
				}
			};

			console.log(Object.assign(buttons));

			new FroalaEditor(this, {
				theme: 'dark',
				language: 'pt_br',
				height: height,
				placeholderText: placeholder,
				key: '1C%kZV[IX)_SL}UJHAEFZMUJOYGYQE[\\ZJ]RAe)+%$==',
				toolbarSticky: false,
				attribution: false,
				toolbarBottom: false,
				wordCounterCount: true,
				charCounterCount: true,
				toolbarButtons: buttons,
			});
		});
	}

	/** Página de agenda */
	$('#details .card-title').unbind().bind('click', function() {
		Url.update(BASE_URL + 'agenda');
	});

	$('#details .card-title .date').unbind().bind('click', function() {
		$('#details .card-title').click();
	});

	$('.masonry').masonry({
		'itemSelector': '.masonry-item'
	});

});
