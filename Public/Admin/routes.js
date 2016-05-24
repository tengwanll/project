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
            .state('serviceDetail', {
                url: '/service/status/:status/_id/:_id',
                templateUrl: baseurl + '/tpl/service/detail.html?t=' + Math.floor(Date.now() / 1000),
                controller: 'ServiceDetailctrl',
            })
            // 职员
            .state('employee', {
                url: '/employee',
                templateUrl: baseurl + '/tpl/employee/list.html?t=' + Math.floor(Date.now() / 1000),
                controller: 'EmployeeListCtrl',
                // resolve: loader("EmployeeController")
            })
            .state('employeeDetail', {
                url: '/employee/status/:status/_id/:_id',
                templateUrl: baseurl + '/tpl/employee/detail.html?t=' + Math.floor(Date.now() / 1000),
                controller: 'EmployeeDetailCtrl',
                // resolve: loader("EmployeeController")
            })
            // 活动
            .state('activity', {
                url: '/activity',
                templateUrl: baseurl + '/tpl/activity/list.html?t=' + Math.floor(Date.now() / 1000),
                controller: 'ActivityListCtrl',
                // resolve: loader("EmployeeController")
            })
            .state('activityDetail', {
                url: '/activity/status/:status/_id/:_id',
                templateUrl: baseurl + '/tpl/activity/detail.html?t=' + Math.floor(Date.now() / 1000),
                controller: 'ActivityDetailCtrl',
                // resolve: loader("EmployeeController")
            })
            // 新闻
            .state('news', {
                url: '/news',
                templateUrl: baseurl + '/tpl/news/list.html?t=' + Math.floor(Date.now() / 1000),
                controller: 'NewsListCtrl',
                // resolve: loader("NewsController")
            })
            .state('newsDetail', {
                url: '/news/status/:status/_id/:_id',
                templateUrl: baseurl + '/tpl/news/detail.html?t=' + Math.floor(Date.now() / 1000),
                controller: 'NewsDetailCtrl',
                // resolve: loader("NewsController")
            })
            // 招聘
            .state('job', {
                url: '/job',
                templateUrl: baseurl + '/tpl/job/list.html?t=' + Math.floor(Date.now() / 1000),
                controller: 'JobListCtrl',
                // resolve: loader("JobsController")
            })
            .state('jobDetail', {
                url: '/job/status/:status/_id/:_id',
                templateUrl: baseurl + '/tpl/job/detail.html?t=' + Math.floor(Date.now() / 1000),
                controller: 'JobDetailCtrl',
                // resolve: loader("JobsController")
            })
            // 留言
            .state('message', {
                url: '/message',
                templateUrl: baseurl + '/tpl/message/list.html?t=' + Math.floor(Date.now() / 1000),
                controller: 'MessageListCtrl',
                // resolve: loader("JobsController")
            })
            .state('messageDetail', {
                url: '/message/status/:status/_id/:_id',
                templateUrl: baseurl + '/tpl/message/detail.html?t=' + Math.floor(Date.now() / 1000),
                controller: 'MessageDetailCtrl',
                // resolve: loader("JobsController")
            })
            // 实验室
            .state('laboratory', {
                url: '/laboratory',
                templateUrl: baseurl + '/tpl/laboratory/list.html?t=' + Math.floor(Date.now() / 1000),
                controller: 'LaboratoryListCtrl',
                // resolve: loader("PicsController")
            })
            .state('laboratoryDetail', {
                url: '/laboratory/status/:status/_id/:_id',
                templateUrl: baseurl + '/tpl/laboratory/detail.html?t=' + Math.floor(Date.now() / 1000),
                controller: 'LaboratoryDetailCtrl',
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
