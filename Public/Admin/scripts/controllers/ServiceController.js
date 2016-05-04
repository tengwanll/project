define(['app'], function(app) {
    app.controller('ServiceController', ['$scope', '$http', '$state', function($scope, $http, $state) {
        // 服务模块所有数据
        $scope.serviceDatas = {
            list: [],
            sort: [],
            newData: {},
            state: 0,	// 0: 添加 1: 查看 2. 修改
        };

        // 获取列表数据
        $http.get('/Admin/service/serviceList').then(function(res) {
            $scope.serviceDatas.list = res.data.result.serviceList;
        });

        // 获取分类数据
        $http.get('/Admin/service/sortList').then(function (res) {
        	$scope.serviceDatas.sort = res.data.result;
        })

        // 添加服务

        // 筛选查看
        $scope.sortList = function() {

        };

        // 详情界面
        if ($('#wangeditor').size() > 0) {
        	$scope.initEditor();
        }

        // 提交操作
        $scope.submit = function () {
        	// 新增
        	if ($scope.serviceDatas.state === 0) {
        		$http.post('/Admin/service/create', $scope.serviceDatas.newData).then(function (res) {
        			if (res.result && res.result.id) {
        				alert("保存成功!");
        				$state.go('service');
        			}
        		});
        	}

        	// 修改
        	if ($scope.serviceDatas.state === 1) {

        	}
        }

    }])
});