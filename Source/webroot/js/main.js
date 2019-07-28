console.log('main.js');

function getQuery() {
	params={};location.search.replace(/[?&]+([^=&]+)=([^&]*)/gi,function(s,k,v){params[k]=v})
	return params;
}

$('div.collapse.main-menu').on('show.bs.collapse hide.bs.collapse', function (e) {
	console.log('got event');
	var $icon = $('#' + $(this).attr('id') + '-heading').find('i.fa').eq(0);
	var toAdd = (e.type === 'show') ? 'fa-chevron-down' : 'fa-chevron-right';
	var toRemove = (e.type === 'show') ? 'fa-chevron-right' : 'fa-chevron-down';
	$icon.addClass(toAdd).removeClass(toRemove);
});