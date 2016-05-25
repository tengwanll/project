define(['app'], function(app) {
    app.directive('uploader', ['$parse', 'httpRequest', function($parse, httpRequest) {
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
            restrict: 'E', // E = Element, A = Attribute, C = Class, M = Comment
            // template: '',
            templateUrl: './scripts/directives/uploader/uploader.html',
            // replace: true,
            // transclude: true,
            // compile: function(tElement, tAttrs, function transclude(function(scope, cloneLinkingFn){ return function linking(scope, elm, attrs){}})),
            link: function($scope, iElm, iAttrs, ngModelController) {
                var inputFile = $(iElm).find('input[type="file"]');

                $scope.uploaderDatas = {
                        state: 'toupload', // toupload: 上传前  uploading:上传中  uploaded： 已上传
                        srcs: [],
                    }
                    // 触发选择文件
                $scope.selectFile = function() {
                    inputFile.click();
                };

                // 监听文件变动
                inputFile.on('change', function(e) {
                    $scope.uploaderDatas.state = 'uploading';
                    var formData = new FormData();
                    formData.append('photo', event.target.files[0]);
                    httpRequest.upload({
                        data: formData,
                        success: function(result) {
                            $scope.uploaderDatas.state = 'uploaded';
                            $scope.uploaderDatas.srcs.push(result.url);

                            ngModelController.$setViewValue(result);
                        }
                    })

                });

            }
        };
    }]);
})
