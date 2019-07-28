console.log('settings.js');

$('#change-image').click(function () {
	$('#user-image-input').click();
})

$('#user-image-input').change(function () {
	var $this = $(this);
	var filename = $this.val().split('\\').pop();
	$('#image-filename').text(filename);

	// show the image in base64
	var file = this.files[0];
	var reader  = new FileReader();

	reader.addEventListener('load', function () {
		$('#profile-picture').attr('src', reader.result);
	}, false);

	if (file) {
		reader.readAsDataURL(file);
	}
});

$('#add-phone-input, #add-email-input').bind('keypress', function(e) {
	if (e.keyCode === 13) {
		var type = ($(this).attr('id') === 'add-phone-input') ? 'phone' : 'email';
		$('#add-' + type).click();
		e.preventDefault();
		return false;
	}
});

$('#add-phone, #add-email').click(function () {
	var $this = $(this);
	var type = ($this.attr('id') === 'add-phone') ? 'phone' : 'email';

	var $input = $('#add-' + type + '-input');

	var value = $.trim($input.val());
	$this.val(value);

	if (value === '') {
		return;
	}

	var $list = $('#' + type + '-list');

	var exists = false;
	$list.find('li').each(function () {
		if ($(this).text() === value) {
			exists = true;
			return false;
		}
	});

	if (exists) {
		return;
	}

	function isValidPhone(p) {
		var phoneRe = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im;
		return phoneRe.test(p);
	}

	function isValidEmail(email) {
		var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		return re.test(email);
	}

	var $inputGroup = $input.parents('.input-group').eq(0);

	if ((type === 'phone' && !isValidPhone(value)) || (type === 'email' && !isValidEmail(value))) {
		$input.addClass('form-control-warning');
		$inputGroup.addClass('has-warning');
		return;
	}

	$input.removeClass('form-control-warning');
	$inputGroup.removeClass('has-warning');

	var lastLiIndex = $list.find('li').last().index();

	var $li = $('<li>').addClass('new').text(value);

	var $hiddenInput = $('<input>').attr('type', 'hidden').attr('value', value);
	var $remove = $('#remove-entity-template').clone().removeAttr('id').addClass(type);

	$li.append($remove);
	$li.append($hiddenInput);

	$list.append($li);

	$list.find('li').each(function (index, e) {
		var $this = $(this);
		if ($this.find('input[type=hidden]').length === 2) {
			$this.find('input[type=hidden]').eq(0).attr('name', 'user_' + type + 's[' + index + '][id]');
			$this.find('input[type=hidden]').eq(1).attr('name', 'user_' + type + 's[' + index + '][' + type + ']');
		} else {
			$this.find('input[type=hidden]').attr('name', 'user_' + type + 's[' + index + '][' + type + ']');
		}
	})

	$input.val('');
});

$(document).on('click', '.remove.phone, .remove.email', function (e) {
	console.log('clicked');
	var $this = $(this);
	var $li = $this.parents('li').eq(0);

	var isNew = $li.hasClass('new');
	var type = $this.hasClass('email') ? 'email' : 'phone';

	if (isNew) {
		// this phone was just added, so removing the li is all we need because the phone is not saved on the server yet
		$li.remove();
	} else {
		// inform the server about the deletion
		$this.hide();

		$.ajax({
			'type': 'post',
			'url': '/user-' + type + 's/delete/' + $this.attr('data-id') + '.json'
		})
		.done(function (data) {
			if (data.hasOwnProperty('success') && data.success) {
				$li.remove();
			} else {
				$this.show();
			}
		})
		.fail(function () {
			$this.show();
		});
	}

	e.preventDefault();
	return false;
});