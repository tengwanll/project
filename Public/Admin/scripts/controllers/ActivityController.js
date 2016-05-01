// 活动
define(['app'], function (app) {
    app.controller('ActivityController', ['$scope', '$http', function($scope, $http){
    	// 活动 所有数据
    	$scope.activityDatas = {
    		list: []
    	};

    	// 获取活动数据
    	$http.get('/Admin/Activity/lists').then(function (res) {
    		$scope.activityDatas.list = res.data.result.activityList;
    	});

    }])
});