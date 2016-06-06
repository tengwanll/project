$(document).ready(function() {
    var getDatas = false;
    var hasMore = true;
    var oLoad = $('.loading');
    var currentPage = 0;
    var rows = 12;
    var listDatas = [];
    var oList = $('.list');
    var colLeft = $(oList.find('ul')[0]);
    var colCenter = $(oList.find('ul')[1]);
    var colRight = $(oList.find('ul')[2]);

    // 获取第一页数据
    getListDatas();

    $(document).on('scroll', function(e) {
        // console.log(oLoad.position());
        // console.log(oLoad.offset());
        // console.log($(this).scrollTop());

        if ($(this).scrollTop() > oList.height() / 2 && !getDatas) {
            getDatas = true;
            if (hasMore) {
                getListDatas(++currentPage, function(data) {
                    if (!hasMore) {
                        oLoad.hide();
                        return;
                    }
                    getDatas = false;

                    var indexBegin = currentPage * rows;

                    // 插入数据
                    for (var i = 0, len = data.length; i < len; i++) {
                        var html = ' 												\
							<li data-listindex="'+ (indexBegin + i) + '">			\
								<a href="#">										\
									<img src="' + data[i].photo + '">				\
									<h6 class="ellipsis_one_line">					\
										<span>' + data[i].name + '</span>			\
									</h6>											\
								</a>												\
							</li>													\
                    	';
                    	colLeft.append(html);
                    	var leftHeight = $(oList.find('ul')[0]).height();
                    	var centerHeight = $(oList.find('ul')[1]).height();
                    	var rightHeight = $(oList.find('ul')[2]).height();
                    	var heightArr = [leftHeight, centerHeight, rightHeight].sort();
                    	(leftHeight === heightArr[0] ? colLeft : (centerHeight === heightArr[0] ? colCenter : colRight)).append(html);
                    }
                });
            }
        }
    });


    function getListDatas(page, cb) {
        var options = {
            page: page || 0,
            rows: rows
        };

        $.get({
            url: '/Home/laboratory/lists/rows/' + options.rows + '/page/' + options.page,
            success: function(data) {
                if (data.result.page * options.rows + data.result.list.length >= parseInt(data.result.total)) {
                    hasMore = false;
                }
                listDatas = listDatas.concat(data.result.list);
                if (cb) cb(data.result.list);
            },
            error: function() {
                alert('加载失败！');
            }
        });
    }



});
