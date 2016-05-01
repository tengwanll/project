// 新闻
define(['app'], function (app) {
	app.controller('NewsController', ['$scope', '$http', function($scope, $http){
		// 新闻所有数据
		$scope.newsDatas = {
			list: []
		};

		// 获取新闻列表
		$http.get('/Admin/news/newsList').then(function (res) {
			$scope.newsDatas.list = res.data.result.newsList;
		})
	}])
});