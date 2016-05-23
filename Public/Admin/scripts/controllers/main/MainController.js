define(['app'], function(app) {
    app.controller('MainController', ['$scope', '$http', '$rootScope', function($scope, $http, $rootScope) {
        // 所有数据
        $scope.mainDatas = {
            menu: [
                { name: '首页', state: 'index' },
                { name: '服务管理', state: 'service' },
                { name: '职员管理', state: 'employee' },
                { name: '活动管理', state: 'activity' },
                { name: '新闻管理', state: 'news' },
                { name: '招聘管理', state: 'job' },
                { name: '留言管理', state: 'message' },
                { name: '实验室展示', state: 'laboratory' },
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

        // 上传图片
        $rootScope.upload = function(event, cb) {
            var formData = new FormData();
            formData.append('photo', event.target.files[0]);
            $http({
                method: 'POST',
                url: '/Admin/admin/upload',
                headers: {
                    'Content-Type': undefined
                },
                data: formData
            }).then(function(res) {
                cb(res.data.result);
            });
        };

        // 分页
        $rootScope.rows = 20;

        // 加载画面
        $rootScope.loading = function() {
            $('#loading').show();
        };
        $rootScope.hideLoading = function() {
            $('#loading').hide();
        };
    }])
});