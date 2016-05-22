define(['app'], function(app) {
    app.controller('ServiceListCtrl', ['$scope', '$http', '$state', '$rootScope', '$stateParams', 'httpRequest',
        function($scope, $http, $state, $rootScope, $stateParams, httpRequest) {
            // 服务模块所有数据
            $scope.serviceListDatas = {
                config: {
                    th: [
                        { title: { name: '项目名称' }, key: 'title' },
                        { sortTitle: { name: '分类' }, key: 'sortTitle' },
                        { createTime: { name: '创建时间' }, key: 'createTime' },
                    ],
                    currentPage: 1,
                    rows: $rootScope.rows,
                    listApi: '/Admin/service/serviceList',
                    action: {
                        search: '搜索',
                        sort: '筛选',
                        add: '添加',
                        view: '查看',
                        edit: '编辑',
                        delete: '删除'
                    }
                }
            };

            // 添加
            $scope.add = function () {
                $state.go('serviceDatail', {status: 'add'});
            };

            // 查看
            $scope.view = function (id) {
                $state.go('serviceDatail', {status: 'view', _id: id});
            };

            // 删除
            $scope.delete = function (id) {
            };

            // 修改
            $scope.edit = function (id) {
                $state.go('serviceDatail', {status: 'edit', _id: id});
            };
        }
    ])
});
