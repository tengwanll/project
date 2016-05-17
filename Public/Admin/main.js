require.config({
    paths: {
        'angular': '//cdn.bootcss.com/angular.js/1.5.0/angular.min',
        'jquery': '//cdn.bootcss.com/jquery/2.2.1/jquery.min',
        'bootstrap': '//cdn.bootcss.com/bootstrap/3.3.6/js/bootstrap',
        'uiRouter': '//cdn.bootcss.com/angular-ui-router/0.2.18/angular-ui-router.min',
        'app': './app',
        'routes': './routes',
        'MainController': './scripts/controllers/MainController',
        'IndexController': './scripts/controllers/IndexController',
        'ServiceController': './scripts/controllers/ServiceController',
        'EmployeeController': './scripts/controllers/EmployeeController',
        'ActivityController': './scripts/controllers/ActivityController',
        'NewsController': './scripts/controllers/NewsController',
        'JobsController': './scripts/controllers/JobsController',
        'PicsController': './scripts/controllers/PicsController',
        'InfoController': './scripts/controllers/InfoController',
        'SettingController': './scripts/controllers/SettingController',
        'wangEditor': './libs/wangeditor/js/wangEditor',
        'DataTables': './scripts/directives/DataTables/DataTables',
        'Detail': './scripts/directives/Detail/Detail',
    },
    shim: {
        'angular': {
            exports: 'angular',
        },
        'bootstrap': {
        	deps: ['jquery']
        },
        'uiRouter': {
            deps: ['angular'],
        },
        'angular-ui-router': {
            deps: ['angular'],
        },
        'wangEditor': {
            deps: ['jquery']
        }
    },
    deps: ['routes'],
    urlArgs: "bust=" + (new Date()).getTime() // debug:防止读写缓存
});

require([
        'angular',
        'jquery',
        'app',
        'bootstrap',
        'uiRouter',
        'routes',
        'MainController',
        'IndexController',
        'ServiceController',
        'EmployeeController',
        'ActivityController',
        'NewsController',
        'JobsController',
        'PicsController',
        'InfoController',
        'SettingController',
        'wangEditor',
        'DataTables',
        'Detail'
        ],
    function (angular, $) {
    	$(document).ready(function() {
    		angular.bootstrap(document, ['admin']);
    	});
    }
);