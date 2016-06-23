define(['app'], function(app) {
    app.controller('InfoCtrl', ['$scope', '$state', 'httpRequest',
        function($scope, $state, httpRequest) {

            $scope.infoDatas = {
                data: {},
                newData: {}
            };

            // 初始化数据
            httpRequest.get({
                api: '/Admin/admin/company',
                success: function(data) {
                    $scope.infoDatas.data = data;
                    $scope.infoDatas.newData = angular.copy($scope.infoDatas.data);
                }
            });


            // 保存
            $scope.save = function(e) {
                $(e.target).attr('disabled', 'disabled');

                var postDatas = $scope.infoDatas.newData;

                // 处理图片
                if (postDatas.photo) postDatas.photo = postDatas.photo.id;

                // 发送请求
                httpRequest.post({
                    api: '/Admin/admin/updateCompany',
                    data: postDatas,
                    success: function(result) {
                        alert('保存成功！');
                        $state.reload();
                    }
                });
            };

            // 重填
            $scope.reset = function(e) {
                $scope.infoDatas.newData = angular.copy($scope.infoDatas.data);
            };

        }


    ])
})
