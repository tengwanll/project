define(['app'], function(app) {
    app.controller('CarouselListCtrl', ['$scope', '$rootScope',
        function($scope, $rootScope) {
            // 轮播图 所有数据
            $scope.carouselListDatas = {
                config: {
                    th: [
                        { title: { name: '名称' }, key: 'title' },
                        { description: { name: '备注' }, key: 'description' },
                        { createTime: { name: '创建时间' }, key: 'createTime' },
                    ],
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
