define(['app'], function(app) {
    app.controller('MainController', ['$scope', '$http', '$rootScope', '$state',
        function($scope, $http, $rootScope, $state) {
            // 所有数据
            $scope.mainDatas = {
                menu: [
                    { name: '首页', state: 'index' },
                    { name: '服务管理', state: 'service' },
                    { name: '职员管理', state: 'employee' },
                    { name: '活动管理', state: 'activity' }, {
                        name: '资讯管理',
                        children: [
                            { name: '新闻管理', state: 'news' },
                            { name: '公告管理', state: 'notice' }
                        ]
                    },
                    { name: '招聘管理', state: 'job' },
                    { name: '留言管理', state: 'message' }, {
                        name: '展现管理',
                        children: [
                            { name: '实验室展示', state: 'laboratory' },
                            { name: '轮播图管理', state: 'carousel' },
                        ]
                    },
                    { name: '公司信息', state: 'info' },
                    { name: '系统设置', state: 'setting' }
                ],
                currentState: [],
                currentStateIndex: -1,
                showChildMenuIndex: -1
            };

            // 初始化状态
            $scope.mainDatas.currentState = $state.current.name.split('.');

            // 初始化二级菜单和当前状态索引
            $scope.mainDatas.menu.map(function (item, index, arr) {
                if (item.children) {
                    item.children.map(function (_item, _index, _arr) {
                        if (_item.state === $scope.mainDatas.currentState[1]) {
                            $scope.mainDatas.showChildMenuIndex = index;
                        }
                    });
                }
            })

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

            // 更改菜单
            $scope.changeMenu = function(state, index) {
                console.log(arguments);
                $scope.mainDatas.currentState = $state.current.name.split('.');
                if (state) {
                    $scope.mainDatas.currentState[1] = state;
                    $scope.mainDatas.showChildMenuIndex = -1;
                    return;
                } else {
                    $scope.mainDatas.showChildMenuIndex = index;
                }
            };

            // 分页
            $rootScope.rows = 20;
        }
    ])
});
