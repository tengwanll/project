define(['app'], function(app) {
    app.controller('ActivityController', ['$scope', '$rootScope', '$http', 'httpRequest',
        function($scope, $rootScope, $http, httpRequest) {
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
