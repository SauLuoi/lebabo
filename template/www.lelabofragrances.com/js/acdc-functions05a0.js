$(function() {
	/**
	 * just making sure that it's not getting the page in the browser cache
	 */
	$('.nav li a:not(.dropdown-button), .header .logo').on('click', function () {
		if($(this).prop('href') && getCookieWithHelper(false,'ACDC_LOCALE') == 'FR'){

			let uri = new URI($(this).prop('href'));
			let path = uri._parts.path;
			if(!path.startsWith('/fr') || (window.location.href.includes('/fr/') && !path.startsWith('/fr'))){
				let pathStr = uri._parts.protocol + "://" + uri._parts.hostname + "/fr" + path;
				window.location = pathStr;
				return false;
			}
		};
	});

	checkLogIn();

	countCart();

	initializeUserRegionRelated();

	checkTopBanner();

	checkCountryToggleLinks();

	$(document).on('click', '.popup-destroy', function(event) {
		event.preventDefault();

		var target = $(this).attr('href');
		$(target).remove();
	});

	$('#field-personalize-engraving').on('input', function(event) {
		var regex = new RegExp('[^A-Za-z0-9 ]', 'g');
		var currentValue = $(this).val();

		if (regex.test(currentValue)) {
			var newValue = currentValue.replace(regex, '');
			$(this).val(newValue);
		}
	});

	$('.top-banner-close').on('click', function(event) {
		event.preventDefault();
		setTopBannerCookie();
		checkTopBanner();
	});

	$('body').on('click', '.popup-close-btn', function(e) {
		e.preventDefault();

		var targetId = $(this).attr('href');
		var $target = $(targetId);
		$target.toggleClass('visible');
	});

	$('body').on('click', 'a.disabled', function(event) {
		event.preventDefault();

		return false;
	});

	$('.scroll-to-section').on('click', function(event) {
		event.preventDefault();

		var $topBanner = $('.top-banner');
		var $header = $('.header.header-sticky');
		var target = $(this).attr('href');
		var $target = $(target);
		var top = $target.offset().top;
		var breakpoint = 1024;
		var offset;

		if ($(window).width() < breakpoint) {
			offset = top;
		} else {
			if (top < $topBanner.outerHeight()) {
				offset = top;
			} else {
				offset = top - $header.outerHeight();
			}
		}

		$('html').animate({
			scrollTop: offset
		}, 500);
	});
});

function checkLogIn() {
	$.getJSON(js_site_var['context_path'] + '/app/account/info.json', function(data) {
		var $link = $('.header-actions .link-account > a > span');
		var $mobileLink = $('#mobile-link-account');
		var $links = $link.add($mobileLink);
		var $filler = $('#logged-in-filler');

		if (data.loggedIn) {
			if (js_site_var['userLanguage'] == 'FR') {
				$links.text('Bonjour, ' + data.firstName);
				$filler.text('Bonjour, ' + data.firstName + '.');
			} else {
				$links.text('Hello, ' + data.firstName);
				$filler.text('Hello, ' + data.firstName + '.');
			}
		} else {
			if (js_site_var['userLanguage'] == 'FR') {
				$links.text("SE CONNECTER/S'inscrire");
			} else {
				$links.text('Log in/Register');
			}
		}
	});
}

function formatPrice(listBuq, priceBuq, symbol) {
	var listPrice = listBuq / 100;
	var price = priceBuq / 100;
	if (priceBuq < listBuq) {
		return "<span style='text-decoration: line-through'>" + symbol + listPrice.toFixed(2) + "</span> " + symbol + price.toFixed(2);
	} else {
		return symbol + price.toFixed(2);
	}
}

function handleSkuPrice(sku_id, handler) {
	ajaxWithoutAuth(js_site_var['context_path'] + '/app/product/price/' + sku_id + '.json', '', 'GET', function(data) {
		for (key in data.prices) {
			if (data.prices.hasOwnProperty(key)) {
				if (typeof handler === 'undefined') {
					var pricePrefix = js_site_var['userCurrency'] + ' ' + data.prices[key].symbol;
					$('#sku-price-' + sku_id).html(formatPrice(data.prices[key].listBuq, data.prices[key].buq, pricePrefix));
					$('#sku-price-' + sku_id).closest('.product-item').find('.btn-link, .promotion-btn').data('price',formatListingPrice(data.prices[key].buq));

				} else {
					handler(data.prices[key], sku_id);
				}
			}
		}
	}, 'json');
}

function checkTopBanner() {
	if (typeof getCookieWithHelper(false, 'acdc_top_banner') === 'undefined') {
		var $topBanner = $('.top-banner');
		$topBanner.removeClass('hidden');
		var maxIndex = $topBanner.data('maxIndex');

		if($topBanner.data('maxIndex') > 0) {
			window.bannerInterval = setInterval(function () {
				var currentIndex = $topBanner.data('currentIndex');
				var nextIndex = currentIndex < maxIndex ? ++currentIndex : 0;

				$topBanner.find('.top-banner-text').addClass('hidden');
				$($topBanner.find('.top-banner-text')[nextIndex]).removeClass('hidden');

				$topBanner.data('currentIndex', nextIndex);

				mobileMenuAdjust();
			}, 5000);
		}
	} else {
		$('.top-banner').remove();
		window.clearInterval(window.bannerInterval);
	}
}

function setTopBannerCookie() {
	setCookieWithHelper(false, 'acdc_top_banner', 'true', {
		path: '/',
		domain: js_site_var['cookie_domain']
	});
}

function showOrderLimitPopup() {
	var $target = $('#popup-order-limit');

	$target.toggleClass('visible');
}

function showPersonalizationPopup() {
	var $target = $('#popup-personalize');

	$target.toggleClass('visible');
}

/**
 * Format the input element to be
 * @param element
 */
function formatCPF(element){
	let ele = document.getElementById(element.id);

	ele = ele.value.split('.').join('');  // Remove dot
	ele = ele.split('-').join('');        // Remove dash

	//console.log ("ELE => " + ele);

	let finalVal = ele.match(/.{1,3}/g).join('\.');

	//replace the 3 occurence of dot to dash
	let nth = 0;
	finalVal = finalVal.replace(/\./g, function (match, i, original) {
		nth++;
		return (nth === 3) ? "-" : match;
	});
	//console.log ("FINAL => " + finalVal);
	document.getElementById(element.id).value = finalVal;
}

function showAlertPopup(msg) {
	let $target = $('#popup-alert-msg');

	$target.find('.popup-content').text(msg);
	$target.toggleClass('visible');
}

function checkCountryToggleLinks() {
	$('.country-toggle').each(function() {
		let $this = $(this);
		let visibleCountries = $this.data('visible-countries');
		let hiddenCountries = $this.data('hidden-countries');
		let region = js_site_var['userRegion'];

		if (visibleCountries != null) {
			$this.toggleClass('hidden', visibleCountries.indexOf(region) < 0);
		}

		if (hiddenCountries != null) {
			$this.toggleClass('hidden', hiddenCountries.indexOf(region) > -1);
		}
	});
}

// Used for cart page only
function recommendationsCallback() {
	window.scrollTo(0,0)
	window.location.reload();
}