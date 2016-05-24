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
                    deleteApi: '/Admin/jobs/delete',
                    action: {
                        search: '搜索',
                        add: '添加',
                        view: '查看',
                        edit: '编辑',
                        delete: '删除'
                    }
                }
            };
        }
    ])
});
