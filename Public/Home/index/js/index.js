$(document).ready(function() {


	// 服务项目切换
	$(document).on('click', '.project .tabs li', function (e) {
		e.preventDefault();
		var _index = $('.project .tabs li').index(this);

		$('.project .tabs .active').removeClass('active');
		$(this).addClass("active");
		$('.project .infoList.active').removeClass('active');
		$($('.project .infoList')[_index]).addClass('active');
	});


	// 最新资讯
	$(document).on('click', '.news ol li', function (e) {
		$('.news ol .active').removeClass('active');
		$(this).addClass('active');
	});


});