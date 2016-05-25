define(['app'], function (app) {
	app.filter('tartype', function () {
		var toggle = {
			'service': '服务',
			'activity': '活动',
			'news': '新闻',
		};

		return function (value) {
			return toggle[value];
		};
	});
});