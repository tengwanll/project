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
                    currentPage: 1,
                    rows: $rootScope.rows,
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

            // 添加
            $scope.add = function () {
                $state.go('newsDetail', {status: 'add'});
            };

            // 查看
            $scope.view = function (id) {
                $state.go('newsDetail', {status: 'view', _id: id});
            };

            // 删除
            $scope.delete = function (id) {
                if (confirm('确认删除？')) {
                    httpRequest.post({
                        api: $scope.newsDatas.config.deleteApi,
                        data: {id: id},
                        success: function (result) {
                            $state.reload();
                        }
                    });
                }
            };

            // 修改
            $scope.edit = function (id) {
                $state.go('newsDetail', {status: 'edit', _id: id});
            };
        }
    ])
});
