console.log('user/register.js');

$('select#user-type').change(function () {

	var $this = $(this);

	$this.find('> option').each(function () {
		if (this.value === $this.val()) {
			$('.' + this.value + '-specific').show();
		} else {
			$('.' + this.value + '-specific').hide();
		}
	});
});