define(['app'], function(app) {
    app.controller('CarouselListCtrl', ['$scope', '$rootScope',
        function($scope, $rootScope) {
            // 轮播图 所有数据
            $scope.carouselListDatas = {
                config: {
                    th: [
                        { title: { name: '名称' }, key: 'title' },
                        { type: { name: '链接类型' }, key: 'type' },
                        { type_id: { name: '链接标题' }, key: 'type_id' },
                        { description: { name: '备注' }, key: 'description' },
                    ],
                    currentPage: 1,
                    rows: $rootScope.rows,
                    listApi: '/Admin/carousel/lists',
                    deleteApi: '/Admin/carousel/delete',
                    action: {
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
