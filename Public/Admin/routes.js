define(['app'], function(app) {
    return app.config(['$stateProvider', '$urlRouterProvider', function($stateProvider, $urlRouterProvider) {
        // $locationProvider.html5Mode(true);

        var baseurl = "/Public/Admin";
        $urlRouterProvider.otherwise('/');

        var loader = function(ctrlName) {
            return {
                loadCtrl: ["$q", function($q) {
                    var deferred = $q.defer();
                    require(['./scripts/controllers/' + ctrlName], function() {
                        deferred.resolve();
                    });
                    return deferred.promise;
                }]
            };
        };

        $stateProvider
            // 首页
            .state('index', {
                url: '/',
                templateUrl: baseurl + '/tpl/index/index.html',
                controller: 'IndexController',
                // resolve: loader("IndexController")
            })
            // 服务
            .state('service', {
                url: '/service',
                templateUrl: baseurl + '/tpl/service/list.html',
                controller: 'ServiceController',
                // resolve: loader("ServiceController")
            })
            .state('serviceAdd', {
                url: '/service/add',
                templateUrl: baseurl + '/tpl/service/detail.html',
                controller: 'ServiceController',
            })
            .state('serviceDatail', {
                url: '/service/detail',
                templateUrl: baseurl + '/tpl/service/detail.html',
                controller: 'ServiceController',
            })
            .state('serviceEdit', {
                url: '/service/edit',
                templateUrl: baseurl + '/tpl/service/detail.html',
                controller: 'ServiceController',
            })
            // .state('serviceDetail', {
            //     url: '/service/:type/:id',
            //     templateUrl: baseurl + '/tpl/'
            // })
            // 职员
            .state('employee', {
                url: '/employee',
                templateUrl: baseurl + '/tpl/employee/list.html',
                controller: 'EmployeeController',
                // resolve: loader("EmployeeController")
            })
            // 活动
            .state('activity', {
                url: '/activity',
                templateUrl: baseurl + '/tpl/activity/list.html',
                controller: 'ActivityController',
                // resolve: loader("ActivityController")
            })
            // 新闻
            .state('news', {
                url: '/news',
                templateUrl: baseurl + '/tpl/news/list.html',
                controller: 'NewsController',
                // resolve: loader("NewsController")
            })
            // 招聘
            .state('jobs', {
                url: '/jobs',
                templateUrl: baseurl + '/tpl/jobs/list.html',
                controller: 'JobsController',
                // resolve: loader("JobsController")
            })
            // 实验室
            .state('pics', {
                url: '/pics',
                templateUrl: baseurl + '/tpl/pics/list.html',
                controller: 'PicsController',
                // resolve: loader("PicsController")
            })
            // 公司信息
            .state('info', {
                url: '/info',
                templateUrl: baseurl + '/tpl/info/list.html',
                controller: 'InfoController',
                // resolve: loader("InfoController")
            })
            // 设置
            .state('setting', {
                url: '/setting',
                templateUrl: baseurl + '/tpl/setting/index.html',
                controller: 'SettingController',
                // resolve: loader("SettingController")
            })
    }])
});
