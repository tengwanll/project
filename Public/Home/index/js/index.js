$(document).ready(function() {
    // banner
    var currentIndex = 0;
    var bannerList = $('.banner ul');

    var bannerTimmer = null;
    var bannerResart = null;

    bannerAutoPlay();

    function bannerAutoPlay () {
    	bannerTimmer = setInterval(next, 5000);
    }

    $(document).on('click', '.banner .prev a', function() {
    	clearInterval(bannerTimmer);
    	bannerList.stop();
        prev();
        bannerAutoPlay();
    })

    $(document).on('click', '.banner .next a', function() {
    	clearInterval(bannerTimmer);
    	bannerList.stop();
        next();
        bannerAutoPlay();
    })

    function next() {
        bannerList.animate({ left: -(currentIndex + 1) + '00%' }, 500, function() {
            currentIndex++;
            if (currentIndex === bannerList.find('li').size() - 1) {
                currentIndex = 0;
                bannerList.css('left', '0');
            }
        });
    }

    function prev() {
        if (currentIndex === 0) {
            currentIndex = bannerList.find('li').size() - 1;
            bannerList.css('left', -(currentIndex) + '00%');
        }
        bannerList.animate({ left: -(currentIndex - 1) + '00%' }, 500, function() {
            currentIndex--;
        });
    }



    // 服务项目切换
    $(document).on('click', '.project .tabs li', function(e) {
        e.preventDefault();
        var _index = $('.project .tabs li').index(this);

        $('.project .tabs .active').removeClass('active');
        $(this).addClass("active");
        $('.project .infoList.active').removeClass('active');
        $($('.project .infoList')[_index]).addClass('active');
    });


    // 最新资讯
    $(document).on('click', '.news ol li', function(e) {
        $('.news .active h6').removeClass('ellipsis_one_line');
        $('.news ol .active').removeClass('active');
        $(this).addClass('active').find('h6').addClass('ellipsis_one_line');
    });

});
