define(['app'], function(app) {
    app.controller('InfoCtrl', ['$scope', function($scope) {
            $scope.infoDetailDatas = {
                config: {
                    content: [
                        { title: '标题', type: 'input', key: 'title'},
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
