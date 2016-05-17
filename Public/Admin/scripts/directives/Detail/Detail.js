define(['app'], function (app) {
	app.directive('Detail', ['', function(){
		return {
			restrict: 'E',
			templateUrl: './Detail.tpl.html',
		};
	}]);
})