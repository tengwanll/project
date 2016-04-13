$(document).ready(function() {

	var navTime = null;

	// header nav
	$(document).on('mouseover', '.header nav > ul > li > a', function () {
		$(this).next().show();
	});

	$(document).on('mouseout', '.header nav > ul > li > a', function () {
		var list = $(this).next();
		navTime = setTimeout(function () {
			list.hide();
		}, 10);
	});

	$(document).on('mouseover', '.header nav > ul ul', function () {
		clearTimeout(navTime);
		$(this).show();
	});

	$(document).on('mouseout', '.header nav ul ul', function () {
		$(this).hide();
	});

});