require.config({
    paths: {
        // 三方
        // 'angular': '//cdn.bootcss.com/angular.js/1.5.0/angular.min',
        'angular': '//cdn.bootcss.com/angular.js/1.5.0/angular',
        'jquery': '//cdn.bootcss.com/jquery/2.2.1/jquery.min',
        // 'uiRouter': '//cdn.bootcss.com/angular-ui-router/0.2.18/angular-ui-router.min',
        'uiRouter': '//cdn.bootcss.com/angular-ui-router/0.2.18/angular-ui-router',
        // sanitize
        'sanitize': '//cdn.bootcss.com/angular.js/1.5.5/angular-sanitize.min',
        'wangEditor': './libs/wangeditor/js/wangEditor',

        // 入口文件
        'app': './app',
        'routes': './routes',

        // 控制器
        'MainController': './scripts/controllers/main/MainController',
        'IndexController': './scripts/controllers/index/index',
        'ServiceListCtrl': './scripts/controllers/service/list',
        'ServiceDetailCtrl': './scripts/controllers/service/detail',
        'EmployeeListCtrl': './scripts/controllers/employee/list',
        'EmployeeDetailCtrl': './scripts/controllers/employee/detail',
        'ActivityListCtrl': './scripts/controllers/activity/list',
        'ActivityDetailCtrl': './scripts/controllers/activity/detail',
        'NewsListCtrl': './scripts/controllers/news/list',
        'NewsDetailCtrl': './scripts/controllers/news/detail',
        'JobListCtrl': './scripts/controllers/job/list',
        'JobDetailCtrl': './scripts/controllers/job/detail',
        'MessageListCtrl': './scripts/controllers/message/list',
        'MessageListDetail': './scripts/controllers/message/detail',
        'LaboratoryListCtrl': './scripts/controllers/laboratory/list',
        'LaboratoryDetailCtrl': './scripts/controllers/laboratory/detail',
        'InfoController': './scripts/controllers/info/info',
        'SettingController': './scripts/controllers/setting/setting',
        'CarouselListCtrl': './scripts/controllers/carousel/list',
        'CarouselDetailCtrl': './scripts/controllers/carousel/detail',

        // 指令
        'dataTable': './scripts/directives/datatable/datatable',
        'detail': './scripts/directives/detail/detail',
        'editor': './scripts/directives/editor/editor',
        'uploader': './scripts/directives/uploader/uploader',
        'photoset': './scripts/directives/photoset/photoset',

        // 过滤器
        'serviceSort': './scripts/filters/servicesort',
        'sce': './scripts/filters/sce',
        'tartype': './scripts/filters/tartype',

        // 服务
        'httpRequest': './scripts/services/httpRequest',
        'notify': './scripts/services/notify',


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
        'sanitize': {
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
    deps: ['routes'],
    urlArgs: "bust=" + (new Date()).getTime() // debug:防止读写缓存
});

require([
        // 三方
        'angular', 'jquery', 'uiRouter', 'sanitize', 'wangEditor',

        // 入口文件
        'app', 'routes',

        // 控制器
        'MainController', 'IndexController', 'ServiceListCtrl', 'ServiceDetailCtrl',
        'EmployeeListCtrl', 'EmployeeDetailCtrl', 'ActivityListCtrl', 'ActivityDetailCtrl',
        'NewsListCtrl', 'NewsDetailCtrl', 'JobListCtrl', 'JobDetailCtrl', 'MessageListCtrl', 'MessageListDetail',
        'LaboratoryListCtrl', 'LaboratoryDetailCtrl', 'InfoController', 'SettingController', 'CarouselListCtrl', 'CarouselDetailCtrl',

        // 指令
        'dataTable', 'detail', 'editor', 'uploader', 'photoset',

        // 过滤器
        'serviceSort', 'sce', 'tartype',

        // 服务
        'httpRequest', 'notify',
    ],
    function(angular, $) {
        $(document).ready(function() {
            angular.bootstrap(document, ['admin']);
        });
    }
);
