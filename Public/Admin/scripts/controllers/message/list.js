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
                    listApi: '/Admin/feedback/lists',
                    deleteApi: '/Admin/feedback/delete',
                    action: {
                        search: '搜索',
                        view: '查看',
                        delete: '删除'
                    }
                }
            };
        }
    ])
})
