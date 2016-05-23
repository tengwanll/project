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
                // 初始化编辑器，获取实例
                $scope.editor = init();

                // 设置初始值
                $scope.$on('detailDataReady', function() {
                    ngModelController.$formatters.push(function (modelValue) {
                        $scope.editor.txt.$txt.html(modelValue);
                    });
                });

                // 初始化编辑器
                function init() {
                    var editor = new wangEditor(element);

                    editor.config.uploadImgFileName = 'photo';
                    editor.config.uploadImgUrl = '/Admin/admin/upload';
                    if (attrs.type === 'all') {
                        editor.config.menus = [
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
                        editor.config.menus = ['fullscreen'];
                    }
                    // 自定义load事件
                    editor.config.uploadImgFns.onload = function(resultText, xhr) {
                        result = JSON.parse(resultText).result;
                        editor.command(null, 'insertHtml', '<img src="' + result.substr(1) + '" style="max-width:100%;"/>');
                    };

                    // 绑定数据
                    editor.onchange = function() {
                        $scope.$apply(function() {
                            var html = editor.$txt.html();
                            ngModelController.$setViewValue(html);
                        });
                    };

                    editor.create();

                    return editor;
                };

            }
        };
    }]);
})
