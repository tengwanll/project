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
                    listApi: '/Admin/activity/lists',
                    deleteApi: '/Admin/activity/delete',
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
