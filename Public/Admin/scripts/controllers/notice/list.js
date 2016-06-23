define(['app'], function(app) {
    app.controller('NoticeListCtrl', ['$scope', '$rootScope', '$state',
        function($scope, $rootScope, $state) {
            $scope.noticeListDatas = {
                config: {
                    th: [
                        { content: { name: '内容' }, key: 'content' },
                        { createTime: { name: '发布时间' }, key: 'createTime' },
                    ],
                    listApi: '/Admin/notice/noticeList',
                    deleteApi: '/Admin/notice/delete',
                    action: {
                        view: '查看',
                        edit: '修改',
                        delete: '删除'
                    }
                }
            };
        }
    ])
})
