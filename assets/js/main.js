'use strict';

let $ = jQuery.noConflict();

function slideUp(target, duration = 400) {
	target.style.height = target.offsetHeight + "px";
	target.style.boxSizing = "border-box";
	target.style.overflow = "hidden";

	target.offsetHeight;

	requestAnimationFrame(() => {
		requestAnimationFrame(() => {
			target.style.transition = `height ${duration}ms ease`;
			target.style.height = 0;
		});
	});

	setTimeout(() => {
		target.style.display = "none";
		target.style.removeProperty("height");
		target.style.removeProperty("overflow");
		target.style.removeProperty("transition");
	}, duration);
}

function slideDown(target, duration = 400) {
	target.style.removeProperty("display");

	let display = getComputedStyle(target).display;

	if (display === "none") display = "block";

	target.style.display = display;

	let height = target.offsetHeight;

	target.style.height = 0;
	target.style.overflow = "hidden";
	target.offsetHeight;

	requestAnimationFrame(() => {
		requestAnimationFrame(() => {
			target.style.transition = `height ${duration}ms ease`;
			target.style.height = height + "px";
		});
	});

	setTimeout(() => {
		target.style.removeProperty("height");
		target.style.removeProperty("overflow");
		target.style.removeProperty("transition");
	}, duration);
}

function slideToggle(target, duration = 500) {
	if (window.getComputedStyle(target).display === 'none') {
		slideDown(target, duration);
	} else {
		slideUp(target, duration);
	}
}

function getSiblings(elem) {
	let siblings = [];

	if (!elem.parentNode) {
		return siblings;
	}
	let sibling = elem.parentNode.firstChild;

	while (sibling) {
		if (sibling.nodeType === 1 && sibling !== elem) {
			siblings.push(sibling);
		}
		sibling = sibling.nextSibling;
	}
	return siblings;
}

function setTelMask() {
	[].forEach.call(document.querySelectorAll('[type="tel"]'), function (input) {
		let keyCode;

		function mask(event) {
			event.keyCode && (keyCode = event.keyCode);
			let pos = this.selectionStart;
			if (pos < 3) event.preventDefault();
			let matrix = input.placeholder,
				i = 0,
				def = matrix.replace(/\D/g, ""),
				val = this.value.replace(/\D/g, ""),
				new_value = matrix.replace(/[_\d]/g, function (a) {
					return i < val.length ? val.charAt(i++) || def.charAt(i) : a
				});
			i = new_value.indexOf("_");
			if (i != -1) {
				i < 5 && (i = 3);
				new_value = new_value.slice(0, i)
			}
			let reg = matrix.substr(0, this.value.length).replace(/_+/g,
				function (a) {
					return "\\d{1," + a.length + "}"
				}).replace(/[+()]/g, "\\$&");
			reg = new RegExp("^" + reg + "$");
			if (!reg.test(this.value) || this.value.length < 5 || keyCode > 47 && keyCode < 58) this.value = new_value;
			if (event.type == "blur" && this.value.length < 5) this.value = ""
		}

		input.addEventListener("input", mask, false);
		input.addEventListener("focus", mask, false);
		input.addEventListener("blur", mask, false);
		input.addEventListener("keydown", mask, false)
	});
}

function sendForms() {
	const startTime = Date.now();
	let typingSpeed = [];

	document.querySelectorAll("input, textarea").forEach((field) => {
		let lastTime = null;
		field.addEventListener("input", () => {
			const now = Date.now();
			if (lastTime) {
				typingSpeed.push(now - lastTime);
			}
			lastTime = now;
		});
	});

	document.querySelectorAll('form.js-form').forEach(function (form) {
		form.addEventListener('submit', function (e) {
			e.preventDefault();

			let formData = new FormData(form);
			const formName = form.getAttribute('name');
			const submitBtm = form.querySelector('button[type=submit]');
			const submitBtnText = submitBtm.innerHTML;

			if (formName) {
				formData.append('form_name', formName);
				formData.append('time_on_page', Date.now() - startTime);
				formData.append('typing_speed', JSON.stringify(typingSpeed));
				formData.append('action', 'send_mail');
				submitBtm.innerHTML = 'Отправляю...'
			} else {
				return;
			}

			form.classList.add('loading');

			const response = fetch(adem_ajax.url, {
				method: 'POST',
				body: formData
			})
				.then(response => response.text())
				.then(data => {
					Fancybox.close(true);
					form.reset();
					form.classList.remove('loading');
					submitBtm.innerHTML = submitBtnText;

					//if (typeof (ym) === "function") ym(metrika_number, 'reachGoal', 'metrika_ID'); // TODO отправка целей в метрику. Удалить, если не используется.

					setTimeout(function () {
						Fancybox.show([{
							src: '#modal-success',
							type: 'inline'
						}]);
					}, 100);
				})
				.catch((error) => {
					console.error('Error:', error);
				});
		});
	});
}

function initTabs() {
	let Tabs = {
		init: function () {
			this.bindUIfunctions();
		},

		bindUIfunctions: function () {
			$('.js-tabs').on("click", "li:not(.active)", function (e) {
				Tabs.changeTab($(this));
			});

			$('.js-tabs').on("click", "li.active", function (e) {
				Tabs.toggleMobileMenu(e, this);
			});
		},

		changeTab: function (tab_link) {
			let tab_item = $('#' + tab_link.data('tab'));

			tab_link.addClass("active").siblings().removeClass("active");

			tab_item.addClass("active").siblings().removeClass("active");

			tab_link.closest(".js-tabs").removeClass("open");
		},

		toggleMobileMenu: function (event, el) {
			$(el).closest(".js-tabs").toggleClass("open");
		}
	};

	Tabs.init();
}

function loadMorePosts() {
	const ajax_loader = document.querySelector('#ajax_loader');

	if (ajax_loader) {
		const options = {
			root: null,
			rootMargin: '0px',
			threshold: 0.1
		}

		const observer = new IntersectionObserver(load_more, options);

		observer.observe(ajax_loader);

		function load_more(element, observer) {
			const ajax_loader = document.querySelector('#ajax_loader');

			if (element[0].intersectionRatio) {
				ajax_loader.classList.add('loading');
				current_page++;

				$.ajax({
					url: adem_ajax.url,
					data: {
						'action': 'load_more',
						'page': current_page,
						'query': JSON.stringify(query)
					},
					type: 'POST',
					success: function (data) {
						if (data) {
							$('.page__grid').append(data);
						}
					},
					complete: function () {
						ajax_loader.classList.remove('loading');
					}
				});
			}
		}
	}
}

function burgerToggle() {
	$('.js-burger').on('click', function () {
		$('.menu-container').fadeToggle();
	});
}

function initSidebarMenu() {
	$('.sidebar__menu > .menu-item').on('mouseenter', function (e) {
		e.preventDefault();
		$(this).siblings().find('.sub-menu').hide();
		$(this).find('.sub-menu').fadeIn();
		$(this).addClass('hover');
	}).on('mouseleave', function () {
		$('.sub-menu').hide();
		$(this).removeClass('hover');
	});
}

function sendSubscribeForm() {
	$('form#subscribe').on('submit', function (e) {
		e.preventDefault();
		const form = $(this);
		let formData = new FormData(form.get(0));

		if (form.data('name')) {
			formData.append('form_name', form.data('name'));
		} else {
			return;
		}

		$.ajax({
			type: 'POST',
			url: '/wp-admin/admin-ajax.php?action=subscribe',
			data: formData,
			cache: false,
			processData: false,
			contentType: false,
			success: function (data) {
				$.fancybox.close();
				form.trigger("reset");
				setTimeout(function () {
					$.fancybox.open({
						src: '<div class="success" id="order_success">' +
							'<svg class="success__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">' +
							'<circle class="success__icon-circle" cx="26" cy="26" r="25" fill="none" />' +
							'<path class="success__icon-check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" />' +
							'</svg>' +
							'<h3>Спасибо</h3>' +
							'<p>Вы подписаны на рассылку новостей.</p>' +
							'<button class="btn btn_success" type="button" data-fancybox-close>OK</button>' +
							'</div>',
						type: 'inline',
						modal: true
					});
				}, 100);
			},
			error: function (jqXHR, textStatus, errorThrown) {
				console.log(jqXHR, textStatus, errorThrown);
			}
		});
	});
}

function sendStatusForm() {
	$('form#status').on('submit', function (e) {
		e.preventDefault();
		const form = $(this);
		let formData = new FormData(form.get(0));

		$.ajax({
			type: 'POST',
			url: '/wp-admin/admin-ajax.php?action=status',
			data: formData,
			cache: false,
			processData: false,
			contentType: false,
			success: function (data) {
				$('.status').html(data);
			},
			error: function (jqXHR, textStatus, errorThrown) {
				console.log(jqXHR, textStatus, errorThrown);
			}
		});
	});
}

document.addEventListener("DOMContentLoaded", function () {
	Fancybox.bind();

	burgerToggle();
	initSidebarMenu();
	initTabs();
	loadMorePosts();
	setTelMask();
	sendForms();
	sendStatusForm();
	sendSubscribeForm();
});
