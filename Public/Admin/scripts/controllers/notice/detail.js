define(['app'], function(app) {
    app.controller('NoticeDetailCtrl', ['$scope', function($scope) {
            $scope.noticeDetailDatas = {
                config: {
                    content: [
                        { title: '内容(中文)', type: 'text', key: 'content'},
                        { title: '内容(英文)', type: 'text', key: 'englishContent'}
                    ],
                    api: {
                        add: '/Admin/notice/create',
                        view: '/Admin/notice/detail',
                        edit: '/Admin/notice/update',
                    }
                }
            };
        }
    ])
})
