define(['app'], function(app) {
    app.directive('editor', ['$http', function($http) {
        // Runs during compile
        return {
            // name: '',
            // priority: 1,
            // terminal: true,
            scope: {
                // name: "=asd"
            }, // {} = isolate, true = child, false/undefined = no change
            // controller: function($scope, $element, $attrs, $transclude) {},
            // require: 'ngModel', // Array = multiple requires, ? = optional, ^ = check parent elements
            restrict: 'E', // E = Element, A = Attribute, C = Class, M = Comment
            template: '<textarea></textarea>',
            // templateUrl: './editor.tpl.html',
            replace: true,
            // transclude: true,
            // compile: function(tElement, tAttrs, function transclude(function(scope, cloneLinkingFn){ return function linking(scope, elm, attrs){}})),
            link: function(scope, element, attrs) { // wangEditor.config.printLog = false;
                console.log(attrs);
                var editor = new wangEditor(element);
                editor.config.uploadImgFileName = 'photo';
                editor.config.uploadImgUrl = '/Admin/admin/upload';
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
                // 自定义load事件
                editor.config.uploadImgFns.onload = function(resultText, xhr) {
                    result = JSON.parse(resultText).result;
                    editor.command(null, 'insertHtml', '<img src="' + result.substr(1) + '" style="max-width:100%;"/>');
                };

                scope.getEditorContent = function () {
                    return editor.txt.$txt.html();
                };

                editor.create();
            }
        };
    }]);
})
