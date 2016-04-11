$(document).ready(function() {






	// 服务项目
	$(document).on('click', '.project .tabs li', function () {
		var _index = $('.project .tabs li').index(this);

		$('.project .infoList.active').removeClass('active');
		$($('.project .infoList')[_index]).addClass('active');
	});


	// 最新资讯
	$(document).on('click', '.news li', function () {
		$('.news .active').removeClass('active');
		$(this).addClass('active');
	});


});