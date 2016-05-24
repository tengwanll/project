$(document).ready(function() {
	$(document).on('click', '.form button', function (e) {
		e.preventDefault();

		var formEle = $('.form');
		var postDatas = {
			name: formEle.find('input[name="name"]').val(),
			telephone: formEle.find('input[name="telephone"]').val(),
			email: formEle.find('input[name="email"]').val(),
			address: formEle.find('input[name="address"]').val(),
			tel: formEle.find('input[name="tel"]').val(),
			work: formEle.find('input[name="work"]').val(),
			txt: formEle.find('textarea').val()
		};

		// check
		for(var i in postDatas) {
            var telephone=/^((13[0-9])|(15[0-9])|(18[0-9])|(17[0-9]))\d{8}$/;
            var email=/^[_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,4}$/;
            var phone=/^((\(\d{3}\))|(\d{3}\-))?(\(0\d{2,3}\)|0\d{2,3}-)?[1-9]\d{6,7}$/;
			if (!postDatas[i]) {
				alert($('input[name="' + i + '"]').prev().html() + '不能为空。');
				return;
			}else{
                if(!telephone.exec($('#telephone').val())){
                    alert( '手机号码格式不对。');
                    return;
                }
                if(!email.exec($('#email').val())){
                    alert('邮箱格式不对。');
                    return;
                }
                if(!phone.exec($('#tel').val())){
                    alert('固定电话格式不对。');
                    return;
                }
            }
		}

		var btn = $(this);
		btn.html('提交中...').attr('disabled', 'disabled');

		$.post({
			url: '/Home/contact/add',
			type: 'post',
			data: postDatas,
			success: function (data) {
				if (data.errno === 0) {
					btn.html('发送').removeAttr('disabled');
					alert('留言成功!');
				}
			}
		})
	})
});