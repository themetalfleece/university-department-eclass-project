console.log('user/home.js');

$('body.home.user table#user-lessons select.lesson-status').change(function () {
	// change the lesson status in the user's homepage
	var $this = $(this);
	var courseStatus = $this.val();
	var userLessonId = $this.attr('data-userlesson-id');

	$.ajax({
		type: 'PUT',
		url: '/courses-students/' + userLessonId + '.json',
		data: {'status': courseStatus}
	})
	.always(function (data) {
		location.reload();
	});
});

$('body.home.user table#user-lessons i.remove-course').click(function () {
	var $this = $(this);
	var lessonId = $this.attr('data-userlesson-id');

	$.ajax({
		type: 'POST',
		url: '/courses-students.json',
		data: {'course_id': lessonId, 'status': 'deregister'}
	})
	.done(function (data) {
		console.log(data);
		if (data.hasOwnProperty('success') && data.success === true) {
			location.reload();
		}
	});
});