require.config({
    paths: {
        // 三方
        'wangEditor': './libs/wangeditor/js/wangEditor',
        'angular': '//cdn.bootcss.com/angular.js/1.5.0/angular.min',
        'jquery': '//cdn.bootcss.com/jquery/2.2.1/jquery.min',
        'uiRouter': '//cdn.bootcss.com/angular-ui-router/0.2.18/angular-ui-router.min',

        // 入口文件
        'app': './app',
        'routes': './routes',

        // 控制器
        'MainController': './scripts/controllers/main/MainController',
        'IndexController': './scripts/controllers/index/index',
        'ServiceListController': './scripts/controllers/service/list',
        'ServiceDetailController': './scripts/controllers/service/detail',
        'EmployeeListController': './scripts/controllers/employee/list',
        'EmployeeDetailController': './scripts/controllers/employee/detail',
        'ActivityListController': './scripts/controllers/activity/list',
        'ActivityDetailController': './scripts/controllers/activity/detail',
        'NewsListController': './scripts/controllers/news/list',
        'NewsDetailController': './scripts/controllers/news/detail',
        'JobListController': './scripts/controllers/job/list',
        'JobDetailController': './scripts/controllers/job/detail',
        'MessageListCtrl': './scripts/controllers/message/list',
        'PicsListController': './scripts/controllers/pics/list',
        'PicsDetailController': './scripts/controllers/pics/detail',
        'InfoController': './scripts/controllers/info/info',
        'SettingController': './scripts/controllers/setting/setting',

        // 指令
        'dataTable': './scripts/directives/datatable/datatable',
        'Detail': './scripts/directives/Detail/Detail',
        'editor': './scripts/directives/editor/editor',

        // 服务
        'httpRequest': './scripts/services/httpRequest',


    },
    shim: {
        'angular': {
            exports: 'angular',
        },
        'bootstrap': {
            deps: ['jquery']
        },
        'uiRouter': {
            deps: ['angular']
        },
        'angular-ui-router': {
            deps: ['angular']
        },
        'wangEditor': {
            deps: ['jquery']
        },
        'routes': {
            deps: ['app']
        }
    },
    deps: ['app', 'routes'],
    urlArgs: "bust=" + (new Date()).getTime() // debug:防止读写缓存
});

require([
        'angular',
        'jquery',
        'app',
        'uiRouter',
        'routes',
        "MainController",
        "IndexController",
        "ServiceListController",
        "ServiceDetailController",
        "EmployeeListController",
        "EmployeeDetailController",
        "ActivityListController",
        "ActivityDetailController",
        "NewsListController",
        "NewsDetailController",
        "JobListController",
        "JobDetailController",
        'MessageListCtrl',
        "PicsListController",
        "PicsDetailController",
        "InfoController",
        "SettingController",
        'wangEditor',
        'dataTable',
        'editor',
        'httpRequest',
    ],
    function(angular, $) {
        $(document).ready(function() {
            angular.bootstrap(document, ['admin']);
        });
    }
);
