define(['app'], function(app) {
    app.controller('CarouselDetailCtrl', ['$scope', function($scope) {
            $scope.carouselDetailDatas = {
                config: {
                    content: [
                        { title: '标题', type: 'input', key: 'title'},
                        { title: '链接', type: 'input', key: 'href'},
                        { title: '背景图', type: 'photo', key: 'photo'},
                        { title: '备注', type: 'text', key: 'description'}

                    ],
                    api: {
                        add: '/Admin/carousel/create',
                        view: '/Admin/carousel/detail',
                        edit: '/Admin/carousel/update',
                    }
                }
            }
        }
    ])
})
