define(['app'], function(app) {
    app.controller('laboratoryListCtrl', ['$scope', '$rootScope', '$state', '$http', 'httpRequest',
        function($scope, $rootScope, $state, $http, httpRequest) {
            // 招聘 相关 数据
            $scope.laboratoryListDatas = {
                config: {
                    th: [
                        { name: { name: '名称' }, key: 'name' },
                        { discription: { name: '描述' }, key: 'discription' },
                        { createTime: { name: '创建时间' }, key: 'createTime' },
                    ],
                    currentPage: 1,
                    rows: $rootScope.rows,
                    listApi: '/Admin/laboratory/lists',
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
                $state.go('laboratoryDatail', {status: 'add'});
            };

            // 查看
            $scope.view = function (id) {
                $state.go('laboratoryDatail', {status: 'view', _id: id});
            };

            // 删除
            $scope.delete = function (id) {
            };

            // 修改
            $scope.edit = function (id) {
                $state.go('laboratoryDatail', {status: 'edit', _id: id});
            };
        }
    ])
});
