define(['app'], function(app) {
    app.directive('detail', ['$stateParams', '$state', '$http', 'httpRequest', 'notify',
        function($stateParams, $state, $http, httpRequest, notify) {
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
                        data: null,
                        sortDatas: [],
                        status: $stateParams.status || $state.current.name.split('.')[2],
                        _id: $stateParams._id,
                        type: 0,
                    };

                    // 初始化界面
                    switch ($scope.detailDatas.status) {
                        case 'add':
                            if ($scope.detailConfig.sort) getSortListDatas();
                            break;
                        case 'edit':
                            getDetailDatas($scope.detailDatas._id);
                            if ($scope.detailConfig.sort) {
                                getSortListDatas();
                            }
                            break;
                        case 'view':
                            getDetailDatas($scope.detailDatas._id);
                            break;
                        default:
                            console.error('状态有误：' + $scope.detailDatas.status);
                    }

                    // 获取详情数据
                    function getDetailDatas(_id) {
                        $scope.detailDatas.data = null;
                        var params = {};
                        if ($scope.detailDatas.status !== 'add') {
                            params._id = _id;
                        }
                        httpRequest.get({
                            api: $scope.detailConfig.api.view,
                            params: params,
                            success: function(data) {
                                $scope.detailDatas.data = data;
                                if ($scope.detailConfig.sort) $scope.detailDatas.type = data.type;
                                $scope.$broadcast('detailDataReady');
                            }
                        })
                    }

                    // 获取分组数据
                    function getSortListDatas() {
                        httpRequest.get({
                            api: $scope.detailConfig.api.sort,
                            success: function (data) {
                                $scope.detailDatas.sortDatas = data.result;
                            }
                        })
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
                        var postDatas = angular.copy($scope.detailDatas.data);

                        // 处理图片
                        if (postDatas.photo) postDatas.photo = postDatas.photo.id;

                        // 发送请求
                        httpRequest.post({
                            api: api,
                            data: postDatas,
                            success: function(result) {
                                alert('保存成功！');
                                $state.go($state.current.name.split('.')[0] + '.' + $state.current.name.split('.')[1]);
                            }
                        });
                    };

                    // 取消
                    $scope.cancel = function() {
                        $state.go($state.current.name.split('.')[0] + '.' + $state.current.name.split('.')[1]);
                    };

                    // 修改
                    $scope.edit = function() {
                        $state.go($state.current.name, { status: 'edit', _id: $scope.detailDatas._id });
                    };

                }
            };
        }
    ]);
})
