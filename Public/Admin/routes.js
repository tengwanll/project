define(['app', 'angular-route'], function(app) {
    app.config(['$routeProvider', '$locationProvider', function($routeProvider, $locationProvider) {
        // $locationProvider.html5Mode(true);
        var baseurl = "/Public/Admin"
        $routeProvider
            .when('/', {
                templateUrl: baseurl + '/tpl/index.tpl.html',
                controller: 'IndexController'
            })
            .when('/service', {
                templateUrl: baseurl + '/tpl/service.tpl.html',
                controller: 'ServiceController'
            })
            .when('/employee', {
                templateUrl: baseurl + '/tpl/employee.tpl.html',
                controller: 'EmployeeController'
            })
            .when('/activity', {
                templateUrl: baseurl + '/tpl/activity.tpl.html',
                controller: 'ActivityController'
            })
            .when('/news', {
                templateUrl: baseurl + '/tpl/news.tpl.html',
                controller: 'NewsController'
            })
            .when('/jobs', {
                templateUrl: baseurl + '/tpl/jobs.tpl.html',
                controller: 'JobsController'
            })
            .when('/pics', {
                templateUrl: baseurl + '/tpl/pics.tpl.html',
                controler: 'PicsController'
            })
            .when('/info', {
                templateUrl: baseurl + '/tpl/info.tpl.html',
                controler: 'InfoController'
            })
            .when('/setting', {
                templateUrl: baseurl + '/tpl/setting.tpl.html',
                controller: 'SettingController'
            })
            .otherwise({
                redirectTo: '/'
            });
    }])
});
