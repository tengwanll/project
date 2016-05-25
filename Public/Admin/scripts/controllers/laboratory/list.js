define(['app'], function(app) {
    app.controller('LaboratoryListCtrl', ['$scope', '$rootScope', '$state', '$http', 'httpRequest',
        function($scope, $rootScope, $state, $http, httpRequest) {
            // 招聘 相关 数据
            $scope.laboratoryListDatas = {
                config: {
                    th: [
                        { name: { name: '名称' }, key: 'name' },
                        { description: { name: '描述' }, key: 'description' },
                        { createTime: { name: '创建时间' }, key: 'createTime' },
                    ],
                    currentPage: 1,
                    rows: $rootScope.rows,
                    listApi: '/Admin/laboratory/lists',
                    deleteApi: '/Admin/laboratory/delete',
                    action: {
                        search: '搜索',
                        add: '添加',
                        view: '查看',
                        edit: '编辑',
                        delete: '删除'
                    }
                }
            };

        }
    ])
});
