$('body.user form#search').submit(function (e) {
	var params = getQuery();

	params['search'] = $(this).find('input.search').eq(0).val();

	var completeUrl = window.location.pathname;
	var paramsCount = Object.keys(params).length;

	if (paramsCount === 1 && $.trim(params['search']) === '') {
		// no get vars, do not alter the completeUrl
	} else {
		if ($.trim(params['search']) === '') {
			delete params['search'];
		}
		// there are get vars
		params['page'] = 1;
		completeUrl += '?';
		for (var key in params) {
			completeUrl += key + '=' + params[key] + '&';
		}

		completeUrl = completeUrl.slice(0, -1);
	}

	window.location.href = completeUrl;
	e.preventDefault();
	return false;
});

$('body.user #search-clear').click(function () {
	var $input = $('body.user form#search input.search').eq(0);

	if ($.trim($input.val()) === '') {
		$input.val('');
		$input.focus();
		return;
	}

	$input.val('');
	$('body.user form#search').submit();
});