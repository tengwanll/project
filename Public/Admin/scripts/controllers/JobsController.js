// 招聘
define(['app'], function (app) {
	app.controller('JobsController', ['$scope', '$http', function($scope, $http){
		// 招聘 相关 数据
		$scope.jobsDatas = {
			list: []
		};

		// 获取招聘列表数据
		$http.get('/Admin/jobs/lists').then(function (res) {
			$scope.jobsDatas.list = res.data.result.jobList;
		});
	}])
});