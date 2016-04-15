$(document).ready(function() {






	// 服务项目切换
	$(document).on('click', '.project .tabs li', function (e) {
		e.preventDefault();
		var _index = $('.project .tabs li').index(this);

		$('.project .tabs .active').removeClass('active');
		$(this).addClass("active");
		$('.project .active').removeClass('active');
		$($('.project .infoList')[_index]).addClass('active');
	});


	// 最新资讯
	$(document).on('click', '.news li', function (e) {
		e.preventDefault();
		$('.news .active').removeClass('active');
		$(this).addClass('active');
	});



	// banner 自动切换
	var bannerIndex = 0;
	var bannerTime = setInterval(function () {
		if (bannerIndex === $('.banner_nav li').size()) {
			bannerIndex = 0;
		}

		$('.activity ul .active').removeClass('active');
		$($('.activity .banner_nav li')[bannerIndex]).addClass('active');
		$($('.activity .banner_info li')[bannerIndex]).addClass('active');

		bannerIndex++;
	}, 2000);

	// banner
	$(document).on('click', '.banner_nav a', function (e) {
		e.preventDefault();
		$(this).parent().siblings('.active').removeClass('active');
		$(this).parent().addClass('active');

		bannerIndex = $('.banner_nav li').index($(this).parent().get(0));

		$('.banner_info .active').removeClass('active');
		$($('.banner_info li')[bannerIndex]).addClass('active');
	});


});