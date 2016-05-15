// 新闻
define(['app'], function(app) {
    app.controller('NewsController', ['$scope', '$http', '$rootScope', '$state', function($scope, $http, $rootScope, $state) {
        // 新闻所有数据
        $scope.newsDatas = {
            list: [],
            newData: {
                title: '',
                shortDesc: '',
                content: '',
                photo: ''
            },
        };


        // 不同状态的处理
        if ($state.is('news')) {
            init();
        } else if ($state.is('newsAdd')) {
            $rootScope.initEditor();
            $rootScope.hidePageLoading();
        }

        // 获取新闻列表
        function init() {
            $rootScope.pageLoading();
            $http.get('/Admin/news/newsList').then(function(res) {
                $scope.newsDatas.list = res.data.result.newsList;
                $rootScope.hidePageLoading();
            });
        }

        // 创建新闻
        $scope.createNews = function () {
        	$scope.newsDatas.newData.content = $('.wangEditor-txt').html();
        	$http.post('/Admin/news/create', $scope.newsDatas.newData).then(function (res) {
        		if (res.data.errno === 0) {
        			alert('添加成功!');
        			$state.go('news');
        		};
        	});
        };

        // 图片上传
        $scope.uploadImg = function (event, type) {
            $rootScope.upload(event, function(id) {
                $scope.newsDatas.newData[type] = id;
            });
        }
    }])
});
