$(document).ready(function() {


	$(document).on('click', '.news li', function () {
		$('.news .active').removeClass('active');
		$(this).addClass('active');
	});


});