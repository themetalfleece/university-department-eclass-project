console.log('professor/register.js');

$('input.professor-register').change(function () {
	var $this = $(this);

	var checked = $this.is(':checked');

	$.ajax({
		type: 'POST',
		url: '/professors/register.json',
		data: {
			checked: checked,
			csid: $this.data('cs-id')
		}
	});
});