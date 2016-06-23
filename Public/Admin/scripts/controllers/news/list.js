// 新闻
define(['app'], function(app) {
    app.controller('NewsListCtrl', ['$scope', '$http', '$rootScope', '$state', 'httpRequest',
        function($scope, $http, $rootScope, $state, httpRequest) {
            $scope.newsDatas = {
                config: {
                    th: [
                        { title: { name: '标题' }, key: 'title' },
                        { shortDesc: { name: '摘要' }, key: 'shortDesc' },
                        { createTime: { name: '创建时间' }, key: 'createTime' },
                    ],
                    listApi: '/Admin/news/newsList',
                    deleteApi: '/Admin/news/delete',
                    action: {
                        search: '搜索',
                        add: '添加',
                        view: '查看',
                        edit: '编辑',
                        delete: '删除'
                    }
                }
            }
        }
    ])
});
