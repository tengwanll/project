define(['app'], function(app) {
    app.controller('JobDetailCtrl', ['$scope', function($scope) {
            $scope.jobDetailDatas = {
                config: {
                    content: [
                        { title: '实验室名称', type: 'input', key: 'lab'},
                        { title: '招聘职位', type: 'input', key: 'station'},
                        { title: '招聘人数', type: 'input', key: 'number'},
                        { title: '岗位要求', type: 'editor', key: 'demand'},
                    ],
                    api: {
                        add: '/Admin/jobs/create',
                        view: '/Admin/jobs/detail',
                        edit: '/Admin/jobs/update',
                    }
                }
            };

        }
    ])
})