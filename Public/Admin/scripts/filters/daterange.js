define(['app'], function (app) {
	app.filter('daterange', function () {
		return function (input) {
			if (input === 'today') {
				return '今天';
			} else if (input === 'month') {
				return '本月';
			} else if (input === 'year') {
				return '年度';
			}
		};
	});
});