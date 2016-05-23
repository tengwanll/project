define(['app'], function(app) {
    app.directive('datatable', ['$state', '$stateParams', 'httpRequest',
        function($state, $stateParams, httpRequest) {
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
                    $scope.listConfig = JSON.parse(attrs.listConfig);

                    $scope.page = {
                        current: 1,
                        total: 1,
                        pages: []
                    };

                    $scope.datatable = {
                        keyword: ''
                    };

                    getListDatas();

                    // 获取列表数据
                    function getListDatas(page, keyword) {
                        var set = true;
                        if (!page) {
                            page = $scope.page.current;
                            var set = false;
                        }
                        var params = { rows: $scope.listConfig.rows, page: page };
                        console.log(params);
                        console.log(keyword);
                        if (keyword) params.keyword = keyword;
                        httpRequest.get({
                            api: $scope.listConfig.listApi,
                            params: params,
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

                    // 搜索
                    $scope.search = function() {
                        console.log($scope);
                        getListDatas(1, $scope.datatable.keyword);
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
                    $scope.page.changeTo = function(num) {
                        getListDatas(num);
                    };

                    var detail = $state.current.name + 'Detail';

                    // 添加
                    $scope.add = function () {
                        $state.go(detail, {status: 'add'});
                    };

                    // 编辑
                    $scope.edit = function (id) {
                        $state.go(detail, {status: 'edit', _id: id});
                    };

                    // 查看
                    $scope.view = function (id) {
                        $state.go(detail, {status: 'view', _id: id});
                    };

                    // 删除
                    $scope.delete = function(id) {
                        if (confirm('确认删除？')) {
                            httpRequest.post({
                                api: $scope.newsDatas.listConfig.deleteApi,
                                data: { id: id },
                                success: function(result) {
                                    $state.reload();
                                }
                            });
                        }
                    };
                }
            };
        }
    ]);
})
