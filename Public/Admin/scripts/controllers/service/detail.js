define(['app'], function(app) {
    app.controller('ServiceDetailctrl', ['$scope', function($scope) {
        $scope.serviceDetailDatas = {
            config: {
                content: [
                    { title: '服务名称', type: 'input', key: 'title'},
                    { title: '分类', type: 'select', key: 'sortId'},
                    { title: '概述', type: 'text', key: 'shortDesc'},
                    { title: '项目简介', type: 'editor', key: 'description'},

                    { title: '实验流程', type: 'editor', key: 'experimentFlow', sort: 1 },
                    { title: '用户需知', type: 'editor', key: 'userNotice', sort: 1 },
                    { title: '结果展示', type: 'editor', key: 'resultShow', sort: 1 },
                    { title: '服务周期', type: 'editor', key: 'serverCircle', sort: 1 },

                    { title: '实验原理', type: 'editor', key: 'experimentTheory', sort: 2 },
                    { title: '项目优势', type: 'editor', key: 'advantage', sort: 2 },
                    { title: '实验流程', type: 'editor', key: 'experimentFlow', sort: 2 },
                    { title: '结果展示', type: 'editor', key: 'resultShow', sort: 2 },
                    { title: '服务周期', type: 'editor', key: 'serverCircle', sort: 2 },
                    { title: '参考文献', type: 'editor', key: 'literature', sort: 2 },
                    { title: '客户须知', type: 'editor', key: 'userNotice', sort: 2 },
                ],
                api: {
                    add: '/Admin/service/create',
                    view: '/Admin/service/detail',
                    edit: '/Admin/service/update',
                    sort: '/Admin/service/sortList',
                },
                sort: [
                    {key: '1', value: "普通服务"},
                    {key: '2', value: "特色服务"},
                ]
            }
        }
    }])
})
