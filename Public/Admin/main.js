require.config({
    paths: {
        'angular': '//cdn.bootcss.com/angular.js/1.5.0/angular.min',
        'jquery': '//cdn.bootcss.com/jquery/2.2.1/jquery.min',
        'bootstrap': '//cdn.bootcss.com/bootstrap/3.3.6/js/bootstrap',
        'angular-route': '//cdn.bootcss.com/angular.js/1.5.0/angular-route.min',
        'app': './app',
        'routes': './routes',
        'remodal': './libs/remodal/remodal.min',
    },
    shim: {
        'angular': {
            exports: 'angular',
        },
        'bootstrap': {
        	exports: 'bootstrap',
        	deps: ['jquery']
        },
        'angular-route': {
            deps: ['angular'],
            exports: 'angular-route'
        },
        'remodal': {
            deps: ['jquery'],
            exports: 'remodal'
        },
    },
    deps: ['routes']
    // urlArgs: "bust=" + (new Date()).getTime() // debug:防止读写缓存
});

require(['angular', 'jquery', 'app', 'bootstrap', 'angular-route', 'routes', 'remodal'],
    function (angular, $) {
    	$(document).ready(function() {
    		angular.bootstrap(document, ['admin']);
    	});
    }
);