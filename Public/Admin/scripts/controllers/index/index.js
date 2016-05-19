define(['app'], function(app) {
    app.controller('IndexController', ['$scope', '$rootScope', function($scope, $rootScope) {
        $scope.submit = function() {};

        $scope.demo = "asdasd";

        $scope.test = function () {
        	alert('111');
        }

        $scope.indexDatas = {
            config: {
                th: [
                	{title: {name: "名称"}, key: 'title'},
                	{sortTitle: {name: "分类"}, key: 'sortTitle'},
                ],
                currentPage: 1,
                rows: $rootScope.rows,
                action: {
                    list: {
                        api: '/Admin/service/serviceList',
                    },
                	view: '查看',
                	edit: '编辑',
                	delete: '删除',
                	serach: '搜索',
                	sort: '排序'
                }
            }
        }
    }])
});
