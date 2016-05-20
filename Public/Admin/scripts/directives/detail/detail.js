define(['app'], function(app) {
    app.directive('detail', ['$stateParams', '$state', 'httpRequest',
        function($stateParams, $state, httpRequest) {
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
                        data: {},
                        status: $stateParams.status,
                        _id: $stateParams._id
                    };
                    // 初始化界面
                    switch ($scope.detailDatas.status) {
                        case 'add':
                            break;
                        case 'edit':
                            getDetailDatas($scope.detailDatas._id);
                            break;
                        case 'view':
                            getDetailDatas($scope.detailDatas._id);
                            break;
                        default:
                            console.error('状态有误！');
                    }

                    // 获取详情数据
                    function getDetailDatas(_id) {
                        httpRequest.get({
                            api: $scope.detailConfig.api.view,
                            params: { _id: _id },
                            success: function(data) {
                                $scope.detailDatas.data = data;
                            }
                        })
                    }

                    // 保存
                    $scope.save = function(e) {
                        console.log(e);
                    };

                    // 取消
                    $scope.cancel = function() {
                        $state.go($state.current.name.substr(0, $state.current.name.length - 6));
                    };

                    // 修改
                    $scope.edit = function() {
                    };
                }
            };
        }
    ]);
})
