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
})
