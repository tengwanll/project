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

        // 富文本编辑器
        $rootScope.initEditor = function() {
            // wangEditor.config.printLog = false;
            var editor = new wangEditor('wangeditor');
            editor.config.uploadImgFileName = 'photo';
            editor.config.uploadImgUrl = '/Admin/admin/upload';
            editor.config.menus = [
                // 'source',
                '|',
                'bold',
                'underline',
                'italic',
                // 'strikethrough',
                // 'eraser',
                // 'forecolor',
                // 'bgcolor',
                '|',
                'quote',
                'fontfamily',
                'fontsize',
                'head',
                'unorderlist',
                'orderlist',
                'alignleft',
                'aligncenter',
                'alignright',
                '|',
                'link',
                'unlink',
                'table',
                // 'emotion',
                '|',
                'img',
                // 'video',
                // 'location',
                // 'insertcode',
                '|',
                'undo',
                'redo',
                'fullscreen'
            ];
            // 自定义load事件
            editor.config.uploadImgFns.onload = function(resultText, xhr) {
                result = JSON.parse(resultText).result;
                editor.command(null, 'insertHtml', '<img src="' + result.substr(1) + '" style="max-width:100%;"/>');
            };
            editor.create();
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

        // 加载画面
        $rootScope.loading = function() {
            $('#loading').show();
        };
        $rootScope.hideLoading = function() {
            $('#loading').hide();
        };
        $rootScope.pageLoading = function() {
            $('#pageLoading').show();
            $('.mainView').css('overflow', 'hidden');
        };
        $rootScope.hidePageLoading = function() {
            $('#pageLoading').hide();
            $('.mainView').css('overflow', 'visible');
        };

    }])
});
