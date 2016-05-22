define(['app'], function(app) {
    app.factory('httpRequest', ['$http', '$rootScope', function($http, $rootScope) {
        // 拼装url参数
        function handleUrl(api, params) {
            var url = api;
            for (var key in params) {
                url += '/' + key + '/' + params[key];
            }
            return url;
        }

        return {
            get: function(options) {
                options = {
                    api: options.api || '',
                    params: options.params || {},
                    success: options.success || function() {},
                    error: options.error || function() {}
                };
                $rootScope.showPageLoading = true;

                $http.get(handleUrl(options.api, options.params))
                    .then(function(res) {
                        console.info(res);
                        $rootScope.showPageLoading = false;
                        if (res.data.errno === 0) {
                            options.success(res.data.result);
                        } else {
                            console.log(res.data.ermsg);
                        }
                    })
            },
            post: function(options) {
                options = {
                    api: options.api || '',
                    params: options.params || {},
                    data: options.data || {},
                    success: options.success || function() {},
                };
                $http.post(handleUrl(options.api, options.params), options.data)
                    .then(function (res) {
                        if (res.data.errno === 0) {
                            res.data.result = res.data.result || {};
                            options.success(res.data.result);
                        } else {
                            console.log(res.data.ermsg);
                        }
                    })
            }
        };
    }])
});
