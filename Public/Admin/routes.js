define(['app'], function(app) {
    return app.config(['$stateProvider', '$urlRouterProvider',
        function($stateProvider, $urlRouterProvider) {
        // $locationProvider.html5Mode(true);

        var baseurl = "/Public/Admin";
        $urlRouterProvider.otherwise('/index');

        var urlParams = '?t=' + Math.floor(Date.now() / 1000);

        $stateProvider
            // 界面框架
            .state('root', {
                abstract: true,
                url: '/',
                templateUrl: baseurl + '/tpl/main/main.html' + urlParams,
                controller: 'MainController',
            })


            // 首页
            .state('root.index', {
                url: 'index',
                templateUrl: baseurl + '/tpl/index/index.html?t=' + urlParams,
                controller: 'IndexController',
                // resolve: loader("IndexController")
            })


            // 服务
            .state('root.service', {
                url: 'service',
                templateUrl: baseurl + '/tpl/service/list.html' + urlParams,
                controller: 'ServiceListCtrl',
                // resolve: loader("ServiceController")
            })
            .state('root.service.add', {
                url: '/add',
                templateUrl: baseurl + '/tpl/service/detail.html' + urlParams,
                controller: 'ServiceDetailctrl',
            })
            .state('root.service.detail', {
                url: '/:status/:_id',
                templateUrl: baseurl + '/tpl/service/detail.html' + urlParams,
                controller: 'ServiceDetailctrl',
            })


            // 职员
            .state('root.employee', {
                url: 'employee',
                templateUrl: baseurl + '/tpl/employee/list.html' + urlParams,
                controller: 'EmployeeListCtrl',
                // resolve: loader("EmployeeController")
            })
            .state('root.employee.add', {
                url: '/add',
                templateUrl: baseurl + '/tpl/employee/detail.html' + urlParams,
                controller: 'EmployeeDetailCtrl',
                // resolve: loader("EmployeeController")
            })
            .state('root.employee.detail', {
                url: '/:status/:_id',
                templateUrl: baseurl + '/tpl/employee/detail.html' + urlParams,
                controller: 'EmployeeDetailCtrl',
                // resolve: loader("EmployeeController")
            })


            // 活动
            .state('root.activity', {
                url: 'activity',
                templateUrl: baseurl + '/tpl/activity/list.html' + urlParams,
                controller: 'ActivityListCtrl',
                // resolve: loader("EmployeeController")
            })
            .state('root.activity.add', {
                url: '/add',
                templateUrl: baseurl + '/tpl/activity/detail.html' + urlParams,
                controller: 'ActivityDetailCtrl',
                // resolve: loader("EmployeeController")
            })
            .state('root.activity.detail', {
                url: '/:status/:_id',
                templateUrl: baseurl + '/tpl/activity/detail.html' + urlParams,
                controller: 'ActivityDetailCtrl',
                // resolve: loader("EmployeeController")
            })


            // 新闻
            .state('root.news', {
                url: 'news',
                templateUrl: baseurl + '/tpl/news/list.html' + urlParams,
                controller: 'NewsListCtrl',
                // resolve: loader("NewsController")
            })
            .state('root.news.add', {
                url: '/add',
                templateUrl: baseurl + '/tpl/news/detail.html' + urlParams,
                controller: 'NewsDetailCtrl',
                // resolve: loader("NewsController")
            })
            .state('root.news.detail', {
                url: '/:status/:_id',
                templateUrl: baseurl + '/tpl/news/detail.html' + urlParams,
                controller: 'NewsDetailCtrl',
                // resolve: loader("NewsController")
            })


            // 招聘
            .state('root.job', {
                url: 'job',
                templateUrl: baseurl + '/tpl/job/list.html' + urlParams,
                controller: 'JobListCtrl',
                // resolve: loader("JobsController")
            })
            .state('root.job.add', {
                url: '/add',
                templateUrl: baseurl + '/tpl/job/detail.html' + urlParams,
                controller: 'JobDetailCtrl',
                // resolve: loader("JobsController")
            })
            .state('root.job.detail', {
                url: '/:status/:_id',
                templateUrl: baseurl + '/tpl/job/detail.html' + urlParams,
                controller: 'JobDetailCtrl',
                // resolve: loader("JobsController")
            })


            // 留言
            .state('root.message', {
                url: 'message',
                templateUrl: baseurl + '/tpl/message/list.html' + urlParams,
                controller: 'MessageListCtrl',
                // resolve: loader("JobsController")
            })
            .state('root.message.add', {
                url: '/add',
                templateUrl: baseurl + '/tpl/message/detail.html' + urlParams,
                controller: 'MessageDetailCtrl',
                // resolve: loader("JobsController")
            })
            .state('root.message.detail', {
                url: '/:status/:_id',
                templateUrl: baseurl + '/tpl/message/detail.html' + urlParams,
                controller: 'MessageDetailCtrl',
                // resolve: loader("JobsController")
            })


            // 实验室
            .state('root.laboratory', {
                url: 'laboratory',
                templateUrl: baseurl + '/tpl/laboratory/list.html' + urlParams,
                controller: 'LaboratoryListCtrl',
                // resolve: loader("PicsController")
            })
            .state('root.laboratory.add', {
                url: '/add',
                templateUrl: baseurl + '/tpl/laboratory/detail.html' + urlParams,
                controller: 'LaboratoryDetailCtrl',
                // resolve: loader("PicsController")
            })
            .state('root.laboratory.detail', {
                url: '/:status/:_id',
                templateUrl: baseurl + '/tpl/laboratory/detail.html' + urlParams,
                controller: 'LaboratoryDetailCtrl',
                // resolve: loader("PicsController")
            })


            // 轮播图
            .state('root.carousel', {
                url: 'carousel',
                templateUrl: baseurl + '/tpl/carousel/list.html' + urlParams,
                controller: 'CarouselListCtrl',
                // resolve: loader("PicsController")
            })
            .state('root.carousel.add', {
                url: '/add',
                templateUrl: baseurl + '/tpl/carousel/detail.html' + urlParams,
                controller: 'CarouselDetailCtrl',
                // resolve: loader("PicsController")
            })
            .state('root.carousel.detail', {
                url: '/:status/:_id',
                templateUrl: baseurl + '/tpl/carousel/detail.html' + urlParams,
                controller: 'CarouselDetailCtrl',
                // resolve: loader("PicsController")
            })


            // 公司信息
            .state('root.info', {
                url: 'info',
                templateUrl: baseurl + '/tpl/info/info.html' + urlParams,
                controller: 'InfoCtrl',
                // resolve: loader("InfoController")
            })
            // 设置
            .state('root.setting', {
                url: 'setting',
                templateUrl: baseurl + '/tpl/setting/index.html' + urlParams,
                controller: 'SettingController',
                // resolve: loader("SettingController")
            })
    }])
});
