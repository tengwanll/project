// 招聘
define(['app'], function(app) {
    app.controller('JobsController', ['$scope', '$rootScope', '$http', 'httpRequest',
        function($scope, $rootScope, $http, httpRequest) {
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
                    header: {
                        search: '搜索',
                        sort: '排序',
                        add: '添加',
                    },
                    action: {
                        view: {
                            name: '查看',
                            sref: '',
                        },
                        edit: {
                            name: '编辑',
                            sref: '',
                        },
                        delete: {
                            name: '<b>asdasd</b>',
                            handle: 'delete'
                        }
                    }
                }
            };
        }
    ])
});
