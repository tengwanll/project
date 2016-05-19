// 新闻
define(['app'], function(app) {
    app.controller('NewsController', ['$scope', '$http', '$rootScope', '$state', 'httpRequest',
        function($scope, $http, $rootScope, $state, httpRequest) {
            $scope.newsDatas = {
                config: {
                    th: [
                        { title: { name: '标题' }, key: 'title' },
                        { shortDesc: { name: '摘要' }, key: 'shortDesc' },
                        { createTime: { name: '创建时间' }, key: 'createTime' },
                    ],
                    currentPage: 1,
                    rows: $rootScope.rows,
                    listApi: '/Admin/news/newsList',
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
            }

            $scope.delete = function () {
                console.log(1)
            }
        }
    ])
});
