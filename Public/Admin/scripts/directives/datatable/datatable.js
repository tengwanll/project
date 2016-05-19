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

                $scope.$watch('$scope.listConfig.currentPage', function() {
                    getListDatas();
                });

                // 获取列表数据
                function getListDatas() {
                    httpRequest.get({
                        api: $scope.listConfig.listApi,
                        params: { rows: $scope.listConfig.rows, page: $scope.listConfig.currentPage },
                        success: function(data) {
                            $scope.listData = data.list;
                        }
                    })
                }

                $scope.changePage = function() {
                    $scope.listConfig.currentPage++;
                }


            }
        };
    }]);
})
