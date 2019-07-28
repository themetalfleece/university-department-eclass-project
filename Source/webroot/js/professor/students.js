console.log('professor/students.js')

var $modal = $('#user-courses-modal');
var $modalHeader = $('#user-courses-modal-header');
var $modalContent = $('#user-courses-modal-content');
var $modalLoading = $('#user-courses-modal-loading');

var $coursesReq = null;

$('a.student-with-courses').click(function (e) {
	var $this = $(this);

	$modalContent.hide();
	$modalLoading.show();

	var studentId = $this.data('id');

	function ajaxFail() {
		alert('Problem fetching data from the server. Try again later.');
		$modal.modal('hide');
	}

	$.ajax({
		'type': 'GET',
		'url': '/professors/specific-student-courses.json',
		'data': {'student-id': studentId}
	})
	.done(function (data, textStatus, jqXHR ) {
		console.log(data);

		if (!data || !data.courses || !data.user) {
			return ajaxFail();
		}

		$modalContent.show();
		$modalContent.append(data.courses);
		$modalHeader.append(data.user);
	})
	.fail(ajaxFail)
	.always(function () {
		$modalLoading.hide();
	});

	$modal.modal();
	e.preventDefault();
	return false;
});

$modal.on('hidden.bs.modal', function () {
	$modalContent.html('');
	$modalHeader.html('');

	if ($coursesReq) {
		$coursesReq.abort();
	}
});