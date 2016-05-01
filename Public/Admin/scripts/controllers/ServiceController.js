define(['app'], function (app) {
	app.controller('ServiceController', ['$scope', '$http', function($scope, $http){
		// 服务模块所有数据
		$scope.serviceDatas = {
			list: []
		};

		// 获取列表数据
		$http.get('/Admin/service/serviceList').then(function (res) {
			$scope.serviceDatas.list = res.data.result.serviceList;
		});

		// 添加服务

		// 筛选查看
		$scope.sortList = function () {
			console.log(11)
		};
	}])
});