define(['app'], function(app) {
    app.directive('editor', ['$http', '$stateParams', function($http, $stateParams) {
        // Runs during compile
        return {
            // name: '',
            // priority: 1,
            // terminal: true,
            scope: {
                // name: "=asd"
                ngModel: '='
            }, // {} = isolate, true = child, false/undefined = no change
            // scope: true,
            // controller: function($scope, $element, $attrs, $transclude) {},
            require: 'ngModel', // Array = multiple requires, ? = optional, ^ = check parent elements
            restrict: 'E', // E = Element, A = Attribute, C = Class, M = Comment
            template: '<textarea style="height: 200px;"></textarea>',
            // templateUrl: './editor.tpl.html',
            replace: true,
            // transclude: true,
            // compile: function(tElement, tAttrs, function transclude(function(scope, cloneLinkingFn){ return function linking(scope, elm, attrs){}})),
            link: function($scope, element, attrs, ngModelController) {
                // wangEditor.config.printLog = false;

                // 初始化编辑器
                $scope.editor = new wangEditor(element);

                $scope.editor.config.uploadImgFileName = 'photo';
                $scope.editor.config.uploadImgUrl = '/Admin/admin/upload';
                if (attrs.type === 'all') {
                    $scope.editor.config.menus = [
                        // 'source',
                        '|',
                        'bold',
                        'underline',
                        'italic',
                        // 'strikethrough',
                        // 'eraser',
                        // 'forecolor',
                        // 'bgcolor',
                        '|',
                        'quote',
                        'fontfamily',
                        'fontsize',
                        'head',
                        'unorderlist',
                        'orderlist',
                        'alignleft',
                        'aligncenter',
                        'alignright',
                        '|',
                        'link',
                        'unlink',
                        'table',
                        // 'emotion',
                        '|',
                        'img',
                        // 'video',
                        // 'location',
                        // 'insertcode',
                        '|',
                        'undo',
                        'redo',
                        'fullscreen'
                    ];
                } else if (attrs.type === 'text') {
                    $scope.editor.config.menus = ['fullscreen'];
                }

                // 设置初始值
                $scope.$on('detailDataReady', function() {
                    ngModelController.$formatters.push(function(modelValue) {
                        $scope.editor.$txt.html(modelValue);
                    });
                });
                // 自定义load事件
                $scope.editor.config.uploadImgFns.onload = function(resultText, xhr) {
                    var result = JSON.parse(resultText).result.url.substr(1);
                    $scope.editor.$txt.html($scope.editor.$txt.html() + '<img src="' + result + '" style="max-width:100%;"/>');
                };

                // 绑定数据
                $scope.editor.onchange = function() {
                    $scope.$apply(function() {
                        var html = $scope.editor.$txt.html();
                        ngModelController.$setViewValue(html);
                    });
                };

                $scope.editor.create();
            }
        };
    }]);
})
