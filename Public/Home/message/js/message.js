$(document).ready(function() {
	$(document).on('click', '.form button', function (e) {
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