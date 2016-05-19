define(['app'], function(app) {
    app.directive('detail', ['$stateParams', 'httpRequest', function($stateParams, httpRequest) {
        // Runs during compile
        return {
            // name: '',
            // priority: 1,
            // terminal: true,
            // scope: {}, // {} = isolate, true = child, false/undefined = no change
            // controller: function($scope, $element, $attrs, $transclude) {},
            // require: 'ngModel', // Array = multiple requires, ? = optional, ^ = check parent elements
            restrict: 'E', // E = Element, A = Attribute, C = Class, M = Comment
            // template: '',
            templateUrl: './scripts/directives/detail/detail.html',
            // replace: true,
            // transclude: true,
            // compile: function(tElement, tAttrs, function transclude(function(scope, cloneLinkingFn){ return function linking(scope, elm, attrs){}})),
            link: function($scope, iElm, iAttrs, controller) {
                $scope.detailConfig = JSON.parse(iAttrs.detailConfig);
                $scope.detailDatas = {
                    status: $stateParams.status
                };
                console.log($scope.detailConfig)
                switch ($scope.detailDatas.status) {
                    case 'add':
                        break;
                    case 'edit':
                        break;
                    case 'view':
                        break;
                    default:
                        console.error('状态有误！');
                }


            }
        };
    }]);
})
