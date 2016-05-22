define(['app'], function(app) {
    app.controller('ActivityListCtrl', ['$scope', '$rootScope', '$state', '$http', 'httpRequest',
        function($scope, $rootScope, $state, $http, httpRequest) {
            // 活动 所有数据
            $scope.activityListDatas = {
                config: {
                    th: [
                        { title: { name: '标题' }, key: 'title' },
                        { shortDesc: { name: '简介' }, key: 'shortDesc' },
                        { createTime: { name: '创建时间' }, key: 'createTime' },
                    ],
                    currentPage: 1,
                    rows: $rootScope.rows,
                    listApi: '/Admin/activity/lists',
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
                $state.go('activityDatail', {status: 'add'});
            };

            // 查看
            $scope.view = function (id) {
                $state.go('activityDatail', {status: 'view', _id: id});
            };

            // 删除
            $scope.delete = function (id) {
            };

            // 修改
            $scope.edit = function (id) {
                $state.go('activityDatail', {status: 'edit', _id: id});
            };
        }
    ])
});
