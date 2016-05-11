$(document).ready(function() {
	// 展示历史公告
	$(document).on('click', '.newest li a', function (e) {
		$(this).parent().parent().find('.title').addClass('ellipsis_one_line');
		$(this).removeClass('ellipsis_one_line');
	});
});