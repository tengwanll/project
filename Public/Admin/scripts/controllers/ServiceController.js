define(['app'], function(app) {
    app.controller('ServiceController', ['$scope', '$http', '$state', '$rootScope', function($scope, $http, $state, $rootScope) {
        // 服务模块所有数据
        $scope.serviceDatas = {
            list: [],
            topSort: 0, // 0 普通服务， 1 特色服务
            sort: [],
            currentPage: 1,
            pageLen: 20,
            listTotal: 0,
            newData: {},
            state: 0, // 0: 添加 1: 查看 2. 修改
        };

        // 获取列表数据
        $scope.getListDatas = function(cb) {
            $http.get('/Admin/service/serviceList/rows/' + $scope.pageLen + '/page/' + $scope.serviceDatas.currentPage).then(function(res) {
                $scope.serviceDatas.list = res.data.result.serviceList;
                $scope.serviceDatas.listTotal = res.data.result.total;
            });
        }

        // 初始化界面
        $scope.getListDatas();


        // 获取分类数据
        $http.get('/Admin/service/sortList').then(function(res) {
            $scope.serviceDatas.sort = res.data.result;
        });


        // 换页
        $scope.changePage = function(type) {
            if (type === 'next') {
                $scope.serviceDatas.currentPage++;
            } else if (type === 'prev') {
                $scope.serviceDatas.currentPage--;
            }
            $scope.getListDatas(function() {

            });
        };

        // 筛选查看
        $scope.sortList = function() {

        };

        // 删除服务
        $scope.deleteService = function(_id) {
            var postData = { serviceId: _id };
            $http.post('/Admin/service/delete', postData).then(function (res) {
            });
        };

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
    }])
});
