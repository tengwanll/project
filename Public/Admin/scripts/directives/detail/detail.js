define(['app'], function(app) {
    app.directive('detail', ['$stateParams', '$state', '$http', 'httpRequest',
        function($stateParams, $state, $http, httpRequest) {
            // Runs during compile
            return {
                // name: '',
                // priority: 1,
                // terminal: true,
                scope: {}, // {} = isolate, true = child, false/undefined = no change
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
                        sortDatas: [],
                        status: $stateParams.status,
                        _id: $stateParams._id
                    };
                    // 初始化界面
                    switch ($scope.detailDatas.status) {
                        case 'add':
                            // getSortListDatas();
                            break;
                        case 'edit':
                            getDetailDatas($scope.detailDatas._id);
                            // getSortListDatas();
                            break;
                        case 'view':
                            getDetailDatas($scope.detailDatas._id);
                            break;
                        default:
                            console.error('状态有误！');
                    }

                    // 获取详情数据
                    function getDetailDatas(_id) {
                        var params = {};
                        if ($scope.detailDatas.status !== 'add' ) {
                            params._id = _id;
                        }
                        httpRequest.get({
                            api: $scope.detailConfig.api.view,
                            params: params,
                            success: function(data) {
                                $scope.detailDatas.data = data;
                            }
                        })
                    }

                    // 获取分组数据
                    function getSortListDatas() {
                        $http.get($scope.detailConfig.api.sort).then(function(res) {
                            $scope.detailDatas.sortDatas = res.data.result;
                        });
                    }


                    // 保存
                    $scope.save = function(e) {
                        $(e.target).html('保存中').addClass('disabled');
                        var api = '';
                        if ($scope.detailDatas.status === 'add') {
                            api = $scope.detailConfig.api.add;
                        } else if ($scope.detailDatas.status === 'edit') {
                            api = $scope.detailConfig.api.edit;
                        }

                        console.log($scope.detailDatas.data);
                    };

                    // 取消
                    $scope.cancel = function() {
                        $state.go($state.current.name.substr(0, $state.current.name.length - 6));
                    };

                    // 修改
                    $scope.edit = function() {
                        $state.go($state.current.name, {status: 'edit', _id: $scope.detailDatas._id});
                    };
                }
            };
        }
    ]);
})
