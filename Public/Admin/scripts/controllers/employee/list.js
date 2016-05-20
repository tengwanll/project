define(['app'], function(app) {
    app.controller('EmployeeListCtrl', ['$scope', '$rootScope', '$state', '$http', 'httpRequest',
        function($scope, $rootScope, $state, $http, httpRequest) {
            // 职员模块所有数据
            $scope.employeeListDatas = {
                config: {
                    th: [
                        { name: { name: '姓名' }, key: 'name' },
                        { position: { name: '职位' }, key: 'position' },
                        { createTime: { name: '创建时间' }, key: 'createTime' },
                    ],
                    currentPage: 1,
                    rows: $rootScope.rows,
                    listApi: '/Admin/employee/employeeList',
                    action: {
                        search: '搜索',
                        sort: '筛选',
                        add: '添加',
                        view: '查看',
                        edit: '编辑',
                        delete: '删除'
                    }
                }
            };


            // 添加
            $scope.add = function () {
                $state.go('employeeDatail', {status: 'add'});
            };

            // 查看
            $scope.view = function (id) {
                $state.go('employeeDatail', {status: 'view', _id: id});
            };

            // 删除
            $scope.delete = function (id) {
            };

            // 修改
            $scope.edit = function (id) {
                $state.go('employeeDatail', {status: 'edit', _id: id});
            };

        }
    ])
});
