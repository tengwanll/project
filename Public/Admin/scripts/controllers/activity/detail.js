define(['app'], function(app) {
    app.controller('ActivityDetailctrl', ['$scope', '$stateParams', '$http', 'httpRequest',
        function($scope, $stateParams, $http, httpRequest) {
            $scope.activityDetailDatas = {
                config: {
                    content: [
                        { title: '标题', type: 'input', key: 'title'},
                        { title: '分类', type: 'sort', key: 'sortTitle'},
                        { title: '项目简介', type: 'editor', key: 'description'},
                        { title: '实验流程', type: 'editor', key: 'experimentFlow'},
                        { title: '用户需知', type: 'editor', key: 'userNotice' },
                        { title: '结果展示', type: 'editor', key: 'resultShow'},
                        { title: '服务周期', type: 'editor', key: 'serverCircle'},
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
