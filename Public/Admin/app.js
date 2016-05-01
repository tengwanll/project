define(['angular', 'uiRouter'], function(angular) {
    var app = angular.module('admin', ['ui.router'])
        .controller('MainController', ['$scope', '$http', function($scope, $http) {
            // 所有数据
            $scope.mainDatas = {
                menu: [
                    { name: '首页', state: 'index' },
                    { name: '服务管理', state: 'service' },
                    { name: '职员管理', state: 'employee' },
                    { name: '活动管理', state: 'activity' },
                    { name: '新闻管理', state: 'news' },
                    { name: '招聘管理', state: 'jobs' },
                    { name: '留言管理', state: 'message' },
                    { name: '实验室', state: 'pics' },
                    { name: '公司信息', state: 'info' },
                    { name: '系统设置', state: 'setting' }
                ],
                currentMenu: 0
            };

            // 初始化菜单激活状态
            $scope.mainDatas.menu.map(function(item, index, arr) {
                if (item.state === window.location.hash.split('/')[1]) {
                    $scope.mainDatas.currentMenu = index;
                }
            });

            // 短消息
            // $http.get()

            // 退出登录
            $scope.logout = function() {
                if (confirm("确认退出？")) {
                    $http.get('/Admin/admin/logout').then(function(res) {
                        if (res.data.errno === 0) {
                            window.location.href = "/Admin/Index/login.html";
                        }
                    });
                };
            }

            // 更改密码
            $scope.uploadPassword = function() {

            };

            // 更改菜单
            $scope.changeMenu = function($index) {
                $scope.mainDatas.currentMenu = $index;
            };

        }])

    return app;
});
