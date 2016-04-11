$(document).ready(function() {
	// 切换页面
	$(document).on('click', '.main .news_header li', function () {
		var _index = $('.main .news_header li').index(this);

		$('.main .news_header .active').removeClass('active');
		$(this).addClass('active');

		$('.main .page.active').removeClass('active');
		$($('.main .page')[_index]).addClass('active');
	});


});