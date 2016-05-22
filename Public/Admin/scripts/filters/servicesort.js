define(['app'], function (app) {
	app.filter('servicesort', function () {
		return function (input) {
			if (input === '1') {
				return '普通服务';
			} else if (input === '2') {
				return '特色服务';
			}
		};
	});
});