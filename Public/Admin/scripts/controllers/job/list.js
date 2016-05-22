define(['app'], function(app) {
    app.controller('JobListCtrl', ['$scope', '$rootScope', '$state', '$http', 'httpRequest',
        function($scope, $rootScope, $state, $http, httpRequest) {
            // 招聘 相关 数据
            $scope.jobListDatas = {
                config: {
                    th: [
                        { station: { name: '岗位' }, key: 'station' },
                        { lab: { name: '实验室' }, key: 'lab' },
                        { number: { name: '人数' }, key: 'number' },
                        { createTime: { name: '创建时间' }, key: 'createTime' },
                    ],
                    currentPage: 1,
                    rows: $rootScope.rows,
                    listApi: '/Admin/jobs/lists',
                    action: {
                        search: '搜索',
                        add: '添加',
                        view: '查看',
                        edit: '编辑',
                        delete: '删除'
                    }
                }
            };

            // 添加
            $scope.add = function () {
                $state.go('jobDatail', {status: 'add'});
            };

            // 查看
            $scope.view = function (id) {
                $state.go('jobDatail', {status: 'view', _id: id});
            };

            // 删除
            $scope.delete = function (id) {
            };

            // 修改
            $scope.edit = function (id) {
                $state.go('jobDatail', {status: 'edit', _id: id});
            };
        }
    ])
});
