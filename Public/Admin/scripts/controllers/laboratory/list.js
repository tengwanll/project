define(['app'], function(app) {
    app.controller('laboratoryListCtrl', ['$scope', '$rootScope', '$http', 'httpRequest',
        function($scope, $rootScope, $http, httpRequest) {
            // 招聘 相关 数据
            $scope.laboratoryListDatas = {
                config: {
                    th: [
                        { name: { name: '名称' }, key: 'name' },
                        { discription: { name: '描述' }, key: 'discription' },
                        { createTime: { name: '创建时间' }, key: 'createTime' },
                    ],
                    currentPage: 1,
                    rows: $rootScope.rows,
                    listApi: '/Admin/laboratory/lists',
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
        }
    ])
});
