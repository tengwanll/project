define(['app'], function (app) {
	app.filter('sce', ['$sce', function ($sce) {
		return function (value) {
			return $sce.trustAsHtml(value);
		};
	}]);
});