define(['app'], function(app) {
    app.directive('photoset', ['httpRequest', function(httpRequest) {
        // Runs during compile
        return {
            // name: '',
            // priority: 1,
            // terminal: true,
            scope: {
            	ngModel: '='
            }, // {} = isolate, true = child, false/undefined = no change
            // controller: function($scope, $element, $attrs, $transclude) {},
            require: 'ngModel', // Array = multiple requires, ? = optional, ^ = check parent elements
            // restrict: 'A', // E = Element, A = Attribute, C = Class, M = Comment
            // template: '',
            templateUrl: './scripts/directives/photoset/photoset.html',
            // replace: true,
            // transclude: true,
            // compile: function(tElement, tAttrs, function transclude(function(scope, cloneLinkingFn){ return function linking(scope, elm, attrs){}})),
            link: function($scope, iElm, iAttrs, ngModelController) {
                var inputFile = $(iElm).find('input[type="file"]');

                $scope.photosetDatas = {
                	set: {
                		id: [],
                		url: [],
                	},
                };

                // 触发选择文件
                $scope.selectFile = function(e) {
                	e.preventDefault();
                    inputFile.click();
                };

                // 修改时的初始值
                // ngModelController.$formatters.push(function(modelValue) {
                //     if (modelValue) {
                //         $scope.uploaderDatas.state = "uploaded";
                //         $scope.uploaderDatas.srcs.push(modelValue);
                //     }
                // });

                // 监听文件变动
                inputFile.on('change', function(event) {
                    if (!event.target.files[0]) return;
                    // $scope.uploaderDatas.state = 'uploading';
                    var formData = new FormData();
                    formData.append('photo', event.target.files[0]);
                    httpRequest.upload({
                        data: formData,
                        success: function(result) {
                            // $scope.uploaderDatas.state = 'uploaded';
                            $scope.photosetDatas.set.url.push(result.url);
                            $scope.photosetDatas.set.id.push(result.id);
                            ngModelController.$setViewValue($scope.photosetDatas.set.id);

                            console.log($scope)
                        }
                    })
                });

            }
        };
    }]);
});
