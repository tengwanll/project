define(['app'], function(app) {
    app.controller('EmployeeController', ['$scope', '$http', 'httpRequest',
        function($scope, $http, httpRequest) {
            // 教职员数据
            $scope.employeeDatas = {
                list: []
            };

            // 初始化界面
            init();





            /**
             * 初始化
             */
            function init() {
                httpRequest.get({
                    api: '/Admin/employee/employeeList',
                    success: function(result) {
                        $scope.employeeDatas.list = result.employeeList;
                    }
                });
            }
        }
    ])
});
