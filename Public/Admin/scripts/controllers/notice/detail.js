define(['app'], function(app) {
    app.controller('NoticeDetailCtrl', ['$scope', function($scope) {
            $scope.newsDetailDatas = {
                config: {
                    content: [
                        { title: '内容', type: 'input', key: 'title'},
                        { title: '封面', type: 'photo', key: 'photo'},
                        { title: '简介', type: 'text', key: 'shortDesc'},
                        { title: '详情', type: 'editor', key: 'content'},
                    ],
                    api: {
                        add: '/Admin/news/create',
                        view: '/Admin/news/detail',
                        edit: '/Admin/news/update',
                    }
                }
            };
        }
    ])
})
