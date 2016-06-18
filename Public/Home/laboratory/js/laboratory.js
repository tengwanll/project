$(document).ready(function() {
    var gettingDatas = false;
    var hasMoreDatas = true;
    var oLoad = $('.loading');
    var currentPage = 1;
    var currentPhotoIndex = 0;
    var currentData = {};
    var rows = 12;
    var listDatas = [];
    var oList = $('.list');
    var colLeft = $(oList.find('ul')[0]);
    var colCenter = $(oList.find('ul')[1]);
    var colRight = $(oList.find('ul')[2]);

    // 获取第一页数据
    getListDatas(currentPage);

    // 动态加载
    $(document).on('scroll', function(e) {
        if ($(this).scrollTop() > oList.height() / 2 && !gettingDatas && hasMoreDatas) {
            hasMoreDatas = false;
            gettingDatas = true;
            getListDatas(++currentPage, function(data) {
                console.log(data)
                var indexBegin = (currentPage - 1) * rows;
                // 插入数据
                for (var i = 0, len = data.length; i < len; i++) {
                    var html = '                                                \
                            <li data-listindex="' + (indexBegin + i) + '">          \
                                <a href="#">                                        \
                                    <img src="' + data[i].photo + '">               \
                                    <h6 class="ellipsis_one_line">                  \
                                        <span>' + data[i].name + '</span>           \
                                    </h6>                                           \
                                </a>                                                \
                            </li>                                                   \
                        ';
                    var leftHeight = $(oList.find('ul')[0]).height();
                    var centerHeight = $(oList.find('ul')[1]).height();
                    var rightHeight = $(oList.find('ul')[2]).height();
                    var heightArr = [leftHeight, centerHeight, rightHeight].sort();
                    (leftHeight === heightArr[0] ? colLeft : (centerHeight === heightArr[0] ? colCenter : colRight)).append(html);
                }
                gettingDatas = false;
                if (!hasMoreDatas) {
                    $('.loading').hide();
                }
            });
        }
    });

    // 查看图片集
    $(document).on('click', '.list li a', function(e) {
        e.preventDefault();
        currentData = listDatas[$(this).parent().data('listindex')];
        var html = '<li><img src="' + currentData.photo + '"/></li>';
        for (var i in currentData.photoDetailUrl) {
            html += '<li><img src="' + currentData.photoDetailUrl[i] + '"/></li>';
        }

        // reset
        $('.detail .next').removeClass('hide');
        $('.detail .prev').addClass('hide');
        currentPhotoIndex = 0;

        $('.detail .photos ul').html(html);
        $('.detail .info .name').html(currentData.name).next().html(currentData.description);

        if ($('.detail .photos li').size() <= 1) {
            $('.detail .next').addClass('hide');
        }
        $('.detail').show();
    });

    // 下一张
    $(document).on('click', '.detail .next', function(e) {
        e.preventDefault();

        $(this).prev().removeClass('hide');

        $('.detail .photos li:eq(' + currentPhotoIndex++ + ')').hide().next().show();
        if (currentPhotoIndex === currentData.photoDetailUrl.length) {
            $(this).addClass('hide');
        } else {
            $(this).removeClass('hide');
        }
    });

    // 上一张
    $(document).on('click', '.detail .prev', function(e) {
        $(this).next().removeClass('hide');
        $('.detail .photos li:eq(' + currentPhotoIndex-- + ')').hide().prev().show();
        e.preventDefault();
        if (currentPhotoIndex === 0) {
            $(this).addClass('hide');
        } else {
            $(this).removeClass('hide');
        }
    });

    // 关闭图片集页面
    $(document).on('click', '.detail .fa-close', function(e) {
        $('.detail').hide();
    });


    // 获取数据
    function getListDatas(page, cb) {
        var options = {
            page: page,
            rows: rows
        };

        $.get({
            url: '/Home/laboratory/lists/rows/' + options.rows + '/page/' + options.page,
            success: function(data) {
                listDatas = listDatas.concat(data.result.list);
                if (listDatas.length === data.result.total) {
                    hasMoreDatas = false;
                }
                if (cb) cb(data.result.list);
            },
            error: function() {
                alert('加载失败！');
            }
        });
    }
});
