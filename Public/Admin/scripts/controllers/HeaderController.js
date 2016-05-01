define(['app'], function(app) {
    app.controller('HeaderController', ['$scope', '$http', function($scope, $http) {
        // 短消息
        // $http.get()

        // 退出登录
        $scope.logout = function() {
            $http.get('/Admin/admin/logout').then(function(res) {
                if (res.data.errno === 0) {
                    window.location.href = "/Admin/Index/login.html";
                }
            });
        }

        // 更改密码
        $scope.uploadPassword = function() {

        };
    }]);

});
