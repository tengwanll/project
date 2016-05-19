define(['app'], function(app) {
    app.controller('ServiceDetailctrl', ['$scope', '$stateParams', '$http', 'httpRequest',
        function($scope, $stateParams, $http, httpRequest) {
            // 详情数据
            $scope.serviceDetailDatas = {
                    data: {},
                    sorts: [],
                    edit: true,
                    status: $stateParams.status || '',
                    _id: $stateParams._id || '',
                }

            // 初始化
            switch ($scope.serviceDetailDatas.status) {
                case 'add':
                    $scope.serviceDetailDatas.edit = true;
                    getSortList();
                    break;
                case 'edit':
                    $scope.serviceDetailDatas.edit = true;
                    getServiceDetailDatas($scope.serviceDetailDatas._id);
                    break;
                case 'view':
                    $scope.serviceDetailDatas.edit = false;
                    getServiceDetailDatas($scope.serviceDetailDatas._id);
                    break;
            }

            // 获取详情数据
            function getServiceDetailDatas(_id) {
                httpRequest.get({
                    api: '/Admin/service/detail',
                    params: { serviceId: _id },
                    success: function(data) {
                        $scope.serviceDetailDatas.data = data;
                    }
                })
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
            function getSortList() {
                $http.get('/Admin/service/sortList').then(function(res) {
                    $scope.serviceDetailDatas.sorts = res.data.result;
                })
            }
        }
    ])
})
