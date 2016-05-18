define(['app'], function(app) {
    app.controller('ServiceDetailctrl', ['$scope','$stateParams', '$http',
        function($scope, $stateParams, $http) {
        	// 详情数据
        	$scope.serviceDetailDatas = {
        		info: {},
        		sorts: [],
        	}
        	// 初始化
        	if ($stateParams.status === 'add') {
        		// 添加状态
        		getSortList();
        	} else if ($stateParams.status === 'edit') {
        		// 编辑状态
        	} else if ($stateParams.status === 'detail') {
        		// 查看状态
        	}

            // 提交操作
            $scope.submit = function() {
                // 新增
                if ($scope.serviceDatas.state === 0) {
                    $http.post('/Admin/service/create', $scope.serviceDatas.newData).then(function(res) {
                        if (res.data.result) {
                            alert("保存成功!");
                            $state.go('service');
                        }
                    });
                }

                // 修改
                if ($scope.serviceDatas.state === 1) {}
            }

            // 上传图片
            $scope.uploadImg = function(event, type) {
                $rootScope.upload(event, function(id) {
                    $scope.serviceDatas.newData[type] = id;
                });
            };

            // 获取分类
            function getSortList () {
            	$http.get('/Admin/service/sortList').then(function (res) {
            		$scope.serviceDetailDatas.sorts = res.data.result;
            	})
            }
        }
    ])
})
