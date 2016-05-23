define(['app'], function(app) {
    app.factory('notify', ['$rootScope', function($rootScope) {
    	var timelen = 3000;
    	$rootScope.notify = {};
    	return {
    		success: function (title, type) {
    			$rootScope.notify.success = {
    				show: true,
    				title: title,
    				type: type
    			};
    			setTimeout(function () {
    				$rootScope.notify.success.show = false;
    			}, timelen);
    		},
    		error: function (message) {
    			$rootScope.notify.error = {
    				show: true,
    				message: message
    			};
    			setTimeout(function () {
    				$rootScope.notify.error.show = false;
    			}, timelen);
    		}
    	};
    }])
});
