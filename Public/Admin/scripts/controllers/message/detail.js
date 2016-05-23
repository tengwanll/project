define(['app'], function(app) {
    app.controller('MessageDetailCtrl', ['$scope', function($scope) {
            $scope.messageDetailDatas = {
                config: {
                    content: [
                        { title: '姓名', type: 'input', key: 'name'},
                        { title: '电话', type: 'input', key: 'telephone'},
                        { title: '邮箱', type: 'input', key: 'email'},
                        { title: '联系地址', type: 'input', key: 'address'},
                        { title: '固定电话', type: 'input', key: 'phone'},
                        { title: '工作单位', type: 'input', key: 'work'},
                        { title: '留言内容', type: 'editor', key: 'content'},
                    ],
                    api: {
                        view: '/Admin/feedback/detail',
                        edit: '/Admin/feedback/update',
                    }
                }
            }
        }
    ])
})
