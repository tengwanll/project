define(['app'], function(app) {
    app.controller('ActivityDetailCtrl', ['$scope', function($scope) {
            $scope.activityDetailDatas = {
                config: {
                    content: [
                        { title: '标题', type: 'input', key: 'title'},
                        { title: '封面', type: 'photo', key: 'photo'},
                        { title: '简介', type: 'text', key: 'shortDesc'},
                        { title: '活动详情', type: 'editor', key: 'content'},
                    ],
                    api: {
                        add: '/Admin/activity/create',
                        view: '/Admin/activity/detail',
                        edit: '/Admin/activity/update',
                    }
                }
            }
        }
    ])
})
