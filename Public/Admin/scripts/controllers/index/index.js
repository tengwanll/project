define(['app'], function(app) {
    app.controller('IndexController', ['$scope', 'httpRequest', function($scope, httpRequest) {

    	$scope.indexDatas = {
    		count: {}
    	}


    	getCount();








    	function getCount () {
    		httpRequest.get({
    			api: '/admin/flow/counts',
    			success: function (data) {
    				$scope.indexDatas.count = data;
    			}
    		});
    	}

    }])
});
