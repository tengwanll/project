// 招聘
define(['app'], function(app) {
    app.controller('JobsController', ['$scope', '$http', 'httpRequest',
        function($scope, $http, httpRequest) {
            // 招聘 相关 数据
            $scope.jobsDatas = {
                list: []
            };


            // 初始化
            init();


            // 初始化界面
            function init() {
                httpRequest.get({
                    api: '/Admin/jobs/lists',
                    success: function(result) {
                        $scope.jobsDatas.list = result.jobList;
                    }
                });
            }
        }
    ])
});
