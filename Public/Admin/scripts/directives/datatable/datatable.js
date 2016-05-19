define(['app'], function(app) {
    app.directive('datatable', ['httpRequest', function(httpRequest) {
        return {
            // name: '',
            // priority: 1,
            // terminal: true,
            // scope: {}, // {} = isolate, true = child, false/undefined = no change
            // controller: function($scope, $element, $attrs, $transclude) {},
            // require: 'ngModel', // Array = multiple requires, ? = optional, ^ = check parent elements
            restrict: 'E',
            templateUrl: './scripts/directives/datatable/datatable.html',
            replace: true,
            // transclude: true,
            // compile: function(tElement, tAttrs, function transclude(function(scope, cloneLinkingFn){ return function linking(scope, elm, attrs){}})),
            link: function($scope, element, attrs) {
                console.log(attrs);
                $scope.listConfig = JSON.parse(attrs.listConfig);

                $scope.page = {
                    current: 1,
                    total: 1,
                    pages: []
                }

                getListDatas();

                // 获取列表数据
                function getListDatas(page) {
                    var set = true;
                    if (!page) {
                        page = $scope.page.current;
                        var set = false;
                    }
                    httpRequest.get({
                        api: $scope.listConfig.listApi,
                        params: { rows: $scope.listConfig.rows, page: page },
                        success: function(data) {
                            if (set) {
                                $scope.page.current = page;
                            }
                            $scope.listData = data.list;
                            $scope.page.total = parseInt(data.total / $scope.listConfig.rows) + 1;
                            if (true) {
                                $scope.page.pages = [];
                                for (var i = parseInt($scope.page.current / 10) * 10 + 1; i <= Math.min(parseInt($scope.page.current / 10 + 1) * 10, $scope.page.total); i++) {
                                    $scope.page.pages.push(i);
                                }
                            }
                        }
                    })
                }

                // 分页
                $scope.page.first = function() {
                    getListDatas(1);
                };
                $scope.page.last = function() {
                    getListDatas($scope.page.total);
                };
                $scope.page.prev = function() {
                    getListDatas($scope.page.current - 1);
                };
                $scope.page.next = function() {
                    getListDatas($scope.page.current + 1);
                };
                $scope.page.changeTo = function (num) {
                    getListDatas(num);
                };
            }
        };
    }]);
})
