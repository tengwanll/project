define(['app'], function(app) {
    app.controller('IndexController', ['$scope', '$rootScope', function($scope, $rootScope) {
        $scope.indexDatas = {
            config: {
            	content: [
            		{title: '标题', type: 'input', key: 'title'},
            		{title: '分类', type: 'sort', key: 'sort_id'},
            		{title: '项目简介', type: 'editor', key: ''},
            		{title: '实验流程', type: 'editor', key: ''},
            		{title: '用户需知', type: 'text'},
            		{title: '结果展示', type: 'editor'},
            		{title: '服务周期', type: 'editor'},
            	],
            }
        }
    }])
});
