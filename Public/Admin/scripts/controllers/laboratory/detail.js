define(['app'], function(app) {
    app.controller('LaboratoryDetailCtrl', ['$scope', function($scope) {
        $scope.laboratoryDetailDatas = {
            config: {
                content: [
                    { title: '名称', type: 'input', key: 'name' },
                    { title: '封面', type: 'photo', key: 'photo' },
                    { title: '简介', type: 'text', key: 'description' },
                    { title: '图片集', type: 'photoset', key: 'photoDetail' },
                ],
                api: {
                    add: '/Admin/laboratory/create',
                    view: '/Admin/laboratory/detail',
                    edit: '/Admin/laboratory/update',
                }
            }
        }
    }])
})
