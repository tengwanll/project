define(['angular', 'angular-route'], function(angular) {
    var app = angular.module('admin', ['ngRoute']);

    // 头部
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
        };

        // 更改密码
        $scope.uploadPassword = function() {};
    }]);

    // 侧边栏导航
    app.controller('SideBarController', ['$scope', function($scope){
        $scope.sideBarDatas = {
            menu: [
                {name: '首页', url: 'index'},
                {name: '服务', url: 'service'},
                {name: '职员', url: 'employee'},
                {name: '活动', url: 'activity'},
                {name: '新闻', url: 'news'},
                {name: '招聘', url: 'jobs'},
                {name: '图片', url: 'pics'},
                {name: '公司', url: 'info'},
                {name: '设置', url: 'setting'}
            ]
        };

        $scope.selectMenu = function () {
            console.log($(this).html())
        }
    }]);

    // 首页
    app.controller('IndexController', ['$scope', '$http', function($scope, $http) {}]);

    // 服务
    app.controller('ServiceController', ['$scope', '$http', function($scope, $http) {
        // 服务页面相关数据
        $scope.serviceDatas = {
            list: []
        };

        // 获取列表数据
        $http.get('/Admin/service/serviceList').then(function(res) {
            $scope.serviceDatas.list = res.data.result.serviceList;
        });

        // 添加服务项目
        $scope.addService = function() {};

        // 查看服务项目
        $scope.showService = function(id) {}

        // 查看服务项目
        $scope.editService = function(id) {}

        // 删除服务项目
        $scope.deleteService = function(id) {
        	if (confirm("确定删除？")) {
        		
        	}
        }
    }]);

    // 职员
    app.controller('EmployeeController', ['$scope', '$http', function($scope, $http) {
        // 教职员界面相关数据
        $scope.employeeDatas = {
            list: []
        };

        // 获取列表数据
        $http.get('/Admin/service/serviceList').then(function(res) {
            $scope.serviceDatas.list = res.data.result.serviceList;
        });

        // 添加服务项目
        $scope.addService = function() {
            console.log(111)
        };

        // 删除服务项目
        $scope.deleteService = function(id) {
            console.log(2222)
        }
    }]);

    // 活动
    app.controller('ActivityController', ['$scope', '$http', function($scope, $http) {
        // 教职员界面相关数据
        $scope.activityDatas = {
            list: []
        };

        // 获取列表数据
        $http.get('/Admin/activity/lists').then(function(res) {
            $scope.activityDatas.list = res.data.result.activityList;
        });

        // 添加服务项目
        $scope.addService = function() {
            console.log(111)
        };

        // 删除服务项目
        $scope.deleteService = function(id) {
            console.log(2222)
        }
    }]);

    // 新闻
    app.controller('NewsController', ['$scope', '$http', function($scope, $http) {
        // 新闻界面相关数据
        $scope.activityDatas = {
            list: []
        };

        // 获取列表数据
        $http.get('/Admin/activity/lists').then(function(res) {
            $scope.activityDatas.list = res.data.result.activityList;
        });

        // 添加服务项目
        $scope.addService = function() {
            console.log(111)
        };

        // 删除服务项目
        $scope.deleteService = function(id) {
            console.log(2222)
        }
    }]);

    // 招聘
    app.controller('JobsController', ['$scope', '$http', function($scope, $http) {}]);

    // 图片
    app.controller('PicsController', ['$scope', '$http', function($scope, $http) {}]);

    // 公司
    app.controller('InfoController', ['$scope', '$http', function($scope, $http) {}]);
    // 设置
    app.controller('SettingController', ['$scope', '$http', function($scope, $http) {}]);

    return app;
});
