console.log('confirm-by-other-user.js');

$('select.user-confirmed').change(function () {
	var $this = $(this);

	var userId = $this.attr('data-user-id')
	var userConfirmed = ($this.val() === 'no') ? 0 : 1;

	$.ajax({
		type: 'POST',
		url: '/users/confirm-user.json',
		data: {'id': $this.attr('data-user-id'), 'user_confirmed' : userConfirmed}
	})
	.fail(function (data) {
		console.log('fail', data);
	})
	.done(function (data) {
		try {
			if (!data.hasOwnProperty('success') || !data.success) {
				throw 0;
			}
		} catch(err) {
			// set the value back
			$this.val(userConfirmed ? 'no' : 'yes');
		}
	});
});