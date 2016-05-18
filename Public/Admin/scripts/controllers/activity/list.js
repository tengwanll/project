// 活动
define(['app'], function(app) {
    app.controller('ActivityController', ['$scope', '$http', 'httpRequest',
        function($scope, $http, httpRequest) {
            // 活动 所有数据
            $scope.activityDatas = {
                list: []
            };


            // 初始化
            init();



            // 初始化界面
            function init() {
                httpRequest.get({
                    api: '/Admin/Activity/lists',
                    success: function(result) {
                        $scope.activityDatas.list = result.activityList;
                    }
                })
            }

        }
    ])
});
