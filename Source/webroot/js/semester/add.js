console.log('semester/add.js');

$('#copy_over_lessons').click(function () {
	var checked = $(this).is(':checked');
	if (checked) {
		$('.enable-for-copy').removeAttr('disabled');	
	} else {
		$('.enable-for-copy').attr('disabled', 'disabled');
	}
});