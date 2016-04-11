$(document).ready(function() {


	$(document).on('click', '.header_nav a', function (e) {
		e.preventDefault();

		var _index = $('.header_nav a').index(this);

		$('.header_nav .active').removeClass('active');
		$($('.header_nav li')[_index + 1]).addClass('active');
		$($('.info.active')).removeClass('active');
		$($('.info')[_index]).addClass('active');
	});
});