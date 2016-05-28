$(document).ready(function() {
	$(document).on('mouseover', '.concept .info li', function (e) {
		$(this).parent().find('li').removeClass('hover').addClass('nohover');
		$(this).removeClass('nohover').addClass('hover');
	});
	$(document).on('mouseout', '.concept .info ul', function (e) {
		$(this).find('li').removeClass('hover nohover');
	})
});