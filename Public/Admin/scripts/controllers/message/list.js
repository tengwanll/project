define(['app'], function(app) {
    app.controller('MessageListCtrl', ['$scope', '$rootScope', '$state', 'httpRequest',
        function($scope, $rootScope, $state, httpRequest) {
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
                        view: '查看',
                        delete: '删除'
                    }
                }
            };


            // 添加
            $scope.add = function() {
                $state.go('messageDetail', { status: 'add' });
            };

            // 查看
            $scope.view = function(id) {
                $state.go('messageDetail', { status: 'view', _id: id });
            };

            // 修改
            $scope.edit = function(id) {
                $state.go('messageDetail', { status: 'edit', _id: id });
            };

            // 删除
            $scope.delete = function(id) {};
        }
    ])
})
