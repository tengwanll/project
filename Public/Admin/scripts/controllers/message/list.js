define(['app'], function(app) {
    app.controller('MessageController', ['$scope', 'httpRequest',
        function($scope, httpRequest) {
        	$scope.messageDatas = {
        		list: []
        	};


        	// 初始化
        	init();

        	// 初始化界面
        	function init () {
        		httpRequest.get({
        			api: '',
        			success: function (result) {
        				$scope.messageDatas.list = result.data;
        			}
        		})
        	}
        }
    ])
})
