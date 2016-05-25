define(['app'], function(app) {
    app.controller('EmployeeDetailCtrl', ['$scope', function($scope) {
            $scope.employeeDetailDatas = {
                config: {
                    content: [
                        { title: '姓名', type: 'input', key: 'name'},
                        { title: '职位', type: 'input', key: 'position'},
                        { title: 'email', type: 'input', key: 'email'},
                        { title: '电话', type: 'input', key: 'telephone'},
                        { title: '头像', type: 'photo', key: 'photo'},
                        { title: '简介', type: 'editor', key: 'description'},
                        { title: '研究方向', type: 'editor', key: 'study'},
                        { title: '文献', type: 'editor', key: 'thesis'},
                    ],
                    api: {
                        add: '/Admin/employee/createEmployee',
                        view: '/Admin/employee/employeeDetail',
                        edit: '/Admin/employee/updateEmployee',
                    }
                }
            }
        }
    ])
})
