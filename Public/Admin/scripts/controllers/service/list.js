define(['app'], function(app) {
    app.controller('ServiceListCtrl', ['$scope', '$http', '$state', '$rootScope', '$stateParams', 'httpRequest',
        function($scope, $http, $state, $rootScope, $stateParams, httpRequest) {
            // 服务模块所有数据
            $scope.serviceListDatas = {
                list: [],
                sorts: [],
                currentSort: 0,
                currentPage: $stateParams.page || 1,
                listTotal: 0,
            };

            // 初始化
            init();

            // 初始化界面
            function init() {
                getListDatas({ rows: $rootScope.rows, page: $scope.serviceListDatas.currentPage });
            }


            // 获取列表数据
            function getListDatas(params) {
                params = params || {};
                httpRequest.get({
                    api: '/Admin/service/serviceList',
                    params: params,
                    success: function(result) {
                        $scope.serviceListDatas.list = result.serviceList;
                        $scope.serviceListDatas.listTotal = result.total;
                    }
                })
            }

            // 换页
            $scope.changePage = function(type) {
                if (type === 'next') {
                    $scope.serviceListDatas.currentPage++;
                } else if (type === 'prev') {
                    $scope.serviceListDatas.currentPage--;
                }
                $scope.getListDatas(function() {

                });
            };

            // 删除服务
            $scope.deleteService = function(_id) {
                var postData = { serviceId: _id };
                httpRequest({
                    api: '/Admin/service/delete',
                    data: postData,
                    success: function () {
                        alert("删除成功！");
                    }
                })
            };
        }
    ])
});
