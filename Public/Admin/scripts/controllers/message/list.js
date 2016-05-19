define(['app'], function(app) {
    app.controller('messageListCtrl', ['$scope', '$rootScope', 'httpRequest',
        function($scope, $rootScope, httpRequest) {
            $scope.messageListDatas = {
                config: {
                    th: [
                        { name: { name: '联系人' }, key: 'name' },
                        { phone: { name: '电话' }, key: 'phone' },
                        { content: { name: '留言内容' }, key: 'content' },
                        { createTime: { name: '留言时间' }, key: 'createTime' },
                    ],
                    currentPage: 1,
                    rows: $rootScope.rows,
                    listApi: '/Admin/activity/lists',
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
            $scope.add = function() {
                $state.go('newsDetail', { status: 'add' });
            };

            // 查看
            $scope.view = function(id) {
                $state.go('newsDetail', { status: 'view', news_id: id });
            };

            // 修改
            $scope.edit = function(id) {
                $state.go('newsDetail', { status: 'edit', news_id: id });
            };

            // 删除
            $scope.delete = function(id) {};
        }
    ])
})
