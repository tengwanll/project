define(['app'], function(app) {
    app.directive('editor', ['$http', '$stateParams', '$compile',
        function($http, $stateParams, $compile) {
            // Runs during compile
            return {
                // name: '',
                // priority: 1,
                // terminal: true,
                scope: {
                    ngModel: '='
                }, // {} = isolate, true = child, false/undefined = no change
                // scope: true,
                // controller: function($scope, $element, $attrs, $transclude) {},
                require: 'ngModel', // Array = multiple requires, ? = optional, ^ = check parent elements
                restrict: 'E', // E = Element, A = Attribute, C = Class, M = Comment
                // template: '',
                templateUrl: './scripts/directives/editor/editor.html',
                replace: true,
                // compile: function(element, attrs) {
                // return function ($scope, element, attrs, ngModelController) {}
                // },
                link: function($scope, element, attrs, ngModelController) {
                    // wangEditor.config.printLog = false;

                    // 初始化编辑器
                    var pageEditor = new wangEditor($compile(element.contents())($scope).context);

                    // console.log($(editorId));
                    pageEditor.config.uploadImgFileName = 'photo';
                    pageEditor.config.uploadImgUrl = '/Admin/admin/upload';
                    pageEditor.config.menus = [
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

                    // 设置初始值
                    $scope.$on('detailDataReady', function() {
                        ngModelController.$formatters.push(function(modelValue) {
                            pageEditor.$txt.html(modelValue);
                        });
                    });

                    // 自定义load事件
                    pageEditor.config.uploadImgFns.onload = function(resultText, xhr) {
                        var result = JSON.parse(resultText).result.url.substr(1);
                        console.log(pageEditor.$txt.html());    // 最后一个
                        pageEditor.$txt.html(pageEditor.$txt.html() + '<img src="' + result + '" style="max-width:100%;"/>');
                        // console.log($scope.pageEditor.$txt.html());

                        // var html = "";
                        // console.log(ngModelController)
                        // ngModelController.$parsers.push(function (viewValue) {
                        //     console.log(viewValue)
                        // });
                        // ngModelController.$formatters.push(function(modelValue) {
                        //     modelValue += '<img src="' + result + '" style="max-width:100%;"/>';
                        //     $scope.pageEditor.$txt.html(modelValue);
                        //     console.log(modelValue)
                        // });
                        // ngModelController.$setViewValue(html);
                    };

                    // 绑定数据
                    pageEditor.onchange = function() {
                        console.log(pageEditor.$txt.html())     // 当前的
                        $scope.$apply(function() {
                            var html = pageEditor.$txt.html();
                            ngModelController.$setViewValue(html);
                        });
                    };

                    pageEditor.create();
                }
            };
        }
    ]);
})
