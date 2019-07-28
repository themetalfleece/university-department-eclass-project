console.log('general/copy-over-semester.js');

$('input[name=copy_over]').click(function () {
	var $lessons = $('div.semester-lessons-container');

	if ($(this).is(':checked')) {
		$lessons.hide();
	} else {
		$lessons.show();
	}
})