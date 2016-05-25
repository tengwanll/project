define(['app'], function(app) {
    app.controller('CarouselDetailCtrl', ['$scope', function($scope) {
            $scope.carouselDetailDatas = {
                config: {
                    content: [
                        { title: '标题', type: 'input', key: 'title'},
                        { title: '封面', type: 'photo', key: 'photo'},
                        { title: '描述', type: 'editor', key: 'description'},
                        { title: '链接类型', type: 'editor', key: 'type'},
                        { title: '链接标题', type: 'editor', key: 'content'},
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
