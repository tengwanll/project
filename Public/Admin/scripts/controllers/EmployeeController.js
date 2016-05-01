define(['app'], function (app) {
    app.controller('EmployeeController', ['$scope', '$http', function($scope, $http){
        // 教职员数据
        $scope.employeeDatas = {
        	list: []
        };

        // 初始化数据
        $http.get('/Admin/employee/employeeList').then(function (res) {
        	$scope.employeeDatas.list = res.data.result.employeeList;
        })
    }])
});