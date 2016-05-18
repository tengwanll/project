define(['app'], function(app) {
    return app.config(['$stateProvider', '$urlRouterProvider', function($stateProvider, $urlRouterProvider) {
        // $locationProvider.html5Mode(true);

        var baseurl = "/Public/Admin";
        $urlRouterProvider.otherwise('/');

        $stateProvider
            // 首页
            .state('index', {
                url: '/',
                templateUrl: baseurl + '/tpl/index/index.html?t=' + Math.floor(Date.now() / 1000),
                controller: 'IndexController',
                // resolve: loader("IndexController")
            })
            // 服务
            .state('service', {
                url: '/service',
                templateUrl: baseurl + '/tpl/service/list.html?t=' + Math.floor(Date.now() / 1000),
                controller: 'ServiceListCtrl',
                // resolve: loader("ServiceController")
            })
            .state('serviceDatail', {
                url: '/service/status/:status/_id/:_id',
                templateUrl: baseurl + '/tpl/service/detail.html?t=' + Math.floor(Date.now() / 1000),
                controller: 'ServiceDetailctrl',
            })
            // .state('serviceDetail', {
            //     url: '/service/:type/:id',
            //     templateUrl: baseurl + '/tpl/'
            // })
            // 职员
            .state('employee', {
                url: '/employee',
                templateUrl: baseurl + '/tpl/employee/list.html?t=' + Math.floor(Date.now() / 1000),
                controller: 'EmployeeController',
                // resolve: loader("EmployeeController")
            })
            // 活动
            .state('activity', {
                url: '/activity',
                templateUrl: baseurl + '/tpl/activity/list.html?t=' + Math.floor(Date.now() / 1000),
                controller: 'ActivityController',
                // resolve: loader("ActivityController")
            })
            // 新闻
            .state('news', {
                url: '/news',
                templateUrl: baseurl + '/tpl/news/list.html?t=' + Math.floor(Date.now() / 1000),
                controller: 'NewsController',
                // resolve: loader("NewsController")
            })
            .state('newsAdd', {
                url: '/news/add',
                templateUrl: baseurl + '/tpl/news/detail.html?t=' + Math.floor(Date.now() / 1000),
                controller: 'NewsController',
                // resolve: loader("NewsController")
            })
            // 招聘
            .state('jobs', {
                url: '/jobs',
                templateUrl: baseurl + '/tpl/jobs/list.html?t=' + Math.floor(Date.now() / 1000),
                controller: 'JobsController',
                // resolve: loader("JobsController")
            })
            // 实验室
            .state('pics', {
                url: '/pics',
                templateUrl: baseurl + '/tpl/pics/list.html?t=' + Math.floor(Date.now() / 1000),
                controller: 'PicsController',
                // resolve: loader("PicsController")
            })
            // 公司信息
            .state('info', {
                url: '/info',
                templateUrl: baseurl + '/tpl/info/list.html?t=' + Math.floor(Date.now() / 1000),
                controller: 'InfoController',
                // resolve: loader("InfoController")
            })
            // 设置
            .state('setting', {
                url: '/setting',
                templateUrl: baseurl + '/tpl/setting/index.html?t=' + Math.floor(Date.now() / 1000),
                controller: 'SettingController',
                // resolve: loader("SettingController")
            })
    }])
});
