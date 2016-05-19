define(['app'], function(app) {
    app.controller('EmployeeController', ['$scope', '$rootScope', '$http', 'httpRequest',
        function($scope, $rootScope, $http, httpRequest) {
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
                    header: {
                        search: '搜索',
                        sort: '排序',
                        add: '添加',
                    },
                    action: {
                        view: {
                            name: '查看',
                            sref: '',
                        },
                        edit: {
                            name: '编辑',
                            sref: '',
                        },
                        delete: {
                            name: '<b>asdasd</b>',
                            handle: 'delete'
                        }
                    }
                }
            };

        }
    ])
});
