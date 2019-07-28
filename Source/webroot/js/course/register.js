console.log('user/course-register.js');

// 'select' with multiple options to change the lesson status
$('body.user table#lessons-register select.lesson-status').change(function () {
	// change the lesson status in the user's homepage
	var $this = $(this);
	var courseStatus = $this.val();
	var lessonId = $this.attr('data-lesson-id');

	$.ajax({
		type: 'POST',
		url: '/courses-students.json',
		data: {'course_id': lessonId, 'status': courseStatus}
	});

	if (courseStatus === 'deregister') {
		$this.removeClass('lesson-registered').addClass('lesson-notregistered');
	} else {
		$this.removeClass('lesson-notregistered').addClass('lesson-registered');
	}
});