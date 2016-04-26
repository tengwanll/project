$(document).ready(function() {

	// 画面切换
	$(document).on('click', '.cat li', function (e) {
		e.preventDefault();
		var _index = $('.cat li').index(this);
		$(this).parent().find('.active').removeClass('active');
		$(this).addClass('active');

		$('.list.active').removeClass('active');
		$($('.list')[_index]).addClass('active');
	});
});