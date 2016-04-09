$(document).ready(function() {

	// header nav
	$(document).on('mouseover', '.header nav > ul > li > a', function () {
		$(this).next().show();
	});

	$(document).on('mouseout', '.header nav > ul > li', function () {
		$(this).find('ul').hide();
	});

});