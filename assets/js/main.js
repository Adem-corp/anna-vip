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
			const ajaxLoader = document.querySelector('#ajax_loader');

			if (element[0].intersectionRatio) {
				ajaxLoader.classList.add('loading');
				catalog_current_page++;

				const response = fetch(adem_ajax.url, {
					method: 'POST',
					headers: {
						'Content-Type': 'application/x-www-form-urlencoded;charset=UTF-8'
					},
					body: new URLSearchParams({
						'action': 'load_more',
						'query': JSON.stringify(catalog_query),
						'page': catalog_current_page,
						'nonce': catalog_nonce,
					})
				})
					.then(response => response.text())
					.then(data => {
						if (data) {
							$('.catalog__grid').append(data);
						}

						ajaxLoader.classList.remove('loading');
					})
					.catch((error) => {
						console.error('Error:', error);
					});
			}
		}
	}
}

function burgerToggle() {
	const burgerBtn = document.querySelector('.js-burger-btn');
	const burgerContainer = document.querySelector('.js-burger');

	if (!burgerBtn || !burgerContainer) return;

	burgerBtn.addEventListener('click', function (e) {
		burgerBtn.classList.toggle('active');
		burgerContainer.classList.toggle('active');
	});
}

function initSidebarMenu() {
	const sidebar = document.querySelector('.sidebar');

	if (!sidebar) return;

	sidebar.addEventListener('click', function (e) {
		const target = e.target.closest('a[href="#"]');

		if (target) {
			e.preventDefault();
		}
	});
}

function sendStatusForm() {
	const form = document.querySelector('#status');
	const container = document.querySelector('.status__container');

	if (!form || !container) return;

	form.addEventListener('submit', function (e) {
		e.preventDefault();

		let formData = new FormData(form);

		formData.append('action', 'status');

		form.classList.add('loading');

		const response = fetch(adem_ajax.url, {
			method: 'POST',
			body: formData
		})
			.then(response => response.text())
			.then(data => {
				container.innerHTML = data;
			})
			.catch((error) => {
				console.error('Error:', error);
			});
	});
}

function orderFromCatalogs() {
	const form = document.querySelector('form#order');
	const addBtn = document.querySelector('#add_pos');
	const calcOrderBtn = document.querySelector('#calc_order');
	let counter = 1;

	if (!form) return;

	function addCatalogRow() {
		const lastRow = document.querySelector('.order__table tr:last-child');
		let rowHtml = `<tr class="order__catalog-row" data-name="Позиция ${counter}">
														<td data-name="Каталог">
															<select class="input order__input" name='cat_${counter}'>`;

		adem_ajax.catalogs.forEach(function (item) {
			rowHtml += `<option value="${item.name}">${item.name}</option>`
		});

		rowHtml += `</select>
		</td>
		<td data-name="Стр.">
			<input class="input order__input" type='text' name='page_${counter}'>
		</td>
		<td data-name="Рис.">
			<input class="input order__input" type='text' name='img_${counter}'>
		</td>
		<td data-name="Название на русском">
			<input class="input order__input" type='text' name='name_${counter}'>
		</td>
		<td data-name="Кол-во">
			<input class="input order__input" type='text' name='count_${counter}'>
		</td>
		<td data-name="Артикул">
			<input class="input order__input" type='text' name='art_${counter}'>
		</td>
		<td data-name="Размер">
			<input class="input order__input" type='text' name='size_${counter}'>
		</td>
		<td data-name="Цвет">
			<input class="input order__input" type='text' name='color_${counter}'>
		</td>
		<td data-name="Цена (EURO)">
			<input class="input order__input" type='text' name='price_${counter}'>
		</td>
	</tr>`;

		lastRow.insertAdjacentHTML('afterend', rowHtml);

		document.querySelector('input[name=catalog_count]').value = counter;
		counter++;
	}

	addCatalogRow();

	addBtn.addEventListener('click', addCatalogRow);

	function calcOrder() {
		let rows = document.querySelectorAll('.order__catalog-row');
		let total = 0;
		let percent = document.querySelector('input[name=percent]').value;
		let result;

		rows.forEach(function (row) {
			let quantity = row.querySelector('input[name^=count_]').value;
			let price = row.querySelector('input[name^=price_]').value;

			total += quantity * price;
		});

		if (percent) {
			total += total * percent / 100;
			result = 'Сумма заказа с учетом доставки ' + total + ' EUR';
		} else {
			result = 'Сумма заказа без учета доставки ' + total + ' EUR';
		}

		if (total > 0) {
			document.querySelector('.order__total-text').innerHTML = `<strong>${result}</strong>`;
		}
	}

	calcOrderBtn.addEventListener('click', calcOrder);

	form.addEventListener('submit', function (e) {
		e.preventDefault();

		let formData = new FormData(form);
		const formName = form.getAttribute('name');
		const submitBtm = form.querySelector('button[type=submit]');
		const submitBtnText = submitBtm.innerHTML;

		if (formName) {
			formData.append('form_name', formName);
			formData.append('action', 'make_order');
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
				form.reset();
				form.classList.remove('loading');
				submitBtm.innerHTML = submitBtnText;

				document.querySelector('#order-success strong').innerHTML = data;

				setTimeout(function () {
					Fancybox.show([{
						src: '#order-success',
						type: 'inline'
					}]);
				}, 100);
			})
			.catch((error) => {
				console.error('Error:', error);
			});
	});
}

function initReviewsSlider() {
	const section = document.querySelector('.reviews');

	if (!section) return;

	const swiper = new Swiper(section.querySelector('.swiper'), {
		slidesPerView: 1,
		spaceBetween: 8,
		centerInsufficientSlides: true,
		pagination: {
			el: section.querySelector('.swiper-pagination'),
			type: 'bullets',
			clickable: true
		},
		breakpoints: {
			769: {
				slidesPerView: 2,
				spaceBetween: 15,
			},
			1025: {
				slidesPerView: 3,
				spaceBetween: 15,
			},
			1281: {
				slidesPerView: 3,
				spaceBetween: 30,
			},
		}
	});

	section.querySelectorAll('.review-card').forEach((card, index) => {
		const id = `review-popup-${index}`;
		const popup = document.createElement('div');

		popup.id = id;
		popup.style.display = 'none';
		popup.innerHTML = card.outerHTML;

		document.body.appendChild(popup);

		card.setAttribute('data-fancybox', 'reviews');
		card.setAttribute('data-src', `#${id}`);
	});
}

function initInfoSlider() {
	const sections = document.querySelectorAll('.info');

	if (!sections) return;

	sections.forEach(function (section) {
		const swiper = new Swiper(section.querySelector('.swiper'), {
			slidesPerView: 1,
			spaceBetween: 30,
			centerInsufficientSlides: true,
			navigation: {
				nextEl: section.querySelector('.arrow--next'),
				prevEl: section.querySelector('.arrow--prev'),
			},
		});
	});
}

document.addEventListener("DOMContentLoaded", function () {
	Fancybox.bind();

	burgerToggle();
	initInfoSlider();
	initReviewsSlider();
	initSidebarMenu();
	initTabs();
	loadMorePosts();
	orderFromCatalogs();
	setTelMask();
	sendForms();
	sendStatusForm();
});
