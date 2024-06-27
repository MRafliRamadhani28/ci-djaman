function change() {
	"password" == document.getElementById("password").type
		? ((document.getElementById("password").type = "text"),
		  (document.getElementById("mybutton").innerHTML =
				'<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-slash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">\n    <path d="M10.79 12.912l-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z"/>\n    <path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708l-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829z"/>\n    <path fill-rule="evenodd" d="M13.646 14.354l-12-12 .708-.708 12 12-.708.708z"/>\n    </svg>'))
		: ((document.getElementById("password").type = "password"),
		  (document.getElementById("mybutton").innerHTML =
				'<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">\n    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>\n    <path fill-rule="evenodd" d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>\n    </svg>'));
}
!(function (e) {
	"use strict";
	jQuery(document).ready(function (e) {
		e(".testimonial-sliders").owlCarousel({
			items: 1,
			loop: !0,
			autoplay: !0,
			responsive: {
				0: { items: 1, nav: !1 },
				600: { items: 1, nav: !1 },
				1e3: { items: 1, nav: !1, loop: !0 },
			},
		}),
			e(".homepage-slider").owlCarousel({
				items: 1,
				loop: !0,
				autoplay: !0,
				nav: !0,
				dots: !1,
				navText: [
					'<i class="fas fa-angle-left"></i>',
					'<i class="fas fa-angle-right"></i>',
				],
				responsive: {
					0: { items: 1, nav: !1, loop: !0 },
					600: { items: 1, nav: !0, loop: !0 },
					1e3: { items: 1, nav: !0, loop: !0 },
				},
			}),
			e(".logo-carousel-inner").owlCarousel({
				items: 4,
				loop: !0,
				autoplay: !0,
				margin: 30,
				responsive: {
					0: { items: 1, nav: !1 },
					600: { items: 3, nav: !1 },
					1e3: { items: 4, nav: !1, loop: !0 },
				},
			}),
			e(".time-countdown").length &&
				e(".time-countdown").each(function () {
					var a = e(this),
						s = e(this).data("countdown");
					a.countdown(s, function (a) {
						e(this).html(
							a.strftime(
								'<div class="counter-column"><div class="inner"><span class="count">%D</span>Days</div></div> <div class="counter-column"><div class="inner"><span class="count">%H</span>Hours</div></div>  <div class="counter-column"><div class="inner"><span class="count">%M</span>Mins</div></div>  <div class="counter-column"><div class="inner"><span class="count">%S</span>Secs</div></div>'
							)
						);
					});
				}),
			e(".product-filters li").on("click", function () {
				e(".product-filters li").removeClass("active"),
					e(this).addClass("active");
				var a = e(this).attr("data-filter");
				e(".product-lists").isotope({ filter: a });
			}),
			e(".product-lists").isotope(),
			e(".popup-youtube").magnificPopup({
				disableOn: 700,
				type: "iframe",
				mainClass: "mfp-fade",
				removalDelay: 160,
				preloader: !1,
				fixedContentPos: !1,
			}),
			e(".image-popup-vertical-fit").magnificPopup({
				type: "image",
				closeOnContentClick: !0,
				mainClass: "mfp-img-mobile",
				image: { verticalFit: !0 },
			}),
			e(".homepage-slider").on("translate.owl.carousel", function () {
				e(".hero-text-tablecell .subtitle")
					.removeClass("animated fadeInUp")
					.css({ opacity: "0" }),
					e(".hero-text-tablecell h1")
						.removeClass("animated fadeInUp")
						.css({ opacity: "0", "animation-delay": "0.3s" }),
					e(".hero-btns")
						.removeClass("animated fadeInUp")
						.css({ opacity: "0", "animation-delay": "0.5s" });
			}),
			e(".homepage-slider").on("translated.owl.carousel", function () {
				e(".hero-text-tablecell .subtitle")
					.addClass("animated fadeInUp")
					.css({ opacity: "0" }),
					e(".hero-text-tablecell h1")
						.addClass("animated fadeInUp")
						.css({ opacity: "0", "animation-delay": "0.3s" }),
					e(".hero-btns")
						.addClass("animated fadeInUp")
						.css({ opacity: "0", "animation-delay": "0.5s" });
			}),
			e("#sticker").sticky({ topSpacing: 0 }),
			e(".main-menu").meanmenu({
				meanMenuContainer: ".mobile-menu",
				meanScreenWidth: "992",
			}),
			e(".search-bar-icon").on("click", function () {
				e(".search-area").addClass("search-active");
			}),
			e(".close-btn").on("click", function () {
				e(".search-area").removeClass("search-active");
			});
	}),
		jQuery(window).on("load", function () {
			jQuery(".loader").fadeOut(1e3);
		});
})();
